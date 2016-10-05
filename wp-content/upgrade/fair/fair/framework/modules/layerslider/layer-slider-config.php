<?php
	if(!function_exists('fair_edge_layerslider_overrides')) {
		/**
		 * Disables Layer Slider auto update box
		 */
		function fair_edge_layerslider_overrides() {
			$GLOBALS['lsAutoUpdateBox'] = false;
		}

		add_action('layerslider_ready', 'fair_edge_layerslider_overrides');
	}
?>