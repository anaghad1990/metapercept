<?php
/**
*	This file has been preloaded, so you can wp_enqueue_style to out in wp_head();
*/	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	global $devn;
	
	wp_enqueue_style('devn-menu-6');
	
?>
<!--Header Layout 6: Location /templates/header/-->
<div class="top_nav two">
	<div class="container">
		<div class="col-md-6 left">
			<?php print( !empty($devn->cfg['topInfo']) ? $devn->cfg['topInfo'] : '' ); ?>
		</div>
		<!-- end left -->
		<div class="col-md-6 right">
			<?php
				if( is_user_logged_in() ){
					$user = wp_get_current_user();
					echo '<a href="'.site_url().'/wp-admin/profile.php">'.__('Welcome ', 'aaikadomain' ).ucfirst($user->user_login).'</a>!';
				}else{
			?>
			<a href="<?php echo site_url(); ?>?action=login">
				<i class="fa fa-sign-in">
				</i>
				<?php _e('Sign In', 'aaikadomain' ); ?>
			</a>
			<a href="<?php echo site_url(); ?>?action=register">
				<i class="fa fa-user">
				</i>
				<?php _e('Register', 'aaikadomain' ); ?>
			</a>
			<?php } ?>
			<?php $devn->socials('topsocial two'); ?>
		</div>
		<!-- end right -->
	</div>
	<!-- end top links -->
</div>
<div class="clearfix"></div>
<header class="header">
	<div class="container">
		<div class="col-md-12">
			<!-- Logo -->
			<div class="logo">
				<a href="<?php echo esc_url( SITE_URI ); ?>">
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
									<?php _e('Menu', 'aaikadomain' ); ?>
								</span>
								<button type="button"><i class="fa fa-bars"></i></button>
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
</header>
