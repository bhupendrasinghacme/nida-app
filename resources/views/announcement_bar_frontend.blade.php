<?php if(isset($announcement_bar_list) && !empty($announcement_bar_list)) { 
  if(isset($announcement_bar_list->themefont)){
  $font_family = isset($announcement_bar_list->font_family)?preg_replace('/\+/',' ',$announcement_bar_list->font_family):"";
}
else{
  $font_family = '';
}
$bar_position = isset($announcement_bar_list->bar_position)?$announcement_bar_list->bar_position:"";
$font_size = isset($announcement_bar_list->font_size)?$announcement_bar_list->font_size:"";
$letter_spacing = isset($announcement_bar_list->letter_spacing)?$announcement_bar_list->letter_spacing:"";
$display_bar_based_on_device = isset($announcement_bar_list->display_bar_based_on_device)?$announcement_bar_list->display_bar_based_on_device:"";
  ?>
  <style>
    .announcement_bar_wrapper{
      background: <?php echo $announcement_bar_list->background_color; ?>;
    }
  	.annoucement_set_goal{
  		color: <?php echo $announcement_bar_list->goal_color; ?>;
  		font-size: <?php echo $font_size; ?>px;
  		font-family: <?php echo $font_family ?>
  	}
<?php
	if($announcement_bar_list->display_bar_based_on_page == 'home_page'){
		echo "body:not(.template-index) .announcement_bar_wrapper{
			display:none;
		}";
	}
?>
  </style>
<div class="announcement_bar_wrapper <?php echo $bar_position; ?> <?php echo $display_bar_based_on_device; ?>">
  <div class="annoucement_message" style="color: <?php echo $announcement_bar_list->text_color; ?>;text-transform: <?php echo $announcement_bar_list->textstyle; ?>;font-size: <?php echo $font_size; ?>px;letter-spacing: <?php echo $letter_spacing;?>; font-family: <?php echo $font_family ?>"><?php $string= str_replace("{{goal}}","<span class='annoucement_set_goal'>".$announcement_bar_list->set_goal."</span>",$announcement_bar_list->message); echo $string; ?> </div>

</div>
<?php } ?>