<?php // This line is needed for mixItUp gutter ?>

<article <?php edge_cpt_class_attribute($classes);?>>
	<a class ="edgtf-portfolio-link" href="<?php echo esc_url($item_link); ?>"></a>
	<div class = "edgtf-item-image-holder">
	<?php
		echo get_the_post_thumbnail(get_the_ID(),$thumb_size);
	?>				
	</div>
	<div class="edgtf-item-text-overlay">
		<div class="edgtf-item-text-overlay-inner">
			<div class="edgtf-item-text-holder">
				<<?php echo esc_attr($title_tag)?> class="edgtf-item-title">
					<?php echo esc_attr(get_the_title()); ?>
				</<?php echo esc_attr($title_tag)?>>
				<?php 
				if ($hover_type == 'launch') {
					echo fair_edge_get_separator_html(array('position' => 'center'));
					?>
					<div class="edgtf-portfolio-link-holder">
						<a class="edgtf-portfolio-link-launch" href="<?php echo esc_url($item_link); ?>" target="_blank">
							<span><?php esc_html_e('Launch','fair'); ?></span>
						</a>
						<?php if ($pop_up == 'yes') { ?>
							<a class ="edgtf-portfolio-link-popup" href="#">
								<span><?php esc_html_e('Preview','fair')?></span>
							</a>
						<?php } ?>
					</div>
				<?php }
				else{
					echo $category_html;
				}
				?>
			</div>
		</div>
	</div>
	<?php if ($hover_type == 'rounded') { ?>
		<svg class="edgtf-rounded-tab" x="0px" y="0px" width="134.983px" height="35.995px" <?php edge_cpt_inline_style($rounded_tab_style);?> viewBox="0 0 134.983 35.995" xml:space="preserve">
			<path d="M67.492,0C39.958,0,41.958,35.995,0,35.995c19.162,0,67.492,0,67.492,0s48.33,0,67.491,0	C93.026,35.995,95.026,0,67.492,0z"/>
		</svg>
	<?php } ?>
	<?php if ($hover_type == 'launch' && $pop_up == 'yes') { ?>
		<div class="edgtf-popup-content">
			<div class="edgtf-ptf-popup-launch">
				<a class ="edgtf-portfolio-popup-link" href="<?php echo esc_url($item_link); ?>" target="_blank">
					<?php esc_html_e('Launch','fair'); ?>
				</a>
			</div>
			<div class="edgtf-popup-image">
				<?php
				if (is_array($portfolio_gallery) && count($portfolio_gallery)) {
					$image = $portfolio_gallery[0];
					?>
					<a class ="edgtf-portfolio-popup-link" href="<?php echo esc_url($item_link); ?>" target="_blank">
						<img src="<?php echo esc_url($image['image_url']); ?>" alt="<?php echo esc_attr($image['description']); ?>" />
					</a>
				<?php }
				?>
			</div>
		</div>
	<?php } ?>
</article>

<?php // This line is needed for mixItUp gutter ?>