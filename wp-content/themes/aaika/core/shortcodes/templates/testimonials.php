<?php

if ( $posts->have_posts() ){
	
	switch( $layout ){
		
		case 'slider-1' : 
		
		?>
		<div class="peosays slider nosidearrows leftnav">
			<div class="flexslider carousel">
				<ul class="slides">
			<?php
		
				while ( $posts->have_posts() ) :
					$posts->the_post();
					global $post;
					$options = get_post_meta( $post->ID, 'devn_testi' );
					$options = shortcode_atts( array(
						'website'	=> 'www.yourwebsite.com',
						'rate'	=> 5
					), $options[0], false );
			?>
			<li class="box">
	                
	        	<div class="ppimg">
	        		<?php @the_post_thumbnail(); ?>
	        		<h6><?php the_title(); ?> <em><?php echo esc_url( $options['website'] ); ?></em></h6>
	        	</div>
	            
	            <p><?php echo wp_trim_words( $post->post_content, $words ); ?></p>
	            
	            <span> Rating: &nbsp; 
	            
	            	<?php
		            	
		            	if( !is_numeric( $options['rate'] ) ){
			            	$options['rate'] = 3;
		            	}
		            	for( $i=0; $i < $options['rate']; $i++ ){
			            	echo '<i class="fa fa-star"></i> ';
		            	}
		            	
	            	?>
	            	
	            </span>
	            
	        </li>
	        <?php
		        endwhile;
	        ?>
				</ul>
			</div>	
        </div>
		
		<?php
		break;
		
		case 'slider-2' : 
		
		?>
		<div class="peosays slider nosidearrows nosidearrows_three">
			<div class="flexslider carousel">
				<ul class="slides">
			<?php
		
				while ( $posts->have_posts() ) :
					$posts->the_post();
					global $post;
					$options = get_post_meta( $post->ID, 'devn_testi' );
					$options = shortcode_atts( array(
						'website'	=> 'www.yourwebsite.com',
						'rate'	=> 5
					), $options[0], false );
			?>
			<li>
                
            	<?php @the_post_thumbnail(); ?>
                <h6><?php the_title(); ?><em>- <?php echo esc_url( $options['website'] ); ?> -</em></h6>
                
                <p><?php echo wp_trim_words( $post->post_content, $words ); ?></p>

			</li>
	        <?php
		        endwhile;
	        ?>
				</ul>
			</div>	
        </div>
		
		<?php
		break;
		
	}
	
}else {
	echo '<h4>' . __( 'Testimonials not found', 'aaikadomain' ) . '</h4> <a href="'.admin_url('post-new.php?post_type=testimonials').'"><i class="fa fa-plus"></i> Add New Testimonial</a>';
}	
	
?>