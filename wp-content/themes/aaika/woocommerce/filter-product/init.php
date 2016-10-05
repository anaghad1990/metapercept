<?php
/**
* Init
*/
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

    define( 'DEVN_FILTER_URL', get_template_directory_uri() . '/woocommerce/filter-product/' );
    define( 'DEVN_FILTER_DIR', get_template_directory_uri() . '/woocommerce/filter-product/' );
	global $devn, $devn_filter;
    // Load required classes and functions
    $devn->ext['rqo']( dirname(__FILE__).DS.'functions.devn-filter.php' );
    $devn->ext['rqo']( dirname(__FILE__).DS.'devn-filter-admin.php' );
    $devn->ext['rqo']( dirname(__FILE__).DS.'devn-filter-frontend.php' );
    $devn->ext['rqo']( dirname(__FILE__).DS.'devn-filter-helper.php' );
    $devn->ext['rqo']( dirname(__FILE__).DS.'widgets/devn-filter-widget.php' );
    $devn->ext['rqo']( dirname(__FILE__).DS.'widgets/devn-filter-reset-widget.php' );
    $devn->ext['rqo']( dirname(__FILE__).DS.'devn-filter.php' );

    $devn_filter = new DEVN_FILTER();