<!doctype html>
<?php header('Content-Type: text/html; charset=ISO-8859-1'); ?>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
       <!--  <link rel="stylesheet" href="https://unpkg.com/@shopify/polaris@5.2.1/dist/styles.css"/> -->
       <link rel="stylesheet" href="https://sdks.shopifycdn.com/polaris/2.12.1/polaris.min.css" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="{{ URL::asset('public/assets/js/jquery.fontselect.min.js') }}?<?php echo rand(1,1000000);?>"></script>
      <script src="{{ URL::asset('public/assets/js/chaos.js') }}?<?php echo rand(1,1000000);?>"></script>
      <script src="{{ URL::asset('public/assets/js/country_setting_controller.js') }}?<?php echo rand(1,1000000);?>"></script>
      <script src="{{ URL::asset('public/assets/js/country_redirection_controller.js') }}?<?php echo rand(1,1000000);?>"></script>
      <script src="{{ URL::asset('public/assets/js/announcement_bar_setting.js') }}?<?php echo rand(1,1000000);?>"></script>
      <script src="{{ URL::asset('public/assets/js/chosen.jquery.min.js') }}?<?php echo rand(1,1000000);?>"></script>
      <script src="{{ URL::asset('public/assets/js/init.js') }}?<?php echo rand(1,1000000);?>"></script>
      <link  rel="stylesheet" href="{{ URL::asset('public/assets/css/chosen.min.css') }}?<?php echo rand(1,1000000);?>">
      <link  rel="stylesheet" href="{{ URL::asset('public/assets/css/chaos.css') }}?<?php echo rand(1,1000000);?>">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- <link href="{{ URL::asset('js/project.js') }}" rel="script"> -->
        <!-- Styles -->
        <style>
            html, body {
                background-color: #gray;
                color: #212b36;
               /* font-family: 'Raleway', sans-serif;*/
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

      
        </style>
        <script src="https://cdn.shopify.com/s/assets/external/app.js"></script>
    <script type="text/javascript">
      var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
        var shop_url = getUrlParameter('shop');
      ShopifyApp.init({
          apiKey: "1486a742bfecfdaf900157d7b6585eeb",
          shopOrigin:"https://"+shop_url,
          debug: false,
          forceRedirect: true
        });
        ShopifyApp.ready(function(){
            ShopifyApp.Bar.loadingOff();
        })
     </script>
    </head>
    <body>

      
      <div class="main-header-wrapper">
      <div class="Polaris-Layout">
        <div class="Polaris-Layout__Section">
          <div class="Polaris-Cardd">
            <!-- <div class="Polaris-Card__Header">
              <h2 class="Polaris-Heading">Online store dashboard</h2>
            </div> -->

            <div class="Polaris-Card__Sectionn main-header-top">
              <div class="Polaris-Cardd header-btm-border">
                <div>
                  <div class="Polaris-Tabs__Wrapper main-header-cover">
                    <ul role="tablist" class="Polaris-Tabs header-menu">
                      <li class="Polaris-Tabs__TabContainer">
                        <a href="{{url('/dashboard')}}?shop=<?php echo $_GET['shop']?>">
                          <button id="" role="tab" type="button" tabindex="0" class="Polaris-Tabs__Tab" aria-selected="true" aria-controls="Dashboard-content" aria-label="Dashboard">
                            <span class="Polaris-Tabs__Title">Dashboard</span>
                          </button> 
                        </a>
                      </li>

                      <li class="Polaris-Tabs__TabContainer">
                        <a href="{{url('/app_setting')}}?shop=<?php echo $_GET['shop']?>">
                          <button id="" role="tab" type="button" tabindex="0" class="Polaris-Tabs__Tab" aria-selected="true" aria-controls="Country-Price-Setting">
                            <span class="Polaris-Tabs__Title">General Settings</span>
                          </button> 
                        </a>
                      </li>

                      <li class="Polaris-Tabs__TabContainer">
                        <a href="{{url('country_price_setting')}}?shop=<?php echo $_GET['shop']?>">
                          <button id="" role="tab" type="button" tabindex="0" class="Polaris-Tabs__Tab" aria-selected="true" aria-controls="Country-Price-Setting">
                            <span class="Polaris-Tabs__Title">Price Settings</span>
                          </button> 
                        </a>
                      </li>

                      <li class="Polaris-Tabs__TabContainer">
                        <a href="{{url('country_redirect_setting')}}?shop=<?php echo $_GET['shop']?>">
                          <button id="" role="tab" type="button" tabindex="0" class="Polaris-Tabs__Tab" aria-selected="true" aria-controls="Country-Redirect-Setting">
                            <span class="Polaris-Tabs__Title">Redirect Settings</span>
                          </button> 
                        </a>
                      </li>

                      <li class="Polaris-Tabs__TabContainer">
                        <a href="{{url('announcement_bar_setting')}}?shop=<?php echo $_GET['shop']?>">
                          <button id="" role="tab" type="button" tabindex="0" class="Polaris-Tabs__Tab" aria-selected="true" aria-controls="Announcement-Bar-Setting">
                            <span class="Polaris-Tabs__Title">Announcement Bar Settings</span>
                          </button> 
                        </a>
                      </li>
                    </ul>

                    <div class="header-button-wrapper">
                      <div class="help_wrap">
                        <button type="button" class="Polaris-Button help_btn" tabindex="0" aria-controls="Polarispopover2" aria-owns="Polarispopover2" aria-expanded="true"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Help</span><span class="Polaris-Button__Icon">
                          <div class="Polaris-Button__DisclosureIcon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                              <path d="M5 8l5 5 5-5H5z"></path>
                            </svg></span></div>
                         </span></span>
                       </button>
                        <div class="Polaris-PositionedOverlay Polaris-Popover__PopoverOverlay Polaris-Popover__PopoverOverlay--open help_menu" style="top: 44px; left: 0px; display: none">
                          <div class="Polaris-Popover" data-polaris-overlay="true">
                            <div class="Polaris-Popover__FocusTracker" tabindex="0"></div>
                            <div class="Polaris-Popover__Wrapper">
                              <div id="Polarispopover2" tabindex="-1" class="Polaris-Popover__Content">
                                <div class="Polaris-Popover__Pane Polaris-Scrollable Polaris-Scrollable--vertical" data-polaris-scrollable="true">
                                  <ul class="Polaris-OptionList">
                                    <li>
                                      <ul class="Polaris-OptionList__Options" id="PolarisOptionList11-0">
                                        <li class="Polaris-OptionList-Option" tabindex="-1"><a href="https://support.chaostheoryhq.com/hc/en-us/articles/360018587220-Install-Instructions" target="_blank"><button id="PolarisOptionList11-0-4" type="button" class="Polaris-OptionList-Option__SingleSelectOption">
                                        Install Instructions
                                        </button></a></li>
                                        <li class="Polaris-OptionList-Option" tabindex="-1">
                                        <a href="https://support.chaostheoryhq.com" target="_blank">
                                        <button id="PolarisOptionList11-0-0" type="button" class="Polaris-OptionList-Option__SingleSelectOption">FAQ</button>
                                        </a></li>
                                        <li class="Polaris-OptionList-Option" tabindex="-1">
                                        <a href="https://support.chaostheoryhq.com/hc/en-us/requests/new" target="_blank">
                                        <button id="PolarisOptionList11-0-1" type="button" class="Polaris-OptionList-Option__SingleSelectOption">
                                        Submit a Ticket</button></a></li>
                                        <li class="Polaris-OptionList-Option" tabindex="-1">
                                        <a href="{{url('/change_log')}}?shop=<?php echo $_GET['shop']?>">
                                        <button id="PolarisOptionList11-0-2" type="button" class="Polaris-OptionList-Option__SingleSelectOption">Changelog</button></a></li>
                                        <li class="Polaris-OptionList-Option" tabindex="-1">
                                        <a href="https://chaostheoryhq.com/pages/privacy-policy" target="_blank">
                                        <button id="PolarisOptionList11-0-2" type="button" class="Polaris-OptionList-Option__SingleSelectOption">Privacy Policy</button></a></li>
                                        <li class="Polaris-OptionList-Option" tabindex="-1">
                                        <a href="https://chaostheoryhq.com/" target="_blank">
                                        <button id="PolarisOptionList11-0-3" type="button" class="Polaris-OptionList-Option__SingleSelectOption">Website Design & Development</button></a></li>
                                      </ul>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="Polaris-Popover__FocusTracker" tabindex="0"></div>
                          </div>
                         </div>
                      </div>

                      <div class="feedback_wrap">
                        <button type="button" class="Polaris-Button feedback_btn" tabindex="0" aria-controls="Polarispopover2" aria-owns="Polarispopover2" aria-expanded="true"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Feedback</span><span class="Polaris-Button__Icon">
                          <div class="Polaris-Button__DisclosureIcon"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                              <path d="M5 8l5 5 5-5H5z"></path>
                            </svg></span></div>
                         </span></span></button>
                        <div class="Polaris-PositionedOverlay Polaris-Popover__PopoverOverlay Polaris-Popover__PopoverOverlay--open feedback_menu" style="top: 44px; left: 0px; display: none">
                          <div class="Polaris-Popover" data-polaris-overlay="true">
                            <div class="Polaris-Popover__FocusTracker" tabindex="0"></div>
                            <div class="Polaris-Popover__Wrapper">
                              <div id="Polarispopover2" tabindex="-1" class="Polaris-Popover__Content">
                                <div class="Polaris-Popover__Pane Polaris-Scrollable Polaris-Scrollable--vertical" data-polaris-scrollable="true">
                                  <ul class="Polaris-OptionList">
                                    <li>
                                      <ul class="Polaris-OptionList__Options" id="PolarisOptionList11-0">
                                        <li class="Polaris-OptionList-Option" tabindex="-1"><a href="{{url('/app_feature')}}?shop=<?php echo $_GET['shop']?>"><button id="PolarisOptionList11-0-4" type="button" class="Polaris-OptionList-Option__SingleSelectOption">
                                        Feature Request
                                        </button></a></li>
                                        <li class="Polaris-OptionList-Option" tabindex="-1">
                                        <a href="{{url('/share_feedback')}}?shop=<?php echo $_GET['shop']?>">
                                        <button id="PolarisOptionList11-0-0" type="button" class="Polaris-OptionList-Option__SingleSelectOption">Share Feedback</button>
                                        </a></li>
                                      </ul>
                                    </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                            <div class="Polaris-Popover__FocusTracker" tabindex="0"></div>
                          </div>
                         </div>
                      </div>

                      <button type="button" class="Polaris-Button review_btn" tabindex="0" aria-controls="Polarispopover2" aria-owns="Polarispopover2" aria-expanded="true"><a href="https://apps.shopify.com/country-based-pricing" target="_blank"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Write a Review</span></span></a>
                      </button>
                    </div>

                  </div>  
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      </div>


      <div id="snackbar" ></div>
      <div id="PolarisPortalsContainer" class="hidden-toast"><div data-portal-id="Polarisportal2"><div class="Polaris-Frame-ToastManager" aria-live="polite"><div class="Polaris-Frame-ToastManager__ToastWrapper Polaris-Frame-ToastManager--toastWrapperEnterDone" style="--toast-translate-y-in:-80px; --toast-translate-y-out:90px;"><div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb; --p-frame-offset:0px;"><div class="Polaris-Frame-Toast"><span class="toast-message"></span><button type="button" class="Polaris-Frame-Toast__CloseButton toast-close"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true"><path d="M11.414 10l6.293-6.293a1 1 0 1 0-1.414-1.414L10 8.586 3.707 2.293a1 1 0 0 0-1.414 1.414L8.586 10l-6.293 6.293a1 1 0 1 0 1.414 1.414L10 11.414l6.293 6.293A.998.998 0 0 0 18 17a.999.999 0 0 0-.293-.707L11.414 10z"></path></svg></span></button></div></div></div></div></div></div>



