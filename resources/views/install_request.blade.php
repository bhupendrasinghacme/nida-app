@include('shopify_header')

  <div class="Polaris-Page Polaris-Page--narrowWidth whole-cover">
		<div>

			<nav class="Polaris-top-custom-header" aria-label="Pagination">
				<span class="Polaris-Back-Icon">
					<svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
						<path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
					</svg>
				</span>

				<div class="custom-heading main-title-head Polaris-DisplayText--sizeMedium mb-10">Setup your theme</div>
				<p>We recommend doing this in a non-live theme before going live. Please create a backup of the theme you are selecting before the installation starts. <b>Installation is usually completed within 1 business day after you complete step 3 (add us as a staff account).</b>
					
					</p>

			</nav>


			
		  <div class="Polaris-Layout mt-10">
		 		    <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary right-section">
				  <div class="Polaris-FormLayout">
					  <form action="" method="POST" enctype="multipart/form-data">
					  	 <input type="hidden" name="shop" class="shop_url" value="<?php if(!empty($shop)){echo $shop;} ?>">
		  <input type="hidden" name="customer_email" value="<?php if(!empty($customer_email)){ echo $customer_email;}?>" />

							<div class="Polaris-Layout__Section mt-top-none">
			      		<div class="Polaris-Card same-height-card Polaris-Card__Section">
	                <div class="Polaris-Label mb-10">
	                  <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text text--uppercase font-bold">Step 1: Pick a Theme</label>
	                </div>
		             
		              <div class="Polaris-Select"> 
		                <select class="Polaris-Select__Input shopfiy_theme" name="theme_name" aria-labelledby="ExamplesLabel">
											<?php if(!empty($theme_data)){foreach ($theme_data['themes'] as $theme) { ?>
												<option class="" <?php if(sizeof($theme_data_db)> 0){if($theme_data_db[0]->theme_id == $theme['id']){ echo 'selected="selected"';}}?> data-value="<?php echo $theme['id']?>" value="<?php echo $theme['name']?>">
											<?php echo $theme['name']?></option>
											<?php } }?>					
										</select>

		                <div class="Polaris-Select__Content" aria-hidden="true">
		                  <span class="Polaris-Select__SelectedOption">Choose a option</span>
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
							</div>
			    <div class="Polaris-Layout__Section Polaris-Layout__Section--secondaryy hide">
			    	 <select class="Polaris-Select__Input shopfiy_theme-hidden" name="theme_id" aria-labelledby="ExamplesLabel">
										<?php foreach ($theme_data['themes'] as $theme) { ?>
											<option class=""<?php if(sizeof($theme_data_db)> 0){if($theme_data_db[0]->theme_id == $theme['id']){ echo 'selected="selected"';}}?> value="<?php echo $theme['id']?>">
										<?php echo $theme['name']?></option>
										<?php } ?>					
									</select>
							<div class="Polaris-Card same-height-card Polaris-Card__Section">
						    <div class="Polaris-Labelled__LabelWrapper">
						      <div class="Polaris-Label">
						      	<label id="" for="" class="Polaris-Label__Text">Facebook Pixel Code</label>
						      </div>
						    </div>

						    <div class="Polaris-Connected">
						      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
						        <div class="Polaris-TextField Polaris-TextField--hasValue Polaris-TextField--multiline">
						        	<textarea id="" class="Polaris-TextField__Input facebook_pixel" name="facebook_tracking" style="height: 36px;resize: vertical;"><?php if(sizeof($theme_data_db)> 0){echo $theme_data_db[0]->fb_pixel;}?></textarea>
						          <div class="Polaris-TextField__Backdrop"></div>
						        </div>
						      </div>
						    </div>

								<div class="Polaris-Labelled__LabelWrapper mt-15">
						      <div class="Polaris-Label">
						      	<label id="" for="" class="Polaris-Label__Text">Google Converstion Tracking Code</label>
						      </div>
						    </div>
						    
						    <div class="Polaris-Connected">
						      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
						        <div class="Polaris-TextField Polaris-TextField--hasValue Polaris-TextField--multiline">
						        	<textarea id="" class="Polaris-TextField__Input google_tracking_code" name="google_tracking" style="height: 36px;resize: vertical;"><?php if(sizeof($theme_data_db)> 0){echo $theme_data_db[0]->google_pixel;}?></textarea>
						          <div class="Polaris-TextField__Backdrop"></div>
						        </div>
						      </div>
						    </div>
						    	
						  </div>
						</div>
							<div class="Polaris-Layout__Section mt-top-none">
			      		<div class="Polaris-Card same-height-card Polaris-Card__Section">	
	                <div class="Polaris-Label mb-10">
	                  <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text text--uppercase font-bold">Step 2: Run Setup</label>
	                </div>
		            
		              <div class="btn">
									  <button type="submit" name="install_request" class="Polaris-Button Polaris-Button--primary" <?php if(!empty($statusMsg)){ echo 'style="opacity:0.5;"';}?>>
									  	<span class="Polaris-Button__Content"><span class="Polaris-Button__Text"><?php if(!empty($statusMsg)){ ?>Setup Requested<?php }  else{ ?>Request Setup<?php }?></span></span>
									  </button>
									</div>
								</div>
							</div>

							<div class="Polaris-Layout__Section mt-top-none">
			      		<div class="Polaris-Card same-height-card Polaris-Card__Section">	
	                <div class="Polaris-Label mb-10">
	                  <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text text--uppercase font-bold">Step 3: Next Step</label>
	                </div>
	                <p>Please add support@chaostheoryhq.com as a staff account so that we can integrate the app.
	                </p>
								</div>
							</div>
						</form>
				  </div>
		    </div>
		  </div>
		  <div class="custom-heading main-title-head Polaris-DisplayText--sizeMedium mb-10 bottom-text" style="text-align:left;">Are you familiar with coding?</div>
		  <span class="normal-text" style="font-size: 1.4rem;font-weight:400;margin-top:20px;">You can set up the theme <a href="{{url('/app_setting')}}?shop=<?php echo $_GET['shop']?>">manually</a> now.</span>
		</div>
  </div>
<style>
	.bottom-text {
    margin-top: 20px;
    text-align: center;
    font-weight: 700;
}
</style>
  </body>
</html>