@include('shopify_header')
 	<div class="Polaris-Page Polaris-Page--narrowWidth whole-cover">

 		<nav class="Polaris-top-custom-header" aria-label="Pagination">
	    <span class="Polaris-Back-Icon">
	      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
	        <path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
	      </svg>
	    </span>

	    <div class="custom-heading main-title-head Polaris-DisplayText--sizeMedium mb-10">General Settings</div>

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

	  <div class="app-setting-wrapper">

	  	<div id="theme_install_Setting" class="">

				<form method="POST">
				  
					<input type="hidden" name="shop_url" class="shop_url" value="<?php echo $shop ?>">

					<div class="Polaris-Layout custom-flex-cover mb-15 pb-15">
				    <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary">
				      <div class="Polaris-Cardd same-height-cardd">
				      	<div class="flex-vertical-center-text">
					        <div class="Polaris-Card__Sectionn">
					        	<h2 class="Polaris-Heading mb-5">Integrate App in a Theme Manually</h2>
					          <p>We recommend doing this in a non-live theme before going live. Please create a backup of the theme you are selecting before the installation starts. If you face any problems during installation steps, feel free to contact our <a href="https://support.chaostheoryhq.com/hc/en-us/articles/360018587220-Install-Instructions" target="_blank">support</a>.
					          	<br/>
					          	<a href="{{url('install_request')}}?shop=<?php echo $_GET['shop']?>">Or request for install via support instead</a>.
					          </p>
					        </div>
					      </div>
				      </div>
				    </div>

						<div class="Polaris-Layout__Section Polaris-Layout__Section--secondaryy">
		      		<div class="Polaris-Card same-height-card Polaris-Card__Section">
							
								<div class="Polaris-Labelled__LabelWrapper">
	                <div class="Polaris-Label">
	                  <label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text font-bold text--uppercase">Step 1: Pick a Theme</label>
	                </div>
	              </div>

	              <div class="Polaris-Select"> 
	                <select class="Polaris-Select__Input shopfiy_theme" aria-labelledby="ExamplesLabel">
										<?php foreach ($theme_data['themes'] as $theme) { ?>
											<option class=""<?php if(sizeof($theme_data_db)> 0){if($theme_data_db[0]->theme_id == $theme['id']){ echo 'selected="selected"';}}?> value="<?php echo $theme['id']?>">
										<?php echo $theme['name']?></option>
										<?php } ?>					
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

								<button type="button" class="Polaris-Button Polaris-Button--primary tablinks install_theme mt-15">
									<span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Install</span></span>
								</button>
								  <div class="Polaris-Label bottom-step">
					                  <label class="Polaris-Label__Text font-bold text--uppercase">Step 2: Add Code Snippets</label>
					                   <p>Once you’ve clicked the Install button above for the theme that you’d like to install the app in, please go to this <a href="https://chaostheory.zendesk.com/hc/en-us/articles/360018587220-Install-Instructions" target="_blank">article</a> and complete the steps.
					                	
					                </p>
					                </div>
					               
							</div>
						</div>
					</div>

					<!-- <hr class="custom-hr-border"> -->

					<div class="Polaris-Layout custom-flex-cover analytic-module mt-10">
						<div class="Polaris-Layout__Section Polaris-Layout__Section--secondary">
				      <div class="Polaris-Cardd same-height-cardd">
				      	<div class="flex-vertical-center-text">
					      	<div class="Polaris-Card__Sectionn">
					        	<h2 class="Polaris-Heading mb-5">Analytics</h2>
					          <p>Implement Pixel Tracking to your store and get advanced reports at the end of the month.</p>
					        </div>
					      </div>
				      </div>
				    </div>

						<div class="Polaris-Layout__Section Polaris-Layout__Section--secondaryy">
							<div class="Polaris-Card same-height-card Polaris-Card__Section">
						    <div class="Polaris-Labelled__LabelWrapper">
						      <div class="Polaris-Label">
						      	<label id="" for="" class="Polaris-Label__Text">Facebook Pixel Code</label>
						      </div>
						    </div>

						    <div class="Polaris-Connected">
						      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
						        <div class="Polaris-TextField Polaris-TextField--hasValue Polaris-TextField--multiline">
						        	<textarea id="" class="Polaris-TextField__Input facebook_pixel" name="facebook_pixel" style="height: 36px;resize: vertical;"><?php if(sizeof($theme_data_db)> 0){echo $theme_data_db[0]->fb_pixel;}?></textarea>
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
						        	<textarea id="" class="Polaris-TextField__Input google_tracking_code" name="google_tracking_code" style="height: 36px;resize: vertical;"><?php if(sizeof($theme_data_db)> 0){echo $theme_data_db[0]->google_pixel;}?></textarea>
						          <div class="Polaris-TextField__Backdrop"></div>
						        </div>
						      </div>
						    </div>
						    	
						  </div>
						</div>
					</div>

					<div class="btn-cover text--right">
						<button type="button" class="Polaris-Button Polaris-Button--primary tablinks addpixelcode mt-20 save-theme-content">
							<span class="Polaris-Button__Content">
								<span class="Polaris-Button__Text">Save</span>
							</span>
						</button>
				  </div>

				</form>
			</div>
	  </div>

	</div>

</body>
</html>