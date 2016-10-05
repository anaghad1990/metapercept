<?php
/**
 * Counter shortcode template
 */
?>
<div class="edgtf-counter-holder <?php echo esc_attr($position); ?>" <?php echo fair_edge_get_inline_style($counter_holder_styles); ?>>

	<span class="edgtf-counter <?php echo esc_attr($type) ?>" <?php echo fair_edge_get_inline_style($counter_styles); ?>>
		<?php echo esc_attr($digit); ?>
	</span>
	<?php if($title != '') { ?>
		<<?php echo esc_html($title_tag); ?> class="edgtf-counter-title" <?php echo fair_edge_get_inline_style($title_styles); ?>>
			<?php echo esc_attr($title); ?>
		</<?php echo esc_html($title_tag);; ?>>
	<?php } ?>
	<?php if ($text != "") { ?>
		<p class="edgtf-counter-text" <?php echo fair_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
	<?php } ?>

</div>