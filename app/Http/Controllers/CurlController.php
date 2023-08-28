<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
header("Access-Control-Allow-Origin: https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/");

class CurlController extends Controller
{
/**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
  public function curl_get_fun($url,$access_token){
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: application/json",
          "X-Shopify-Access-Token: $access_token"
        ),
      ));

       $response = json_decode(curl_exec($curl), true);
     // $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);
      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
        $response_data = $response;
        return $response_data;
      }
  }
  public function curl_post_fun($url,$access_token,$json_data){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$json_data);  //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = [
        "cache-control: no-cache",
        "content-type: application/json",
        "X-Shopify-Access-Token: $access_token"            
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //$response = json_decode(curl_exec($ch), true);
    $response = curl_exec($ch);
    return $response;
    $err = curl_error($ch);

    curl_close($ch);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else { 
      echo "success";
    }
  }
  public function curl_put_fun($url,$access_token,$json_data){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS,$json_data);  //Post Fields
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers = [
        "cache-control: no-cache",
        "content-type: application/json",
        "X-Shopify-Access-Token: $access_token"            
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    //$response = json_decode(curl_exec($ch), true);
    $response = curl_exec($ch);
    return $response;
    $err = curl_error($ch);

    curl_close($ch);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else { 
      echo "success";
    }
  }
    public function curl_get_fun_products($url,$access_token,$currentpagetoken){
      $curl = curl_init();
      if($currentpagetoken){
      	$url = $url.'&page_info='.preg_replace('/\s+/', '', $currentpagetoken);
      }
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: application/json",
          "X-Shopify-Access-Token: $access_token"
        ),
      ));
      curl_setopt($curl, CURLOPT_HEADER, 1);
      // $response = json_decode(curl_exec($curl), true);
      $response = curl_exec($curl);
      $err = curl_error($curl);
		$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		$header = substr($response, 0, $header_size);
		$products_array = json_decode(substr($response, $header_size), true);
		curl_close($curl);
		$headers = [];
		$output = rtrim($response);
		$data = explode("\n",$output);
		$headers['status'] = $data[0];
		array_shift($data);

foreach($data as $part){

    //some headers will contain ":" character (Location for example), and the part after ":" will be lost, Thanks to @Emanuele
    $middle = explode(":",$part,2);

    //Supress warning message if $middle[1] does not exist, Thanks to @crayons
    if ( !isset($middle[1]) ) { $middle[1] = null; }

    $headers[trim($middle[0])] = trim($middle[1]);
}
$responseHeaders = $headers;
 $tokenType = 'next';
      // print_r($response);
      if(array_key_exists('Link',$responseHeaders)){
          $link = $responseHeaders['Link'];


          $tokenType  = strpos($link,'rel="next') !== false ? "next" : "previous";

          $tobeReplace = ["<",">",'rel="next"',";",'rel="previous"'];
          $tobeReplaceWith = ["","","",""];
          parse_str(parse_url(str_replace($tobeReplace,$tobeReplaceWith,$link),PHP_URL_QUERY),$op);
         
         $nextpageToken = $op['page_info'];
          
       
      }
      
      if(empty($nextpageToken)){
            $nextpageToken = null;
          }
     // echo $pageToken;
// Print all headers as array
// echo "<pre>";
// print_r($headers);
// echo "</pre>";
      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
      	// print_r($products_array['products'][0]);
       //  exit();
      	  $return_data = ['products'   => $products_array['products'],
         'page_token' => $nextpageToken];
        return $return_data;
      }
  }
 //  public function getPaginateProducts($shop,$access_token,$pagetoken){
 //    $products_array = [];
 //    $nextPageToken = "eyJsYXN0X2lkIjo2MDYwMzExODM4ODc0LCJsYXN0X3ZhbHVlIjoiQk9ZIEJMQUNLTUFJTCBTV0VBVFNISVJUIiwiZGlyZWN0aW9uIjoibmV4dCJ9";
 //    // $response = $this->request($shop, $access_token,'get','products.json?limit=250&page_info='.$pagetoken);
 //    // foreach($response['resource'] as $product){
 //    //             array_push($products_array, $product);
 //    // }
 //    // $nextPageToken = $response['next']['page_token'] ?? null;
 //    // print_r($response);
 //    // $return_data = ['products'   => $products_array,
 //    //       'page_token' => $nextPageToken];
 //          $response = $this->request($shop, $access_token,'get','products.json?limit=50&page_info=eyJsYXN0X2lkIjo2MDYwMzExODM4ODc0LCJsYXN0X3ZhbHVlIjoiQk9ZIEJMQUNLTUFJTCBTV0VBVFNISVJUIiwiZGlyZWN0aW9uIjoibmV4dCJ9');
 //        //     do{
 //        //     $response = $this->request($shop, $access_token,'get','products.json?limit=50&page_info='.$nextPageToken);
 //        //     foreach($response['resource'] as $product){
 //        //         array_push($products_array, $product);
 //        //         // echo $product['title'];
 //        //     }
 //        //     echo sizeof($response['resource']);
 //        //     $nextPageToken = $response['next']['page_token'] ?? null;
 //        // }while($nextPageToken != null);

 //    //return $return_data;
 //  }
 //   public function getAllProducts($shop,$access_token)
 //   {
 //        $products_array=[];
 //        $nextPageToken = null;
 //        do{
 //            $response = $this->request($shop, $access_token,'get','products.json?limit=250&page_info='.$nextPageToken);
 //            foreach($response['resource'] as $product){
 //                array_push($products_array, $product);
 //            }
 //            $nextPageToken = $response['next']['page_token'] ?? null;
 //        }while($nextPageToken != null);
 //        return $products_array;
 // }
  public function request($shop,$access_token,$method,$url,$param = []){
      $client = new \GuzzleHttp\Client();
      $url = "https://country-based-pricing.myshopify.com/admin/api/2021-04/products.json?limit=50&page_info=eyJsYXN0X2lkIjo2MDYwMzExODM4ODc0LCJsYXN0X3ZhbHVlIjoiQk9ZIEJMQUNLTUFJTCBTV0VBVFNISVJUIiwiZGlyZWN0aW9uIjoibmV4dCJ9";
      echo $url;
      $parameters = [
          'headers' => [
              'Content-Type' => 'application/json',
              'Accept' => 'application/json',
              "cache-control: no-cache"
          ],
          'query' => [
              'access_token' => $access_token
            ]
      ];
      if(!empty($param)){ $parameters['json'] = $param;}
      $response = $client->request($method, $url,$parameters);
     
      
      $responseHeaders = $response->getHeaders();
      echo json_encode($responseHeaders);
       $responseBody = json_decode($response->getBody(),true);
      print_r($responseBody);
      exit();
      $tokenType = 'next';
      // print_r($response);
      if(array_key_exists('Link',$responseHeaders)){
          $link = $responseHeaders['Link'][0];
          $tokenType  = strpos($link,'rel="next') !== false ? "next" : "previous";
          $tobeReplace = ["<",">",'rel="next"',";",'rel="previous"'];
          $tobeReplaceWith = ["","","",""];
          parse_str(parse_url(str_replace($tobeReplace,$tobeReplaceWith,$link),PHP_URL_QUERY),$op);
          $pageToken = trim($op['page_info']);
          
       
      }
      $rateLimit = explode('/', $responseHeaders["X-Shopify-Shop-Api-Call-Limit"][0]);
      $usedLimitPercentage = (100*$rateLimit[0])/$rateLimit[1];
      if($usedLimitPercentage > 95){sleep(5);}
      $responseBody = json_decode($response->getBody(),true);
      $r['resource'] =  (is_array($responseBody) && count($responseBody) > 0) ? array_shift($responseBody) : $responseBody;
      $r[$tokenType]['page_token'] = isset($pageToken) ? $pageToken : null;
      return $r;
  }
  public function sendProductData($data,$url,$access_token){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($data));  //Post Fields
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      $headers = [
          "cache-control: no-cache",
          "content-type: application/json",
          "X-Shopify-Access-Token: $access_token"
      ];
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      //$response = json_decode(curl_exec($ch), true);
      $response = curl_exec($ch);
      $err = curl_error($ch);
      curl_close($ch);
      return $response;
    }
    public function getCurrencyPricing($shop){
  $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://'.$shop.'/services/javascripts/currencies.js',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "GET"
      ));
      $response = curl_exec($curl);
      //$response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
        echo "cURL Error #:" . $err;
      } else {
      $newString = str_replace(" ","",$response);
      $right_part = explode("=",$newString)[1];
      $final_content = explode("}",$right_part)[0];
      $final_content1 = explode('rates:', $final_content)[1];
      $final_content2 = explode('{', $final_content1)[1];
      $json = '{'.$final_content2.'}';
      $array_data = json_decode($json);
      foreach ($array_data as $key => $value) 
      $array[$key] = $value;
        return $array;
      }
    }
    public function curl_delete_fun($url,$access_token){
      $curl = curl_init();
      curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "DELETE",
        CURLOPT_HTTPHEADER => array(
          "cache-control: no-cache",
          "content-type: application/json",
          "X-Shopify-Access-Token: $access_token"
        ),
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
}