@include('shopify_header')

	<div class="Polaris-Page Polaris-Page--narrowWidth whole-cover">
 		<!-- <nav class="Polaris-top-custom-header" aria-label="Pagination">
	    <span class="Polaris-Back-Icon">
	      <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
	        <path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
	      </svg>
	    </span>

	    <div class="custom-heading main-title-head">Share Feedback</div>

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

    <div class="submit_ticket_wrap mt-20">
    	<div class="head_title hide">
	    	<button type="button" class="Polaris-Button Polaris-Button--primary tablinks">
	    		<span class="Polaris-Button__Content">
		    		<span class="Polaris-Button__Text">Back</span>
		    	</span>
	    	</button>

	  		<h2>Share Feedback</h2>
    	</div>

    	<div class="form-cover pt-20 pb-20">

    		<div class="custom-heading main-title-head Polaris-DisplayText Polaris-DisplayText--sizeMedium">Share Feedback</div>

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
			          	<label  for="question1" class="Polaris-Label__Text">ii.	Is there anything our app is missing or anything you had issues with? <span class="cumpulsary-field">*</span></label>
			          </div>
			        </div>
			        <div class="Polaris-Connected right">
			          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
			            <div class="Polaris-TextField"><textarea id="question1" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField3Label" aria-invalid="false" required="required" name="question1" aria-multiline="false"></textarea>
			              <div class="Polaris-TextField__Backdrop"></div>
			            </div>
			          </div>
			        </div>
			    	</div>
			    	<div class="Polaris-FormLayout__Item form-grid">
			        <div class="Polaris-Labelled__LabelWrapper left">
			          <div class="Polaris-Label">
			          	<label  for="question2" class="Polaris-Label__Text">Please let us know what we should improve.<span class="cumpulsary-field">*</span></label>
			          </div>
			        </div>
			        <div class="Polaris-Connected right">
			          <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
			            <div class="Polaris-TextField"><textarea id="question2" class="Polaris-TextField__Input" aria-labelledby="PolarisTextField3Label" aria-invalid="false" required="required" name="question2" aria-multiline="false"></textarea>
			              <div class="Polaris-TextField__Backdrop"></div>
			            </div>
			          </div>
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