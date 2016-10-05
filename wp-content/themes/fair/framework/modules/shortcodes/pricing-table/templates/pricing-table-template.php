<div <?php fair_edge_class_attribute($pricing_table_classes)?>>
	<div class="edgtf-price-table-inner">
		<ul>
			<li class="edgtf-table-title" <?php fair_edge_inline_style($active_style); ?>>
				<h6 class="edgtf-title-content"><?php echo esc_html($title) ?></h6>
				<?php if($active == 'yes'){ ?>
					<div class="edgtf-active-text">
						<span class="edgtf-active-text-inner">
							<?php echo esc_attr($active_text) ?>
						</span>
					</div>
				<?php } ?>
			</li>
			<li class="edgtf-table-prices">
				<div class="edgtf-price-in-table">
					<span class="edgtf-price-holder">
						<sup class="edgtf-value"><?php echo esc_attr($currency) ?></sup>
						<span class="edgtf-price"><?php echo esc_attr($price)?></span>
					</span>
					<span class="edgtf-mark"><?php echo esc_attr($price_period)?></span>
				</div>	
			</li>
			<li class="edgtf-table-content">
				<?php
					echo do_shortcode($content);
				?>
			</li>
			<?php 
			if($show_button == "yes" && $button_text !== ''){ ?>
				<li class="edgtf-price-button">
					<?php echo fair_edge_get_button_html(array(
						'link' => $link,
						'text' => $button_text
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>