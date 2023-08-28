<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
include 'CurlController.php';
/*include 'SnippetController.php';*/
class AppController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
private $_APP_KEY;
private $_APP_SECRET;

public function __construct(){
    $this->initializeKeys();
}
// shopify Custom app key
protected function initializeKeys() {
        $this->_APP_KEY = '9b970923f8f55e33557d8b385e60c34f';
        $this->_APP_SECRET = '039fce2c638df2bea078c5c73bcc0726';
        $this->table_name = 'shopify_stores';
}



public function index(Request $request)
{
    $curlController = new CurlController();
   // get store url
   $shop = $request->input('shop');
   // get store code
   $code = isset($_GET["code"]) ? $_GET["code"] : false;
   $error = '';
   if($shop && !$code){
        $subject = $shop;
        $pattern = '/^(.*)?(\.myshopify\.com)$/';
        $validateMyShopify = preg_match($pattern, $subject);
        if(!$validateMyShopify){
            $error = "Invalid shop url";
        }else{
            $redirect_url = $this->getAuthUrl($shop);
            echo "<script>window.location.href='$redirect_url';</script>";
           //header("Location: $redirect_url");
        }
    }
    if($code){
        // get access token
        $exchange_token_response = $this->exchangeTempTokenForPermanentToken($shop, $code);
        if(!isset($exchange_token_response->access_token) && isset($exchange_token_response->errors)) {
            // access token is not valid, redirect user to error page
            // echo "<pre>";
            // print_r($exchange_token_response->errors);
            // echo "</pre>";
        }
        $access_token = $exchange_token_response['access_token'];
        // echo $access_token;
        $shop_info = $this->isShopExists($shop);
        //*** Add Default Country *****///
        $shop_url = "https://".$shop."/admin/api/2021-04/shop.json";
        $shop_data = $curlController->curl_get_fun($shop_url,$access_token);
        $country_name = $shop_data['shop']['country_name'];
        $country_row = DB::table("country")->where('country_name',$country_name)->get();
        $country_id = $country_row[0]->country_id;
        $get_country_id = DB::table("country_price_setting")->where('country_id',$country_id)->where('store_url',$shop)->first();
          if(empty($get_country_id)){
              $country_data = array(
                'country_id' => $country_id, 
                'country_status' => 1,
                'country_url' => '', 
                'custom_name' => '',
                'default_country' => 1,
                'intl_currency' => 1,
                'store_url' => $shop
                );
               DB::table('country_price_setting')->insert($country_data);
            }else{
                $country_data = array(
                'country_id' => $country_id,
                'default_country' => 1,
                'intl_currency' => 1,
                'store_url' => $shop
                );
               DB::table('country_price_setting')->where('country_id',$country_id)->where('store_url',$shop)->update($country_data);
            }
        //*** End Add Default Country *****///
        if(empty($shop_info)){
            $data=array(
                "store_url" => $shop,
                "access_key" => $this->_APP_KEY,
                "access_token" => $access_token,
                "created_at" => date("Y-m-d"),
                "pay_chargeId" => '123'
            );
            DB::table('shopify_stores')->insert($data);
               $module_data=array(
                    "store_url" => $shop,
                    "country_price" => 0,
                    "geolocation" => 0,
                    "announcement_bar" => 1,
                    "country_redirection" => 0,
                );
                DB::table('Module')->insert($module_data);
              $shop_charge_id = '123';
        }else{
            DB::update('update shopify_stores set access_token = ? where store_url = ?',[$access_token,$shop]);
                        $module = DB::table("Module")->where('store_url',$shop)->first();
          if(empty($module)){
                $module_data=array(
                    "store_url" => $shop,
                    "country_price" => 0,
                    "geolocation" => 0,
                    "announcement_bar" => 1,
                    "country_redirection" => 0
                );
                DB::table('Module')->insert($module_data);
            }
              $shop_charge_id = $shop_info->pay_chargeId;
        }
        // $redirect_url = 'https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/index.php/dashboard?shop='.$shop;
        // echo "<script>window.location.href='$redirect_url';</script>";
             // first time charge creation 
         

      if($shop_charge_id == '123'){

      $charge_data = json_encode(array(
          'recurring_application_charge' => array(
            'name' => 'Chaos Public App',
            'price' => 19.99,
            'return_url' => 'https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/index.php/shopify_app?shop='.$shop,
            'trial_days' => 15

            )
      ));
      $ch1 = curl_init();
      curl_setopt($ch1, CURLOPT_URL,"https://$shop/admin/api/2021-04/recurring_application_charges.json");
      curl_setopt($ch1, CURLOPT_POSTFIELDS, $charge_data);  //Post Fields
      curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
      $http_headers = array("Content-Type:application/json", "X-Shopify-Access-Token: $access_token");
      curl_setopt($ch1, CURLOPT_HTTPHEADER, $http_headers);
      $charge_get_data = json_decode(curl_exec($ch1), true);
      $err = curl_error($ch1);
      curl_close($ch1);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        $confirmation_url = $charge_get_data['recurring_application_charge']['confirmation_url'];
        $app_id = $charge_get_data['recurring_application_charge']['id'];
        $app_price = $charge_get_data['recurring_application_charge']['price'];
        $app_status = $charge_get_data['recurring_application_charge']['status'];
        $app_created_at = $charge_get_data['recurring_application_charge']['created_at'];
        echo $confirmation_url;
        DB::update('update shopify_stores set pay_amt = ?, pay_status = ?, pay_chargeId = ?, pay_date = ? , confirmation_url = ? where store_url = ?',[$app_price,$app_status,$app_id,$app_created_at,$confirmation_url,$shop]);
               // first time charge creation
        // print_r($charge_get_data);
        echo "<script>top.location.href='$confirmation_url'</script>";
        // header("location:$confirmation_url");
        // return redirect($confirmation_url);
       } 
      } else {
        // get charge data

       $curl_data = curl_init();
       curl_setopt_array($curl_data, array(
       CURLOPT_URL => "https://".$shop."/admin/api/2021-04/recurring_application_charges/$shop_charge_id.json",
       CURLOPT_RETURNTRANSFER => true,
       CURLOPT_CUSTOMREQUEST => "GET",
       CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json",
        "x-shopify-access-token: $access_token"
        ),
       ));
       $get_charge_response = json_decode(curl_exec($curl_data), true);
       // print_r($get_charge_response);
       // echo "<pre>";
       $err = curl_error($curl_data);
       curl_close($curl_data); 
       

       $confimr_store_data = DB::table('shopify_stores')->where('store_url', $shop)->first();
       $old_confirm_url = $confimr_store_data->confirmation_url;
       //  print_r($get_charge_response);
       // // // echo $get_charge_response['status'];
       // exit();
       if($get_charge_response['recurring_application_charge']['status'] == 'active'){
        header("Location: https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/index.php/dashboard?shop=$shop");
        return redirect("https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/index.php/dashboard?shop=$shop");
       } else {
        $updated_confirm_url = str_replace("confirm_recurring_application_charge","request_recurring_application_charge",$old_confirm_url);
         $charge_data = json_encode(array(
          'recurring_application_charge' => array(
            'name' => 'Chaos Public App',
            'price' => 19.99,
            'return_url' => 'https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/index.php/shopify_app?shop='.$shop,
            'trial_days' => 15
            )
      ));
      $ch1 = curl_init();
      curl_setopt($ch1, CURLOPT_URL,"https://$shop/admin/api/2021-04/recurring_application_charges.json");
      curl_setopt($ch1, CURLOPT_POSTFIELDS, $charge_data);  //Post Fields
      curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
      $http_headers = array("Content-Type:application/json", "X-Shopify-Access-Token: $access_token");
      curl_setopt($ch1, CURLOPT_HTTPHEADER, $http_headers);
      $charge_get_data = json_decode(curl_exec($ch1), true);
      $err = curl_error($ch1);
      curl_close($ch1);
       if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        $confirmation_url = $charge_get_data['recurring_application_charge']['confirmation_url'];
        $app_id = $charge_get_data['recurring_application_charge']['id'];
        $app_price = $charge_get_data['recurring_application_charge']['price'];
        $app_status = $charge_get_data['recurring_application_charge']['status'];
        $app_created_at = $charge_get_data['recurring_application_charge']['created_at'];
        echo $confirmation_url;
        DB::update('update shopify_stores set pay_chargeId = ?, pay_amt = ?, pay_status = ?, pay_chargeId = ?, pay_date = ? , confirmation_url = ? where store_url = ?',[$app_id,$app_price,$app_status,$app_id,$app_created_at,$confirmation_url,$shop]);
               // first time charge creation
        // print_r($charge_get_data);
        echo "<script>top.location.href='$confirmation_url'</script>";
        // header("location:$confirmation_url");
        // return redirect($confirmation_url);
       }
      
       // return redirect($updated_confirm_url);
        
        echo "<script src='https://cdn.shopify.com/s/assets/external/app.js'></script>";
        echo "
		<script>
		var getUrlParameter = function getUrlParameter(sParam) {
		  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
		      sURLVariables = sPageURL.split('&'),
		      sParameterName,
		      i;

		  for (i = 0; i < sURLVariables.length; i++) {
		      sParameterName = sURLVariables[i].split('=');

		      if (sParameterName[0] === sParam) {
		          return sParameterName[1] === undefined ? true : sParameterName[1];
		      }
		  }
		};
		var shop_url = getUrlParameter('shop');
		ShopifyApp.init({
		apiKey: '1486a742bfecfdaf900157d7b6585eeb',
		shopOrigin:'https://'+shop_url
		});
		const permissionUrl = `$updated_confirm_url`;
		if (window.top == window.self) {
		window.location.assign(permissionUrl);
		} else {
		ShopifyApp.redirect(permissionUrl);
		}
		</script>";

		    //echo "<script>window.location.href = '$updated_confirm_url';</script>";
		   }
      }
    }
   return view('welcome', ["error"=>$error]);
}





// generate store link
public function getAuthUrl($shop, $scope = null){
    $scopes = "read_themes, write_themes,read_products,write_products,read_content,write_content,write_script_tags,read_shopify_payments_payouts";
    //print_r($scopes);
    //echo SHOPIFY_API_KEY;
    return 'https://'. $shop.'/admin/oauth/authorize?'
            . 'scope=' . $scopes
            . '&client_id=' . $this->_APP_KEY
            . '&redirect_uri=' . 'https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/';
}

// generate Token
public function exchangeTempTokenForPermanentToken($shop, $TempCode) {            
    // encode the data
    $data = json_encode(array("client_id" => $this->_APP_KEY, "client_secret" => $this->_APP_SECRET, "code" => $TempCode));      

    // the curl url
    $curl_url = "https://$shop/admin/oauth/access_token";
    // set curl options
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $curl_url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // execute curl
    $response = json_decode(curl_exec($ch), true);

    // close curl
    curl_close($ch);
    return $response;
}


// Select data
public function isShopExists($shop){
    $store_data = DB::table('shopify_stores')->where('store_url', $shop)->first();
    // print_r($store_data);
    //$store_data = DB::select('select * from shopify_stores where store_url = ?',[$shop]);
    return $store_data;
}
public function shopify_app_data(Request $request){
  $curlController = new CurlController();
   $shop = $_REQUEST['shop'];
    $shop_info = $this->isShopExists($shop);
    $access_token = $shop_info->access_token; 
    $shopurl = "https://".$shop."/admin/api/2021-04/shop.json";
    $shop_data = $curlController->curl_get_fun($shopurl,$access_token);
    $customer_email = $shop_data['shop']['customer_email'];
    $uninstall_webhook = json_encode(array (
      'webhook' =>
      array (
        'topic' => 'app/uninstalled',
        'address' => 'https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/index.php/uninstall?shop='.$shop,
        'format' => 'json',
      ),
    ));
    $create_uninstall_webhook = $this->create_webhook($shop,$access_token,$uninstall_webhook);
   if(isset($_REQUEST['charge_id'])){

$charge_id = $_REQUEST['charge_id'];
      // get charge single data
    $curl_data = curl_init();
    curl_setopt_array($curl_data, array(
      CURLOPT_URL => "https://".$shop."/admin/api/2021-04/recurring_application_charges/$charge_id.json",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json",
        "x-shopify-access-token: $access_token"
      ),
    ));
    $get_charge_response = json_decode(curl_exec($curl_data), true);
    // echo "<pre>";
    $err = curl_error($curl_data);
    curl_close($curl_data);

    $app_id = $get_charge_response['recurring_application_charge']['id'];
    $app_name = $get_charge_response['recurring_application_charge']['name'];
    $api_client_id = $get_charge_response['recurring_application_charge']['api_client_id'];
    $app_price = $get_charge_response['recurring_application_charge']['price'];
    $app_status = $get_charge_response['recurring_application_charge']['status'];
    $app_return_url = $get_charge_response['recurring_application_charge']['return_url'];
    $app_billing_on = $get_charge_response['recurring_application_charge']['billing_on'];
    $app_test = $get_charge_response['recurring_application_charge']['test'];
    $app_created_at = $get_charge_response['recurring_application_charge']['created_at'];
    $app_updated_at = $get_charge_response['recurring_application_charge']['updated_at'];
    $app_activated_on = $get_charge_response['recurring_application_charge']['activated_on'];
    $app_cancelled_on = $get_charge_response['recurring_application_charge']['cancelled_on'];
    $app_trial_days = $get_charge_response['recurring_application_charge']['trial_days'];
    $app_trial_ends_on = $get_charge_response['recurring_application_charge']['trial_ends_on'];
    $decorated_return_url = $get_charge_response['recurring_application_charge']['decorated_return_url'];

    

    $single_charge_data = json_encode(array(
          'application_charge' => array(
            'id' => $app_id,
            'name' => $app_name,
            'api_client_id' => $api_client_id,
            'price' => $app_price,
            'status' => $app_status,
            'return_url' =>$app_return_url,
            'test' => $app_test,
            'created_at' => $app_created_at,
            'updated_at' => $app_updated_at,
            'activated_on' => $app_activated_on,
            'cancelled_on' => $app_cancelled_on,
            'trial_days' => $app_trial_days,
            'trial_ends_on' => $app_trial_ends_on,
            'decorated_return_url' => $decorated_return_url
            )
      ));
      $ch1 = curl_init();
      curl_setopt($ch1, CURLOPT_URL,"https://$shop/admin/api/2021-04/recurring_application_charges/$app_id/activate.json");
      curl_setopt($ch1, CURLOPT_POSTFIELDS, $single_charge_data);  //Post Fields
      curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);

      $http_headers = array("Content-Type:application/json", "X-Shopify-Access-Token: $access_token");

      curl_setopt($ch1, CURLOPT_HTTPHEADER, $http_headers);

      $charge_get_data = json_decode(curl_exec($ch1), true);
       

      //$response = curl_exec($curl);
      $err = curl_error($ch1);

      curl_close($ch1);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {

    $app_id = $charge_get_data['recurring_application_charge']['id'];
    $app_name = $charge_get_data['recurring_application_charge']['name'];
    $api_client_id = $charge_get_data['recurring_application_charge']['api_client_id'];
    $app_price = $charge_get_data['recurring_application_charge']['price'];
    $app_status = $charge_get_data['recurring_application_charge']['status'];
    $app_return_url = $charge_get_data['recurring_application_charge']['return_url'];
    $app_billing_on = $charge_get_data['recurring_application_charge']['billing_on'];
    $app_test = $charge_get_data['recurring_application_charge']['test'];
    $app_created_at = $charge_get_data['recurring_application_charge']['created_at'];
    $app_updated_at = $charge_get_data['recurring_application_charge']['updated_at'];
    $app_activated_on = $charge_get_data['recurring_application_charge']['activated_on'];
    $app_cancelled_on = $charge_get_data['recurring_application_charge']['cancelled_on'];
    $app_trial_days = $charge_get_data['recurring_application_charge']['trial_days'];
    $app_trial_ends_on = $charge_get_data['recurring_application_charge']['trial_ends_on'];
    $decorated_return_url = $charge_get_data['recurring_application_charge']['decorated_return_url'];
        DB::update('update shopify_stores set pay_amt = ?, pay_status = ?, pay_chargeId = ?, pay_date = ?,  billing_on_date = ?,trial_ends_on = ? where store_url = ?',[$app_price,$app_status,$app_id,$app_created_at,$app_billing_on,$app_trial_ends_on,$shop]);
        if($app_status == 'active'){
        	return redirect("https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/index.php/dashboard?shop=$shop");
        }
        else{
        	echo "<script>top.location.href='$confirmation_url'</script>";
        	// return redirect($app_return_url);
        }
      }
   }
}

public function customer_data_request(){
  $webhook_payload = file_get_contents('php://input');
  $webhook_payload = json_encode($webhook_payload,true);
  $shop_id = $webhook_payload['shop_id'];
  $shop_domain = $webhook_payload['shop_domain'];
  $customer_id = $webhook_payload['customer']['id'];
}
public function shop_redact(){
  $webhook_payload = file_get_contents('php://input');
  $webhook_payload = json_encode($webhook_payload,true);
  $shop_id = $webhook_payload['shop_id'];
  $shop_domain = $webhook_payload['shop_domain'];
}

public function create_webhook($shop,$access_token,$data){
      $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://".$shop."/admin/api/2021-04/webhooks.json");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = [
        "content-type: application/json",
        "x-shopify-access-token: $access_token",
        "cache-control: no-cache"            
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = json_decode(curl_exec($ch), true);
    return $response;
    $err = curl_error($ch);
    curl_close($ch);
    if ($err) {
      echo "cURL Error #:" . $err;
    }else{

    }   
}
public function getModule(Request $request){
    header('Access-Control-Allow-Origin:  *');
    header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
    header('Access-Control-Allow-Methods: GET, POST, PUT');
    $shop = $request->shop;
    $module = DB::table("Module")->where('store_url',$shop)->first();
    echo json_encode($module);
}

}