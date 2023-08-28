


$(document).ready(function(){
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
$('#product-pricing-management').click(function(){
  $('body').css('opacity',0);
  if(document.location.href.indexOf('?')  > -1) {
      var url = document.location.href+"&product_tab=true";
  }else{
      var url = document.location.href+"?product_tab=true";
  }
  window.location.href = url;
})
$('.load-more-btn').click(function(){
  var shop = $('.shop_url').val();
  $('body').addClass('loading');
  var page_token = $(this).attr('data-target-token');
  setTimeout(function(){
  $.ajax({
      url: "loadmore?shop="+shop,
      type:"POST",
      data:{
       page_token:page_token,shop_url:shop
      },
      success:function(response){
       $('.products-wrapper').append(response);
       $('.load-more-btn').attr('data-target-token',$('.next-token').attr('data-page-token'));
       $('body').removeClass('loading');
       if($('.products-wrapper .individual-form-part').length >= parseInt($('.load-more-btn').attr('data-total-products'))){
          $('.load-more-btn').hide();
       }
        //show_data_announcement_bar_setting();
        //snackbar_toast(response);
      },
      error:function(){
        $('body').removeClass('loading');
      }
     });
  },500);
})
/* start  insert country,country Price setting*/
 $(".insert_country").click(function(e){
        e.preventDefault();

        var country = $('#country').val();
		var shop = $('.shop_url').val();
        console.log(country);
      $.ajax({
          url: "insert_country",
          type:"POST",
          data:{
           
            country:country,
			shop:shop
            
          },
          success:function(response){
          	snackbar_custom_toast(response);
            $('.popup-close').click();
           show_country_setting_data();
          },
         });
        });

 /* end  insert country,country Price setting*/


 /* start  update coustom  data ,country Price setting*/
 $(".setting_country_update").click(function(e){
        e.preventDefault();

        custom_name = $('#custom_name').val();
        custom_url = $('#custom_url').val();
        country_price_setting_id  = $('#country_id').val();
		shop = $('.shop_url').val();
		custom_rounding_price = $('#custom_rounding_price').val();
		different_country = $('#custom_country').val();
		
		console.log(different_country)
        var custom_flag = $('#custom_flag').prop('files')[0];
        var file_data = $('#custom_flag').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
		form_data.append('shop', shop);
        form_data.append('custom_name', custom_name);
        form_data.append('custom_url', custom_url);
		form_data.append('custom_rounding_price', custom_rounding_price);
		form_data.append('different_country', different_country);
        form_data.append('country_price_setting_id', country_price_setting_id);

      $.ajax({
          url: "setting_country_update",
          type:"POST",
          data: form_data,
          processData: false,
        contentType: false,
          success:function(response){
           snackbar_custom_toast(response) 
            $('.popup-close').click();
            $('#custom_name').val("");
            $('#custom_url').val("");
            $("#custom_flag").val("");
			$('#setting_country_update').val("");
            $('.enable-countries').find('[data-country-id="'+country_price_setting_id+'"]').attr('data-name',custom_name)
          },
         });
        });

 /* end  update coustom  data ,country Price setting*/

// Enable country module //
$('.country-price-status-module  label').not('.custom-switch').click(function(){
	if(!$(this).hasClass('intl-label')){
		var status_value = $(this).find('input').val();
		console.log(status_value)
		var shop = $('.shop_url').val();
		$.ajax({
			url: "update_status",
			type:"POST",
			data:{
				data_status:status_value,type:'country',shop:shop
			},
			success:function(response){
				snackbar_custom_toast(response) 
			}
		});
	}
	else{
		var status_value = $(this).find('input').val();
		var shop = $('.shop_url').val();
		var country_price_setting_id = $(this).attr('data-country-id');
		$.ajax({
			url: "update_status",
			type:"POST",
			data:{
				data_status:status_value,type:'international',shop:shop,country_id:country_price_setting_id
			},
			success:function(response){
				snackbar_custom_toast(response) 
			}
		});
	}
})
$('.country-round-status-module  .Polaris-RadioButton').not('.custom-switch').click(function(){
    var status_value = $(this).find('input').val();
    console.log(status_value)
    var shop = $('.shop_url').val();
    $.ajax({
      url: "update_status",
      type:"POST",
      data:{
        data_status:status_value,type:'round',shop:shop
      },
      success:function(response){
        snackbar_custom_toast(response) 
      }
    });
})
$('#geolocation').click(function(){
	var shop = $('.shop_url').val();
  if ($(this).is(':checked')) {
      $.ajax({
          url: "update_status",
          type:"POST",
          data:{
            data_status:'1',type:'geolocation',shop:shop
          },
          success:function(response){
            snackbar_custom_toast(response) 
          }
        }); 
    } else{
        $.ajax({
          url: "update_status",
          type:"POST",
          data:{
            data_status:'0',type:'geolocation',shop:shop
          },
          success:function(response){
            snackbar_custom_toast(response) 
          }
        });
    }
  
});
$(".chosen-select-country").chosen({width: "100%"});
// Enable country module //
function country_price_status_init(){
	var shop = $('.shop_url').val();
$('.country_price_status').each(function(){
  $(this).click(function(){
    var status = $(this).val();
    var country_price_setting_id = $(this).attr("data-setting-id");
    $.ajax({
      url: "update_status",
      type:"POST",
      data:{
        data_status:status,country_price_setting_id:country_price_setting_id,type:'currency_status',shop:shop
      },
      success:function(response){
        snackbar_custom_toast(response) 
      }
    });
  });
});
}
function delete_country_init(){
	var shop = $('.shop_url').val();
$('.delete_country_price').each(function(){
  $(this).click(function(){
    var country_id = $(this).attr("data-country-id");
    var checkstr =  confirm('Are you sure you want to delete this?');
    if(checkstr == true){
      $.ajax({
        url: "delete_country_price",
        type:"POST",
        data:{
          country_id:country_id,
		  shop:shop
        },
        success:function(response){
          snackbar_custom_toast(response);
          show_country_setting_data();
         
        }
      });
    }else{
    return false;
    }
    
  });
});
}
function show_country_setting_data(){
var shop = $('.shop_url').val();
     $.ajax({  
          type: "GET",
          url: "show_country_setting_data?shop="+shop,             
          dataType: "html",              
          success: function(response){                    
             $("#country-list-backend").html(response); 
           popup_int();
           delete_country_init();
           country_price_status_init();
          }

      });
}
function popup_int(){   
    $('.trigger-modal').click(function(e){
	e.preventDefault();
	$('.modal').hide();
	$('#country_id').val($(this).attr('data-country-id'));
	$('#'+$(this).attr('data-target')).show(); 
	if($(this).attr('data-target') == 'setting_currency_modal'){
		$('#'+$(this).attr('data-target')).find('#custom_name').val($(this).attr('data-name'))
		$('#'+$(this).attr('data-target')).find('#custom_url').val($(this).attr('data-url'))
		$('#'+$(this).attr('data-target')).find('#custom_rounding_price').val($(this).attr('data-round-price'));
		if($(this).attr('data-different-country') != undefined && $(this).attr('data-different-country') != ''){
			$('#'+$(this).attr('data-target')).find('#custom_country').val($(this).attr('data-different-country')).change();
		}
		else{
			$('#'+$(this).attr('data-target')).find('#custom_country').val($(this).attr('data-country-id')).change();
		}
		$('#custom_country').trigger('chosen:updated');
		if($(this).attr('data-flag') != undefined && $(this).attr('data-flag') != ''){
		$('#'+$(this).attr('data-target')).find('.custom-flag-image').html('<img width="100" src="'+$(this).attr('data-flag')+'"/>')
		}
	}
    })
  }

$('#product_search').keyup(function(){
    typed_text = $(this).val();
    typed_text = typed_text.toLowerCase();
    $(".inner_product_wrapper").each(function(){
      var product_title = $(this).attr('data-title');
      product_title = product_title.toLowerCase();
      if(product_title.indexOf(typed_text) !== -1)
      {
        $(this).parent().show();
      }
      else
      {
        $(this).parent().hide();
      }
    });
  });

delete_country_init();
country_price_status_init();
popup_int();
$(".add_variant").click(function(){
   var product_id = $(this).attr("data-id");
   var shop = $(".shop_url").val();
   var access_token = $(".access_token").attr("data-token");
   var form_data = $('#form-'+product_id).serializeArray();
   console.log(form_data);
   var price_fields_empty = true;
   $('#form-'+product_id+' .normal-price').each(function(i){
	   price_fields_empty = true;
	   if($(this).val() != ''){
		   price_fields_empty = false;
	   }
   })
   if(price_fields_empty){
	   snackbar_custom_toast("Price fields can't be empty");
	   return false;
   }
	$.ajax({
		url: "add_product_variant",
		type:"POST",
		data:{
		  product_id:product_id,shop:shop,access_token:access_token,formdata:form_data
		},
		success:function(response){
		  snackbar_custom_toast('Saved Successfully');
		}
	});
 });
 $('.delete-product').click(function(){
	 var product_id = $(this).attr("data-id");
	 var shop = $(".shop_url").val();
	 var access_token = $(".access_token").attr("data-token");
	 $.ajax({
		url: "delete_product_variant",
		type:"POST",
		data:{
		  product_id:product_id,shop:shop,access_token:access_token
		},
		success:function(response){
		  snackbar_custom_toast('Saved Successfully'); 
		  $('#form-'+product_id).find('.normal-price').val('');
		  $('#form-'+product_id).find('.compare-price').val('');
		}
	});
 })
 $('.add-all-variant').click(function(){
  $(this).addClass('btn-loading');
  $(this).find('.Polaris-Button__Text').text('Please wait');
  setTimeout(function(){


  var numberOfPendingRequests = 0;
  $(".add_variant").each(function(){
    numberOfPendingRequests++;
  })
  $(".add_variant").each(function(i){
      var product_id = $(this).attr("data-id");
     var shop = $(".shop_url").val();
     var access_token = $(".access_token").attr("data-token");
     var form_data = $('#form-'+product_id).serializeArray();
     console.log(form_data);
     var price_fields_empty = true;
     $('#form-'+product_id+' .normal-price').each(function(i){
       price_fields_empty = true;
       if($(this).val() != ''){
         price_fields_empty = false;
       }
     })
     if(price_fields_empty){
       snackbar_custom_toast("Price fields can't be empty");
       $('.add-all-variant').removeClass('btn-loading');
       $('.add-all-variant').find('.Polaris-Button__Text').text('Save All');
       return false;
     }
    $.ajax({
      url: "add_product_variant",
      type:"POST",
      async: false,
      data:{
        product_id:product_id,shop:shop,access_token:access_token,formdata:form_data
      },
      success:function(response){
         numberOfPendingRequests --;
            if(numberOfPendingRequests == 0)
            {
              $('.add-all-variant').removeClass('btn-loading')
              $('.add-all-variant').find('.Polaris-Button__Text').text('Save All');
            snackbar_custom_toast('Saved Successfully');
        }
      }
    });
  })
   },1000)
 })
 $('.reset-all-variant').click(function(){
  $(this).addClass('btn-loading');
  $(this).find('.Polaris-Button__Text').text('Please wait');
  setTimeout(function(){
  var numberOfPendingRequests = 0;
  $('.delete-product').each(function(){
    numberOfPendingRequests++;
  })
  $('.delete-product').each(function(){
    var product_id = $(this).attr("data-id");
    var shop = $(".shop_url").val();
    var access_token = $(".access_token").attr("data-token");
    $.ajax({
    url: "delete_product_variant",
    type:"POST",
    async: false,
    data:{
    product_id:product_id,shop:shop,access_token:access_token
    },
    success:function(response){
       numberOfPendingRequests --;
       $('#form-'+product_id).find('.normal-price').val('');
        $('#form-'+product_id).find('.compare-price').val('');
            if(numberOfPendingRequests == 0)
            {
              $('.reset-all-variant').addClass('btn-loading');
  $('.reset-all-variant').find('.Polaris-Button__Text').text('Reset All');
        snackbar_custom_toast('Saved Successfully'); 
        
      }
    }
    });
    })
},1000);
 })
  $('.save-button').click(function(e){
	e.preventDefault();
	 var form_id = $(this).attr("data-target");
	 var shop = $(".shop_url").val();
	 var access_token = $(".access_token").attr("data-token");
	 var form_data = $('#'+form_id).serialize();
	 $.ajax({
		url: "save_form_values",
		type:"POST",
		data:form_data+'&shop='+shop+'&access_token='+access_token,
		success:function(response){
		  snackbar_custom_toast(response) 
		},
		error:function(err){
			console.log(err);
		}
	});
 })
  $('[name="letterspacing"]').keydown(function(e) {
  if (e.keyCode === 190 || e.keyCode === 110) {
    e.preventDefault();
  }
});
});