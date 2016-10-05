<?php
/**
*	This file has been preloaded, so you can wp_enqueue_style to out in wp_head();
*/	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	global $devn;
	
	wp_enqueue_style('devn-menu-4');
	
?>
<!--Header Layout 4: Location /templates/header/-->
<div id="header" class="container-fluid header">
	<div id="topHeader">
		<div class="wrapper">
			<div class="top_nav">
				<div class="container">
					<div class="col-md-12">
						<div class="left">
							<a href="<?php echo esc_url( SITE_URI ); ?>" class="logo">
								<img src="<?php echo esc_url( $devn->cfg['logo'] ); ?>" alt="<?php bloginfo('description'); ?>" />
							</a>
						</div>
						<!-- end left -->
						<div class="right">
							<?php
								global $woocommerce;
								
								if( !empty( $woocommerce ) ){
							?>
								<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'aaikadomain'); ?>" class="buynow cart-contents">
									<i class="fa fa-shopping-cart"></i> 
									<?php _e( 'Cart', 'aaikadomain' ); ?> 
									(<?php global $woocommerce; echo $woocommerce->cart->cart_contents_count; ?>)
								</a>
							<?php } ?>
							<?php echo devn::esc_js( !empty($devn->cfg['topInfo']) ? $devn->cfg['topInfo'] : '' ); ?>
							<?php $devn->socials('topsocial'); ?>
						</div>
						<!-- end right -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end top navigations -->
	<div id="trueHeader">
		<div class="wrapper">
			<!-- Navigation Menu -->
			<div class="container">
				<div class="col-md-12">
					<nav class="menu_main2">
						<div class="navbar yamm navbar-default">
							<div class="navbar-header">
								<div class="navbar-toggle .navbar-collapse .pull-right " data-toggle="collapse" data-target="#navbar-collapse-1">
									<span>
										<?php _e('Menu', 'aaikadomain' ); ?>
									</span>
									<button type="button">
										<i class="fa fa-bars">
										</i>
									</button>
								</div>
							</div>
							<div id="navbar-collapse-1" class="navbar-collapse collapse">
								<?php $devn->mainmenu(); ?>
							</div>
						</div>
					</nav>
					<!-- end Navigation Menu --> 
					<div class="menu_right2">
						<div class="search_hwrap">
							<form action="<?php echo SITE_URI; ?>" autocomplete="on">
								<input id="search" name="s" type="text" placeholder="Search the site...">
								<input id="search_submit" value="Rechercher" type="submit">
							</form>
						</div>
					</div>
					<!-- end search bar --> 
				</div>
			</div>
		</div>
	</div>	
</div>