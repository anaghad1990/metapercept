<div class="fbposts"> 
	<?php
		// Posts are found
		if ( $posts->have_posts() ) {
			while ( $posts->have_posts() ) :
				$posts->the_post();
				global $post;
				?>

				<a href="<?php the_permalink(); ?>">
					<?php 
						
						if ( has_post_thumbnail() ) :
						
							echo '<img src="'.devn_createLinkImage( devn::get_featured_image( $post, true ), '50x50' ).'" alt="" />';
							
						endif;
						the_title();
					
					 ?>
				</a>

				<?php
			endwhile;
		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'aaikadomain' ) . '</h4>';
		}
	?>
</div>