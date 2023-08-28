@include('shopify_header')


      <div class="Polaris-Page Polaris-Page--narrowWidth whole-cover main-country-module" id="currentpage">
    
      <nav class="Polaris-top-custom-header" aria-label="Pagination">
        <span class="Polaris-Back-Icon">
          <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
            <path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
          </svg>
        </span>

        <div class="custom-heading main-title-head Polaris-DisplayText--sizeMedium mb-10">Set Prices by Country</div>

        <div class="btn-cover right-sec">  
          <div class="Polaris-ButtonGroup">
            <div class="Polaris-ButtonGroup__Item">
              <button type="button" class="Polaris-Button Polaris-Button--destructive">
                <span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Cancel</span></span>
              </button>
            </div>

            <div class="Polaris-ButtonGroup__Item"><button type="button" class="Polaris-Button Polaris-Button--primary"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Save</span></span></button></div>
          </div>
        </div>
      </nav>

      <div class="tab">
        <button class="tablinks"  onclick="open_tab(event, 'General_Setting')">General Settings</button>
        <button class="tablinks" id="country_managment" onclick="open_tab(event, 'Country_Managment')">Country Management</button>
        <button class="tablinks" id="product-pricing-management" onclick="open_tab(event, 'Product_Managment')">Product Management</button>
        <button class="tablinks hide" onclick="open_tab(event, 'Currency_Menu_Customization')">Currency Menu Customization</button>
      </div>

      <input type="hidden" value="<?php echo $data['shop'] ?>"  class="shop_url">

      <div id="General_Setting" class="tabcontent General_Setting">
        <form method="POST">
          <div class="row general-block-wrapper">
            
            <div class="Polaris-Layout custom-flex-cover">
              <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary left-box">
                <div class="Polaris-Cardd same-height-cardd">
                  <div class="Polaris-Card__Header pd-none">
                    <h2 class="Polaris-Heading">Enable Prices by Country</h2>
                  </div>
                  <div class="Polaris-Card__Section pd-none pt-5">
                    <p>Enable or disable prices by country. If disabled, prices will not change based on country.</p>
                  </div>
                </div>
              </div>

              <div class="Polaris-Layout__Section Polaris-Layout__Section--secondaryy right-box">
                <div class="Polaris-Card same-height-card">
                  <div class="Polaris-Card__Section flex-vertical-center-text">
                    <div class="right-block country-price-status-module">
                      <div class="Polaris-Stack Polaris-Stack--vertical">
                        <div class="Polaris-Stack__Item">
                          <div>
                            <div class="enable-desable-text">Enable/Disable</div>
                            <label class="custom-switch">
                              <input type="checkbox" checked>
                              <span class="slider round"></span>
                            </label>
                            <div class="hidden-radio-button" style="display:none;">
                            <label class="Polaris-Choice" for="enable-price"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                              <input id="enable-price" name="enableprice" type="radio" class="Polaris-RadioButton__Input"  value="1" <?php if($data['module_data'][0]->country_price == 1){ echo 'checked';}?>>
                              <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Enable</span>
                            </label>

                            <label class="Polaris-Choice" for="disable-price"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                              <input id="disable-price" name="enableprice" type="radio" class="Polaris-RadioButton__Input"  value="0" <?php if($data['module_data'][0]->country_price == 0){ echo 'checked';}?>>
                              <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Disable</span>
                            </label>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row general-block-wrapper">
            
            <div class="Polaris-Layout custom-flex-cover">
              <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary left-box">
                <div class="Polaris-Cardd same-height-cardd">
                  <div class="Polaris-Card__Header pd-none">
                    <h2 class="Polaris-Heading">Enable nearest round off.</h2>
                  </div>
                  <div class="Polaris-Card__Section pd-none pt-5">
                    <p>It will round prices to its nearest decimal.</p>
                  </div>
                </div>
              </div>

              <div class="Polaris-Layout__Section Polaris-Layout__Section--secondaryy right-box">
                <div class="Polaris-Card same-height-card">
                  <div class="Polaris-Card__Section flex-vertical-center-text">
                    <div class="right-block country-round-status-module">
                      <div class="Polaris-Stack Polaris-Stack--vertical">
                        <div class="Polaris-Stack__Item">
                          <div>
                            <div class="enable-desable-text">Enable/Disable</div>
                            <label class="custom-switch">
                              <input type="checkbox" checked>
                              <span class="slider round"></span>
                            </label>
                            <div class="hidden-radio-button" style="display:none;">
                            <label class="Polaris-Choice" for="enable-price-round"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                              <input id="enable-price-round" name="enablepriceround" type="radio" class="Polaris-RadioButton__Input"  value="1" <?php if($data['module_data'][0]->roundoff == 1){ echo 'checked';}?>>
                              <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Enable</span>
                            </label>

                            <label class="Polaris-Choice" for="disable-price-round"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                              <input id="disable-price-round" name="enablepriceround" type="radio" class="Polaris-RadioButton__Input"  value="0" <?php if($data['module_data'][0]->roundoff == 0){ echo 'checked';}?>>
                              <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Disable</span>
                            </label>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row general-block-wrapper geolocation-module">

            <div class="Polaris-Layout custom-flex-cover">
              <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary left-box">
                <div class="Polaris-Cardd same-height-cardd">
                  <div class="Polaris-Card__Header pd-none">
                    <h2 class="Polaris-Heading">Customer Geo Location</h2>
                  </div>
                  <div class="Polaris-Card__Section pd-none pt-5">
                    <p>You can display the currency based on customer's current location. If this app can't find a suitable match, we will use your default currency.</p>
                  </div>
                </div>
              </div>

              <div class="Polaris-Layout__Section Polaris-Layout__Section--secondaryy right-box">
                <div class="Polaris-Card same-height-card">
                  <div class="Polaris-Card__Section flex-vertical-center-text">
                    <label class="Polaris-Choice" for="geolocation">
                      <span class="Polaris-Choice__Control"><span class="Polaris-Checkbox">
                        <input id="geolocation" type="checkbox" name="geolocation" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value="1" <?php if($data['module_data'][0]->geolocation == 1){ echo 'checked';}?>/><span class="Polaris-Checkbox__Backdrop"></span><span class="Polaris-Checkbox__Icon"><span class="Polaris-Icon">
                          <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                            <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                          </svg>
                        </span></span></span>
                      </span>

                      <span class="Polaris-Choice__Label">Use the customer's location to automatically set the store currency.</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </form>
      </div>

      <div id="Country_Managment" class="tabcontent">
        <form method="POST">
          <div class="row general-block-wrapper">
            
            <div class="Polaris-Layout custom-flex-cover">
              <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary left-box">
                <div class="Polaris-Cardd same-height-cardd">
                  <div class="Polaris-Card__Header pd-left-none pd-top-none">
                    <h2 class="Polaris-Heading">Countries & Currencies</h2>
                  </div>
                  <div class="Polaris-Card__Section pt-5 pd-left-none pd-top-none">
                    <p>Configure which countries & currencies you’d like to display to your customers and how you label them in your selector (i.e. label by currency or country).

                    </p>
                    <p><b>Note:</b> You cannot delete your default currency from here. Please contact support to change your default currency.</p>
                  </div>
                </div>
              </div>

              <div class="Polaris-Layout__Section right-box">
                <div class="Polaris-Card">
                  <div class="Polaris-Card__Section flex-vertical-center-text">
                    <div class="right-block country-price-status-module">
                      <div class="Polaris-Stack Polaris-Stack--vertical">
                       <?php
                            if(!empty($data['shopify_payments_data'])){
                          ?>
                        <div class="Polaris-Stack__Item">
                          <div class="right-borderr country_currency_detail enable-countries">
                          Shopify payment detected. Please <a target="_blank" href="https://<?php echo $data['shop'] ?>/admin/settings/payments/shopify-payments">Click here</a> to add countries.<br/>
                          <i>Please access this section using store owner account.</i>
                        </div>
                        </div>
                        <?php
                          }
                          else{
                            ?>
                              <div class="Polaris-Stack__Item">
                          <div class="right-borderr country_currency_detail enable-countries">
                          Enable Shopify Payments to checkout in your local currency. <a target="_blank" href="https://<?php echo $data['shop'] ?>/admin/settings/payments/shopify-payments">Click here</a> to enable Shopify Payments.
                        </div>
                        </div>
                            <?php
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="Polaris-Card same-height-card">
                  <div class="Polaris-Card__Section flex-vertical-center-text">
                    <div class="right-block country-price-status-module">
                      <div class="Polaris-Stack Polaris-Stack--vertical">

                        <div class="Polaris-Stack__Item">
                          <div class='right-borderr country_currency_detail' id="country-list-backend">

                            <?php 
                            if(isset($data['country_currency']) && !empty($data['country_currency'])){
                            $i = 1;
                            foreach ($data['country_currency'] as $currency) { 
                              if($currency->country_code  !=''){
                                 ?>
                            <div class="enable-countries <?php if($currency->default_country == 1){ echo 'disabled-country';} ?>">

                              <div class="left-part">
                                <h4 class="Polaris-Heading text--uppercase"><?php echo $currency->country_code ?></h4>
                                <?php if($currency->default_country == 1){
                                 $base_currency = $currency->country_currency;
                                 echo '<div class="default-text">Default Country </div>';}
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
                                data-country-id="<?php echo $currency->country_id ?>" data-name="<?php echo $currency->custom_name ?>" data-round-price="<?php echo $currency->custom_rounding_price ?>" data-different-country="<?php  if(!empty($currency->different_country)){echo $currency->different_country;} ?>" data-url="<?php echo $currency->country_url ?>" data-flag="<?php if(!empty($currency->custom_flag)){echo 'https://chaos.chaostheoryhq.com/public/assets/flag_icon/'.$currency->custom_flag; }?>">
                                <span class="Polaris-Button__Content"><span class="Polaris-Button__Text">
                                  Edit
                                </span></span>
                                </button>

                                <button type="button" class="Polaris-Button Polaris-ButtonGroup__Item delete-btn delete_country_price delete_icon" data-country-id="<?php echo $currency->country_id ?>"><span class="Polaris-Button__Content" >
                                  <span class="Polaris-Button__Text">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" fill="#000" d="M17 4h-3V2c0-1.103-.897-2-2-2H8C6.897 0 6 .897 6 2v2H3a1 1 0 1 0 0 2v13a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 1 0 0-2zM5 18h10V6H5v12zM8 4h4V2H8v2zm0 12a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1m4 0a1 1 0 0 0 1-1V9a1 1 0 1 0-2 0v6a1 1 0 0 0 1 1"></path>
                                  </svg>
                                </span></span>
                                </button>
                              </div>
                              </div>
                            </div>
                            <?php $i++;} } } ?>

                          </div>
                          <?php
                            if(empty($data['shopify_payments_data'])){
                          ?>
                          <button type="button" class="Polaris-Button Polaris-Button--primary add_currency trigger-modal" 
                            data-target="currency_insert_modal">
                            <span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Add Country</span></span>
                          </button>
                           <?php
                            }
                            else{
                              ?>
                              <button type="button" class="Polaris-Button Polaris-Button--primary add_currency trigger-modal" 
                            data-target="currency_insert_modal">
                            <span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Add Country</span></span>
                          </button>
                              <?php
                            }
                           ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div id="Product_Managment" class="tabcontent">
        <div class="full-section-content mb-20">
          <div class="Polaris-Card same-height-card">
            <div class="Polaris-Card__Header">
              <h2 class="Polaris-Heading">Enter Prices by Country</h2>
            </div>
            <div class="Polaris-Card__Section pt-5">
              <p>Enter & manage the custom prices that you’d like to display for each product in each country.</p>
            </div>
          </div>
        </div>

        <div class="Polaris-Connected__Item Polaris-Connected__Item--primary mb-20">
            <div class="Polaris-TextField">
              <div class="Polaris-TextField__Prefix" id="PolarisTextField2Prefix">
                <span class="Polaris-Icon Polaris-Icon--colorInkLighter Polaris-Icon--isColored">
                  <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                    <path d="M8 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8m9.707 4.293l-4.82-4.82A5.968 5.968 0 0 0 14 8 6 6 0 0 0 2 8a6 6 0 0 0 6 6 5.968 5.968 0 0 0 3.473-1.113l4.82 4.82a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414" fill-rule="evenodd"></path>
                  </svg>
                </span>
              </div>
              <input id="product_search" placeholder="Search" autocomplete="off" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField2Label PolarisTextField2Prefix" aria-invalid="false" aria-autocomplete="list" aria-multiline="false" value="" tabindex="0" aria-controls="Polarispopover2" aria-owns="Polarispopover2" aria-expanded="false">
              <div class="Polaris-TextField__Backdrop"></div>
            </div>
        </div>

          <div class="products-wrapper">
            <div class="top-btn-wrapper">
              <button type="button" class="Polaris-Button Polaris-Button--primary add-all-variant"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Save All</span></span>
                        </button>
                        <span class="delete_icon">
                        <button class="Polaris-Button reset-all-variant" type="button">
                        <span class="Polaris-Button__Content">
                          <span class="Polaris-Button__Text">
                           Reset All
                          </span>
                        </span>
                      </button>
                    </span>
            </div>
            <?php 
             if(!empty($data['products'])){
              $original_product_data = $data['products'];
     
               for($i=0;$i<sizeof($data['products']);$i++)
                {
                  $hascountry = false;
                  $total_options = sizeof($data['products'][$i]['options']);
                  for($j=0;$j<$total_options;$j++){
                    if($data['products'][$i]['options'][$j]['name'] == 'Country'){
                      $hascountry = true;
                    }
                  }
                  ?>
                <form method="post" class="individual-form-part" id="form-<?php echo $data['products'][$i]['id'] ?>">
               
                <input type="hidden" data-token="<?php echo $data['access_token'] ?>"  class="access_token">
                <div class="inner_product_wrapper" data-title="<?php echo $data['products'][$i]['title']; ?>">

                  <div class="product-head-wrapper">
                    <div class="product-image">
                      <?php
                      if($data['products'][$i]['image'] != null && $data['products'][$i]['image'] != '' && !empty($data['products'][$i]['image'])){
                        ?>
                        <img src="<?php print_r($data['products'][$i]['image']['src'])?>"/>
                        <?php
                      }
                      ?>
                      
                      <div class="product-title"><?php echo $data['products'][$i]['title']; ?></div>
                    </div>

                    <div class="add_variant_cover Polaris-ButtonGroup__Item">
                      <button type="button" class="Polaris-Button Polaris-Button--primary add_variant" data-id="<?php echo $data['products'][$i]['id'] ?>"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Save</span></span>
                      </button>
                    </div>

                    <div class="delete_icon delete-product" data-id="<?php echo $data['products'][$i]['id'] ?>">
                      <button class="Polaris-Button" type="button">
                        <span class="Polaris-Button__Content">
                          <span class="Polaris-Button__Text">
                            <svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17 9a1 1 0 01-1-1c0-.551-.448-1-1-1H5.414l1.293 1.293a.999.999 0 11-1.414 1.414l-3-3a.999.999 0 010-1.414l3-3a.997.997 0 011.414 0 .999.999 0 010 1.414L5.414 5H15c1.654 0 3 1.346 3 3a1 1 0 01-1 1zM3 11a1 1 0 011 1c0 .551.448 1 1 1h9.586l-1.293-1.293a.999.999 0 111.414-1.414l3 3a.999.999 0 010 1.414l-3 3a.999.999 0 11-1.414-1.414L14.586 15H5c-1.654 0-3-1.346-3-3a1 1 0 011-1z" fill="#000"></svg>
                          </span>
                        </span>
                      </button>
                      </svg>
                    </div>
                  </div> 

                  <div class="Polaris-DataTable product-table">
                    <div class="Polaris-DataTable__ScrollContainer">
                      <table class="Polaris-DataTable__Table">
                        <thead>
                          <tr>
                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn Polaris-DataTable__Cell--header" scope="col">Variants</th>
                            <?php if(isset($data['country_currency']) && !empty($data['country_currency'])){ foreach ($data['country_currency'] as $currency) {  
                              if($currency->country_code != ''){
                                $different_currency_id = $currency->different_country;
                              //echo "<pre>"; print_r($data['country']); 
                                 $different_currency_code = null;
                              if(!empty($different_currency_id)){
                               
                               foreach ($data['country'] as $original_country){
                                if($original_country->country_id == $different_currency_id){
                                   $different_currency_code = $original_country->country_currency;
                                 break;
                                }
                               }
                              }
                              ?>
                            <th data-polaris-header-cell="true" class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--header Polaris-DataTable__Cell--numeric" scope="col" <?php if ($currency->default_country == 1){ ?>style="display: none;"<?php }?>><?php echo $currency->country_code ?>
                              <?php
                                if(!empty($different_currency_code)){
                                  echo '<span class="variant-currency">('.$different_currency_code.')</span>';
                                }
                                else{
                                   echo '<span class="variant-currency">('.$currency->country_currency.')</span>';
                                }
                              ?>
                            </th>
                            <?php } } } ?>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $product_id = $data['products'][$i]['id'];
                          // $variant_url = "https://".$data['shop']."/admin/api/2020-07/products/".$product_id."/variants.json";
                          // $variant_data_get = $data['curl_controller']->curl_get_fun($variant_url,$data['access_token']);
                          $variant_data = $data['products'][$i]['variants'];
                        if($hascountry){

                          // if country option exist
                          $variant_title_array = [];
                          $variant_sku_array = [];
                          foreach ($variant_data as $variant){
                            array_push($variant_title_array,substr($variant['title'], 0,strrpos($variant['title'], ' / ')));
                            array_push($variant_sku_array,$variant['sku']);
                          }
                         $variant_title_array_unique = array_values(array_unique($variant_title_array));
                         $variant_sku_array_unique = array_values(array_unique($variant_sku_array));
                         for($v=0;$v<sizeof($variant_title_array_unique);$v++){
                          ?>
                          <tr class="Polaris-DataTable__TableRow">
                            <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">
                              <?php echo $variant_title_array_unique[$v]; ?>
                               <div>SKU: <?php echo $variant_sku_array_unique[$v]; ?></div>
                            </th>
                            <?php
                            foreach ($data['country_currency'] as $key => $currency) {
                            if($currency->country_code != ''){
                              $currency_variant_exist = false;
                              $normal_price = '';
                              $compare_price = '';
                              foreach ($variant_data as $variant){
                                if($variant['title'] == $variant_title_array_unique[$v].' / '.$currency->country_code ){
                                	
                  $different_currency_id = $currency->different_country;
                  //echo "<pre>"; print_r($data['country']); 
                  $different_currency_code = null;
                  if(!empty($different_currency_id)){
                     
                   foreach ($data['country'] as $original_country){
                    if($original_country->country_id == $different_currency_id){
                       $different_currency_code = $original_country->country_currency;
                     break;
                    }
                   }
                   $currency->country_currency = $different_currency_code;  
                  }
                                  $currency_variant_exist = true;
                                  if(!empty($currency->custom_rounding_price)){
                    
                    $normal_price = round(($variant['price'] * $data['conversion_data'][$base_currency])/$currency->custom_rounding_price, 2);
                  }
                  else{
                    $normal_price = round(($variant['price'] * $data['conversion_data'][$base_currency])/$data['conversion_data'][$currency->country_currency], 2);
                  }
                                      
                                   
                                        if($variant['compare_at_price'] != '' && $variant['compare_at_price'] != null){
                                          if(!empty($currency->custom_rounding_price)){
                                            $compare_price = round(($variant['compare_at_price'] * $data['conversion_data'][$base_currency])/$currency->custom_rounding_price, 2);
                                          }
                                          else{
                                            $compare_price = round(($variant['compare_at_price'] * $data['conversion_data'][$base_currency])/$data['conversion_data'][$currency->country_currency], 2);
                                          }
                                        
                                      }
                                      else{
                                        $compare_price='';
                                      }
                      
                                ?>
                                <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric" <?php if ($currency->default_country == 1){ ?>style="display: none;"<?php }?>>
                                  
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label"><label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Price:</label>
                                    </div>
                                  </div>

                                  <div class="Polaris-Connected">
                                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                                        <input id="" class="Polaris-TextField__Input <?php if ($currency->default_country != 1){ ?> normal-price <?php  }?>" type="text" name="price_<?php echo $variant['title']; ?>" value="<?php echo $normal_price;?>">
                                        <div class="Polaris-TextField__Backdrop"></div>
                                      </div>
                                    </div>
                                  </div>
                                 
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label"><label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Compare Price:</label>
                                    </div>
                                  </div>

                                  <div class="Polaris-Connected">
                                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                                        <input id="" class="Polaris-TextField__Input compare-price" type="text" name="compareprice_<?php echo $variant['title'] ?>" value="<?php echo $compare_price;?>">
                                        <div class="Polaris-TextField__Backdrop"></div>
                                      </div>
                                    </div>
                                  </div>

                                </td>
                                <?php
                              }

                            }
                         
                                if(!$currency_variant_exist){
                                ?>
                                 <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric" <?php if ($currency->default_country == 1){ ?>style="display: none;"<?php }?>>
                                  
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label"><label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Price:</label>
                                    </div>
                                  </div>

                                  <div class="Polaris-Connected">
                                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                                        <input id="" class="Polaris-TextField__Input <?php if ($currency->default_country != 1){ ?> normal-price <?php  }?>" type="number" name="price_<?php echo $variant_title_array_unique[$v]; ?> / <?php echo $currency->country_code ?>" value="<?php echo $normal_price;?>">
                                        <div class="Polaris-TextField__Backdrop"></div>
                                      </div>
                                    </div>
                                  </div>
                                 
                                  <div class="Polaris-Labelled__LabelWrapper">
                                    <div class="Polaris-Label"><label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Compare Price:</label>
                                    </div>
                                  </div>

                                  <div class="Polaris-Connected">
                                    <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                      <div class="Polaris-TextField Polaris-TextField--hasValue">
                                        <input id="" class="Polaris-TextField__Input compare-price" type="text" name="compareprice_<?php echo $variant['title'] ?> / <?php echo $currency->country_code ?>" value="<?php echo $compare_price;?>">
                                        <div class="Polaris-TextField__Backdrop"></div>
                                      </div>
                                    </div>
                                  </div>

                                </td>
                                <?php
                              }
                            }
                          }
                          ?>
                        </tr>
                        <?php
                         }
                        }
                        else{
                          // if country option not exist
                          foreach ($variant_data as $variant) {
                            ?>
                            <tr class="Polaris-DataTable__TableRow">
                            <th class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--firstColumn" scope="row">
                            <?php echo $variant['title'] ?>
                            <div>SKU: <?php echo $variant['sku'] ?></div>
                            </th>
                            <?php if(isset($data['country_currency']) && !empty($data['country_currency'])){ foreach ($data['country_currency'] as $key => $currency) { 
                      if($currency->country_code != ''){
                             ?>

                            <td class="Polaris-DataTable__Cell Polaris-DataTable__Cell--verticalAlignTop Polaris-DataTable__Cell--numeric" <?php if ($currency->default_country == 1){ ?>style="display: none;"<?php }?>>

                              <div class="Polaris-Labelled__LabelWrapper">
                                <div class="Polaris-Label">
                                  <label id="" for="PolarisTextField8" class="Polaris-Label__Text">Price:</label>
                                </div>
                              </div>

                              <div class="Polaris-Connected">
                                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                  <div class="Polaris-TextField Polaris-TextField--hasValue">
                                    <input type="text" class="Polaris-TextField__Input <?php if ($currency->default_country != 1){ ?> normal-price <?php  }?>" name="price_<?php echo $variant['title'] ?> / <?php echo $currency->country_code ?>">
                                    <div class="Polaris-TextField__Backdrop"></div>
                                  </div>
                                </div>
                              </div>
                             
                              <div class="Polaris-Labelled__LabelWrapper">
                                <div class="Polaris-Label"><label id="PolarisTextField8Label" for="PolarisTextField8" class="Polaris-Label__Text">Compare Price:</label>
                                </div>
                              </div>

                              <div class="Polaris-Connected">
                                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                  <div class="Polaris-TextField Polaris-TextField--hasValue">
                                    <input type="text" class="Polaris-TextField__Input compare-price" name="compareprice_<?php echo $variant['title'] ?> / <?php echo $currency->country_code ?>">
                                    <div class="Polaris-TextField__Backdrop"></div>
                                  </div>
                                </div>
                              </div>

                            </td>
                            <?php } } } ?>
                          </tr>
                            <?php
                          }
                        }
                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>

                </form>
                <?php
               

                  }

                }
                ?>

              </div>
              <?php
              if(!empty($data['next_page_token']))
              {

              ?>
              <div class="load-more-wrapper">
              <div class="load-more-btn Polaris-Button Polaris-Button--primary" data-total-products="<?php echo $data['product_count'];?>" data-target-token="<?php echo $data['next_page_token']; ?>">Load More</div>
            </div>
            <?php
              }
            ?>

      </div>

      <div id="Currency_Menu_Customization" class="tabcontent">
        <div class="form-wrapper">
          <div class="form-inner-wrapper">
            <form method="POST" id="country-design-form">
              <div class="Polaris-Layout">

                <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary">
                  <div class="Polaris-Cardd">
                    <div class="Polaris-Card__Sectionn">
                      <h2 class="Polaris-Heading">Menu Display Settings</h2>
                      <p>The display settings allow you to fully customize the look, style, and placement of your currency selector in order to match your website's branding.</p>
                    </div>
                  </div>
                </div>

                <div class="Polaris-Layout__Section">
                  <div class="Polaris-Card">
                    <div class="Polaris-Card__Section bar-flex-cover">

                      <div class="Polaris-Cardd custom_card_section for-font-choose">
                        <div class="Polaris-Card__Sectionn">
                          <div class="fields-wrapper">
                            <div class="label-text">
                              <h2 class="Polaris-Heading">Font Family</h2>
                              <p>Choose what font will be used for the menu text.</p>
                            </div>

                            <div class="input-field-wrapper Polaris-Card">
                              <label class="Polaris-Choice" for="enable_theme_font">
                                <span class="Polaris-Choice__Control"><span class="Polaris-Checkbox">
                                  <input type="checkbox" name="enable_theme_font" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value="true" <?php if(!empty($data['design_data']) && $data['design_data']->themefont == 'true'){echo 'checked';}?> id="enable_theme_font"/><span class="Polaris-Checkbox__Backdrop"></span><span class="Polaris-Checkbox__Icon"><span class="Polaris-Icon">
                                    <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                      <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                    </svg>
                                  </span></span></span>
                                </span>

                                <span class="Polaris-Choice__Label">Enable theme's font</span>
                              </label>

                              <!-- <label for="enable_theme_font">
                                <input type="checkbox" name="enable_theme_font" value="true" <?php if(!empty($data['design_data']) && $data['design_data']->themefont == 'true'){echo 'checked';}?> id="enable_theme_font"/>
                                <span>Enable theme's font</span>
                              </label> -->
                              <br/>
                              <input class="google-font-selector-country" type="text" name="fontfamily" value="<?php if(!empty($data['design_data'])){echo $data['design_data']->fontfamily;}?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="Polaris-Cardd custom_card_section">
                        <div class="Polaris-Card__Sectionn">
                          <div class="fields-wrapper cover-box">
                            <div class="label-text">
                              <h2 class="Polaris-Heading">Text Style</h2>
                              <p>Choose what style will be used in storefront i.e Uppercase/Lowercase/Normal</p>
                            </div>
                            
                            <div class="input-field-wrapper Polaris-Card">
                            <div class="Polaris-Select">
                                <select id="select_text_style" name="textStyle" class="Polaris-Select__Input" aria-invalid="false">
                                  <option value="uppercase" <?php if(!empty($data['design_data']) && $data['design_data']->textstyle == 'uppercase'){ echo 'selected="seleted"';}?>>Uppercase</option>
                                  <option value="lowercase"  <?php if(!empty($data['design_data']) && $data['design_data']->textstyle == 'lowercase'){ echo 'selected="seleted"';}?>>Lowercase</option>
                                  <option value="normal" <?php if(!empty($data['design_data']) && $data['design_data']->textstyle == 'normal'){ echo 'selected="seleted"';}?>>Normal</option>
                            </select>
                              <div class="Polaris-Select__Content" aria-hidden="true">
                                <span class="Polaris-Select__SelectedOption">Choose a option</span>
                                  <span class="Polaris-Select__Icon"><span class="Polaris-Icon">
                                    <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                      <path d="M10 16l-4-4h8l-4 4zm0-12l4 4H6l4-4z"></path>
                                    </svg>
                                  </span>
                                </span>
                              </div>
                               <div class="Polaris-Select__Backdrop"></div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="Polaris-Cardd custom_card_section Polaris-range-special hide">
                        <div class="Polaris-Card__Sectionn">
                          <div class="fields-wrapper">
                            <div class="label-text">
                              <h2 class="Polaris-Heading">Left Padding</h2>
                            </div>
                            <div class="input-field-wrapper Polaris-Card">
                              <input type="range" min="0" max="100" onchange="updateTextInput(this.value);" value="<?php if(!empty($data['design_data']) && $data['design_data']->paddingleft != null){echo $data['design_data']->paddingleft;} else{ echo 0;}?>"class="slider" id="rangeslider"name="paddingleft"><span id="rangevalue"><?php if(!empty($data['design_data']) && $data['design_data']->paddingleft != null){echo $data['design_data']->paddingleft;} else{ echo 0;}?></span> %
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="Polaris-Cardd custom_card_section Polaris-range-special top-padding-range hide">
                        <div class="Polaris-Card__Sectionn">
                          <div class="fields-wrapper">
                            <div class="label-text">
                              <h2 class="Polaris-Heading">Top Padding</h2>
                            </div>
                            <div class="input-field-wrapper Polaris-Card">
                              <input type="range" min="0" max="100" onchange="updateTextInputTop(this.value);" value="<?php if(!empty($data['design_data']) && $data['design_data']->paddingtop != null){echo $data['design_data']->paddingtop;} else{ echo 0;}?>"class="slider" id="rangeslidertop"name="paddingtop"><span id="rangevaluepaddingtop"><?php if(!empty($data['design_data']) && $data['design_data']->paddingtop != null){echo $data['design_data']->paddingtop;} else{ echo 0;}?></span> %
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="Polaris-Cardd custom_card_section Polaris-range-special">
                        <div class="Polaris-Card__Sectionn">
                          <div class="fields-wrapper">
                            <div class="label-text">
                              <h2 class="Polaris-Heading">Font Weight</h2>
                            </div>
                            <div class="input-field-wrapper Polaris-Card">
                              <input type="range" min="100" max="800" step="100" onchange="updateTextWeight(this.value);" value="<?php if(!empty($data['design_data']) && $data['design_data']->fontweight != null){echo $data['design_data']->fontweight;} else{ echo 500;}?>"class="slider" id="rangesliderWeight"name="fontweight"><span id="rangevalueWeight"><?php if(!empty($data['design_data']) && $data['design_data']->fontweight != null){echo $data['design_data']->fontweight;} else{ echo 500;}?></span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="Polaris-Cardd custom_card_section">
                        <div class="Polaris-Card__Sectionn">
                          <div class="fields-wrapper">
                            <div class="label-text">
                              <h2 class="Polaris-Heading">Font Color</h2>
                            </div>
                            <div class="input-field-wrapper Polaris-Card">
                              <input class="fontcolor" type="color" name="fontcolor" value="<?php if(!empty($data['design_data'])){echo $data['design_data']->fontcolor;}?>">
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="Polaris-Cardd custom_card_section">
                        <div class="Polaris-Card__Sectionn">
                          <div class="fields-wrapper">
                            <div class="label-text">
                              <h2 class="Polaris-Heading">Font Size</h2>
                            </div>
                            <div class="input-field-wrapper Polaris-Card">

                            <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                <div class="Polaris-TextField Polaris-TextField--hasValue"><input id="PolarisTextField4" class="Polaris-TextField__Input" type="text" class="fontsize" name="fontsize"aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" value="<?php if(!empty($data['design_data'])){echo $data['design_data']->fontsize;}else{ echo 14;}?>"><span class="units">px</span>
                                </div>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="Polaris-Cardd custom_card_section">
                        <div class="Polaris-Card__Sectionn">
                          <div class="fields-wrapper">
                            <div class="label-text">
                              <h2 class="Polaris-Heading">Letter Spacing</h2>
                            </div>
                            <div class="input-field-wrapper Polaris-Card">
                            <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                <div class="Polaris-TextField Polaris-TextField--hasValue"><input id="PolarisTextField4" class="Polaris-TextField__Input" type="text" class="letterspacing" name="letterspacing"aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" value="<?php if(!empty($data['design_data'])){echo $data['design_data']->letterspacing;} else{ echo 1;}?>"><span class="units">px</span>
                                </div>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="Polaris-Cardd custom_card_section">
                        <div class="Polaris-Card__Sectionn">
                          <div class="fields-wrapper">
                            <div class="label-text">
                              <h2 class="Polaris-Heading">Show/Hide Flag</h2>
                              <p>Choose whether you want to display a flag or not in your currency selector.</p>
                            </div>

                            <div class="input-field-wrapper Polaris-Card">
                              <div class="enable-desable-text">Enable/Disable</div>
                              <label class="custom-switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                              </label>

                              <div class="hidden-radio-button" style="display:none;">
                              <label class="Polaris-Choice" for="enable-flag">
                                <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                                <input id="enable-flag" type="radio" class="Polaris-RadioButton__Input" name="enableflag" value="1" <?php if(!empty($data['design_data'])){if($data['design_data']->enableflag == 1){ echo 'checked';}}?>>
                                <span class="Polaris-RadioButton__Backdrop"></span>
                                <span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Enable</span>
                              </label>

                              <label class="Polaris-Choice" for="disable-flag">
                                <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                                <input id="disable-flag" type="radio" class="Polaris-RadioButton__Input " name="enableflag" value="0" <?php if(!empty($data['design_data'])){if($data['design_data']->enableflag == 0){ echo 'checked';}} else{ echo 'checked';}?>>
                                <span class="Polaris-RadioButton__Backdrop"></span>
                                <span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Disable</span>
                              </label>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="Polaris-Cardd custom_card_section hide">
                        <div class="Polaris-Card__Sectionn">
                          <div class="fields-wrapper">
                            <div class="label-text">
                              <h2 class="Polaris-Heading">Menu Placement</h2>
                              <p>Select where the currency selector will be displayed on your store.</p>
                            </div>
                            <div class="input-field-wrapper Polaris-Card">
                              <p class="field-heading mb-15 hide">Choose the placement of the currency picker.</p>
                              <div class="preview-main-wrapper">
                               <div class="preview-wrapper <?php if(!empty($data['design_data'])){if($data['design_data']->position == 'up'){ echo 'header';}} ?> mb-15">
                                 <?php if(isset($data['country_currency']) && !empty($data['country_currency'])){
                                  foreach ($data['country_currency'] as $currency) {
                                    if($currency->default_country == 1){
                                    ?>
                                 <img src="{{ URL::asset('public/assets/default_flag_icon') }}/<?php echo $currency->country_code;?>.svg"/>
                                 <?php
                                   }
                                 }
                               }
                                 ?>
                               </div>

                              <div class="options-wrapper">
                                <label class="Polaris-Choice" for="selector-down">
                                  <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                                  <input id="selector-down" type="radio" class="Polaris-RadioButton__Input " name="position" value="down" <?php if(!empty($data['design_data'])){if($data['design_data']->position == 'down'){ echo 'checked';} } else{ echo 'checked';}?>>
                                  <span class="Polaris-RadioButton__Backdrop"></span>
                                  <span class="Polaris-RadioButton__Icon"></span></span></span>
                                  <span class="Polaris-Choice__Label">Footer</span>
                                </label>

                                <label class="Polaris-Choice" for="selector-up">
                                  <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                                  <input id="selector-up" type="radio" class="Polaris-RadioButton__Input " name="position" value="up"  <?php if(!empty($data['design_data'])){if($data['design_data']->position == 'up'){ echo 'checked';}} ?>>
                                  <span class="Polaris-RadioButton__Backdrop"></span>
                                  <span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Header</span>
                                </label>
                               </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </form>
          </div>

          <div class="Polaris-Layout mt-20">
            <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary mobile-hide">
              <div class="Polaris-Cardd footer-save-btn hidden">
                <div class="Polaris-Card__Sectionn">
                  <h2 class="Polaris-Heading">Menu Display Settings</h2>
                </div>
              </div>
            </div>

            <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary">
              <div class="Polaris-Cardd">
                <div class="save-btn-wrapper text--right">
                  <button class="save-button Polaris-Button Polaris-Button--primary" data-target="country-design-form">
                    <span class="Polaris-Button__Content">
                      <span class="Polaris-Button__Text">Save</span>
                    </span>
                  </button>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>


      <!-- //  start Currencies Modal Setting// -->


      <!-- The Modal -->
      <div id="setting_currency_modal" class="modal">
       <!-- Modal content -->
        <div>
          <form action="" method="POST" enctype="multipart/form-data">
            <div class="Polaris-Modal-Dialog__Container" data-polaris-layer="true" data-polaris-overlay="true">
              <div>
                <div role="dialog" aria-labelledby="Polarismodal-header4" tabindex="-1" class="Polaris-Modal-Dialog">
                  <div class="Polaris-Modal-Dialog__Modal">
                    <div class="Polaris-Modal-Header">
                      <div id="Polarismodal-header4" class="Polaris-Modal-Header__Title">
                        <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall">Custom Settings</h2>
                      </div><button class="Polaris-Modal-CloseButton" aria-label="Close"><span class="Polaris-Icon Polaris-Icon--colorInkLighter Polaris-Icon--isColored"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                            <path d="M11.414 10l6.293-6.293a.999.999 0 1 0-1.414-1.414L10 8.586 3.707 2.293a.999.999 0 1 0-1.414 1.414L8.586 10l-6.293 6.293a.999.999 0 1 0 1.414 1.414L10 11.414l6.293 6.293a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L11.414 10z" fill-rule="evenodd"></path>
                          </svg></span></button>
                    </div>
                    <div class="Polaris-Modal__BodyWrapper">
                      <div class="Polaris-Modal__Body Polaris-Scrollable Polaris-Scrollable--vertical" data-polaris-scrollable="true">
                        <section class="Polaris-Modal-Section">
                          <div class="Polaris-Stack Polaris-Stack--vertical">
                            <div class="Polaris-Stack__Item">
                            	
          					<div class="Polaris-FormLayout">
          					    <div class="Polaris-FormLayout__Item">
          					      <div class="">
          					        <div class="Polaris-Labelled__LabelWrapper">
          					          <div class="Polaris-Label"><label id="PolarisTextField3Label" for="PolarisTextField3" class="Polaris-Label__Text" >Custom Name:</label></div>

                               <input type="hidden" name="country_id" id="country_id"/>
          					        </div>
          					        <div class="Polaris-Connected">
          					          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
          					            <div class="Polaris-TextField"><input id="custom_name" class="Polaris-TextField__Input" aria-labelledby="custom_nameLabel" name="custom_name" aria-invalid="false" aria-multiline="false" value="" required>
          					              <div class="Polaris-TextField__Backdrop"></div>
          					            </div>
          					          </div>
          					        </div>
          					      </div>
          					    </div>
          					    <div class="Polaris-FormLayout__Item hide">
          					      <div class="">
          					        <div class="Polaris-Labelled__LabelWrapper">
          					          <div class="Polaris-Label"><label id="PolarisTextField3Label_rounding" for="PolarisTextField3_rounding" class="Polaris-Label__Text" >Manual conversion rate:</label></div>
          					        </div>
          					        <div class="Polaris-Connected">
          					          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
          					            <div class="Polaris-TextField"><input id="custom_rounding_price" class="Polaris-TextField__Input" aria-labelledby="custom_nameLabel" name="custom_rounding_price" type="number" aria-invalid="false" aria-multiline="false" value="" required>
          					              <div class="Polaris-TextField__Backdrop"></div>
          					            </div>
          					          </div>
          					        </div>
          					      </div>
          					    </div>
          					    <div class="Polaris-FormLayout__Item hide">
          					      <div class="">
          					        <div class="Polaris-Labelled__LabelWrapper">
          					          <div class="Polaris-Label"><label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Custom URL:</label></div>
          					        </div>
          					        <div class="Polaris-Connected">
          					          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
          					            <div class="Polaris-TextField"><input id="custom_url" name="custom_url" class="Polaris-TextField__Input" type="text" aria-labelledby="custom_urlLabel" aria-invalid="false" aria-multiline="false" value="" required>
          					              <div class="Polaris-TextField__Backdrop"></div>
          					            </div>
          					          </div>
          					        </div>
          					      </div>
          					    </div>
                        <div class="Polaris-FormLayout__Item">
                          <div class="">
                            <div class="Polaris-Labelled__LabelWrapper">
                              <div class="Polaris-Label"><label id="PolarisTextField4diffrvurrency" for="PolarisTextField5" class="Polaris-Label__Text">Different Currency</label></div>
                            </div>
                            <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                            <select data-placeholder="Choose a Country..." class="chosen-select-country input_currency" id="custom_country" name="custom_country" tabindex="4" >
                            <option value=""></option>

                            <?php 
                          if(isset($data['country_currency']) && !empty($data['country_currency'])){
                            $i = 1;
                            foreach ($data['country_currency'] as $country) { 
                              if($country->country_code  !=''){
                                ?>
                            <option value="<?php echo $country->country_id ?>"><?php echo $country->country_name?></option>
                            <?php } } } ?>
                        </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="Polaris-FormLayout__Item custom-flag-wrapper">
                          <div class="">
                            <div class="Polaris-Labelled__LabelWrapper">
                              <div class="Polaris-Label"><label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Upload Custom Flag:</label></div>
                            </div>

                            <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                <div class="Polaris-TextField"><input id="custom_flag" name="custom_flag" class="Polaris-TextField__Input" type="file" value="">
                                 <div class="custom-flag-image"></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
          					  </div>
                            	
                            </div>
                          </div>
                        </section>
                      </div>
                    </div>
                    <div class="Polaris-Modal-Footer">
                      <div class="Polaris-Modal-Footer__FooterContent">
                        <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
                          <div class="Polaris-Stack__Item Polaris-Stack__Item--fill"></div>
                          <div class="Polaris-Stack__Item">
                            <div class="Polaris-ButtonGroup">
                              <div class="Polaris-ButtonGroup__Item"><button type="button" class="Polaris-Button"><span class="Polaris-Button__Content popup-close"><span class="Polaris-Button__Text">Cancel</span></span></button></div>
                              <div class="Polaris-ButtonGroup__Item"><button type="button" class="Polaris-Button Polaris-Button--primary add_custom_title setting_country_update" ><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Save</span></span></button></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="Polaris-Backdrop"></div>
      </div>
       <!-- Modal content -->

      <div id="currency_insert_modal" class="modal">
        <form  action="" method="POST">
        	<div>
            <div class="Polaris-Modal-Dialog__Container" data-polaris-layer="true" data-polaris-overlay="true">
              <div>
                <div role="dialog" aria-labelledby="Polarismodal-header4" tabindex="-1" class="Polaris-Modal-Dialog">
                  <div class="Polaris-Modal-Dialog__Modal">
                    <div class="Polaris-Modal-Header">
                      <div id="Polarismodal-header4" class="Polaris-Modal-Header__Title">
                        <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall">Add Country</h2>
                      </div><button class="Polaris-Modal-CloseButton" aria-label="Close"><span class="Polaris-Icon Polaris-Icon--colorInkLighter Polaris-Icon--isColored"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                            <path d="M11.414 10l6.293-6.293a.999.999 0 1 0-1.414-1.414L10 8.586 3.707 2.293a.999.999 0 1 0-1.414 1.414L8.586 10l-6.293 6.293a.999.999 0 1 0 1.414 1.414L10 11.414l6.293 6.293a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L11.414 10z" fill-rule="evenodd"></path>
                          </svg></span></button>
                    </div>
                    <div class="Polaris-Modal__BodyWrapper">
                      <div class="Polaris-Modal__Body Polaris-Scrollable Polaris-Scrollable--vertical" data-polaris-scrollable="true">
                        <section class="Polaris-Modal-Section">
                          <div class="Polaris-Stack Polaris-Stack--vertical">
                            <div class="Polaris-Stack__Item">
                            	
          					      		<div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;">
          					<div style="height: 225px;">
          					<div role="combobox" aria-expanded="false" aria-owns="PolarisComboBox2" aria-controls="PolarisComboBox2" aria-haspopup="true" tabindex="0">
          					<div class="Polaris-Connected">

          					<div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
          					    <div class="Polaris-Select">
                          <input type="hidden" value="<?php echo $data['shop'] ?>"  class="shop_url_2">
                    <input type="hidden" value="<?php echo $data['access_token'] ?>"  class="access_token">
                        <select data-placeholder="Choose a Country..." class="chosen-select-country input_currency" id="country" name="country" tabindex="4" >
                            <option value=""></option>
                            <?php  foreach ($data['country'] as $country) {
                              $found = false;
                          if(isset($data['country_currency']) && !empty($data['country_currency'])){
                                $i = 1;
                                foreach ($data['country_currency'] as $enabledcountry) { 
                                  if($enabledcountry->country_id  == $country->country_id ){
                                    $found = true;
                                  }
                                }
                              }
                             ?>

                            <option value="<?php echo $country->country_id ?>" <?php if($found){ echo 'disabled';}?>><?php echo $country->country_name?></option>
                            <?php } ?>
                        </select>
                            </div>
                            <!-- <input id="country" placeholder="eg. CAD" autocomplete="off" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField2Label PolarisTextField2Prefix" aria-invalid="false" aria-autocomplete="list" aria-multiline="false" value="sxs" name="country" tabindex="0" aria-controls="Polarispopover2" class="input_currency" aria-owns="Polarispopover2" aria-expanded="false"> -->
          					     </div>
          					</div>
          					</div>
          					</div>
          					</div>

                            
                            </div>
                          </div>
                        </section>
                      </div>
                    </div>
                    <div class="Polaris-Modal-Footer">
                      <div class="Polaris-Modal-Footer__FooterContent">
                        <div class="Polaris-Stack Polaris-Stack--alignmentCenter">
                          <div class="Polaris-Stack__Item Polaris-Stack__Item--fill"></div>
                          <div class="Polaris-Stack__Item">
                            <div class="Polaris-ButtonGroup">
                              <div class="Polaris-ButtonGroup__Item"><button type="button" class="Polaris-Button"><span class="Polaris-Button__Content popup-close"><span class="Polaris-Button__Text">Cancel</span></span></button></div>
                              <div class="Polaris-ButtonGroup__Item"><button type="button" class="Polaris-Button Polaris-Button--primary insert_country"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Add Currency</span></span></button></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="Polaris-Backdrop"></div>
        </form>
      </div>
      <!-- //  end Currencies Modal Setting// -->

    </div>


    </body>
</html>