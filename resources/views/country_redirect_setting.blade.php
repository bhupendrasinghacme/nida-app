@include('shopify_header')

  <div class="Polaris-Page Polaris-Page--narrowWidth whole-cover">

  <nav class="Polaris-top-custom-header" aria-label="Pagination">
    <span class="Polaris-Back-Icon">
      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
        <path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
      </svg>
    </span>

    <div class="custom-heading main-title-head Polaris-DisplayText--sizeMedium mb-10">Redirect Settings</div>

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
    <button class="tablinks" onclick="open_tab(event, 'redirection_setting')">General Settings</button>
   <button class="tablinks" onclick="open_tab(event, 'Internal_Redirection')">Page Redirection</button>
    <button class="tablinks" onclick="open_tab(event, 'External_Redirection')">External Redirection</button>
  </div>
<div id="redirection_setting" class="tabcontent"> 
    <div class="enable_feature_country">
      <form method="POST">
        <div class="row general-block-wrapper">
          <div class="Polaris-Layout custom-flex-cover">
            <div class="Polaris-Layout__Section  Polaris-Layout__Section--secondary">
              <div class="Polaris-Cardd same-height-cardd">
                <div class="Polaris-Card__Header pd-none">
                  <h2 class="Polaris-Heading">Enable Feature</h2>
                </div>
                <div class="Polaris-Card__Section pd-none pt-5">
                  <p>Enable or disable redirection. If disabled, different pages will not display for different countries.</p>
                </div>
              </div>
            </div>

            <div class="Polaris-Layout__Section">
              <div class="Polaris-Card same-height-card">
                <div class="Polaris-Card__Section flex-vertical-center-text cstm-flx-wrp-individual">
                  <div class="enable-desable-text">Enable/Disable</div>
                  <label class="custom-switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                  </label>
                  <div class="hidden-radio-button" style="display:none;">
                  <label class="Polaris-Choice" for="enable-redirect"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                    <input type="hidden" name="shop_url" class="shop_url" value="<?php echo $shop; ?>">
                    <input id="enable-redirect" name="enableredirect" type="radio" class="Polaris-RadioButton__Input"   onclick="enable_disable_country_redirect(1)" value="1" <?php if($external_module[0]->country_redirection == 1){ echo 'checked';}?>>
                    <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Enable</span>
                  </label>

                  <label class="Polaris-Choice" for="disable-redirect"><span class="Polaris-Choice__Control"><span class="Polaris-RadioButton">
                    <input id="disable-redirect" name="enableredirect" type="radio" class="Polaris-RadioButton__Input" <?php if($external_module[0]->country_redirection == 0){ echo 'checked';}?> onclick="enable_disable_country_redirect(0)" value="0">
                    <span class="Polaris-RadioButton__Backdrop"></span><span class="Polaris-RadioButton__Icon"></span></span></span><span class="Polaris-Choice__Label">Disable</span>
                  </label>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
</div>
  <div id="Internal_Redirection" class="tabcontent"> 
<div class="row general-block-wrapper" style="margin-bottom: 20px;">
          <div class="Polaris-Layout custom-flex-cover">
        <div class="Polaris-Layout__Section">
              <div class="Polaris-Card same-height-card">
                <div class="Polaris-Card__Section flex-vertical-center-text cstm-flx-wrp-individual">
          <h2 class="Polaris-Heading text--left mb-10">Configure Local Page Redirections</h2>
          <p class="Polaris-Configure_description-text">Configure the internal site page redirections by first selecting the default page and then selecting the page to redirect to based on country. For example, use this redirect to show UK visitors the page that contains the information specific to the UK.</p>
                </div>
              </div>
            </div>
</div>
</div>
    <div class="Configure_Redirections_sectionn">
      <div class="Polaris-Card">
      

        <div class="Polaris-Card__Section">
          <form method="post">

            <div class="cover-box">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label">
                  <label id="PolarisSelect2Label" for="pages" class="Polaris-Label__Text">Select Default Page</label>
                </div>
              </div>

              <div class="Polaris-Select">
                <select id="select_page" class="Polaris-Select__Input" aria-invalid="false">
                      <?php
                  for($i=0;$i<count($shop_data['pages']); $i++)
                  { 
                    ?>
                  <option value="<?php  echo $shop_data['pages'][$i]['handle'] ?>"><?php  echo $shop_data['pages'][$i]['title'] ?>
                  </option>
                  <?php
                  }
                  ?>
                </select>

                <div class="Polaris-Select__Content" aria-hidden="true">
                  <span class="Polaris-Select__SelectedOption">Choose a option</span>
                  <span class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                        <path d="M10 16l-4-4h8l-4 4zm0-12l4 4H6l4-4z"></path>
                      </svg></span>
                  </span>
                </div>
                
                <div class="Polaris-Select__Backdrop"></div>
                
              </div>
              <div class="select-bottom-text"><i>(i.e. Shipping Info) </i></div>
            </div>

            <div class="cover-box">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label">
                  <label id="PolarisSelect2Label" for="country" class="Polaris-Label__Text">Select Country</label>
                </div>
              </div>

              <div class="Polaris-Select">
                <select id="select_country_redirect" class="Polaris-Select__Input" aria-invalid="false">
                  <?php foreach ($countries as $country) { 
                    ?>
                    <option value="<?php echo $country->country_id; ?>"><?php echo $country->country_name; ?></option>
                  <?php } ?>
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
              <div class="select-bottom-text hidden"><i>(i.e. Shipping Info for UK) </i></div>
            </div>
            <div class="cover-box">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label">
                  <label id="PolarisSelect2Label" for="pages" class="Polaris-Label__Text">Select Page to Show Visitors from this Country
                    <a href="<?php echo 'https://'.$shop.'/admin/pages';?>" target="_blank" class="hide">Create Page</a>
                  </label>
                </div>
              </div>

              <div class="Polaris-Select">
                <select id="select_page_new" class="Polaris-Select__Input" aria-invalid="false">
                      <?php
                  for($i=0;$i<count($shop_data['pages']); $i++)
                  { 
                    ?>
                  <option value="<?php  echo $shop_data['pages'][$i]['handle'] ?>"><?php  echo $shop_data['pages'][$i]['title'] ?>
                  </option>
                  <?php
                  }
                  ?>
                </select>

                <div class="Polaris-Select__Content" aria-hidden="true">
                  <span class="Polaris-Select__SelectedOption">Choose a option</span>
                  <span class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                        <path d="M10 16l-4-4h8l-4 4zm0-12l4 4H6l4-4z"></path>
                      </svg></span>
                  </span>
                </div>
                
                <div class="Polaris-Select__Backdrop"></div>
                
              </div>
              <div class="select-bottom-text"><i>(i.e. Shipping Info for UK) </i></div>
            </div>

            <div class="btn-coverr">
              <!-- <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label">
                  <label id="PolarisSelect2Label" for="page_handle" class="Polaris-Label__Text hidden">Page URL</label>
                </div>
              </div> -->

              <button type="button" class="Polaris-Button Polaris-Button--primary insert_country_page_internal" ><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Submit</span></span>
              </button>
            </div>
          </form>
        </div>

        <div id="responsecontainer_internal">

        </div>
      </div>
    </div>

  </div>

  <div id="External_Redirection" class="tabcontent">
<div class="row general-block-wrapper" style="margin-bottom: 20px;">
          <div class="Polaris-Layout custom-flex-cover">
        <div class="Polaris-Layout__Section">
              <div class="Polaris-Card same-height-card">
                <div class="Polaris-Card__Section flex-vertical-center-text cstm-flx-wrp-individual">
          <h2 class="Polaris-Heading text--left mb-10">Configure Page Redirections</h2>
          <p class="Polaris-Configure_description-text">Configure the external redirections by first selecting the default page and then selecting the page to redirect to based on country.</p>
                </div>
              </div>
            </div>
</div>
</div>
    <div class="Polaris-Card">
  
      <div class="Polaris-Card__Section">
        <form method="post" >

          <div class="cover-box">
            <div class="Polaris-Labelled__LabelWrapper">
              <div class="Polaris-Label">
                <label id="PolarisSelect2Label" for="pages" class="Polaris-Label__Text">Select page</label>
              </div>
            </div>

            <div class="Polaris-Select">
              <select id="select_page_external" class="Polaris-Select__Input" aria-invalid="false">
                <?php
                for($i=0;$i<count($shop_data['pages']); $i++)
                { ?>
                <option value="<?php  echo $shop_data['pages'][$i]['handle'] ?>"><?php  echo $shop_data['pages'][$i]['handle'] ?></option>

                <?php
                }
                ?>
              </select>

              <div class="Polaris-Select__Content" aria-hidden="true">
                <span class="Polaris-Select__SelectedOption">Choose a option</span>
                <span class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                      <path d="M10 16l-4-4h8l-4 4zm0-12l4 4H6l4-4z"></path>
                    </svg></span>
                </span>
              </div>
              
              <div class="Polaris-Select__Backdrop page_error"></div>
            </div>
          </div>

          <div class="cover-box">
            <div class="Polaris-Labelled__LabelWrapper">
              <div class="Polaris-Label">
                <label id="PolarisSelect2Label" for="country" class="Polaris-Label__Text">Select Country</label>
              </div>
            </div>

            <div class="Polaris-Select">
              <select id="select_country_external" class="Polaris-Select__Input" aria-invalid="false">
                <?php foreach ($countries as $country) { ?>
                <option value="<?php echo $country->country_id; ?>"><?php echo $country->country_name; ?></option>
                <?php } ?>
              </select>

              <div class="Polaris-Select__Content" aria-hidden="true">
                <span class="Polaris-Select__SelectedOption">Choose a option</span>
                <span class="Polaris-Select__Icon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                      <path d="M10 16l-4-4h8l-4 4zm0-12l4 4H6l4-4z"></path>
                    </svg></span>
                </span>
              </div>
              
              <div class="Polaris-Select__Backdrop country_error"></div>
            </div>
          </div>

          <div class="cover-box">
            <div class="Polaris-Labelled__LabelWrapper">
              <div class="Polaris-Label">
                <label id="PolarisSelect2Label" for="page_url" class="Polaris-Label__Text">Redirect to URL</label>
              </div>
            </div>
    
            <div class="Polaris-Connected">
              <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                <div class="Polaris-TextField Polaris-TextField--hasValue">
                  <input type="url" name='external_page_handle' id='external_page_handle' class="Polaris-TextField__Input" placeholder="New Page URL">
                  <div class="Polaris-TextField__Backdrop"></div>
                </div>
              </div>

              <div class="Polaris-Select__Backdrop url_error"></div>
            </div>
          </div>
            
          <div class="btn-coverr">
            <div class="Polaris-Labelled__LabelWrapper">
              <div class="Polaris-Label">
                <label id="PolarisSelect2Label" for="page_handle" class="Polaris-Label__Text hidden">Page URL</label>
              </div>
            </div>

            <button type="button" class="Polaris-Button Polaris-Button--primary insert_country_page_external" >
              <span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Submit</span></span>
            </button>
          </div>
        </form>
      </div>
           
      <div id="responsecontainer_external">
      </div>

    </div>

  </div>

</div>
<!-- //  start Currencies Modal Setting// -->
</body>
</html>