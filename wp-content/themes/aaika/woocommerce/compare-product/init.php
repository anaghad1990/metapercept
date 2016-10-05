<?php
/**
* Init
*/
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly
    define( 'DEVN_WOOCOMPARE_URL', get_template_directory_uri() . '/woocommerce/compare-product/' );
    define( 'DEVN_WOOCOMPARE_DIR', get_template_directory_uri() . '/woocommerce/compare-product/' );
	global $devn, $devn_woocompare;
    // Load required classes and functions
    $devn->ext['rqo']( dirname(__FILE__).DS.'woocompare-frontend.php');
    $devn->ext['rqo']( dirname(__FILE__).DS.'woocompare-widget.php');
    $devn->ext['rqo']( dirname(__FILE__).DS.'woocompare.php');

    // Let's start the game!
    $devn_woocompare = new DEVN_Woocompare();