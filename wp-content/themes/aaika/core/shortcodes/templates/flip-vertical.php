<?php 

$i = 0;
if ( $posts->have_posts() ) {

	while ( $posts->have_posts() ) : $posts->the_post();
	global $post, $devn;
		
	$image = $devn->get_featured_image( $post );
	$i++;
?>			

<div class="one_fourth<?php if( $i%4 == 0 )echo ' last'; ?>">
    
    <div class="flips2">
    
        <div class="flips2_front flipscont1">
        	<img src="<?php echo devn_createLinkImage( $image, '257x318' ); ?>" alt="<?php echo esc_attr( $post->post_title ); ?>" class="full">
        </div>
        
        <div class="flips2_back globalBgColor flipscont1">
        	<h4 class="white"><strong><?php echo esc_html( $post->post_title ); ?></strong></h4>
            <p><?php echo substr($post->post_content,0,100); ?>[...]</p>
            <br>
            <a href="<?php echo get_permalink(); ?>" class="but_small5 light"><i class="fa fa-paper-plane"></i>&nbsp; Read more</a>
        </div>
        
    </div>

</div>

<?php

		endwhile;
	} else {
			echo '<h4>' . __( 'Posts not found', 'aaikadomain' ) . '</h4>';
		}

?>
