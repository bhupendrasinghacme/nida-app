@include('shopify_header')
		<div class="dashboard-cover">
			<div class="Polaris-Layout">
				<div class="Polaris-Layout__Section">
				  <div class="Polaris-Card-None">
				    <div class="Polaris-Card__Header">
  						<p class="Polaris-DisplayText Polaris-DisplayText--sizeLarge Polaris-welcome-name-heading" style="display:flex;align-items:center;">
  							<!-- <span class="day-status"></span>, <?php echo $shop_data['shop']['shop_owner']?> -->
							Welcome to Country Based Pricing
  							 <a href="{{url('/app_setting')}}?shop=<?php echo $_GET['shop']?>" class="hide dashboard-settings-icon"><svg viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9.027 0a1 1 0 00-.99.859l-.37 2.598A6.993 6.993 0 005.742 4.57L3.305 3.59a1 1 0 00-1.239.428L.934 5.981a1 1 0 00.248 1.287l2.066 1.621a7.06 7.06 0 000 2.222l-2.066 1.621a1 1 0 00-.248 1.287l1.132 1.962a1 1 0 001.239.428l2.438-.979a6.995 6.995 0 001.923 1.113l.372 2.598a1 1 0 00.99.859h2.265a1 1 0 00.99-.859l.371-2.598a6.995 6.995 0 001.924-1.112l2.438.978a1 1 0 001.238-.428l1.133-1.962a1 1 0 00-.249-1.287l-2.065-1.621a7.063 7.063 0 000-2.222l2.065-1.621a1 1 0 00.249-1.287l-1.133-1.962a1 1 0 00-1.239-.428l-2.437.979a6.994 6.994 0 00-1.924-1.113L12.283.86a1 1 0 00-.99-.859H9.027zm1.133 13a3 3 0 100-6 3 3 0 000 6z" fill="#5C5F62"></path></svg></a>
  						</p>
  						<!-- <p class="Polaris-DisplayText Polaris-welcome-name-subheading">Here's what happening with your store.</p> -->
				    </div>
				  </div>
				</div>
			</div>

			<div class="custom-box-cover dashboard-bottom-grid">
			  <div class="Polaris-Layout custom-flex-cover">
			  	<div class="Polaris-Layout__Section Polaris-Layout__Section--secondary dashboard-left-sec">
			      <div class="Polaris-Cardd custom-box-cover same-height-card">
			        
						  <div class="Polaris-Layout">
						    <div class="Polaris-Layout__Section icon-hide">
						    	
						      <div class="Polaris-Card transparent-background">
						        <div class="Polaris-Card__Section pd-none">
						        	<!-- <h2 class="Polaris-Heading text--uppercase">What is Lorem Ipsum?</h2> -->
						          <div class="welcome-page-description">Start localizing your store for different countries to give your international customers a better experience.</div>
						        </div>
						      </div>
						    </div>

						    <div class="Polaris-Layout__Section icon-hide Polaris-Layout__Section--secondary">
						      <div class="Polaris-Card">
					        <div class="Polaris-Card__Section">
					        	<a href="{{url('install_request')}}?shop=<?php echo $_GET['shop']?>">
					          <h2 class="Polaris-Heading flex-wrapper">
					          	<img src="{{ URL::asset('public/assets/setting.png') }}"/>
					            <span>Request for install via support.</span>
					          </h2>
					          <!--  <div>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div> -->
					          </a>
					          
					        <a href="{{url('/app_setting')}}?shop=<?php echo $_GET['shop']?>"><h2 class="Polaris-Heading flex-wrapper">
					          	<img src="{{ URL::asset('public/assets/setting.png') }}"/>
					            <span>Install app in theme manually.</span>
					          </h2>
					        </a>
					        </div>
					      </div>
						    </div>
						  </div>
						  
			      </div>
			    </div>

			  	<div class="Polaris-Layout__Section Polaris-Layout__Section--secondary dashboard-middle-sec">
			      <div class="Polaris-Cardd custom-box-cover same-height-card">
			        
						  <div class="Polaris-Layout">
						    <div class="Polaris-Layout__Section">
						    	<a href="{{url('country_price_setting')}}?shop=<?php echo $_GET['shop']?>"  style="color:#000;">
						      <div class="Polaris-Card">
						        <div class="Polaris-Card__Header">
						          <h2 class="Polaris-Heading text--uppercase">Configure prices by country</h2>
						        </div>
						        <div class="Polaris-Card__Section">
						          <p><span class="count-value">
						          	<?php echo $county_count ?></span>Countries Active</p>
						        </div>
						      </div>
						  </a>
						    </div>

						    <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary">
						    	 <a href="{{url('announcement_bar_setting')}}?shop=<?php echo $_GET['shop']?>"  style="color:#000;">
						      <div class="Polaris-Card">
						        <div class="Polaris-Card__Header">
						          <h2 class="Polaris-Heading text--uppercase">Configure announcement bars</h2>
						        </div>
						        <div class="Polaris-Card__Section">
						          <p><span class="count-value">
						          	<?php echo $announcement_bar_active; ?></span>Bars Active</p>
						        </div>
						      </div>
						  </a>
						    </div>
						  </div>

			      </div>
			    </div>

			    <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary dashboard-right-sec">
			      <div class="Polaris-Cardd custom-box-cover same-height-card">
			        
						  <div class="Polaris-Layout">
						    <div class="Polaris-Layout__Section">
						    	<a href="{{url('country_redirect_setting')}}?shop=<?php echo $_GET['shop']?>" style="color:#000;">
						      <div class="Polaris-Card">
						        <div class="Polaris-Card__Header">
						          <h2 class="Polaris-Heading text--uppercase">Configure Page Redirects</h2>
						        </div>
						        <div class="Polaris-Card__Section">
						          <p><span class="count-value"><?php echo $total_redirects; ?></span>Redirects Active</p>
						        </div>
						      </div>
						  </a>
						    </div>

						    <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary">
						      <div class="Polaris-Card">
						        <div class="Polaris-Card__Header">
						          <h2 class="Polaris-Heading text--uppercase">Have Questions?</h2>
						        </div>
						        <div class="Polaris-Card__Section">
						          <a href="https://support.chaostheoryhq.com" target="_blank">Check Out Our FAQ
						          	<span class="Polaris-Icon_yj27d new-tab-icon Polaris-Icon--newDesignLanguage_1rik8" aria-label="(opens a new window)"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true"><path d="M14 13v1a1 1 0 0 1-1 1H6c-.575 0-1-.484-1-1V7a1 1 0 0 1 1-1h1c1.037 0 1.04 1.5 0 1.5-.178.005-.353 0-.5 0v6h6V13c0-1 1.5-1 1.5 0zm-3.75-7.25A.75.75 0 0 1 11 5h4v4a.75.75 0 0 1-1.5 0V7.56l-3.22 3.22a.75.75 0 1 1-1.06-1.06l3.22-3.22H11a.75.75 0 0 1-.75-.75z"></path></svg></span>
						          </a>
						        </div>
						      </div>
						    </div>
						  </div>
						  
			      </div>
			    </div>

			    

			    <!-- <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary dashboard-right-sec">
			      <div class="Polaris-Card same-height-card">
			        <div class="Polaris-Card__Header">
			          <h2 class="Polaris-Heading">Just a few steps and you’ll start making sales!</h2>
			        </div>
			        <div class="Polaris-Card__Section">

			          <div class="progress-bar">    	
								  <div class="Polaris-ProgressBar Polaris-ProgressBar--sizeSmall"><progress class="Polaris-ProgressBar__Progress" value="40" max="100"></progress>
							    <div class="Polaris-ProgressBar__Indicator app-setup-progress" style="width: 40%;"><span class="Polaris-ProgressBar__Label">40%</span></div>
								  </div>
			          </div>
                <label class="Polaris-Choice duplicate-checkbox" for="PolarisCheckbox6" style="display:none">
				          	<span class="Polaris-Choice__Control">
				          		<span class="Polaris-Checkbox">
				          			<input id="PolarisCheckbox6" type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" readonly>
				          			<span class="Polaris-Checkbox__Backdrop"></span>
								      </span>
								    </span>
							    </label>
			          <div class="dash-checkbox-cover" style="pointer-events: all;">
				          <label class="Polaris-Choice" for="PolarisCheckbox6">
				          	<span class="Polaris-Choice__Control">
				          		<span class="Polaris-Checkbox">
				          			<input id="PolarisCheckbox6" type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" readonly value=""<?php if(count($theme_setup) > 0){ echo 'checked';}?>>
				          			<span class="Polaris-Checkbox__Backdrop"></span>
				          			<span class="Polaris-Checkbox__Icon">
				          				<span class="Polaris-Icon">
				          					<svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
	              							<path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0">
	              							</path>
								            </svg>
								          </span>
								        </span>
								      </span>
								    </span>

							      <a href="{{url('/app_setting')}}?shop=<?php echo $_GET['shop']?>"><span class="Polaris-Choice__Label">Install and setup in theme <span class="Polaris-Icon_yj27d new-tab-icon Polaris-Icon--newDesignLanguage_1rik8" aria-label="(opens a new window)"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true"><path d="M14 13v1a1 1 0 0 1-1 1H6c-.575 0-1-.484-1-1V7a1 1 0 0 1 1-1h1c1.037 0 1.04 1.5 0 1.5-.178.005-.353 0-.5 0v6h6V13c0-1 1.5-1 1.5 0zm-3.75-7.25A.75.75 0 0 1 11 5h4v4a.75.75 0 0 1-1.5 0V7.56l-3.22 3.22a.75.75 0 1 1-1.06-1.06l3.22-3.22H11a.75.75 0 0 1-.75-.75z"></path></svg></span></span></a>
							    </label>

							    <label class="Polaris-Choice" for="PolarisCheckbox6">
				          	<span class="Polaris-Choice__Control">
				          		<span class="Polaris-Checkbox">
				          			<input id="PolarisCheckbox6" type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" readonly value="" <?php if($county_count > 0){ echo 'checked';}?>>
				          			<span class="Polaris-Checkbox__Backdrop"></span>
				          			<span class="Polaris-Checkbox__Icon">
				          				<span class="Polaris-Icon">
				          					<svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
	              							<path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0">
	              							</path>
								            </svg>
								          </span>
								        </span>
								      </span>
								    </span>

							      <a href="{{url('country_price_setting')}}?shop=<?php echo $_GET['shop']?>"><span class="Polaris-Choice__Label">Configure prices by country <span class="Polaris-Icon_yj27d new-tab-icon Polaris-Icon--newDesignLanguage_1rik8" aria-label="(opens a new window)"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true"><path d="M14 13v1a1 1 0 0 1-1 1H6c-.575 0-1-.484-1-1V7a1 1 0 0 1 1-1h1c1.037 0 1.04 1.5 0 1.5-.178.005-.353 0-.5 0v6h6V13c0-1 1.5-1 1.5 0zm-3.75-7.25A.75.75 0 0 1 11 5h4v4a.75.75 0 0 1-1.5 0V7.56l-3.22 3.22a.75.75 0 1 1-1.06-1.06l3.22-3.22H11a.75.75 0 0 1-.75-.75z"></path></svg></span></span></a>
							    </label>

							    <label class="Polaris-Choice" for="PolarisCheckbox6">
				          	<span class="Polaris-Choice__Control">
				          		<span class="Polaris-Checkbox">
				          			<input id="PolarisCheckbox6" readonly type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value="" <?php if($total_redirects > 0){ echo 'checked';}?>>
				          			<span class="Polaris-Checkbox__Backdrop"></span>
				          			<span class="Polaris-Checkbox__Icon">
				          				<span class="Polaris-Icon">
				          					<svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
	              							<path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0">
	              							</path>
								            </svg>
								          </span>
								        </span>
								      </span>
								    </span>

							      <a href="{{url('country_redirect_setting')}}?shop=<?php echo $_GET['shop']?>"><span class="Polaris-Choice__Label">Configure page redirects by country <span class="Polaris-Icon_yj27d new-tab-icon Polaris-Icon--newDesignLanguage_1rik8" aria-label="(opens a new window)"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true"><path d="M14 13v1a1 1 0 0 1-1 1H6c-.575 0-1-.484-1-1V7a1 1 0 0 1 1-1h1c1.037 0 1.04 1.5 0 1.5-.178.005-.353 0-.5 0v6h6V13c0-1 1.5-1 1.5 0zm-3.75-7.25A.75.75 0 0 1 11 5h4v4a.75.75 0 0 1-1.5 0V7.56l-3.22 3.22a.75.75 0 1 1-1.06-1.06l3.22-3.22H11a.75.75 0 0 1-.75-.75z"></path></svg></span></span></a>
							    </label>

							    <label class="Polaris-Choice" for="PolarisCheckbox6">
				          	<span class="Polaris-Choice__Control">
				          		<span class="Polaris-Checkbox">
				          			<input id="PolarisCheckbox6" type="checkbox" class="Polaris-Checkbox__Input" aria-invalid="false" role="checkbox" aria-checked="false" value="" <?php if($announcement_bar_active > 0){ echo 'checked';}?>>
				          			<span class="Polaris-Checkbox__Backdrop"></span>
				          			<span class="Polaris-Checkbox__Icon">
				          				<span class="Polaris-Icon">
				          					<svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
	              							<path d="M8.315 13.859l-3.182-3.417a.506.506 0 0 1 0-.684l.643-.683a.437.437 0 0 1 .642 0l2.22 2.393 4.942-5.327a.436.436 0 0 1 .643 0l.643.684a.504.504 0 0 1 0 .683l-5.91 6.35a.437.437 0 0 1-.642 0">
	              							</path>
								            </svg>
								          </span>
								        </span>
								      </span>
								    </span>

							      <a href="{{url('announcement_bar_setting')}}?shop=<?php echo $_GET['shop']?>"><span class="Polaris-Choice__Label">Configure announcement bars by country <span class="Polaris-Icon_yj27d new-tab-icon Polaris-Icon--newDesignLanguage_1rik8" aria-label="(opens a new window)"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg_375hu" focusable="false" aria-hidden="true"><path d="M14 13v1a1 1 0 0 1-1 1H6c-.575 0-1-.484-1-1V7a1 1 0 0 1 1-1h1c1.037 0 1.04 1.5 0 1.5-.178.005-.353 0-.5 0v6h6V13c0-1 1.5-1 1.5 0zm-3.75-7.25A.75.75 0 0 1 11 5h4v4a.75.75 0 0 1-1.5 0V7.56l-3.22 3.22a.75.75 0 1 1-1.06-1.06l3.22-3.22H11a.75.75 0 0 1-.75-.75z"></path></svg></span></span></a>
							    </label>
						  	</div>
        
			        </div>
			      </div>
			    </div> -->

			  </div>
			</div>
		</div>

  </body>
</html>