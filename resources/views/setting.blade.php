<!DOCTYPE html>
<html lang="en">
<head>
<title></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ asset('/css/polaris.css') }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style type="text/css">
.alert.alert-success {
  color: #3c763d;
  background-color: #dff0d8;
  border-color: #d6e9c6;
  padding: 10px 10px;
  margin: 10px 0 20px;
}
.Polaris-Tabs__Panel {
    color: #212B36;
}
.Polaris-TextContainer.Polaris-TextContainer--spacingLoose {
 padding: 5px 0 20px;
}
.Polaris-List__Item img{  
  margin: 10px 0 20px;
    border: 1px solid #F2F2F2;
   max-width: 100%;
    box-shadow: 0 0 1px rgba(0,0,0,.88) inset, 0 0 7px rgba(0,0,0,.1);
    border-radius: 5px;
}
.Polaris-Card {
    position: relative;
}
#loading {
  position: absolute;
  top: 50%;
  left: 50%;
  z-index: 99;
  transform: translate(-50%, -50%);
  text-align: center;
}
.loader_image {
    max-width: 150px;
}
.loader_image img {
    width: 100%;
    max-width: 100%;
}
.Polaris-List__Item{margin-top: 5px;}
</style>
<script type="text/javascript">
setTimeout(function(){ jQuery('.alert-success').hide() }, 3000);
</script>
</head>
<body style="background-color: #f4f6f8 !important;">

<div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb;">
<div class="Polaris-Card">
  <div id="loading" style="display: none" >
  <div class="loader_image"><img src="{{URL('/images/loader.gif')}}" alt="Loader" /></div>
<div>Synchronizing data..</div>
</div>
<div>
  <ul role="tablist" class="Polaris-Tabs">
    <li class="Polaris-Tabs__TabContainer"><button id="all-customers" role="tab" type="button" tabindex="0" class="Polaris-Tabs__Tab Polaris-Tabs__Tab--selected" aria-selected="true" aria-controls="all-customers-content" aria-label="All customers"><span class="Polaris-Tabs__Title">Setting</span></button></li>
    <li class="Polaris-Tabs__TabContainer"><button id="accepts-marketing" role="tab" type="button" tabindex="-1" class="Polaris-Tabs__Tab" aria-selected="false" aria-controls="accepts-marketing-content"><span class="Polaris-Tabs__Title">Support</span></button></li>
    <li class="Polaris-Tabs__TabContainer"><button id="help-page" role="tab" type="button" tabindex="-1" class="Polaris-Tabs__Tab" aria-selected="false" aria-controls="help-page-content"><span class="Polaris-Tabs__Title">Help</span></button></li>
    <li class="Polaris-Tabs__DisclosureTab">
      <div><button type="button" class="Polaris-Tabs__DisclosureActivator" aria-label="More tabs" tabindex="0" aria-controls="Polarispopover2" aria-owns="Polarispopover2" aria-expanded="false"><span class="Polaris-Tabs__Title"><span class="Polaris-Icon"><svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true">
                <path d="M6 10a2 2 0 1 1-4.001-.001A2 2 0 0 1 6 10zm6 0a2 2 0 1 1-4.001-.001A2 2 0 0 1 12 10zm6 0a2 2 0 1 1-4.001-.001A2 2 0 0 1 18 10z" fill-rule="evenodd"></path>
              </svg></span></span></button></div>
    </li>
  </ul>
  <div class="Polaris-Tabs__Panel" id="all-customers-content" role="tabpanel" aria-labelledby="all-customers" tabindex="-1">      
    <div class="Polaris-Card__Section">
      <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb;">
        <form action="/create_fixedparam" method="post">
           @if(isset($_GET['success']))
            <div class="alert alert-success">
               {{ $_GET['success'] }}
            </div>
        @endif
          <input type="hidden" name="store_id" value="{{ $shop_info->id }}">
         <input type="hidden" name="shop" value="{{ $shop_info->store_url }}">
         @foreach ($theme_data as $theme)
             @if($theme['role'] == 'main')
                    <input type="hidden" name="theme_id" value="{{ $theme['id'] }}">
             @endif
          @endforeach
          <div class="Polaris-FormLayout">
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField1" class="Polaris-Label__Text">Authentication Key:</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="authentication_key" class="Polaris-TextField__Input" type="text" name="authentication_key" placeholder="Authentication Key" value="@if(isset($shopify_user->project_key)){{ $shopify_user->project_key }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">User Name:</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="user_name" class="Polaris-TextField__Input" type="text" name="user_name" placeholder="User Name" value="@if(isset($shopify_user->username)){{ $shopify_user->username }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField3" class="Polaris-Label__Text">Password:</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="password" class="Polaris-TextField__Input" type="password" name="password" placeholder="Password" value="@if(isset($shopify_user->password)){{ $shopify_user->password }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-ResourceList__HeaderWrapper">
              <div class="Polaris-ResourceList__HeaderContentWrapper">
                <div class="Polaris-ResourceList__HeaderTitleWrapper">Firebase Setting</div>
              </div>
            </div>
             <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="" for="" class="Polaris-Label__Text">Api Key:</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
      <input id="api_key" class="Polaris-TextField__Input" type="text" name="api_key" placeholder="Api Key" 
                    value="@if(isset($shopify_user->fb_apikey)){{ $shopify_user->fb_apikey }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="" for="" class="Polaris-Label__Text">Auth Domain</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="authDomain" class="Polaris-TextField__Input" type="text" name="authDomain" placeholder="Auth Domain" value="@if(isset($shopify_user->fb_authDomain)){{ $shopify_user->fb_authDomain }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="" for="" class="Polaris-Label__Text">Database URL</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="databaseURL" class="Polaris-TextField__Input" type="text" 
                    name="databaseURL" placeholder="Database URL" value="@if(isset($shopify_user->fb_databaseURL)){{ $shopify_user->fb_databaseURL }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="" for="" class="Polaris-Label__Text">Project Id</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="projectId" class="Polaris-TextField__Input" type="text" 
                    name="projectId" placeholder="Project Id" value="@if(isset($shopify_user->fb_projectId)){{ $shopify_user->fb_projectId }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="" for="" class="Polaris-Label__Text">Storage Bucket</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="storageBucket" class="Polaris-TextField__Input" type="text" 
                    name="storageBucket" placeholder="Storage Bucket" value="@if(isset($shopify_user->fb_storageBucket)){{ $shopify_user->fb_storageBucket }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="" for="" class="Polaris-Label__Text">Messaging Sender Id</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="messagingSenderId" class="Polaris-TextField__Input" type="text" 
                    name="messagingSenderId" placeholder="Messaging Sender Id" value="@if(isset($shopify_user->fb_messagingSenderId)){{ $shopify_user->fb_messagingSenderId }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="" for="" class="Polaris-Label__Text">App Id</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="appId" class="Polaris-TextField__Input" type="text" 
                    name="appId" placeholder="appId" value="@if(isset($shopify_user->fb_appId)){{ $shopify_user->fb_appId }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="" for="" class="Polaris-Label__Text">Measurement Id</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="measurementId" class="Polaris-TextField__Input" type="text" 
                    name="measurementId" placeholder="Measurement Id" value="@if(isset($shopify_user->fb_measurementId)){{ $shopify_user->fb_measurementId }}@endif" required>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField3" class="Polaris-Label__Text">Firebase Embedded Code:</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <textarea id="PolarisTextField3" class="Polaris-TextField__Input" name="message" placeholder="" rows="8">
                      @if(isset($shopify_user->fb_apikey))
                      importScripts('https://www.gstatic.com/firebasejs/5.5.0/firebase-app.js');
                      importScripts('https://ecommerce.cronberry.com/firebase-messaging.js');
                      importScripts('https://www.gstatic.com/firebasejs/4.1.1/firebase.js');

                      var firebaseConfig = {
                          apiKey: "{{ $shopify_user->fb_apikey }}",
                          authDomain: "{{ $shopify_user->fb_authDomain }}",
                          databaseURL: "{{ $shopify_user->fb_databaseURL }}",
                          projectId: "{{ $shopify_user->fb_projectId }}",
                          storageBucket: "{{ $shopify_user->fb_storageBucket }}",
                          messagingSenderId: "{{ $shopify_user->fb_messagingSenderId }}",
                          appId: "{{ $shopify_user->fb_appId }}",
                          measurementId: "{{ $shopify_user->fb_measurementId }}"
                        };
                        firebase.initializeApp(firebaseConfig);
                          const messaging = firebase.messaging();
                      @endif
                    </textarea>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div> -->
              <div class="Polaris-FormLayout__Item"><button class="submit_form_button" type="submit" class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Submit</span></span></button></div>
            <span class="Polaris-VisuallyHidden"><button type="submit" class="submit_form_button" name="submit_auth">Submit</button></span>
          
          </div>
        </form>
      </div>
    </div>
    <!-- end form html -->
  </div>
  <div class="Polaris-Tabs__Panel" id="accepts-marketing-content" role="tabpanel" aria-labelledby="accepts-marketing" style="display: none;">
   <div class="Polaris-Card__Section">
      <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb;">
        @if (count($errors) > 0)
          <div class="alert alert-danger">
           <button type="button" class="close" data-dismiss="alert">×</button>
           <ul>
            @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
            @endforeach
           </ul>
          </div>
         @endif
        <form action="/support_form" method="post">
          <input type="hidden" name="shop_url" value="{{ $_GET['shop'] }}">
          <div class="Polaris-FormLayout">
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField1" class="Polaris-Label__Text">Enter Your Name:</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="PolarisTextField1" class="Polaris-TextField__Input" type="text" name="name" placeholder="Enter Your Name" value="" >
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField2" class="Polaris-Label__Text">Enter Your Email:</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <input id="PolarisTextField2" class="Polaris-TextField__Input" type="email" name="email" placeholder="Enter Your Email" value="" >
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item">
              <div class="Polaris-Labelled__LabelWrapper">
                <div class="Polaris-Label"><label id="PolarisTextField2Label" for="PolarisTextField3" class="Polaris-Label__Text">Enter Your Message:</label></div>
              </div>
              <div class="Polaris-Connected">
                <div class="Polaris-Connected__Item Polaris-Connected__Item--primary">
                  <div class="Polaris-TextField">
                    <textarea id="PolarisTextField3" class="Polaris-TextField__Input" name="message" placeholder="Enter Your Message" rows="6"></textarea>
                    <div class="Polaris-TextField__Backdrop"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="Polaris-FormLayout__Item"><button type="submit" class="Polaris-Button"><span class="Polaris-Button__Content"><span class="Polaris-Button__Text">Submit</span></span></button></div>
          <span class="Polaris-VisuallyHidden"><button type="submit" name="submit_auth">Submit</button></span>
          </div>
        </form>
      </div>
    <!-- end form html -->
    </div>
  </div>
  <div class="Polaris-Tabs__Panel" id="help-page-content" role="tabpanel" aria-labelledby="help-page" style="display: none;">
   <div class="Polaris-Card__Section">
      <div style="--top-bar-background:#00848e; --top-bar-background-lighter:#1d9ba4; --top-bar-color:#f9fafb;">
        <div style="--p-frame-offset:0px;">
        <h2 class="Polaris-Heading">Integrate Shopify with Cronberry</h2>
      </div>
      <div style="--p-frame-offset:0px;">
         <div class="Polaris-TextContainer Polaris-TextContainer--spacingLoose">
  <p>This document depicts the procedure of mapping your Shopify store with Cronberry. Shopify is a cloud-based, SAAS shopping cart solution.</p>
</div>
</div>

<div style="--p-frame-offset:0px;">
<h3 aria-label="Accounts" class="Polaris-Subheading">Need to fill out below details in a form</h3>
</div>

<div style="--p-frame-offset:0px;">
<ul class="Polaris-List Polaris-List--typeNumber">
  <li class="Polaris-List__Item">
    <div style="--p-frame-offset:0px;">
         <div class="Polaris-TextContainer Polaris-TextContainer--spacingLoose">
  <p>Cronberry authentication settings</p>
</div>
</div>
    <ul class="Polaris-List">
      <li class="Polaris-List__Item">
        <strong>Authentication Key :</strong> This is the project key generated on your Cronberry account as shown highlighted in below image.<br>
        <img src="{{URL('/images/auth.png')}}" />
      </li>
      <li class="Polaris-List__Item">
        <strong>Username & Password :</strong> These will be the same which is used for login into your Cronberry account.
      </li>
    </ul>
</li>
<li>
  <div style="--p-frame-offset:0px;">
         <div class="Polaris-TextContainer Polaris-TextContainer--spacingLoose">
  <p>Firebase settings</p>
</div>
</div>
<ul class="Polaris-List">
      <li class="Polaris-List__Item">
        For this information, you need to login your firebase account <a href="https://firebase.google.com/">https://firebase.google.com/</a> then click on Go To Console button.<br>
        <img src="{{URL('/images/firebase.png')}}" />
      </li>
      <li class="Polaris-List__Item">
        Then click on your listed firebase project. Under Project Overview > click on Project Settings.<br>
        <img src="{{URL('/images/firebase1.png')}}" />
      </li>
      <li class="Polaris-List__Item">
        In General section, When you will scroll down the page then all required Information you will get as per below screenshot.<br>
        <img src="{{URL('/images/firebase2.png')}}" />
      </li>
      <li class="Polaris-List__Item">
        Please fill all these details in required fields as per below screenshot.<br>
        <img src="{{URL('/images/firebase3.png')}}" />
      </li>
      
    </ul>
</li>
</ul>
</div>


<div style="--p-frame-offset:0px;">
<h3 aria-label="Accounts" class="Polaris-Subheading">Web Notifications</h3>
</div>
<div style="--p-frame-offset:0px;">
<ul class="Polaris-List Polaris-List--typeNumber">
  <li class="Polaris-List__Item">
   For web push notification, click on Allow Notification pop-up at your store.<br>
  <img src="{{URL('/images/web_push.png')}}" />
</li>
  <li class="Polaris-List__Item">
  We are collecting data on Cronberry if any user is signing up at your store(Email, first_name,last_name) , Order Success(Address, province, zip, name, country code, orders_count, total_spent,customer id, city, country, phone).
</li>
  <li class="Polaris-List__Item">
  Now login on Cronberry by using above test account credentials.
</li>
  <li class="Polaris-List__Item">
  Click on "Audience > View Audience" button in left side menu.<br>
  Here You will be able to view your user profile with all parameters & values.<br>
  <img src="{{URL('/images/view_audience.PNG')}}" />
</li>
<li class="Polaris-List__Item">
  You can also create segment for targeting your specific audience.<br>
For this click on “Segments” in left bar menu and click on “create segment” button for creating any group.<br>
  <img src="{{URL('/images/segments.PNG')}}" />
</li>
<li class="Polaris-List__Item">
  Now click on "Create Campaign" button in left side menu then you can click on "send to all audience" button(in case you want to send notifications to all audience)or you can chose your segment name(your specific audience) then Proceed and select “Push Notification” and update details(Title, Image,Icon,Body) for testing. You can send notifications now, schedule it for any date & time and also repeat it.
</li>
<li class="Polaris-List__Item">
Now You will be able to receive push notification on your web.<br>
  <img src="{{URL('/images/push_notification.PNG')}}" />
</li>
</ul>
</div>
<div style="--p-frame-offset:0px;">
<h3 aria-label="Accounts" class="Polaris-Subheading">In-App Notifications</h3>
</div>
<div style="--p-frame-offset:0px;">
<ul class="Polaris-List Polaris-List--typeNumber">
  <li class="Polaris-List__Item">
  On Cronberry, click on "Create Campaign"button in left side menu then you can click on "send to all audience" button(in case you want to send notifications to all audience)or you can chose your segment name(your specific audience) then Proceed and select “In App Notification” and update detail(Header Image, Header Text, Content,button). You can send notifications now, schedule it for any date & time and also repeat it.<br>
  <img src="{{URL('/images/in_app_notification.PNG')}}" />
</li>
  <li class="Polaris-List__Item">
  On your Shopify store, there is a bell icon in the middle where you can see your In App notification.<br>
  <img src="{{URL('/images/bell_icon.PNG')}}" />
</li>
</ul>
</div>
<div style="--p-frame-offset:0px;">
<h3 aria-label="Accounts" class="Polaris-Subheading">SMS Notifications</h3>
</div>
<div style="--p-frame-offset:0px;">
<ul class="Polaris-List">
  <li class="Polaris-List__Item">
  Click on "Create Campaign"button in left side menu then you can click on "send to all audience" button(in case you want to send notifications to all audience)or you can chose your segment name(your specific audience) then Proceed and select “SMS campaign” and update detail(Message). You can send sms now, schedule it for any date & time and also repeat it.<br>
  <img src="{{URL('/images/sms.PNG')}}" />
</li>
</ul>
</div>
<div style="--p-frame-offset:0px;">
<h3 aria-label="Accounts" class="Polaris-Subheading">Email Notifications</h3>
</div>
<div style="--p-frame-offset:0px;">
<ul class="Polaris-List">
  <li class="Polaris-List__Item">
  Click on "Create Campaign"button in left side menu then you can click on "send to all audience" button(in case you want to send notifications to all audience) or you can chose your segment name(your specific audience) then Proceed and select “Email campaign”and update detail(Subject,Email). You can send email now, schedule it for any date & time and also repeat it.<br>
  <img src="{{URL('/images/email.PNG')}}" />
</li>
</ul>
</div>
      </div>
    <!-- end form html -->
    </div>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$("#accepts-marketing").click(function(){
  $("#accepts-marketing-content").show();
  $("#accepts-marketing").addClass("Polaris-Tabs__Tab--selected");
  $("#all-customers").removeClass("Polaris-Tabs__Tab--selected");
  $("#help-page").removeClass("Polaris-Tabs__Tab--selected");
  $("#all-customers-content").hide();
  $("#help-page-content").hide();
});
$("#all-customers").click(function(){
  $("#accepts-marketing-content").hide();
  $("#help-page-content").hide();
  $("#all-customers").addClass("Polaris-Tabs__Tab--selected");
  $("#accepts-marketing").removeClass("Polaris-Tabs__Tab--selected");
  $("#help-page").removeClass("Polaris-Tabs__Tab--selected");
  $("#all-customers-content").show();
});
$("#help-page").click(function(){
  $("#all-customers-content").hide();
  $("#accepts-marketing-content").hide();
  $("#help-page").addClass("Polaris-Tabs__Tab--selected");
  $("#all-customers").removeClass("Polaris-Tabs__Tab--selected");
  $("#accepts-marketing").removeClass("Polaris-Tabs__Tab--selected");
  $("#help-page-content").show();
});
});
</script>
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
    apiKey: "94c1c40075ea2c9d617a48914c13dde7",
    shopOrigin:"https://"+shop_url,
    debug: false,
    forceRedirect: true
  });
  ShopifyApp.ready(function(){
      ShopifyApp.Bar.loadingOff();
  })
  $(document).ready(function() {
   $('.submit_form_button').click(function(e){
//e.preventDefault();
var authentication_key = $("#authentication_key").val();
var user_name = $("#user_name").val();
var password = $("#password").val();
var api_key = $("#api_key").val();
var authDomain = $("#authDomain").val();
var databaseURL = $("#databaseURL").val();
var storageBucket = $("#storageBucket").val();
var messagingSenderId = $("#messagingSenderId").val();
var appId = $("#appId").val();
var measurementId = $("#measurementId").val();
if(authentication_key != "" && user_name != "" && password != "" && api_key != "" && authDomain != "" && databaseURL != "" && storageBucket != "" && messagingSenderId != "" && appId != "" &&  measurementId != ""){
    $("#loading").show();
}
});
});
</script>
</body>
</html>
