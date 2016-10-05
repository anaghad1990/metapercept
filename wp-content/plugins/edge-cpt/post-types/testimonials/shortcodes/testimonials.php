<?php

namespace EdgeCore\PostTypes\Testimonials\Shortcodes;


use EdgeCore\Lib;

/**
 * Class Testimonials
 * @package EdgeCore\PostTypes\Testimonials\Shortcodes
 */
class Testimonials implements Lib\ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    public function __construct() {
        $this->base = 'edgtf_testimonials';

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
     * Maps shortcode to Visual Composer
     *
     * @see vc_map()
     */
    public function vcMap() {
        if(function_exists('vc_map')) {
            vc_map( array(
                'name' => 'Testimonials',
                'base' => $this->base,
                'category' => 'by EDGE',
                'icon' => 'icon-wpb-testimonials extended-custom-icon',
                'allowed_container_element' => 'vc_row',
                'params' => array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Type',
						'param_name' => 'type',
						'value' => array(
							'Simple' => 'simple',
							'Carousel' => 'carousel'
						),
						'description' => ''
					),
					array(
                        'type' => 'textfield',
						'admin_label' => true,
                        'heading' => 'Category',
                        'param_name' => 'category',
                        'value' => '',
                        'description' => 'Category Slug (leave empty for all)'
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => 'Skin',
                        'param_name' => 'skin',
                        'value' => array(
                            'Dark' => 'dark',
                            'Light' => 'light',
                        )
                    ),
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => 'Number',
                        'param_name' => 'number',
                        'value' => '',
                        'description' => 'Number of Testimonials'
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Title',
                        'param_name' => 'show_title',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
						'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Author',
                        'param_name' => 'show_author',
                        'value' => array(
                            'Yes' => 'yes',
                            'No' => 'no'
                        ),
						'save_always' => true,
                        'description' => ''
                    ),
                    array(
                        'type' => 'dropdown',
                        'admin_label' => true,
                        'heading' => 'Show Author Job Position',
                        'param_name' => 'show_position',
                        'value' => array(
                            'Yes' => 'yes',
							'No' => 'no',
                        ),
						'save_always' => true,
                        'dependency' => array('element' => 'show_author', 'value' => array('yes')),
                        'description' => ''
                    ), 
                    array(
                        'type' => 'textfield',
                        'admin_label' => true,
                        'heading' => 'Animation speed',
                        'param_name' => 'animation_speed',
                        'value' => '',
                        'description' => __('Speed of slide animation in miliseconds')
                    ),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Show Arrows navigation',
						'param_name' => 'arrows_navigation',
						'value' => array(
							'Yes' => 'yes',
							'No' => 'no',
						),
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Show Dots navigation',
						'param_name' => 'dots_navigation',
						'value' => array(
							'Yes' => 'yes',
							'No' => 'no',
						),
						'description' => ''
					)
                )
            ) );
        }
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
            'type'				=> 'simple',
            'number'			=> '-1',
            'category'			=> '',
            'skin'              => 'dark',
            'show_title'		=> 'yes',
            'show_author'		=> 'yes',
            'show_position' 	=> 'yes',
            'animation_speed'	=> '',
            'arrows_navigation'	=> 'yes',
            'dots_navigation'	=> 'yes'
        );
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);

        $number = esc_attr($number);
        $category = esc_attr($category);
        $animation_speed = esc_attr($animation_speed);
		
		$data_attr = $this->getDataParams($params);
		$query_args = $this->getQueryParams($params);
        $testimonials_classes = $this->getTestimonialsClasses($params);

		$html = '';
        $html .= '<div class="edgtf-testimonials-holder clearfix">';
        $html .= '<div class="edgtf-slick-slider-navigation-style '. $testimonials_classes .'" ' . $data_attr . '>';

        query_posts($query_args);
        if (have_posts()) :
            while (have_posts()) : the_post();
                $author = get_post_meta(get_the_ID(), 'edgtf_testimonial_author', true);
                $text = get_post_meta(get_the_ID(), 'edgtf_testimonial_text', true);
                $title = get_post_meta(get_the_ID(), 'edgtf_testimonial_title', true);
                $job = get_post_meta(get_the_ID(), 'edgtf_testimonial_author_position', true);

				$params['author'] = $author;
				$params['text'] = $text;
				$params['title'] = $title;
				$params['job'] = $job;
				$params['current_id'] = get_the_ID();				
					$html .= edgt_core_get_shortcode_module_template_part('testimonials', $type . '-testimonials-template', '', $params);

            endwhile;
        else:
            $html .= __('Sorry, no posts matched your criteria.', 'edge-cpt');
        endif;

        wp_reset_query();
        $html .= '</div>';
		$html .= '</div>';
		
        return $html;
    }
	/**
    * Generates testimonial data attribute array
    *
    * @param $params
    *
    * @return string
    */
	private function getDataParams($params){
		$data_attr = '';
		
		if(!empty($params['animation_speed'])){
			$data_attr .= ' data-animation-speed ="' . $params['animation_speed'] . '"';
		}

		if(!empty($params['arrows_navigation']) && $params['arrows_navigation'] == 'no'){
			$data_attr .= ' data-arrows-navigation ="false"';
		}

		if(!empty($params['dots_navigation']) && $params['dots_navigation'] == 'no'){
			$data_attr .= ' data-dots-navigation ="false"';
		}
		
		return $data_attr;
	}
	/**
    * Generates testimonials query attribute array
    *
    * @param $params
    *
    * @return array
    */
	private function getQueryParams($params){
		
		$args = array(
            'post_type' => 'testimonials',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $params['number']
        );

        if ($params['category'] != '') {
            $args['testimonials_category'] = $params['category'];
        }
		return $args;
	}

    /**
    * Generates css classes for testimonials
    *
    * @param $params
    *
    * @return array
    */
    private function getTestimonialsClasses($params){
        
        $testimonials_classes = array();
        $testimonials_classes[] = 'edgtf-testimonials';
        $testimonial_type = 'simple';
                
        if(!empty($params['type'])){
            $testimonial_type = $params['type'];
            $testimonials_classes[] = 'edgtf-testimonials-type-'.$testimonial_type;
        }

        if($params['skin'] !== ''){
            $testimonials_classes[] = 'edgtf-testimonials-'.$params['skin'];
        }
        else{
            if ($testimonial_type == 'simple'){
                $testimonials_classes[] = 'edgtf-testimonials-dark';
            }
            else{
                $testimonials_classes[] = 'edgtf-testimonials-light';
            }
        }

        return implode(' ', $testimonials_classes);
    }
	 
}