<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \OhMyBrew\ShopifyApp\Models\Shop;
use \OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use App\Order;
use \Carbon\Carbon;

class WebhookController extends Controller
{
    /**
     * Create Order Webhook
     *
     * @return void
     * @author 
     **/
    public function OrdersCreate(Request $request)
    {
    	
    	$shopDomain = $request->header('x-shopify-shop-domain');
        $data = json_decode($request->getContent());
        $shop = Shop::where('shopify_domain',$shopDomain)->first();
        $api = ShopifyApp::api();
        $api->setShop($shopDomain);
        $api->setAccessToken($shop->shopify_token);
        foreach ($data->line_items as $key => $item) {
            $product = $api->request(
                                'GET',
                                '/admin/products/'.$item->product_id.'.json',
                                ['fields'=>'id,title,image,handle']
                            )->body->product;
	        $order = new Order;
	        $order->shop_id = $shop->id;
	        $order->order_id = (string)$data->id;
	        $order->order_number = $data->order_number;
	        $order->variant_id = (string)$item->variant_id;
	        $order->product_id = (string)$item->product_id;
	        $order->product_name = $item->name;
	        $order->customer_name = $data->shipping_address->name;
	        $order->customer_address = $data->shipping_address->address1.', '.$data->shipping_address->address2;
	        $order->customer_city = $data->shipping_address->city;
	        $order->customer_province = $data->shipping_address->province;
	        $order->customer_country = $data->shipping_address->country;
	        $order->customer_zip = $data->shipping_address->zip;
	        $order->latitude = $data->shipping_address->latitude;
	        $order->longitude = $data->shipping_address->longitude;
	        $order->created = Carbon::createFromFormat("Y-m-d\TH:i:sP", $data->created_at)->timestamp;
            if($product->image != null){
                $order->image = $product->image->src;
            }
            $order->url = $product->handle;
	        $order->save();
        }
        return response('', 201);
    }
    /**
     * uninstall function
     *
     * @return void
     * @author 
     **/
    public function AppUninstalled(Request $request)
    {
           
        $hmac = $request->header('x-shopify-hmac-sha256');
        $shopDomain = $request->header('x-shopify-shop-domain');
        
        $data = $request->getContent();

        $hmacLocal = base64_encode(hash_hmac('sha256', $data, config('shopify-app.api_secret'), true));

        if (hash_equals($hmac, $hmacLocal) == false || empty($shopDomain)) {
            // Issue with HMAC or missing shop header
            
            abort(401, 'Invalid webhook signature');
        }
        //$shopDomain = 'demo-622.myshopify.com';
        $shop = Shop::where('shopify_domain',$shopDomain)->first();
        $shop->shopify_token = null;
        $shop->save();
        return response('', 201);                
    }
}
