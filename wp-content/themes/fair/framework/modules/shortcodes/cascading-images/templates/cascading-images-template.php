<div class="edgtf-cascading-images-holder-outer">
	<div class="edgtf-cascading-images">
		<div class="edgtf-cascading-images-laptop" data-150-bottom="right:-40%" data-120-center="right:0%">
			<img class="edgtf-laptop-frame" src="<?php echo EDGE_ASSETS_ROOT ?>/css/img/cascading_images_laptop.png" alt="cascading images" />
			<div class="edgtf-laptop-image">
				<?php if ($laptop_image_link != '') { ?>
					<a href="<?php echo esc_url($laptop_image_link); ?>" target="<?php echo esc_attr($laptop_image_target) ?>"></a>
				<?php } if ($laptop_image != '') { ?>
					<div class="edgtf-bgrnd" style="background-image:url(<?php echo wp_get_attachment_url($laptop_image); ?>);"></div>
				<?php }  ?>
			</div>
		</div>
		<div class="edgtf-cascading-images-tablet" data-150-bottom="right:0%" data-200-center="right:85%">
			<img class="edgtf-tablet-frame" src="<?php echo EDGE_ASSETS_ROOT ?>/css/img/cascading_images_tablet.png" alt="cascading images" />
			<div class="edgtf-tablet-image">
				<?php if ($tablet_image_link != '') { ?>
					<a href="<?php echo esc_url($tablet_image_link); ?>" target="<?php echo esc_attr($tablet_image_target) ?>"></a>
				<?php } if ($tablet_image != '') { ?>
					<div class="edgtf-bgrnd" style="background-image:url(<?php echo wp_get_attachment_url($tablet_image); ?>);"></div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>