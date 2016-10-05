<div class="devn-posts devn-posts-single-post">
	<?php
		// Prepare marker to show only one post
		$first = true;
		// Posts are found
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) :
				$posts->the_post();
				global $post;

				// Show oly first post
				if ( $first ) {
					$first = false;
					?>
					<div id="devn-post-<?php the_ID(); ?>" class="devn-post">
						<h1 class="devn-post-title"><?php the_title(); ?></h1>
						<div class="devn-post-meta"><?php _e( 'Posted', 'aaikadomain' ); ?>: <?php the_time( get_option( 'date_format' ) ); ?> | <a href="<?php comments_link(); ?>" class="devn-post-comments-link"><?php comments_number( __( '0 comments', 'aaikadomain' ), __( '1 comment', 'aaikadomain' ), __( '%n comments', 'aaikadomain' ) ); ?></a></div>
						<div class="devn-post-content">
							<?php the_content(); ?>
						</div>
					</div>
					<?php
				}
			endwhile;
		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'aaikadomain' ) . '</h4>';
		}
	?>
</div>