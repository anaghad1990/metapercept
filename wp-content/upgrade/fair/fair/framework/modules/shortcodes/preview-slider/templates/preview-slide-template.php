<div class="edgtf-ps-text-slider">
	<?php if ($subtitle !== '') { ?>
		<h5 class="edgtf-ps-subtitle">
			<?php echo esc_html($subtitle);?>
		</h5>
	<?php } ?>
	<?php if ($title !== '') { echo fair_edge_get_section_title_html(array('italicized_words'=>'2', 'title'=> $title)); } ?>
	<?php
		echo fair_edge_execute_shortcode('edgtf_separator', array('position' => 'left'));
	?>
	<?php if ($text !== '') { ?>
		<p class="edgtf-ps-text">
			<?php echo esc_html($text);?>
		</p>
	<?php } ?>
</div>