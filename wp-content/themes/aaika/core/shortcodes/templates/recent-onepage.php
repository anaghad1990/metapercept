<div class="rbps">
<?php

$i = 1;
if ( $posts->have_posts() ){
	while ( $posts->have_posts() ) :
		$posts->the_post();
		global $post;
	
?>		
	<div class="one_third animated eff-fadeInUp delay-<?php echo esc_attr( $i ); ?>00ms<?php if( ($i)%3 == 0 )echo ' last'; ?>">
	    
	   <?php @the_post_thumbnail(' rimg'); ?>
    
	    <div class="date"><h5><a href="<?php the_permalink(); ?>"><strong><?php echo esc_html( get_the_date('d') ); ?></strong><?php echo esc_html( get_the_date('M Y') ); ?></a></h5></div>
	    
	    <div class="contarea">
	    
	        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
	        
	        <p><?php echo wp_trim_words( $post->post_content, 13 ); ?></p>
	        
	    </div>
	    
	</div>

<?php
	
	if( $i%3 == 0 && $i<$items )echo '<div class="clearfix margin_top9"></div>';
	
	$i++;
	endwhile;
	
}else {
	echo '<h4>' . __( 'Posts not found', 'aaikadomain' ).' </h4>';
}
	
?>

</div>