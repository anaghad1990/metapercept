<?php
namespace FairEdge\Modules\Shortcodes\DevicePresentation;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class DevicePresentation implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_device_presentation';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Device Presentation', 'fair'),
			'base' => $this->base,
			'icon' => 'icon-wpb-device-presentation extended-custom-icon',
			'category' => 'by EDGE',
			'params' => array(
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Title',
					'param_name'	=> 'title',
					'admin_label'	=> true,
					'group'	=> 'Typography'
				),
				array(
					'type' => 'textfield',
					'heading' => 'Italicize Words',
					'param_name' => 'italicized_words',
					'value' => '',
					'description' => 'Enter the position in the string (in number form) of the words you would like to italicize separated by comma (for example, if you would like to italicize the word "or" in "Video or Picture", you would enter the number "2")',
					'group'	=> 'Typography'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Description',
					'param_name'	=> 'description',
					'group'	=> 'Typography'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Title Color',
					'param_name' => 'title_color',
					'description' => '',
					'group'	=> 'Typography',
	                'dependency' => array('element' => 'title', 'not_empty' => true),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Title Font Size',
					'param_name'	=> 'title_font_size',
					'group'	=> 'Typography',
	                'dependency' => array('element' => 'title', 'not_empty' => true),
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Description Color',
					'param_name' => 'description_color',
					'description' => '',
					'group'	=> 'Typography',
	                'dependency' => array('element' => 'description', 'not_empty' => true),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Description Font Size',
					'param_name'	=> 'description_font_size',
					'group'	=> 'Typography',
	                'dependency' => array('element' => 'description', 'not_empty' => true),
				),
				array(
					'type'			=> 'attach_image',
					'heading'		=> 'Desktop Image',
					'param_name'	=> 'desktop_image',
					'description'	=> 'This image will be set inside the desktop frame.',
					'group'	=> 'Devices'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Link',
					'param_name'	=> 'desktop_image_link',
					'description'	=> 'Enter an external URL to link to.',
					'group'	=> 'Devices'
				),
				array(
				    'type'       => 'dropdown',
				    'heading'    => 'Target',
				    'param_name' => 'desktop_image_target',
				    'value'      => array(
				        ''      => '',
				        'Self'  => '_self',
				        'Blank' => '_blank'
				    ),
				    'dependency' => array('element' => 'desktop_image_link', 'not_empty' => true),
					'group'	=> 'Devices'
				),
				array(
					'type'			=> 'attach_image',
					'heading'		=> 'Laptop Image',
					'param_name'	=> 'laptop_image',
					'description'	=> 'This image will be set inside the laptop frame.',
					'group'	=> 'Devices'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Link',
					'param_name'	=> 'laptop_image_link',
					'description'	=> 'Enter an external URL to link to.',
					'group'	=> 'Devices'
				),
				array(
				    'type'       => 'dropdown',
				    'heading'    => 'Target',
				    'param_name' => 'laptop_image_target',
				    'value'      => array(
				        ''      => '',
				        'Self'  => '_self',
				        'Blank' => '_blank'
				    ),
				    'dependency' => array('element' => 'laptop_image_link', 'not_empty' => true),
					'group'	=> 'Devices'
				),
				array(
					'type'			=> 'attach_image',
					'heading'		=> 'Tablet Image',
					'param_name'	=> 'tablet_image',
					'description'	=> 'This image will be set inside the tablet frame.',
					'group'	=> 'Devices'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Link',
					'param_name'	=> 'tablet_image_link',
					'description'	=> 'Enter an external URL to link to.',
					'group'	=> 'Devices'
				),
				array(
				    'type'       => 'dropdown',
				    'heading'    => 'Target',
				    'param_name' => 'tablet_image_target',
				    'value'      => array(
				        ''      => '',
				        'Self'  => '_self',
				        'Blank' => '_blank'
				    ),
				    'dependency' => array('element' => 'tablet_image_link', 'not_empty' => true),
					'group'	=> 'Devices',
				),
				array(
					'type'			=> 'attach_image',
					'heading'		=> 'Phone Image',
					'param_name'	=> 'phone_image',
					'description'	=> 'This image will be set inside the phone frame.',
					'group'	=> 'Devices'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Link',
					'param_name'	=> 'phone_image_link',
					'description'	=> 'Enter an external URL to link to.',
					'group'	=> 'Devices'
				),
				array(
				    'type'       => 'dropdown',
				    'heading'    => 'Target',
				    'param_name' => 'phone_image_target',
				    'value'      => array(
				        ''      => '',
				        'Self'  => '_self',
				        'Blank' => '_blank'
				    ),
				    'dependency' => array('element' => 'phone_image_link', 'not_empty' => true),
					'group'	=> 'Devices'
				),
				array(
				    'type'       => 'attach_image',
				    'heading'    => 'Background Image',
				    'param_name' => 'background_image',
					'group'	=> 'Design Options'
				),
				array(
				    'type'       => 'dropdown',
				    'heading'    => 'Image Infinite Scroll Effect',
				    'param_name' => 'infinite_scroll_effect',
					'admin_label'	=> true,
				    'value'      => array(
				        'Yes'  => 'yes',
				        'No' => 'no'
				    ),
				    'save_always' => true,
					'description' => 'Infinite horizontal scroll effect for the background_image.',
				    'dependency' => array('element' => 'background_image', 'not_empty' => true),
					'group'	=> 'Design Options',
				),
				array(
				    'type'       => 'dropdown',
				    'heading'    => 'Devices Appear Effect',
				    'param_name' => 'devices_appear_effect',
					'admin_label'	=> true,
				    'value'      => array(
				        'Yes'  => 'yes',
				        'No' => 'no'
				    ),
				    'save_always' => true,
					'group'	=> 'Design Options',
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Content Top Offset',
					'param_name'	=> 'content_top_offset',
					'admin_label'	=> true,
					'group'	=> 'Design Options',
					'description' => 'Specify a pixel value.',
				    'dependency' => array('element' => 'background_image', 'not_empty' => true),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'HiDPI Laptop Content Top Offset',
					'param_name'	=> 'hidpi_laptop_content_top_offset',
					'admin_label'	=> true,
					'group'	=> 'Responsive Design Options',
					'description' => 'Devices with 1440px wide screens.',
				    'dependency' => array('element' => 'background_image', 'not_empty' => true),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'MDPI Laptop Content Top Offset',
					'param_name'	=> 'mdpi_laptop_content_top_offset',
					'admin_label'	=> true,
					'group'	=> 'Responsive Design Options',
					'description' => 'Devices with 1280px wide screens.',
				    'dependency' => array('element' => 'background_image', 'not_empty' => true),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Tablet Landscape Content Top Offset',
					'param_name'	=> 'tablet_landscape_content_top_offset',
					'admin_label'	=> true,
					'group'	=> 'Responsive Design Options',
					'description' => 'Devices with 1024px wide screens.',
				    'dependency' => array('element' => 'background_image', 'not_empty' => true),
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Tablet Portrait Content Top Offset',
					'param_name'	=> 'tablet_portrait_content_top_offset',
					'admin_label'	=> true,
					'group'	=> 'Responsive Design Options',
					'description' => 'Devices with 768px wide screens.',
				    'dependency' => array('element' => 'background_image', 'not_empty' => true),
				),
			)
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'title'	=> '',
			'title_color' => '',
			'title_font_size' => '',
			'italicized_words' => '',
			'description' => '',
			'description_color' => '',
			'description_font_size' => '',
			'desktop_image'	=> '',
			'desktop_image_link' => '',
			'desktop_image_target' => '',
			'laptop_image'	=> '',
			'laptop_image_link' => '',
			'laptop_image_target' => '',
			'tablet_image'	=> '',
			'tablet_image_link'	=> '',
			'tablet_image_target'	=> '',
			'phone_image'	=> '',
			'phone_image_link'	=> '',
			'phone_image_target'	=> '',
			'background_image' => '',
			'devices_appear_effect' => '',
			'infinite_scroll_effect' => '',
			'content_top_offset' => '',
			'hidpi_laptop_content_top_offset' => '',
			'mdpi_laptop_content_top_offset' => '',
			'tablet_landscape_content_top_offset' => '',
			'tablet_portrait_content_top_offset' => ''
		);

		$params = shortcode_atts($args, $atts);

		$params['title_italicized'] = $this->getTitleItalicized($params);
		$params['title_style'] = $this->getTitleStyle($params);
		$params['description_style'] = $this->getDescriptionStyle($params);
		$params['shortcode_classes'] = $this->getShortcodeClasses($params);
		$params['shortcode_style'] = $this->getShortcodeStyle($params);
		$params['shortcode_data'] = $this->getShortcodeData($params);
		$params['content_style'] = $this->getContentStyle($params);

		$html = fair_edge_get_shortcode_module_template_part('templates/device-presentation-template', 'device-presentation', '', $params);

		return $html;

	}


	/**
	 * Return Title Italic params
	 *
	 * @param $params
	 * @return string
	 */
	private function getTitleItalicized($params) {
		$title_array = explode(' ', $params['title']);
		$words = explode(',', $params['italicized_words']);

		if (is_array($title_array) && count($title_array) && is_array($words) && count($words)){
			foreach ($words as $number) {
				if (is_numeric($number)){
					$title_array[$number - 1] = '<span class="edgtf-italicize">'.$title_array[$number - 1].'</span>';
				}
			}
		}

		return implode(' ', $title_array);
	}

	/**
	 * Return Title style
	 *
	 * @param $params
	 * @return string
	 */
	private function getTitleStyle($params) {
		$style = array();

		if ($params['title_color'] !== ''){
			$style[] = 'color:'.$params['title_color'];
		}

		if ($params['title_font_size'] !== ''){
			$style[] = 'font-size:'. fair_edge_filter_px($params['title_font_size']).'px';
		}

		return implode(';', $style);
	}

	/**
	 * Return Description style
	 *
	 * @param $params
	 * @return string
	 */
	private function getDescriptionStyle($params) {
		$style = array();

		if ($params['description_color'] !== ''){
			$style[] = 'color:'.$params['description_color'];
		}

		if ($params['description_font_size'] !== ''){
			$style[] = 'font-size:'. fair_edge_filter_px($params['description_font_size']).'px';
		}

		return implode(';', $style);
	}

	/**
	 * Generates classes for Device Presentation shortcode
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getShortcodeClasses($params){

		$shortcode_classes = array();

		if($params['background_image'] !== ''){
			$shortcode_classes[] = 'edgtf-background-image-set';

			if($params['infinite_scroll_effect'] == 'yes'){
				$shortcode_classes[] = 'edgtf-infinite-scroll-effect';
			}
		}

		if($params['devices_appear_effect'] == 'yes'){
			$shortcode_classes[] = 'edgtf-devices-appear-effect';
		}

		return implode(' ', $shortcode_classes);
	}

	/**
	 * Return shortcode style
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getShortcodeStyle($params){

		$shortcode_style = array();

		if($params['content_top_offset'] !== ''){
			$shortcode_style[] = 'padding-bottom:' .fair_edge_filter_px($params['content_top_offset']).'px';
		}

		return implode(' ', $shortcode_style);
	}

	/**
	 * Return shortcode data
	 *
	 * @param $params
	 * @return array
	 */
	private function getShortcodeData($params) {

		$shortcode_data = array();

		if (!empty($params['hidpi_laptop_content_top_offset'])) {
			$shortcode_data['data-hidpi'] = $params['hidpi_laptop_content_top_offset'];;
		}

		if (!empty($params['mdpi_laptop_content_top_offset'])) {
			$shortcode_data['data-mdpi'] = $params['mdpi_laptop_content_top_offset'];;
		}

		if (!empty($params['tablet_landscape_content_top_offset'])) {
			$shortcode_data['data-tablet-landscape'] = $params['tablet_landscape_content_top_offset'];;
		}

		if (!empty($params['tablet_portrait_content_top_offset'])) {
			$shortcode_data['data-tablet-portrait'] = $params['tablet_portrait_content_top_offset'];;
		}

		return $shortcode_data;

	}

	/**
	 * Return content style
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getContentStyle($params){

		$content_style = array();

		if($params['content_top_offset'] !== ''){
			$content_style[] = '-webkit-transform: translateY('.fair_edge_filter_px($params['content_top_offset']).'px);';
			$content_style[] = 'transform: translateY('.fair_edge_filter_px($params['content_top_offset']).'px);';
		}

		return implode(' ', $content_style);
	}

}