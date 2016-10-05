<div class="edgtf-blog-holder edgtf-blog-type-narrow edgtf-hover-follows <?php echo esc_attr($blog_classes)?>">
	<?php
		if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			fair_edge_get_post_format_html($blog_type);
		endwhile;
		echo '<div class="edgtf-blog-narrow-bgrnd"></div>';
		else:
			fair_edge_get_module_template_part('templates/parts/no-posts', 'blog');
		endif;
	?>
</div>
