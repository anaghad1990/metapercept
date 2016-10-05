<?php get_header(); ?>

	<div class="edgtf-container">
	<?php do_action('fair_edge_after_container_open'); ?>
		<div class="edgtf-container-inner edgtf-404-page">
			<div class="edgtf-page-not-found">
				<span class="edgtf-number-holder">
					<?php if(fair_edge_options()->getOptionValue('404_title')){
						echo esc_html(fair_edge_options()->getOptionValue('404_title'));
					}
					else{
						esc_html_e('404', 'fair');
					} ?>
				</span>
				<?php echo fair_edge_get_separator_html(array('position'=>'center')); ?>
				<h5>
					<?php if(fair_edge_options()->getOptionValue('404_title')){
						echo esc_html(fair_edge_options()->getOptionValue('404_title'));
					}
					else{
						esc_html_e('Page you are looking is not found', 'fair');
					} ?>
				</h5>       
				<p>
					<?php if(fair_edge_options()->getOptionValue('404_text')){
						echo esc_html(fair_edge_options()->getOptionValue('404_text'));
					}
					else{
						esc_html_e('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'fair');
					} ?>
				</p>
				<?php
					$params = array();
					if (fair_edge_options()->getOptionValue('404_back_to_home')){
						$params['text'] = fair_edge_options()->getOptionValue('404_back_to_home');
					}
					else{
						$params['text'] = esc_html__('Homepage', 'fair');
					}
					$params['link'] = esc_url(home_url('/'));
					$params['target'] = '_self';
					$params['type'] = 'solid';
				echo fair_edge_execute_shortcode('edgtf_button',$params);?>
			</div>
		</div>
		<?php do_action('fair_edge_before_container_close'); ?>
	</div>
<?php get_footer(); ?>