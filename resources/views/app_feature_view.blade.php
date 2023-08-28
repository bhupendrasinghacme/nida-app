@include('shopify_header')

  <div class="Polaris-Page Polaris-Page--narrowWidth whole-cover">
		<div>

			<nav class="Polaris-top-custom-header" aria-label="Pagination">
				<span class="Polaris-Back-Icon">
					<svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
						<path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
					</svg>
				</span>

				<div class="custom-heading main-title-head Polaris-DisplayText--sizeMedium mb-10">Feature Request</div>
				
			</nav>


			<?php if(!empty($statusMsg)){ ?>
			<div class="msg"> <?php echo $statusMsg; ?></div>
			<?php } ?>
		  <div class="Polaris-Layout">
		  <input type="hidden" name="" class="shop_url" value="<?php echo $shop; ?>">
		    <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary left-section hide">
		      <div class="Polaris-Card">
		        <div class="Polaris-Card__Header">
		          <h2 class="Polaris-Heading text--center text--capitalize Polaris-DisplayText--sizeSmall custom-heading">Feature Integration</h2>
		        </div>

		        <div class="Polaris-Card__Section">
		          <div class="img-cover-wrapper">
		          	<img width="20" src="data:image/svg+xml,%3csvg fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill-rule='evenodd' clip-rule='evenodd' d='M20 10a10 10 0 11-20 0 10 10 0 0120 0zM5.3 8.3l4-4a1 1 0 011.4 0l4 4a1 1 0 01-1.4 1.4L11 7.4V15a1 1 0 11-2 0V7.4L6.7 9.7a1 1 0 01-1.4-1.4z' fill='%235C5F62'/%3e%3c/svg%3e" alt="">
		          </div>

							<div class="Polaris-FormLayout__Item text--center submit-btn">
							  <button type="button" class="feature_integration_btn Polaris-Button Polaris-Button--primary Polaris-Button--textAlignCenter">
							  	<span class="Polaris-Button__Content"><span class="Polaris-Button__Text">US$ 20</span></span>
							  </button>
							</div>

		      	</div>
		      </div>
		    </div>

		    <div class="Polaris-Layout__Section Polaris-Layout__Section--secondary right-section">
		      <div class="Polaris-Card">
		        <div class="Polaris-Card__Header">
		          <h2 class="Polaris-Heading text--center text--capitalize Polaris-DisplayText--sizeSmall custom-heading hide">Custom Request</h2>
		          <p>If there’s anything you could change in our app, what would it be? We’d love to hear from you. Your feedback is so valuable to us.</p>
		        </div>

		        <div class="Polaris-Card__Section">
						  <div class="Polaris-FormLayout">

						  <form action="" method="POST" enctype="multipart/form-data">
						    <div class="Polaris-FormLayout__Item">
						      <div class="">
						        <div class="Polaris-Labelled__LabelWrapper">
						          <div class="Polaris-Label"><label id="PolarisTextField3Label" for="PolarisTextField3" class="Polaris-Label__Text">Store name<span class="cumpulsary-field">*</span></label></div>
						        </div>
						        <div class="Polaris-Connected">
						          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
						            <div class="Polaris-TextField"><input id="PolarisTextField3" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField3Label" aria-invalid="false" aria-multiline="false" name="store_name" value="" required="required">
						              <div class="Polaris-TextField__Backdrop"></div>
						            </div>
						          </div>
						        </div>
						      </div>
						    </div>

						    <div class="Polaris-FormLayout__Item">
						      <div class="">
						        <div class="Polaris-Labelled__LabelWrapper">
						          <div class="Polaris-Label"><label id="PolarisTextField4Label" for="PolarisTextField4" class="Polaris-Label__Text">Email Address<span class="cumpulsary-field">*</span></label></div>
						        </div>
						        <div class="Polaris-Connected">
						          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
						            <div class="Polaris-TextField"><input id="PolarisTextField4" class="Polaris-TextField__Input" type="email" aria-labelledby="PolarisTextField4Label" aria-invalid="false" name="account_email" aria-multiline="false" value="" required="required">
						              <div class="Polaris-TextField__Backdrop"></div>
						            </div>
						          </div>
						        </div>
						      </div>
						    </div>

						    <div class="Polaris-FormLayout__Item">
						      <div class="">
								    <div class="Polaris-Labelled__LabelWrapper">
								      <div class="Polaris-Label"><label id="PolarisTextField24Label" for="PolarisTextField24" class="Polaris-Label__Text">Details<span class="cumpulsary-field">*</span></label></div>
								    </div>

								    <div class="Polaris-Connected">
								      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
								        <div class="Polaris-TextField Polaris-TextField--hasValue Polaris-TextField--multiline">
								        	<textarea id="PolarisTextField24" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField24Label" aria-invalid="false" aria-multiline="true" style="height: 108px;" required="required" name="shipping_address"></textarea>
								          <div class="Polaris-TextField__Backdrop"></div>
								          <div aria-hidden="true" class="Polaris-TextField__Resizer">
								            <div class="Polaris-TextField__DummyInput"><br></div>
								            <div class="Polaris-TextField__DummyInput"><br><br><br><br></div>
								          </div>
								        </div>
								      </div>
								    </div>
								  </div>
								</div>

								<div class="Polaris-FormLayout__Item">	    
						        <div class="upload-file-cover text--center">
						        	<label for="upload" class="upload-btn">
						        		<img width="20" src="data:image/svg+xml,%3csvg fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill-rule='evenodd' clip-rule='evenodd' d='M20 10a10 10 0 11-20 0 10 10 0 0120 0zM5.3 8.3l4-4a1 1 0 011.4 0l4 4a1 1 0 01-1.4 1.4L11 7.4V15a1 1 0 11-2 0V7.4L6.7 9.7a1 1 0 01-1.4-1.4z' fill='%235C5F62'/%3e%3c/svg%3e" alt="">
						        	  File Upload
						          </label>
						        	<input id="upload" type="file" name="file" accept="image/*" style="display: none;">
						        	<div class="file_name"></div>
						      </div>
						    </div>
								  

							  <div class="Polaris-FormLayout__Item text--center submit-btn">
								  <button type="submit" name="submit" class="Polaris-Button Polaris-Button--primary Polaris-Button--textAlignCenter">
								  	<span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Submit</span></span>
								  </button>
								</div>
							</form>
						  </div>
		        </div>
		      </div>
		    </div>
		  </div>

		</div>
  </div>

  </body>
</html>