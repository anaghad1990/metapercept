<article id="post-<?php the_ID(); ?>" <?php post_class('edgtf-post-format-instagram'); ?>>
	<div class="edgtf-post-content">
		<?php if ( $instagram_thumbnail_url ) { ?>
			<div class="edgtf-post-image">
				<a href="<?php echo esc_url(get_post_meta(get_the_ID(), "edgtf_post_link_link_meta", true)); ?>" title="<?php the_title_attribute(); ?>">
					<img alt="<?php the_title(); ?>" title="<?php the_title(); ?>" src="<?php echo esc_url($instagram_thumbnail_url); ?>" width="<?php echo esc_attr($instagram_thumbnail_width); ?>" height="<?php echo esc_attr($instagram_thumbnail_height); ?>">
					<div class="edgtf-inst-mark">
						<span class="social_instagram"></span>
					</div>
				</a>
			</div>
		<?php } ?>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<span><?php print $instagram_title; ?></span>
			</div>
		</div>
	</div>
</article>