<?php
namespace FairEdge\Modules\Shortcodes\SectionSubtitle;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class SectionSubtitle
 */
class SectionSubtitle implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_section_subtitle';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see edgt_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map( array(
				'name' => esc_html__('Section Subtitle', 'fair'),
				'base' => $this->getBase(),
				'category' => 'by EDGE',
				'icon' => 'icon-wpb-section-subtitle extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params' => array(
					array(
						'type'			=> 'textfield',
						'heading'		=> 'Subtitle Text',
						'param_name'	=> 'subtitle_text',
						'value'			=> '',
						'admin_label'	=> true
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> 'Text Align',
						'param_name'	=> 'text_align',
						'value'			=> array(
							''			=> '',
							'Left'		=> 'left',
							'Center'	=> 'center',
							'Right'		=> 'right',
							'Justify'	=> 'justify'
						)
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => 'Text Color',
						'param_name'  => 'text_color',
						'admin_label' => true
					),
				)
		) );
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'subtitle_text' => '',
			'text_align'	=> '',
			'text_color'	=> ''
		);

		$params = shortcode_atts($args, $atts);

		$params['subtitle_style'] = array();
		if($params['text_align'] != '') {
			$params['subtitle_style'][] = 'text-align:' . $params['text_align'];
		}
		if($params['text_color'] != '') {
			$params['subtitle_style'][] = 'color:' . $params['text_color'];
		}
		//Get HTML from template
		$html = fair_edge_get_shortcode_module_template_part('templates/section-subtitle-template', 'section-subtitle', '', $params);

		return $html;

	}


}