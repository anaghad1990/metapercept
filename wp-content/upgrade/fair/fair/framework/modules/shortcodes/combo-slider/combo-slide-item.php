<?php
namespace FairEdge\Modules\Shortcodes\ComboSlideItem;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class ComboSlideItem implements ShortcodeInterface{
	private $base;

	function __construct() {
		$this->base = 'edgtf_combo_slide_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Combo Slide Item', 'fair'),
					'base' => $this->base,
					'as_child' => array('only' => 'edgtf_combo_slider'),
					'category' => 'by EDGE',
					'icon' => 'icon-wpb-combo-slide-item extended-custom-icon',
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => 'Title',
							'param_name' => 'title',
							'value' => '',
							'description' => ''
						),
						array(
							'type'       => 'dropdown',
							'heading'    => 'Title Tag',
							'param_name' => 'title_tag',
							'value'      => array(
								''   => '',
								'h2' => 'h2',
								'h3' => 'h3',
								'h4' => 'h4',
								'h5' => 'h5',
								'h6' => 'h6',
							),
							'dependency' => array('element' => 'title', 'not_empty' => true),
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => 'Show Separator',
							'param_name' => 'separator',
							'value' => array(
								'Default' => '',
								'Yes'     => 'yes',
								'No'      => 'no'
							),
							'description' => ''
						),
						array(
							'type' => 'textarea',
							'heading' => 'Text',
							'param_name' => 'text',
							'value' => '',
							'description' => ''
						),
						array(
							'type' => 'textfield',
							'heading' => 'Title and Text Padding',
							'param_name' => 'content_padding',
							'value' => '',
							'description' => 'Please insert padding in format 0px 10px 0px 10px'
						),
						array(
							'type' => 'attach_image',
							'heading' => 'Hero Image',
							'param_name' => 'image',
							'value' => '',
							'description' => ''
						),
						array(
							'type' => 'textfield',
							'heading' => 'Hero Image link',
							'param_name' => 'image_link',
							'value' => '',
							'dependency' => array('element' => 'image', 'not_empty' => true),
						),
						array(
							'type' => 'attach_image',
							'heading' => 'Aux Image',
							'param_name' => 'aux_image',
							'value' => '',
							'description' => '',
							'dependency' => array('element' => 'image', 'not_empty' => true),
						),
						array(
							'type' => 'textfield',
							'heading' => 'Aux Image link',
							'param_name' => 'aux_image_link',
							'value' => '',
							'dependency' => array('element' => 'aux_image', 'not_empty' => true),
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Link Target',
							'param_name' => 'link_target',
							'value' => array(
								'Blank'     => '_blank',
								'Self'      => '_self'
							),
							'save_always' => true,
							'description' => '',
							'dependency' => array('element' => 'image_link', 'not_empty' => true),
						),
						array(
							'type'			=> 'textfield',
							'heading'		=> 'Image Sizes',
							'param_name'	=> 'image_size',
							'description'	=> 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size'
						),
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'title'				=> '',
			'title_tag'			=> 'h2',
			'separator'			=> 'yes',
			'text'				=> '',
			'content_padding'	=> '',
			'image'				=> '',
			'image_link'		=> '',
			'aux_image'			=> '',
			'aux_image_link'	=> '',
			'link_target'		=> '',
			'image_size'		=> '',
		);
		
		$params = shortcode_atts($args, $atts);

		extract($params);

		$params['content_style'] = $this->getContentStyle($params);
		$params['image_size'] = $this->getImageSize($params['image_size']);

		$html = fair_edge_get_shortcode_module_template_part('templates/combo-item-template', 'combo-slider', '', $params);

		return $html;
	}



	/**
	 * Return Content Style
	 *
	 * @param $params
	 * @return string
	 */
	private function getContentStyle($params) {

		$content_style = array();

		if ($params['content_padding'] !== '') {

			$content_style[] = 'padding: '.$params['content_padding'];
		}

		return implode('; ', $content_style);

	}

	/**
	 * Return image size or custom image size array
	 *
	 * @param $image_size
	 * @return array
	 */
	private function getImageSize($image_size) {

		$image_size = trim($image_size);
		//Find digits
		preg_match_all( '/\d+/', $image_size, $matches );
		if(in_array( $image_size, array('thumbnail', 'thumb', 'medium', 'large', 'full'))) {
			return $image_size;
		} elseif(!empty($matches[0])) {
			return array(
					$matches[0][0],
					$matches[0][1]
			);
		} else {
			return 'thumbnail';
		}
	}
}
