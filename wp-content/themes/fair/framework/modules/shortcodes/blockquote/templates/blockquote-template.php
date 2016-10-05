<?php
/**
 * Blockquote shortcode template
 */
?>

<blockquote class="edgtf-blockquote-shortcode" <?php fair_edge_inline_style($blockquote_style); ?> >
	<span class="edgtf-quotations-holder">&rdquo;</span>
	<div class="edgtf-blockquote-text">
		<span><?php echo esc_attr($text); ?></span>
	</div>
</blockquote>