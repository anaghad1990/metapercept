<?php
namespace FairEdge\Modules\Shortcodes\SectionTitle;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class SectionTitle
 */
class SectionTitle implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_section_title';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/*
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see edgt_core_get_carousel_slider_array_vc()
	 */
	 
	public function vcMap() {

		vc_map(
			array(
				'name' => esc_html__('Section Title', 'fair'),
				'base' => $this->base,
				'category' => 'by EDGE',
				'icon' => 'icon-wpb-section-title extended-custom-icon',
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => 'Title',
						'param_name' => 'title',
						'value' => '',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Italicize Words',
						'param_name' => 'italicized_words',
						'value' => '',
						'description' => 'Enter the position in the string (in number form) of the words you would like to italicize separated by comma (for example, if you would like to italicize the word "or" in "Video or Picture", you would enter the number "2")'
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
                        'dependency' => array('element' => 'title', 'not_empty' => true)
                    ),
					array(
						'type' => 'colorpicker',
						'heading' => 'Color',
						'param_name' => 'color',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Link',
						'param_name' => 'link',
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'heading' => 'Link Target',
						'param_name' => 'link_target',
						'value' => array(
							'Blank' => '_blank',
							'Self' => '_self'
						),
						'dependency' => array('element' => 'link', 'not_empty' => true),
						'description' => ''
					),
				)
			)
		);
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'title' => '',
			'italicized_words' => '',
			'title_tag' => 'h2',
			'color' => '',
			'link' => '',
			'link_target' => '_blank'
		);

		$params = shortcode_atts($args, $atts);

		$params['title_italicized'] = $this->getTitleItalicized($params);
		$params['title_style'] = $this->getTitleStyle($params);

		//Get HTML from template
		$html = fair_edge_get_shortcode_module_template_part('templates/section-title-template', 'section-title', '', $params);

		return $html;

	}

	/**
	 * Return Style for Dropcaps
	 *
	 * @param $params
	 * @return string
	 */
	private function getTitleItalicized($params) {
		$title_array = explode(' ', $params['title']);
		$words = explode(',', $params['italicized_words']);

		if (is_array($title_array) && count($title_array) && is_array($words) && count($words)){
			foreach ($words as $number) {
				if (is_numeric($number) && count($title_array) >= $number){
					$title_array[$number - 1] = '<span class="edgtf-section-ital">'.$title_array[$number - 1].'</span>';
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

		if ($params['color'] !== ''){
			$style[] = 'color:'.$params['color'];
		}

		return implode(';', $style);
	}
}