<?php if ( has_post_thumbnail() ) { ?>
<?php $size = isset($image_size) ? $image_size : 'full'; ?>
	<div class="edgtf-post-image">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail($size); ?>
		</a>
	</div>
<?php } ?>