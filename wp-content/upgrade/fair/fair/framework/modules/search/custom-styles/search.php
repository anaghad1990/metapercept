<?php

if (!function_exists('fair_edge_search_opener_icon_size')) {

	function fair_edge_search_opener_icon_size()
	{

		if (fair_edge_options()->getOptionValue('header_search_icon_size')) {
			echo fair_edge_dynamic_css('.edgtf-search-opener, .edgtf-header-standard .edgtf-search-opener', array(
				'font-size' => fair_edge_filter_px(fair_edge_options()->getOptionValue('header_search_icon_size')) . 'px'
			));
		}

	}

	add_action('fair_edge_style_dynamic', 'fair_edge_search_opener_icon_size');

}

if (!function_exists('fair_edge_search_opener_icon_colors')) {

	function fair_edge_search_opener_icon_colors()
	{

		if (fair_edge_options()->getOptionValue('header_search_icon_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-search-opener', array(
				'color' => fair_edge_options()->getOptionValue('header_search_icon_color')
			));
		}

		if (fair_edge_options()->getOptionValue('header_search_icon_hover_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-search-opener:hover', array(
				'color' => fair_edge_options()->getOptionValue('header_search_icon_hover_color')
			));
		}

		if (fair_edge_options()->getOptionValue('header_light_search_icon_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header) .edgtf-search-opener,
			.edgtf-light-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-search-opener,
			.edgtf-light-header .edgtf-top-bar .edgtf-search-opener', array(
				'color' => fair_edge_options()->getOptionValue('header_light_search_icon_color') . ' !important'
			));
		}

		if (fair_edge_options()->getOptionValue('header_light_search_icon_hover_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-light-header .edgtf-page-header > div:not(.edgtf-sticky-header) .edgtf-search-opener:hover,
			.edgtf-light-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-search-opener:hover,
			.edgtf-light-header .edgtf-top-bar .edgtf-search-opener:hover', array(
				'color' => fair_edge_options()->getOptionValue('header_light_search_icon_hover_color') . ' !important'
			));
		}

		if (fair_edge_options()->getOptionValue('header_dark_search_icon_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header) .edgtf-search-opener,
			.edgtf-dark-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-search-opener,
			.edgtf-dark-header .edgtf-top-bar .edgtf-search-opener', array(
				'color' => fair_edge_options()->getOptionValue('header_dark_search_icon_color') . ' !important'
			));
		}
		if (fair_edge_options()->getOptionValue('header_dark_search_icon_hover_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-dark-header .edgtf-page-header > div:not(.edgtf-sticky-header) .edgtf-search-opener:hover,
			.edgtf-dark-header.edgtf-header-style-on-scroll .edgtf-page-header .edgtf-search-opener:hover,
			.edgtf-dark-header .edgtf-top-bar .edgtf-search-opener:hover', array(
				'color' => fair_edge_options()->getOptionValue('header_dark_search_icon_hover_color') . ' !important'
			));
		}

	}

	add_action('fair_edge_style_dynamic', 'fair_edge_search_opener_icon_colors');

}

if (!function_exists('fair_edge_search_opener_icon_background_colors')) {

	function fair_edge_search_opener_icon_background_colors()
	{

		if (fair_edge_options()->getOptionValue('search_icon_background_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-search-opener', array(
				'background-color' => fair_edge_options()->getOptionValue('search_icon_background_color')
			));
		}

		if (fair_edge_options()->getOptionValue('search_icon_background_hover_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-search-opener:hover', array(
				'background-color' => fair_edge_options()->getOptionValue('search_icon_background_hover_color')
			));
		}

	}

	add_action('fair_edge_style_dynamic', 'fair_edge_search_opener_icon_background_colors');
}

if (!function_exists('fair_edge_search_opener_text_styles')) {

	function fair_edge_search_opener_text_styles()
	{
		$text_styles = array();

		if (fair_edge_options()->getOptionValue('search_icon_text_color') !== '') {
			$text_styles['color'] = fair_edge_options()->getOptionValue('search_icon_text_color');
		}
		if (fair_edge_options()->getOptionValue('search_icon_text_fontsize') !== '') {
			$text_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('search_icon_text_fontsize')) . 'px';
		}
		if (fair_edge_options()->getOptionValue('search_icon_text_lineheight') !== '') {
			$text_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('search_icon_text_lineheight')) . 'px';
		}
		if (fair_edge_options()->getOptionValue('search_icon_text_texttransform') !== '') {
			$text_styles['text-transform'] = fair_edge_options()->getOptionValue('search_icon_text_texttransform');
		}
		if (fair_edge_options()->getOptionValue('search_icon_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = fair_edge_get_formatted_font_family(fair_edge_options()->getOptionValue('search_icon_text_google_fonts')) . ', sans-serif';
		}
		if (fair_edge_options()->getOptionValue('search_icon_text_fontstyle') !== '') {
			$text_styles['font-style'] = fair_edge_options()->getOptionValue('search_icon_text_fontstyle');
		}
		if (fair_edge_options()->getOptionValue('search_icon_text_fontweight') !== '') {
			$text_styles['font-weight'] = fair_edge_options()->getOptionValue('search_icon_text_fontweight');
		}		
		if (fair_edge_options()->getOptionValue('search_icon_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('search_icon_text_letterspacing')).'px';
		}

		if (!empty($text_styles)) {
			echo fair_edge_dynamic_css('.edgtf-search-icon-text', $text_styles);
		}
		if (fair_edge_options()->getOptionValue('search_icon_text_color_hover') !== '') {
			echo fair_edge_dynamic_css('.edgtf-search-opener:hover .edgtf-search-icon-text', array(
				'color' => fair_edge_options()->getOptionValue('search_icon_text_color_hover')
			));
		}

	}

	add_action('fair_edge_style_dynamic', 'fair_edge_search_opener_text_styles');
}

if (!function_exists('fair_edge_search_opener_spacing')) {

	function fair_edge_search_opener_spacing()
	{
		$spacing_styles = array();

		if (fair_edge_options()->getOptionValue('search_padding_left') !== '') {
			$spacing_styles['padding-left'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('search_padding_left')) . 'px';
		}
		if (fair_edge_options()->getOptionValue('search_padding_right') !== '') {
			$spacing_styles['padding-right'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('search_padding_right')) . 'px';
		}
		if (fair_edge_options()->getOptionValue('search_margin_left') !== '') {
			$spacing_styles['margin-left'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('search_margin_left')) . 'px';
		}
		if (fair_edge_options()->getOptionValue('search_margin_right') !== '') {
			$spacing_styles['margin-right'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('search_margin_right')) . 'px';
		}

		if (!empty($spacing_styles)) {
			echo fair_edge_dynamic_css('.edgtf-search-opener', $spacing_styles);
		}

	}

	add_action('fair_edge_style_dynamic', 'fair_edge_search_opener_spacing');
}

if (!function_exists('fair_edge_search_bar_background')) {

	function fair_edge_search_bar_background()
	{

		if (fair_edge_options()->getOptionValue('search_background_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-search-cover, .edgtf-search-fade .edgtf-fullscreen-search-holder .edgtf-fullscreen-search-table, .edgtf-fullscreen-search-overlay', array(
				'background-color' => fair_edge_options()->getOptionValue('search_background_color')
			));
		}
	}

	add_action('fair_edge_style_dynamic', 'fair_edge_search_bar_background');
}

if (!function_exists('fair_edge_search_text_styles')) {

	function fair_edge_search_text_styles()
	{
		$text_styles = array();

		if (fair_edge_options()->getOptionValue('search_text_color') !== '') {
			$text_styles['color'] = fair_edge_options()->getOptionValue('search_text_color');
			echo fair_edge_dynamic_css('.edgt_search_field::-webkit-input-placeholder',array('color' => $text_styles['color']));
			echo fair_edge_dynamic_css('.edgt_search_field:-moz-placeholder',array('color' => $text_styles['color']));
			echo fair_edge_dynamic_css('.edgt_search_field::-moz-placeholder',array('color' => $text_styles['color']));
			echo fair_edge_dynamic_css('.edgt_search_field:-ms-input-placeholder',array('color' => $text_styles['color']));
		}
		if (fair_edge_options()->getOptionValue('search_text_fontsize') !== '') {
			$text_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('search_text_fontsize')) . 'px';
		}
		if (fair_edge_options()->getOptionValue('search_text_texttransform') !== '') {
			$text_styles['text-transform'] = fair_edge_options()->getOptionValue('search_text_texttransform');
		}
		if (fair_edge_options()->getOptionValue('search_text_google_fonts') !== '-1') {
			$text_styles['font-family'] = fair_edge_get_formatted_font_family(fair_edge_options()->getOptionValue('search_text_google_fonts')) . ', sans-serif';
		}
		if (fair_edge_options()->getOptionValue('search_text_fontstyle') !== '') {
			$text_styles['font-style'] = fair_edge_options()->getOptionValue('search_text_fontstyle');
		}
		if (fair_edge_options()->getOptionValue('search_text_fontweight') !== '') {
			$text_styles['font-weight'] = fair_edge_options()->getOptionValue('search_text_fontweight');
		}
		if (fair_edge_options()->getOptionValue('search_text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('search_text_letterspacing')) . 'px';
		}

		if (!empty($text_styles)) {
			echo fair_edge_dynamic_css('.edgtf-search-cover input[type="text"], .edgtf-fullscreen-search-opened .edgtf-form-holder .edgtf-search-field', $text_styles);
		}

	}

	add_action('fair_edge_style_dynamic', 'fair_edge_search_text_styles');
}

if (!function_exists('fair_edge_search_icon_styles')) {

	function fair_edge_search_icon_styles()
	{

		if (fair_edge_options()->getOptionValue('search_icon_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-search-submit', array(
				'color' => fair_edge_options()->getOptionValue('search_icon_color')
			));
		}
		if (fair_edge_options()->getOptionValue('search_icon_hover_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-search-submit:hover', array(
				'color' => fair_edge_options()->getOptionValue('search_icon_hover_color')
			));
		}
		if (fair_edge_options()->getOptionValue('search_icon_size') !== '') {
			echo fair_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-search-submit', array(
				'font-size' => fair_edge_filter_px(fair_edge_options()->getOptionValue('search_icon_size')) . 'px'
			));
		}

	}

	add_action('fair_edge_style_dynamic', 'fair_edge_search_icon_styles');
}

if (!function_exists('fair_edge_search_close_icon_styles')) {

	function fair_edge_search_close_icon_styles()
	{

		if (fair_edge_options()->getOptionValue('search_close_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-search-cover .edgtf-search-close i,.edgtf-search-cover .edgtf-search-close span, .edgtf-fullscreen-search-close', array(
				'color' => fair_edge_options()->getOptionValue('search_close_color')
			));
		}
		if (fair_edge_options()->getOptionValue('search_close_hover_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-search-cover .edgtf-search-close i:hover,.edgtf-search-cover .edgtf-search-close span:hover, .edgtf-fullscreen-search-close:hover', array(
				'color' => fair_edge_options()->getOptionValue('search_close_hover_color')
			));
		}
		if (fair_edge_options()->getOptionValue('search_close_size') !== '') {
			echo fair_edge_dynamic_css('.edgtf-search-cover .edgtf-search-close i,.edgtf-search-cover .edgtf-search-close span, .edgtf-fullscreen-search-close', array(
				'font-size' => fair_edge_filter_px(fair_edge_options()->getOptionValue('search_close_size')) . 'px'
			));
		}

	}

	add_action('fair_edge_style_dynamic', 'fair_edge_search_close_icon_styles');
}

if (!function_exists('fair_edge_search_border_styles')) {

	function fair_edge_search_border_styles()
	{

		if (fair_edge_options()->getOptionValue('search_border_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-field-holder', array(
				'border-color' => fair_edge_options()->getOptionValue('search_border_color')
			));
		}
		if (fair_edge_options()->getOptionValue('search_border_focus_color') !== '') {
			echo fair_edge_dynamic_css('.edgtf-fullscreen-search-holder .edgtf-field-holder .edgtf-line', array(
				'background-color' => fair_edge_options()->getOptionValue('search_border_focus_color')
			));
		}

	}

	add_action('fair_edge_style_dynamic', 'fair_edge_search_border_styles');
}

?>
