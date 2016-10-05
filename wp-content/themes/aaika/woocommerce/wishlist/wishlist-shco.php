<?php
/**
 * Wishlist Shortcodes
 */

if ( !defined( 'DEVN_WISHLIST' ) ) { exit; } // Exit if accessed directly

if( !class_exists( 'DEVN_WISHLIST_SHORTCODE' ) ) {
    /**
     * 
     */
    class DEVN_WISHLIST_SHORTCODE {
        /**
         * Print the wishlist HTML.
         */
        static function wishlist( $atts, $content = null ) {
            $atts = shortcode_atts( array(
                'per_page' => 10,
                'pagination' => 'no' 
            ), $atts );
            
            ob_start();
            devn_wishlist_get_template( 'wishlist.php', $atts );
            
            return apply_filters( 'devn_wishlist_html', ob_get_clean() );
        }
        
        /**
         * Return "Add to Wishlist" button.
         */
        static function add_to_wishlist( $atts, $content = null ) {
            global $product, $devn_wishlist;
            
            $html = DEVN_WISHLIST_UI::add_to_wishlist_button( $devn_wishlist->get_wishlist_url(), $product->product_type, $devn_wishlist->is_product_in_wishlist( $product->id ) ); 
            
            $html .= DEVN_WISHLIST_UI::popup_message();
            
            return $html;
        }
    }
}
global $devn;
$devn->ext['asc']( 'devn_wishlist', array( 'DEVN_WISHLIST_SHORTCODE', 'wishlist' ) );
$devn->ext['asc']( 'devn_add_to_wishlist', array( 'DEVN_WISHLIST_SHORTCODE', 'add_to_wishlist' ) );