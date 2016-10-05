<?php $post_class[] = 'edgtf-post-format-twitter'; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-mark edgtf-link-mark">
			<span class="social_twitter"></span>
		</div>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
					<div class="edgtf-post-twitter-author"><?php print $twitter_author; ?></div>
					<?php fair_edge_get_module_template_part('templates/lists/parts/title', 'blog','', array('post_url' => get_post_meta(get_the_ID(), "edgtf_post_link_link_meta", true))); ?>
					<p class="edgtf-post-excerpt"><?php print $twitter_text; ?></p>
					<div class="edgtf-twitter-time">
						<?php print $twitter_time; ?>
					</div>
			</div>
		</div>
	</div>
</article>