<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
include 'CurlController.php';
include 'SnippetController.php';

class App_Setting_Controller extends Controller
{

public function index(Request $request)
{
    $curlController = new CurlController();
    $shop = $_GET['shop'];
    $store_details = DB::table("shopify_stores")->where('store_url',$shop)->get();
    $theme_data_db = DB::table("theme_data")->where('store_url',$shop)->get();
	$access_token = $store_details[0]->access_token;
	$url = "https://".$shop."/admin/api/2021-04/themes.json";
	$theme_data = $curlController->curl_get_fun($url,$access_token); 
	$shopurl = "https://".$shop."/admin/api/2021-04/shop.json";
	$shop_data = $curlController->curl_get_fun($shopurl,$access_token);
	//echo "<pre>"; print_r($shop_data);
	$view_data = [
		    'theme_data'  => $theme_data,
		    'shop' => $shop,
		    'theme_data_db' => $theme_data_db
		];
     return view('app_setting')->with($view_data);
   
}
public function theme_install_fun_ajax(Request $request){
	$curlController = new CurlController();
	$snippetController = new SnippetController();
	$store_details = DB::table("shopify_stores")->where('store_url',$_POST['shop'])->get();
	$access_token = $store_details[0]->access_token;
	$theme_detail = DB::table("theme_data")->where('store_url',$_POST['shop'])->first();
	if(empty($theme_detail)){
            $data=array(
                "theme_id" => $_POST['theme_id'],
                "store_url" => $_POST['shop'],
                "google_pixel" => $_POST['google_tracking'],
                "fb_pixel" => $_POST['facebook_tracking']
            );
            DB::table('theme_data')->insert($data);
        }else{
        	$data=array(
                "theme_id" => $_POST['theme_id'],
                "store_url" => $_POST['shop'],
                "google_pixel" => $_POST['google_tracking'],
                "fb_pixel" => $_POST['facebook_tracking']
            );
            DB::table('theme_data')->update($data);
            // DB::update('update theme_data set theme_id,google_tracking,fb_tracking = ? where store_url = ?',[$_POST['theme_id'],$_POST['google_tracking'],$_POST['facebook_tracking'],$_POST['shop']]);
        }
        $chaos_common_snippet = $this->create_snippet_common($_POST['shop'],$access_token,$_POST['theme_id']);

        /** chaos product price snippet **/
        $chaos_product_price_snippet = $this->create_snippet_product_price($_POST['shop'],$access_token,$_POST['theme_id']);

                $analytic_data = $_POST['google_tracking'].''.$_POST['facebook_tracking'];
        $chaos_analytic_snippet = $this->create_snippet_analytics($_POST['shop'],$access_token,$_POST['theme_id'],$analytic_data);
     	 $theme_liquid = 'layout/theme.liquid';
  		 $theme_file = $snippetController->getshopify_assest($_POST['shop'], $access_token, $_POST['theme_id'], $theme_liquid);
  		 if(isset($theme_file['asset'])){
	        $theme_backup_file = $snippetController->getshopify_assest($_POST['shop'], $access_token, $_POST['theme_id'], "layout/theme-backup.liquid");
	        if(empty($theme_backup_file)){
	            $create_backup_file = json_encode(array("asset" => array("key" => "layout/theme-backup.liquid","value" => $theme_file['asset']['value'])), JSON_UNESCAPED_SLASHES);
	            $snippetController->saveBackUpTemplate($_POST['shop'],$_POST['theme_id'], $create_backup_file, $access_token);
	        }
	        if(!empty($theme_backup_file)){
	        	$country_snippet = '{% include "chaos_common" %}';
	        	$analytic_snippet = '{% include "chaos_analytics" %}';
          		$final_template_value = $snippetController->insertString($theme_file['asset']['value'], "</body>", $country_snippet);

          		$final_template_value_google = $snippetController->insertString_analytics($theme_file['asset']['value'], "</head>", $analytic_snippet);

          		//$final_template_value_fb = $snippetController->insertString_analytics($theme_file['asset']['value'], "</head>", $_POST['facebook_tracking']);

          		$announcement_bar_string = "<div id='announcement_bar_div'></div>";
	            $announcement_bar_value = $snippetController->insertString_annoucment($final_template_value, "{% section 'header' %}", $announcement_bar_string);
          		if(isset($final_template_value)) {
	              $data_2 = json_encode(array("asset" => array("key" => $theme_file['asset']['key'],
	                  "value" => $final_template_value)), JSON_UNESCAPED_SLASHES);
	              $result = $snippetController->saveBackUpTemplate($_POST['shop'],$_POST['theme_id'], $data_2, $access_token);
	            }
				if(isset($final_template_value_google)) {
				  $data_3 = json_encode(array("asset" => array("key" => $theme_file['asset']['key'],
				      "value" => $final_template_value_google)), JSON_UNESCAPED_SLASHES);
				  $result = $snippetController->saveBackUpTemplate($_POST['shop'],$_POST['theme_id'], $data_3, $access_token);
				}
				/*if(isset($final_template_value_fb)) {
				  $data_4 = json_encode(array("asset" => array("key" => $theme_file['asset']['key'],
				      "value" => $final_template_value_fb)), JSON_UNESCAPED_SLASHES);
				  $result = $snippetController->saveBackUpTemplate($_POST['shop'],$_POST['theme_id'], $data_4, $access_token);
				}*/
	          if(isset($announcement_bar_value)) {
	              $data_anno = json_encode(array("asset" => array("key" => $theme_file['asset']['key'],
	                  "value" => $announcement_bar_value)), JSON_UNESCAPED_SLASHES);
	              $result = $snippetController->saveBackUpTemplate($_POST['shop'],$_POST['theme_id'], $data_anno, $access_token);
	            }
	       }
    	}
     echo 'Saved successfully';
 }

 public function create_snippet_analytics($shopurl,$access_token,$shop_theme_id,$data){
 	$snippetController = new SnippetController();
 	$curlController = new CurlController();
	$snippet = json_encode(array('asset' => array(
          'key' => "snippets/chaos_analytics.liquid",
          'value' => $data
     )));
      $result = $snippetController->createSnippet($shopurl,$access_token,$snippet,$shop_theme_id);
 }

 public function create_snippet_common($shopurl,$access_token,$shop_theme_id){
 	$snippetController = new SnippetController();
 	$curlController = new CurlController();
 	$shopify_payments_data = $curlController->curl_get_fun("https://".$shopurl."/admin/api/2021-04/shopify_payments/balance.json",$access_token);
 	if(!empty($shopify_payments_data)){
 		$shopify_payment = 'true';
 	}
 	else{
 		$shopify_payment = 'false';
 	}
 	$snippet_val = '<script type="text/javascript">
	  if(typeof window.chaosapp === "undefined") {
	    window.chaosapp = {};
	  }
	  window.chaosapp.shopURL = "{{ shop.permanent_domain | replace: "https://", "" }}";
	</script>
	<script  src="//cdn.shopify.com/s/javascripts/currencies.js" type="text/javascript"></script>
	<script type="text/javascript" src="https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/public/assets/js/chaos_shopify_app.js?'.rand(1,100000000000000000).'"></script>
	<link href="https://56a6-2405-201-6007-5ca3-fd47-db01-45fe-5c68.ngrok-free.app/public/assets/css/chaos-storefront.css?'.rand(1,100000000000000000).'" rel="stylesheet" type="text/css"/>
	<div id="country_selector" data-shopify-payment="'.$shopify_payment.'"></div>
	<div style="display:none;">
 {% form "currency" %}
    <select name="currency" style="display:none;">
      {% for currency in shop.enabled_currencies %}
        {% if currency == cart.currency %}
          <option selected="true" value="{{currency.iso_code}}">{{currency.iso_code}} {{currency.symbol}}</option>
          {% else %}
          <option value="{{currency.iso_code}}">{{currency.iso_code}}</option>
        {% endif %}
      {% endfor %}
    </select>
    <button type="submit" id="chaos-update-shopify-currency">Update</button>
  {% endform %}
  <script>
Currency.format = "{{ settings.currency_format | default: "money_with_currency_format" }}";
var shopCurrency = "{{ shop.currency }}";
/* Sometimes merchants change their shop currency, let"s tell our JavaScript file */
Currency.moneyFormats[shopCurrency].money_with_currency_format = {{ shop.money_with_currency_format | strip_html | json }};
Currency.moneyFormats[shopCurrency].money_format = {{ shop.money_format | strip_html | json }};
var defaultCurrency = "{{ settings.default_currency | default: shop.currency }}";
var cookieCurrency = Currency.cookie.read();
  $(window).on("load",function(){
  
jQuery("span.money span.money").each(function() {
  jQuery(this).parents("span.money").removeClass("money");
});
jQuery("span.money").each(function() {
  jQuery(this).attr("data-currency-{{ shop.currency }}", jQuery(this).html());
});
	setTimeout(function(){
if (cookieCurrency == null) {
  if (shopCurrency !== defaultCurrency) {
    Currency.convertAll(shopCurrency, defaultCurrency);
  }
  else {
    Currency.currentCurrency = defaultCurrency;
  }
}
else if (jQuery("[name=currencies]").length && jQuery("[name=currencies] option[value=" + cookieCurrency + "]").length === 0) {
  Currency.currentCurrency = shopCurrency;
  Currency.cookie.write(shopCurrency);
}
else if (cookieCurrency === shopCurrency) {
  Currency.currentCurrency = shopCurrency;
}
else {
  Currency.convertAll(shopCurrency, cookieCurrency);
}

jQuery("[name=currencies]").val(Currency.currentCurrency).change(function() {
  console.log(Currency.currentCurrency)
  var newCurrency = jQuery(this).val();
  Currency.convertAll(Currency.currentCurrency, newCurrency);
  console.log(Currency.currentCurrency)
  jQuery(".selected-currency").text(Currency.currentCurrency);
});
var original_selectCallback = window.selectCallback;
var selectCallback = function(variant, selector) {
  original_selectCallback(variant, selector);
  Currency.convertAll(shopCurrency, jQuery("[name=currencies]").val());
  console.log(Currency.currentCurrency)
  jQuery(".selected-currency").text(Currency.currentCurrency);
};
},1000)
  })
  document.addEventListener("DOMContentLoaded", function(){
  function usePushState(handler){
    //modern themes use pushstate to track variant changes without reload
    function track (fn, handler, before) {
      return function interceptor () {
        if (before) {
          handler.apply(this, arguments);
          return fn.apply(this, arguments);
        } else {
          var result = fn.apply(this, arguments);
          handler.apply(this, arguments);
          return result;
        }
      };
    }
    var currentVariantId = null;
    function variantHandler () {
      var selectedVariantId = window.location.search.replace(/.*variant=(\d+).*/, "$1");
      if(!selectedVariantId) return;
      if(selectedVariantId != currentVariantId){
        currentVariantId = selectedVariantId;
        handler(selectedVariantId);
      }
    }
    // Assign listeners
    window.history.pushState = track(history.pushState, variantHandler);
    window.history.replaceState = track(history.replaceState, variantHandler);
    window.addEventListener("popstate", variantHandler);
  }
  usePushState(function(variantId){
    Currency.convertAll(shopCurrency, jQuery("[name=currencies]").val());
        console.log(Currency.currentCurrency)
  });
});
</script>

  </div>
	';
	$snippet = json_encode(array('asset' => array(
          'key' => "snippets/chaos_common.liquid",
          'value' => $snippet_val
     )));
      $result = $snippetController->createSnippet($shopurl,$access_token,$snippet,$shop_theme_id);
 }
 public function country_selector_list(Request $request){
 	header('Access-Control-Allow-Origin:  *');
	header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
	header('Access-Control-Allow-Methods: GET, POST, PUT');
 	$shop = $_POST['shop'];
 	//echo $shop;
 	$country_selector =  DB::table('country_price_setting')
		->select('*')->where(['store_url' => $shop,'country_status' => 1])
		->join('country','country.country_id','=','country_price_setting.country_id')
		->get();
    $country = DB::table('country')->get();
	$selector_design = DB::table("country_selector_design")->where(['store_url' => $shop])->first();
	$view_data = [
		    'country_selector'  => $country_selector,
		    'selector_design' => $selector_design,
        'all_country' => $country
		];
     echo view('country_selector_list_view')->with($view_data);
	//echo "<pre>"; print_r($country_currency);
}
public function get_announcement_bar(Request $request){
	header('Access-Control-Allow-Origin:  *');
	header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
	header('Access-Control-Allow-Methods: GET, POST, PUT');
	$shop = $_POST['shop'];
	$country_id = $_POST['country_id'];
	$module = DB::table("Module")->where(['store_url'=> $shop,'announcement_bar' => 1
	 ])->first();
	$announcement_bar_list = DB::table("announcement_bar_setting")->where(['store_url'=> $shop,'country_id' => $country_id, 'bar_status' => 1
	 ])->first();
	$view_data = [
		    'announcement_bar_list'  => $announcement_bar_list
		];
	if(!empty($module)){
    echo view('announcement_bar_frontend')->with($view_data);
	}
	//echo "<pre>"; print_r($announcement_bar_list);
}
public function country_page_redirect(Request $request){
	header('Access-Control-Allow-Origin:  *');
	header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
	header('Access-Control-Allow-Methods: GET, POST, PUT');
	$shop = $_POST['shop'];
	$country_code = $_POST['country_code'];
	$country = DB::table("country")->where(['country_code' => $country_code ])->get();
	$country_id = $country[0]->country_id;

	$page_redirect_data = array();
	$page_redirect_data[] = DB::table("internal_redirect")->where(['store_url' => $shop,'country_id' => $country_id ])->get();
	$page_redirect_data[] = DB::table("external_redirect")->where(['store_url' => $shop,'country_id' => $country_id ])->get();
	return json_encode($page_redirect_data);
	/*foreach ($internal_redirect as $page_handle) {
		echo $page_handle->new_page_handle;
	}*/
}
 public function create_snippet_product_price($shopurl,$access_token,$shop_theme_id){
 	$snippetController = new SnippetController();
 	$curlController = new CurlController();

 	$snippet_val ='  {% capture variant-title %}
    {% if product.options contains "Country" %}
    {% assign index = product.variants.size | minus:1 %}
	{% else %}
	{% assign index = product.variants.size %}
	{% endif %}
    {% for variant in product.variants %}
{% endfor %}
{% endcapture %}
{% if product.has_only_default_variant  %}
<div class="chaos-hidden-variant-data" data-target-id="{{product.id}}">
  <div class="data-chaos-variant-title">
    {% if product.compare_at_price > product.price %}

    <span class="chaos-price sale"> {{product.price | money}}</span>
    <span class="chaos-variant-compare-price linethrough">
      {{product.compare_at_price | money}}
    </span>
    {% else %}
    <span class="chaos-price"> {{product.price | money}}</span>
    {% endif %}
  </div>
</div>

{% elsif product.options contains "Country" %}
<div class="chaos-hidden-variant-data" style="display:none;" data-target-id="{{product.id}}">
  {% for variant in product.variants %}
  {% if product.options.size == 2 %}
  {% assign variant_without_country = variant.option1 %}
  {% elsif product.options.size == 3 %}
  {% assign variant_without_country = variant.option1 | append:" / " | append:variant.option2 %}
  {% endif %}
  <div data-variant="{{variant.id}}" data-combination="{{variant_without_country | escape}}" data-chaos-variant-title="{{variant.title | escape}}" class="data-chaos-variant-title" style="display:none;">{{variant.price | money}}
  {% if variant.compare_at_price%}<span class="chaos-variant-compare-price linethrough">{{variant.compare_at_price | money}}</span>{% endif %}
  </div>
  {% endfor %}
</div>
{% else %}
<div class="chaos-hidden-variant-data" data-target-id="{{product.id}}">
  <div class="data-chaos-variant-title">
    {% if product.compare_at_price > product.price %}

    <span class="chaos-price sale"> {{product.price | money}}</span>
    <span class="chaos-variant-compare-price linethrough">
      {{product.compare_at_price | money}}
    </span>
    {% else %}
    <span class="chaos-price"> {{product.price | money}}</span>
    {% endif %}
  </div>
</div>
{% endif %}';
 	$snippet = json_encode(array('asset' => array(
          'key' => "snippets/chaos_product_price_snippet.liquid",
          'value' => $snippet_val
     )));
      $result = $snippetController->createSnippet($shopurl,$access_token,$snippet,$shop_theme_id);

 }
}
?>