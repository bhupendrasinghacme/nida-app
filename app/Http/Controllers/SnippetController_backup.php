<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class SnippetController extends Controller
{
 
 public function createShopSnippet($shop,$store_id,$theme_id,$access_token){
 	$appController = new AppController();
 	$shop_theme_id = $theme_id;
 	$shopify_domain = $shop;
 	$shop_info = $appController->isShopExists($shopify_domain);
  $shopify_user = DB::table('shopify_user_cred')->where('store_id', $store_id)->first();
  $value =  '{% assign store_url_data  = shop.url  | replace: "https://", ""  %}<script src="https://code.jquery.com/jquery-1.12.4.js"></script>';
	$value .= '<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	          <script src="https://www.gstatic.com/firebasejs/5.5.0/firebase-app.js"></script>
	 		  <script data-shop_url="{{ shop.url  | replace: "https://", ""  }}" src="https://shopify.cronberry.com/firebase-messaging.js"></script>
			  <script src="https://www.gstatic.com/firebasejs/3.5.2/firebase-auth.js"></script>
			  <script src="https://www.gstatic.com/firebasejs/3.5.2/firebase-database.js"></script>';
	$value .= '<script type="text/javascript">
    // Please use your own firebaseConfig provided by firebase for your site.
    var firebaseConfig = {';
      $value .= "apiKey: '".$shopify_user->fb_apikey ."',\r\n";
      $value .= "authDomain: '".$shopify_user->fb_authDomain."',\r\n";
      $value .= "databaseURL: '".$shopify_user->fb_databaseURL."',\r\n";
      $value .= "projectId: '".$shopify_user->fb_projectId."',\r\n";
      $value .= "storageBucket: '".$shopify_user->fb_storageBucket."',\r\n";
      $value .= "messagingSenderId: '".$shopify_user->fb_messagingSenderId."',\r\n";
      $value .= "appId: '".$shopify_user->fb_appId."',\r\n";
      $value .= "measurementId: '".$shopify_user->fb_measurementId."'\r\n";
    $value .= '};';
    $value .= 'firebase.initializeApp(firebaseConfig);';
    $value .= 'const messaging = firebase.messaging();';
    $value .=  "var this_js_script = $('script[src=\"https://shopify.cronberry.com/firebase-messaging.js\"]'); // or better regexp to get the file name..

var shop_url = this_js_script.attr('data-shop_url'); 
navigator.serviceWorker.register('/apps/sw/'+shop_url+'/firebase-messaging-sw.js')
.then((registration) => {
  messaging.useServiceWorker(registration);
  // Request permission and get token.....
});";
$value .= "if(current_token == 'null'){
   Notification.requestPermission().then((permission) => {if (permission === 'granted') 
           {
             console.log('Notification permission granted.');      
            if(isTokenSentToServer()){
            console.log('Token already sent ');
           }else{getRegisteredToken();
            }
          } else {console.log('Unable to get permission to notify.');
          }
        });
   }else{
    $.ajax({
      type: 'POST',
      url: 'https://shopify.cronberry.com/get_shopify_fcmtoken?currentToken='+current_token+'&customer_id={{customer.id}}&store_url={{ store_url_data }}', 
    success: function(response){
      if(response == 'empty_token'){
            Notification.requestPermission().then((permission) => {if (permission === 'granted') 
           {
             console.log('Notification permission granted.');      
            re_getRegisteredToken();
          } else {console.log('Unable to get permission to notify.');
          }
        });
       }else{
             Notification.requestPermission().then((permission) => {if (permission === 'granted') 
           {
             console.log('Notification permission granted.');      
            if(isTokenSentToServer()){
            console.log('Token already sent ');
           }else{getRegisteredToken();
            }
          } else {console.log('Unable to get permission to notify.');
          }
        });
         
    }
    }});
   }"."\r\n";
    $value .= "function getRegisteredToken() {
      messaging.getToken().then((currentToken) => {
        if (currentToken) {
          saveToken(currentToken);  
          sendTokenToServer(currentToken); 
          //updateUIForPushEnabled(currentToken);
        } else {
          console.log('No Instance ID token available. Request permission to generate one.');
          //updateUIForPushPermissionRequired();
          setTokenSentToServer(false); 
        }
      }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        setTokenSentToServer(false); 
      });

    }
    function re_getRegisteredToken() {
      messaging.getToken().then((currentToken) => {
        if (currentToken) {
          saveToken(currentToken);  
          //sendTokenToServer(currentToken);
          shopify_fcmtoken(currentToken);
          //updateUIForPushEnabled(currentToken);
        } else {
          console.log('No Instance ID token available. Request permission to generate one.');
          //updateUIForPushPermissionRequired();
          setTokenSentToServer(false); 
        }
      }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        setTokenSentToServer(false); 
      });

    }
    function sendTokenToServer(currentToken) {
      if (!isTokenSentToServer()) {
        console.log('Sending token to server...');
        setTokenSentToServer(true);
      } else {
        console.log('Token already sent to server so won\'t send it again ' +
                    'unless it changes');
      }
    }

    function setTokenSentToServer(sent) {
      window.localStorage.setItem('sentToServer', sent ? '1' : '0');
    }

    function isTokenSentToServer() {
      return window.localStorage.getItem('sentToServer') === '1';
    }

    function getToken(currentToken) {

      return currentToken;
    }
    </script>
    {% if customer %}
<script type='text/javascript'>";

   $value .= 'function saveToken(currentToken) {
      $.ajax({
        type: "POST",
        url: "https://api.dev.cronberry.com/cronberry/api/campaign/register-audience-data",
        dataType: "json",';
   $value .=    "headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },";
    $value .=  'data:JSON.stringify({'."\r\n";
          $value .= 'projectKey: "'.$shopify_user->project_key.'",'."\r\n";
          $value .= 'audienceId: "{{customer.id}}",
          web_fcm_token:currentToken  
          //If you do not have audience id
          //Ex. Before login case than send any unique value here like current timestamp/epoch(new Date().getTime())time 
        }),
        success: function (data) {
          console.log("success");
          console.log(data);
          localStorage.setItem("current_token", currentToken);
        },
        error: function () {
          console.log("error");
        }
      });
    }
    var current_token = localStorage.getItem("current_token");';
    $value .= "function shopify_fcmtoken(currentToken){
    $.ajax({
      type: 'POST',
      url: 'https://shopify.cronberry.com/shopify_fcmtoken?currentToken='+currentToken+'&customer_id={{customer.id}}&store_url={{ store_url_data }}', 
    success: function(result){
        console.log(result);
    }});
  }";

  $value .= '</script>{% endif %}'."\r\n";
  $value .="<script>
        var d = new Date();
        var month = d.getMonth()+1;
        var day = d.getDate();
        var current_date = (day<10 ? '0' : '') + day + '-' +
            (month<10 ? '0' : '') + month + '-' +
            d.getFullYear();
        </script>"."\r\n";
  $value .='{% if template == "index" %}{% if customer %}'."\r\n";
   $value .=   '<script type="text/javascript">';
   $value .= ' var access_token = "'.$access_token; 
   $value .= '";';
   $value .= ' var project_key = "'.$shopify_user->project_key; 
   $value .= '";';
   $value .= ' var shopify_domain = "'.$shopify_domain; 
   $value .= '";';
   $value .=  ' var settings = {
  "async": true,
  "crossDomain": true,
  "url": "https://"+shopify_domain+"/admin/customers.json",
  "method": "GET",
  "headers": {
    "content-type": "application/json",
    "x-shopify-access-token": access_token,
    "cache-control": "no-cache",
  }
}

$.ajax(settings).done(function (response) {
 var customer_data = response["customers"][0]; 
  var $stockData = new Array();
  $.each(customer_data, function(key, value) {
   if(value != null && key != "addresses" && key != "default_address"){
     $stockData.push({ paramKey : key, paramValue : value });
    }
  });
  if(customer_data["addresses"][0]){
    $.each(customer_data["addresses"][0], function(key1, value1) {
     if(value1 != null){
       $stockData.push({ paramKey : key1, paramValue : value1 });
      }
    });
  }
 $.ajax({
        type: "POST",
        url: "https://api.dev.cronberry.com/cronberry/api/campaign/register-audience-data",
        dataType: "json",
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json",
          "authorization": "Basic Y3JvbmJlcnJ5QHVzZXJuYW1lOmNyb25iZXJyeUBwYXNzd29yZA==",
        },data:JSON.stringify({
            "projectKey":project_key,
            "audienceId":"{{customer.id}}",
            "name":"{{customer.name}}",
            "email":"{{customer.email}}",
            "web_fcm_token":current_token,
            "last_active" :current_date,
            "phone_no":"{{customer.phone}}",
            "source":"shopify",
            "paramList":$stockData
        }),
        success: function (data) {
          console.log("success");
          console.log(data);
        },
        error: function () {
          console.log("error");
        }
      });
});';
       $value .= '</script>
  {% endif %}{% endif %}';
  $value .= '{% if template == "product" %} 
{% if customer %}
<script type="text/javascript">';
   $value .= ' var project_key = "'.$shopify_user->project_key; 
   $value .= '";';
  $value .= '$.ajax({
        type: "POST",
        url: "https://api.dev.cronberry.com/cronberry/api/campaign/register-audience-data",
        dataType: "json",
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json",
          "authorization": "Basic Y3JvbmJlcnJ5QHVzZXJuYW1lOmNyb25iZXJyeUBwYXNzd29yZA==",
        },data:JSON.stringify({
          "projectKey":project_key,
            "audienceId":"{{customer.id}}",
            "name":"{{customer.name}}",
            "email":"{{customer.email}}",
            "web_fcm_token":current_token,
            "last_active" :current_date,
            "phone_no":"{{customer.phone}}",
            "source":"shopify",
            "paramList":[
              {
                  "paramKey": "product",
                  "paramValue": "product"
              }
          ]
        }),
        success: function (data) {
          console.log("success");
          console.log(data);
        },
        error: function () {
          console.log("error");
        }
      });
  </script>
{% endif %}
{% endif %}';
$value .= '{% if template == "cart" %} 
{% if customer %}
<script type="text/javascript">';
   $value .= ' var project_key = "'.$shopify_user->project_key; 
   $value .= '";';
  $value .= '$.ajax({
        type: "POST",
        url: "https://api.dev.cronberry.com/cronberry/api/campaign/register-audience-data",
        dataType: "json",
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json",
          "authorization": "Basic Y3JvbmJlcnJ5QHVzZXJuYW1lOmNyb25iZXJyeUBwYXNzd29yZA==",
        },data:JSON.stringify({
          "projectKey":project_key,
            "audienceId":"{{customer.id}}",
            "name":"{{customer.name}}",
            "email":"{{customer.email}}",
            "web_fcm_token":current_token,
            "last_active" :current_date,
            "phone_no":"{{customer.phone}}",
            "source":"shopify",
            "paramList":[
              {
                  "paramKey": "cart",
                  "paramValue": "cart"
              }
          ]
        }),
        success: function (data) {
          console.log("success");
          console.log(data);
        },
        error: function () {
          console.log("error");
        }
      });
  </script>
{% endif %}
{% endif %}';
$value .= '{% if template == "customers/account" %} 
{% if customer %}
<script type="text/javascript">';
   $value .= ' var project_key = "'.$shopify_user->project_key; 
   $value .= '";';
  $value .= '$.ajax({
        type: "POST",
        url: "https://api.dev.cronberry.com/cronberry/api/campaign/register-audience-data",
        dataType: "json",
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json",
          "authorization": "Basic Y3JvbmJlcnJ5QHVzZXJuYW1lOmNyb25iZXJyeUBwYXNzd29yZA==",
        },data:JSON.stringify({
          "projectKey":project_key,
            "audienceId":"{{customer.id}}",
            "name":"{{customer.name}}",
            "email":"{{customer.email}}",
            "web_fcm_token":current_token,
            "last_active" :current_date,
            "phone_no":"{{customer.phone}}",
            "source":"shopify",
            "paramList":[
              {
                  "paramKey": "account",
                  "paramValue": "account"
              }
          ]
        }),
        success: function (data) {
          console.log("success");
          console.log(data);
        },
        error: function () {
          console.log("error");
        }
      });
  </script>
{% endif %}
{% endif %}';
$value .= '{% if template == "customers/order" %} 
{% if customer %}
<script type="text/javascript">';
   $value .= ' var project_key = "'.$shopify_user->project_key; 
   $value .= '";';
  $value .= '$.ajax({
        type: "POST",
        url: "https://api.dev.cronberry.com/cronberry/api/campaign/register-audience-data",
        dataType: "json",
        headers: {
          "Accept": "application/json",
          "Content-Type": "application/json",
          "authorization": "Basic Y3JvbmJlcnJ5QHVzZXJuYW1lOmNyb25iZXJyeUBwYXNzd29yZA==",
        },data:JSON.stringify({
          "projectKey":project_key,
            "audienceId":"{{customer.id}}",
            "name":"{{customer.name}}",
            "email":"{{customer.email}}",
            "web_fcm_token":current_token,
            "last_active" :current_date,
            "phone_no":"{{customer.phone}}",
            "source":"shopify",
            "paramList":[
              {
                  "paramKey": "order_history",
                  "paramValue": "order_history"
              }
          ]
        }),
        success: function (data) {
          console.log("success");
          console.log(data);
        },
        error: function () {
          console.log("error");
        }
      });
  </script>
{% endif %}
{% endif %}';
  $snippet_data = json_encode(array('asset' => array(
        'key' => "snippets/firebase_code.liquid",
        'value' => $value
   )));
  $filename =  'snippets/firebase_code.liquid';
  $get_files = $this->getshopify_assest($shopify_domain, $access_token, $shop_theme_id, $filename);
  $theme_liquid = 'layout/theme.liquid';
  $theme_file = $this->getshopify_assest($shopify_domain, $access_token, $shop_theme_id, $theme_liquid);
  /// Inapp snippet code fun
  $Inapp = $this->create_inappfun($shop_theme_id,$shopify_domain,$access_token,$shopify_user->project_key);
  if(empty($get_files)){
    $result = $this->createSnippet($shopify_domain,$access_token,$snippet_data,$shop_theme_id); 
    $msg =  'Files has been created';
  }else{
    $msg = 'File has been already created';
  }

  if(isset($theme_file['asset'])){
        $theme_backup_file = $this->getshopify_assest($shopify_domain, $access_token, $shop_theme_id, "layout/theme-backup.liquid");
        if(empty($theme_backup_file)){
            $create_backup_file = json_encode(array("asset" => array("key" => "layout/theme-backup.liquid",
                "value" => $theme_file['asset']['value'])), JSON_UNESCAPED_SLASHES);
            $this->saveBackUpTemplate($shopify_domain,$shop_theme_id, $create_backup_file, $access_token);
        }
        if(isset($create_backup_file)){
          $insert_string = '{% include "firebase_code" %}';
          $final_template_value = $this->insertString($theme_file['asset']['value'], "</head>", $insert_string);
          //echo "<pre>"; print_r($final_template_value); exit;
          $insert_string_app = '{% include "inapp_code" %}';
          $final_template_value_2 = $this->insertString_app($final_template_value, "</body>", $insert_string_app);
          
          if(!$final_template_value){
              $final_template_value = $this->insertString($theme_file['asset']['value'], "</head>", $insert_string);
          }
          if($final_template_value) {
              $final_key = $this->insertString($theme_file['asset']['key'], "layout", "-copy");
              if($final_key){
                  $data = json_encode(array("asset" => array("key" => $final_key,
                      "value" => $theme_file['asset']['value'])), JSON_UNESCAPED_SLASHES);      
                  $this->saveBackUpTemplate($shopify_domain,$shop_theme_id, $data, $access_token);
              }  
              $data = json_encode(array("asset" => array("key" => $theme_file['asset']['key'],
                  "value" => $final_template_value)), JSON_UNESCAPED_SLASHES);
              $this->saveBackUpTemplate($shopify_domain,$shop_theme_id, $data, $access_token);
          }
          if($final_template_value_2) {
              $data_2 = json_encode(array("asset" => array("key" => $theme_file['asset']['key'],
                  "value" => $final_template_value_2)), JSON_UNESCAPED_SLASHES);
              $result = $this->saveBackUpTemplate($shopify_domain,$shop_theme_id, $data_2, $access_token);
          }
      }
      //return redirect('/shopify_app?shop='.$shopify_domain.'&msg='.$msg);
  }
    
 }
 function saveBackUpTemplate($shopify_domain,$shop_theme_id, $data, $access_token){
     $result = $this->updateTemplate($shop_theme_id,$data,$shopify_domain,$access_token);
}
   public function updateTemplate($theme_id, $data, $shop, $access_token){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://".$shop."/admin/themes/$theme_id/assets.json",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "PUT",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "X-Shopify-Access-Token: $access_token"
          ),
          CURLOPT_POSTFIELDS => $data
        ));
        $response = json_decode(curl_exec($curl), true);
        //$response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $response_data = $response;
          return $response_data;
        }
  }
 function createSnippet($shop, $access_token, $snippet_data, $theme_id){
  	    $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://".$shop."/admin/themes/$theme_id/assets.json",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "PUT",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "X-Shopify-Access-Token: $access_token"
          ),
          CURLOPT_POSTFIELDS => $snippet_data
        ));
        $response = json_decode(curl_exec($curl), true);
        //$response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $response_data = $response;
          return $response_data;
        }
    }
    public function getshopify_assest($shop, $access_token, $theme_id, $filename){
      $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://".$shop."/admin/themes/$theme_id/assets.json?asset[key]=".$filename,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "content-type: application/json",
            "X-Shopify-Access-Token: $access_token"
          )
        ));
        $response = json_decode(curl_exec($curl), true);
        //$response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          return $response;
        }
    }
    function insertString($mainString, $afterString, $insert_string){
      $var = strpos($mainString, $afterString ) + strlen($afterString);
      $var_count = $var - 7; 
      if( strpos($mainString, $afterString) != false ) {
          if(strpos($mainString, "firebase_code") == false){
              $newstr = substr_replace($mainString, $insert_string, $var_count, 0);
              return $newstr;
          }
          else {
              return false;
          }
       }
       else {
          return false;
      }
   }
   function insertString_app($mainString, $afterString, $insert_string){
      $var = strpos($mainString, $afterString ) + strlen($afterString);
      $var_count = $var - 7; 
      if( strpos($mainString, $afterString) != false ) {
          if(strpos($mainString, "inapp_code") == false){
              $newstr = substr_replace($mainString, $insert_string, $var_count, 0);
              return $newstr;
          }
          else {
              return false;
          }
       }
       else {
          return false;
      }
   }
   function create_inappfun($shop_theme_id,$shopify_domain,$access_token,$project_key){
    $snippet_val = '<style>
/* The Modal (background) */
.notify_modal_class {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 9999; /* Sit on top */
 
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
  .notify_modal-content {
    background-color: #fefefe;
    margin-left: auto;
    border: 1px solid #888;
    max-width: 450px;
  }

/* The Close Button */
  .close {
    color: #efefef;
    font-size: 20px;
    font-weight: bold;
    background-color: #000;
    width: 18px;
    height: 18px;
    line-height: 18px;
    border-radius: 100%;
    text-align: center;
  }

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
/* modal btn css */
  
  button#myBtn {
    position: fixed;
    z-index: 999;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    -webkit-box-shadow: -2px 8px 28px -6px rgba(0,0,0,0.75);
    -moz-box-shadow: -2px 8px 28px -6px rgba(0,0,0,0.75);
    box-shadow: -2px 8px 28px -6px rgba(0,0,0,0.75);
    background-color: #000;
    font-size: 20px;
  }
  .bell_icon {
    position: absolute;
    top: 8px;
    right: 11px;
    font-size: 15px;
    background-color: red;
    width: 11px;
    height: 11px;
    line-height: 11px;
    border-radius: 50%;
    font-size: 10px;
  }
  button#myBtn img {
    max-width: 18px;
    display: flex; 
    align-items: center;
  }
  .title-box .title {
    margin-top: 10px;
    margin-bottom: 10px;
    font-size: 16px;
  }
  .preview-inner {
    padding: 0 18px 18px;
    border-bottom: 1px solid #eee;
    margin: 18px 0;
  }
  .description-box .inner {
/*     margin-bottom: 10px; */
    line-height: normal;
    font-size: 15px;
  }
  .buttons.check_data {
    margin-top: 10px;
}
  img {
    display: block;
  }
  .notification {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #eee;
    padding:10px 18px;
    margin-bottom: 10px;
  }
  .notification.sticky {
    position: fixed;
    top: 0;
    z-index: 999;
    max-width: 450px;
    width: 100%;
  }
  .check_data .btn {
    font-size: 11px;
    text-transform: capitalize;
    padding: 5px 12px;
  }
  .notification-info {
    font-weight: 600;
    font-size: 15px;
}
</style>
{% if customer %}
<!-- Trigger/Open The Modal -->
<button id="myBtn" class="btn"><img src ="https://shopify.cronberry.com/bell.png">
</button>
{% endif %}

<!-- The Modal -->
<div id="notify_modal" class="notify_modal_class">

  <!-- Modal content -->
  <div class="notify_modal-content">
    <div class="notification"><div class="notification-info">Notification</div>
    <div class="close">&times;</div></div>
    <div class="notify_div"></div>
  </div>

</div>
<script type="text/javascript">
  $.ajax({
        type: "POST",
        url: "https://api.dev.cronberry.com/cronberry/api/campaign/fetch-inapp-notifications-list",
        dataType: "json",
        headers: {
          "Accept": "application/json",'."\r\n";
$snippet_val .= '"api-key":"'.$project_key .'",'."\r\n";
          $snippet_val .= '"Content-Type": "application/json",
          "authorization": "Basic Y3JvbmJlcnJ5QHVzZXJuYW1lOmNyb25iZXJyeUBwYXNzd29yZA==",
        },
      data:JSON.stringify({
          "audienceId":"{{customer.id}}",
          "page":0,
          "limit":50
        }),
        success: function (response) {
          var inapp_code = response["data"];
          var unread_nty = inapp_code.totalElements;
          jQuery("#myBtn").append("<span class=\'bell_icon\'>"+unread_nty+"</span>");
          if(response.error_msgs){
            jQuery(".notify_div").append("<h3>Data not Available</h3>");
        }
        else{
           $.each(inapp_code["data"], function(key, value) {
              jQuery(".notify_div").append("<div class=\'preview\'>"+
                                          "<div class=\'preview-inner\'>"+
                                          "<div>"+
                                              "<img src=\'"+value.image+"\'>"+                
                                          "</div>"+
                                          "<div class=\'title-box\'>"+
                                              "<h3 class=\'title\'>"+value.title+"</h3>"+
                                          "</div>"+
                                          "<div class=\'description-box\'>"+
                                              "<div class=\'inner\'>"+value.content+"</div>"+
                        "<div class=\'buttons check_data\' "data-inappCampaignId=\'"+value.userCampaignId+"\'>"+
                        "<a style=\'background:"+value.buttonColor+"\' class=\'btn btn-primary\'"+
                         "href=\'"+value.buttonLink+"\' target=\'_blank\'>"+value.buttonName+"</a>"+
                                              "</div>"+
                                          "</div>"+
                                      "</div>"+
                                  "</div>");
           });
        }
        },
        error: function () {
          console.log("error");
        }
      });
</script>
<script type="text/javascript">
// Get the modal
var modal = document.getElementById("notify_modal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
<script type="text/javascript">
  setTimeout(function(){  
  $(".buttons.check_data").each(function(index) {
    var button_name = $(this).children().text();
      if(button_name == ""){
         $(this).hide();
    }
    $(this).click(function(){
      var inappcampaignid = $(this).attr("data-inappcampaignid");
      $.ajax({
          type: "POST",
          url: "https://api.dev.cronberry.com/cronberry/api/campaign/readmore-inapp",
          dataType: "json",
          headers: {'."\r\n";
          $snippet_val .= '"api-key":"'.$project_key .'",'."\r\n";
          $snippet_val .='Content-Type": "application/json",
          "authorization": "Basic Y3JvbmJlcnJ5QHVzZXJuYW1lOmNyb25iZXJyeUBwYXNzd29yZA=="
          },
         data:JSON.stringify({
            "audienceId":"{{customer.id}}",
            "inappCampaignId":inappcampaignid
          }),
          success: function (response) {
            console.log("success");
          },
          error: function () {
            console.log("error");
          }
        });
  });
 });
}, 2000);
 $("#notify_modal").scroll(function(){
  if ($("#notify_modal").scrollTop() >= 10) {
    $(".notification").addClass("sticky");
   }
   else {
    $(".notification").removeClass("sticky");
   }
});
</script>';
      $snippet = json_encode(array('asset' => array(
          'key' => "snippets/inapp_code.liquid",
          'value' => $snippet_val
     )));
      $result = $this->createSnippet($shopify_domain,$access_token,$snippet,$shop_theme_id);
   }
}