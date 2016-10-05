<?php

if( !function_exists('fair_edge_search_body_class') ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function fair_edge_search_body_class($classes) {

		if ( is_active_widget( false, false, 'edgt_search_opener' ) ) {

			$classes[] = 'edgtf-' . fair_edge_options()->getOptionValue('search_type');

			if ( fair_edge_options()->getOptionValue('search_type') == 'fullscreen-search' ) {

				$classes[] = 'edgtf-search-fade';

			}

		}
		return $classes;

	}

	add_filter('body_class', 'fair_edge_search_body_class');
}

if ( ! function_exists('fair_edge_get_search') ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function fair_edge_get_search() {

		if ( fair_edge_active_widget( false, false, 'edgt_search_opener' ) ) {

			$search_type = fair_edge_options()->getOptionValue('search_type');

			if ($search_type == 'search-covers-header') {
				fair_edge_set_position_for_covering_search();
				return;
			}

			fair_edge_load_search_template();

		}
	}

}

if ( ! function_exists('fair_edge_set_position_for_covering_search') ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function fair_edge_set_position_for_covering_search() {

		$containing_sidebar = fair_edge_active_widget( false, false, 'edgt_search_opener' );

		foreach ($containing_sidebar as $sidebar) {

			if ( strpos( $sidebar, 'top-bar' ) !== false ) {
				add_action( 'fair_edge_after_header_top_html_open', 'fair_edge_load_search_template');
			} else if ( strpos( $sidebar, 'main-menu' ) !== false ) {
				add_action( 'fair_edge_after_header_menu_area_html_open', 'fair_edge_load_search_template');
			} else if ( strpos( $sidebar, 'mobile-logo' ) !== false ) {
				add_action( 'fair_edge_after_mobile_header_html_open', 'fair_edge_load_search_template');
			} else if ( strpos( $sidebar, 'logo' ) !== false ) {
				add_action( 'fair_edge_after_header_logo_area_html_open', 'fair_edge_load_search_template');
			} else if ( strpos( $sidebar, 'sticky' ) !== false ) {
				add_action( 'fair_edge_after_sticky_menu_html_open', 'fair_edge_load_search_template');
			}

		}

	}

}

if ( ! function_exists('fair_edge_load_search_template') ) {
	/**
	 * Loads HTML template with parameters
	 */
	function fair_edge_load_search_template() {
		global $fair_edge_IconCollections;

		$search_type = fair_edge_options()->getOptionValue('search_type');

		$search_icon = '';
		$search_icon_close = '';
		if ( fair_edge_options()->getOptionValue('search_icon_pack') !== '' ) {
			$search_icon = $fair_edge_IconCollections->getSearchIcon( fair_edge_options()->getOptionValue('search_icon_pack'), true );
			$search_icon_close = $fair_edge_IconCollections->getSearchClose( fair_edge_options()->getOptionValue('search_icon_pack'), true );
		}

		$parameters = array(
			'search_in_grid'		=> fair_edge_options()->getOptionValue('search_in_grid') == 'yes' ? true : false,
			'search_icon'			=> $search_icon,
			'search_icon_close'		=> $search_icon_close
		);

		fair_edge_get_module_template_part( 'templates/types/'.$search_type, 'search', '', $parameters );

	}

}