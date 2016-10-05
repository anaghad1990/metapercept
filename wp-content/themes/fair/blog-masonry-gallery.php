<?php
	/*
	Template Name: Blog Masonry Gallery
	*/
?>
<?php get_header(); ?>

<?php get_template_part( 'title' ); ?>
<?php get_template_part('slider'); ?>

	<div class="edgtf-full-width">
		<div class="edgtf-full-width-inner clearfix">
			<?php fair_edge_get_blog('masonry-gallery'); ?>
		</div>
	</div>
	<?php do_action('fair_edge_after_full_width_container_close') ?>
<?php get_footer(); ?>