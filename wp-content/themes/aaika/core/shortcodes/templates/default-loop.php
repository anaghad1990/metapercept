<div class="devn-posts devn-posts-default-loop">
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
					<div class="devn-post-meta"><?php _e( 'Posted', 'aaikadomain' ); ?>: <?php the_time( get_option( 'date_format' ) ); ?></div>
					<div class="devn-post-excerpt">
						<?php the_excerpt(); ?>
					</div>
					<a href="<?php comments_link(); ?>" class="devn-post-comments-link"><?php comments_number( __( '0 comments', 'aaikadomain' ), __( '1 comment', 'aaikadomain' ), __( '%n comments', 'aaikadomain' ) ); ?></a>
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