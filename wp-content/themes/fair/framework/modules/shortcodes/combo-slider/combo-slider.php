<?php
namespace FairEdge\Modules\Shortcodes\ComboSlider;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class ComboSlider implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_combo_slider';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Combo Slider', 'fair'),
			'base' => $this->base,
			'icon' => 'icon-wpb-combo-slider extended-custom-icon',
			'category' => 'by EDGE',
			'as_parent' => array('only' => 'edgtf_combo_slide_item'),
			'js_view' => 'VcColumnView',
			'show_settings_on_create' => false
		));
	}

	public function render($atts, $content = null) {
	
		$args = array();
		$params = shortcode_atts($args, $atts);

		$html = '';

		$html .= '<div class="edgtf-combo-slider-holder">';
			$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;

	}

}
