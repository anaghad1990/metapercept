<div class="edgtf-numbered-box <?php echo esc_attr($content_class);?>" <?php fair_edge_inline_style($content_style);?>>
	<div class="edgtf-numbered-box-inner">
		<?php if ($subtitle !== '') { ?>
			<h5 class="edgtf-numbered-subtitle" <?php fair_edge_inline_style($subtitle_style);?>>
				<?php echo esc_html($subtitle);?>
			</h5>
		<?php } ?>
		<?php if ($title !== '') { ?>
			<<?php echo esc_attr($title_tag);?> class="edgtf-numbered-title" <?php fair_edge_inline_style($title_style);?>>
				<?php echo esc_html($title);?>
			</<?php echo esc_attr($title_tag);?>>
		<?php } ?>
		<?php
			if (is_array($separator_params) && count($separator_params)){
				echo fair_edge_execute_shortcode('edgtf_separator', $separator_params);
			}
		?>
		<?php if ($text !== '') { ?>
			<p class="edgtf-numbered-text" <?php fair_edge_inline_style($text_style);?>>
				<?php echo esc_html($text);?>
			</p>
		<?php } ?>
	</div>
	<?php if ($link !== '') { ?>
		<a class="edgtf-numbered-link" href="<?php echo esc_url($link);?>" target="<?php echo esc_attr($link_target);?>"></a>
	<?php } ?>
	<?php if ($number !== '') { ?>
		<div class="edgtf-numbered-box-number" <?php fair_edge_inline_style($number_style);?>>
			<?php echo esc_attr($number); ?>
		</div>
	<?php } ?>
	<div class="edgtf-numbered-bgrnd" <?php fair_edge_inline_style($background_style);?>></div>
</div>