	<?php
	
	if ( $posts->have_posts() ) {
		$i = 0;
		$ar = array(1,2,2,3);
		while ( $posts->have_posts() ) :
			$posts->the_post();
			global $post;
			$img = devn::get_featured_image( $post, true );
	?>
				
			<a href="<?php the_permalink(); ?>">
		        <div class="box<?php echo esc_attr( $ar[$i] ); ?> animated eff-fadeInUp delay-<?php echo esc_attr( $i*2 ); ?>00ms" style="background-image: url('<?php echo esc_url( $img ); ?>');">
		            <div class="hovcont">
		            	<?php if( $i == 0 ){ ?>
		               		<h2><?php echo substr($post->post_title,0,25); ?>..</h2>
		               	<?php }else{ ?>	
					   		<h3><?php echo substr($post->post_title,0,25); ?>..</h3>
					   	<?php } ?>	
		                <h5><?php echo wp_trim_words($post->post_content, 6); ?></h5>
		            </div>
		        </div>
		    </a>
			
<?php
		$i++;
		endwhile;
	}
	// Posts not found
	else {
		echo '<h4>' . __( 'Posts not found', 'aaikadomain' ) . '</h4>';
	}
?>
