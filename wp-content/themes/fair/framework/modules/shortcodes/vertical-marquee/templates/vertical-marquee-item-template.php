<div class="edgtf-vm-r-text-container">
	<div class="edgtf-vm-monitor">
		<img src="<?php echo EDGE_ASSETS_ROOT.'/img/marquee-monitor.png'; ?>" alt="">
		<div class="edgtf-vm-monitor-screen">
			<div class="edgtf-vm-slide"><?php echo wp_get_attachment_image($image, 'full') ?></div>
			</div>
		</div>
	<div class="edgtf-vm-r-text">
		<?php echo do_shortcode($content) ?>
	</div>
</div>