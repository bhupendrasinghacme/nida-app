@include('shopify_header')

  <div class="Polaris-Page Polaris-Page--narrowWidth whole-cover">

  <nav class="Polaris-top-custom-header" aria-label="Pagination">
    <span class="Polaris-Back-Icon">
      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
        <path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
      </svg>
    </span>

    <div class="custom-heading main-title-head Polaris-DisplayText--sizeMedium">Announcement Bar Settings</div>
  
    <div class="btn-cover right-sec hidden">  
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

    
  <!-- Start Show All  Announcement Bar data-->
        <form method="POST">
       
      </form> 

  <div class="announcement_bar_wrp"> 
    <div id="create_bar" class="tabcontent">
        
      <div class="text--left Polaris-create-bar-cover">
        <span class="Polaris-Back-Icon" onclick="open_tab(event, 'Back')">
          <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
            <path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
          </svg>
          <span>Back</span>
        </span>

        <h3>Create Bar</h3>
      </div>
      

      <input type="hidden" class="shop_url" value="<?php echo $shop ?>">
      <div class="dynamic-announcement-content"></div>

      <form method="POST" class="announcement-form">
        <input type="hidden" name="bar_position" value=""/>
        <div class="row general-block-wrapper mb-20 Announcement-Bar-setting">
      
          <div class="Polaris-Layout custom-flex-coverr">
            <div class="Polaris-Layout__Section  Polaris-Layout__Section--secondary">
              <div class="Polaris-Cardd same-height-cardd">
                <div class="Polaris-Card__Header pd-left-none pd-right-none pd-top-none">
                  <h2 class="Polaris-Heading">Bar Status</h2>
                </div>
                <div class="Polaris-Card__Section pd-left-none pd-right-none pd-bottom-none pt-5">
                  <p>Enable or disable this feature. If disabled, announcment bar will not appear on your store.</p>
                </div>
              </div>
            </div>

            <div class="Polaris-Layout__Section Polaris-Layout__Section--secondaryy">
              <div class="Polaris-Card same-height-card">
                <div class="Polaris-Card__Section flex-vertical-center-text">
                <div class="enable-desable-text">Enable/Disable</div>
                <label class="custom-switch">
                  <input type="checkbox" checked>
                  <span class="slider round"></span>
                </label>
                <div class="hidden-radio-button" style="display:none;">
                  <label class="Polaris-Choice" for="enable_bar_status">
                    <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                    <input type="radio" id="enable_bar_status" name="bar_status" value="1" checked class="Polaris-RadioButton__Input bar-status">
                    <span class="Polaris-RadioButton__Backdrop"></span>
                    <span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Enable</span>
                  </label>

                  <label class="Polaris-Choice" for="disable_bar_status">
                    <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                    <input type="radio" id="disable_bar_status"  name="bar_status"  value="0" class="Polaris-RadioButton__Input bar-status">
                    <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Disable</span>
                  </label>
                </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="row general-block-wrapper">

          <div class="Polaris-Layout custom-flex-cover">
            <div class="Polaris-Layout__Section  Polaris-Layout__Section--secondary">
              <div class="Polaris-Cardd same-height-cardd">
                <div class="Polaris-Card__Headerr">
                  <h2 class="Polaris-Heading">Bar Details</h2>
                </div>
                <div class="Polaris-Card__Section pd-left-none pd-right-none pt-5 hide">
                  <p>Enable or disable this feature. If disabled, price module will not be displayed and price will not change based on country.</p>
                </div>
              </div>
            </div>

            <div class="Polaris-Layout__Section">
              <div class="Polaris-Card same-height-card">
                <!-- <form method="post" novalidate=""> -->
                  <div class="Polaris-FormLayout">
                    <div class="Polaris-FormLayout__Item">
                      <div class="Polaris-Card__Section bar-flex-cover">
                        <div class="fields-wrapper mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Name</label>
                            </div>
                          </div>

                          <div class="Polaris-Connected">
                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField">
                                <input id="name" class="Polaris-TextField__Input" type="text" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" value="" name="name">
                                <div class="Polaris-TextField__Backdrop"></div>
                              </div>
                            </div>
                           </div>
                        </div>

                        <div class="fields-wrapper custom-multi-select-option mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Display Bar to This Country</label>
                            </div>
                          </div>   

                          <select id="select_country" multiple class="" name="country" data-placeholder="Select Country">
                            <option value="" disabled>Choose an option</option>
                            @foreach($countries as $country)
                             <?php 
                             $announcement_bar_data = DB::table('announcement_bar_setting')->select('*')->where(['store_url' => $shop,'country_id' => $country->country_id])->get();
                            $announcement_bar = json_decode(json_encode($announcement_bar_data), true);
                             //echo "<pre>"; print_r(); 
                            if(isset($announcement_bar) && !empty($announcement_bar)){
                              foreach ($announcement_bar as $announcement_bar_country) {
                                //print_r($announcement_bar_country); exit;
                                ?>
                                <option  <?php if($country->country_id == $announcement_bar_country['country_id']) { echo "disabled"; } ?> value="<?php echo $country->country_id; ?>"><?php echo $country->country_name; ?></option>
                              <?php
                              }
                            }else{
                              ?>
                              <option  value="<?php echo $country->country_id; ?>"><?php echo $country->country_name; ?></option>
                              <?php
                            }
                            ?>

                            
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                <!-- </form> -->
              </div>
            </div>
          </div>
        </div>  

        <div class="row general-block-wrapper">

          <div class="Polaris-Layout custom-flex-cover">
            <div class="Polaris-Layout__Section  Polaris-Layout__Section--secondary">
              <div class="Polaris-Cardd same-height-cardd">
                <div class="Polaris-Card__Headerr">
                  <h2 class="Polaris-Heading">Bar Message</h2>
                </div>
                <div class="Polaris-Card__Section pd-left-none pd-right-none pt-5">  
                  <p>Use <?php echo "{{goal}}"; ?> to represent your cart goal defined above.</p>
                </div>
              </div>
            </div>

            <div class="Polaris-Layout__Section">
              <div class="Polaris-Card same-height-card">
                <!-- <form method="post" novalidate=""> -->

                  <div class="Polaris-FormLayout">
                    <div class="Polaris-FormLayout__Item">
                      <div class="Polaris-Card__Section bar-flex-cover">
                        <div class="fields-wrapper mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Message</label>
                            </div>
                          </div>

                          <div class="Polaris-Connected">
                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField">
                                <input id="message" class="Polaris-TextField__Input" type="text" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" name="message" value="">
                                <div class="Polaris-TextField__Backdrop"></div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="fields-wrapper mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Set Goal</label>
                            </div>
                          </div>

                          <div class="Polaris-Connected">
                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField"><input id="set_goal" name="goal" class="Polaris-TextField__Input" type="text" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" >
                                <div class="Polaris-TextField__Backdrop"></div>
                              </div>
                            </div>
                           </div>
                        </div>

                        <div class="fields-wrapper mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Text Color</label>
                            </div>
                          </div>

                          <div class="Polaris-Connected">
                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField"><input id="text_color" name="text_color" class="Polaris-TextField__Input" type="color" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" >
                                <div class="Polaris-TextField__Backdrop"></div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="fields-wrapper mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField5Label" for="PolarisTextField5" class="Polaris-Label__Text">Background Color</label>
                            </div>
                          </div>

                          <div class="Polaris-Connected">
                            <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                              <div class="Polaris-TextField"><input id="background_color" name="background_color" class="Polaris-TextField__Input" type="color" aria-labelledby="PolarisTextField5Label" aria-invalid="false" aria-multiline="false" >
                                <div class="Polaris-TextField__Backdrop"></div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="fields-wrapper mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Goal Color</label>
                            </div>
                          </div>

                          <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                <div class="Polaris-TextField">
                                  <input id="goal_color" class="Polaris-TextField__Input" type="color" name="goal_color" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" >
                                  <div class="Polaris-TextField__Backdrop"></div>
                                </div>
                              </div>
                          </div>
                        </div>
                      <div class="fields-wrapper mb-10 custom_card_section">
                        <div class="Polaris-Labelled__LabelWrapper">
                          <div class="Polaris-Label">
                            <label id="PolarisTextField4Label" for="letter_spacing" class="Polaris-Label__Text">Letter Spacing</label>
                          </div>
                        </div>
                        <div class="input-field-wrapper Polaris-Card">
                        <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                <div class="Polaris-TextField Polaris-TextField--hasValue"><input id="letter_spacing" class="Polaris-TextField__Input" type="text" class="letterspacing" name="letter_spacing"aria-labelledby="letter_spacing" aria-invalid="false" aria-multiline="false"><span class="units">px</span>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                        <div class="fields-wrapper mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Font Family</label>
                            </div>
                          </div>
                          <div class="Polaris-Select">
                            <div class="input-field-wrapper">
                              <input class="google-font_family"  id="font_family" type="text" name="font_family">
                            </div>
                          </div>
                           <label class="Polaris-Choice" for="enable_theme_font">
                            <span class="Polaris-Choice__Control"><span class="Polaris-Checkbox">
                              <input type="checkbox" name="enable_theme_font" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value="true" id="enable_theme_font"/><span class="Polaris-Checkbox__Backdrop"></span><span class="Polaris-Checkbox__Icon"><span class="Polaris-Icon">
                                <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                  <path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0"></path>
                                </svg>
                              </span></span></span>
                            </span>

                            <span class="Polaris-Choice__Label">Enable theme's font</span>
                          </label>
                        </div>
                        <div class="fields-wrapper mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Text Style</label>
                            </div>
                          </div>

                          <div class="Polaris-Select">
                            <select id="text_style" class="Polaris-Select__Input" name="text_style">
                              <option value="none">None</option>
                              <option value="uppercase">Uppercase</option>
                              <option value="lowercase">Lowercase</option>
                            </select>

                            <div class="Polaris-Select__Content" aria-hidden="true">
                              <span class="Polaris-Select__SelectedOption">Choose an option</span>
                              <span class="Polaris-Select__Icon">
                                <span class="Polaris-Icon">
                                  <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <path d="M10 16l-4-4h8l-4 4zm0-12l4 4H6l4-4z"></path>
                                  </svg>
                                </span>
                              </span>
                            </div>
                            <div class="Polaris-Select__Backdrop"></div>
                          </div>
                        </div>
                        <div class="fields-wrapper mb-10" style="display:none;">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Close Button</label>
                            </div>
                          </div>

                          <div class="Polaris-Select">
                            <select id="close_button" class="Polaris-Select__Input" name="close_button">
                              <option value="Yes">Yes</option>
                              <option value="No">No</option>
                            </select>

                            <div class="Polaris-Select__Content" aria-hidden="true">
                              <span class="Polaris-Select__SelectedOption">Choose an option</span>
                              <span class="Polaris-Select__Icon">
                                <span class="Polaris-Icon">
                                  <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <path d="M10 16l-4-4h8l-4 4zm0-12l4 4H6l4-4z"></path>
                                  </svg>
                                </span>
                              </span>
                            </div>
                            <div class="Polaris-Select__Backdrop"></div>
                          </div>
                        </div>

                        <div class="fields-wrapper mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Font Size</label>
                            </div>
                          </div>

                          <div class="Polaris-Select">
                            <select id="font_size" class="Polaris-Select__Input" name="font_size">
                              <?php
                              for($i=9;$i<=32;$i++){
                              ?>
                              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                              <?php
                              }
                              ?>
                            </select>

                            <div class="Polaris-Select__Content" aria-hidden="true">
                              <span class="Polaris-Select__SelectedOption">Choose an option</span>
                              <span class="Polaris-Select__Icon">
                                <span class="Polaris-Icon">
                                  <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <path d="M10 16l-4-4h8l-4 4zm0-12l4 4H6l4-4z"></path>
                                  </svg>
                                </span>
                              </span>
                            </div>
                            <div class="Polaris-Select__Backdrop"></div>
                          </div>
                        </div>
                             
                        <div class="fields-wrapper mb-10">
                          <div class="Polaris-Labelled__LabelWrapper">
                            <div class="Polaris-Label">
                              <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Display bar based on Device</label>
                            </div>
                          </div>

                          <div class="Polaris-Select">
                            <select id="display_bar_based_on_device" class="Polaris-Select__Input" name="display_bar_based_on_device">
                              <option value="all_bar">All</option>
                              <option value="mobile_bar">Mobile</option> 
                              <option value="desktop_bar">Desktop</option> 
                            </select>

                            <div class="Polaris-Select__Content" aria-hidden="true">
                              <span class="Polaris-Select__SelectedOption">Choose an option</span>
                              <span class="Polaris-Select__Icon">
                                <span class="Polaris-Icon">
                                  <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                                    <path d="M10 16l-4-4h8l-4 4zm0-12l4 4H6l4-4z"></path>
                                  </svg>
                                </span>
                              </span>
                            </div>
                            <div class="Polaris-Select__Backdrop"></div>
                          </div>
                        </div>
    
                        <div class="multi-radio-btn-cover mt-15">
                          <fieldset class="Polaris-ChoiceList" id="PolarisChoiceList12" aria-invalid="false">
                            <legend class="Polaris-ChoiceList__Title">Display Bar Based on Page</legend>
                            <ul class="Polaris-ChoiceList__Choices">
                              <li>
                                <label class="Polaris-Choice" for="display_bar_based_on_page4">
                                  <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                                  <input type="radio" id="display_bar_based_on_page4" name="display_bar_based_on_page" value="any_pages" class="Polaris-RadioButton__Input">
                                  <span class="Polaris-RadioButton__Backdrop"></span>
                                  <span class="Polaris-RadioButton__Icon"></span></span>
                                  </span><span class="Polaris-Choice__Label">Any page</span>
                                </label>
                              </li>

                              <li>
                                <label class="Polaris-Choice" for="display_bar_based_on_page5">
                                  <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                                  <input type="radio" id="display_bar_based_on_page5" name="display_bar_based_on_page" value="home_page" class="Polaris-RadioButton__Input">
                                  <span class="Polaris-RadioButton__Backdrop"></span>
                                  <span class="Polaris-RadioButton__Icon"></span></span>
                                  </span><span class="Polaris-Choice__Label">Homepage only</span>
                                </label>
                              </li>
                             
                            </ul>
                          </fieldset>
                        </div>

                       
                      </div>
                    </div>
                  </div>

                <!-- </form> -->
              </div>
            </div>
          </div>
        </div>  
          <div class="btn-cover mt-20 mb-10 text--right">
                          <button type="submit" class="Polaris-Button announcement_bar_setting_insert_button Polaris-Button--primary" >
                            <span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Submit</span></span>
                          </button>
                        </div>
      </form>
    </div>
    <!-- End Show All  Announcement Bar data--> 

    <!--   Start Create New Announcement Bar --> 

    <div id="Back" class="tabcontent">
      <div class="text--right">
       	<button type="button" class="Polaris-Button Polaris-Button--primary tablinks create_bar"  onclick="open_tab(event, 'create_bar')">
          <span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Create New</span></span>
        </button>
      </div>

      <div class="Announcement_Bar__cover mt-20">
        <div class="Polaris-Connected mb-20">
          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
            <div class="Polaris-TextField Polaris-TextField--hasValue">
              <input type="text" name='' id="myInput" class="Polaris-TextField__Input" placeholder="Search..">
              <div class="Polaris-TextField__Backdrop"></div>
            </div>
          </div>
        </div>

        <div id=responsecontainer_announcement_bar></div> 	
      </div>
    </div>
  </div>

  <!-- <-----------------------------  End Create  New Announcement Bar ------------> 
  <div id="edit_announcement_bar_page"></div>

  </div>