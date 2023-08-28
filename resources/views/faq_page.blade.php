@include('shopify_header')
	<div class="Polaris-Page Polaris-Page--narrowWidth whole-cover">
    
    <!-- <nav class="Polaris-top-custom-header" aria-label="Pagination">
      <span class="Polaris-Back-Icon">
        <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
          <path d="M17 9H5.414l3.293-3.293a.999.999 0 1 0-1.414-1.414l-5 5a.999.999 0 0 0 0 1.414l5 5a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414L5.414 11H17a1 1 0 1 0 0-2z"></path>
        </svg>
      </span>

      <div class="custom-heading main-title-head">FAQ</div>

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
    </nav> -->

    <div class="faq-main-wrapper">

    	<div class="Polaris-Layout custom-flex-cover">
        <div class="Polaris-Layout__Section">
          <div class="Polaris-Card same-height-card">
            <div class="Polaris-Card__Header">
              <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall">Help</h2>
            </div>
            <div class="Polaris-Card__Section">
  				    <div class="Polaris-accordian-cover">
  				      <button class="accordion">Section 1</button>
                <div class="panel">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>

                <button class="accordion">Section 2</button>
                <div class="panel">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>

                <button class="accordion">Section 3</button>
                <div class="panel">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
  				    </div>   
  				  </div>
  			  </div>
  			</div>

        <div class="Polaris-Layout__Section mt-20 pt-20">
          <div class="Polaris-Card same-height-card">
            <div class="Polaris-Card__Header">
              <h2 class="Polaris-DisplayText Polaris-DisplayText--sizeSmall">FAQ</h2>
            </div>
            <div class="Polaris-Card__Section">
              <div class="Polaris-accordian-cover">
                <button class="accordion">Section 1</button>
                <div class="panel">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>

                <button class="accordion">Section 2</button>
                <div class="panel">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>

                <button class="accordion">Section 3</button>
                <div class="panel">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
              </div>   
            </div>
          </div>
        </div>
  		</div>

    </div>
  
  </div>

  <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        } 
      });
    }
  </script>

  </body>
</html>