<?php

if (!function_exists('fair_edge_register_widgets')) {

	function fair_edge_register_widgets() {

		$widgets = array(
			'FairEdgeLatestPosts',
			'FairEdgeSearchOpener',
			'FairEdgeSideAreaOpener',
			'FairEdgeStickySidebar',
			'FairEdgeSocialIconWidget',
			'FairEdgeSeparatorWidget'
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'fair_edge_register_widgets');