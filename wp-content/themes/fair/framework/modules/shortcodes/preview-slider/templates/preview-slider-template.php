<div <?php fair_edge_class_attribute($slider_classes) ?> <?php echo fair_edge_get_inline_attrs($slider_data); ?>>
	<?php if($devices_position == 'right') { ?>
		<div class="edgtf-ps-text-holder">
			<div class="edgtf-ps-text-slider-holder">
				<?php echo do_shortcode($content); ?>
			</div>
		</div>
	<?php } ?>
	<div class="edgtf-ps-images-holder">
		<div class="edgtf-ps-images-holder-inner">
			<div class="edgtf-ps-laptop-holder">
				<img src="<?php echo EDGE_ASSETS_ROOT .'/img/preview-slider-monitor.png' ?>" class="edgtf-ps-laptop-frame" alt="<?php esc_attr_e('monitor','fair');?>"/>
				<div class="edgtf-ps-laptop-slider">
					<div class="edgtf-ps-laptop-images edgtf-preview-slider-element">
						<?php
							$i = 0;
							foreach($laptop_images as $laptop_image){ ?>
						<?php if(array_key_exists($i, $slider_links)){ ?>
							<div class="edgtf-ps-laptop-image"><a href="<?php echo esc_url($slider_links[$i]); ?>" target="<?php echo esc_attr($slider_targets[$i]); ?>"><?php echo wp_get_attachment_image($laptop_image,'full'); ?></a></div>
						<?php } else { ?>
							<div class="edgtf-ps-laptop-image"><?php echo wp_get_attachment_image($laptop_image,'full'); ?></div>
						<?php } ?>
							<?php $i++; } ?>
					</div>
				</div>
			</div>
			<div class="edgtf-ps-tablet-holder">
				<img src="<?php echo EDGE_ASSETS_ROOT .'/img/preview-slider-tablet.png' ?>" class="edgtf-ps-tablet-frame"  alt="<?php esc_attr_e('tablet','fair');?>"/>
				<div class="edgtf-ps-tablet-slider">
						<div class="edgtf-ps-tablet-images  edgtf-preview-slider-element">
							<?php
							$j = 0;
							foreach($tablet_images as $tablet_image){ ?>
								<div class="edgtf-ps-tablet-image">
									<?php if(array_key_exists($j, $slider_links)){ ?>
										<a href="<?php echo esc_url($slider_links[$j]); ?>" target="<?php echo esc_attr($slider_targets[$j]); ?>">
											<?php echo wp_get_attachment_image($tablet_image,'full'); ?>
										</a>
									<?php } else { ?>
										<?php echo wp_get_attachment_image($tablet_image,'full'); ?>
									<?php } ?>
								</div>
							<?php $j++; } ?>
						</div>
				</div>
			</div>
			<div class="edgtf-ps-mobile-holder">
				<img src="<?php echo EDGE_ASSETS_ROOT .'/img/preview-slider-phone.png' ?>" class="edgtf-ps-phone-frame"  alt="<?php esc_attr_e('phone','fair');?>"/>
				<div class="edgtf-ps-mobile-slider">
					<div class="edgtf-ps-mobile-images  edgtf-preview-slider-element">
						<?php
						$k = 0;
						foreach($mobile_images as $mobile_image){ ?>
							<?php if(array_key_exists($k, $slider_links)){ ?>
								<div class="edgtf-ps-mobile-image"><a href="<?php echo esc_url($slider_links[$k]); ?>" target="<?php echo esc_attr($slider_targets[$k]); ?>"><?php echo wp_get_attachment_image($mobile_image,'full'); ?></a></div>
							<?php } else { ?>
								<div class="edgtf-ps-mobile-image"><?php echo wp_get_attachment_image($mobile_image,'full'); ?></div>
							<?php } ?>
							<?php $k++; } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if($devices_position != 'right') { ?>
		<div class="edgtf-ps-text-holder">
			<div class="edgtf-ps-text-slider-holder">
				<?php echo do_shortcode($content); ?>
			</div>
		</div>
	<?php } ?>
</div>