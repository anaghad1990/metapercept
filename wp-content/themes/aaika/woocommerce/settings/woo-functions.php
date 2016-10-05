<?php 
 // DEVN Woocommerce functions
 // Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
	die;
}

global $devn;

add_action('wp_enqueue_scripts', 'woocommerce_enqueue_content');
function woocommerce_enqueue_content(){

	wp_enqueue_style('devn-woo', THEME_URI.'/woocommerce/settings/css/devn-woo.css', false, DEVN_VERSION );
	
	wp_register_script( 'devn-magnifier', THEME_URI.'/woocommerce/magnifier/js/magnifier.min.js', array('jquery'), DEVN_VERSION , true );
	wp_register_script( 'devn-carouFredSel', THEME_URI.'/woocommerce/magnifier/js/jquery.carouFredSel.min.js', array('jquery'), DEVN_VERSION , true );
	
	wp_enqueue_script( 'devn-magnifier' );
	wp_enqueue_script( 'devn-carouFredSel' );
}

// WooCommerce template
if( ! class_exists( 'DevnWooTemplate' )) {

	class DevnWooTemplate{
		
		function __construct(){
			add_filter( 'woocommerce_show_page_title', array( $this, 'shop_title'), 10 );
			// Product Loop page.
			add_action( 'woocommerce_after_shop_loop_item', array( $this, 'before_shop_item_buttons' ), 9 );
    		add_action( 'woocommerce_after_shop_loop_item', array( $this, 'after_shop_item_buttons' ), 11 );
			/* Single product page */
			//add_action( 'woocommerce_single_product_summary', array( $this, 'add_product_line' ), 19 );
		}
		// End __construct();
		
		function before_shop_item_buttons() {
			echo '<div class="product-buttons"><div class="product-buttons-box">';
		}
		function after_shop_item_buttons() {
			echo '<a href="' . get_permalink() . '" class="show_details_button">' . __( 'Show details', 'aaikadomain' ) . '</a></div></div>';
		}
		/* function add_product_line() {
			echo '<div class="clear"></div><div class="product-line"></div>';
		} */
		
		// Hidden Shop title
		function shop_title() {
			return false;
		}
	} 
	// End class DevnWooTemplate;
}

new DevnWooTemplate();

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);	

add_action('woocommerce_before_shop_loop', 'devn_woo_products_order', 30);
function devn_woo_products_order() {

	// Get WooCommerce admin setting.
	global $devn;
	
	parse_str($_SERVER['QUERY_STRING'], $params);
	
	$query_string = '?'.$_SERVER['QUERY_STRING'];
	
	if( !empty( $devn->cfg['product_number'] ) ) {
		$products_per_page = $devn->cfg['product_number'];
	} else {
		$products_per_page = 12;
	}
	
	// Set product_orderby, product_order, product_count.
	$devn_product_orderby = !empty($params['product_orderby']) ? $params['product_orderby'] : 'default';
	$devn_product_order = !empty($params['product_order'])  ? $params['product_order'] : 'asc';
	$devn_product_count = !empty($params['product_count']) ? $params['product_count'] : $products_per_page;
	
	$html = '';
	$html .= '<div class="devn-product-order">';
	$html .= '<div class="devn-orderby-container">';
	$html .= '<ul class="orderby order-dropdown">';
	$html .= '<li>';
	$html .= '<span class="current-li"><span class="current-li-content"><a>'.__('Sort by', 'aaikadomain' ).' <strong>'.__('Default Order', 'aaikadomain' ).'</strong></a></span></span>';
	$html .= '<ul>';
	$html .= '<li class="'.(($devn_product_orderby == 'default') ? 'current': '').'"><a href="'.devn_get_data_url($query_string, 'product_orderby', 'default').'">'.__('Sort by', 'aaikadomain' ).' <strong>'.__('Default Order', 'aaikadomain' ).'</strong></a></li>';
	$html .= '<li class="'.(($devn_product_orderby == 'name') ? 'current': '').'"><a href="'.devn_get_data_url($query_string, 'product_orderby', 'name').'">'.__('Sort by', 'aaikadomain' ).' <strong>'.__('Name', 'aaikadomain' ).'</strong></a></li>';
	$html .= '<li class="'.(($devn_product_orderby == 'price') ? 'current': '').'"><a href="'.devn_get_data_url($query_string, 'product_orderby', 'price').'">'.__('Sort by', 'aaikadomain' ).' <strong>'.__('Price', 'aaikadomain' ).'</strong></a></li>';
	$html .= '<li class="'.(($devn_product_orderby == 'date') ? 'current': '').'"><a href="'.devn_get_data_url($query_string, 'product_orderby', 'date').'">'.__('Sort by', 'aaikadomain' ).' <strong>'.__('Date', 'aaikadomain' ).'</strong></a></li>';
	$html .= '<li class="'.(($devn_product_orderby == 'rating') ? 'current': '').'"><a href="'.devn_get_data_url($query_string, 'product_orderby', 'rating').'">'.__('Sort by', 'aaikadomain' ).' <strong>'.__('Rating', 'aaikadomain' ).'</strong></a></li>';
	$html .= '</ul>';
	$html .= '</li>';
	$html .= '</ul>';
	$html .= '<ul class="order">';
	if($devn_product_order == 'desc'):
	$html .= '<li class="desc"><a href="'.devn_get_data_url($query_string, 'product_order', 'asc').'"><i class="fa fa-arrow-up"></i></a></li>';
	endif;
	if($devn_product_order == 'asc'):
	$html .= '<li class="asc"><a href="'.devn_get_data_url($query_string, 'product_order', 'desc').'"><i class="fa fa-arrow-down"></i></a></li>';
	endif;
	$html .= '</ul>';

	$html .= '</div>';

	$html .= '<ul class="sort-count order-dropdown">';
	$html .= '<li>';
	$html .= '<span class="current-li"><a>'.__('Show', 'aaikadomain' ).' <strong>'.$products_per_page.' '.__(' Products', 'aaikadomain' ).'</strong></a></span>';
	$html .= '<ul>';
	$html .= '<li class="'.(($devn_product_count == $products_per_page) ? 'current': '').'"><a href="'.devn_get_data_url($query_string, 'product_count', $products_per_page).'">'.__('Show', 'aaikadomain' ).' <strong>'.$products_per_page.' '.__('Products', 'aaikadomain' ).'</strong></a></li>';
	$html .= '<li class="'.(($devn_product_count == $products_per_page*2) ? 'current': '').'"><a href="'.devn_get_data_url($query_string, 'product_count', $products_per_page*2).'">'.__('Show', 'aaikadomain' ).' <strong>'.($products_per_page*2).' '.__('Products', 'aaikadomain' ).'</strong></a></li>';
	$html .= '<li class="'.(($devn_product_count == $products_per_page*3) ? 'current': '').'"><a href="'.devn_get_data_url($query_string, 'product_count', $products_per_page*3).'">'.__('Show', 'aaikadomain' ).' <strong>'.($products_per_page*3).' '.__('Products', 'aaikadomain' ).'</strong></a></li>';
	$html .= '<li class="'.(($devn_product_count == $products_per_page*4) ? 'current': '').'"><a href="'.devn_get_data_url($query_string, 'product_count', $products_per_page*4).'">'.__('Show', 'aaikadomain' ).' <strong>'.($products_per_page*4).' '.__('Products', 'aaikadomain' ).'</strong></a></li>';
	$html .= '</ul>';
	$html .= '</li>';
	$html .= '</ul>';
	$html .= '</div>
	<script>
		jQuery(".devn-product-order .orderby .current-li a").html(jQuery(".devn-product-order .orderby ul li.current a").html());
		jQuery(".devn-product-order .sort-count .current-li a").html(jQuery(".devn-product-order .sort-count ul li.current a").html());	
	</script>
	';

	print( $html );
}

add_action('woocommerce_get_catalog_ordering_args', 'devn_woo_get_order', 20);
function devn_woo_get_order($args){
	global $woocommerce;

	parse_str($_SERVER['QUERY_STRING'], $params);

	$devn_product_orderby = !empty($params['product_orderby']) ? $params['product_orderby'] : 'default';
	$devn_product_order = !empty($params['product_order'])  ? $params['product_order'] : 'asc';
	
	switch($devn_product_orderby) {
		case 'date':
			$orderby = 'date';
			$order = 'desc';
			$meta_key = '';
		break;
		case 'price':
			$orderby = 'meta_value_num';
			$order = 'asc';
			$meta_key = '_price';
		break;
		case 'popularity':
			$orderby = 'meta_value_num';
			$order = 'desc';
			$meta_key = 'total_sales';
		break;
		case 'title':
			$orderby = 'title';
			$order = 'asc';
			$meta_key = '';
		break;
		case 'default':
		default:
			$orderby = 'menu_order title';
			$order = 'asc';
			$meta_key = '';
		break;
	}

	switch($devn_product_order) {
		case 'desc':
			$order = 'desc';
		break;
		case 'asc':
			$order = 'asc';
		break;
		default:
			$order = 'asc';
		break;
	}

	$args['orderby'] = $orderby;
	$args['order'] = $order;
	$args['meta_key'] = $meta_key;

	if( $devn_product_orderby == 'rating' ) {
		$args['orderby']  = 'menu_order title';
		$args['order']    = $devn_product_order == 'desc' ? 'desc' : 'asc';
		$args['order']	  = strtoupper( $args['order'] );
		$args['meta_key'] = '';

		add_filter( 'posts_clauses', 'devn_order_rating' );
	}

	return $args;
}

function devn_order_rating( $args ) {
	global $wpdb;

	$args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";

	$args['where'] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";

	$args['join'] .= "
		LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
		LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
	";
	
	$order = woocommerce_clean( $_GET['product_order'] );
	$order = $order == 'asc' ? 'asc' : 'desc';
	$order = strtoupper($order);

	$args['orderby'] = "average_rating {$order}, $wpdb->posts.post_date DESC";

	$args['groupby'] = "$wpdb->posts.ID";

	return $args;
}

add_filter('loop_shop_per_page', 'devn_loop_per_page');
function devn_loop_per_page(){
	// Get WooCommerce admin setting.
	global $devn;

	parse_str($_SERVER['QUERY_STRING'], $params);

	if( !empty( $devn->cfg['product_number'] ) ) {
		$products_per_page = $devn->cfg['product_number'];
	} else {
		$products_per_page = 12;
	}

	$devn_product_count = !empty($params['product_count']) ? $params['product_count'] : $products_per_page;

	return $devn_product_count;
}

function devn_get_data_url($devn_url, $devn_pr_name, $devn_pr_value) {

	 $devn_url_info = parse_url($devn_url);
	 if(!isset($devn_url_info["query"]))
		 $devn_url_info["query"]="";

	 $params = array();
	 parse_str($devn_url_info['query'], $params);
	 $params[$devn_pr_name] = $devn_pr_value;
	 $devn_url_info['query'] = http_build_query($params);
	 return devn_generate_url($devn_url_info);
}

function devn_generate_url($devn_url_info) {

     $devn_url="";
     if(isset($devn_url_info['host']))
     {
         $devn_url .= $devn_url_info['scheme'] . '://';
         if (isset($devn_url_info['user'])) {
             $devn_url .= $devn_url_info['user'];
                 if (isset($devn_url_info['pass'])) {
                     $devn_url .= ':' . $devn_url_info['pass'];
                 }
             $devn_url .= '@';
         }
         $devn_url .= $devn_url_info['host'];
         if (isset($devn_url_info['port'])) {
             $devn_url .= ':' . $devn_url_info['port'];
         }
     }
     if (isset($devn_url_info['path'])) {
     	$devn_url .= $devn_url_info['path'];
     }
     if (isset($devn_url_info['query'])) {
         $devn_url .= '?' . $devn_url_info['query'];
     }
     if (isset($devn_url_info['fragment'])) {
         $devn_url .= '#' . $devn_url_info['fragment'];
     }
     return $devn_url;
 }

add_filter('add_to_cart_fragments', 'devn_woocommerce_update_cart_fragment');
function devn_woocommerce_update_cart_fragment( $fragments ) {

	global $woocommerce;

	ob_start();
	?>
	<li class="cart">
		<?php if(!$woocommerce->cart->cart_contents_count): ?>
		<a class="my-cart-link" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"></a>
		<?php else: ?>
		<a class="my-cart-link my-cart-link-active" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"></a>
		<div class="cart-contents">
			<?php foreach($woocommerce->cart->cart_contents as $cart_item): ?>
			<div class="cart-content">
				<a href="<?php echo get_permalink($cart_item['product_id']); ?>">
				<?php $thumbnail_id = ($cart_item['variation_id']) ? $cart_item['variation_id'] : $cart_item['product_id']; ?>
				<?php echo get_the_post_thumbnail($thumbnail_id, 'recent-works-thumbnail'); ?>
				<div class="cart-desc">
					<span class="cart-title"><?php echo esc_html( $cart_item['data']->post->post_title ); ?></span><br/>
					<span class="product-quantity"><?php print( $cart_item['quantity'] ); ?> x <?php print( $woocommerce->cart->get_product_subtotal($cart_item['data'], 1) ); ?></span>
				</div>
				</a>
			</div>
			<?php endforeach; ?>
			<div class="cart-checkout">
				<div class="cart-link"><a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><?php _e('View Cart', 'aaikadomain' ); ?></a></div>
				<div class="checkout-link"><a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>"><?php _e('Checkout', 'aaikadomain' ); ?></a></div>
			</div>
		</div>
		<?php endif; ?>
	</li>
	<?php
	$header_cart = ob_get_clean();
	$fragments['#cart-place .cart'] = $header_cart;

	return $fragments;

}

function  devn_cart_place_shortcode(){

	global $woocommerce;
	ob_start();?>
	<div id="cart-place">
		<li class="cart">
			<?php if(!$woocommerce->cart->cart_contents_count): ?>
			<a class="empty-cart" href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><?php _e('Cart', 'aaikadomain' ); ?></a>
			<?php else: ?>
			<a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><?php echo esc_html( $woocommerce->cart->cart_contents_count ); ?> <?php _e('Item(s)', 'aaikadomain' ); ?> - <?php echo woocommerce_price($woocommerce->cart->subtotal); ?></a>
			<div class="cart-contents">
				<?php foreach($woocommerce->cart->cart_contents as $cart_item): ?>
				<div class="cart-content">
					<a href="<?php echo get_permalink($cart_item['product_id']); ?>">
					<?php $thumbnail_id = ($cart_item['variation_id']) ? $cart_item['variation_id'] : $cart_item['product_id']; ?>
					<?php echo get_the_post_thumbnail($thumbnail_id, 'recent-works-thumbnail'); ?>
					<div class="cart-desc">
						<span class="cart-title"><?php echo esc_html( $cart_item['data']->post->post_title ); ?></span><br/>
						<span class="product-quantity"><?php echo esc_attr( $cart_item['quantity'] ); ?> x <?php echo esc_attr( $woocommerce->cart->get_product_subtotal($cart_item['data'], 1) ); ?></span>
					</div>
					</a>
				</div>
				<?php endforeach; ?>
				<div class="cart-checkout">
					<div class="cart-link"><a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>"><?php _e('View Cart', 'aaikadomain' ); ?></a></div>
					<div class="checkout-link"><a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>"><?php _e('Checkout', 'aaikadomain' ); ?></a></div>
				</div>
			</div>
			<?php endif; ?>
		</li>
	</div>	
<?php

 return ob_get_clean(); 

} 

$devn->ext['asc']( 'devn_cart_place', 'devn_cart_place_shortcode' );

add_action('woocommerce_after_single_product_summary', 'devn_woo_social_sharing', 15);
function devn_woo_social_sharing(){
	global $devn;
						
	if( $devn->cfg['showShareBox'] == 1 ){
	
	$link =  "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$escaped_link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
?>	

	<div class="sharepost woo-social-share">
		
		<ul>
		<?php if( $devn->cfg['showShareFacebook'] == 1 ){ ?>
		  <li class="globalBgColor">
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( $escaped_link ); ?>">
				&nbsp;<i class="fa fa-facebook fa-lg"></i>&nbsp;
			</a>
		  </li>
		  <?php } ?>
		  <?php if( $devn->cfg['showShareTwitter'] == 1 ){ ?>
		  <li class="globalBgColor">
			<a href="https://twitter.com/home?status=<?php echo esc_url( $escaped_link ); ?>">
				<i class="fa fa-twitter fa-lg"></i>
			</a>
		  </li>
		  <?php } ?>
		  <?php if( $devn->cfg['showShareGoogle'] == 1 ){ ?>
		  <li class="globalBgColor">
			<a href="https://plus.google.com/share?url=<?php echo esc_url( $escaped_link ); ?>">
				<i class="fa fa-google-plus fa-lg"></i>	
			</a>
		  </li>
		  <?php } ?>
		  <?php if( $devn->cfg['showShareLinkedin'] == 1 ){ ?>
		  <li class="globalBgColor">
			<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=&amp;title=&amp;summary=&amp;source=<?php echo esc_url( $escaped_link ); ?>">
				<i class="fa fa-linkedin fa-lg"></i>
			</a>
		  </li>
		  <?php } ?>
		  <?php if( $devn->cfg['showSharePinterest'] == 1 ){ ?>
		  <li class="globalBgColor">
			<a href="https://pinterest.com/pin/create/button/?url=&amp;media=&amp;description=<?php echo esc_url( $escaped_link ); ?>">
				<i class="fa fa-pinterest fa-lg"></i>
			</a>
		  </li>
		  <?php } ?>
		</ul>
	</div>

	
<?php 
		} 
	}
	
// Add switch woocommerce switch layout

add_action( 'woocommerce_before_shop_loop', 'devn_woocommerce_list_or_grid', 20 );
// 
function devn_woocommerce_list_or_grid() {
	if ( is_single() ) return;
	global $devn, $woocommerce_loop;
?>	
	<div class="devn-switch-layout">
			<a id="grid-button" class="grid-view<?php if ( $woocommerce_loop['view'] == 'grid' ) echo ' active'; ?>" href="#"><i class="fa fa-th-large"></i></a>
			<a id="list-button" class="list-view<?php if ( $woocommerce_loop['view'] == 'list' ) echo ' active'; ?>" href="#"><i class="fa fa-list"></i></a>
	</div>
	<?php 
		$html = '';		
		$html .='<script>
			jQuery( document ).ready( function( $ ) {
				$(".devn-switch-layout a").on( "click", function(){
					var devn_view = $(this).attr("class").replace( "-view", "" );
					$("ul.products li").removeClass("list grid").addClass( devn_view );
					$(this).parent().find("a").removeClass("active");
					$(this).addClass("active");
					
					$.cookie(devn_shop_view_cookie, devn_view);
					$("ul.products li").trigger("styleswitch");
					return false;
				});
			});';
		$html .='</script>';
		print( $html ); 
	} 


add_action('woocommerce_before_shop_loop_item_title', 'devn_woocommerce_img_effect', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
function devn_woocommerce_img_effect() {

	global $product, $woocommerce;

	$items_in_cart = array();

	if($woocommerce->cart->get_cart() && is_array($woocommerce->cart->get_cart())) {
		foreach($woocommerce->cart->get_cart() as $cart) {
			$items_in_cart[] = $cart['product_id'];
		}
	}

	$id = get_the_ID();
	$in_cart = in_array($id, $items_in_cart);
	$size = 'shop_catalog';

	$gallery = get_post_meta($id, '_product_image_gallery', true);
	$attachment_image = '';
	if(!empty($gallery)) {
		$gallery = explode(',', $gallery);
		$first_image_id = $gallery[0];
		$attachment_image = wp_get_attachment_image($first_image_id , $size, false, array('class' => 'hover-image'));
	}
	$thumb_image = get_the_post_thumbnail($id , $size);

	if($attachment_image) {
		$classes = 'product-detail-image crossfade-images';
	} else {
		$classes = 'product-detail-image';
	}
	
	if( empty( $thumb_image ) ){
		$thumb_image = '<img src="'.$woocommerce->plugin_url().'/assets/images/placeholder.png" />';
	}
	
	echo '<span class="'.$classes.'">';
	print( $attachment_image );
	print( $thumb_image );
	if($in_cart) {
		echo '<span class="cart-loading checked globalBgColor"><i class="icon-check"></i></span>';
	} else {
		echo '<span class="cart-loading"><i class="icon-spinner"></i></span>';
	}
	echo '</span>';
	
}


//======   WooCommerce Magnifier   ============//
function devn_magnifier_active(){
	global $devn;
	$devn->cfg['mg_active'] = 1;
	return true;
}

function devn_wishlist_actived(){
	global $devn;
	$devn->cfg['wl_actived'] = 1;
	return true;
}

if( !function_exists( 'wc_get_template_part' ) && function_exists( 'woocommerce_get_template_part' ) ){
	function wc_get_template_part( $a, $b ){
		return woocommerce_get_template_part( $a, $b );
	}
}

// Active Wishlist

include THEME_PATH.'/woocommerce/wishlist/init.php';

// Active Ajax navigation

include THEME_PATH.'/woocommerce/filter-product/init.php';

// Active Compare product!

include THEME_PATH.'/woocommerce/compare-product/init.php';

