<?php
namespace FairEdge\Modules\Shortcodes\CascadingImages;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class CascadingImages implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_cascading_images';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => esc_html__('Cascading Images', 'fair'),
			'base' => $this->base,
			'icon' => 'icon-wpb-cascading-images extended-custom-icon',
			'category' => 'by EDGE',
			'params' => array(
				array(
					'type'			=> 'attach_image',
					'heading'		=> 'Laptop Image',
					'param_name'	=> 'laptop_image',
					'description'	=> 'This image will be set inside the laptop frame.'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Link',
					'param_name'	=> 'laptop_image_link',
					'description'	=> 'Enter an external URL to link to.',
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
				),
				array(
					'type'			=> 'attach_image',
					'heading'		=> 'Tablet Image',
					'param_name'	=> 'tablet_image',
					'description'	=> 'This image will be set inside the tablet frame.'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Link',
					'param_name'	=> 'tablet_image_link',
					'description'	=> 'Enter an external URL to link to.',
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
				)
			)
		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'laptop_image'	=> '',
			'laptop_image_link' => '',
			'laptop_image_target' => '',
			'tablet_image'	=> '',
			'tablet_image_link'	=> '',
			'tablet_image_target'	=> '',
		);

		$params = shortcode_atts($args, $atts);

		$html = fair_edge_get_shortcode_module_template_part('templates/cascading-images-template', 'cascading-images', '', $params);

		return $html;

	}

}
