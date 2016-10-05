<?php
namespace FairEdge\Modules\Shortcodes\BlogSlider;

use FairEdge\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Blog Slider
 */
class BlogSlider implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'edgtf_blog_slider';

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
	 * @see edgtf_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		$categories_array = array();

		vc_map( array(
			'name' => 'Blog Slider',
			'base' => $this->getBase(),
			'icon'  => 'icon-wpb-blog-slider extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'category' => 'by EDGE',
			'params' => array(
                array(
                    'type'			=> 'dropdown',
                    'heading'		=> 'Slider Type',
                    'param_name'	=> 'slider_type',
                    'value'			=> array(
                        'Carousel'		=> 'carousel',
                        'Slider'		=> 'slider',
                    ),
                    'admin_label'	=> true,
                    'description'	=> ''
                ),
				array(
					'type' => 'textfield',
					'heading' => 'Number of Posts',
					'param_name' => 'number_of_posts',
					'description' => 'Leave empty for all posts'
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Selected Posts',
					'param_name'	=> 'selected_posts',
					'description'	=> 'Selected Posts (leave empty for all, delimit by comma)'
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Order by',
					'param_name'	=> 'order_by',
					'value'			=> array(
						'Date'		=> 'date',
						'Title'		=> 'title'
					),
					'admin_label'	=> true,
					'description'	=> ''
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Order',
					'param_name'	=> 'order',
					'value'			=> array(
						'DESC'		=> 'desc',
						'ASC'		=> 'asc'
					),
					'admin_label'	=> true,
					'description'	=> ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Category',
					'param_name' => 'category',
					'value' => '',
					'description' => 'Leave empty for all or use comma for list'
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Show Categories',
					'param_name' => 'show_categories',
					'value' => array(
						'Yes' => 'yes',
						'No' => 'no',
					),
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Show Image',
					'param_name'	=> 'show_image',
					'value'			=> array(
						'No'		=> 'no',
						'Yes'		=> 'yes',
					),
					'description'	=> '',
					"dependency" => array("element" => "slider_type", "value" => array("carousel"))
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> 'Image Size',
					'param_name'	=> 'image_size',
					'value'			=> array(
						'Default'		=> 'default',
						'Square'		=> 'square',
					),
					'description'	=> '',
                    "dependency" => array("element" => "show_image", "value" => array("yes"))
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Show Separator',
					'param_name' => 'show_separator',
					'value' => array(
						'Yes' => 'yes',
						'No' => 'no'
					),
				),
                array(
                    'type'			=> 'dropdown',
                    'heading'		=> 'Image Size',
                    'param_name'	=> 'image_size_slider',
                    'value'			=> array(
                        'Default'		=> 'default',
                        'Square'		=> 'square',
                        'Custom'		=> 'custom',
                    ),
                    "dependency" => array("element" => "slider_type", "value" => array("slider"))
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Image Width",
                    "param_name" => "image_width",
                    "value" => "",
                    "description" => "Set custom image width",
                    "dependency" => array("element" => "image_size_slider", "value" => array("custom"))
                ),
                array(
                    "type" => "textfield",
                    "heading" => "Image Height",
                    "param_name" => "image_height",
                    "value" => "",
                    "description" => "Set custom image height",
                    "dependency" => array("element" => "image_size_slider", "value" => array("custom"))
                ),
				array(
					'type' => 'textfield',
					'heading' => 'Text length',
					'param_name' => 'text_length',
					'description' => 'Number of characters'
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
			'number_of_posts'	=> -1,
			'order_by'		 	=> 'date',
			'order'				=> 'DESC',
			'category'			=> '',
			'show_categories'	=> 'yes',
			'image_size'		=> 'full',
			'image_size_slider'	=> 'full',
			'slider_type'	 	=> 'carousel',
			'show_image'	 	=> 'no',
			'image_height'	 	=> '',
            'image_width'	 	=> '',
            'show_separator'	=> 'yes',
            'selected_posts' 	=> '',
            'text_length' 		=> '90'
		);

		$params = shortcode_atts($args, $atts);

		extract($params);
		
		
		$args = array(
			'post_type'			=> 'post',
			'posts_per_page'	=> $number_of_posts,
			'orderby'			=> $order_by,
			'order'				=> $order
		);
		if($category != '' && $category !== 0){
			$args['category_name'] = $category;			
		}

		$slider_class = 'edgtf-blog-slider-type-'.$slider_type;
		$post_ids = null;
		
		if($selected_posts != ''){
			$post_ids = explode(',', $selected_posts);
			$args['post__in'] = $post_ids;
		}

        if($slider_type == 'slider'){
           if($image_size_slider == 'custom' && $image_width != '' && $image_height != ''){
                $params['image_size_slider'] = 'custom';
                $params['image_width'] = $image_width;
                $params['image_height'] = $image_height;
            }elseif($image_size_slider == 'square') {
               $params['image_size_slider'] = 'fair_edge_square';
           }



        }elseif($image_size == 'square') {
            $params['image_size'] = 'fair_edge_square';
        }

		$query = new \WP_Query($args);

		if ( $query->have_posts() ) {

			$html = '';

			$html .= '<div class="edgtf-blog-slider-outer">';
			

			$html .= '<div class="edgtf-blog-slider edgtf-slick-slider-navigation-style '. $slider_class .'" data-type="'.$slider_type.'">';

			while ( $query->have_posts() ) {

				$query->the_post();

				//Get slide HTML from template
				$html .= fair_edge_get_shortcode_module_template_part('templates/blog-'.$slider_type, 'blog-slider', '', $params);

			}

			$html .= '</div></div>';


		} else {

			$html = esc_html__('There is no posts!', 'fair');

		}

		wp_reset_postdata();

		return $html;

	}
}