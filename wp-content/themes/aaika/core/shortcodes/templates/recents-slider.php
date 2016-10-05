<?php
	
	wp_enqueue_script('devn-bacslider');
	
?>

 <div class="main-slider-container rnews_wra">
        
    <div class="prevli crousel-navigation"></div>
    <div class="nextli crousel-navigation"></div>
    
        <div class="bacslider-container">
        
            <ul>

			<?php
				// Posts are found
				if ( $posts->have_posts() ) {
					while ( $posts->have_posts() ) :
						$posts->the_post();
						global $post;
						?>
		
						<li>
							<a class="devn-post-thumbnail" href="<?php the_permalink(); ?>">
							<?php
								$img = devn::get_featured_image( $post );
								echo '<img src="'.devn_createLinkImage( $img, '514x288' ).'" alt="" />';
							?>
							</a>
							 <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( $post->post_title ); ?>">
							 	<strong><?php echo substr($post->post_title,0,23); ?>...</strong>
							 </a>
							 <a href="#" class="dsm"><?php echo esc_html( get_the_date('d.m.Y') ); ?></a>
							 <p><?php echo wp_trim_words( $post->post_content, 12 ); ?></p>
							
						</li>
		
						<?php
					endwhile;
				}

				else {
					echo '<h4>' . __( 'Posts not found', 'aaikadomain' ) . '</h4>';
				}
			?>
			
           </ul>
     </div>    	
</div>