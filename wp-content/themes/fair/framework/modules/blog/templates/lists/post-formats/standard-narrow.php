<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-text">
			<h5 class="edgtf-item-categories-section">
				<span class="edgtf-post-info-category">
					<?php the_category(', '); ?>
				</span>
			</h5>
			<?php fair_edge_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
			<?php echo fair_edge_get_separator_html(array('position' => 'center'));?>
			<?php fair_edge_excerpt($excerpt_length); ?>
			<?php fair_edge_get_module_template_part('templates/lists/parts/pages-navigation', 'blog');  ?>
			<div class="edgtf-post-info">
				<div class="edgtf-post-info-top">
					<?php fair_edge_post_info(array(
						'author' => 'yes',
						'date' => 'yes',
					)) ?>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php the_permalink(); ?>" class="edgtf-blog-narrow-link-over"></a>
</article>