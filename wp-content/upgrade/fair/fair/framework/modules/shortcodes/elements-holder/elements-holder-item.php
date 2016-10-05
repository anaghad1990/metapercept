<?php
namespace FairEdge\Modules\Shortcodes\ElementsHolderItem;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class ElementsHolderItem implements ShortcodeInterface{
	private $base;

	function __construct() {
		$this->base = 'edgtf_elements_holder_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Elements Holder Item', 'fair'),
					'base' => $this->base,
					'as_child' => array('only' => 'edgtf_elements_holder'),
					'as_parent' => array('except' => 'edgtf_elements_holder'),
					'content_element' => true,
					'category' => 'by EDGE',
					'icon' => 'icon-wpb-elements-holder-item extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view' => 'VcColumnView',
					'params' => array(
						array(
							'type' => 'colorpicker',
							'class' => '',
							'heading' => 'Background Color',
							'param_name' => 'background_color',
							'value' => '',
							'description' => ''
						),
						array(
							'type' => 'attach_image',
							'class' => '',
							'heading' => 'Background Image',
							'param_name' => 'background_image',
							'value' => '',
							'description' => ''
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => 'Padding',
							'param_name' => 'item_padding',
							'value' => '',
							'description' => 'Please insert padding in format 0px 10px 0px 10px'
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => 'Horizontal Alignment',
							'param_name' => 'horizontal_aligment',
							'value' => array(
								'Left'    	=> 'left',
								'Right'     => 'right',
								'Center'    => 'center'
							),
							'description' => ''
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => 'Vertical Alignment',
							'param_name' => 'vertical_alignment',
							'value' => array(
								'Middle'    => 'middle',
								'Top'    	=> 'top',
								'Bottom'    => 'bottom'
							),
							'description' => ''
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => 'Enable Rounded Tab',
							'param_name' => 'rounded_tab',
							'value' => array(
								'No' => 'no',
								'Yes' => 'yes'
							)
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => 'Enable Rounded Tab Position',
							'param_name' => 'rounded_tab_position',
							'value' => array(
								'Left'			=> 'left',
								'Right'			=> 'right'
							),
							'dependency' => array('element' => 'rounded_tab', 'value' => 'yes')
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => 'Animate Rounded Tab',
							'param_name' => 'animate_rounded_tab',
							'value' => array(
								'Yes' => 'yes',
								'No' => 'no'
							),
							'save_always' => true
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => 'Animation Name',
							'param_name' => 'animation_name',
							'value' => array(
								'No Animation' => '',
								'Fade In Upwards' => 'fade_in_up',
								'Fade In Downwards' => 'fade_in_down',
								'Fade In From Left' => 'fade_in_left',
								'Fade In From Right' => 'fade_in_right',
								'Fade In To Scale' => 'fade_in_scale'
							),
							'description' => ''
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'heading' => 'Animation Delay (ms)',
							'param_name' => 'animation_delay',
							'value' => '',
							'description' => '',
							'dependency' => array('element' => 'animation_name', 'not_empty' => true)
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'group' => 'Width & Responsiveness',
							'heading' => 'Padding on screen size between 1280px-1440px',
							'param_name' => 'item_padding_1280_1440',
							'value' => '',
							'description' => 'Please insert padding in format 0px 10px 0px 10px'
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'group' => 'Width & Responsiveness',
							'heading' => 'Padding on screen size between 1024px-1280px',
							'param_name' => 'item_padding_1024_1280',
							'value' => '',
							'description' => 'Please insert padding in format 0px 10px 0px 10px'
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'group' => 'Width & Responsiveness',
							'heading' => 'Padding on screen size between 768px-1024px',
							'param_name' => 'item_padding_768_1024',
							'value' => '',
							'description' => 'Please insert padding in format 0px 10px 0px 10px'
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'group' => 'Width & Responsiveness',
							'heading' => 'Padding on screen size between 600px-768px',
							'param_name' => 'item_padding_600_768',
							'value' => '',
							'description' => 'Please insert padding in format 0px 10px 0px 10px'
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'group' => 'Width & Responsiveness',
							'heading' => 'Padding on screen size between 480px-600px',
							'param_name' => 'item_padding_480_600',
							'value' => '',
							'description' => 'Please insert padding in format 0px 10px 0px 10px'
						),
						array(
							'type' => 'textfield',
							'class' => '',
							'group' => 'Width & Responsiveness',
							'heading' => 'Padding on Screen Size Bellow 480px',
							'param_name' => 'item_padding_480',
							'value' => '',
							'description' => 'Please insert padding in format 0px 10px 0px 10px'
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'background_color'			=> '',
			'background_image'			=> '',
			'item_padding'				=> '',
			'horizontal_aligment'		=> '',
			'vertical_alignment'		=> '',
			'rounded_tab'				=> '',
			'rounded_tab_position'		=> 'left',
			'animate_rounded_tab'		=> 'yes',
			'animation_name'			=> '',
			'animation_delay'			=> '',
			'item_padding_1280_1440'	=> '',
			'item_padding_1024_1280'	=> '',
			'item_padding_768_1024'		=> '',
			'item_padding_600_768'		=> '',
			'item_padding_480_600'		=> '',
			'item_padding_480'			=> '',
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['content']= $content;

		$rand_class = 'edgtf-elements-holder-custom-' . mt_rand(100000,1000000);

		$params['elements_holder_item_style'] = $this->getElementsHolderItemStyle($params);
		$params['elements_holder_item_rounded_tab_style'] = $this->getElementsHolderRoundedTabStyle($params);
		$params['elements_holder_item_content_style'] = $this->getElementsHolderItemContentStyle($params);
		$params['elements_holder_item_class'] = $this->getElementsHolderItemClass($params);
		$params['rounded_tab_class'] = $this->getRoundedTabClass($params);
		$params['elements_holder_item_content_class'] = $rand_class;
		$params['elements_holder_item_content_responsive'] = $this->getElementsHolderItemContentResponsiveStyle($params);
		$params['elements_holder_item_data'] = $this->getData($params);

		$html = fair_edge_get_shortcode_module_template_part('templates/elements-holder-item-template', 'elements-holder', '', $params);

		return $html;
	}


	/**
	 * Return Elements Holder Item style
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemStyle($params) {

		$element_holder_item_style = array();

		if ($params['background_color'] !== '') {
			$element_holder_item_style[] = 'background-color: ' . $params['background_color'];
		}
		if ($params['background_image'] !== '') {
			$element_holder_item_style[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';
		}

		return implode(';', $element_holder_item_style);

	}

	private function getElementsHolderRoundedTabStyle($params) {

		$element_holder_item_style = array();

		if ($params['background_color'] !== '') {
			$element_holder_item_style[] = 'fill: ' . $params['background_color'];
		}

		return implode(';', $element_holder_item_style);

	}

	/**
	 * Return Elements Holder Item Content style
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemContentStyle($params) {

		$element_holder_item_content_style = array();

		if ($params['item_padding'] !== '') {
			$element_holder_item_content_style[] = 'padding: ' . $params['item_padding'];
		}

		return implode(';', $element_holder_item_content_style);

	}

	/**
	 * Return Elements Holder Item Content Responssive style
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemContentResponsiveStyle($params) {

		$element_holder_item_responsive_style = array();

		if ($params['item_padding_1280_1440'] !== '') {
			$element_holder_item_responsive_style['item_padding_1280_1440'] = $params['item_padding_1280_1440'];
		}
		if ($params['item_padding_1024_1280'] !== '') {
			$element_holder_item_responsive_style['item_padding_1024_1280'] = $params['item_padding_1024_1280'];
		}
		if ($params['item_padding_768_1024'] !== '') {
			$element_holder_item_responsive_style['item_padding_768_1024'] = $params['item_padding_768_1024'];
		}
		if ($params['item_padding_600_768'] !== '') {
			$element_holder_item_responsive_style['item_padding_600_768'] = $params['item_padding_600_768'];
		}
		if ($params['item_padding_480_600'] !== '') {
			$element_holder_item_responsive_style['item_padding_480_600'] = $params['item_padding_480_600'];
		}
		if ($params['item_padding_480'] !== '') {
			$element_holder_item_responsive_style['item_padding_480'] = $params['item_padding_480'];
		}

		return $element_holder_item_responsive_style;

	}

	/**
	 * Return Elements Holder Item classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getElementsHolderItemClass($params) {

		$element_holder_item_class = array();

		if ($params['vertical_alignment'] !== '') {
			$element_holder_item_class[] = 'edgtf-vertical-alignment-'. $params['vertical_alignment'];
		}

		if ($params['horizontal_aligment'] !== '') {
			$element_holder_item_class[] = 'edgtf-horizontal-alignment-'. $params['horizontal_aligment'];
		}

		if ($params['animation_name'] !== '') {
			$element_holder_item_class[] = 'edgtf-animation-holder-init';
		}


		return implode(' ', $element_holder_item_class);

	}

	private function getData($params) {
		$data = array();

		if($params['animation_name'] !== '') {
			$data['data-animation-type'] = $params['animation_name'];
		}
		if ($params['animation_delay'] !== '') {
			$data['data-animation-delay'] = $params['animation_delay'];
		}
		return $data;
	}

	/**
	 * Return Elements Holder Item Rounded Tab Class
	 *
	 * @param $params
	 * @return array
	 */
	private function getRoundedTabClass($params) {
		$rounded_tab_class = '';

		if($params['animate_rounded_tab'] == 'yes') {
			$rounded_tab_class = 'edgtf-animate-rounded-tab';
		}

		return $rounded_tab_class;

	}
}
