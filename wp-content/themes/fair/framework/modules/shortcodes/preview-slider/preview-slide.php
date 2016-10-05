<?php
namespace FairEdge\Modules\Shortcodes\PreviewSlide;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class PreviewSlide implements ShortcodeInterface{
	private $base;

	function __construct() {
		$this->base = 'edgtf_preview_slide';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Preview Slide', 'fair'),
					'base' => $this->base,
					'as_child' => array('only' => 'edgtf_preview_slider'),
					'content_element' => true,
					'category' => 'by EDGE',
					'icon' => 'icon-wpb-preview-slide extended-custom-icon',
					'show_settings_on_create' => true,
					'params' => array(
						array(
							'type' => 'attach_image',
							'heading' => 'Laptop Image',
							'param_name' => 'ps_laptop_image'
						),
						array(
							'type' => 'attach_image',
							'heading' => 'Tablet Image',
							'param_name' => 'ps_tablet_image'
						),
						array(
							'type' => 'attach_image',
							'heading' => 'Mobile Image',
							'param_name' => 'ps_mobile_image'
						),
						array(
							'type' => 'textfield',
							'heading' => 'Title',
							'param_name' => 'title',
							'admin_label' => true
						),
						array(
							'type' => 'textfield',
							'heading' => 'Subtitle',
							'param_name' => 'subtitle',
							'admin_label' => true
						),
						array(
							'type' => 'textarea',
							'heading' => 'Text',
							'param_name' => 'text',
							'admin_label' => true
						),
						array(
							'type' => 'textfield',
							'heading' => 'Link',
							'param_name' => 'ps_link',
							'admin_label' => true
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Link Target',
							'param_name' => 'ps_target',
							'value' => array(
								'Self' => '_self',
								'Blank' => '_blank'
							),
							'save_always' => true
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'ps_laptop_image'	=> '',
			'ps_tablet_image'	=> '',
			'ps_mobile_image'	=> '',
			'title'				=> '',
			'subtitle'			=> '',
			'text'				=> '',
			'ps_link'				=> '',
			'ps_target'			=> '_self'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['content']= $content;

		$html = fair_edge_get_shortcode_module_template_part('templates/preview-slide-template', 'preview-slider', '', $params);

		return $html;
	}




}
