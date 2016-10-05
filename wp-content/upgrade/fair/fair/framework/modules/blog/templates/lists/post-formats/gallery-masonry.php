<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<?php fair_edge_get_module_template_part('templates/lists/parts/gallery', 'blog'); ?>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<?php fair_edge_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<?php fair_edge_excerpt($excerpt_length); ?>
				<?php fair_edge_get_module_template_part('templates/lists/parts/pages-navigation', 'blog');  ?>
				<div class="edgtf-blog-slide-info-line-holder"><div class="edgtf-blog-slide-info-line"></div></div>
				<div class="edgtf-post-info">
					<div class="edgtf-post-info-top">
						<?php fair_edge_post_info(array('author' => 'yes','category' => 'yes', 'date' => 'yes')) ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>