<div class="edgtf-elements-holder-item <?php echo esc_attr($elements_holder_item_class); ?>" <?php echo fair_edge_get_inline_attrs($elements_holder_item_data); ?> <?php echo fair_edge_get_inline_style($elements_holder_item_style); ?>>
	<?php if($rounded_tab == 'yes' && $rounded_tab_position == 'left') { ?>
		<svg class="edgtf-elements-rounded-tab edgtf-elements-rounded-tab-left <?php echo esc_attr($rounded_tab_class); ?>" x="0px" y="0px" width="35.996px" height="134.984px" viewBox="49.493 -49.494 35.996 134.984" <?php echo fair_edge_get_inline_style($elements_holder_item_rounded_tab_style); ?>>
			<path d="M85.489,85.493c0-19.161,0-67.491,0-67.491s0-48.332,0-67.494 c0,41.959-35.996,39.959-35.996,67.493C49.493,45.536,85.489,43.536,85.489,85.493z"/>
		</svg>
	<?php } ?>
	<div class="edgtf-elements-holder-item-inner">
		<div class="edgtf-elements-holder-item-content <?php echo esc_attr($elements_holder_item_content_class); ?>" <?php echo fair_edge_get_inline_style($elements_holder_item_content_style); ?>>
			<?php if(count($elements_holder_item_content_responsive) > 0){ ?>
			<style type="text/css" data-type="edgtf-elements-custom-padding" scoped="scoped">

				<?php if(isset($elements_holder_item_content_responsive['item_padding_1280_1440']) && $elements_holder_item_content_responsive['item_padding_1280_1440'] !== ''){ ?>
					@media only screen and (min-width: 1280px) and (max-width: 1440px) {
						.edgtf-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
							padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_1280_1440']); ?> !important;
						}
					}
				<?php } ?>
				<?php if(isset($elements_holder_item_content_responsive['item_padding_1024_1280']) && $elements_holder_item_content_responsive['item_padding_1024_1280'] !== ''){ ?>
					@media only screen and (min-width: 1024px) and (max-width: 1280px) {
						.edgtf-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
							padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_1024_1280']); ?> !important;
						}
					}
				<?php } ?>
				<?php if(isset($elements_holder_item_content_responsive['item_padding_768_1024']) && $elements_holder_item_content_responsive['item_padding_768_1024'] !== ''){ ?>
				@media only screen and (min-width: 768px) and (max-width: 1024px) {
					.edgtf-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
						padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_768_1024']); ?> !important;
					}
				}
				<?php } ?>
				<?php if(isset($elements_holder_item_content_responsive['item_padding_600_768']) && $elements_holder_item_content_responsive['item_padding_600_768'] !== ''){ ?>
				@media only screen and (min-width: 600px) and (max-width: 768px) {
					.edgtf-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
						padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_600_768']); ?> !important;
					}
				}
				<?php } ?>
				<?php if(isset($elements_holder_item_content_responsive['item_padding_480_600']) && $elements_holder_item_content_responsive['item_padding_480_600'] !== ''){ ?>
				@media only screen and (min-width: 480px) and (max-width: 600px) {
					.edgtf-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
						padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_480_600']); ?> !important;
					}
				}
				<?php } ?>
				<?php if(isset($elements_holder_item_content_responsive['item_padding_480']) && $elements_holder_item_content_responsive['item_padding_480'] !== ''){ ?>
					@media only screen and (max-width: 480px) {
						.edgtf-elements-holder-item-content.<?php echo esc_attr($elements_holder_item_content_class); ?> {
							padding: <?php echo esc_attr($elements_holder_item_content_responsive['item_padding_480']); ?> !important;
						}
					}
				<?php } ?>

			</style>
			<?php } ?>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
	<?php if($rounded_tab == 'yes' && $rounded_tab_position == 'right') { ?>
		<svg class="edgtf-elements-rounded-tab edgtf-elements-rounded-tab-right <?php echo esc_attr($rounded_tab_class); ?>" x="0px" y="0px" width="35.996px" height="134.984px" viewBox="49.493 -49.494 35.996 134.984" <?php echo fair_edge_get_inline_style($elements_holder_item_rounded_tab_style); ?>>
			<path d="M49.493-49.494c0,19.161,0,67.49,0,67.49s0,48.332,0,67.494 c0-41.959,35.996-39.959,35.996-67.493C85.489-9.537,49.493-7.537,49.493-49.494z"/>
		</svg>
	<?php } ?>
</div>