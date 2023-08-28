<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
include 'AppController.php';
include 'CurlController.php';

class Announcement_Bar_Setting_Controller extends Controller
{

public function index(Request $request)
{
  $shop = $_GET['shop'];
  $countries =  DB::table('country_price_setting')
    ->select('*')->where(['store_url' => $shop,'country_status' => 1])
    ->join('country','country.country_id','=','country_price_setting.country_id')
    ->get();
  $announcement_bar_status = DB::table('Module')->select('*')->where('store_url',$shop)->first();
  $view_data = [
      'countries'  => $countries,
      'shop' => $shop,
      'announcement_bar_status' => $announcement_bar_status
  ];
   
   return view('announcement_bar_setting')->with($view_data);
	
}

  public function announcement_bar_setting_insert(Request $request)
{
	

	    $name = $request->name;
        $country_id = $request->select_country;
        $message = $request->message;
        $set_goal = $request->set_goal;
        $text_color = $request->text_color;
        $text_style = $request->text_style;
        $background_color = $request->background_color;
        $goal_color = $request->goal_color;
        $letter_spacing = $request->letter_spacing;
        $font_family = $request->font_family;
        $close_button = $request->close_button;
        $font_size = $request->font_size;
        $enable_theme_font = $request->enable_theme_font;
        $bar_position = $request->bar_position;
        $display_bar_based_on_device = $request->display_bar_based_on_device;
        $display_bar_based_on_page = $request->display_bar_based_on_page;
        $store_url = $request->shop; 
        $status = $request->status;
        foreach ($country_id as $countryid) {
        $id=DB::table('announcement_bar_setting')->insertGetId(
	    ['name' =>$name,'country_id' =>$countryid,'message' =>$message,'set_goal' =>$set_goal,'text_color' =>$text_color,'textstyle'=>$text_style,'background_color'=>$background_color,'goal_color'=> $goal_color,'letter_spacing'=>$letter_spacing,'font_family'=>$font_family,'themefont'=>$enable_theme_font,'close_button'=>$close_button,'font_size'=>$font_size,'bar_position' => $bar_position,'display_bar_based_on_device'=>$display_bar_based_on_device,'display_bar_to_specific_country' => "",'display_bar_based_on_page'=>$display_bar_based_on_page,'bar_status'=>$status,'store_url' => $store_url]);
        }
	    
	  echo 'Saved successfully';
	
}
	
	public function show_data_announcement_bar_setting(Request $request)
{
  $shop = $_GET['shop'];
	$show_data = DB::table('announcement_bar_setting')->select('*')->where('store_url',$shop)->get();
   /* print_r($show_data);*/

	echo ' 
  <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
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
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Name</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Status</th>
                    <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col">Action</th>
                   
                    
                  </tr>
                </thead>
                <tbody id="myTable">';

					for( $i=0; $i<count($show_data); $i++ ){
            echo '<tr class="Polaris-DataTable__TableRow">';
							$announcement_bar_id=$show_data[$i]->announcement_bar_id;
					        $name=$show_data[$i]->name;
					        
					       
					        $bar_status=$show_data[$i]->bar_status;
							echo '<th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">'.$name.'</th>';

                if($bar_status=='1'){
                echo '<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                  <p><span class="Polaris-Badge Polaris-Badge--statusSuccess">Active</span></p>
                </td>';
                }
                else{
                  echo '<td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric">
                    <p><span class="Polaris-Badge Polaris-Badge--statusAttention">Inactive</span></p>
                  </td>';
                }

                    
                   echo ' <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric"><div class="Polaris-ButtonGroup Polaris-ButtonGroup--segmented table-action" style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
                   <button type="button" onclick="return edit_announcement_bar(\'' . $announcement_bar_id . '\',\'' . $shop . '\');" class="Polaris-Button Polaris-ButtonGroup__Item edit-btn"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Edit</span></span></button>
                   <button type="button" onclick="return delete_data_announcement_bar(\'' . $announcement_bar_id . '\',\'' . $shop . '\');" class="Polaris-Button Polaris-ButtonGroup__Item delete-btn"><span class="Polaris-Button__Content"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" fill="#000" d="M17 4h-3V2c0-1.103-.897-2-2-2H8C6.897 0 6 .897 6 2v2H3a1 1 0 1 0 0 2v13a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 1 0 0-2zM5 18h10V6H5v12zM8 4h4V2H8v2zm0 12a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1m4 0a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1"></path>
                        </svg></span></button>                  
                   </div></td>';
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

public function edit_announcement_bar(Request $request){
   $announcement_bar_id = $request->announcement_bar_id;
   $shop = $_POST['shop_url'];
   $countries =  DB::table('country_price_setting')
    ->select('*')->where(['store_url' => $shop,'country_status' => 1])
    ->join('country','country.country_id','=','country_price_setting.country_id')
    ->get();
   $announcement_bar_data =  DB::table('announcement_bar_setting')->where(['store_url' => $shop,'announcement_bar_id' => $announcement_bar_id])->first();
   $view_data = [
      'countries'  => $countries,
      'shop' => $shop,
      'announcement_bar_data' => $announcement_bar_data
  ];
   
   echo view('edit_announcement_bar_setting')->with($view_data);

}
public function delete_data_announcement_bar(Request $request)
{
  $announcement_bar_id = $request->announcement_bar_id; 
  DB::table('announcement_bar_setting')->where('announcement_bar_id',$announcement_bar_id)->delete();	
  echo 'delete successfully';
}

public function module_enable_disable_announcement_bar_setting(Request $request)
{
  $value = $request->value; 
  $shop = $request->shop_url;
  DB::table('Module')->update(['announcement_bar' => $value,'store_url' => $shop]);
  echo 'Saved successfully';
}

public function announcement_bar_update(Request $request){
  //echo "<pre>"; print_r($_POST);
  $announcement_bar_id = $_POST['announcement_bar_id'];
  if(isset($_POST['enable_theme_font_edit'])){
    $themefont = $_POST['enable_theme_font_edit'];
  }
  else{
    $themefont = null;
  }
  $bar_data = array(
    'name' =>$_POST['annou_name'],
    'country_id' =>$_POST['select_country'],
    'message' =>$_POST['message'],
    'set_goal' =>$_POST['set_goal'],
    'text_color' =>$_POST['text_color'],
    'textstyle' => $_POST['text_style'],
    'background_color' =>$_POST['background_color'],
    'goal_color'=> $_POST['goal_color'],
    'letter_spacing'=> $_POST['letter_spacing_edit'],
    'font_family'=>$_POST['font_family'],
    'themefont' => $themefont,
    'close_button'=>$_POST['close_button'],
    'font_size'=>$_POST['font_size'],
    'bar_position' => $_POST['bar_position'],
    'display_bar_based_on_device'=>$_POST['display_bar_based_on_device'],
    'display_bar_to_specific_country' => "",
    'display_bar_based_on_page'=>$_POST['display_bar_based_on_page'],
    'bar_status'=>$_POST['enable_bar_status'],
    'store_url' => $_POST['shop_url']
    );
   $validate =  DB::table('announcement_bar_setting')->where(['store_url' => $_POST['shop_url'],'country_id' => $_POST['select_country']])->first();
   if($validate && $validate->announcement_bar_id != $announcement_bar_id){
   	echo 'Country already exist.';
   	return false;
   }
  $id=DB::table('announcement_bar_setting')->where('announcement_bar_id',$announcement_bar_id)->update($bar_data );
      echo 'Saved successfully';
}


}
?>