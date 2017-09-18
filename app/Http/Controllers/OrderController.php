<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \OhMyBrew\ShopifyApp\Models\Shop;
use \OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use App\Order;

class OrderController extends Controller
{
    /**
     * get Orders
     *
     * @return void
     * @author 
     **/
    public function index(Request $request)
    {
    	$shop = ShopifyApp::shop();
    	//$shop = Shop::where('shopify_domain',$request->get('shop'))->first();
    	$orders = Order::where('shop_id',$shop->id) ->orderBy('order_id', 'desc')->take(10)->get();
    	return json_encode($orders);
    }
}
