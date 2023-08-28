<?php
 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
header("Access-Control-Allow-Origin: *");
include 'AppController.php';
include 'CurlController.php';

class Country_Price_Setting_Controller extends Controller
{ 
	public $conversion_price_data;

	public function __construct(){
		$curlController = new CurlController();
		 $shop = $_REQUEST['shop'];
		 $enable_countries = $this->getEnableCountries($shop);

		for($i=0;$i<sizeof($enable_countries);$i++){
			$country_id = $enable_countries[$i]->country_id;
			$country_code = DB::select('select * from country where country_id ='.$country_id, [1]);
			if($enable_countries[$i]->default_country == 1){
				$base_currency = $country_code[0]->country_currency; // default currency
			}
		}

		$this->conversion_price_data = $curlController->getCurrencyPricing($shop);
		
	}
	public function index(Request $request)
	{
		 $curlController = new CurlController();
		 $shop = $_REQUEST['shop'];
		 $store_details = DB::table("shopify_stores")->where('store_url',$shop)->get();
		 $access_token = $store_details[0]->access_token;
		 $url = "https://".$shop."/admin/api/2021-04/shop.json";
		 $shop_data = $curlController->curl_get_fun($url,$access_token);
		 $product_url = "https://".$shop."/admin/api/2021-04/products.json?limit=50";
		 $product_details = $curlController->curl_get_fun_products($product_url,$access_token,null);
	 // exit();	
		 $products_Data = $product_details['products'];
		 // print_r($products_Data);
		 // exit();
		 $next_page_token = $product_details['page_token'];
		 $country=DB::table('country')->get();
		 $country_currency =  DB::table('country_price_setting')->where('store_url',$shop)
				->select('*')
				->join('country','country.country_id','=','country_price_setting.country_id')
				->get();
		$get_module_data = DB::table("Module")->where('store_url',$shop)->get();
		
				$shop_currency_data = $curlController->curl_get_fun("https://".$shop."/admin/api/2021-04/currencies.json",$access_token);
				$product_count = $curlController->curl_get_fun("https://".$shop."/admin/api/2021-04/products/count.json",$access_token);
				$shopify_payments_data = $curlController->curl_get_fun("https://".$shop."/admin/api/2021-04/shopify_payments/balance.json",$access_token);
				
				if(!empty($shopify_payments_data)){
					$shopify_currency_data = $curlController->curl_get_fun("https://".$shop."/admin/api/2021-04/currencies.json",$access_token);
					for($i=0;$i<sizeof($shopify_currency_data['currencies']);$i++){
						$country_all_data = DB::table("country")->where('country_currency',$shopify_currency_data['currencies'][$i]['currency'])->get();
						foreach ($country_all_data as $country_data) {
							# code...
						$get_country_id = DB::table("country_price_setting")->where('country_id',$country_data->country_id)->where('store_url',$shop)->first();
						      if(empty($get_country_id)){
						      $insert_country_data = array(
						      	'country_id' => $country_data->country_id, 
						      	'country_status' => 0,
						      	'country_url' => '', 
						      	'custom_name' => '',
						      	'store_url' => $shop
						      	);
							   DB::table('country_price_setting')->insert($insert_country_data);
							}else{
								// echo $country_data->country_id;
								$insert_country_data = array(
						      	'country_id' => $country_data->country_id,
						      	'store_url' => $shop
						      	);
							   DB::table('country_price_setting')->where('country_id',$country_data->country_id)->where('store_url',$shop)->update($insert_country_data);
							}																						
						}
					}

					// delete those countries which are not enable in currency json
					$country_currency =  DB::table('country_price_setting')->where('store_url',$shop)
					->select('*')
					->join('country','country.country_id','=','country_price_setting.country_id')
					->get();
				// 	if(sizeof($shopify_currency_data['currencies']) > 0){

				// 	for($i=0;$i<sizeof($country_currency);$i++){
				// 		$a = false;
				// 		for($j=0;$j<sizeof($shopify_currency_data['currencies']);$j++){
				// 			if($country_currency[$i]->country_currency == $shopify_currency_data['currencies'][$j]['currency']){
				// 				$a = true;
				// 			}
				// 			if($country_currency[$i]->default_country == 1){
				// 				$a = true;
				// 			}
				// 		}
				// 		if(!$a){
				// 		$country_currency =  DB::table('country_price_setting')->where('store_url',$shop)->where('country_id',$country_currency[$i]->country_id)->delete();
				// 	}
				// 		// echo $country_currency;
				// 	}
				// }
					// for($i=0;$i<sizeof($shopify_currency_data['currencies']);$i++){

					// }

				}

			$design_data = DB::table("country_selector_design")->where('store_url',$shop)->first();
			 $view_data = [
			    'country'  => $country,
			    'products'   => $products_Data,
			    'next_page_token' => $next_page_token,
			    'country_currency' => $country_currency,
			    'access_token' => $access_token,
			    'shop' => $shop,
			    "shop_currency_data" =>$shop_currency_data,
			    'curl_controller' => new CurlController,
			    'module_data' => $get_module_data,
			    'conversion_data' => $this->conversion_price_data,
			    'shopify_payments_data' => $shopify_payments_data,
			    'design_data' => $design_data,
			    'product_count' => $product_count['count']
			];
		 return  view('country_price_setting')->with('data',$view_data);
		 //return  view('country_price_setting')->with('country',$country);
	}
	public function loadMoreProducts(Request $request){
		$curlController = new CurlController();
		$page_token = $request->page_token;
		$shop = $request->shop_url;
		$store_details = DB::table("shopify_stores")->where('store_url',$shop)->get();
		$access_token = $store_details[0]->access_token;
		$url = "https://".$shop."/admin/api/2021-04/shop.json";
		$shop_data = $curlController->curl_get_fun($url,$access_token);
		$product_details = $curlController->curl_get_fun_products("https://".$shop."/admin/api/2021-04/products.json?limit=50",$access_token,$page_token);
		$products_Data = $product_details['products'];
		$next_page_token = $product_details['page_token'];
		$country=DB::table('country')->get();
		$country_currency =  DB::table('country_price_setting')->where('store_url',$shop)
				->select('*')
				->join('country','country.country_id','=','country_price_setting.country_id')
				->get();
		$get_module_data = DB::table("Module")->where('store_url',$shop)->get();
				$shop_currency_data = $curlController->curl_get_fun("https://".$shop."/admin/api/2021-04/currencies.json",$access_token);
				$shopify_payments_data = $curlController->curl_get_fun("https://".$shop."/admin/api/2021-04/shopify_payments/balance.json",$access_token);
				if(!empty($shopify_payments_data)){
					$shopify_currency_data = $curlController->curl_get_fun("https://".$shop."/admin/api/2021-04/currencies.json",$access_token);
					for($i=0;$i<sizeof($shopify_currency_data['currencies']);$i++){
						$country_all_data = DB::table("country")->where('country_currency',$shopify_currency_data['currencies'][$i]['currency'])->get();
						foreach ($country_all_data as $country_data) {
							# code...
						$get_country_id = DB::table("country_price_setting")->where('country_id',$country_data->country_id)->where('store_url',$shop)->first();
						      if(empty($get_country_id)){
						      $insert_country_data = array(
						      	'country_id' => $country_data->country_id, 
						      	'country_status' => 0,
						      	'country_url' => '', 
						      	'custom_name' => '',
						      	'store_url' => $shop
						      	);
							   DB::table('country_price_setting')->insert($insert_country_data);
							}else{
								// echo $country_data->country_id;
								$insert_country_data = array(
						      	'country_id' => $country_data->country_id,
						      	'store_url' => $shop
						      	);
							   DB::table('country_price_setting')->where('country_id',$country_data->country_id)->where('store_url',$shop)->update($insert_country_data);
							}																						
						}
					}
					// delete those countries which are not enable in currency json
					$country_currency =  DB::table('country_price_setting')->where('store_url',$shop)
					->select('*')
					->join('country','country.country_id','=','country_price_setting.country_id')
					->get();
					// for($i=0;$i<sizeof($country_currency);$i++){
					// 	$a = false;
					// 	for($j=0;$j<sizeof($shopify_currency_data['currencies']);$j++){
					// 		if($country_currency[$i]->country_currency == $shopify_currency_data['currencies'][$j]['currency']){
					// 			$a = true;
					// 		}
					// 	}
					// 	if(!$a){
					// 	$country_currency =  DB::table('country_price_setting')->where('store_url',$shop)->where('country_id',$country_currency[$i]->country_id)->delete();
					// }
					// 	// echo $country_currency;
					// }
					// // for($i=0;$i<sizeof($shopify_currency_data['currencies']);$i++){

					// }

				}
			$design_data = DB::table("country_selector_design")->where('store_url',$shop)->first();
			 $view_data = [
			    'country'  => $country,
			    'products'   => $products_Data,
			    'next_page_token' => $next_page_token,
			    'country_currency' => $country_currency,
			    'access_token' => $access_token,
			    'shop' => $shop,
			    "shop_currency_data" =>$shop_currency_data,
			    'curl_controller' => new CurlController,
			    'module_data' => $get_module_data,
			    'conversion_data' => $this->conversion_price_data,
			    'shopify_payments_data' => $shopify_payments_data,
			    'design_data' => $design_data
			];
		 echo view('load-more-products')->with('data',$view_data);
	}
	public function insert_country(Request $request)
	{
      $country = $request->country;
      $shop = $request->shop;
      $get_country_id = DB::table("country_price_setting")->where('country_id',$country)->where('store_url',$shop)->first();
      if(empty($get_country_id)){
	      $country_data = array(
	      	'country_id' => $country, 
	      	'country_status' => 1,
	      	'country_url' => '', 
	      	'custom_name' => '',
	      	'store_url' => $_POST['shop']
	      	);
		   DB::table('country_price_setting')->insert($country_data);
		}else{
			$country_data = array(
	      	'country_id' => $country,
	      	'store_url' => $_POST['shop']
	      	);
		   DB::table('country_price_setting')->where('country_id',$country)->where('store_url',$shop)->update($country_data);
		}
   	 echo 'Saved successfully';
	}
	public function update_status(Request $request){
		$type = $request->type;
		$shop = $request->shop;
		$data_status = $request->data_status;
		if($type == 'country'){
			$affected = DB::table('Module')->where('store_url',$shop)
              ->update(['country_price' =>$data_status,'store_url' => $shop]);
		}
		if($type == 'geolocation'){
			$affected = DB::table('Module')->where('store_url',$shop)
              ->update(['geolocation' =>$data_status,'store_url' => $shop]);
		}
		if($type == 'round'){
			$affected = DB::table('Module')->where('store_url',$shop)
              ->update(['roundoff' =>$data_status,'store_url' => $shop]);
		}
		if($type == 'currency_status'){
			$country_price_setting_id = $request->country_price_setting_id;
			$update = DB::table('country_price_setting')->where('country_price_setting_id',$country_price_setting_id)->where('store_url',$shop)->update(['country_status' =>$data_status,'store_url' => $shop]);
		}
		if($type == 'international'){
			$country_price_setting_id = $request->country_id;
			DB::table('country_price_setting')->where('store_url',$shop)->update(['intl_currency' =>null,'store_url' => $shop]);
			$update = DB::table('country_price_setting')->where('country_price_setting_id',$country_price_setting_id)->where('store_url',$shop)->update(['intl_currency' =>$data_status,'store_url' => $shop]);
		}
			echo 'Saved successfully';
		}

	public function setting_country_update(Request $request)
	{
		$shop = $request->shop;
       $custom_name  = $request->input('custom_name');
       $custom_url = $request->input('custom_url');
       $custom_rounding_price = $request->input('custom_rounding_price');
       $different_country = $request->input('different_country');
       $country_price_setting_id  = $request->input('country_price_setting_id');
       if($request->hasFile('file')) {
	       $file = $request->file('file');
	       $custom_flag = rand(1,1000000000000000).$file->getClientOriginalName();
	       $image['filePath'] = $custom_flag;
	       $file->move(public_path().'/assets/flag_icon/', $custom_flag);
   		}
   		else{
   			$custom_flag = null;
   		}
   	$affected = DB::table('country_price_setting')
              ->where('country_id',$country_price_setting_id)->where('store_url',$shop)
              ->update(['custom_name' =>$custom_name,'country_url' => $custom_url,'custom_flag' => $custom_flag,'custom_rounding_price' => $custom_rounding_price,'different_country' => $different_country]);
              echo 'Saved successfully';
	}
	public function delete_country_price(Request $request)
	{
		$shop = $request->shop;
       $country_id  = $request->country_id;
   		$delete = DB::table('country_price_setting')->where('country_id', $country_id)->where('store_url',$shop)->delete();
              echo 'Saved successfully';
	}
	public function show_country_setting_data(Request $request)
	{
		$shop = $request->shop;
       $country_currency =  DB::table('country_price_setting')->where('store_url',$shop)
				->select('*')
				->join('country','country.country_id','=','country_price_setting.country_id')
				->get();
		 if(isset($country_currency) && !empty($country_currency)){
		      $i = 1;
		      foreach ($country_currency as $currency) { 
                              if($currency->country_code  !=''){
                                 ?>
                            <div class="enable-countries <?php if($currency->default_country == 1){ echo 'disabled-country';} ?>">

                              <div class="left-part">
                                <h4 class="Polaris-Heading text--uppercase"><?php echo $currency->country_code ?></h4>
                                <?php if($currency->default_country == 1){
                                 echo '<div class="default-text">Default Country</div>';} 
                                  else{
                                  echo '<div class="default-text">'.$currency->country_name.'</div>';
                                 } 
                                ?>
                              </div>

                              <div class="middle-part">
                                <label class="Polaris-Choice" for="enable-currency<?php echo $i ?>"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                                  <input id="enable-currency<?php echo $i ?>" type="radio" class="Polaris-RadioButton__Input country_price_status" name="enableCurrency<?php echo $i ?>" value="1" data-setting-id="<?php echo $currency->country_price_setting_id ?>" <?php if($currency->country_status == 1){ ?> checked <?php } ?>>
                                  <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Enable</span>
                                </label>

                                <label class="Polaris-Choice" for="disable-currency<?php echo $i ?>"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                                  <input id="disable-currency<?php echo $i ?>" type="radio" class="Polaris-RadioButton__Input country_price_status"  name="enableCurrency<?php echo $i ?>" value="0" data-setting-id="<?php echo $currency->country_price_setting_id ?>"  <?php if($currency->country_status == 0){ ?> checked <?php } ?>>
                                  <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Disable</span>
                                </label>
                                 <label class="Polaris-Choice intl-label" for="intl-currency<?php echo $i ?>" data-country-id="<?php echo $currency->country_price_setting_id ?>"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                                  <input id="intl-currency<?php echo $i ?>" type="radio" class="Polaris-RadioButton__Input intl-currency-status"  name="intl-currency" value="1"  <?php if($currency->intl_currency == 1){ ?> checked <?php } ?>>
                                  <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Rest of the World</span>
                                </label>
                              </div>

                              <div class="right-part">
                              	<div class="Polaris-ButtonGroup Polaris-ButtonGroup--segmented table-action">
	                                <button type="button" class=" Polaris-Button Polaris-ButtonGroup__Item edit-btn setting_icon trigger-modal" data-target="setting_currency_modal" id="setting_currency" 
	                                data-country-id="<?php echo $currency->country_id ?>" data-name="<?php echo $currency->custom_name ?>" data-different-country="<?php  if(!empty($currency->different_country)){echo $currency->different_country;} ?>" data-url="<?php echo $currency->country_url ?>" data-flag="<?php if(!empty($currency->custom_flag)){echo 'https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/public/assets/flag_icon/'.$currency->custom_flag; }?>">
	                                  <span class="Polaris-Button__Content"><span class="Polaris-Button__Text">
	                                  Edit
	                                  </span></span>
	                                </button>

	                                <button type="button" class="Polaris-Button Polaris-ButtonGroup__Item delete-btn delete_country_price delete_icon" data-country-id="<?php echo $currency->country_id ?>">
	                                	<span class="Polaris-Button__Content" >
		                                  <span class="Polaris-Button__Text">
		                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" fill="#000" d="M17 4h-3V2c0-1.103-.897-2-2-2H8C6.897 0 6 .897 6 2v2H3a1 1 0 1 0 0 2v13a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 1 0 0-2zM5 18h10V6H5v12zM8 4h4V2H8v2zm0 12a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1m4 0a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1"></path>
		                                  </svg>
		                                  </span>
	                                  </span>
	                                </button>
	                              </div>
                              </div>
                            </div>
                            <?php $i++;
                        	}
                        }
                     }
	}
	public function add_product_variant(Request $request){
		$curlController = new CurlController();
		$product_id = $request->product_id;
		$shop = $request->shop;
		$access_token = $request->access_token;
		$formdata = $request->formdata;
		$country_code_array=[];
		$country_option_values = [];
		$enable_countries = $this->getEnableCountries($shop);
		$country_conversion_prices = $this->conversion_price_data;
		for($i=0;$i<sizeof($enable_countries);$i++){
			$country_id = $enable_countries[$i]->country_id;
			$country_code = DB::select('select * from country where country_id ='.$country_id, [1]);
			if($enable_countries[$i]->default_country == 1){
				$default_country = $country_code[0]->country_code;  // default country 
				$base_currency = $country_code[0]->country_currency; // default currency
			}
			
			if(!empty($enable_countries[$i]->different_country)){
				$different_country_data = DB::select('select * from country where country_id ='.$enable_countries[$i]->different_country, [1]);
				$different_currency_code = $different_country_data[0]->country_currency;
			}
			else{
				$different_currency_code = null;
			}
			$enable_country_data = ['country_code' =>$country_code[0]->country_code,'currency' => $country_code[0]->country_currency,"different_currency" => $different_currency_code,"custom_rounding_price" => $enable_countries[$i]->custom_rounding_price];
			array_push($country_code_array,$enable_country_data);
			array_push($country_option_values,$country_code[0]->country_code);
		}
		
		// print_r($country_conversion_prices['rates']['AED']);
		$product_url = "https://".$shop."/admin/api/2021-04/products/".$product_id.".json";
		$get_product_data = $curlController->curl_get_fun($product_url,$access_token);
		$count_product_variant = count($get_product_data['product']['options']);
		if(intval($count_product_variant) >= 3){
			// if it has already 3 options
			echo "Already 3 variants exist";
			return false;
		}
		// deleting country variants first //
		if($get_product_data['product']['options'][$count_product_variant-1]['name'] == 'Country'){
			unset($get_product_data['product']['options'][$count_product_variant-1]);
			$default_variants = []; // store combinations based on default coun==+try
			for($i=0;$i<sizeof($get_product_data['product']['variants']);$i++){
				if($get_product_data['product']['variants'][$i]['option'.$count_product_variant] == $default_country){
					$get_product_data['product']['variants'][$i]['option'.$count_product_variant] = '';
					$get_product_data['product']['variants'][$i]['title'] = chop($get_product_data['product']['variants'][$i]['title']," / ".$default_country);
					unset($get_product_data['product']['variants'][$i]['id']);
					array_push($default_variants,$get_product_data['product']['variants'][$i]);
				}
			}
			$get_product_data['product']['variants'] = $default_variants;
			$response_product = $curlController->sendProductData($get_product_data,$product_url,$access_token);
			// deleting country variants first //
		}
		$product_url = "https://".$shop."/admin/api/2021-04/products/".$product_id.".json";
		$get_product_data = $curlController->curl_get_fun($product_url,$access_token);
		$count_product_variant = count($get_product_data['product']['options']);
		$position = intval($count_product_variant)+1;
		$new_option_values= array("name" => "Country","values"=>$country_option_values,"position"=>$position);
		$original_variant_array = $get_product_data['product']['variants'];
		$variants_array = [];
		array_push($get_product_data['product']['options'],$new_option_values);
		if(sizeof($get_product_data['product']['variants'])*sizeof($country_code_array) <= 100){
			for($i=0;$i<sizeof($country_code_array);$i++){
				for($j=0;$j<sizeof($get_product_data['product']['variants']);$j++){
					$price_value = '';
					$compare_price_value = '';
					$formkey_price = 'price_'.$original_variant_array[$j]['title'].' / '.$country_code_array[$i]['country_code'];
					$formkey_compare_price = 'compareprice_'.$original_variant_array[$j]['title'].' / '.$country_code_array[$i]['country_code'];
					if($country_code_array[$i]['country_code'] == $default_country){
						// if default country loop true
						$price_value = $original_variant_array[$j]['price'];
						$compare_price_value = $original_variant_array[$j]['compare_at_price'];
					}
					else{
						// if default country loop false
						$currency =  $country_code_array[$i]['currency'];
						$different_currency = $country_code_array[$i]['different_currency'];
						$custom_rounding_price = $country_code_array[$i]['custom_rounding_price'];
						if(!empty($different_currency)){
							$currency = $different_currency;	
						}
						for($k=0;$k<sizeof($formdata);$k++){
							if($formdata[$k]['name'] == $formkey_price && $formdata[$k]['value'] != ''){
				
									//if conversion rate is less than 1
								if(!empty($custom_rounding_price)){
									$price_value = ($formdata[$k]['value']*$custom_rounding_price)/$country_conversion_prices[$base_currency];
								}
								else{
									$price_value = ($formdata[$k]['value']*$country_conversion_prices[$currency])/$country_conversion_prices[$base_currency];
								}
							}
							if($formdata[$k]['name'] == $formkey_compare_price && $price_value != ''){
								if($formdata[$k]['value'] == ''){
									$compare_price_value = null;
								}
								else{
								if(!empty($custom_rounding_price)){
										$compare_price_value = ($formdata[$k]['value']*$custom_rounding_price)/$country_conversion_prices[$base_currency];	
										}
										else{
											$compare_price_value = ($formdata[$k]['value']*$country_conversion_prices[$currency])/$country_conversion_prices[$base_currency];
										}		
									}
							}
						}
					}
					if($price_value != ''){
						$get_product_data['product']['variants'][$j]['title'] = $original_variant_array[$j]['title'].' / '.$country_code_array[$i]['country_code'];
				 		$get_product_data['product']['variants'][$j]['option'.$position] = $country_code_array[$i]['country_code'];
				 		$get_product_data['product']['variants'][$j]['price'] = $price_value;
				 		$get_product_data['product']['variants'][$j]['compare_at_price'] = $compare_price_value;
				 		unset($get_product_data['product']['variants'][$j]['id']); // remove variant id
				 		array_push($variants_array,$get_product_data['product']['variants'][$j]);
			 		}
			 		else{
			 			// remove combination if price is not entered
			 			unset($get_product_data['product']['variants'][$j]); 
			 		}
			 	}
			}
			$get_product_data['product']['variants'] = $variants_array;
			$response_product = $curlController->sendProductData($get_product_data,$product_url,$access_token);
		}
		else{
			// if combinations are more than 100 or more than 100
			echo 'You can add maximum 100 combinations of variants';
		}
	}
	public function delete_product_variant(Request $request){
		$curlController = new CurlController();
		$product_id = $request->product_id;
		$shop = $request->shop;
		$access_token = $request->access_token;
		$country_code_array=[];
		$enable_countries = $this->getEnableCountries($shop);
		for($i=0;$i<sizeof($enable_countries);$i++){
			$country_id = $enable_countries[$i]->country_id;
			$country_code = DB::select('select * from country where country_id ='.$country_id, [1]);
			if($enable_countries[$i]->default_country == 1){
				$default_country = $country_code[0]->country_code;  // default country 
			}
			array_push($country_code_array,$country_code[0]->country_code);
		}
		$product_url = "https://".$shop."/admin/api/2021-04/products/".$product_id.".json";
		$get_product_data = $curlController->curl_get_fun($product_url,$access_token);
		$position = count($get_product_data['product']['options']);
		unset($get_product_data['product']['options'][$position-1]);
		$default_variants = []; // store combinations based on default coun==+try
		for($i=0;$i<sizeof($get_product_data['product']['variants']);$i++){
			if($get_product_data['product']['variants'][$i]['option'.$position] == $default_country){
				$get_product_data['product']['variants'][$i]['option'.$position] = '';
				$get_product_data['product']['variants'][$i]['title'] = chop($get_product_data['product']['variants'][$i]['title']," / ".$default_country);
				unset($get_product_data['product']['variants'][$i]['id']);
				array_push($default_variants,$get_product_data['product']['variants'][$i]);
			}
		}
		$get_product_data['product']['variants'] = $default_variants;
		$response_product = $curlController->sendProductData($get_product_data,$product_url,$access_token);
		print_r($response_product);
	}
	public function save_form_values(Request $request){
		extract($_POST);
		if(!isset($enable_theme_font)){
			$enable_theme_font = null;
		}
		$design_data = DB::table("country_selector_design")->where('store_url',$shop)->first();
			if(empty($design_data)){
				 $data=array(
	                "store_url" => $shop,
	                "fontfamily" => $fontfamily,
	                "fontcolor" => $fontcolor,
	                "themefont" => $enable_theme_font,
	                "textstyle" => $textStyle,
	                "paddingleft" =>$paddingleft,
	                "paddingtop" =>$paddingtop,
	                "fontweight" => $fontweight,
	                "fontsize" => $fontsize,
	                "letterspacing" => $letterspacing,
	                "enableflag" => $enableflag,
	                "position" => $position
		            );
					$response = DB::table('country_selector_design')->insert($data);
			}
			else{
				 $data=array(
	                "store_url" => $shop,
	                "fontfamily" => $fontfamily,
	                "themefont" => $enable_theme_font,
	                "fontcolor" => $fontcolor,
	                "fontsize" => $fontsize,
	                "textstyle" => $textStyle,
	                "paddingleft" =>$paddingleft,
	                "paddingtop" =>$paddingtop,
	                "fontweight" => $fontweight,
	                "letterspacing" => $letterspacing,
	                "enableflag" => $enableflag,
	                "position" => $position
		            );
				$response = DB::table('country_selector_design')->where('store_url',$shop)->update($data);
			}
			
				echo 'Saved';
		}
	public function getEnableCountries($shop){
		//$results = DB::select("select * from country_price_setting where country_status = 1 and store_url= '$shop'", [1]);
		 $country_detail = DB::table("country_price_setting")->where(['country_status'=> 1,'store_url'=>$shop])->get();
		return $country_detail;
	}
}
?>