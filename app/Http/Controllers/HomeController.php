<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \OhMyBrew\ShopifyApp\Models\Shop;
use \OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use View;
use Response;
use DB;
use App\Order;
use App\Setting;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth.shop');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        
        $shop = ShopifyApp::shop();
        
        $setting = Setting::where('shop_id',$shop->id)->first();
        $notification_per_page = json_decode($setting->settings)->notifications_per_page;

        $orders = Order::where('shop_id',$shop->id) ->orderBy('order_id', 'desc')->take($notification_per_page)->get();
        return view('dashboard', ['orders' => $orders]);
    }
    /**
     * Show the get Settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSettings(Request $request)
    {
        $shop = ShopifyApp::shop();
        $setting = Setting::where('shop_id',$shop->id)->first();
        return response()->json([
            'response_code' => 'success',
            'setting' => $setting
        ]);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function saveSetting(Request $request)
    {
        $shop = ShopifyApp::shop();
        $setting = Setting::updateOrCreate(
            ['shop_id' => $shop->id],
            ['active' => $request->get('active'), 'active_desktop' => $request->get('active_desktop'), 'active_mobile' => $request->get('active_mobile'), 'settings' => json_encode($request->all())]
        );
        
        return response()->json([
            'response_code' => 'success',
            'setting' => $setting
        ]);
        
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function script(Request $request)
    {
        //return Carbon::createFromFormat("Y-m-d\TH:i:sP", '2017-07-26T08:40:49-04:00')->timestamp;
        $shop = Shop::where('shopify_domain',$request->get('shop'))->first();
        $setting = Setting::where('shop_id',$shop->id)->first();
        $notification_per_page = json_decode($setting->settings)->notifications_per_page;

        $orders = Order::where('shop_id',$shop->id) ->orderBy('order_id', 'desc')->take($notification_per_page)->get();

        $contents = View::make('script', [ 'shop' => $shop , 'setting' => json_decode($setting->settings), 'orders' => $orders ]);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'application/javascript');
        $response->header('Access-Control-Allow-Origin', '*');
        $response->header('Access-Control-Allow-Methods', 'GET');
        return $response;
    }
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function style(Request $request)
    {
        //return Carbon::createFromFormat("Y-m-d\TH:i:sP", '2017-07-26T08:40:49-04:00')->timestamp;
        $shop = Shop::where('shopify_domain',$request->get('shop'))->first();
        $setting = Setting::where('shop_id',$shop->id)->first();
        

        $contents = View::make('css', [ 'shop' => $shop , 'setting' => json_decode($setting->settings)]);
        $response = Response::make($contents, 200);
        $response->header('Content-Type', 'text/css');
        return $response;
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function store(Request $request)
    {
        $shop = Shop::where('shopify_domain',$request->get('shop'))->first();
        $setting = Setting::where('shop_id',$shop->id)->first();
        $notification_per_page = json_decode($setting->settings)->notifications_per_page;

        if(json_decode($setting->settings)->distance == false){
            $orders = Order::where('shop_id',$shop->id) ->orderBy('order_id', 'desc')->take($notification_per_page)->get();
        }else{
            $circle_radius = 3959;
            $lat = $request->get('lat');
            $lng = $request->get('lng');

            $orders = DB::select(
                           'SELECT * FROM
                                (SELECT *, ROUND(' . $circle_radius . ' * acos(cos(radians(' . $lat . ')) * cos(radians(latitude)) *
                                cos(radians(longitude) - radians(' . $lng . ')) +
                                sin(radians(' . $lat . ')) * sin(radians(latitude))))
                                AS distance
                                FROM orders WHERE shop_id = ' . $shop->id . ') AS distances
                            
                            ORDER BY distance
                            LIMIT '.$notification_per_page.';
                        ');
        }
        return response()->json([
            'language' => 'en',
            'status' => 'success',
            'message' => array('web'=>json_decode($setting->settings)->message),
            'notifications' => $orders,
            'timeago' => array('Just now','{mins} {min_txt} ago','min','mins','{hours} {hour_txt} ago','hour','hours','{days} {day_txt} ago','day','days','{weeks} {week_txt} ago','week','weeks')
        ]);

    }
}
