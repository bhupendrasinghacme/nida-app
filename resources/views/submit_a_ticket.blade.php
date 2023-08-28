@include('shopify_header')

	<div class="Polaris-Page Polaris-Page--narrowWidth whole-cover">
 		<!-- <nav class="Polaris-top-custom-header" aria-label="Pagination">
	    <span class="Polaris-Back-Icon">
	      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
	        <path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
	      </svg>
	    </span>

	    <div class="custom-heading main-title-head">Submit a Ticket</div>

	    <div class="btn-cover right-sec">  
	      <div class="Polaris-ButtonGroup hidden">
	        <div class="Polaris-ButtonGroup__Item">
	          <button type="button" class="Polaris-Button Polaris-Button--destructive">
	            <span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Cancel</span></span>
	          </button>
	        </div>

	        <div class="Polaris-ButtonGroup__Item"><button type="button" class="Polaris-Button Polaris-Button--primary"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Save</span></span></button></div>
	      </div>
	    </div>
	  </nav> -->

    <div class="submit_ticket_wrap">
    	<div class="head_title hide">
	    	<button type="button" class="Polaris-Button Polaris-Button--primary tablinks">
	    		<span class="Polaris-Button__Content">
		    		<span class="Polaris-Button__Text">Back</span>
		    	</span>
	    	</button>

	  		<h2>Submit a ticket</h2>
    	</div>

    	<div class="form-cover pt-20 pb-20">
    		<div class="custom-heading main-title-head Polaris-DisplayText Polaris-DisplayText--sizeMedium">Submit a Ticket</div>

			  <div class="Polaris-FormLayout">
			  	<?php 
			  	if (isset($data)) {
			  		echo '<div class="msg">'.$data.'</div>';
			  	}
			  	?>
			  	<form action="" method="POST" enctype="multipart/form-data">
			    	<div class="Polaris-FormLayout__Item form-grid">
			        <div class="Polaris-Labelled__LabelWrapper left">
			          <div class="Polaris-Label">
			          	<label for="email_address" class="Polaris-Label__Text">Email Address <span class="cumpulsary-field">*</span></label>
			          </div>
			        </div>
			        <div class="Polaris-Connected right">
			          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
			            <div class="Polaris-TextField"><input id="email_address" class="Polaris-TextField__Input" type="email" aria-labelledby="PolarisTextField4Label" name="email_address" aria-invalid="false" aria-multiline="false" value="" required="required">
			              <div class="Polaris-TextField__Backdrop"></div>
			            </div>
			          </div>
			        </div>
			    	</div>

			    	<div class="Polaris-FormLayout__Item form-grid">
			        <div class="Polaris-Labelled__LabelWrapper left">
			          <div class="Polaris-Label">
			          	<label  for="subject" class="Polaris-Label__Text">Subject</label>
			          </div>
			        </div>
			        <div class="Polaris-Connected right">
			          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
			            <div class="Polaris-TextField"><input id="subject" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField3Label" aria-invalid="false" required="required" name="subject" aria-multiline="false" value="">
			              <div class="Polaris-TextField__Backdrop"></div>
			            </div>
			          </div>
			        </div>
			    	</div>

			    	<div class="Polaris-FormLayout__Item form-grid">
			        <div class="Polaris-Labelled__LabelWrapper left">
			          <div class="Polaris-Label">
			          	<label  for="subject" class="Polaris-Label__Text">Which Product best relates to your inquiry ? <span class="cumpulsary-field">*</span></label>
			          </div>
			        </div>

              <div class="Polaris-Select right"> 
                <select class="Polaris-Select__Input inquiry" name="inquiry" required="required">
			          	<option value="Announcement Bar">Announcement Bar</option>
			          	<option value="Country Pricing">Country Pricing</option>
			          	<option value="Page Redirection">Page Redirection</option>			
								</select>

                <div class="Polaris-Select__Content" aria-hidden="true">
                  <span class="Polaris-Select__SelectedOption">Select</span>
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

			    	<div class="Polaris-FormLayout__Item form-grid">
			        <div class="Polaris-Labelled__LabelWrapper left">
			          <div class="Polaris-Label">
			          	<label for="Support_category" class="Polaris-Label__Text">Support Category <span class="cumpulsary-field">*</span></label>
			          </div>
			        </div>

			        <div class="Polaris-Select right"> 
                <select class="Polaris-Select__Input support_category" name="support_category" required="required">
			          	<option value="Sales">Sales</option>
			          	<option value="Technical">Technical</option>
			          	<option value="Other">Other</option>			
								</select>

                <div class="Polaris-Select__Content" aria-hidden="true">
                  <span class="Polaris-Select__SelectedOption">Select</span>
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

			    	<div class="Polaris-FormLayout__Item form-grid">
			    		<div class="Polaris-Labelled__LabelWrapper left">
					      <div class="Polaris-Label">
					      	<label id="" for="details" class="Polaris-Label__Text">Details <span class="cumpulsary-field">*</span></label>
					      </div>
					    </div>

					    <div class="Polaris-Connected right">
					      <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
					        <div class="Polaris-TextField Polaris-TextField--hasValue Polaris-TextField--multiline">
					        	<textarea id="details" class="Polaris-TextField__Input details" style="height: 108px;" name="details"></textarea>
					          <div class="Polaris-TextField__Backdrop"></div>
					        </div>
					      </div>
					    </div>
			    	</div>

			    	<div class="Polaris-FormLayout__Item form-grid">
			        <div class="Polaris-Labelled__LabelWrapper left">
			          <div class="Polaris-Label">
			          	<label  for="shopify_address" class="Polaris-Label__Text">Web Shop Url (Enter your *.myshopify.com address) <span class="cumpulsary-field">*</span></label>
			          </div>
			        </div>
			        <div class="Polaris-Connected right">
			          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
			            <div class="Polaris-TextField"><input id="shopify_address" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField3Label" aria-invalid="false" name="shopify_address" aria-multiline="false" required="required" value="">
			              <div class="Polaris-TextField__Backdrop"></div>
			            </div>
			          </div>
			        </div>
			    	</div>

			    	<div class="Polaris-FormLayout__Item form-grid">
			        <div class="Polaris-Labelled__LabelWrapper left">
			          <div class="Polaris-Label">
			          	<label  for="store_name" class="Polaris-Label__Text">Store Name <span class="cumpulsary-field">*</span></label>
			          </div>
			        </div>
			        <div class="Polaris-Connected right">
			          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
			            <div class="Polaris-TextField"><input id="store_name" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField3Label" aria-invalid="false" required="required" name="store_name" aria-multiline="false" value="">
			              <div class="Polaris-TextField__Backdrop"></div>
			            </div>
			          </div>
			        </div>
			    	</div>

			    	<div class="Polaris-FormLayout__Item form-grid">
			        <div class="Polaris-Labelled__LabelWrapper left">
			          <div class="Polaris-Label">
			          	<label for="store_password" class="Polaris-Label__Text">Store Password (if password protected) <span class="cumpulsary-field">*</span></label>
			          </div>
			        </div>
			        <div class="Polaris-Connected right">
			          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
			            <div class="Polaris-TextField"><input id="store_password" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField3Label" aria-invalid="false" name="store_password" aria-multiline="false" value="">
			              <div class="Polaris-TextField__Backdrop"></div>
			            </div>
			          </div>
			        </div>
			    	</div>

			    	<div class="Polaris-FormLayout__Item">	    
			        <div class="upload-file-cover text--center">

			        	<label for="ticket_file" class="upload-btn">
			        		<img width="20" src="data:image/svg+xml,%3csvg fill='none' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill-rule='evenodd' clip-rule='evenodd' d='M20 10a10 10 0 11-20 0 10 10 0 0120 0zM5.3 8.3l4-4a1 1 0 011.4 0l4 4a1 1 0 01-1.4 1.4L11 7.4V15a1 1 0 11-2 0V7.4L6.7 9.7a1 1 0 01-1.4-1.4z' fill='%235C5F62'/%3e%3c/svg%3e" alt="">
			        	  File Upload
			          </label>
			          <div class="selected-file-name"></div>
			        	<input id="ticket_file" type="file" class="ticket_file" name="file" accept="image/*" style="display: none;">
			        	<div class="file_name"></div>
				      </div>
				    </div>

				    <div class="ticket-btn-cover text--center mt-20">
					    <button type="submit" name="mail_submit" class="Polaris-Button Polaris-Button--primary tablinks">
					    	<span class="submitticket"><span class="Polaris-Button__Text">Submit</span></span>
					    </button>

					    <button type="button" class="Polaris-Button ml-10">
					    	<span class="cancel_tickect"><span class="Polaris-Button__Text">Cancel</span></span>
					    </button>
					  </div>
			    </form>
			  </div>
			</div>
    </div>

  </div>

</body>
</html>