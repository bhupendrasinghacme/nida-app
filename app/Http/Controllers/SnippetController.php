<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class SnippetController extends Controller
{
 
 public function createShopSnippet($shop,$store_id,$theme_id,$access_token){
 	
    
 }
 function saveBackUpTemplate($shopify_domain,$shop_theme_id, $data, $access_token){
     $result = $this->updateTemplate($shop_theme_id,$data,$shopify_domain,$access_token);
}
   public function updateTemplate($theme_id, $data, $shop, $access_token){
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://".$shop."/admin/api/2021-04/themes/$theme_id/assets.json",
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
          CURLOPT_URL => "https://".$shop."/admin/api/2021-04/themes/$theme_id/assets.json",
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
          CURLOPT_URL => "https://".$shop."/admin/api/2021-04/themes/$theme_id/assets.json?asset[key]=".$filename,
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
    function insertString_analytics($mainString, $afterString, $insert_string){
      $var = strpos($mainString, $afterString ) + strlen($afterString);
      $var_count = $var - 7; 
      if( strpos($mainString, $afterString) != false ) {
          if(strpos($mainString, "chaos_analytics") == false){
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
    function insertString($mainString, $afterString, $insert_string){
      $var = strpos($mainString, $afterString ) + strlen($afterString);
      $var_count = $var - 7; 
      if( strpos($mainString, $afterString) != false ) {
          if(strpos($mainString, "chaos_common") == false){
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
   function insertString_annoucment($mainString, $afterString, $insert_string){
      $var = strpos($mainString, $afterString ) + strlen($afterString);
      $var_count = $var - 22; 
      if( strpos($mainString, $afterString) != false ) {
          if(strpos($mainString, "<div id='announcement_bar_div'></div>") == false){
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
  }