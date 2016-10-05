<?php
if(!function_exists('fair_edge_tabs_typography_styles')){
	function fair_edge_tabs_typography_styles(){
		$selector = '.edgtf-tabs .edgtf-tabs-nav li a';
		$tabs_tipography_array = array();
		$font_family = fair_edge_options()->getOptionValue('tabs_font_family');
		
		if(fair_edge_is_font_option_valid($font_family)){
			$tabs_tipography_array['font-family'] = fair_edge_get_font_option_val($font_family);
		}
		
		$text_transform = fair_edge_options()->getOptionValue('tabs_text_transform');
        if(!empty($text_transform)) {
            $tabs_tipography_array['text-transform'] = $text_transform;
        }

        $font_style = fair_edge_options()->getOptionValue('tabs_font_style');
        if(!empty($font_style)) {
            $tabs_tipography_array['font-style'] = $font_style;
        }

        $letter_spacing = fair_edge_options()->getOptionValue('tabs_letter_spacing');
        if($letter_spacing !== '') {
            $tabs_tipography_array['letter-spacing'] = fair_edge_filter_px($letter_spacing).'px';
        }

        $font_weight = fair_edge_options()->getOptionValue('tabs_font_weight');
        if(!empty($font_weight)) {
            $tabs_tipography_array['font-weight'] = $font_weight;
        }

        echo fair_edge_dynamic_css($selector, $tabs_tipography_array);
	}
	add_action('fair_edge_style_dynamic', 'fair_edge_tabs_typography_styles');
}

if(!function_exists('fair_edge_tabs_inital_color_styles')){
	function fair_edge_tabs_inital_color_styles(){
		$selector = '.edgtf-tabs .edgtf-tabs-nav li a';
		$styles = array();
		
		if(fair_edge_options()->getOptionValue('tabs_color')) {
            $styles['color'] = fair_edge_options()->getOptionValue('tabs_color');
        }
		if(fair_edge_options()->getOptionValue('tabs_back_color')) {
            $styles['background-color'] = fair_edge_options()->getOptionValue('tabs_back_color');
        }
		if(fair_edge_options()->getOptionValue('tabs_border_color')) {
            $styles['border-color'] = fair_edge_options()->getOptionValue('tabs_border_color');
        }
		
		echo fair_edge_dynamic_css($selector, $styles);
	}
	add_action('fair_edge_style_dynamic', 'fair_edge_tabs_inital_color_styles');
}
if(!function_exists('fair_edge_tabs_active_color_styles')){
	function fair_edge_tabs_active_color_styles(){
		$selector = '.edgtf-tabs .edgtf-tabs-nav li.ui-state-active a, .edgtf-tabs .edgtf-tabs-nav li.ui-state-hover a';
		$styles = array();
		
		if(fair_edge_options()->getOptionValue('tabs_color_active')) {
            $styles['color'] = fair_edge_options()->getOptionValue('tabs_color_active');
        }
		if(fair_edge_options()->getOptionValue('tabs_back_color_active')) {
            $styles['background-color'] = fair_edge_options()->getOptionValue('tabs_back_color_active');
        }
		if(fair_edge_options()->getOptionValue('tabs_border_color_active')) {
            $styles['border-color'] = fair_edge_options()->getOptionValue('tabs_border_color_active');
        }
		
		echo fair_edge_dynamic_css($selector, $styles);
	}
	add_action('fair_edge_style_dynamic', 'fair_edge_tabs_active_color_styles');
}