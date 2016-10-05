<?php
// DEVN WISHLIST STARTUP
if ( !defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

define( 'DEVN_WISHLIST', true );
    if( !defined( 'DEVN_WISHLIST_URL' ) ) { define( 'DEVN_WISHLIST_URL', get_template_directory_uri() . '/woocommerce' ); }
    define( 'WISHLIST_URL', DEVN_WISHLIST_URL . '/wishlist/' );
    define( 'WISHLIST_DIR', dirname( __FILE__ ) . '/' );

global $woocommerce;


if( isset($woocommerce) ) {
    // Load necessary files
    include WISHLIST_DIR.'functions-wishlist.php';
    include WISHLIST_DIR.'wishlist.php';
    include WISHLIST_DIR.'wishlist-init.php';
    include WISHLIST_DIR.'wishlist-install.php';
    
    if( devn_wishlist_actived() ) {
        include WISHLIST_DIR.'wishlist-ui.php';
        include WISHLIST_DIR.'wishlist-shco.php';
    }
    
    // ============
    global $devn_wishlist;
    $devn_wishlist = new DEVN_WISHLIST( $_REQUEST );
}