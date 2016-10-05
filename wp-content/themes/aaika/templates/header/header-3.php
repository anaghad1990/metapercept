<?php
/**
*	This file has been preloaded, so you can wp_enqueue_style to out in wp_head();
*/	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	global $devn;
	
	wp_enqueue_style('devn-menu-3');
	
?>
<!--Header Layout 3: Location /templates/header/-->
<div id="trueHeader" class="container-fluid header">
	<div class="limit-width container">
		<div class="col-md-12">
			<div class="logo">
				<a href="<?php echo SITE_URI; ?>">
					<img src="<?php echo esc_url( $devn->cfg['logo'] ); ?>" alt="<?php bloginfo('description'); ?>" />
				</a>
			</div>
			
			<?php
				global $woocommerce;
				
				if( !empty( $woocommerce ) ){
			?>
			<div class="menu_right">
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'aaikadomain'); ?>" class="buynow cart-contents">
					<i class="fa fa-shopping-cart"></i> 
					<?php _e( 'Cart', 'aaikadomain' ); ?> 
					(<?php global $woocommerce; echo $woocommerce->cart->cart_contents_count; ?>)
				</a>
			</div>
			
			<?php } ?>
			
			<!-- Navigation Menu -->
			<nav class="menu_main">
				<div class="navbar yamm navbar-default">
					<div class="container">
						<div class="navbar-header">
							<div class="navbar-toggle .navbar-collapse .pull-right " data-toggle="collapse" data-target="#navbar-collapse-1">
								<span>
									<?php _e( 'Menu', 'aaikadomain' ); ?>
								</span>
								<button type="button">
									<i class="fa fa-bars"></i>
								</button>
							</div>
						</div>
						<div id="navbar-collapse-1" class="navbar-collapse collapse pull-right">
							<?php $devn->mainmenu(); ?>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</div>
</div>	