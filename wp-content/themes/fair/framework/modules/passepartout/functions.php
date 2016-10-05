<?php

if(!function_exists('fair_edge_passepartout_enabled')) {
	/**
	 * Checks if passepartout is enabled
	 *
	 * @return bool
	 */
	function fair_edge_passepartout_enabled() {

		return fair_edge_get_meta_field_intersect('passepartout') == 'yes';
	}
}

if(!function_exists('fair_edge_passepartout_class')) {
	/**
	 * Adds overlapping content class to body tag
	 * if overlapping content is enabled
	 * @param $classes
	 *
	 * @return array
	 */
	function fair_edge_passepartout_class($classes) {

		if(fair_edge_passepartout_enabled()) {
			$classes[] = 'edgtf-passepartout';
		}


		return $classes;
	}

	add_filter('body_class', 'fair_edge_passepartout_class');
}

if(!function_exists('fair_edge_passepartout_per_page_js_var')) {
	function fair_edge_passepartout_per_page_js_var($perPageVars) {


		if(fair_edge_passepartout_enabled()) {
			$perPageVars['edgtfPassepartout'] = 25;
		} else {
			$perPageVars['edgtfPassepartout'] = 0;
		}

		return $perPageVars;
	}

	add_filter('fair_edge_per_page_js_vars', 'fair_edge_passepartout_per_page_js_var');
}

if( !function_exists('fair_edge_page_passepartout_style') ) {

	/**
	 * Function that return container style
	 */

	function fair_edge_page_passepartout_style( $style ) {

		$id = fair_edge_get_page_id();
		$class_prefix = fair_edge_get_unique_page_class();

		$page_selector = array(
			$class_prefix . '.edgtf-passepartout .edgtf-passepartout-left',
			$class_prefix . '.edgtf-passepartout .edgtf-passepartout-right',
			$class_prefix . '.edgtf-passepartout .edgtf-passepartout-bottom',
			$class_prefix . '.edgtf-passepartout .edgtf-passepartout-top'
		);
		$page_css = array();

		$page_passepartout_color 				= get_post_meta($id, 'edgtf_passepartout_color_meta', true);


		if($page_passepartout_color !== ''){
			$page_css['background-color'] = $page_passepartout_color;
		}


		$current_style = fair_edge_dynamic_css($page_selector, $page_css);

		$style[]       = $current_style;

		return $style;

	}
	add_filter('fair_edge_add_page_custom_style', 'fair_edge_page_passepartout_style');
}