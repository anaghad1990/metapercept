<?php

if(!function_exists('fair_edge_passepartout_opening_tag')) {
	/**
	 * Prints opening HTML tags for passepartou
	 * Hooks to fair_edge_after_wrapper_open
	 */
	function fair_edge_passepartout_opening_tag() {

		if(fair_edge_passepartout_enabled()) : ?>
			<div class="edgtf-passepartout-top"></div>
			<div class="edgtf-passepartout-left"></div>
			<div class="edgtf-passepartout-right"></div>
			<div class="edgtf-passepartout-bottom"></div>
		<?php endif;
	}

	add_action('fair_edge_after_wrapper_open', 'fair_edge_passepartout_opening_tag');
}