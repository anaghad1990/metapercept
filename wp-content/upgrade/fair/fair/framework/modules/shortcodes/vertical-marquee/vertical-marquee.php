<?php
namespace FairEdge\Modules\Shortcodes\VerticalMarquee;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class VerticalMarquee implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_vertical_marquee';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Vertical Marquee', 'fair'),
			'base' => $this->base,
			'icon' => 'icon-wpb-vertical-marquee extended-custom-icon',
			'category' => 'by EDGE',
			'as_parent' => array('only' => 'edgtf_vertical_marquee_item'),
			'js_view' => 'VcColumnView',
			'content_element' => true,
			'description' => 'Scrolling text next to a fixed monitor.',
			'show_settings_on_create' => false,
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'fair' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'fair' )
				)
			)
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'el_class' 		=> ''
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$regex = "/image=\"([0-9]*)\"/";
		preg_match_all($regex, $content, $matches);
		$matches = $matches[1];
		$left_img_html = "";
		foreach($matches as $match) {
			$left_img_html .= '<div class="edgtf-vm-slide">'.wp_get_attachment_image($match, 'full').'</div>';
		}
		$params['content'] = $content;
		$params['left_img_html'] = $left_img_html;
		$html = fair_edge_get_shortcode_module_template_part('templates/vertical-marquee-template', 'vertical-marquee', '', $params);

		return $html;

	}

}
