<?php
	
if ( $posts->have_posts() ) {	

	global $devn;	
	
	if( $atts['column'] == 'flat' ){
	
		$postsObj = $posts->posts;
	
?>

<div class="left">
        
    <div class="boxsize1 animated eff-fadeInUp delay-500ms">
    <div class="hp-item square effect10 bottom_to_top">
    	
    <?php if( !empty( $postsObj[0] ) ){ ?>
        <a href="<?php echo get_the_permalink( $postsObj[0]->ID ); ?>">
            <div class="img"><img src="<?php echo $devn->get_featured_image( $postsObj[0] ); ?>" alt=""></div>
            <div class="info">
            <h3><?php echo wp_trim_words( $postsObj[0]->post_content, 5 ); ?></h3>
            </div>
        </a>
    <?php }else{ echo '<div class="img"><img src="'.THEME_URI.'/assets/images/default.jpg" alt=""></div>'; } ?>
    
    </div>
    </div><!-- end item -->
	
    <div class="boxsize3 animated eff-fadeInLeft delay-600ms">
        <div class="onlycolor">
        
            <?php 
            
            	if( !empty( $postsObj[0] ) ){
            		echo '<h3>'.wp_trim_words( $postsObj[0]->post_title, 3 ).'</h3>';
            	}
            	else{
            		echo '<h3>No Work</h3>';
            	}
            ?>
        
        </div>
    </div><!-- end item -->
    
    <div class="boxsize3 animated eff-fadeInDown delay-500ms">
    <div class="hp-item square effect10 bottom_to_top">

	<?php if( !empty( $postsObj[1] ) ){ ?>
        <a href="<?php echo get_the_permalink( $postsObj[1]->ID ); ?>">
            <div class="img"><img src="<?php echo $devn->get_featured_image( $postsObj[1] ); ?>" alt=""></div>
            <div class="info">
            <h3><?php echo wp_trim_words( $postsObj[1]->post_content, 5 ); ?></h3>
            </div>
        </a>
    <?php }else{ echo '<div class="img"><img src="'.THEME_URI.'/assets/images/default.jpg" alt=""></div>'; } ?>

    </div>
    </div><!-- end item -->
    
</div>	

<div class="center">
        
    <div class="boxsize2 animated eff-fadeInUp delay-500ms">
    <div class="hp-item square effect10 bottom_to_top">
        
    <?php if( !empty( $postsObj[2] ) ){ ?>
        <a href="<?php echo get_the_permalink( $postsObj[2]->ID ); ?>">
            <div class="img"><img src="<?php echo $devn->get_featured_image( $postsObj[2] ); ?>" alt=""></div>
            <div class="info">
            <h3><?php echo wp_trim_words( $postsObj[2]->post_content, 5 ); ?></h3>
            </div>
        </a>
    <?php }else{ echo '<div class="img"><img src="'.THEME_URI.'/assets/images/default.jpg" alt=""></div>'; } ?>
        
    </div>
    </div><!-- end item -->
    
    <div class="boxsize2 animated eff-fadeInRight delay-500ms">
        <div class="onlycolor">
        
            <?php 
            
            	if( !empty( $postsObj[2] ) ){
            		echo '<h3>'.wp_trim_words( $postsObj[2]->post_title, 3 ).'</h3>';
            	}
            	else{
            		echo '<h3>No Work</h3>';
            	}
            ?>
        
        </div>
    </div><!-- end item -->
    
    <div class="boxsize3 animated eff-zoomIn delay-600ms">
        <div class="onlycolor white">
        
            <?php 
            
            	if( !empty( $postsObj[3] ) ){
            		echo '<h3 class="darkc">'.wp_trim_words( $postsObj[3]->post_title, 3 ).'</h3>';
            	}
            	else{
            		echo '<h3>No Work</h3>';
            	}
            ?>
        
        </div>
    </div><!-- end item -->
	
    <div class="boxsize1 animated eff-fadeInDown delay-500ms">
    <div class="hp-item square effect10 bottom_to_top">
   
    <?php if( !empty( $postsObj[3] ) ){ ?>
        <a href="<?php echo get_the_permalink( $postsObj[3]->ID ); ?>">
            <div class="img"><img src="<?php echo $devn->get_featured_image( $postsObj[3] ); ?>" alt=""></div>
            <div class="info">
            <h3><?php echo wp_trim_words( $postsObj[3]->post_content, 5 ); ?></h3>
            </div>
        </a>
    <?php }else{ echo '<div class="img"><img src="'.THEME_URI.'/assets/images/default.jpg" alt=""></div>'; } ?>
        
    </div>
    </div><!-- end item -->
    
</div>


<div class="right">
        
    <div class="boxsize4 animated eff-fadeInUp delay-600ms">
    <div class="hp-item square effect10 bottom_to_top">
       
    <?php if( !empty( $postsObj[4] ) ){ ?>
        <a href="<?php echo get_the_permalink( $postsObj[4]->ID ); ?>">
            <div class="img"><img src="<?php echo devn::get_featured_image( $postsObj[4] ); ?>" alt=""></div>
            <div class="info">
            <h3><?php echo wp_trim_words( $postsObj[4]->post_content, 5 ); ?></h3>
            </div>
        </a>
    <?php }else{ echo '<div class="img"><img src="'.THEME_URI.'/assets/images/default.jpg" alt=""></div>'; } ?>
        
       
    </div>
    </div><!-- end item -->
	
    <div class="boxsize2 animated eff-fadeInUp delay-500ms">
        <div class="onlycolor white">
        
           <?php 
            
            	if( !empty( $postsObj[4] ) ){
            		echo '<h3 class="darkc">'.wp_trim_words( $postsObj[4]->post_title, 3 ).'</h3>';
            	}
            	else{
            		echo '<h3>No Work</h3>';
            	}
            ?>
        
        </div>
    </div><!-- end item -->
    
    <div class="boxsize2 animated eff-zoomIn delay-500ms">
	    <div class="hp-item square effect10 bottom_to_top">
	     
	     <?php if( !empty( $postsObj[5] ) ){ ?>
	        <a href="<?php echo get_the_permalink( $postsObj[5]->ID ); ?>">
	            <div class="img"><img src="<?php echo devn::get_featured_image( $postsObj[5] ); ?>" alt=""></div>
	            <div class="info">
	            <h3><?php echo wp_trim_words( $postsObj[5]->post_content, 5 ); ?></h3>
	            </div>
	        </a>
		<?php }else{ echo '<div class="img"><img src="'.THEME_URI.'/assets/images/default.jpg" alt=""></div>'; } ?>
	    
	    </div>
    </div><!-- end item -->
        
</div>
	
		
<?php
		
	}else{ // End if Flat style
		
?>

<div>
	
	<div id="devn-filters-container" class="devn-portfolio-filters" <?php if( $atts['filter'] != 'Yes' )echo 'style="visibility: hidden;height: 0px;margin: 0px;width: 100%;clear: both;"'; ?>>
	    <button data-filter="*" class="devn-portfolio-filter-item-active devn-portfolio-filter-item">
	    	<?php _e('All', 'aaikadomain' ); ?>
	    </button>
	</div>
	
	<div id="devn-grid-container" class="devn-portfolio-main <?php echo esc_attr( $atts['column'] ); ?>">
	    <ul>
		<?php

			$catsStack = array();
			
			$i = 0;
			switch( $atts['column'] ){
				case 'two' : $col = 2; break;
				case 'four' : $col = 4; break;
				default : $col = 3; break;
			}
			
			while ( $posts->have_posts() ) :
			
				$posts->the_post();
				global $post;
				$i++;
				
				$image = $devn->get_featured_image( $post );
				$cats = get_the_category();
				$cateClass = '';
				if( count( $cats ) ){
					foreach( $cats as $cat ){
						$cat = strtolower( str_replace(' ','-',$cat->cat_name) );
						if( !in_array($cat, $catsStack) ){
							array_push( $catsStack , $cat );
						}
						$cateClass .= $cat.' ';
					}	
				}
				
				if( $i%$col == 0 )$cateClass .= ' last';
				
			?>
			
			
			<li class="devn-portfolio-item <?php echo esc_attr( $cateClass ); ?>">
				<div class="devn-portfolio-item-wrapper">
                    <div class="devn-portfolio-image">
                        <img class="noborder" src="<?php echo esc_url( $image ); ?>" alt="<?php the_title(); ?>" /></div>
                    <a href="#" class="devn-portfolio-caption-wrap">
                        <div class="devn-portfolio-caption">
                            <div class="devn-portfolio-caption-body">
                                <div class="devn-portfolio-caption-title"><?php the_title(); ?></div>
                                <div class="devn-portfolio-caption-desc"><?php the_excerpt(); ?></div>
                            </div>
                        </div>
                    </a>
                    <a href="<?php echo esc_url( $image ); ?>"  title="<?php the_title(); ?>" class="btn linkfr view-large lightbox">
                    	<i class="fa fa-search"></i>
                    </a>
                    <a href="<?php the_permalink(); ?>" title="<?php _e('More Detail','aaikadomain'); ?>" class="btn linkfr more-detail">
                    	<i class="fa fa-link"></i>
                    </a>
                </div>
             </li>
                
		<?php
			endwhile;
		?>
		
		
		</ul>
		
		<script type="text/javascript">
		<?php 
			
			$btn = '';
			foreach( $catsStack as $cat ){
				$btn .= '<button data-filter=".'.$cat.'" class="devn-portfolio-filter-item">'.str_replace('-',' ',$cat).'</button>';
			}
			echo 'jQuery("#devn-filters-container").append(\''.$btn.'\');';
			
		?>
		</script>
		
		
	</div>
</div>

<?php
	
	} // Endelse Column
		
}else {
	echo '<h4>' . __( 'Works not found', 'aaikadomain' ) . '</h4> <a href="'.admin_url('post-new.php?post_type=our-works').'"><i class="fa fa-plus"></i> Add New Work</a>';
}	
	
?>