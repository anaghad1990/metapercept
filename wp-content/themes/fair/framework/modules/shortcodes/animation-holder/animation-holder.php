<?php
namespace FairEdge\Modules\Shortcodes\AnimationHolder;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class AnimationHolder implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_animation_holder';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Animation Holder', 'fair'),
			'base' => $this->base,
			'as_parent' => array('except' => ''),
			'content_element' => true,
			'icon' => 'icon-wpb-animation-holder extended-custom-icon',
			'category' => 'by EDGE',
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => 'Animation Type',
					'param_name' => 'animation_type',
					'value' => array(
						'Fade In Upwards' => 'fade_in_up',
						'Fade In Downwards' => 'fade_in_down',
						'Fade In From Left' => 'fade_in_left',
						'Fade In From Right' => 'fade_in_right',
						'Fade In To Scale' => 'fade_in_scale',
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Animation Delay',
					'param_name' => 'animation_delay',
					'description' => 'Enter animation delay in miliseconds.'
				),
			)
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'animation_type' 			=> '',
			'animation_delay' 			=> '',
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$params['content']= $content;
		$params['holder_data'] = $this->getAnimationHolderData($params);

		$html = fair_edge_get_shortcode_module_template_part('templates/animation-holder-template', 'animation-holder', '', $params);

		return $html;

	}


	/**
	 * Return Animated holder data
	 *
	 * @param $params
	 * @return array
	 */
	private function getAnimationHolderData($params) {

		$animated_holder_data = array();

		if (!empty($params['animation_type'])) {
			$animated_holder_data['data-animation-type'] = $params['animation_type'];;
		}

		if (!empty($params['animation_delay'])) {
			$animated_holder_data['data-animation-delay'] = $params['animation_delay'];;
		}

		return $animated_holder_data;

	}
}
