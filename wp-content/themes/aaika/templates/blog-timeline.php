<?php
	/**
	*
	* @author king-theme.com
	*
	*/
	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	global $post, $more, $devn;
	
	get_header();

	
?>

<div class="clearfix"></div>

<div class="page_title two">
	<div class="container">
		<div class="title">
			<h1>
				History
			</h1>
		</div>
		<h3>
			Storytelling fused with technology and design.
		</h3>
		<h5>
			Anchour enhances business with its proven web media services.
		</h5>
	</div>
</div>

<div class="clearfix"></div>

<div class="content_fullwidth less">
	<div class="features_sec65">
		<div class="container no-touch">
			<div id="cd-timeline" class="cd-container">
				<?php devn_ajax_loadPostsTimeline(); ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>   