





/*-------------- Start Internal Redireaction Script-----------------------------------------*/
$(document).ready(function(){
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
var shop_url = $(".shop_url").val();
/*start  insert country,page_internal*/
 $(".insert_country_page_internal").click(function(e){
        e.preventDefault();
        var select_page = $('#select_page').val();
        var select_country = $('#select_country_redirect').val();
        // var new_pagehandle = select_page.toLowerCase()+'-'+$('#select_country_redirect option:selected').text().toLowerCase().replace(' ','-');
		var new_pagehandle = $('#select_page_new').val();
        var shop_url = $(".shop_url").val();
        console.log(select_country);
      $.ajax({
          url: "insert_country_page_internal",
          type:"POST",
          data:{         
            select_page:select_page,
            select_country:select_country,
            new_pagehandle:new_pagehandle,
            shop_url:shop_url            
          },
          success:function(response){
            show_data_internal(shop_url);
			$('#internal_page_handle').val(new_pagehandle);
          	snackbar_custom_toast(response);
          },
         });
        });
 /*end  insert country,page_internal*/

 



show_data_internal(shop_url);
});


 /*start  show all data page_internal*/
function show_data_internal(shop_url){

     $.ajax({  
          type: "GET",
          data:{shop_url:shop_url},
          url: "show_data_internal",             
          dataType: "html",              
          success: function(response){                    
             $("#responsecontainer_internal").html(response); 
           /* Edit internal redirection */
			 $(".edit-internal-btn").click(function(e){
				e.preventDefault();
				var selected_country = $(this).attr('data-country');
				var selected_page = $(this).attr('data-handle');
				console.log(selected_page);
				var old_page = $(this).attr('data-old-page');
				$('#select_page').val(old_page).change();
				$('#select_country_redirect option').each(function(){
					if($(this).text() == selected_country){
						$('#select_country_redirect').val($(this).attr('value')).change();
					}
				})
				$('#select_page_new').val(selected_page).change();
				$('html, body').animate({
					'scrollTop' : $(".tab").position().top
				});
			 });
			/* Edit internal redirection */
          }

      });
}

/*end   show all data page_internal*/


  /*start  delete  page_internal*/
function delete_data_internal(internal_id,shop_url,page_id){
 
$.ajax({
          url: "delete_data_internal",
          type:"POST",
          data:{
           internal_id:internal_id,shop_url:shop_url,page_id:page_id
          },
          success:function(response){
            show_data_internal(shop_url);
            snackbar_custom_toast(response);
          },
         });
}

     /*end   delete page_internal*/

      /*start  delete  page_internal*/
function enable_disable_country_redirect(res){
 var shop_url = $(".shop_url").val();
$.ajax({
          url: "enable_disable_country_redirect",
          type:"POST",
          data:{
           value:res,shop_url:shop_url
          },
          success:function(response){
            show_data_internal(shop_url);
            snackbar_custom_toast(response);
          },
         });
}

     /*end   delete page_internal*/

/*-------------- End Internal Redireaction Script-----------------------------------------*/

/*----------------------------------------------------------------------------------------*/


/*-------------- Start External Redireaction Script----------------------------------------*/


$(document).ready(function(){
  var shop_url = $(".shop_url").val();
  console.log(shop_url);
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
/*start  insert country,page_external*/
 $(".insert_country_page_external").click(function(e){
        e.preventDefault();

        select_page_external = $('#select_page_external').val();
        select_country_external = $('#select_country_external').val();
        external_page_handle = $('#external_page_handle').val();
        shop_url = $(".shop_url").val();
        var re = /^(https?:\/\/(?:www\.|(?!www))[^\s\.]+\.[^\s]{2,}|www\.[^\s]+\.[^\s]{2,})/;
        if(select_page_external == ""){
          $(".page_error").html("This field is required");
          return false;
        }else{
          $(".page_error").html("");
        }
        if(select_country_external == ""){
          $(".country_error").html("This field is required");
          return false;
        }else{
          $(".country_error").html("");
        }
        if(external_page_handle == ""){
          $(".url_error").html("This field is required");
          return false;
        }
        else if(!re.test(external_page_handle)) { 
            $(".url_error").html("Please Enter Valid Url");
            return false;
        }
        else{
           $(".url_error").html("");
        }
        
      $.ajax({
          url: "insert_country_page_external",
          type:"POST",
          data:{           
            select_page_external:select_page_external,
            select_country_external:select_country_external,
            external_page_handle:external_page_handle,
            shop_url:shop_url            
          },
          success:function(response){
            
            snackbar_custom_toast(response);
            show_data_external(shop_url);
            $('#select_page_external').val("");
            $('#select_country_external').val("");
            $('#external_page_handle').val("");
          },
         });
        });
 /*end  insert country,page_external*/
	
	
	show_data_external(shop_url);
	

});


 /*start  show all data page_internal*/
function show_data_external(shop_url){

     $.ajax({  
          type: "GET",
          data: {shop_url:shop_url},
          url: "show_data_external",             
          dataType: "html",              
          success: function(response){                    
             $("#responsecontainer_external").html(response); 
          
		             /* Edit external redirection */
			 $(".edit-external").click(function(e){
				e.preventDefault();
				var selected_country = $(this).attr('data-country');
				var url = $(this).attr('data-url');
				var old_page = $(this).attr('data-old-page');
				$('#select_page_external').val(old_page).change();
				$('#select_country_external option').each(function(){
					if($(this).text() == selected_country){
						$('#select_country_external').val($(this).attr('value')).change();
					}
				})
				$('#external_page_handle').val(url);
				$('html, body').animate({
					'scrollTop' : $(".tab").position().top
				});
			 });
			/* Edit internal redirection */
          }

      });
}

/*end   show all data page_internal*/


  /*start  delete  page_internal*/
function delete_data_external(external_id,shop_url){
 
$.ajax({
          url: "delete_data_external",
          type:"POST",
          data:{
           external_id:external_id,shop_url:shop_url
          },
          success:function(response){
            show_data_external(shop_url);
            snackbar_custom_toast(response);
          },
         });
}

     /*end   delete page_internal*/

      /*start  delete  page_internal*/
function enable_disable_external(res){
 
$.ajax({
          url: "enable_disable_external",
          type:"POST",
          data:{
           value:res
          },
          success:function(response){
            show_data_internal();
            snackbar_custom_toast(response);
          },
         });
}

     /*end   delete page_internal*/

/*-------------- End External Redireaction Script------------------------------------------*/