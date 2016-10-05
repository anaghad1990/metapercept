<?php
namespace FairEdge\Modules\Shortcodes\PricingTables;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTables implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_pricing_tables';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map( array(
				'name' => esc_html__('Pricing Tables', 'fair'),
				'base' => $this->base,
				'as_parent' => array('only' => 'edgtf_pricing_table'),
				'content_element' => true,
				'category' => 'by EDGE',
				'icon' => 'icon-wpb-pricing-tables extended-custom-icon',
				'show_settings_on_create' => true,
				'params' => array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Columns',
						'param_name' => 'columns',
						'value' => array(
							'Two'       => 'edgtf-two-columns',
							'Three'     => 'edgtf-three-columns',
							'Four'      => 'edgtf-four-columns',
						),
						'save_always' => true,
						'description' => ''
					)
				),
				'js_view' => 'VcColumnView'
		) );
	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'         => 'edgtf-two-columns'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		
		$html = '<div class="edgtf-pricing-tables clearfix '.$columns.'">';
		$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;
	}
}