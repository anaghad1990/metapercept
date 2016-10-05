<div class='edgtf-shop-product <?php echo esc_attr($image_size_class); echo esc_html($cats);  echo esc_attr($out_stock_class);  echo esc_attr($on_sale_class);?>'>
	<a href="<?php the_permalink(); ?>" class="edgtf-masonry-product-item-link"></a>
    <div class="edgtf-masonry-product-image-holder">
    <?php
    	echo woocommerce_get_product_thumbnail($thumb_size);
    ?>
    </div>
    <div class="edgtf-masonry-product-meta-wrapper">
        <div class="edgtf-masonry-product-overlay-outer">
	        <div class="edgtf-masonry-product-overlay-inner">
	            <div class="edgtf-masonry-product-info">
	                <a href="<?php the_permalink(); ?>">
	                    <?php

	                    the_title('<'.$title_tag.' class="edgtf-product-list-product-title">', '</'.$title_tag.'>');

	                    ?>
	                </a>
	                <?php if ($cats_slug !== '') { ?>
	                <h5 class="edgtf-masonry-product-cats">
						<?php echo wp_kses_post($cats_slug);?>
					</h5>
					<?php } ?>
	                <?php
	                /**
	                 * woocommerce_after_shop_loop_item_title hook
	                 *
	                 * @hooked woocommerce_template_loop_price - 10
	                 */

	                do_action( 'woocommerce_after_shop_loop_item_title' );
	            ?>
	            </div>
	            <div class="edgtf-masonry-product-button">
	                <?php
	                /**
	                 * woocommerce_after_shop_loop_item hook
	                 *
	                 * @hooked woocommerce_template_loop_add_to_cart - 10
	                 */
	                do_action( 'woocommerce_after_shop_loop_item' );

	                ?>
	            </div>
	        </div>
        </div>
    </div>
</div>
