<?php $sidebar = fair_edge_sidebar_layout(); ?>
<?php get_header(); ?>
<?php 

$blog_page_range = fair_edge_get_blog_page_range();
$max_number_of_pages = fair_edge_get_max_number_of_pages();

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }
?>
<?php fair_edge_get_title(); ?>
	<div class="edgtf-container">
		<?php do_action('fair_edge_after_container_open'); ?>
		<div class="edgtf-container-inner clearfix">
			<div class="edgtf-container">
				<?php do_action('fair_edge_after_container_open'); ?>
				<div class="edgtf-container-inner" >
					<div class="edgtf-blog-holder edgtf-blog-type-standard edgtf-search-page">
				<?php if(have_posts()) : while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="edgtf-post-content">
							<div class="edgtf-post-text">
								<div class="edgtf-post-text-inner">
									<h4>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
									</h4>
									<?php echo fair_edge_get_separator_html(array('position'=>'left'))?>
									<?php $my_excerpt = get_the_excerpt();
									if ($my_excerpt != '') { ?>
										<p class="edgtf-post-excerpt"><?php echo esc_html($my_excerpt); ?></p>
									<?php } ?>
									<?php
										echo fair_edge_get_button_html(array(
											'size'         => 'medium',
											'type'         => 'outline',
											'link'         => get_the_permalink(),
											'text'         => esc_html__('Read More', 'fair')
										));
									?>
								</div>
							</div>
						</div>
					</article>
					<?php endwhile; ?>
					<?php else: ?>
					<div class="entry">
						<p><?php esc_html_e('No posts were found.', 'fair'); ?></p>
					</div>
					<?php endif; ?>
				</div>
				<?php do_action('fair_edge_before_container_close'); ?>
			</div>
			</div>
		</div>
		<?php do_action('fair_edge_before_container_close'); ?>
	</div>
	<div class="edgtf-container edgtf-container-bottom-navigation">
		<div class="edgtf-container-inner">
			<?php
			if(fair_edge_options()->getOptionValue('pagination') == 'yes') {
				fair_edge_pagination($max_number_of_pages, $blog_page_range, $paged);
			}
			?>
		</div>
	</div>
	<?php do_action('fair_edge_after_container_close'); ?>
<?php get_footer(); ?>