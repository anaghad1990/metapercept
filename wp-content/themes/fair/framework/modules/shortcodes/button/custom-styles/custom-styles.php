<?php

if(!function_exists('fair_edge_button_typography_styles')) {
    /**
     * Typography styles for all button types
     */
    function fair_edge_button_typography_styles() {
        $selector = '.edgtf-btn';
        $styles = array();

        $font_family = fair_edge_options()->getOptionValue('button_font_family');
        if(fair_edge_is_font_option_valid($font_family)) {
            $styles['font-family'] = fair_edge_get_font_option_val($font_family);
        }

        $text_transform = fair_edge_options()->getOptionValue('button_text_transform');
        if(!empty($text_transform)) {
            $styles['text-transform'] = $text_transform;
        }

        $font_style = fair_edge_options()->getOptionValue('button_font_style');
        if(!empty($font_style)) {
            $styles['font-style'] = $font_style;
        }

        $letter_spacing = fair_edge_options()->getOptionValue('button_letter_spacing');
        if($letter_spacing !== '') {
            $styles['letter-spacing'] = fair_edge_filter_px($letter_spacing).'px';
        }

        $font_weight = fair_edge_options()->getOptionValue('button_font_weight');
        if(!empty($font_weight)) {
            $styles['font-weight'] = $font_weight;
        }

        echo fair_edge_dynamic_css($selector, $styles);
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_button_typography_styles');
}

if(!function_exists('fair_edge_button_outline_styles')) {
    /**
     * Generate styles for outline button
     */
    function fair_edge_button_outline_styles() {
        //outline styles
        $outline_styles   = array();
        $outline_selector = '.edgtf-btn.edgtf-btn-outline';

        if(fair_edge_options()->getOptionValue('btn_outline_text_color')) {
            $outline_styles['color'] = fair_edge_options()->getOptionValue('btn_outline_text_color');
        }

        if(fair_edge_options()->getOptionValue('btn_outline_border_color')) {
            $outline_styles['border-color'] = fair_edge_options()->getOptionValue('btn_outline_border_color');
        }

        echo fair_edge_dynamic_css($outline_selector, $outline_styles);

        //outline hover styles
        if(fair_edge_options()->getOptionValue('btn_outline_hover_text_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-hover-color):hover',
                array('color' => fair_edge_options()->getOptionValue('btn_outline_hover_text_color').'!important')
            );
        }

        if(fair_edge_options()->getOptionValue('btn_outline_hover_bg_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-hover-bg):hover',
                array('background-color' => fair_edge_options()->getOptionValue('btn_outline_hover_bg_color').'!important')
            );
        }

        if(fair_edge_options()->getOptionValue('btn_outline_hover_border_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline:not(.edgtf-btn-custom-border-hover):hover',
                array('border-color' => fair_edge_options()->getOptionValue('btn_outline_hover_border_color').'!important')
            );
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_button_outline_styles');
}

if(!function_exists('fair_edge_button_outline_white_styles')) {
    /**
     * Generate styles for outline white button
     */
    function fair_edge_button_outline_white_styles() {

        //outline hover styles
        if(fair_edge_options()->getOptionValue('btn_outline_white_hover_text_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline-white:not(.edgtf-btn-custom-hover-color):hover',
                array('color' => fair_edge_options()->getOptionValue('btn_outline_white_hover_text_color').'!important')
            );
        }

        if(fair_edge_options()->getOptionValue('btn_outline_white_hover_bg_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline-white:not(.edgtf-btn-custom-hover-bg):hover',
                array('background-color' => fair_edge_options()->getOptionValue('btn_outline_white_hover_bg_color').'!important')
            );
        }

        if(fair_edge_options()->getOptionValue('btn_outline_white_hover_border_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-outline-white:not(.edgtf-btn-custom-border-hover):hover',
                array('border-color' => fair_edge_options()->getOptionValue('btn_outline_white_hover_border_color').'!important')
            );
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_button_outline_white_styles');
}

if(!function_exists('fair_edge_button_solid_styles')) {
    /**
     * Generate styles for solid type buttons
     */
    function fair_edge_button_solid_styles() {
        //solid styles
        $solid_selector = '.edgtf-btn.edgtf-btn-solid';
        $solid_styles = array();

        if(fair_edge_options()->getOptionValue('btn_solid_text_color')) {
            $solid_styles['color'] = fair_edge_options()->getOptionValue('btn_solid_text_color');
        }

        if(fair_edge_options()->getOptionValue('btn_solid_border_color')) {
            $solid_styles['border-color'] = fair_edge_options()->getOptionValue('btn_solid_border_color');
        }

        if(fair_edge_options()->getOptionValue('btn_solid_bg_color')) {
            $solid_styles['background-color'] = fair_edge_options()->getOptionValue('btn_solid_bg_color');
        }

        echo fair_edge_dynamic_css($solid_selector, $solid_styles);

        //solid hover styles
        if(fair_edge_options()->getOptionValue('btn_solid_hover_text_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-color):hover',
                array('color' => fair_edge_options()->getOptionValue('btn_solid_hover_text_color').'!important')
            );
        }

        if(fair_edge_options()->getOptionValue('btn_solid_hover_bg_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-bg):hover',
                array('background-color' => fair_edge_options()->getOptionValue('btn_solid_hover_bg_color').'!important')
            );
        }

        if(fair_edge_options()->getOptionValue('btn_solid_hover_border_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-bg):hover',
                array('border-color' => fair_edge_options()->getOptionValue('btn_solid_hover_border_color').'!important')
            );
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_button_solid_styles');
}

if(!function_exists('fair_edge_button_solid_two_styles')) {
    /**
     * Generate styles for solid two type buttons
     */
    function fair_edge_button_solid_two_styles() {
        //solid two styles
        $solid_two_selector = '.edgtf-btn.edgtf-btn-solid-two';
        $solid_two_styles = array();

        if(fair_edge_options()->getOptionValue('btn_solid_two_text_color')) {
            $solid_two_styles['color'] = fair_edge_options()->getOptionValue('btn_solid_two_text_color');
        }

        if(fair_edge_options()->getOptionValue('btn_solid_two_border_color')) {
            $solid_two_styles['border-color'] = fair_edge_options()->getOptionValue('btn_solid_two_border_color');
        }

        if(fair_edge_options()->getOptionValue('btn_solid_two_bg_color')) {
            $solid_two_styles['background-color'] = fair_edge_options()->getOptionValue('btn_solid_two_bg_color');
        }

        echo fair_edge_dynamic_css($solid_two_selector, $solid_two_styles);

        //solid hover styles
        if(fair_edge_options()->getOptionValue('btn_solid_two_hover_text_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid-two:not(.edgtf-btn-custom-hover-color):hover',
                array('color' => fair_edge_options()->getOptionValue('btn_solid_two_hover_text_color').'!important')
            );
        }

        if(fair_edge_options()->getOptionValue('btn_solid_two_hover_bg_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid-two:not(.edgtf-btn-custom-hover-bg):hover',
                array('background-color' => fair_edge_options()->getOptionValue('btn_solid_two_hover_bg_color').'!important')
            );
        }

        if(fair_edge_options()->getOptionValue('btn_solid_two_hover_border_color')) {
            echo fair_edge_dynamic_css(
                '.edgtf-btn.edgtf-btn-solid-two:not(.edgtf-btn-custom-hover-bg):hover',
                array('border-color' => fair_edge_options()->getOptionValue('btn_solid_two_hover_border_color').'!important')
            );
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_button_solid_two_styles');
}