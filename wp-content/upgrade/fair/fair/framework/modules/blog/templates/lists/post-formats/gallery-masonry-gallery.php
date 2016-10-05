<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<div class="edgtf-post-content">
		<?php fair_edge_get_module_template_part('templates/lists/parts/gallery', 'blog', '',array('image_size'=>$image_size)); ?>
		<div class="edgtf-post-overlay"></div>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<?php fair_edge_post_info(array('category' => 'yes')) ?>
				<?php fair_edge_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<?php fair_edge_post_info(array('date' => 'yes')) ?>
			</div>
		</div>
	</div>
</article>