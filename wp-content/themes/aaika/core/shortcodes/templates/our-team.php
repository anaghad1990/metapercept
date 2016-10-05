<?php

$i = 1;
if ( $posts->have_posts() ){
	
	echo '<div class="team-wrapper">';
	
	while ( $posts->have_posts() ) :
		$posts->the_post();
		global $post;
		
		$options = get_post_meta( $post->ID , 'devn_staff' );
		$options = shortcode_atts( array(
			'position'	=> 'position',
			'facebook'	=> 'devn',
			'twitter'	=> 'devn',
			'gplus'	=> 'devn',
		), $options[0], false );

switch( $style ){		
	
	case '2-columns' : 	
	
?>		
	<div class="one_half animated eff-fadeInUp delay-<?php echo esc_attr( $i ); ?>00ms<?php if( ($i)%2 == 0 )echo ' last'; ?>">
	    
		<div class="tbox">
	    
	    	<?php @the_post_thumbnail(' img_left13 rimg'); ?>
	        <h5 class="smt"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><em>- <?php echo esc_html( $options['position'] ); ?></em></h5>
	
	        <p><?php echo wp_trim_words( $post->post_content, $words ); ?></p>
	        
	    </div>
	    
	</div>

<?php

	break;		
	
	case 'grids' : 	
?>		
	<div class="one_fourth animated eff-fadeInUp delay-<?php echo esc_attr( $i ); ?>00ms<?php if( ($i)%4 == 0 )echo ' last'; ?>">
	    
		<div class="tbox">
	    
	    	<?php @the_post_thumbnail(); ?>
	        
	        <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
			<em><?php echo esc_html( $options['position'] ); ?></em>
	
	        <p><?php echo wp_trim_words( $post->post_content, $words ); ?></p>
	    	
	        <a href="https://facebook.com/<?php echo esc_attr( $options['facebook'] ); ?>"><i class="fa fa-facebook"></i></a> 
	        <a href="https://twitter.com/<?php echo esc_attr( $options['twitter'] ); ?>"><i class="fa fa-twitter"></i></a> 
	        <a href="https://plus.google.com/u/0/+/<?php echo esc_attr( $options['gplus'] ); ?>"><i class="fa fa-google-plus"></i></a>
	        
	    </div>
	    
	</div>

<?php
	
	if( ($i)%4 == 0 && $i < $items ){
		echo '<div class="clearfix margin_top1"></div>';
	}
	
	break;	
	
	case 'grids-2' : 	
?>		
	<div class="one_fourth animated eff-fadeInUp delay-<?php echo esc_attr( $i ); ?>00ms<?php if( ($i)%4 == 0 )echo ' last'; ?>">
        <div class="attbox">
            <div class="box">
            
            	<?php @the_post_thumbnail( $post->ID.' cirimg'); ?>
                
                <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
				<em><?php echo esc_html( $options['position'] ); ?></em>
                
                <p><?php echo wp_trim_words( $post->post_content, $words ); ?></p>

            	<a href="<?php echo get_the_permalink(); ?>" class="button1">Read More</a>
             
            </div>
        </div>
    </div>

<?php


	if( ($i)%4 == 0 && $i < $items )echo '<div class="margin_top9"></div><div class="clearfix"></div>';
	
	break;
	
	
	case 'circle' : 

?>	
<div class="one_fourth animated eff-fadeInUp delay-<?php echo esc_attr( $i ); ?>00ms<?php if( ($i)%4 == 0 )echo ' last'; ?>">
	<!-- colored -->
	<div class="ih-item circle effect3 bottom_to_top">
		<a href="<?php the_permalink(); ?>">
			<div class="img">
				<?php @the_post_thumbnail(); ?>
			</div>
			<div class="info">
				<h6><?php the_title(); ?></h6>
				<p><?php echo wp_trim_words( $post->post_content, $words ); ?></p>
			</div>
		</a>
	  </div>
	<!-- end colored -->
</div>	
<?php
	
	 if( ($i)%4 == 0 && $i < $items )echo '<div class="margin_top9"></div><div class="clearfix"></div>';
	
	break;	
	
	case 'circle-2' : 

?>	
<div class="one_fourth animated eff-fadeInUp delay-<?php echo esc_attr( $i ); ?>00ms<?php if( ($i)%4 == 0 )echo ' last'; ?>">
    
    <div class="flips1">
    
        <div class="flips1_front flipscont1">
        	<?php @the_post_thumbnail(); ?>
            <h5><strong><?php the_title(); ?></strong></h5>
           <?php echo esc_html( $options['position'] ); ?>
        </div>
        
        <div class="flips1_back flipscont1">
        	<h4 class="white"><strong><?php the_title(); ?></strong></h4>
            <p><?php echo wp_trim_words( $post->post_content, $words ); ?></p>
            <div class="fsoci">
	            <a href="https://facebook.com/<?php echo esc_url( $options['facebook'] ); ?>"><i class="fa fa-facebook"></i></a> 
		        <a href="https://twitter.com/<?php echo esc_url( $options['twitter'] ); ?>"><i class="fa fa-twitter"></i></a> 
		        <a href="https://plus.google.com/u/0/+/<?php echo esc_url( $options['gplus'] ); ?>"><i class="fa fa-google-plus"></i></a>
            </div>

            <a href="<?php the_permalink(); ?>" class="but_small5 light"><i class="fa fa-paper-plane"></i>&nbsp; Read more</a>
        </div>
        
    </div>

</div>

<?php
	
	 if( ($i)%4 == 0 && $i < $items )echo '<div class="margin_top9"></div><div class="clearfix"></div>';
	
	break;
	

}	
	$i++;
	endwhile;

	echo '</div>';
	
}else {
	echo '<h4>' . __( 'Teams not found', 'aaikadomain' ) . '</h4> <a href="'.admin_url('post-new.php?post_type=our-team').'"><i class="fa fa-plus"></i> Add New Staff</a>';
}
	
?>