<?php
if (!function_exists('fair_edge_register_side_area_sidebar')) {
	/**
	 * Register side area sidebar
	 */
	function fair_edge_register_side_area_sidebar() {

		register_sidebar(array(
			'name' => 'Side Area',
			'id' => 'sidearea', //TODO Change name of sidebar
			'description' => 'Side Area',
			'before_widget' => '<div id="%1$s" class="widget edgtf-sidearea %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="edgtf-sidearea-widget-title">',
			'after_title' => '</h4>'
		));

	}

	add_action('widgets_init', 'fair_edge_register_side_area_sidebar');

}

if(!function_exists('fair_edge_side_menu_body_class')) {
    /**
     * Function that adds body classes for different side menu styles
     *
     * @param $classes array original array of body classes
     *
     * @return array modified array of classes
     */
    function fair_edge_side_menu_body_class($classes) {

		if (is_active_widget( false, false, 'edgtf_side_area_opener' )) {

			if (fair_edge_options()->getOptionValue('side_area_type')) {

				$classes[] = 'edgtf-' . fair_edge_options()->getOptionValue('side_area_type');

				if (fair_edge_options()->getOptionValue('side_area_type') === 'side-menu-slide-with-content') {

					$classes[] = 'edgtf-' . fair_edge_options()->getOptionValue('side_area_slide_with_content_width');

				}

        	}

		}

		return $classes;

    }

    add_filter('body_class', 'fair_edge_side_menu_body_class');
}


if(!function_exists('fair_edge_get_side_area')) {
	/**
	 * Loads side area HTML
	 */
	function fair_edge_get_side_area() {

		if (is_active_widget( false, false, 'edgtf_side_area_opener' )) {

			$parameters = array(
				'show_side_area_title' => fair_edge_options()->getOptionValue('side_area_title') !== '' ? true : false, //Dont show title if empty
			);

			fair_edge_get_module_template_part('templates/sidearea', 'sidearea', '', $parameters);

		}

	}

}

if (!function_exists('fair_edge_get_side_area_title')) {
	/**
	 * Loads side area title HTML
	 */
	function fair_edge_get_side_area_title() {

		$parameters = array(
			'side_area_title' => fair_edge_options()->getOptionValue('side_area_title')
		);

		fair_edge_get_module_template_part('templates/parts/title', 'sidearea', '', $parameters);

	}

}

if(!function_exists('fair_edge_get_side_menu_icon_html')) {
    /**
     * Function that outputs html for side area icon opener.
     * Uses $fair_edge_IconCollections global variable
     * @return string generated html
     */
    function fair_edge_get_side_menu_icon_html() {

        $icon_html = '';

		if (fair_edge_options()->getOptionValue('side_area_button_icon_pack') !== '') {
			$icon_pack = 'font_elegant';

			$icons = fair_edge_icon_collections()->getIconCollection($icon_pack);
			//$icon_options_field = 'side_area_icon_' . $icons->param;
			$icon_options_field = 'side_area_icon_fe_icon';

			//if (fair_edge_options()->getOptionValue($icon_options_field) !== '') {

//				/$icon = fair_edge_options()->getOptionValue($icon_options_field);
				$icon = 'icon_menu';
				$icon_html = fair_edge_icon_collections()->renderIcon($icon, $icon_pack);
		//	}

		}

        return $icon_html;
    }
}