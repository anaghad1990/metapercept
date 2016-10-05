<?php
$blog_archive_pages_classes = fair_edge_blog_archive_pages_classes(fair_edge_get_default_blog_list());
?>
<?php get_header(); ?>
<?php fair_edge_get_title(); ?>
<div class="<?php echo esc_attr($blog_archive_pages_classes['holder']); ?>">
	<?php do_action('fair_edge_after_container_open'); ?>
	<div class="<?php echo esc_attr($blog_archive_pages_classes['inner']); ?>">
		<?php fair_edge_get_blog(fair_edge_get_default_blog_list()); ?>
	</div>
	<?php do_action('fair_edge_before_container_close'); ?>
</div>
<?php do_action('fair_edge_after_container_close'); ?>
<?php get_footer(); ?>
