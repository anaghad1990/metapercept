<?php
/*
*	(c) king-theme.com
*/	
	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	global $devn;
	if( empty( $devn->cfg['footerText'] ) ){
		$devn->cfg['footerText'] = 'Add footer copyrights text via <a href="'.admin_url('admin.php?page=aaika-panel').'"><strong>theme-panel</strong></a>';
	}
	
?>
<!--Footer Layout 3: Location /templates/footer/-->
<div id="footer-layout-3" class="container-fluid footer light">
	<div class="clearfix marb8"></div>
	<div class="limit-width container">
		<div class="spanlevelone col-md-3">
			<?php if ( is_active_sidebar( 'footer-c1' ) ) : ?>
				<div id="footer-column-1" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-c1' ); ?>
				</div><!-- #secondary -->
			<?php endif; ?>
		</div>
		<div class="spanlevelone col-md-3">
			<?php if ( is_active_sidebar( 'footer-c2' ) ) : ?>
				<div id="footer-column-2" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-c2' ); ?>
				</div><!-- #secondary -->
			<?php endif; ?>
		</div>
		<div class="spanlevelone col-md-3">
			<?php if ( is_active_sidebar( 'footer-c3' ) ) : ?>
				<div id="footer-column-3" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-c3' ); ?>
				</div><!-- #secondary -->
			<?php endif; ?>
		</div>
		<div class="spanlevelone col-md-3">
			<?php if ( is_active_sidebar( 'footer-c4' ) ) : ?>
				<div id="footer-column-4" class="widget-area" role="complementary">
					<?php dynamic_sidebar( 'footer-c4' ); ?>
				</div><!-- #secondary -->
			<?php endif; ?>
		</div>
	</div>
	<div class="copyright_info two">	
		<div class="limit-width container">
			<div class="one_half"><?php echo devn::esc_js( $devn->cfg['footerText'] ); ?></div>
			<div class="one_half last">
				<?php $devn->socials('footer_social_links three'); ?>
			</div>
		</div>
	</div>
</div>
