<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
include 'CurlController.php';

class Dashboard_Controller extends Controller
{

public function index(Request $request)
{
    $curlController = new CurlController();
    $shop = $_GET['shop'];
    $store_details = DB::table("shopify_stores")->where('store_url',$shop)->get();
	$access_token = $store_details[0]->access_token;
	$url = "https://".$shop."/admin/api/2021-04/shop.json";
	$shop_data = $curlController->curl_get_fun($url,$access_token); 
	$countries = DB::table('country_price_setting')
		->select('*')->where(['store_url' => $shop,'country_status' => 1,'default_country' => null])
		->get();
	$announcement_bar = DB::table("announcement_bar_setting")->where(['store_url'=> $shop,  'bar_status' => 1])->get();
	$theme_setup = DB::table("theme_data")->where(['store_url'=> $shop])->get();
	$internal_redirects = DB::table("internal_redirect")->where(['store_url'=> $shop])->get();
	$external_redirects = DB::table("external_redirect")->where(['store_url'=> $shop])->get();
	$total_redirects = count($internal_redirects)+count($external_redirects);
	$announcement_bar_active = count($announcement_bar);
		$county_count = count($countries);
		$view_data = [
		    'shop_data'  => $shop_data,
		    'county_count' => $county_count,
		    'announcement_bar_active' => $announcement_bar_active,
		    'total_redirects'=>$total_redirects,
		    'theme_setup' => $theme_setup
		];
     return view('dashboard')->with($view_data);
   
}
}
?>