<?php
include("etkg.php");

function isValidKey(){
	$option_key = '_easy_testimonials_pro_license_status';
	$opt_val = get_option($option_key);
	if ($opt_val == 'ACTIVE') {
		return true;
	}
	
	global $gp_etkg_memo;
	if ( empty($gp_etkg_memo) )
	{
		$email = get_option('easy_t_registered_name');
		$webaddress = get_option('easy_t_registered_url');
		$key = get_option('easy_t_registered_key');
		
		$keygen = new ETKG();
		$computedKey = $keygen->computeKey($webaddress, $email);
		$computedKeyEJ = $keygen->computeKeyEJ($email);

		if ($key == $computedKey || $key == $computedKeyEJ) {
			$gp_etkg_memo = true;
		} else {
			$plugin = "easy-testimonials-pro/easy-testimonials-pro.php";
			
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
			
			if(is_plugin_active($plugin) && class_exists('easyTestimonialsPro') ){
				$gp_etkg_memo = true;
			}
			else {
				$gp_etkg_memo = false;
			}
		}
	}
	return $gp_etkg_memo;
}

function isValidMSKey(){
	$plugin = "easy-testimonials-pro/easy-testimonials-pro.php";
	
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
	if(is_plugin_active($plugin) && class_exists('easyTestimonialsPro') ){
		return true;
	}
	else {
		return false;
	}
}
?>