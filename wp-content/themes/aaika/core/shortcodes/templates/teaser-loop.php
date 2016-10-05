<div class="devn-posts devn-posts-teaser-loop">
	<?php
		// Posts are found
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) :
				$posts->the_post();
				global $post;
				?>
				<div id="devn-post-<?php the_ID(); ?>" class="devn-post">
					<?php if ( has_post_thumbnail() ) : ?>
						<a class="devn-post-thumbnail" href="<?php the_permalink(); ?>"><?php @the_post_thumbnail(); ?></a>
					<?php endif; ?>
					<h2 class="devn-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div>
				<?php
			endwhile;
		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'aaikadomain' ) . '</h4>';
		}
	?>
</div>