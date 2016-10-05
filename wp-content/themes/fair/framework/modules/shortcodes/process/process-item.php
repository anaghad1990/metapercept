<?php
namespace FairEdge\Modules\Shortcodes\Process;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProcessItem implements ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'edgtf_process_item';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map(array(
			'name'                    => 'Process Item',
			'base'                    => $this->getBase(),
			'as_child'                => array('only' => 'edgtf_process_holder'),
			'category'                => 'by EDGE',
			'icon'                    => 'icon-wpb-process-item extended-custom-icon',
			'show_settings_on_create' => true,
			'params'                  => array(
				array(
					'type'        => 'textfield',
					'heading'     => 'Number',
					'param_name'  => 'number',
					'admin_label' => true
				),
				array(
					'type'        => 'textfield',
					'heading'     => 'Title',
					'param_name'  => 'title',
					'admin_label' => true
				),
				array(
					'type'        => 'textarea',
					'heading'     => 'Text',
					'param_name'  => 'text',
					'admin_label' => true
				),
				array(
					'type'        => 'attach_image',
					'heading'     => 'Background Image',
					'param_name'  => 'background_image',
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => 'Hover Gradient First Color',
					'param_name'  => 'gradient_1_color',
				),
				array(
					'type'        => 'colorpicker',
					'heading'     => 'Hover Gradient Second Color',
					'param_name'  => 'gradient_2_color',
				),
				array(
					'type'        => 'dropdown',
					'heading'     => 'Highlight Item?',
					'param_name'  => 'highlighted',
					'value'       => array(
						'No'  => 'no',
						'Yes' => 'yes'
					),
					'admin_label' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$default_atts = array(
			'number' => '',
			'title' => '',
			'text' => '',
			'background_image' => '',
			'gradient_1_color' => '',
			'gradient_2_color' => '',
			'highlighted' => 'no'
		);

		$params = shortcode_atts($default_atts, $atts);

		$params['item_classes'] = array(
			'edgtf-process-item-holder'
		);
		$params['background_style'] = $this->getBackgroundStyle($params);
		$params['background_hover_style'] = $this->getBackgroundHoverStyle($params);

		if($params['highlighted'] === 'yes') {
			$params['item_classes'][] = 'edgtf-pi-highlighted';
		}

		return fair_edge_get_shortcode_module_template_part('templates/process-item-template', 'process', '', $params);
	}

	/**
	* Function that returns background  style
	*/

	private function getBackgroundStyle($params){
		$background_style = array();

		if ($params['background_image']){
			$background_style[] = 'background-image: url('.wp_get_attachment_url($params['background_image']).')';
		}

		return implode('; ', $background_style);
	}

	/**
	* Function that returns background hover style
	*/

	private function getBackgroundHoverStyle($params){
		$background_hover_style = '';
		$first_color = $params['gradient_1_color'];
		$second_color = $params['gradient_2_color'];

		if ($first_color !== '' && $second_color !== ''){
			$background_hover_style .= fair_edge_inline_background_gradient($first_color, $second_color);
		}

		return $background_hover_style;
	}

}