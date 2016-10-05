	<?php
	
	if ( $posts->have_posts() ) {
		$i = 0;
		while ( $posts->have_posts() ) :
			$posts->the_post();
			global $post;
	?>
				
			<div class="lblogs animated eff-fadeInUp delay-<?php echo ($i+1); ?>00ms">
        
				<div class="lbimg">
					<a class="devn-post-thumbnail" href="<?php the_permalink(); ?>">
					<?php 
					
						$img = devn::get_featured_image( $post );
						echo '<img src="'.devn_createLinkImage( $img, '564x250' ).'" alt="" />';
					?>
					</a>
					<span><strong><?php echo esc_html( get_the_date('M') ); ?></strong> <?php echo esc_html( get_the_date('d') ); ?></span> 
				</div>
				
			    <h5 title="<?php echo esc_html( $post->post_title ); ?>"><?php echo substr($post->post_title,0,30); ?>...</h5>
			    
			    <a href="#" class="smlinks"><i class="fa fa-tags"></i> <?php echo count( get_the_tags() ); ?></a>
			    <a href="#" class="smlinks"><i class="fa fa-comment"></i> <?php echo esc_html( $post->comment_count ); ?></a>
			    <a class="smlinks"><i class="fa fa-folder-open-o"></i>  <?php echo count( get_the_category( $post->ID ) ); ?></a>
			    
			    <p><?php echo wp_trim_words($post->post_content, 13); ?>...</p>
			    
			    <a href="<?php the_permalink(); ?>" class="remobut">Read More</a> 
			    
			</div>
			
	<?php
			$i += 3;
			endwhile;
		}
		// Posts not found
		else {
			echo '<h4>' . __( 'Posts not found', 'aaikadomain' ) . '</h4>';
		}
	?>
