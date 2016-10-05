<?php

global $devn;

if( $devn->cfg['archiveRelatedPosts'] == 1 ):

	$related_no = $devn->cfg['archiveNumberofPosts'] ? $devn->cfg['archiveNumberofPosts'] : 3;

	global $post;
	$orig_post = $post;
	
	$query_type = $devn->cfg['archiveRelatedQuery'] ;

	if( $query_type == 'author' ){
		$args = array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'author'=> get_the_author_meta( 'ID' ));
	}elseif( $query_type == 'tag' ){
		$tags = wp_get_post_tags($post->ID);
		$tags_ids = array();
		foreach($tags as $individual_tag) $tags_ids[] = $individual_tag->term_id;
		$args=array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'tag__in'=> $tags_ids );
	}
	else{
		
		$categories = get_the_category($post->ID);
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args = array('post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'category__in'=> $category_ids );
	}		

	$related_query = new wp_query( $args );
	
	if( $related_query->have_posts() ) : 
		
		$count=0;
	
	?>
	
		<div class="clearfix margin_top3"></div>
		
		<section id="related_posts">
			<div class="block-head">
				<h4 class="widget-title"><?php _e( 'Related Articles' , 'aaikadomain' ); ?></h4>
				<div class="stripe-line"></div>
			</div>
			
			<div class="post-listing">
			
				<?php
					
					while ( $related_query->have_posts() ) : $related_query->the_post(); 
					
				?>
				<div class="related-item col-md-4">
					<ul class="recent_posts_list">
						<li>
							<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'aaikadomain' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
								<img src="<?php echo devn_createLinkImage( $devn->get_featured_image($post,false), '272x124' ); ?>" alt="<?php the_title(); ?>" />
								<span class="overlay-icon"></span>
							</a>
							<br />
							<a class="relate-link" href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permalink to %s', 'aaikadomain' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
							<i><?php the_time(get_option('date_format')); ?></i>
						</li>
					</ul>		
				</div>
				
				<?php endwhile;?>
			</div>
		</section>
		
		<div class="clear"></div>
	
<?php	
	
	endif;
	$post = $orig_post;
	wp_reset_query();
	endif;
		
 ?>