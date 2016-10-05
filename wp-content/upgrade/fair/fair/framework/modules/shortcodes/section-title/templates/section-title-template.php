<?php
/**
 * Dropcaps shortcode template
 */
?>

<<?php echo esc_attr($title_tag); ?> class="edgtf-section-title" <?php fair_edge_inline_style($title_style);?>>
	<?php if ($link !== '') { ?>
		<a href="<?php echo esc_url($link);?>" target="<?php echo esc_attr($link_target);?>">
	<?php } ?>
	<?php echo wp_kses_post($title_italicized);?>
	<?php if ($link !== '') { ?>
		</a>
	<?php } ?>
</<?php echo esc_attr($title_tag); ?>>