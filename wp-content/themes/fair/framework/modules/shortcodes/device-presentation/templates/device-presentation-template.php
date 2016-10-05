<div class="edgtf-device-presentation-holder">
	<div class="edgtf-device-presentation <?php echo esc_attr($shortcode_classes); ?>" <?php fair_edge_inline_style($shortcode_style); ?> <?php echo fair_edge_get_inline_attrs($shortcode_data); ?>>
		<?php if ($background_image != '') { ?>
			<div class="edgtf-background-images-holder" style="background-image:url(<?php echo wp_get_attachment_url($background_image); ?>)">
				<img class="edgtf-device-background-image" src="<?php echo wp_get_attachment_url($background_image); ?>" alt="device presentation background" />
				<?php if($infinite_scroll_effect) { ?>
					<img class="edgtf-device-background-image edgtf-aux-background-image" src="<?php echo wp_get_attachment_url($background_image); ?>" alt="device presentation background" />
				<?php } ?>
			</div>
		<?php } ?>
		<div class="edgtf-device-presentation-content" <?php fair_edge_inline_style($content_style); ?>>
			<div class="edgtf-device-presentation-text-holder">
				<div class="edgtf-device-presentation-title-holder">
					<h2 class="edgtf-device-presentation-title" <?php fair_edge_inline_style($title_style);?>>
						<?php echo wp_kses_post($title_italicized);?>
					</h2>
				</div>
				<div class="edgtf-device-presentation-description-holder">
					<p class="edgtf-device-presentation-description" <?php fair_edge_inline_style($description_style); ?>>
						<?php echo esc_attr($description); ?>
					</p>
				</div>
			</div>
			<div class="edgtf-devices-holder">
				<div class="edgtf-desktop-holder">
					<img class="edgtf-desktop-frame" src="<?php echo EDGE_ASSETS_ROOT ?>/css/img/device_presentation_desktop.png" alt="desktop frame" />
					<div class="edgtf-desktop-image">
						<?php if ($desktop_image_link != '') { ?>
							<a href="<?php echo esc_url($desktop_image_link); ?>" target="<?php echo esc_attr($desktop_image_target) ?>"></a>
						<?php } ?>
						<div class="edgtf-bgrnd" style="background-image:url(<?php echo wp_get_attachment_url($desktop_image); ?>);"></div>
					</div>
				</div>
				<div class="edgtf-laptop-holder">
					<img class="edgtf-laptop-frame" src="<?php echo EDGE_ASSETS_ROOT ?>/css/img/device_presentation_laptop.png" alt="laptop frame" />
					<div class="edgtf-laptop-image">
						<?php if ($laptop_image_link != '') { ?>
							<a href="<?php echo esc_url($laptop_image_link); ?>" target="<?php echo esc_attr($laptop_image_target) ?>"></a>
						<?php } ?>
						<div class="edgtf-bgrnd" style="background-image:url(<?php echo wp_get_attachment_url($laptop_image); ?>);"></div>
					</div>
				</div>
				<div class="edgtf-tablet-holder">
					<img class="edgtf-tablet-frame" src="<?php echo EDGE_ASSETS_ROOT ?>/css/img/device_presentation_tablet.png" alt="tablet frame" />
					<div class="edgtf-tablet-image">
						<?php if ($tablet_image_link != '') { ?>
							<a href="<?php echo esc_url($tablet_image_link); ?>" target="<?php echo esc_attr($tablet_image_target) ?>"></a>
						<?php } ?>
						<div class="edgtf-bgrnd" style="background-image:url(<?php echo wp_get_attachment_url($tablet_image); ?>);"></div>
					</div>
				</div>
				<div class="edgtf-phone-holder">
					<img class="edgtf-phone-frame" src="<?php echo EDGE_ASSETS_ROOT ?>/css/img/device_presentation_phone.png" alt="phone frame" />
					<div class="edgtf-phone-image">
						<?php if ($phone_image_link != '') { ?>
							<a href="<?php echo esc_url($phone_image_link); ?>" target="<?php echo esc_attr($phone_image_target) ?>"></a>
						<?php } ?>
						<div class="edgtf-bgrnd" style="background-image:url(<?php echo wp_get_attachment_url($phone_image); ?>);"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>