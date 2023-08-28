<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
include 'AppController.php';
include 'CurlController.php';


class Country_Redirect_Setting_Controller extends Controller
{

public function index(Request $request)
{
   
			$CurlController =new CurlController();
			$shop = $_REQUEST['shop'];
			$store_details = DB::table("shopify_stores")->where('store_url',$shop)->get();
			$access_token = $store_details[0]->access_token;
			$url = "https://".$shop."/admin/api/2021-04/pages.json";
			$shop_data = $CurlController->curl_get_fun($url,$access_token);
			//$country=DB::table("country")->get();
      $countries =  DB::table('country_price_setting')
        ->select('*')->where(['store_url' => $shop,'country_status' => 1])
        ->join('country','country_price_setting.country_id','=','country.country_id')
        ->get();
			$show_data_internal = DB::table('internal_redirect')->select('*')->get();
			$show_data_external = DB::table('external_redirect')->select('*')->get();
      $external_module = DB::table("Module")->where(['store_url'=> $shop])->get();
			return view('country_redirect_setting',compact('shop_data','countries','show_data_internal','show_data_external','shop','external_module'));
}


public function insert_country_page_internal(Request $request)
{
  $curlController =new CurlController();
	$page_handle = $request->select_page;
	$country_id = $request->select_country;
  $new_pagehandle = $request->new_pagehandle;
  $shop = $request->shop_url;
	$country = DB::table('country')->select('country_name')->where('country_id',$country_id)->first();
	$country_name=strtolower($country->country_name);
	$country_name_rep = str_replace(" ", "-", $country_name);	
	// $new_page_handle=$page_handle.'-'.$country_name_rep;
  $new_page_handle = $new_pagehandle;
  $validate_external_data = DB::table('external_redirect')->select('external_id')->where(['country_id' => $country_id,'page_handle'=> $page_handle,'store_url'=>$shop])->get();
  $validate_external_data = $validate_external_data->count();
  $store_details = DB::table("shopify_stores")->where('store_url',$shop)->get();
  $access_token = $store_details[0]->access_token;
  $page_title = str_replace("-", " ", $new_page_handle);
  if(empty($validate_external_data))
  {
    $validate = DB::table('internal_redirect')->select('internal_id')->where(['country_id'=> $country_id,'page_handle'=> $page_handle,'store_url'=>$shop ])->get();

       $validate = $validate->count();

    if(!empty($validate)){
    // echo 'Data already exist';
    $update =DB::table('internal_redirect')->where(['country_id'=> $country_id,'page_handle'=> $page_handle,'store_url'=>$shop ])->update(
    ['page_handle' => $page_handle,'country_id' => $country_id,'new_page_handle' =>$new_page_handle,'internal_status' => '0','store_url' => $shop]);
    echo 'Saved successfully';
    }
    else{
    if(empty($new_pagehandle)){
        $insert =DB::table('internal_redirect')->insertGetId(
      ['page_handle' => $page_handle,'country_id' => $country_id,'new_page_handle' =>$new_page_handle,'internal_status' => '0','store_url' => $shop]
      );
      /**** Create page ***/
      // $url = "https://".$shop."/admin/api/2020-10/pages.json";
      // $page_data = array (
      //       'page' => 
      //       array (
      //         'title' => $page_title,
      //         'handle' => $new_page_handle
      //       ),
      //     );
      // $json_data =  json_encode($page_data);
      // $page_data_create = $curlController->curl_post_fun($url,$access_token,$json_data);
    /**** end create page ****/
    }else{
       $insert =DB::table('internal_redirect')->insertGetId(
      ['page_handle' => $page_handle,'country_id' => $country_id,'new_page_handle' =>$new_pagehandle,'internal_status' => '0','store_url' => $shop]
      );
       /**** Create page ***/
      // $url = "https://".$shop."/admin/api/2020-10/pages.json";
      // $page_data = array (
      //       'page' => 
      //       array (
      //         'title' => $new_pagehandle,
      //         'handle' => $new_pagehandle
      //       ),
      //     );
      // $json_data =  json_encode($page_data);
      // $page_data_create = $curlController->curl_post_fun($url,$access_token,$json_data);
    /**** end create page ****/
    }
    
    	echo 'Saved successfully';

    }
   
  }
else{

	echo 'Data already exist in extenal redirection';
}

	
	
}


public function show_data_internal(Request $request)
{
	$curlController =new CurlController();
  	$shop = $request->shop_url;
	$show_data = 	DB::table('internal_redirect')->select('*')->where('store_url',$shop)->get();
	$store_details = DB::table("shopify_stores")->where('store_url',$shop)->get();
	$access_token = $store_details[0]->access_token;
	$url = "https://".$shop."/admin/api/2021-04/pages.json";
    $page_data = $curlController->curl_get_fun($url,$access_token);
    //echo "<pre>"; print_r($page_data); exit;
   /* print_r($show_data);*/

	


	echo '<div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
  <div class="Polaris-Card__Section show_all_data_internal">
    <div class="Polaris-Page-Header Polaris-Page-Header--mobileView">
      <div class="Polaris-Page-Header__MainContent">
        <div class="Polaris-Page-Header__TitleActionMenuWrapper">
          <div>
           
          </div>
        </div>
      </div>
    </div>
    <div class="Polaris-Page__Content">
      <div class="Polaris-Card">
        <div class="">
          <div class="Polaris-DataTable__Navigation"><button type="button" class="Polaris-Button Polaris-Button--disabled Polaris-Button--plain Polaris-Button--iconOnly" disabled="" aria-label="Scroll table left one column"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                      <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16" fill-rule="evenodd"></path>
                    </svg></span></span></span></button><button type="button" class="Polaris-Button Polaris-Button--plain Polaris-Button--iconOnly" aria-label="Scroll table right one column"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                      <path d="M8 16a.999.999 0 0 1-.707-1.707L11.586 10 7.293 5.707a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5A.997.997 0 0 1 8 16" fill-rule="evenodd"></path>
                    </svg></span></span></span></button></div>
          <div class="Polaris-DataTable">
            <div class="Polaris-DataTable__ScrollContainer">
              <table class="Polaris-DataTable__Table">
                <thead>
                  <tr>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Default Page</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Country</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Redirect To</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Edit</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Preview</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="Polaris-DataTable__TableRow">';

					for( $i=0; $i<count($show_data); $i++ ){
							$internal_id=$show_data[$i]->internal_id;
					        $page_handle=$show_data[$i]->page_handle;
					        $country_id=$show_data[$i]->country_id;
					        $country_name = DB::table('country')->select('country_name')->where('country_id',$country_id)->get();
	                        $country_name=$country_name['0']->country_name;
					       
					        $new_page_handle=$show_data[$i]->new_page_handle;
					        foreach ($page_data['pages'] as $page) {
					        	if($page['handle'] == $new_page_handle){
					        		
                      $url = 'https://'.$shop.'/pages/'.$new_page_handle;
							echo '<th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">'.$page_handle.'</th>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><p>'.$country_name.'</p></td>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><p style="text-transform:lowercase;">'.$url.'</p></td>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric edit-internal-btn" data-old-page="'.$page_handle.'" data-country="'.$country_name.'" data-handle="'.$new_page_handle.'"><p><a href="javascript:void(0)">Edit</a></p></td>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><p><a href="'.$url.'?mode=page&test=true" target="_blank">view</a></p></td>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;"><button data-page-id='.$page['id'].' type="button" onclick="return delete_data_internal(\'' . $internal_id . '\',\'' . $shop . '\',\'' . $page['id'] . '\');" class="Polaris-Button delete_icon"  ><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" fill="#000" d="M17 4h-3V2c0-1.103-.897-2-2-2H8C6.897 0 6 .897 6 2v2H3a1 1 0 1 0 0 2v13a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 1 0 0-2zM5 18h10V6H5v12zM8 4h4V2H8v2zm0 12a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1m4 0a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1"></path>
                        </svg>
                    </span></span></button></div></td>';
						echo '</tr>';
						}

						}
					        }
					        
                    echo '</tbody>
				</table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';


}

public function delete_data_internal(Request $request)
{
  $curlController =new CurlController();
  $internal_id = $request->internal_id; 
  $shop = $request->shop_url;
  $page_id = $request->page_id;
  // $store_details = DB::table("shopify_stores")->where('store_url',$shop)->get();
  // $access_token = $store_details[0]->access_token;
  // $url = "https://".$shop."/admin/api/2020-10/pages/".$page_id.".json";
  // $page_del = $curlController->curl_delete_fun($url,$access_token);
  DB::table('internal_redirect')->where('internal_id',$internal_id)->where('store_url',$shop)->delete();	
  echo 'delete successfully';
}


public function enable_disable_country_redirect(Request $request)
{
  $value = $request->value; 
  $shop = $request->shop_url;
  DB::table('Module')->where('store_url',$shop)->update(['country_redirection' => $value]);
  echo 'Saved successfully';
}


/*--------------------------------------------------------------------------------------------*/


/*-------------- Start External Redireaction Script----------------------------------------*/

public function insert_country_page_external(Request $request)
{
	$page_handle = $request->select_page_external;
	$country_id = $request->select_country_external;
	$new_page_handle=$request->external_page_handle;
  $shop = $request->shop_url;
	$validate_internal_data= DB::table('internal_redirect')->select('internal_id')->where(['country_id' => $country_id,'page_handle'=> $page_handle,'store_url'=>$shop])->get();

$validate_internal_data = $validate_internal_data->count();


    if(empty($validate_internal_data))
{


	
	$validate_external = DB::table('external_redirect')->select('external_id')->where(['country_id' => $country_id,'page_handle'=> $page_handle,'store_url'=>$shop])->get();

     $validate_external = $validate_external->count();


	if(!empty($validate_external)){
     // echo 'Data already exist';
      $update=DB::table('external_redirect')->where(['country_id' => $country_id,'page_handle'=> $page_handle,'store_url'=>$shop])->update(
  ['page_handle' =>$page_handle,'country_id' => $country_id,'custom_url' =>$new_page_handle,'external_status' => '0', 'store_url'=>$shop]
  );
    echo 'Saved successfully';
	}
	else{
	
	$id=DB::table('external_redirect')->insertGetId(
	['page_handle' =>$page_handle,'country_id' => $country_id,'custom_url' =>$new_page_handle,'external_status' => '0', 'store_url'=>$shop]
	);


		echo 'Saved successfully';

	}
   }
   else{

	echo 'Data already exist internal redirection';
}


	
	
}


public function show_data_external(Request $request)
{
  $shop = $request->shop_url; 
$show_data = DB::table('external_redirect')->select('*')->where('store_url',$shop)->get();
   /* print_r($show_data);*/

	


	echo '<div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
  <div class="Polaris-Card__Section show_all_data_internal">
    <div class="Polaris-Page-Header Polaris-Page-Header--mobileView">
      <div class="Polaris-Page-Header__MainContent">
        <div class="Polaris-Page-Header__TitleActionMenuWrapper">
          <div>
           
          </div>
        </div>
      </div>
    </div>
    <div class="Polaris-Page__Content">
      <div class="Polaris-Card">
        <div class="">
          <div class="Polaris-DataTable__Navigation"><button type="button" class="Polaris-Button Polaris-Button--disabled Polaris-Button--plain Polaris-Button--iconOnly" disabled="" aria-label="Scroll table left one column"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                      <path d="M12 16a.997.997 0 0 1-.707-.293l-5-5a.999.999 0 0 1 0-1.414l5-5a.999.999 0 1 1 1.414 1.414L8.414 10l4.293 4.293A.999.999 0 0 1 12 16" fill-rule="evenodd"></path>
                    </svg></span></span></span></button><button type="button" class="Polaris-Button Polaris-Button--plain Polaris-Button--iconOnly" aria-label="Scroll table right one column"><span class="Polaris-Button__Content"><span class="Polaris-Button__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                      <path d="M8 16a.999.999 0 0 1-.707-1.707L11.586 10 7.293 5.707a.999.999 0 1 1 1.414-1.414l5 5a.999.999 0 0 1 0 1.414l-5 5A.997.997 0 0 1 8 16" fill-rule="evenodd"></path>
                    </svg></span></span></span></button></div>
          <div class="Polaris-DataTable">
            <div class="Polaris-DataTable__ScrollContainer">
              <table class="Polaris-DataTable__Table">
                <thead>
                  <tr>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Page</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Country</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Redirect to</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Edit</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Preview</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="Polaris-DataTable__TableRow">';

					for( $i=0; $i<count($show_data); $i++ ){
							$external_id=$show_data[$i]->external_id;
					        $page_handle=$show_data[$i]->page_handle;
					        $country_id=$show_data[$i]->country_id;
					        $countryname = DB::table('country')->select('country_name')->where('country_id',$country_id)->get();
                  //echo "<pre>"; print_r($countryname); exit;
	                $country_name=$countryname[0]->country_name;
					        $new_page_handle=$show_data[$i]->custom_url;
							echo '<th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row"><p>'.$page_handle.'</p></th>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><p>'.$country_name.'</p></td>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><p style="text-transform:lowercase;">'.$new_page_handle.'</p></td>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><p class="edit-external" data-old-page="'.$page_handle.'"data-country="'.$country_name.'"data-url="'.$new_page_handle.'"><a href="javascript:void(0)">Edit</a></p></td>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                    <a href="'.$new_page_handle.'" target="popup"><p>view</p></a></td>
                    <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;"><button type="button" onclick="return delete_data_external(\'' . $external_id . '\',\'' . $shop . '\');" class="Polaris-Button delete_icon"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" fill="#000" d="M17 4h-3V2c0-1.103-.897-2-2-2H8C6.897 0 6 .897 6 2v2H3a1 1 0 1 0 0 2v13a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 1 0 0-2zM5 18h10V6H5v12zM8 4h4V2H8v2zm0 12a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1m4 0a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1"></path>
                        </svg>
                    </span></span></button></div></td>';
						echo '</tr>';
						}
                    echo '</tbody>
				</table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';


}

public function delete_data_external(Request $request)
{
  $external_id = $request->external_id; 
  $shop = $request->shop_url;
  DB::table('external_redirect')->where('external_id',$external_id)->where('store_url',$shop)->delete();	
  echo 'delete successfully';
}


public function enable_disable_external(Request $request)
{
  $value = $request->value; 
  $show_data = DB::table('external_redirect')->select('*')->get();

  for( $i=0; $i<count($show_data); $i++ )
  {
		$external_id=$show_data[$i]->external_id;
		DB::table('external_redirect')->where('external_id', $external_id)->update(['external_status' => $value]);

  }

  
  echo 'Saved successfully';
}

/*-------------- End External Redireaction Script----------------------------------------*/



}
?>