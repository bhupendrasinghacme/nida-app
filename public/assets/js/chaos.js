  //  open_tab_Country_price_setting TABS //
  function open_tab(evt, TabName) {
    var i, tabcontent, tablinks;

    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(TabName).style.display = "block";
	try{
    evt.currentTarget.className += " active";
	}
	catch(err){}
  }
  // TABS //
  function snackbar_custom_toast(response){
    $('#PolarisPortalsContainer').removeClass('hidden-toast');
    $('.toast-message').text(response);
    setTimeout(function(){
      $('#PolarisPortalsContainer').addClass('hidden-toast');
    },4000)
  }
  // slider code //
	function updateTextInput(val) {
	  document.getElementById('rangevalue').innerHTML=val; 
	  document.getElementById('rangeslider').value = val;
	}
  function updateTextInputTop(val) {
    document.getElementById('rangevaluepaddingtop').innerHTML=val; 
    document.getElementById('rangeslidertop').value = val;
  }
	function updateTextWeight(val){
		document.getElementById('rangevalueWeight').innerHTML=val; 
	  document.getElementById('rangesliderWeight').value = val;
	}
  // slider code //
$(document).ready(function() {

  $('.tablinks').eq(0).click().addClass('active');
  $('.toast-close').click(function(){
    $('#PolarisPortalsContainer').addClass('hidden-toast');
  })
  // GET DATA FROM URL //
  $.urlParam = function (name) {
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.search);
    return (results !== null) ? results[1] || 0 : false;
  }
   // GET DATA FROM URL //

	// max height //
	var maxHeight = Math.max.apply(null, $(".dashboard-bottom-grid .custom-box-cover .Polaris-Layout__Section .Polaris-Card").map(function ()
	{
		return $(this).height();
	}).get());
	$(".dashboard-bottom-grid .custom-box-cover .Polaris-Layout__Section .Polaris-Card").css('height',maxHeight)
	// max height //

  // CURRENT TIME CHECK //
  function dateTime() {
  var format="";
    var ndate = new Date();
	var hr = ndate.getHours();
    var h = hr % 12;
	
	 if (hr < 12)
	 {
        greet = 'Good Morning';
		format='AM';
		}
    else if (hr >= 12 && hr < 16)
	{
        greet = 'Good Afternoon';
		format='PM';
		}
    else if (hr >= 16 && hr <= 24)
        greet = 'Good Evening';
  $('.day-status').html(greet);
  }
  /*setInterval(dateTime, 1000);*/
  dateTime();

  // CURRENT TIME CHECK //
  
  // file name when uploading //
  $('#ticket_file').change(function(){
	  var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
	  $('.selected-file-name').text(filename);
  })
	
  // file name when uploading //
$('.trigger-modal').click(function(e){
   e.preventDefault();
	$('.modal').hide();

         $('#country_id').val($(this).attr('data-country-id'));
  


	$('#'+$(this).attr('data-target')).show();	
})
$('.Polaris-Modal-CloseButton,.popup-close').click(function(e){
   e.preventDefault();
	$('.modal').hide();
})
 $('.google-font-selector,.google-font_family,.google-font-selector-country').fontselect();
  
  $('.fs-results').click(function(){
	  $('.font-select').removeClass('font-select-active');
	  $('.fs-drop').hide();
  })
  var active_states = $('.dash-checkbox-cover input:Checked').length;
  var active_percentage = (active_states/4)*100;
  $('.app-setup-progress').css('width',active_percentage+'%');
  setTimeout(function(){
	  $('.msg').hide();
  },5000)
  $('.shopfiy_theme').change(function(){
    setTimeout(function(){
      $('.shopfiy_theme-hidden').val($('.shopfiy_theme option:selected').attr('data-value')).change();
      console.log($('.shopfiy_theme-hidden').val());
    },1000)
    
  })
});

$(document).ready(function(){
  $('.hidden-radio-button').each(function(){
   var value = $(this).find('input:checked').val();
   var selector = $(this);
   if(value == 1){
    selector.prev().find('input').prop('checked',true);
   }
   else{
    selector.prev().find('input').prop('checked',false);
   }
  })
  $('.custom-switch').click(function(){
    var selector = $(this);
    setTimeout(function(){
        if(selector.find('input').is(":checked")){
     selector.next().find("input[value='1']").click();
    }
    else{
     selector.next().find("input[value='0']").click();
    }
  },1000)
  
    
  })
	$('.save-theme-content').click(function(){
		$(".install_theme").click();
	})
  $(".install_theme").click(function(){
     var shop = $(".shop_url").val();
     var theme_id = $(".shopfiy_theme").val();
	 var google_tracking = $(".google_tracking_code").val();
     var facebook_tracking = $(".facebook_pixel").val();
      $.ajax({
          url: "theme_install_fun_ajax",
          type:"POST",
          data:{
            google_tracking:google_tracking,facebook_tracking:facebook_tracking,shop:shop,theme_id:theme_id
          },
          success:function(response){
            snackbar_custom_toast(response) 
          }
      });
   });
  $('.help_btn').click( function(event){           
       event.stopPropagation();           
       $('.help_menu').toggle();  
$('.feedback_menu').hide();	   
  });
  $('.feedback_btn').click( function(event){           
       event.stopPropagation();           
       $('.feedback_menu').toggle(); 
$(".help_menu").hide(); 	   
  });
  $(document).click(function(){
     $(".help_menu").hide(); 
     $('.feedback_menu').hide();
  });
  $(".feature_integration_btn").click(function(){
    var shop = $(".shop_url").val();
      $.ajax({
          url: "feature_integration_mail",
          type:"POST",
          data:{
            shop:shop
          },
          success:function(response){
            console.log(response);
            snackbar_custom_toast(response) 
          }
      });
  })
  $('input#upload').change(function(e){
      var fileName = e.target.files[0].name;
      jQuery(".file_name").text(fileName);
  });
  // Select box common JS //
  $('.Polaris-Select__Input').change(function(){
	  $(this).next().find('.Polaris-Select__SelectedOption').text($(this).find('option:selected').text());
  })
	$('.Polaris-Select__Input').each(function(){
		$(this).next().find('.Polaris-Select__SelectedOption').text($(this).find('option:selected').text());
	})
  $('.Polaris-Select__Input').on('click',function(ev){
    if(ev.offsetY < 0){
      $(this).next().find('.Polaris-Select__SelectedOption').text($(this).find('option:selected').text());  
    }else{
      //dropdown is shown
    }
  });
  // Select box common JS //
  
  // header menu active //
  $('.header-menu .Polaris-Tabs__Tab').removeClass('Polaris-Tabs__Tab--selected');
  $('.header-menu a').each(function(){
	  var url = $(this).attr('href');
	  if(window.location.href == url){
		  $(this).find('button').addClass('Polaris-Tabs__Tab--selected');
	  }
  })
  // header menu active //
  $('#selector-down').click(function(){
	  $('.preview-wrapper').removeClass('header');
  })
  $('#selector-up').click(function(){
	  $('.preview-wrapper').addClass('header');
  })
  if($.urlParam('product_tab') == 'true'){
    $('.tablinks').removeClass('active');
    $('.tabcontent').hide();
    $('#Product_Managment').show();
    $('#product-pricing-management').addClass('active');
  }
});
// Common functions runs after each ajax call
$(document).ajaxComplete(function(){
  $('.Polaris-Select__Input').change(function(){
	  $(this).next().find('.Polaris-Select__SelectedOption').text($(this).find('option:selected').text());
  })
  	$('.Polaris-Select__Input').each(function(){
		$(this).next().find('.Polaris-Select__SelectedOption').text($(this).find('option:selected').text());
	})
  $('.Polaris-Select__Input').on('click',function(ev){
    if(ev.offsetY < 0){
      $(this).next().find('.Polaris-Select__SelectedOption').text($(this).find('option:selected').text());  
    }else{
      //dropdown is shown
    }
  });
  $('.google-font-selector').next('.font-select').remove();
   $('.google-font-selector').fontselect();
    $('.hidden-radio-button').each(function(){
   var value = $(this).find('input:checked').val();
   var selector = $(this);
   if(value == 1){
    selector.prev().find('input').prop('checked',true);
   }
   else{
    selector.prev().find('input').prop('checked',false);
   }
  })
    if($('#currentpage').hasClass('edit-module')){
      $('.custom-switch').click(function(){
        var selector = $(this);
        setTimeout(function(){
            if(selector.find('input').is(":checked")){
         selector.next().find("input[value='1']").click();
        }
        else{
         selector.next().find("input[value='0']").click();
        }
      },1000)
      
        
      })
    }
});