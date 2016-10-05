<?php

if(!function_exists('edgt_core_version_class')) {
    /**
     * Adds plugins version class to body
     * @param $classes
     * @return array
     */
    function edgt_core_version_class($classes) {
        $classes[] = 'edgt-core-'.EDGE_CORE_VERSION;

        return $classes;
    }

    add_filter('body_class', 'edgt_core_version_class');
}

if(!function_exists('edgt_core_theme_installed')) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function edgt_core_theme_installed() {
        return defined('EDGE_ROOT');
    }
}

if (!function_exists('edgt_core_get_carousel_slider_array')){
    /**
     * Function that returns associative array of carousels,
     * where key is term slug and value is term name
     * @return array
     */
    function edgt_core_get_carousel_slider_array() {
        $carousels_array = array();
        $terms = get_terms('carousels_category');

        if (is_array($terms) && count($terms)) {
            $carousels_array[''] = '';
            foreach ($terms as $term) {
                $carousels_array[$term->slug] = $term->name;
            }
        }

        return $carousels_array;
    }
}

if(!function_exists('edgt_core_get_carousel_slider_array_vc')) {
    /**
     * Function that returns array of carousels formatted for Visual Composer
     *
     * @return array array of carousels where key is term title and value is term slug
     *
     * @see edgt_core_get_carousel_slider_array
     */
    function edgt_core_get_carousel_slider_array_vc() {
        return array_flip(edgt_core_get_carousel_slider_array());
    }
}

if(!function_exists('edgt_core_get_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $shortcode name of the shortcode folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @see edge_cpt_get_template_part()
	 */
	function edgt_core_get_shortcode_module_template_part($shortcode,$template, $slug = '', $params = array()) {

		//HTML Content from template
		$html = '';
		$template_path = EDGE_CORE_CPT_PATH.'/'.$shortcode.'/shortcodes/templates';
		
		$temp = $template_path.'/'.$template;
		if(is_array($params) && count($params)) {
			extract($params);
		}
		
		$template = '';

		if($temp !== '') {
			if($slug !== '') {
				$template = "{$temp}-{$slug}.php";
			}
			$template = $temp.'.php';
		}
		if($template) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		return $html;
	}
}

if(!function_exists('edgt_core_set_portfolio_ajax_url')){
	/**
     * load themes ajax functionality
     * 
     */
	function edgt_core_set_portfolio_ajax_url() {
		echo '<script type="application/javascript">var edgtCoreAjaxUrl = "'.admin_url('admin-ajax.php').'"</script>';
	}
	add_action('wp_enqueue_scripts', 'edgt_core_set_portfolio_ajax_url');
	
}
/**
	 * Loads more function for portfolio.
	 *
	 */
if(!function_exists('edgt_core_portfolio_ajax_load_more')){
	
	function edgt_core_portfolio_ajax_load_more(){

	$return_obj = array();
	$shortcode_params = array();
	$activeFilterCat = '';
	$type = '';
	if (!empty($_POST['type'])) {
        $shortcode_params['type'] = $_POST['type'];
        $type = $shortcode_params['type'];
        if ($shortcode_params['type'] == 'masonry-with-space'){
        	$type = 'masonry';
        }
    }
	if (!empty($_POST['columns'])) {
        $shortcode_params['columns'] = $_POST['columns'];
    }
	if (!empty($_POST['gridSize'])) {
        $shortcode_params['gridSize'] = $_POST['gridSize'];
    }
	if (!empty($_POST['orderBy'])) {
        $shortcode_params['order_by'] = $_POST['orderBy'];
    }
	if (!empty($_POST['order'])) {
        $shortcode_params['order'] = $_POST['order'];
    }
	if (!empty($_POST['number'])) {
        $shortcode_params['number'] = $_POST['number'];
    }
	if (!empty($_POST['imageSize'])) {
        $shortcode_params['image_size'] = $_POST['imageSize'];
    }
	if (!empty($_POST['hoverType'])) {
        $shortcode_params['hover_type'] = $_POST['hoverType'];
    }
	if (!empty($_POST['tabStyle'])) {
        $shortcode_params['rounded_tab_style'] = $_POST['tabStyle'];
    }
	if (!empty($_POST['popUp'])) {
        $shortcode_params['pop_up'] = $_POST['popUp'];
    }
	if (!empty($_POST['filter'])) {
        $shortcode_params['filter'] = $_POST['filter'];
    }
	if (!empty($_POST['filterOrderBy'])) {
        $shortcode_params['filter_order_by'] = $_POST['filterOrderBy'];
    }
	if (!empty($_POST['category'])) {
        $shortcode_params['category'] = $_POST['category'];
    }
	if (!empty($_POST['selectedProjectes'])) {
        $shortcode_params['selected_projectes'] = $_POST['selectedProjectes'];
    }
	if (!empty($_POST['showLoadMore'])) {
        $shortcode_params['show_load_more'] = $_POST['showLoadMore'];
    }
	if (!empty($_POST['titleTag'])) {
        $shortcode_params['title_tag'] = $_POST['titleTag'];
    }
	if (!empty($_POST['nextPage'])) {
        $shortcode_params['next_page'] = $_POST['nextPage'];
    }
	if (!empty($_POST['activeFilterCat'])) {
        $shortcode_params['active_filter_cat'] = $_POST['activeFilterCat'];
    }
	
	$html = '';

	$port_list = new \EdgeCore\PostTypes\Portfolio\Shortcodes\PortfolioList();
	$query_array = $port_list->getQueryArray($shortcode_params);
	$query_results = new \WP_Query($query_array);

	if($query_results->have_posts()):			
		while ( $query_results->have_posts() ) : $query_results->the_post(); 

			$shortcode_params['current_id'] = get_the_ID();
			$shortcode_params['thumb_size'] = $port_list->getImageSize($shortcode_params);
			$shortcode_params['category_html'] = $port_list->getItemCategoriesHtml($shortcode_params);
			$shortcode_params['categories'] = $port_list->getItemCategories($shortcode_params);
            $shortcode_params['article_masonry_size'] = $port_list->getMasonrySize($shortcode_params);
            $shortcode_params['classes'] = $port_list->getItemClasses($shortcode_params);
            $shortcode_params['item_link'] = $port_list->getItemLink($shortcode_params);
            $shortcode_params['portfolio_gallery'] = $port_list->getItemGallery($shortcode_params);


			$html .= edgt_core_get_shortcode_module_template_part('portfolio',$type, '', $shortcode_params);

		endwhile;
		else: 			
			$html .= '<p>'. __('Sorry, no posts matched your criteria.', 'edge-cpt') .'</p>';
		endif;
		
	$return_obj = array(
		'html' => $html,
	);

	echo json_encode($return_obj); exit;
}
}


add_action('wp_ajax_nopriv_edgt_core_portfolio_ajax_load_more', 'edgt_core_portfolio_ajax_load_more');
add_action( 'wp_ajax_edgt_core_portfolio_ajax_load_more', 'edgt_core_portfolio_ajax_load_more' );



if(!function_exists('edge_cpt_inline_style')) {
	/**
	 * Function that echoes generated style attribute
	 *
	 * @param $value string | array attribute value
	 *
	 * @see edge_cpt_get_inline_style()
	 */
	function edge_cpt_inline_style($value) {
		echo edge_cpt_get_inline_style($value);
	}
}

if(!function_exists('edge_cpt_get_inline_style')) {
	/**
	 * Function that generates style attribute and returns generated string
	 *
	 * @param $value string | array value of style attribute
	 *
	 * @return string generated style attribute
	 *
	 * @see edge_cpt_get_inline_style()
	 */
	function edge_cpt_get_inline_style($value) {
		return edge_cpt_get_inline_attr($value, 'style', ';');
	}
}

if(!function_exists('edge_cpt_class_attribute')) {
	/**
	 * Function that echoes class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @see edge_cpt_get_class_attribute()
	 */
	function edge_cpt_class_attribute($value) {
		echo edge_cpt_get_class_attribute($value);
	}
}

if(!function_exists('edge_cpt_get_class_attribute')) {
	/**
	 * Function that returns generated class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @return string generated class attribute
	 *
	 * @see edge_cpt_get_inline_attr()
	 */
	function edge_cpt_get_class_attribute($value) {
		return edge_cpt_get_inline_attr($value, 'class', ' ');
	}
}

if(!function_exists('edge_cpt_get_inline_attr')) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 *
	 * @return string generated html attribute
	 */
	function edge_cpt_get_inline_attr($value, $attr, $glue = '') {
		if(!empty($value)) {

			if(is_array($value) && count($value)) {
				$properties = implode($glue, $value);
			} elseif($value !== '') {
				$properties = $value;
			}

			return $attr.'="'.esc_attr($properties).'"';
		}

		return '';
	}
}

if(!function_exists('edge_cpt_inline_attr')) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 *
	 * @return string generated html attribute
	 */
	function edge_cpt_inline_attr($value, $attr, $glue = '') {
		echo edge_cpt_get_inline_attr($value, $attr, $glue);
	}
}

if(!function_exists('edge_cpt_get_inline_attrs')) {
	/**
	 * Generate multiple inline attributes
	 *
	 * @param $attrs
	 *
	 * @return string
	 */
	function edge_cpt_get_inline_attrs($attrs) {
		$output = '';

		if(is_array($attrs) && count($attrs)) {
			foreach($attrs as $attr => $value) {
				$output .= ' '.edge_cpt_get_inline_attr($value, $attr);
			}
		}

		$output = ltrim($output);

		return $output;
	}
}

if(!function_exists('edge_cpt_rgba_color')) {
	/**
	 * Function that generates rgba part of css color property
	 *
	 * @param $color string hex color
	 * @param $transparency float transparency value between 0 and 1
	 *
	 * @return string generated rgba string
	 */
	function edge_cpt_rgba_color($color, $transparency) {
		if($color !== '' && $transparency !== '') {
			$rgba_color = '';

			$rgb_color_array = edge_cpt_hex2rgb($color);
			$rgba_color .= 'rgba('.implode(', ', $rgb_color_array).', '.$transparency.')';

			return $rgba_color;
		}
	}
}

if(!function_exists('edge_cpt_hex2rgb')) {
	/**
	 * Function that transforms hex color to rgb color
	 *
	 * @param $hex string original hex string
	 *
	 * @return array array containing three elements (r, g, b)
	 */
	function edge_cpt_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex, 0, 1).substr($hex, 0, 1));
			$g = hexdec(substr($hex, 1, 1).substr($hex, 1, 1));
			$b = hexdec(substr($hex, 2, 1).substr($hex, 2, 1));
		} else {
			$r = hexdec(substr($hex, 0, 2));
			$g = hexdec(substr($hex, 2, 2));
			$b = hexdec(substr($hex, 4, 2));
		}
		$rgb = array($r, $g, $b);

		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}
}


if(!function_exists('edge_cpt_string_ends_with')) {
	/**
	 * Checks if $haystack ends with $needle and returns proper bool value
	 *
	 * @param $haystack string to check
	 * @param $needle string with which $haystack needs to end
	 *
	 * @return bool
	 */
	function edge_cpt_string_ends_with($haystack, $needle) {
		if($haystack !== '' && $needle !== '') {
			return (substr($haystack, -strlen($needle), strlen($needle)) == $needle);
		}

		return true;
	}
}