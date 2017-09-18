<?php

namespace App\Http\Controllers;

use App\Stat;
use Illuminate\Http\Request;
use App\Events\statPosted;
use \OhMyBrew\ShopifyApp\Models\Shop;
use \OhMyBrew\ShopifyApp\Facades\ShopifyApp;
use DB;
use Carbon\Carbon;

class StatController extends Controller
{
    /**
     * Get function
     *
     * @return void
     * @author 
     **/
    public function index(Request $request)
    {
    	$shop = ShopifyApp::shop();
    	return Stat::where('shop', $shop->shopify_domain)->get();
    }

    /**
     * count function
     *
     * @return void
     * @author 
     **/
    public function count(Request $request)
    {
        $shop = ShopifyApp::shop();
        $view_stat = Stat::where(function ($query) use($shop) {
                $query->where('shop', $shop->shopify_domain)
                      ->where('action', 0)
                      ->whereDate('created_at', DB::raw('CURDATE()'));
            })->count();
        $clicked_stat = Stat::where(function ($query) use($shop) {
                $query->where('shop', $shop->shopify_domain)
                      ->where('action', 1)
                      ->whereDate('created_at', DB::raw('CURDATE()'));
            })->count();
        $purchased_stat = Stat::where(function ($query) use($shop) {
                $query->where('shop', $shop->shopify_domain)
                      ->where('action', 2)
                      ->whereDate('created_at', DB::raw('CURDATE()'));
            })->count();
        return ['view_count' => $view_stat,'clicked_count' => $clicked_stat,'purchased_count' => $purchased_stat];
    }

    /**
     * Save function
     *
     * @return void
     * @author 
     **/
    public function save(Request $request)
    {
    	$country_iso = strtolower(geoip()->getLocation(request()->ip())['iso_code']);
    	$stat = Stat::create([
    		'shop' => $request->get('s'),
    		'title' => $request->get('t'),
    		'mobile' => $request->get('m'),
    		'action' => $request->get('a'),
    		'ip' => request()->ip(),
    		'country_iso' => $country_iso
    		]);
    	broadcast(new statPosted($stat))->toOthers();
		return ['status' => 'OK'];
    }
    /**
     * analytics function
     *
     * @return void
     * @author 
     **/
    public function analytics(Request $request)
    {
        $shop = ShopifyApp::shop();
        $type = $request->get('type');
        $group = $request->get('group');
        $action = 0;
        if($type == 'clicks'){
            $action = 1;
        }elseif ($type == 'purchases') {
            $action = 2;
        }
        $query = '';
        if($group == 'day'){
            for ($i=1; $i < 31; $i++) {
              $query .= "union select curdate() - interval ".$i." day ";
            }
            $analytics = DB::select("SELECT DAY(days.day) as label_value, concat(DAY(days.day),' days') as label, count(stats.id) as value
        FROM
          (select curdate() as day {$query}
           ) days
          left join stats
           on (days.day = DATE_FORMAT(stats.created_at,'%Y-%m-%d') and stats.shop = 'social-feeds.myshopify.com' and stats.action = {$action})
        group by
          days.day");
        }elseif ($group == 'week') {
            for ($i=1; $i < 11; $i++) {
              $query .= "union select curdate() - interval ".$i." week ";
            }

            $analytics = DB::select("SELECT WEEK(weeks.week) as label_value, concat(WEEK(weeks.week),' weeks') as label, count(stats.id) as value
        FROM
          (select curdate() as week {$query}
           ) weeks
          left join stats
           on (WEEK(weeks.week) = WEEK(stats.created_at) and stats.shop = 'social-feeds.myshopify.com' and stats.action = {$action})
        group by
          weeks.week");
        }else{
           for ($i=1; $i <= 12; $i++) {
              $query .= "union select curdate() - interval ".$i." month ";
            } 
            
            $analytics = DB::select("SELECT MONTHNAME(months.month) as label_value, concat(MONTH(months.month),' months') as label, count(stats.id) as value
        FROM
          (select curdate() as month {$query}
           ) months
          left join stats
           on (DATE_FORMAT(months.month,'%Y-%m') = DATE_FORMAT(stats.created_at,'%Y-%m') and stats.shop = 'social-feeds.myshopify.com' and stats.action = {$action})
        group by
          months.month");
        }
        

        return $analytics;
    }
}
