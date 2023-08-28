
/*-------------- Start Internal Redireaction Script-----------------------------------------*/

$(document).ready(function(){
/*$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});*/
/*start  insert Announcement_Bar_Setting */
$("#select_country").chosen({width: "100%"});
var shop = $('.shop_url').val();
$('.Polaris-create-bar-cover .Polaris-Back-Icon').click();
 $(".announcement_bar_setting_insert_button").click(function(e){
        e.preventDefault();
        name = $('#name').val();
        select_country = $('#select_country').val();
        message = $('#message').val();
        set_goal = $('#set_goal').val();
        letter_spacing = $('#letter_spacing').val();
        text_color = $('#text_color').val();
		text_style = $('#text_style').val();
        background_color = $('#background_color').val();
        goal_color = $('#goal_color').val();
        font_family = $('#font_family').val();
        enable_theme_font = $('#enable_theme_font').val();
        close_button = $('#close_button').val();
        font_size = $('#font_size').val();
        //bar_position = $('#bar_position').val();
        display_bar_based_on_device = $('#display_bar_based_on_device').val();
        display_bar_to_specific_country = $('#display_bar_to_specific_country').val();
        display_bar_based_on_page = $('input[name="display_bar_based_on_page"]:checked').val();
        shop = $('.shop_url').val();
        status = $('.bar-status:checked').val();
        //console.log(select_country);
    
      $.ajax({
          url: "announcement_bar_setting_insert",
          type:"POST",
          data:{
           name:name,select_country:select_country,message:message,set_goal:set_goal,text_color:text_color,text_style:text_style,background_color:background_color,goal_color:goal_color,font_family:font_family,letter_spacing:letter_spacing,enable_theme_font:enable_theme_font,close_button:close_button,font_size:font_size,display_bar_based_on_device:display_bar_based_on_device,display_bar_to_specific_country:display_bar_to_specific_country,display_bar_based_on_page:display_bar_based_on_page,shop:shop,status:status
          },
		  contentType: "application/x-www-form-urlencoded",
          success:function(response){
            snackbar_custom_toast(response);
            show_data_announcement_bar_setting(shop);
            window.location.reload();
          },
         });
        });


 /*end   insert Announcement_Bar_Setting */


  /*Start   Search  Announcement_Bar_Setting */
$("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
       $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  /*end   Search  Announcement_Bar_Setting */

show_data_announcement_bar_setting(shop);
  $('.announcement-form').on('keyup change paste', 'input, select, textarea', function(){
    createStikcyBar();
  });
  
});

 /*start  show all data Announcement_Bar_Setting*/
function show_data_announcement_bar_setting(shop){
     $.ajax({  
          type: "GET",
          url: "show_data_announcement_bar_setting", 
          data: {shop,shop},            
          dataType: "html",              
          success: function(response){                    
             $("#responsecontainer_announcement_bar").html(response); 
           
          }

      });
}

/*end   show all data Announcement_Bar_Setting*/


  /*start  delete  announcement_bar_setting*/
function delete_data_announcement_bar(announcement_bar_id,shop_url){
 
$.ajax({
          url: "delete_data_announcement_bar",
          type:"POST",
          data:{
           announcement_bar_id:announcement_bar_id,shop_url:shop_url
          },
          success:function(response){
            show_data_announcement_bar_setting(shop_url);
            snackbar_custom_toast(response);
          },
         });
}

     /*end   delete announcement_bar_setting*/
   

   /*start Module enable_disable announcement_bar_setting */
function module_enable_disable_announcement_bar_setting(res){
  var shop_url = $(".shop_url").val();
 // console.log(shop_url);
 
$.ajax({
          url: "module_enable_disable_announcement_bar_setting",
          type:"POST",
          data:{
           value:res,shop_url:shop_url
          },
          success:function(response){
            show_data_announcement_bar_setting(shop_url);
            snackbar_custom_toast(response);
          },
         });
}

     /*end   enable_disable announcement_bar_setting*/
function edit_announcement_bar(announcement_bar_id, shop_url){
$.ajax({
      url: "edit_announcement_bar",
      type:"POST",
      data:{
       announcement_bar_id:announcement_bar_id,shop_url:shop_url
      },
      success:function(response){
        $("#edit_announcement_bar_page").html(response);
        $(".announcement_bar_wrp").hide();
        $("#edit_announcement_bar_page").show();
        //show_data_announcement_bar_setting();
        //snackbar_toast(response);
      },
     });
}
function back_to_bar(){
  $(".announcement_bar_wrp").show();
  $("#edit_announcement_bar_page").hide();
  $('.dynamic-announcement-content').html('');
}
function announcement_bar_setting_update(){
  var shop = $('.shop_url').val();
   $.ajax({
      type:"POST",
      url:"announcement_bar_update",
      data:$(".announcement_update_form").serialize(),//only input
      success: function(response){
          snackbar_custom_toast(response); 
          show_data_announcement_bar_setting(shop);
      }
  });
}
function createStikcyBar(){
  var $form = $(".announcement-form");
  $('.dynamic-announcement-content').html('');
  var data = getFormData($form);
  console.log(data);
  if(data.message != undefined && data.message != ''){
    var message = data.message.replace('{{goal}}','<span class="annoucement_set_goal">'+data.goal+'</span>');
    console.log(message);
    if(data.letter_spacing != undefined && data.letter_spacing != ''){
      var letter_spacing = data.letter_spacing;
    }
    else if(data.letter_spacing_edit != undefined && data.letter_spacing_edit != ''){
      var letter_spacing = data.letter_spacing_edit;
    }
    else{
      var letter_spacing = ''
    }
    var html_structure = '<style>'+
      '.announcement_bar_wrapper{'+
       ' background:'+data.background_color+';'+
      '}'+
      '.annoucement_set_goal{'+
        'color: '+data.goal_color+';'+
        'font-size: '+data.font_size+'px;'+
        'font-family: '+data.font_family.replace(/\+/gi, " ")+';'+
      '}'+
    '</style>'+
  '<div class="announcement_bar_wrapper '+data.bar_position+' '+ data.display_bar_based_on_device +'">'+
    '<div class="annoucement_message" style="letter-spacing:'+letter_spacing+'px;color: '+data.text_color+';text-transform:'+data.text_style+';font-size: '+data.font_size+'px;font-family: '+data.font_family.replace(/\+/gi, " ")+'">'+
    message
      +'</div>'+

  '</div>';
  $('.dynamic-announcement-content').html(html_structure);
  }
}
function createEditStikcyBar(){
  $('.dynamic-announcement-content').html('');
  var $form = $(".announcement_update_form");
  var data = getFormData($form);
  if(data.message != undefined && data.message != ''){
    var message = data.message.replace('{{goal}}','<span class="annoucement_set_goal">'+data.set_goal+'</span>');
    console.log(message);
    if(data.letter_spacing != undefined && data.letter_spacing != ''){
      var letter_spacing = data.letter_spacing;
    }
    else if(data.letter_spacing_edit != undefined && data.letter_spacing_edit != ''){
      var letter_spacing = data.letter_spacing_edit;
    }
    else{
      var letter_spacing = ''
    }
    var html_structure = '<style>'+
      '.announcement_bar_wrapper{'+
       ' background:'+data.background_color+';'+
      '}'+
      '.annoucement_set_goal{'+
        'color: '+data.goal_color+';'+
        'font-size: '+data.font_size+'px;'+
        'font-family: '+data.font_family.replace(/\+/gi, " ")+';'+
      '}'+
    '</style>'+
  '<div class="announcement_bar_wrapper '+data.bar_position+' '+ data.display_bar_based_on_device +'">'+
    '<div class="annoucement_message" style="letter-spacing:'+letter_spacing+'px;color: '+data.text_color+';text-transform:'+data.text_style+';font-size: '+data.font_size+'px;font-family: '+data.font_family.replace(/\+/gi, " ")+'">'+
    message
      +'</div>'+

  '</div>';
  $('.dynamic-announcement-content').html(html_structure);
  }
}
function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

     //>=, not <=
    if (scroll >= 250) {
        //clearHeader, not clearheader - caps H
        $(".whole-cover").addClass("stickyheader");
    }
    else{
      $(".whole-cover").removeClass("stickyheader");
    }
}); //missing );
$(document).ajaxComplete(function(){ 
$('.announcement_update_form').on('keyup change paste', 'input, select, textarea', function(){
    createEditStikcyBar();

  });
  $('.announcement_update_form input').keyup();
  })