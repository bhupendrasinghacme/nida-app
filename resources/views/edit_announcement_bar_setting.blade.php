
<!-- Start Show All  Announcement Bar data--> 
<div class="text--left Polaris-create-bar-cover edit-module" id="currentpage">
  <span class="Polaris-Back-Icon active" onclick="back_to_bar()">
    <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
      <path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
    </svg>
    <span>Back</span>
  </span>

  <h3>Edit Bar</h3>
</div>

<div class="edit_announcement_bar">
  <form method="post" class="announcement_update_form" novalidate="">
     <div class="dynamic-announcement-content"></div>
    <div class="row general-block-wrapper"> 
      <div class="Polaris-Layout custom-flex-cover">
        <div class="Polaris-Layout__Section  Polaris-Layout__Section--secondary">
          <div class="Polaris-Cardd same-height-cardd">
            <div class="Polaris-Card__Headerr pd-left-none pd-right-none">
              <h2 class="Polaris-Heading">Bar Status</h2>
            </div>
            <div class="Polaris-Card__Section pd-left-none pd-bottom-none pd-right-none pt-5">
              <p>You can change your announcement bar status here.</p>
            </div>
          </div>
        </div>

        <div class="Polaris-Layout__Section">
          <div class="Polaris-Card same-height-card">
            
              <input type="hidden" name="bar_position" value=""/>
              <input type="hidden" class="shop_url" name="shop_url" value="<?php echo $shop ?>">
              <input type="hidden" class="" name="announcement_bar_id" value="<?php echo $announcement_bar_data->announcement_bar_id ?>">

              <div class="Polaris-FormLayout">
                <div class="Polaris-FormLayout__Item">
                  <div class="Polaris-Card__Section bar-flex-cover">
                    <div class="fields-wrapper mb-10">
                      <div class="enable-desable-text">Enable/Disable</div>

                      <label class="custom-switch">
                        <input type="checkbox" checked>
                        <span class="slider round"></span>
                      </label>

                      <div class="hidden-radio-button" style="display:none;">

                        <label class="Polaris-Choice" for="enable_bar_status_individual">
                          <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                          <input type="radio" id="enable_bar_status_individual" class="Polaris-RadioButton__Input" name="enable_bar_status" value="1" <?php if($announcement_bar_data->bar_status == 1) { echo "checked"; } ?>>
                          <span class="Polaris-RadioButton__Backdrop"></span>
                          <span class="Polaris-RadioButton__Icon"></span></span>
                          </span><span class="Polaris-Choice__Label">Enable</span>
                        </label>

                        <label class="Polaris-Choice" for="disable_bar_status_individual">
                          <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                          <input type="radio" id="disable_bar_status_individual" class="Polaris-RadioButton__Input" name="enable_bar_status"  value="0"  <?php if($announcement_bar_data->bar_status == 0) { echo "checked"; } ?> >
                          <span class="Polaris-RadioButton__Backdrop"></span>
                          <span class="Polaris-RadioButton__Icon"></span></span>
                          </span><span class="Polaris-Choice__Label">Disable</span>
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

    <div class="row general-block-wrapper"> 
      <div class="Polaris-Layout custom-flex-coverr">
        <div class="Polaris-Layout__Section  Polaris-Layout__Section--secondary">
          <div class="Polaris-Cardd same-height-cardd">
            <div class="Polaris-Card__Headerr pd-left-none pd-right-none">
              <h2 class="Polaris-Heading">Edit Bar Details</h2>
            </div>
              <div class="Polaris-Card__Section pd-left-none pd-right-none pt-5">  
                  <p>Use <?php echo "{{goal}}"; ?> to represent your cart goal defined above.</p>
                </div>
          </div>
        </div>

        <div class="Polaris-Layout__Section">
          <div class="Polaris-Card same-height-card">
            
              <input type="hidden" name="bar_position" value=""/>
              <input type="hidden" class="shop_url" name="shop_url" value="<?php echo $shop ?>">
              <input type="hidden" class="" name="announcement_bar_id" value="<?php echo $announcement_bar_data->announcement_bar_id ?>">

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
                            <input id="name" class="Polaris-TextField__Input" type="text" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" value="<?php echo $announcement_bar_data->name; ?>" name="annou_name">
                            <div class="Polaris-TextField__Backdrop"></div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="fields-wrapper mb-10">
                      <div class="Polaris-Labelled__LabelWrapper">
                        <div class="Polaris-Label">
                          <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Display Bar to This Country</label>
                        </div>
                      </div>

                      <div class="Polaris-Select">
                        <select id="select_country" name="select_country" class="Polaris-Select__Input" data-placeholder="Select Country">
                          @foreach($countries as $country)
                          <option <?php echo ($announcement_bar_data->country_id == $country->country_id) ? "selected" : ""; ?> value="<?php echo $country->country_id; ?>"><?php echo $country->country_name; ?>
                          </option>
                          @endforeach
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
                          <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Message</label>
                        </div>
                      </div>

                      <div class="Polaris-Connected">
                        <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                          <div class="Polaris-TextField">
                            <input id="message" class="Polaris-TextField__Input" type="text" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" value="<?php echo $announcement_bar_data->message ?>" name="message">
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
                          <div class="Polaris-TextField"><input id="set_goal" class="Polaris-TextField__Input" type="text"  value="<?php echo $announcement_bar_data->set_goal; ?>" aria-invalid="false" aria-multiline="false" name="set_goal" >
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
                          <div class="Polaris-TextField">
                            <input id="text_color" class="Polaris-TextField__Input" type="color" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" value="<?php echo $announcement_bar_data->text_color; ?>" name="text_color">
                            <div class="Polaris-TextField__Backdrop" ></div>
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
                          <div class="Polaris-TextField"><input id="background_color" class="Polaris-TextField__Input" type="color" aria-labelledby="PolarisTextField5Label" aria-invalid="false" value="<?php echo $announcement_bar_data->background_color; ?>" aria-multiline="false" name="background_color" >
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
                            <input id="goal_color" class="Polaris-TextField__Input" type="color" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" value="<?php echo $announcement_bar_data->goal_color; ?>" name="goal_color" >
                            <div class="Polaris-TextField__Backdrop"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="fields-wrapper mb-10 custom_card_section">
                        <div class="Polaris-Labelled__LabelWrapper">
                          <div class="Polaris-Label">
                            <label id="PolarisTextField4Label" for="letter_spacing_edit" class="Polaris-Label__Text">Letter Spacing</label>
                          </div>
                        </div>
                        <div class="input-field-wrapper Polaris-Card">
                        <div class="Polaris-Connected">
                              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                                <div class="Polaris-TextField Polaris-TextField--hasValue"><input id="letter_spacing_edit" class="Polaris-TextField__Input" type="number" class="letterspacing" name="letter_spacing_edit"aria-labelledby="letter_spacing_edit" aria-invalid="false" aria-multiline="false" value="<?php if(!empty($announcement_bar_data) && $announcement_bar_data->letter_spacing != null){echo $announcement_bar_data->letter_spacing;}?>"><span class="units">px</span>
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
                          <input class="google-font-selector" id="font_family" type="text" name="font_family" value="<?php if(!empty($announcement_bar_data)){echo $announcement_bar_data->font_family;}?>">
                        </div>
                      </div>
                          <label class="Polaris-Choice" for="enable_theme_font_edit">
                            <span class="Polaris-Choice__Control"><span class="Polaris-Checkbox">
                              <input type="checkbox" name="enable_theme_font_edit" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value="true" id="enable_theme_font_edit" <?php echo ($announcement_bar_data->themefont == "true") ? "checked" : ""; ?>/><span class="Polaris-Checkbox__Backdrop"></span><span class="Polaris-Checkbox__Icon"><span class="Polaris-Icon">
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
                              <option value="none" <?php echo ($announcement_bar_data->textstyle == "none") ? "selected" : ""; ?>>None</option>
                              <option value="uppercase" <?php echo ($announcement_bar_data->textstyle == "uppercase") ? "selected" : ""; ?>>Uppercase</option>
                              <option value="lowercase" <?php echo ($announcement_bar_data->textstyle == "lowercase") ? "selected" : ""; ?>>Lowercase</option>
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
                        <select id="close_button" name="close_button" class="Polaris-Select__Input">
                          <option <?php echo ($announcement_bar_data->close_button == "Yes") ? "selected" : ""; ?> value="Yes">Yes</option>
                          <option <?php echo ($announcement_bar_data->close_button == "No") ? "selected" : ""; ?> value="No">No</option>
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
                        <select id="font_size" name="font_size" class="Polaris-Select__Input">
                          <?php
                            for($i=9;$i<=32;$i++){
                              ?>
                               <option <?php echo ($announcement_bar_data->font_size == $i) ? "selected" : ""; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
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

                    <!-- <div class="Polaris-Labelled__LabelWrapper">
                       <div class="Polaris-Label"><label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Bar Postion</label>
                       </div>
                    </div>
                    <select id="bar_position" name="bar_position">
                      <option value="">Choose an option</option>
                      <option <?php echo ($announcement_bar_data->bar_position == "Top") ? "selected" : ""; ?> value="Top">Top</option>
                      <option <?php echo ($announcement_bar_data->bar_position == "Left") ? "selected" : ""; ?> value="Left">Left</option>
                    
                    </select> -->
           

                    <div class="fields-wrapper mb-10">
                      <div class="Polaris-Labelled__LabelWrapper">
                        <div class="Polaris-Label">
                          <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Display Bar Based on Device</label>
                        </div>
                      </div>

                      <div class="Polaris-Select">
                        <select id="display_bar_based_on_device" name="display_bar_based_on_device" class="Polaris-Select__Input">
                          <option value="">Choose an option</option>
                          <option <?php echo ($announcement_bar_data->display_bar_based_on_device == "all_bar") ? "selected" : ""; ?> value="all_bar">All</option>
                          <option  <?php echo ($announcement_bar_data->display_bar_based_on_device == "mobile_bar") ? "selected" : ""; ?> value="mobile_bar">Mobile</option> 
                           <option <?php echo ($announcement_bar_data->display_bar_based_on_device == "desktop_bar") ? "selected" : ""; ?> value="desktop_bar">Desktop</option> 
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

                    <!-- <div class="Polaris-Labelled__LabelWrapper">
                      <div class="Polaris-Label"><label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Display bar to specific country</label></div>
                      </div>
                      <div class="Polaris-Connected">
                        <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                          <div class="Polaris-TextField"><input id="display_bar_to_specific_country" class="Polaris-TextField__Input" type="text" aria-labelledby="PolarisTextField4Label" aria-invalid="false" aria-multiline="false" value="<?php echo $announcement_bar_data->display_bar_to_specific_country; ?>" name="display_bar_to_specific_country">
                            <div class="Polaris-TextField__Backdrop" ></div>
                          </div>
                        </div>
                    </div> -->

                    <div class="multi-radio-btn-cover mt-15">
                      <fieldset class="Polaris-ChoiceList" id="PolarisChoiceList12" aria-invalid="false">
                        <legend class="Polaris-ChoiceList__Title">Display Bar Based on Page</legend>
                        <ul class="Polaris-ChoiceList__Choices">
                          <li>
                            <label class="Polaris-Choice" for="display_bar_based_on_page1">
                              <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                              <input type="radio" id="display_bar_based_on_page1" name="display_bar_based_on_page" value="any_pages" <?php echo ($announcement_bar_data->display_bar_based_on_page == "any_pages") ? "checked" : ""; ?> class="Polaris-RadioButton__Input">
                              <span class="Polaris-RadioButton__Backdrop"></span>
                              <span class="Polaris-RadioButton__Icon"></span></span>
                              </span><span class="Polaris-Choice__Label">Any page</span>
                            </label>
                          </li>

                          <li>
                            <label class="Polaris-Choice" for="display_bar_based_on_page2">
                              <span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                              <input  type="radio" id="display_bar_based_on_page2" name="display_bar_based_on_page"  class="Polaris-RadioButton__Input" value="home_page" <?php echo ($announcement_bar_data->display_bar_based_on_page == "home_page") ? "checked" : ""; ?>>
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
          </div>
        </div>
      </div> 
    </div>
  <div class="Polaris-FormLayout__Itemm mt-20 btn-cover text--right">
                      <button type="button" class="Polaris-Button announcement_bar_setting_update Polaris-Button--primary" onclick="announcement_bar_setting_update()">
                        <span class="Polaris-Button__Content"><span class="Polaris-Button__Text" >Update</span></span>
                      </button>
                    </div>
  </form>
</div>
<!-- End Show All  Announcement Bar data--> 