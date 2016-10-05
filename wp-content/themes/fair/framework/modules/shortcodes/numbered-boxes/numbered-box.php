<?php
namespace FairEdge\Modules\Shortcodes\NumberedBox;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class NumberedBox implements ShortcodeInterface{
	private $base;

	function __construct() {
		$this->base = 'edgtf_numbered_box';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Numbered Box', 'fair'),
					'base' => $this->base,
					'as_child' => array('only' => 'edgtf_numbered_boxes'),
					'category' => 'by EDGE',
					'icon' => 'icon-wpb-numbered-box extended-custom-icon',
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => 'Title',
							'param_name' => 'title',
							'value' => '',
							'admin_label' => true
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
							'group' => 'Design Options'
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => 'Title Color',
							'param_name' => 'title_color',
							'value'      => '',
							'dependency' => array('element' => 'title', 'not_empty' => true),
							'group' => 'Design Options'
						),
						array(
							'type' => 'textfield',
							'heading' => 'Subtitle',
							'param_name' => 'subtitle',
							'value' => '',
							'admin_label' => true
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => 'Subtitle Color',
							'param_name' => 'subtitle_color',
							'value'      => '',
							'dependency' => array('element' => 'subtitle', 'not_empty' => true),
							'group' => 'Design Options'
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
							)
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => 'Separator Color',
							'param_name' => 'separator_color',
							'value'      => '',
							'dependency' => array('element' => 'separator', 'value' => array('','yes')),
							'group' => 'Design Options'
						),
						array(
							'type' => 'textarea',
							'heading' => 'Text',
							'param_name' => 'text',
							'value' => '',
							'admin_label' => true
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => 'Text Color',
							'param_name' => 'text_color',
							'value'      => '',
							'dependency' => array('element' => 'text', 'not_empty' => true),
							'group' => 'Design Options'
						),
						array(
							'type' => 'textfield',
							'heading' => 'Number',
							'param_name' => 'number',
							'value' => '',
							'admin_label' => true
						),
						array(
							'type'       => 'colorpicker',
							'heading'    => 'Number Color',
							'param_name' => 'number_color',
							'value'      => '',
							'dependency' => array('element' => 'number', 'not_empty' => true),
							'group' => 'Design Options'
						),
						array(
							'type' => 'textfield',
							'heading' => 'Link',
							'param_name' => 'link',
							'value' => '',
							'description' => ''
						),
						array(
							'type'        => 'dropdown',
							'heading'     => 'Link Target',
							'param_name'  => 'link_target',
							'value'       => array(
								'Blank' => '_blank',
								'Self'  => '_self',
							),
							'save_always' => true,
							'dependency'  => array('element' => 'link', 'not_empty' => true)
						),
						array(
							'type' => 'textfield',
							'heading' => 'Padding',
							'param_name' => 'content_padding',
							'value' => '',
							'description' => 'Please insert padding in format 0px 10px 0px 10px',
							'group' => 'Design Options'
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => 'Alignment',
							'param_name' => 'align',
							'value' => array(
								'Left'    => 'left',
								'Center'  => 'center',
								'Right'   => 'right'
							),
							'description' => '',
							'group' => 'Design Options'
						),
						array(
							'type' => 'dropdown',
							'class' => '',
							'heading' => 'Vertical Alignment',
							'param_name' => 'vertical_align',
							'value' => array(
								'Middle'  => 'middle',
								'Top'     => 'top',
								'Bottom'  => 'bottom'
							),
							'description' => '',
							'group' => 'Design Options'
						),
						array(
							'type' => 'colorpicker',
							'heading' => 'Background Color',
							'param_name' => 'background_color',
							'value' => '',
							'group' => 'Design Options',
							'save_always' => true
						),
						array(
							'type' => 'attach_image',
							'heading' => 'Background Image',
							'param_name' => 'background_image',
							'value' => '',
							'group' => 'Design Options',
							'save_always' => true
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'title'				=> '',
			'title_tag'			=> 'h3',
			'title_color'		=> '',
			'subtitle'			=> '',
			'subtitle_color'	=> '',
			'separator'			=> 'yes',
			'separator_color'	=> '',
			'text'				=> '',
			'text_color'		=> '',
			'number'			=> '',
			'number_color'		=> '',
			'link'				=> '',
			'link_target'		=> '_blank',
			'content_padding'	=> '',
			'align'				=> 'left',
			'vertical_align'	=> 'middle',
			'background_color'	=> '',
			'background_image'	=> '',
		);
		
		$params = shortcode_atts($args, $atts);


		$params['separator_params'] = $this->getSeparatorParams($params);
		$params['content_style'] = $this->getContentStyle($params);
		$params['content_class'] = $this->getContentClass($params);
		$params['background_style'] = $this->getBackgroundStyle($params);
		$params['title_style'] = $this->getTitleStyle($params);
		$params['subtitle_style'] = $this->getSubtitleStyle($params);
		$params['text_style'] = $this->getTextStyle($params);
		$params['number_style'] = $this->getNumberStyle($params);

		$html = fair_edge_get_shortcode_module_template_part('templates/numbered-box-template', 'numbered-boxes', '', $params);

		return $html;
	}


	/**
	 * Return Separator Parameters
	 *
	 * @param $params
	 * @return array
	 */
	private function getSeparatorParams($params) {

		$separator_params = array();

		if ($params['separator'] == 'yes') {

			if ($params['separator_color'] !== ''){
				$separator_params['color'] = $params['separator_color'];
			}

			if ($params['align'] !== '') {
				$separator_params['position'] = $params['align'];
			}
		}

		return $separator_params;

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

	/*
	* Return Background Style
	*/
	private function getBackgroundStyle($params) {
		$background_style = array();

		if ($params['background_color'] !== ''){
			$background_style[] = 'background-color: '.$params['background_color'];
		}

		if ($params['background_image'] !== ''){
			$background_style[] = 'background-image: url(' . wp_get_attachment_url($params['background_image']) . ')';
		}

		return implode('; ', $background_style);

	}
	/**
	 * Return Content Class
	 *
	 * @param $params
	 * @return string
	 */
	private function getContentClass($params) {

		$content_class = array();

		if ($params['align'] !== '') {

			$content_class[] = 'edgtf-horizontal-alignment-'.$params['align'];
		}

		if ($params['vertical_align'] !== ''){
			$content_class[] = 'edgtf-vertical-alignment-'.$params['vertical_align'];
		}

		return implode(' ', $content_class);

	}

	/**
	 * Return Title Style
	 *
	 * @param $params
	 * @return string
	 */
	private function getTitleStyle($params) {

		$title_style = array();

		if ($params['title_color'] !== '') {

			$title_style[] = 'color: '.$params['title_color'];
		}

		return implode('; ', $title_style);
	}


	/**
	 * Return Subtitle Style
	 *
	 * @param $params
	 * @return string
	 */
	private function getSubtitleStyle($params) {

		$subtitle_style = array();

		if ($params['subtitle_color'] !== '') {

			$subtitle_style[] = 'color: '.$params['subtitle_color'];
		}

		return implode('; ', $subtitle_style);
	}

	/**
	 * Return Text Style
	 *
	 * @param $params
	 * @return string
	 */
	private function getTextStyle($params) {

		$text_style = array();

		if ($params['text_color'] !== '') {

			$text_style[] = 'color: '.$params['text_color'];
		}

		return implode('; ', $text_style);
	}

	/**
	 * Return Number Style
	 *
	 * @param $params
	 * @return string
	 */
	private function getNumberStyle($params) {

		$number_style = array();

		if ($params['number_color'] !== '') {
			$number_style[] = 'color: '.$params['number_color'];
		}

		return implode('; ', $number_style);
	}
}
