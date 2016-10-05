<?php
namespace FairEdge\Modules\Shortcodes\VerticalMarqueeItem;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class VerticalMarqueeItem implements ShortcodeInterface{
	private $base;

	function __construct() {
		$this->base = 'edgtf_vertical_marquee_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Vertical Marquee Item', 'fair'),
					'base' => $this->base,
					'as_child' => array('only' => 'edgtf_elements_holder'),
					'as_parent' => array('except' => 'vc_row'),
					'content_element' => true,
					'category' => 'by EDGE',
					'icon' => 'icon-wpb-vertical-marquee-item extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view' => 'VcColumnView',
					'params' => array(
						array(
							'type' => 'attach_image',
							'value' => '',
							'heading' => 'Image',
							'param_name' => 'image',
							'description' => 'Choose portrait images for additional scrolling effect.',
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'image' => ''
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['content'] = $content;

		$html = fair_edge_get_shortcode_module_template_part('templates/vertical-marquee-item-template', 'vertical-marquee', '', $params);

		return $html;
	}

}
