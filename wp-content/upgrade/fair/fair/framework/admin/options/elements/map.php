<?php

if ( ! function_exists('fair_edge_load_elements_map') ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function fair_edge_load_elements_map() {

		fair_edge_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => 'Elements',
				'icon' => 'fa fa-flag-o'
			)
		);

		do_action( 'fair_edge_options_elements_map' );

	}

	add_action('fair_edge_options_map', 'fair_edge_load_elements_map', 11);

}