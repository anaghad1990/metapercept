<?php

if(!function_exists('fair_edge_passepartout_styles')) {
    /**
     * Generates styles for header top bar
     */
    function fair_edge_passepartout_styles() {

		$passepartout_selector = array(
			'.edgtf-passepartout .edgtf-passepartout-left',
			'.edgtf-passepartout .edgtf-passepartout-right',
			'.edgtf-passepartout .edgtf-passepartout-top',
			'.edgtf-passepartout .edgtf-passepartout-bottom'
		);

        $passepartout_styles = array();
        $passepartout_color = fair_edge_options()->getOptionValue('passepartout_color');
        if($passepartout_color !== '') {
           $passepartout_styles['background-color'] = $passepartout_color;
        }

        echo fair_edge_dynamic_css($passepartout_selector, $passepartout_styles);
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_passepartout_styles');
}

