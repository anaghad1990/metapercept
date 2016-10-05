<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner clearfix">
				<?php the_content(); ?>
				<?php fair_edge_get_module_template_part('templates/lists/parts/pages-navigation', 'blog');  ?>
				<?php if(has_tag() || fair_edge_get_social_share_html() != '') : ?>
					<div class="edgtf-post-info-outer">
						<div class="edgtf-post-info-bottom">
							<div class="edgtf-post-info-bottom-left">
								<?php has_tag() ? the_tags('', ', ', '') : ''; ?>
							</div>
							<div class="edgtf-post-info-bottom-right">
								<?php fair_edge_post_info(array('share' => 'yes')) ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php do_action('fair_edge_before_blog_article_closed_tag'); ?>
</article>