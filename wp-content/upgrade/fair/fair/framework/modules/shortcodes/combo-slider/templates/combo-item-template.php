<div class="edgtf-combo-slide">
	<div class="edgtf-combo-slide-table">
		<div class="edgtf-combo-slide-content" <?php fair_edge_inline_style($content_style);?>>
			<div class="edgtf-combo-slide-content-inner">
				<?php if ($title !== '') { ?>
					<<?php echo esc_attr($title_tag);?> class="edgtf-combo-title">
						<?php echo esc_html($title); ?>
					</<?php echo esc_attr($title_tag);?>>
				<?php } ?>
				<?php if ($separator == 'yes') {
					echo fair_edge_execute_shortcode('edgtf_separator',array());
				} ?>
				<?php if ($text !== '') { ?>
					<p class="edgtf-combo-slide-text">
						<?php echo esc_html($text);?>
					</p>
				<?php } ?>
			</div>
		</div>
		<div class="edgtf-combo-slide-images">
			<?php if($image_link != '') { ?>
				<a href="<?php echo esc_url($image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
			<?php } ?>
					<?php echo wp_get_attachment_image($image, $image_size, false, array( 'class' => 'edgtf-hero-image' )); ?>
			<?php if($image_link != '') { ?>
				</a>
			<?php } ?>

			<?php if($aux_image_link != '') { ?>
				<a href="<?php echo esc_url($aux_image_link); ?>" target="<?php echo esc_attr($link_target); ?>">
			<?php } ?>
					<?php echo wp_get_attachment_image($aux_image, $image_size, false, array( 'class' => 'edgtf-aux-image' )); ?>
			<?php if($aux_image_link != '') { ?>
				</a>
			<?php } ?>
		</div>
	</div>
</div>