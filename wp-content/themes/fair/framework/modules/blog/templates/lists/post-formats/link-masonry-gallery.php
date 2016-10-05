<article id="post-<?php the_ID(); ?>" <?php post_class( $post_class ); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-mark edgtf-link-mark">
			<span class="icon_link"></span>
		</div>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<?php fair_edge_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<?php echo fair_edge_get_separator_html(array('position'=>'center'));?>
			</div>
		</div>
		<a class="edgtf-blog-masonry-gallery-link" href="<?php the_permalink(); ?>"></a>
	</div>
</article>