<div class="edgtf-blog-list-holder <?php echo esc_attr($holder_classes) ?>">
	<ul class="edgtf-blog-list">
	<?php if ($type == 'masonry') { ?>
		<li class="edgtf-blog-list-masonry-grid-sizer"></li>
		<li class="edgtf-blog-list-masonry-grid-gutter"></li>
	<?php } 
	$html = '';
		if($query_result->have_posts()):
		while ($query_result->have_posts()) : $query_result->the_post();
			$html .= fair_edge_get_shortcode_module_template_part('templates/'.$type, 'blog-list', '', $params);
		endwhile;
		print $html;
		else: ?>
		<div class="edgtf-blog-list-messsage">
			<p><?php esc_html_e('No posts were found.', 'fair'); ?></p>
		</div>
		<?php endif;
		wp_reset_postdata();
	?>
	<?php if ( ($type == 'narrow') && ($hover_follows_cursor == 'yes') ) { ?>
		<li class="edgtf-blog-narrow-bgrnd"></li>
	<?php } ?>
	</ul>	
</div>
