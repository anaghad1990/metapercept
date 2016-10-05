<?php

if(!function_exists('fair_edge_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function fair_edge_is_responsive_on() {
        return fair_edge_options()->getOptionValue('responsiveness') !== 'no';
    }
}