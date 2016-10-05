<?php get_header(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php fair_edge_get_title(); ?>
<?php get_template_part('slider'); ?>

			<?php fair_edge_get_blog_single(); ?>

	<?php do_action('fair_edge_after_container_close'); ?>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>