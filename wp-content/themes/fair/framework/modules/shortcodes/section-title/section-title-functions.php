<?php

if(!function_exists('fair_edge_get_section_title_html')) {
    /**
     * Calls section title shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function fair_edge_get_section_title_html($params) {
        $section_title_html = fair_edge_execute_shortcode('edgtf_section_title', $params);
		$section_title_html = str_replace("\n", '', $section_title_html);
        return $section_title_html;
    }
}