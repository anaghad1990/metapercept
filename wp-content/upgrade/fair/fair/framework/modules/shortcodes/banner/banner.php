<?php
namespace FairEdge\Modules\Shortcodes\Banner;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ItemShowcase
 */
class Banner implements ShortcodeInterface	{
	private $base; 
	
	function __construct() {
		$this->base = 'edgtf_banner';

		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
		* Returns base for shortcode
		* @return string
	 */
	public function getBase() {
		return $this->base;
	}	
	
    public function vcMap() {
						
		vc_map( array(
			'name' => esc_html__('Banner', 'fair'),
			'base' => $this->base,
			'category' => 'by EDGE',
			'icon' => 'icon-wpb-banner extended-custom-icon',
			'params' =>	array(
                array(
                    'type' => 'attach_image',
                    'heading' => 'Image',
                    'param_name' => 'item_image'
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
				),
                array(
                    'type' => 'textfield',
                    'heading' => 'Subtitle',
                    'admin_label' => true,                    
                    'param_name' => 'banner_subtitle',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => 'Title',
                    'admin_label' => true,                    
                    'param_name' => 'banner_title',
                ),
                array(
                    'type' => 'dropdown',
                    'class' => '',
                    'heading' => 'Show Separator',
                    'param_name' => 'banner_separator',
                    'value' => array(                        
                        'Yes'     => 'yes',
                        'No'      => 'no'
                    ),
                    'description' => ''
                ),
                array(
                    'type' => 'textfield',
                    'admin_label' => true,
                    'heading' => 'Content',
                    'param_name' => 'banner_content',
                    'description' => ''
                ),
				array(
					'type' => 'dropdown',
					'heading' => 'Image Hover',
					'param_name' => 'image_hover',
					'value' => array(
						'No Hover' => '',
						'Zoom' => 'zoom'
					),
					'dependency' => array('element' => 'item_image', 'not_empty' => true),
				)
            )
		) );

	}

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     * @return string
     */

	public function render($atts, $content = null) {
		
		$args = array(
            'item_image' => '',
            'banner_subtitle' => '',
            'banner_title' => '',
            'banner_separator' => 'yes',
            'banner_content' => '',
			'link' => '',
			'link_target' => '',
			'image_hover' => ''

        );

		$params = shortcode_atts($args, $atts);
        $params['banner_classes'] = $this->getBannerClass($params);

        extract($params);
		$params['content']= $content;

		if($params['link_target'] == ''){
			$params['link_target'] = '_self';
		}

        $html = fair_edge_get_shortcode_module_template_part('templates/banner-template', 'banner', '', $params);

        return $html;

	}

    /**
     * Return Separator classes
     *
     * @param $params
     * @return array
     */
    private function getBannerClass($params) {

        $banner_classes = array();

        if($params['banner_separator'] == 'no') {
            $banner_classes[] = 'edgtf-banner-separator-no';
        }

		if($params['image_hover'] != '') {
            $banner_classes[] = 'edgtf-bih-'.$params['image_hover'];
        }

        return implode(' ', $banner_classes);

    }

  }
