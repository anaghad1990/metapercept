<?php
$type_class = '';
	if($type == 'with-title-image') {
		fair_edge_get_single_top_html();
		$type_class = 'edgtf-blog-with-title-image';
	}
?>
<div class="edgtf-container">
	<?php do_action('fair_edge_after_container_open'); ?>
		<div class="edgtf-container-inner">
			<?php if(($sidebar == "default")||($sidebar == "")) : ?>
				<div class="edgtf-blog-holder edgtf-blog-single <?php echo esc_attr($type_class);?>">
					<?php fair_edge_get_single_html(); ?>
				</div>
			<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
				<div <?php echo fair_edge_sidebar_columns_class(); ?>>
					<div class="edgtf-column1 edgtf-content-left-from-sidebar">
						<div class="edgtf-column-inner">
							<div class="edgtf-blog-holder edgtf-blog-single <?php echo esc_attr($type_class);?>">
								<?php fair_edge_get_single_html(); ?>
							</div>
						</div>
					</div>
					<div class="edgtf-column2">
						<?php get_sidebar(); ?>
					</div>
				</div>
			<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
				<div <?php echo fair_edge_sidebar_columns_class(); ?>>
					<div class="edgtf-column1">
						<?php get_sidebar(); ?>
					</div>
					<div class="edgtf-column2 edgtf-content-right-from-sidebar">
						<div class="edgtf-column-inner">
							<div class="edgtf-blog-holder edgtf-blog-single <?php echo esc_attr($type_class);?>">
								<?php fair_edge_get_single_html(); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php do_action('fair_edge_before_container_close'); ?>
</div>