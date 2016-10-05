<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $woocommerce, $product;

$images_classes = '';
$gallery = '';

$attachment_count = count( $product->get_gallery_attachment_ids() );

if ($attachment_count > 0){
	$images_classes .= 'edgtf-has-thumbs-gallery';
	$gallery = '[product-gallery]';
}

?>
<div class="edgtf-single-product-images">
	<div class="images <?php echo esc_attr($images_classes);?>">
		<div class="edgtf-single-product-slider">

		<?php
		if ( has_post_thumbnail() ) {

			$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );

			$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
			$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
			$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title'	 => $props['title'],
				'alt'    => $props['alt'],
			) );


			echo apply_filters(
				'woocommerce_single_product_image_html',
				sprintf(
					'<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto%s">%s</a>',
					esc_url( $props['url'] ),
					esc_attr( $props['caption'] ),
					$gallery,
					$image
				),
				$post->ID
			);

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'fair' ) ), $post->ID );

		}
		if ( $attachment_count > 0 ) {

			$attachment_ids = $product->get_gallery_attachment_ids();
			foreach ( $attachment_ids as $attachment_id ) {
				$image_link = wp_get_attachment_image_src($attachment_id, 'full');
				$image = wp_get_attachment_image($attachment_id, apply_filters('single_product_large_thumbnail_size', 'shop_single'));

				echo apply_filters('woocommerce_single_product_image_html', sprintf('<a href="%s" itemprop="image" class="woocommerce-main-image zoom" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link[0], $image));
			}
		}
		?>
		</div>

		<?php

        // print out of sale on image
        if($product->is_in_stock()){
            add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
            remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
            do_action( 'woocommerce_before_single_product_summary' );
        }

		?>

		<?php do_action( 'woocommerce_product_thumbnails' ); ?>

	</div>
</div>