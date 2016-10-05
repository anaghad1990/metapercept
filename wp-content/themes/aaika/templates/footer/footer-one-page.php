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
<!--Footer Layout one-page: Location /templates/footer/-->
<div id="footer-one-page" class="container-fluid">
	<div class="devn-group footer style2" id="contact">
		<div class="container">
			<div class="clearfix marb2"></div>
			<div class="one_half animated eff-fadeIn delay-800ms">
				<h4>
					Address Info
				</h4>
				<ul class="faddress">
					<li>
						<i class="fa fa-map-marker fa-lg">
						</i>
						2901 Marmora Road, Glassgow,
						<br>
						Seattle, WA 98122-1090
					</li>
					<li>
						<i class="fa fa-phone">
						</i>
						1 -234 -456 -7890
					</li>
					<li>
						<i class="fa fa-print">
						</i>
						1 -234 -456 -7890
					</li>
					<li>
						<a href="mailto:info@yourdomain.com">
							<i class="fa fa-envelope">
							</i>
							info@yourdomain.com
						</a>
					</li>
					<li>
						<i class="fa fa-paper-plane">
						</i>
						<a href="#">
							www.yoursitename.com
						</a>
					</li>
				</ul>
				<div class="clearfix margin_top4"></div>
				<div class="one_full">
					<?php echo '<ifr'.'ame class="google-map5" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=Washington,+DC,+United+States&aq=2&oq=was&sll=40.714353,-74.005973&sspn=0.765069,1.674042&ie=UTF8&hq=&hnear=Washington,+District+of+Columbia&t=m&z=11&ll=38.907231,-77.036464&output=embed&wmode=transparent"></ifr'.'ame>'; ?>
					<br>
					<small>
						<a href="https://maps.google.com/maps?f=q&source=embed&hl=en&geocode=&q=Washington,+DC,+United+States&aq=2&oq=was&sll=40.714353,-74.005973&sspn=0.765069,1.674042&ie=UTF8&hq=&hnear=Washington,+District+of+Columbia&t=m&z=11&ll=38.907231,-77.036464" style="color:#0000FF;text-align:left">
							<?php _e('View Larger Map', 'aaikadomain' ); ?>
						</a>
					</small>
				</div>
			</div>
			<div class="one_half last animated eff-fadeInUp delay-900ms">
				<h4>
					<?php _e('Send Message', 'aaikadomain' ); ?>
				</h4>
				<div class="clearfix">
				</div>
				<div class="devn-form two">
					<?php echo do_shortcode( '[cf7 slug="Contact Form"]' ); ?>
				</div>
			</div>
			<!-- end form -->
			<div class="clearfix margin_top3"></div>
		</div>
		<div class="copyright_info two">
			<div class="container">
				<div class="clearfix divider_dashed10"></div>
				<div class="one_half"><?php echo devn::esc_js( $devn->cfg['footerText'] ); ?></div>
				<div class="one_half last">
					<?php $devn->socials('footer_social_links two'); ?>
				</div>
			</div>
		</div>
	</div>	
</div>