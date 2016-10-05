<?php
namespace FairEdge\Modules\Shortcodes\VerticalSplitSliderContentItem;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class VerticalSplitSliderContentItem implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_vertical_split_slider_content_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Slide Content Item', 'fair'),
			'base' => $this->base,
			'icon' => 'icon-wpb-vertical-split-slider-content-item extended-custom-icon',
			'category' => 'by EDGE',
			'as_parent' => array('except' => 'vc_row'),
			'as_child' => array('only' => 'edgtf_vertical_split_slider_left_panel,edgtf_vertical_split_slider_right_panel'),
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type'			=>	'colorpicker',
					'heading'		=>	'Background Color',
					'param_name'	=>	'background_color',
					'value' 		=>	''
				),
				array(
					'type'			=>	'attach_image',
					'heading'		=>	'Background Image',
					'param_name'	=>	'background_image',
					'value'			=>	''
				),
				array(
					'type'			=>	'textfield',
					'heading'		=>	'Padding left/right',
					'param_name'	=>	'item_padding',
					'value'			=>  '',
					"description"	=>	'Please insert padding in format "10px""'
				),
				array(
					'type'			=>	'dropdown',
					'heading'		=>	'Content Aligment',
					'param_name'	=>	'alignment',
					'value' => array(
						'Left'		=> 'left',
						'Right'		=> 'right',
						'Center'	=> 'center'
					)
				)
			)
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'background_color'	=> '',
			'background_image'	=> '',
			'item_padding'		=> '',
			'alignment'			=> 'left',
		);
		$params = shortcode_atts($args, $atts);
		extract($params);

		$params['content_style'] = $this->getContentStyle($params);
		$params['content'] = $content;

		$html = fair_edge_get_shortcode_module_template_part('templates/vertical-split-slider-content-item-template', 'vertical-split-slider', '', $params);

		return $html;

	}


	/**
	 * Return Content Style
	 *
	 * @param $params
	 * @return array
	 */
	private function getContentStyle($params) {

		$content_style = array();

		if ($params['background_color'] !== '') {
			$content_style[] = 'background-color:'. $params['background_color'];
		}

		if ($params['background_image'] !== '') {
			$url = wp_get_attachment_url($params['background_image']);
			$content_style[] = 'background-image:url('. $url . ')';
		}

		if ($params['item_padding'] !== '') {
			$content_style[] = 'padding:'. $params['item_padding'] . 'px';
		}

		if ($params['alignment'] !== '') {
			$content_style[] = 'text-align:'. $params['alignment'];
		}


		return $content_style;
	}

}
