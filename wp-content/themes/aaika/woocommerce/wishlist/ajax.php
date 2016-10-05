<?php
/**
 * Ajax wishlist
 */


header( "Cache-Control: no-cache, must-revalidate" ); // HTTP/1.1
header( "Expires: Sat, 26 Jul 1997 05:00:00 GMT" ); // Date in the past

global $devn;
$devn->ext['icl'](  dirname( __FILE__ ).DS.'functions-wishlist.php' );

if( !isset( $devn_wishlist ) ) {
	$devn_wishlist = new DEVN_WISHLIST( $_REQUEST );
}

// Remove product from the wishlist
if( $_GET['action'] == 'remove_from_wishlist' ) {
    $count = devn_wishlist_count_products();
        
    if( $devn_wishlist->remove( $_GET['wishlist_item_id'] ) )
        { _e( 'Product successfully removed.', 'aaikadomain' ); }
    else {
        echo '#' . $count . '#';
        _e( 'Error. Unable to remove the product from the wishlist.', 'aaikadomain' );
    }
    
    if( !$count )
        { _e( 'No products were added to the wishlist', 'aaikadomain' ); }
    
    wp_redirect( $devn_wishlist->get_wishlist_url() );
    die();
}
// Add product in the wishlist
elseif( $_GET['action'] == 'add_to_wishlist' ) {
    $return = $devn_wishlist->add();
    
    if( $return == 'true'  )
        { print( $return ) . '##' . __( 'Product added!', 'aaikadomain' ); }
    elseif( $return == 'exists' )
        { print( $return ) . '##' . __( 'Product already in the wishlist.', 'aaikadomain' ); }
    elseif( count( $devn_wishlist->errors ) > 0 )
        { print( $devn_wishlist->get_errors() ); }
    
    wp_redirect( get_permalink( intval( $_GET['add_to_wishlist'] ) ) ); 
    die();
}
// Check if a product exists in the wishlist in case of variations
elseif( $_GET['action'] == 'prod_find' ) {
    if( $devn_wishlist->is_product_in_wishlist( $_POST['prod_id'] ) ) {
		echo "exists";
	}
}