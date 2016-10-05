<?php
/**
*
* (C) King-Theme.com
*
*/



/********************************************************/
/*                        Actions                       */
/********************************************************/

	// Constants
	
	$theme = wp_get_theme();
	if( !empty( $theme['Template'] ) ){
		$theme = wp_get_theme($theme['Template']);
	}
	define('THEME_NAME', $theme['Name'] );
	define('THEME_SLUG', $theme['Template'] );
	define('DEVN_VERSION', $theme['Version'] );
	
	define('HOME_URL', home_url() );
	define( 'DS', DIRECTORY_SEPARATOR );
	define('DEVN_FILE', __FILE__);
	define('OPTIONS_PATH', dirname(__FILE__));
	define('CORE_PATH', dirname(__FILE__));
	define('DEVN_URL', get_template_directory_uri().'/options' );
	define('SITE_URL', site_url() );
	define('SITE_URI', site_url() );
	define('THEME_URI', get_template_directory_uri() );
	define('THEME_PATH', get_template_directory() );
	define('DEVN_OPTNAME', 'devn' );
	define('DEVN_DOMAIN', DEVN_OPTNAME);


	// Shared
	include 'devn.class.php';
	
	global $devn;
	$devn = new devn();
	$devn->init();


