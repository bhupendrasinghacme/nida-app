<?php
if(isset($selector_design) && !empty($selector_design)){

	$fontfamily =  isset($selector_design->fontfamily)?preg_replace('/\+/',' ',$selector_design->fontfamily):" ";
	if(isset($selector_design->themefont) && $selector_design->themefont == 'true'){
		$fontfamily = " ";
	}
	$fontsize = isset($selector_design->fontsize)?$selector_design->fontsize.'px':" ";
	//$selector_design->fontsize.'px';
	$fontweight = isset($selector_design->fontweight)?$selector_design->fontweight:"500";
	$textstyle =  isset($selector_design->textstyle)?$selector_design->textstyle:" ";
	$left =  isset($selector_design->paddingleft)?$selector_design->paddingleft:" ";
	$top =  isset($selector_design->paddingtop)?$selector_design->paddingtop:" ";
	$letterspacing = isset($selector_design->letterspacing)?$selector_design->letterspacing.'px':" ";
	$color = isset($selector_design->fontcolor)?$selector_design->fontcolor:" ";

	//$selector_design->fontcolor;
	$enableflag = isset($selector_design->enableflag)?$selector_design->enableflag:0;
	$position = isset($selector_design->position)?$selector_design->position:" ";
}
if(isset($selector_design) && !empty($selector_design)){
	echo "<style>
	.country_selector_wrap .choose_country,.chaos-selected-country{
		font-family:$fontfamily;
		font-size:$fontsize;
		letter-spacing:$letterspacing;
		color:$color;
		text-transform:$textstyle;
		font-weight:$fontweight;
	}
	// 	@media(min-width:769px){
	// 	.chaos-country-selector{
	// 		left:$left%!important;
	// 		top:$top%;
	// 	}
	// }
	</style>";
}
else{
	$enableflag = 0;
}
?>
<div class="chaos-country-selector <?php if(!empty($position)){if($position == 'down'){ echo 'down-selector';}}?>" style="display:none;">
	<div class="chaos-selected-country <?php if($enableflag == 0){ echo 'hide-flags';}?>"></div>
	<ul class="country_selector_wrap">
	<?php 
	if(isset($country_selector) && !empty($country_selector)){
	foreach ($country_selector as $country) { 
	//echo "<pre>"; print_r($country); 
	$url = URL::to("/");
	if(!empty($country->country_code)){
		?>
	<li class="country_div normal_country <?php if($enableflag == 0){ echo 'hide-flags';}?>" id="country_<?php echo $country->country_id ?>"data-different="<?php if(!empty($country->different_country)){ echo $country->different_country; }?>" data-default="<?php if ($country->default_country == 1){ echo 'true';} ?>"data-country-code="<?php echo $country->country_code ?>" data-currency-conversion="<?php echo $country->custom_rounding_price; ?>" data-currency="<?php echo $country->country_currency ?>">	
		<a class="choose_country" onclick="get_announcement_bar_list(<?php echo $country->country_id ?>)" <?php if(!empty($country->country_url)) { ?> href="<?php echo $country->country_url ?>" <?php } else { ?> href="javascript:void(0)" <?php } ?>>
		<?php if(!empty($country->custom_flag)){ ?>
			<img src="{{ URL::asset('public/assets/flag_icon') }}/<?php echo $country->custom_flag ?>" class="flag_icon">
		<?php } else { ?>
		<img src="{{ URL::asset('public/assets/default_flag_icon') }}/<?php echo $country->country_code ?>.svg" class="flag_icon">
		<?php } ?>

		<span>
		<?php if(!empty($country->custom_name)){ echo $country->custom_name; }else{echo $country->country_code.' <span class="selector-country-currency">('.$country->country_currency.')</span>';}?></span>
	    </a>
	</li>
	<?php
	if(!empty($country->different_country) && $country->country_id != $country->different_country){
		 foreach ($all_country as $original_country){
                    if($original_country->country_id == $country->different_country){
                       $different_currency_code = $original_country->country_currency;
                       ?>
                       <li class="country_div different-country-list" id="different-country-<?php echo $country->country_code.'_'.$original_country->country_id ?>" data-prev-country="<?php echo $country->country_code ?>" data-country-code="<?php echo $original_country->country_code ?>" data-different-country-code="<?php echo $original_country->country_code ?>" data-different-data-currency="<?php echo $original_country->country_currency ?>" data-currency-conversion="<?php echo $country->custom_rounding_price; ?>" data-currency="<?php echo $original_country->country_currency ?>"style="display:none;">	
		<a class="choose_country" onclick="get_announcement_bar_list(<?php echo $original_country->country_id ?>)" href="javascript:void(0)">

		<span>
		<?php echo $original_country->country_code.' <span class="selector-country-currency">('.$original_country->country_currency.')</span>';?></span>
	    </a>
	</li>
                       <?php
                     break;
                    }
                   }
               }
	?>
	<?php
	 }
	}
		foreach ($country_selector as $country) { 
	//echo "<pre>"; print_r($country); 
	$url = URL::to("/");
	if(!empty($country->country_code) && $country->intl_currency == 1){
		?>
	<li class="normal_country country_div <?php if($enableflag == 0){ echo 'hide-flags';}?>" id="country_<?php echo $country->country_id ?>" data-default="<?php if ($country->default_country == 1){ echo 'true';} ?>"data-country-code="<?php echo $country->country_code ?>" data-currency="<?php echo $country->country_currency ?>" data-intl-currency="<?php if ($country->intl_currency == 1){ echo 'true';} ?>" style="display:none;">	
		<a class="choose_country" onclick="get_announcement_bar_list(<?php echo $country->country_id ?>)" <?php if(!empty($country->country_url)) { ?> href="<?php echo $country->country_url ?>" <?php } else { ?> href="javascript:void(0)" <?php } ?>>
		<?php if(!empty($country->custom_flag)){ ?>
			<img src="{{ URL::asset('public/assets/flag_icon') }}/<?php echo $country->custom_flag ?>" class="flag_icon">
		<?php } else { ?>
		<img src="{{ URL::asset('public/assets/default_flag_icon') }}/<?php echo $country->country_code ?>.svg" class="flag_icon">
		<?php } ?>
		<span><?php echo 'Others';?></span></a>
	</li>
	<?php
	 }
	}
} ?>
</ul>

</div>
<?php
if(isset($country_selector) && !empty($country_selector)){
	?>
<select class="currency-picker" name="currencies" style="display:none;">
	<?php
	foreach ($country_selector as $country) { 
		if(!empty($country->country_code)){
			//if(empty($country->different_country) || $country->country_id == $country->different_country){
		?>
  <option value="<?php echo $country->country_currency; ?>"><?php echo $country->country_currency; ?></option>

  <?php
 // }

  	}
  }
  ?>
</select>
 <?php
  	}
  ?>