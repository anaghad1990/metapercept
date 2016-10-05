<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );
$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

?>
<div class="product_meta">

    <?php do_action( 'woocommerce_product_meta_start' ); ?>

    <?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>

        <span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'fair' ); ?> <span class="sku" itemprop="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html_e( 'N/A', 'fair' ); ?></span></span>

    <?php endif; ?>

    <?php print $product->get_categories( '<span class="edgtf-product-meta-separator">, </span>', '<span class="posted_in">' . _n( 'Category:', 'Categories:', $cat_count, 'fair' ) . ' ', '</span>' ); ?>

    <?php print $product->get_tags( '<span class="edgtf-product-meta-separator">, </span>', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', $tag_count, 'fair' ) . ' ', '</span>' ); ?>

    <?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
