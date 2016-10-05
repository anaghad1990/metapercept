<?php
/**
 * (c) king-theme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $devn, $post;

$image = $devn->get_featured_image( $post );
$link =  "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$escaped_link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');

get_header();

?>


<?php $devn->breadcrumb(); ?>

<div id="primary" class="site-content container-content content ">
	<div id="content" class="row row-content container">
		<div class="lessmar">
			<div class="portfolio_area">
				<div class="portfolio_area_left">
					<div class="animated fadeInLeft">
						<div id="portfolio-large-preview">
							<img src="<?php echo esc_url( $image ); ?>" alt="" />
						</div>	
					</div>
					<?php

						preg_match_all('/(?<=src=")[^"]+(?=")/', $post->post_content, $srcs, PREG_PATTERN_ORDER);
						
						if( !empty( $srcs ) ){
							if( !empty( $srcs[0] ) ){
								$srcs = $srcs[0];
								echo '<div class="portfolio_thumbnails">';
								foreach( $srcs as $src ){
									
									$ex = explode( '-', $src );
									if( count( $ex ) > 1 ){
										if(strpos($ex[count( $ex )-1],'x')!==false&&strpos($ex[count($ex)-1],'.')!==false){
											$ex[count( $ex )-1] = substr( $ex[count( $ex )-1], strpos($ex[count($ex)-1],'.') );
										}
										$src = str_replace( '-.', '.', implode( '-', $ex ) );
									}
									
									echo '<a href="'.esc_url($src).'" target=_blank>loading</a>';
								}
								echo '</div>';
							}
						}
						
					?>	
				</div>
				<div class="portfolio_area_right animated eff-fadeInRight delay-200ms">
					<h4>
						<?php echo esc_html($post->post_title); ?>
					</h4>
					<p class="work-des">
						<?php echo strip_tags( $post->post_content ); ?></p>
					<a href="javascript:void(0)" onclick="jQuery('.work-des').css({'max-height':'none'});jQuery(this).remove();" class="addto_favorites">
						<i class="fa fa-chevron-down"></i>
						<?php _e('Show More', DEVN_DOMAIN ); ?>
					</a>
					<ul class="small_social_links">
						<li>
							<a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u='.$escaped_link ); ?>">
								<i class="fa fa-facebook">
								</i>
							</a>
						</li>
						<li>
							<a href="<?php echo esc_url( 'https://twitter.com/home?status='.$escaped_link ); ?>">
								<i class="fa fa-twitter">
								</i>
							</a>
						</li>
						<li>
							<a href="<?php echo esc_url( 'https://plus.google.com/share?url='.$escaped_link ); ?>">
								<i class="fa fa-google-plus">
								</i>
							</a>
						</li>
						<li>
							<a href="<?php echo esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source='.$escaped_link ); ?>">
								<i class="fa fa-linkedin">
								</i>
							</a>
						</li>
						<li>
							<a href="<?php echo esc_url( 'https://pinterest.com/pin/create/button/?url=&media=&description='.$escaped_link ); ?>">
								<i class="fa fa-pinterest">
								</i>
							</a>
						</li>
					</ul>
					<div class="project_details animated eff-fadeInUp delay-500ms">
						<h5>
							<?php _e('Project Details', DEVN_DOMAIN ); ?>
						</h5>
						<span>
							<strong>
								<?php _e('Name', DEVN_DOMAIN ); ?>
							</strong>
							<em>
								<?php the_title(); ?></em>
						</span>
						<span>
							<strong>
								<?php _e('Date', DEVN_DOMAIN ); ?>
							</strong>
							<em>
								<?php echo get_the_time('m D Y',$post); ?></em>
						</span>
						<span>
							<strong>
								<?php _e('Categories', DEVN_DOMAIN ); ?>
							</strong>
							<em>
								<?php
									echo get_the_category_list( ' ' );
								?>
							</em>
						</span>
						<span>
							<strong>
								<?php _e('Author', DEVN_DOMAIN ); ?>
							</strong>
							<em>
								<?php echo the_author_meta( 'display_name' , $post->post_author); ?>
							</em>
						</span>
						<div class="clearfix margin_top5">
						</div>
						<a href="<?php echo esc_url( get_post_meta( $post->ID, 'devn_work', true ) ); ?>" class="but_goback globalBgColor">
							<i class="fa fa-hand-o-right fa-lg">
							</i>
							<?php _e('Visit Site', DEVN_DOMAIN ); ?>
						</a>
					</div>
				</div>
			</div>
			<!-- end section -->
		</div>
		<div class="clearfix margin_top5"></div>
	</div>
</div>	
<script type="text/javascript">
(function($){
	$(window).load(function() {
		$('.portfolio_thumbnails a').each(function(){
			var obj = this;
			var img = new Image();
			img.onload = function(){
				$(obj).html('').append( this ).click(function(e){
					var new_src = $(this).attr('href');
					$('#portfolio-large-preview img').animate({'opacity':0.1},150,function(){
						$('#portfolio-large-preview img').attr({ 'src' : new_src }).css({ 'opacity' : 0 }).animate({ 'opacity' : 1 });
					});
					e.preventDefault();
				});
			}
			img.src = $(this).attr('href');
		});
	});
})(jQuery);	
</script>
<?php get_footer(); ?>	