<?php

/*
Plugin Name: Advanced Custom Fields: Year
Plugin URI: https://github.com/manxstef/acf-year-field
Description: The year field lets you add a select field to Advanced Custom Fields with pre-populated years as a list to choose from.
Note that this is an updated fork of the acf-year-field plugin by Will Ashworth https://github.com/ashworthconsulting/acf-year-field
Version: 1.0.0
Author: Stef Pause
Author URI: https://github.com/manxstef/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/




// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-year', false, dirname( plugin_basename(__FILE__) ) . '/lang/' ); 




// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_year( $version ) {
	
	include_once('acf-year-v5.php');
	
}

add_action('acf/include_field_types', 'include_field_types_year');	




// 3. Include field type for ACF4
function register_fields_year() {
	
	include_once('acf-year-v4.php');
	
}

add_action('acf/register_fields', 'register_fields_year');	



	
?>