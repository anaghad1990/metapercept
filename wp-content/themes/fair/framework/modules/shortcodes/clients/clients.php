<?php
namespace FairEdge\Modules\Shortcodes\Clients;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Clients
 */

class Clients implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_clients';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name' => 'Clients', 'fair',
			'base' => $this->base,
			'as_parent' => array('only' => 'edgtf_client'),
			'content_element' => true,
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-clients extended-custom-icon',
			'show_settings_on_create' => true,
			'params' => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Columns',
					'param_name' => 'columns',
					'value' => array(
						'Two'       => 'two-columns',
						'Three'     => 'three-columns',
						'Four'      => 'four-columns',
						'Five'      => 'five-columns',
						'Six'       => 'six-columns'
					),
					'save_always' => true,
					'description' => ''
				)
			),
			'js_view' => 'VcColumnView'

		));
	}

	public function render($atts, $content = null) {
	
		$args = array(
			'columns' 			=> ''
		);
		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['content']= $content;
		$html						= '';

		$html = fair_edge_get_shortcode_module_template_part('templates/clients-template', 'clients', '', $params);

		return $html;

	}

}
