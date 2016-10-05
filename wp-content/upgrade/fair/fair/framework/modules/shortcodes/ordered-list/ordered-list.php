<?php
namespace FairEdge\Modules\Shortcodes\OrderedList;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

class OrderedList implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'edgtf_list_ordered';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => esc_html__('List - Ordered', 'fair'),
			'base' => $this->base,
			'icon' => 'icon-wpb-ordered-list extended-custom-icon',
			'category' => 'by EDGE',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type'			=> 'textarea_html',
					'heading'		=> 'Content',
					'param_name'	=> 'content',
					'admin_label'	=> true,
					'value'			=> '<ol><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ol>',
					'description'	=> ''
				)
			)
		) );
	}

	public function render($atts, $content = null) {
		$content = preg_replace('#^<\/p>|<p>$#', '', $content);
		$html = '<div class= "edgtf-ordered-list" >' . do_shortcode($content) . '</div>';
        return $html;
	}
}