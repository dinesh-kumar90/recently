<?php namespace OhMyBrew\ShopifyApp\Traits;

use OhMyBrew\ShopifyApp\Jobs\WebhookInstaller;
use OhMyBrew\ShopifyApp\Jobs\ScripttagInstaller;
use OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use \App\Order;
use \Carbon\Carbon;
use \App\Setting;
use \Illuminate\Support\Facades\View;

trait AuthControllerTrait
{
    /**
     * Index route which displays the login page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('shopify-app::auth.index');
    }

    /**
     * Authenticating a shop
     *
     * @return \Illuminate\Http\Response
     */
    public function authenticate()
    {
        // Grab the shop domain (uses session if redirected from middleware)
        $shopDomain = request('shop') ?: session('shop');
        if (!$shopDomain) {
            // Back to login, no shop
            return redirect()->route('login');
        }

        // Save shop domain to session
        session(['shopify_domain' => ShopifyApp::sanitizeShopDomain($shopDomain)]);
        session()->forget('shop');

        if (!request('code')) {
            // Handle a request without a code
            return $this->authenticationWithoutCode();
        } else {
            // Handle a request with a code
            return $this->authenticationWithCode();
        }
    }

    /**
     * Fires when there is no code on authentication
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticationWithoutCode()
    {
        // Setup an API instance
        $shopDomain = session('shopify_domain');
        $api = ShopifyApp::api();
        $api->setShop($shopDomain);

        // Grab the authentication URL
        $authUrl = $api->getAuthUrl(
            config('shopify-app.api_scopes'),
            url(config('shopify-app.api_redirect'))
        );

        // Do a fullpage redirect
        return view('shopify-app::auth.fullpage_redirect', [
            'authUrl' => $authUrl,
            'shopDomain' => $shopDomain
        ]);
    }

    /**
     * Fires when there is a code on authentication
     *
     * @return \Illuminate\Http\Response
     */
    protected function authenticationWithCode()
    {
        // Setup an API instance
        $shopDomain = session('shopify_domain');
        $api = ShopifyApp::api();
        $api->setShop($shopDomain);

        // Check if request is verified
        if (!$api->verifyRequest(request()->all())) {
            // Not valid, redirect to login and show the errors
            return redirect()->route('login')->with('error', 'Invalid signature');
        }

        // Save token to shop
        $shop = ShopifyApp::shop();
        $shop->shopify_token = $api->requestAccessToken(request('code'));
        $shop->save();

        // Install webhooks and scripttags
        $this->installWebhooks();
        $this->installScripttags();
        $this->ordersImport();
        $this->updateThemesAssets();
        $setting = Setting::where('shop_id',ShopifyApp::shop()->id)->first();
        if(!$setting){
            
            $setting = new Setting;
            $setting->shop_id = ShopifyApp::shop()->id;
            $setting->active = 1;
            $setting->active_desktop = 1;
            $setting->active_mobile = 1;
            $setting->settings = '{"active":true,"active_desktop":true,"active_mobile":true,"loop":true,"random":false,"pause":false,"link":true,"close":true,"desktop_text_color":"#000000","desktop_background_color":"#ffffff","desktop_date_color":"#000000","desktop_border_color":"#cccccc","desktop_product_color":"#000000","mobile_text_color":"#000000","mobile_background_color":"#ffffff","mobile_date_color":"#000000","mobile_product_color":"#000000","notifications_per_page":20,"round_corners":3,"border_width":0,"desktop_space":20,"desktop_style":"1","desktop_animation":"fade-slide-vertical","desktop_font_family":null,"desktop_placement":"bottom-left","mobile_space":0,"mobile_style":"1","mobile_animation":"fade","mobile_font_family":null,"mobile_placement":"bottom","initial_delay":true,"initial_delay_val":5,"interval":true,"interval_val":4,"display_time":4,"message":"{ name } in { city }, { country } purchased { product }","distance":false}';
            $setting->save();

        }
        
        // Go to homepage of app
        return redirect()->route('home');
    }

    /**
     * Installs webhooks (if any)
     *
     * @return void
     */
    protected function ordersImport()
    {
        
            // Get the current webhooks installed on the shop
            $order_count = Order::where('shop_id',ShopifyApp::shop()->id)->count();
            if($order_count == 0){
                $api = ShopifyApp::shop()->api();
                $shopOrders = $api->request(
                    'GET',
                    '/admin/orders.json',
                    []
                )->body->orders;
                foreach ($shopOrders as $key => $orders) {
                    foreach ($orders->line_items as $key => $line_item) {
                        if($line_item->product_id != null){
                            $product = $api->request(
                                    'GET',
                                    '/admin/products/'.$line_item->product_id.'.json',
                                    ['fields'=>'id,title,image,handle']
                                )->body->product;
                        }
                        if(isset($orders->shipping_address)){
                            $order = new Order;
                            $order->shop_id = ShopifyApp::shop()->id;
                            $order->order_id = (string)$orders->id;
                            $order->order_number = $orders->order_number;
                            $order->variant_id = (string)$line_item->variant_id;
                            $order->product_id = (string)$line_item->product_id;
                            $order->product_name = $line_item->name;
                            $order->customer_name = $orders->shipping_address->name;
                            $order->customer_address = $orders->shipping_address->address1.', '.$orders->shipping_address->address2;
                            $order->customer_city = $orders->shipping_address->city;
                            $order->customer_province = $orders->shipping_address->province;
                            $order->customer_country = $orders->shipping_address->country;
                            $order->customer_zip = $orders->shipping_address->zip;
                            $order->latitude = $orders->shipping_address->latitude;
                            $order->longitude = $orders->shipping_address->longitude;
                            $order->created = Carbon::createFromFormat("Y-m-d\TH:i:sP", $orders->created_at)->timestamp;
                            if($line_item->product_id != null){
                                if($product->image != null){
                                    $order->image = $product->image->src;
                                }
                                $order->url = $product->handle;
                            }else{
                                $order->image = '';
                                $order->url = '';
                            }
                            $order->save();
                        }
                    }
                }
            }
            return true;
            
    }

    /**
     * Installs webhooks (if any)
     *
     * @return void
     */
    protected function installWebhooks()
    {
        $webhooks = config('shopify-app.webhooks');

        if (sizeof($webhooks) > 0) {
            // dispatch(
            //     new WebhookInstaller(ShopifyApp::shop(), $webhooks)
            // );
            // Keep track of whats created
            $created = [];
            // Get the current webhooks installed on the shop
            $api = ShopifyApp::shop()->api();
            $shopWebhooks = $api->request(
                'GET',
                '/admin/webhooks.json',
                ['limit' => 250, 'fields' => 'id,address']
            )->body->webhooks;

            foreach ($webhooks as $webhook) {
                // Check if the required webhook exists on the shop
                if (!$this->webhookExists($shopWebhooks, $webhook)) {

                    // It does not... create the webhook
                    $api->request('POST', '/admin/webhooks.json', ['webhook' => $webhook]);
                    
                    $created[] = $webhook;
                    
                }
            }

            return $created;
        }
    }
    /**
     * Check if webhook is in the list.
     *
     * @param array $shopWebhooks The webhooks installed on the shop
     * @param array $webhook     The webhook
     *
     * @return boolean
     */
    protected function webhookExists(array $shopWebhooks, array $webhook)
    {
        foreach ($shopWebhooks as $shopWebhook) {
            if ($shopWebhook->address === $webhook['address']) {
                // Found the webhook in our list
                return true;
            }
        }

        return false;
    }

    /**
     * Installs scripttags (if any)
     *
     * @return void
     */
    protected function installScripttags()
    {
        $scripttags = config('shopify-app.scripttags');
        if (sizeof($scripttags) > 0) {
            // dispatch(
            //     new ScripttagInstaller(ShopifyApp::shop(), $scripttags)
            // );
            // Keep track of whats created
            $created = [];

            // Get the current scripttags installed on the shop
            $api = ShopifyApp::shop()->api();
            $shopScripttags = $api->request(
                'GET',
                '/admin/script_tags.json',
                ['limit' => 250, 'fields' => 'id,src']
            )->body->script_tags;

            foreach ($scripttags as $scripttag) {
                // Check if the required scripttag exists on the shop
                if (!$this->scripttagExists($shopScripttags, $scripttag)) {
                    // It does not... create the scripttag
                    $api->request('POST', '/admin/script_tags.json', ['script_tag' => $scripttag]);
                    $created[] = $scripttag;
                }
            }

            return $created;
        }
    }
    /**
     * Check if scripttag is in the list.
     *
     * @param array $shopScripttags The scripttags installed on the shop
     * @param array $scripttag      The scripttag
     *
     * @return boolean
     */
    protected function scripttagExists(array $shopScripttags, array $scripttag)
    {
        foreach ($shopScripttags as $shopScripttag) {
            if ($shopScripttag->src === $scripttag['src']) {
                // Found the scripttag in our list
                return true;
            }
        }

        return false;
    }


    /**
     * Update Theme assets for real time analysis
     *
     * @return boolean
     */
    protected function updateThemesAssets()
    {
        $api = ShopifyApp::shop()->api();
         $view = (string) View::make('snippet_tracking');
         $themes = $api->request('GET','/admin/themes.json',[])->body->themes;
         foreach ($themes as $key => $theme) {
            if($theme->role != 'demo'){
                $asset = $api->request(
                                        'PUT',
                                        '/admin/themes/'.$theme->id.'/assets.json',
                                        ['asset' => ['key' => 'snippets/cc-tracking.liquid', 'value' => $view] ] 
                                    );
                $theme_layout = $api->request(
                                        'GET',
                                        '/admin/themes/'.$theme->id.'/assets.json',
                                        ['asset' => ['key' => 'layout/theme.liquid'] ] 
                                    )->body->asset;
                if(str_contains($theme_layout->value, "<!-- cc-tracking start -->{% include 'cc-tracking' %}<!-- cc-tracking end -->") == false){
                    $updated_layout = str_replace("</body>","<!-- cc-tracking start -->{% include 'cc-tracking' %}<!-- cc-tracking end --></body>",$theme_layout->value);
                    $layout_asset = $api->request(
                                        'PUT',
                                        '/admin/themes/'.$theme->id.'/assets.json',
                                        ['asset' => ['key' => 'layout/theme.liquid', 'value' => $updated_layout] ] 
                                    );
                }
            }
         }
        
    }
}
