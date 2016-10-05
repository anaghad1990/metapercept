<?php
namespace FairEdge\Modules\Shortcodes\Client;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class Client implements ShortcodeInterface{
	private $base;

	function __construct() {
		$this->base = 'edgtf_client';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => 'Client', 'fair',
					'base' => $this->base,
					'content_element' => true,
					'icon' => 'icon-wpb-client extended-custom-icon',
					'as_child' => array('only' => 'edgtf_clients'),
					'params' => array(
						array(
							'type' => 'attach_image',
							'heading' => 'Image',
							'param_name' => 'image'
						),
						array(
							'type' => 'attach_image',
							'heading' => 'Hover Image',
							'param_name' => 'hover_image',
							'dependency' => Array('element' => 'image', 'not_empty' => true)
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Hover Type',
							'param_name' => 'hover_type',
							'value' => array(
								'Roll Over' => 'roll-over',
								'Fade' => 'fade'
							),
							'save_always' => true,
							'dependency' => Array('element' => 'hover_image', 'not_empty' => true)
						),
						array(
							'type' => 'textfield',
							'heading' => 'Link',
							'param_name' => 'link'
						),
						array(
							'type' => 'dropdown',
							'heading' => 'Link Target',
							'param_name' => 'link_target',
							'value' => array(
								'' => '',
								'Self' => '_self',
								'Blank' => '_blank'
							)
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'image' => '',
			'hover_image' => '',
			'hover_type' => '',
			'link' => '',
			'link_target' => ''
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['content']= $content;


		if(is_numeric($params['image'])) {
			$params['image'] = wp_get_attachment_url($params['image']);
			$params['image_alt'] = esc_attr(get_post_meta($params['image'], '_wp_attachment_image_alt', true));
		}
		if(is_numeric($params['hover_image'])) {
			$params['hover_image'] = wp_get_attachment_url($params['hover_image']);
			$params['hover_image_alt'] = esc_attr(get_post_meta($params['hover_image'], '_wp_attachment_image_alt', true));
		}

		if($params['hover_type'] !== '') {
			$params['class'] = 'edgtf-clients-' . $hover_type;
		} else {
			$params['class'] = 'edgtf-hover-opacity';
		}

		if($params['link_target'] == ''){
			$params['link_target'] = '_self';
		}

		$html = fair_edge_get_shortcode_module_template_part('templates/client-template', 'clients', '', $params);

		return $html;
	}

}
