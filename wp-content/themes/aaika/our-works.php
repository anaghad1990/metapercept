<?php
/**
 * (c) www.king-theme.com
 * Pack tmpl
 * PLEASE DO NOT CHANGE THIS FILE
*/


global $post;

$image = devn::get_featured_image( $post );
$link =  "//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$escaped_link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
$cates = get_the_category_list( ' ' );
$link = get_post_meta( $post->ID, 'devn_work' );

?>

<div class="content_fullwidth lessmar">
	<div class="portfolio_area">
		<div class="portfolio_area_left animated fadeInLeft imgframe5">
			<img src="<?php echo esc_url( $image ); ?>" alt="" />
		</div>
		<div class="portfolio_area_right animated eff-fadeInRight delay-200ms">
			<h4>
				<?php _e( 'Project Description', 'aaikadomain' ); ?>
			</h4>
			<p class="work-des">
				<?php print( $post->post_content ); ?></p>
			<a href="javascript:void(0)" onclick="jQuery('.work-des').css({'max-height':'none'});jQuery(this).remove();" class="addto_favorites">
				<i class="fa fa-chevron-down">
				</i>
				Show More
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
					Project Details
				</h5>
				<span>
					<strong>
						Name
					</strong>
					<em>
						<?php the_title(); ?></em>
				</span>
				<span>
					<strong>
						Date
					</strong>
					<em>
						<?php echo get_the_time('m D Y',$post); ?></em>
				</span>
				<span>
					<strong>
						Categories
					</strong>
					<em>
						<?php print( $cates ); ?>
					</em>
				</span>
				<span>
					<strong>
						Author
					</strong>
					<em>
						<?php echo the_author_meta( 'display_name' , $post->post_author); ?>
					</em>
				</span>
				<div class="clearfix margin_top5">
				</div>
				<a href="<?php echo esc_url( $link[0] ); ?>" class="but_goback globalBgColor">
					<i class="fa fa-hand-o-right fa-lg">
					</i>
					Visit Site
				</a>
			</div>
		</div>
	</div>
	<!-- end section -->
</div>
<div class="clearfix margin_top5">
</div>

		