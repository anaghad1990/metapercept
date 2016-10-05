<div class="edgtf-message  <?php echo esc_attr($message_classes)?>" <?php echo fair_edge_get_inline_style($message_styles); ?>>
	<div class="edgtf-message-inner">
		<?php		
		if($type == 'with_icon'){
			$icon_html = fair_edge_get_shortcode_module_template_part('templates/' . $type, 'message', '', $params);
			print $icon_html;
		}
		?>
		<a href="javascript:void(0)" class="edgtf-close" <?php fair_edge_inline_style($close_icon_holder_style); ?>><i class="edgtf-font-elegant-icon icon_close" <?php fair_edge_inline_style($close_icon_style); ?>></i></a>
		<div class="edgtf-message-text-holder">
			<div class="edgtf-message-text">
				<div class="edgtf-message-text-inner"><?php echo do_shortcode($content); ?></div>
			</div>
		</div>
	</div>
</div>