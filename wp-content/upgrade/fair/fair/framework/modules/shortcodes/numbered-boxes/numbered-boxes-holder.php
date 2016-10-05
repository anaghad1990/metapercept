<?php
namespace FairEdge\Modules\Shortcodes\NumberedBoxes;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class NumberedBoxes implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_numbered_boxes';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Numbered Boxes Holder', 'fair'),
			'base' => $this->base,
			'icon' => 'icon-wpb-numbered-boxes-holder extended-custom-icon',
			'category' => 'by EDGE',
			'as_parent' => array('only' => 'edgtf_numbered_box'),
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => 'Boxes Number',
					'param_name' => 'boxes_number',
					'value' => array(
						'Three' => '3',
						'Two' => '2',
					),
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Boxes Layout',
					'param_name' => 'boxes_layout',
					'value' => array(
						'50-50' => '50-50',
						'66-33' => '66-33',
						'33-66' => '33-66'
					),
					'dependency' => array('element' => 'boxes_number','value' => '2')
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Interactivity',
					'param_name' => 'interactivity',
					'value' => array(
						'Yes' => 'yes',
						'No' => 'no',
					),
					'description' => '',
					'save_always' => true
				)
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'boxes_number'		=> '3',
			'boxes_layout'		=> '50-50',
			'interactivity'		=> 'yes',
		);
		
		$params = shortcode_atts($args, $atts);


		$boxes_number_array = $this->getBoxesNumberParams($params);
		$params['number_class'] = $boxes_number_array['class'];

		$classes = $this->getBoxesHolderClasses($params);

		$html = '';

		$html .= '<div '.fair_edge_get_class_attribute($classes).' '.$boxes_number_array['data-number'].' '.$boxes_number_array['data-interactivity'].'>';
			$html .= do_shortcode($content);
		$html .= '</div>';

		return $html;

	}

	/**
	 * Return Boxes holder classes
	 * 
	 * @param $params
	 * @return string
	**/
	private function getBoxesHolderClasses($params){
		$holder_classes = array();
		$holder_classes[] = 'edgtf-numbered-boxes-holder';

		if ($params['number_class'] !== ''){
			$holder_classes[] = $params['number_class'];
		}

		if ($params['boxes_number'] == '2' && $params['boxes_layout'] !== ''){
			$holder_classes[] = 'edgtf-numbered-layout-'.$params['boxes_layout'];
		}

		return implode(' ', $holder_classes);
	}

	/**
	 * Return Boxes number needed params
	 *
	 * @param $params
	 * @return array
	**/
	private function getBoxesNumberParams($params){
		$boxes_number_array = array();
		$number = $params['boxes_number'];
		$interactivity = $params['interactivity'];

		if ($number !== ''){
			$boxes_number_array['data-number'] = 'data-number='.$number;
			switch ($number) {
				case '3':
					$boxes_number_array['class'] = 'edgtf-three-columns';
					break;
				case '2':
					$boxes_number_array['class'] = 'edgtf-two-columns';
					break;
				default:
					$boxes_number_array['class'] = 'edgtf-three-columns';
					break;
			}
		}

		if ($interactivity != '') {
			$boxes_number_array['data-interactivity'] = 'data-interactivity='.$interactivity;
		}

		return $boxes_number_array;
	}

}
