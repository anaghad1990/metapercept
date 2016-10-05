<?php

if(!function_exists('fair_edge_design_responsive_styles')) {
    /**
     * Generates general responsive custom styles
     */
    function fair_edge_design_responsive_styles() {

        $parallax_style = array();
        if (fair_edge_options()->getOptionValue('parallax_min_height') !== '') {
            $parallax_style['height'] = 'auto !important';
            $parallax_min_height = fair_edge_options()->getOptionValue('parallax_min_height');
            $parallax_style['min-height'] = fair_edge_filter_px($parallax_min_height) . 'px';
        }

		echo fair_edge_dynamic_css('.edgtf-section.edgtf-parallax-section-holder,.touch .edgtf-parallax-section-holder.edgtf-parallax-section-holder-touch-disabled', $parallax_style);
    }

    add_action('fair_edge_style_dynamic_responsive_1024', 'fair_edge_design_responsive_styles');
}

if (!function_exists('fair_edge_h1_responsive_styles')) {

    function fair_edge_h1_responsive_styles() {

        $h1_styles = array();

        if(fair_edge_options()->getOptionValue('h1_responsive_fontsize') !== '') {
            $h1_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h1_responsive_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h1_responsive_lineheight') !== '') {
            $h1_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h1_responsive_lineheight')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo fair_edge_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480_768', 'fair_edge_h1_responsive_styles');
}

if (!function_exists('fair_edge_h2_responsive_styles')) {

    function fair_edge_h2_responsive_styles() {

        $h2_styles = array();

        if(fair_edge_options()->getOptionValue('h2_responsive_fontsize') !== '') {
            $h2_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h2_responsive_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h2_responsive_lineheight') !== '') {
            $h2_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h2_responsive_lineheight')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo fair_edge_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480_768', 'fair_edge_h2_responsive_styles');
}

if (!function_exists('fair_edge_h3_responsive_styles')) {

    function fair_edge_h3_responsive_styles() {

        $h3_styles = array();

        if(fair_edge_options()->getOptionValue('h3_responsive_fontsize') !== '') {
            $h3_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h3_responsive_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h3_responsive_lineheight') !== '') {
            $h3_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h3_responsive_lineheight')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo fair_edge_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480_768', 'fair_edge_h3_responsive_styles');
}

if (!function_exists('fair_edge_h4_responsive_styles')) {

    function fair_edge_h4_responsive_styles() {

        $h4_styles = array();

        if(fair_edge_options()->getOptionValue('h4_responsive_fontsize') !== '') {
            $h4_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h4_responsive_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h4_responsive_lineheight') !== '') {
            $h4_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h4_responsive_lineheight')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo fair_edge_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480_768', 'fair_edge_h4_responsive_styles');
}

if (!function_exists('fair_edge_h5_responsive_styles')) {

    function fair_edge_h5_responsive_styles() {

        $h5_styles = array();

        if(fair_edge_options()->getOptionValue('h5_responsive_fontsize') !== '') {
            $h5_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h5_responsive_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h5_responsive_lineheight') !== '') {
            $h5_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h5_responsive_lineheight')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo fair_edge_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480_768', 'fair_edge_h5_responsive_styles');
}

if (!function_exists('fair_edge_h6_responsive_styles')) {

    function fair_edge_h6_responsive_styles() {

        $h6_styles = array();

        if(fair_edge_options()->getOptionValue('h6_responsive_fontsize') !== '') {
            $h6_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h6_responsive_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h6_responsive_lineheight') !== '') {
            $h6_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h6_responsive_lineheight')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo fair_edge_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480_768', 'fair_edge_h6_responsive_styles');
}

if (!function_exists('fair_edge_text_responsive_styles')) {

    function fair_edge_text_responsive_styles() {

        $text_styles = array();

        if(fair_edge_options()->getOptionValue('text_fontsize_res1') !== '') {
            $text_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('text_fontsize_res1')).'px';
        }
        if(fair_edge_options()->getOptionValue('text_lineheight_res1') !== '') {
            $text_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('text_lineheight_res1')).'px';
        }

        $text_selector = array(
            'body',
            'p'
        );

        if (!empty($text_styles)) {
            echo fair_edge_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480_768', 'fair_edge_text_responsive_styles');
}

if (!function_exists('fair_edge_h1_responsive_styles2')) {

    function fair_edge_h1_responsive_styles2() {

        $h1_styles = array();

        if(fair_edge_options()->getOptionValue('h1_responsive_fontsize2') !== '') {
            $h1_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h1_responsive_fontsize2')).'px';
        }
        if(fair_edge_options()->getOptionValue('h1_responsive_lineheight2') !== '') {
            $h1_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h1_responsive_lineheight2')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo fair_edge_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480', 'fair_edge_h1_responsive_styles2');
}

if (!function_exists('fair_edge_h2_responsive_styles2')) {

    function fair_edge_h2_responsive_styles2() {

        $h2_styles = array();

        if(fair_edge_options()->getOptionValue('h2_responsive_fontsize2') !== '') {
            $h2_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h2_responsive_fontsize2')).'px';
        }
        if(fair_edge_options()->getOptionValue('h2_responsive_lineheight2') !== '') {
            $h2_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h2_responsive_lineheight2')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo fair_edge_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480', 'fair_edge_h2_responsive_styles2');
}

if (!function_exists('fair_edge_h3_responsive_styles2')) {

    function fair_edge_h3_responsive_styles2() {

        $h3_styles = array();

        if(fair_edge_options()->getOptionValue('h3_responsive_fontsize2') !== '') {
            $h3_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h3_responsive_fontsize2')).'px';
        }
        if(fair_edge_options()->getOptionValue('h3_responsive_lineheight2') !== '') {
            $h3_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h3_responsive_lineheight2')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo fair_edge_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480', 'fair_edge_h3_responsive_styles2');
}

if (!function_exists('fair_edge_h4_responsive_styles2')) {

    function fair_edge_h4_responsive_styles2() {

        $h4_styles = array();

        if(fair_edge_options()->getOptionValue('h4_responsive_fontsize2') !== '') {
            $h4_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h4_responsive_fontsize2')).'px';
        }
        if(fair_edge_options()->getOptionValue('h4_responsive_lineheight2') !== '') {
            $h4_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h4_responsive_lineheight2')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo fair_edge_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480', 'fair_edge_h4_responsive_styles2');
}

if (!function_exists('fair_edge_h5_responsive_styles2')) {

    function fair_edge_h5_responsive_styles2() {

        $h5_styles = array();

        if(fair_edge_options()->getOptionValue('h5_responsive_fontsize2') !== '') {
            $h5_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h5_responsive_fontsize2')).'px';
        }
        if(fair_edge_options()->getOptionValue('h5_responsive_lineheight2') !== '') {
            $h5_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h5_responsive_lineheight2')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo fair_edge_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480', 'fair_edge_h5_responsive_styles2');
}

if (!function_exists('fair_edge_h6_responsive_styles2')) {

    function fair_edge_h6_responsive_styles2() {

        $h6_styles = array();

        if(fair_edge_options()->getOptionValue('h6_responsive_fontsize2') !== '') {
            $h6_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h6_responsive_fontsize2')).'px';
        }
        if(fair_edge_options()->getOptionValue('h6_responsive_lineheight2') !== '') {
            $h6_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h6_responsive_lineheight2')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo fair_edge_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480', 'fair_edge_h6_responsive_styles2');
}

if (!function_exists('fair_edge_text_responsive_styles2')) {

    function fair_edge_text_responsive_styles2() {

        $text_styles = array();

        if(fair_edge_options()->getOptionValue('text_fontsize_res2') !== '') {
            $text_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('text_fontsize_res2')).'px';
        }
        if(fair_edge_options()->getOptionValue('text_lineheight_res2') !== '') {
            $text_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('text_lineheight_res2')).'px';
        }

        $text_selector = array(
            'body',
            'p'
        );

        if (!empty($text_styles)) {
            echo fair_edge_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('fair_edge_style_dynamic_responsive_480', 'fair_edge_text_responsive_styles2');
}