<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<?php if (!$soundcloud) {
			fair_edge_get_module_template_part('templates/single/parts/image', 'blog');
		} ?>
		<?php fair_edge_get_module_template_part('templates/parts/audio', 'blog'); ?>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner clearfix">
				<div class="edgtf-post-info">
					<div class="edgtf-post-info-top">
						<?php fair_edge_post_info(array('date' => 'yes', 'category' => 'yes')) ?>
					</div>
				</div>
				<?php fair_edge_get_module_template_part('templates/single/parts/title', 'blog'); ?>
				<?php echo fair_edge_get_separator_html(array());?>
				<?php the_content(); ?>
				<?php fair_edge_get_module_template_part('templates/lists/parts/pages-navigation', 'blog');  ?>
				<?php if(has_tag() || fair_edge_get_social_share_html() != '') : ?>
					<div class="edgtf-post-info-bottom">
						<div class="edgtf-post-info-bottom-left">
							<?php has_tag() ? the_tags('', ', ', '') : ''; ?>
						</div>
						<div class="edgtf-post-info-bottom-right">
							<?php fair_edge_post_info(array('share' => 'yes')) ?>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php do_action('fair_edge_before_blog_article_closed_tag'); ?>
</article>