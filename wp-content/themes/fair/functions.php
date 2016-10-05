<?php
include_once get_template_directory().'/theme-includes.php';

if(!function_exists('fair_edge_styles')) {
    /**
     * Function that includes theme's core styles
     */
    function fair_edge_styles() {
        wp_register_style('fair_edge_blog', EDGE_ASSETS_ROOT.'/css/blog.min.css');

        //include theme's core styles
        wp_enqueue_style('fair_edge_default_style', EDGE_ROOT.'/style.css');
        wp_enqueue_style('fair_edge_modules_plugins', EDGE_ASSETS_ROOT.'/css/plugins.min.css');
        wp_enqueue_style('fair_edge_modules', EDGE_ASSETS_ROOT.'/css/modules.min.css');

        fair_edge_icon_collections()->enqueueStyles();

        if(fair_edge_load_blog_assets()) {
            wp_enqueue_style('fair_edge_blog');
        }

        if(fair_edge_load_blog_assets() || is_singular('portfolio-item')) {
            wp_enqueue_style('wp-mediaelement');
        }
		//is woocommerce installed?
		if(fair_edge_is_woocommerce_installed()) {
			if(fair_edge_load_woo_assets() || fair_edge_is_ajax_enabled()) {

				//include theme's woocommerce styles
				wp_enqueue_style('fair_edge_woocommerce', EDGE_ASSETS_ROOT.'/css/woocommerce.min.css');

				//is responsive option turned on?
				if(fair_edge_options()->getOptionValue('responsiveness') == 'yes') {
					//include theme's woocommerce responsive styles
					wp_enqueue_style('fair_edge_woocommerce_responsive', EDGE_ASSETS_ROOT.'/css/woocommerce-responsive.min.css');
				}
			}
		}
        //define files afer which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = array();
        if(fair_edge_load_woo_assets() || fair_edge_is_ajax_enabled()) {
            $style_dynamic_deps_array = array('fair_edge_woocommerce', 'fair_edge_woocommerce_responsive');
        }

		if(file_exists(EDGE_ROOT_DIR.'/assets/css/style_dynamic.css') && fair_edge_is_css_folder_writable() && !is_multisite()) {
			wp_enqueue_style('fair_edge_style_dynamic', EDGE_ASSETS_ROOT.'/css/style_dynamic.css', $style_dynamic_deps_array, filemtime(EDGE_ROOT_DIR.'/assets/css/style_dynamic.css')); //it must be included after woocommerce styles so it can override it
		} else if(file_exists(EDGE_ROOT_DIR.'/assets/css/style_dynamic_ms_id_'. fair_edge_get_multisite_blog_id() .'.css') && fair_edge_is_css_folder_writable() && is_multisite()) {
			wp_enqueue_style('fair_edge_style_dynamic', EDGE_ASSETS_ROOT.'/css/style_dynamic_ms_id_'. fair_edge_get_multisite_blog_id() .'.css', $style_dynamic_deps_array, filemtime(EDGE_ROOT_DIR.'/assets/css/style_dynamic_ms_id_'. fair_edge_get_multisite_blog_id() .'.css')); //it must be included after woocommerce styles so it can override it
		}

        //is responsive option turned on?
        if(fair_edge_is_responsive_on()) {
            wp_enqueue_style('fair_edge_modules_responsive', EDGE_ASSETS_ROOT.'/css/modules-responsive.min.css');
            wp_enqueue_style('fair_edge_blog_responsive', EDGE_ASSETS_ROOT.'/css/blog-responsive.min.css');

            //include proper styles
			if(file_exists(EDGE_ROOT_DIR.'/assets/css/style_dynamic_responsive.css') && fair_edge_is_css_folder_writable() && !is_multisite()) {
				wp_enqueue_style('fair_edge_style_dynamic_responsive', EDGE_ASSETS_ROOT.'/css/style_dynamic_responsive.css', array(), filemtime(EDGE_ROOT_DIR.'/assets/css/style_dynamic_responsive.css'));
			} elseif(file_exists(EDGE_ROOT_DIR.'/assets/css/style_dynamic_responsive_ms_id_'. fair_edge_get_multisite_blog_id() .'.css') && fair_edge_is_css_folder_writable() && is_multisite()) {
				wp_enqueue_style('fair_edge_style_dynamic_responsive', EDGE_ASSETS_ROOT.'/css/style_dynamic_responsive_ms_id_'. fair_edge_get_multisite_blog_id() .'.css', array(), filemtime(EDGE_ROOT_DIR.'/assets/css/style_dynamic_responsive_ms_id_'. fair_edge_get_multisite_blog_id() .'.css'));
			}
        }

        //include Visual Composer styles
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_style('js_composer_front');
        }
    }

    add_action('wp_enqueue_scripts', 'fair_edge_styles');
}

if(!function_exists('fair_edge_google_fonts_styles')) {
	/**
	 * Function that includes google fonts defined anywhere in the theme
	 */
    function fair_edge_google_fonts_styles() {
        $font_simple_field_array = fair_edge_options()->getOptionsByType('fontsimple');
        if(!(is_array($font_simple_field_array) && count($font_simple_field_array) > 0)) {
            $font_simple_field_array = array();
        }

        $font_field_array = fair_edge_options()->getOptionsByType('font');
        if(!(is_array($font_field_array) && count($font_field_array) > 0)) {
            $font_field_array = array();
        }

        $available_font_options = array_merge($font_simple_field_array, $font_field_array);
        $font_weight_str        = '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

        //define available font options array
        $fonts_array = array();
        foreach($available_font_options as $font_option) {
            //is font set and not set to default and not empty?
            $font_option_value = fair_edge_options()->getOptionValue($font_option);
            if(fair_edge_is_font_option_valid($font_option_value) && !fair_edge_is_native_font($font_option_value)) {
                $font_option_string = $font_option_value.':'.$font_weight_str;
                if(!in_array($font_option_string, $fonts_array)) {
                    $fonts_array[] = $font_option_string;
                }
            }
        }


		//add google fonts set in predefined style
		$args = array( 'post_type' => 'any', 'posts_per_page' => -1);
		$loop = new WP_Query( $args );

		//for each post/page/portfolio
		while ( $loop->have_posts() ) : $loop->the_post();

			//is predefined style chosen
			if(get_post_meta(get_the_ID(), "edgtf_predefined_fonts_style_meta", true) != "" ) {
				$predefinded_style = get_post_meta(get_the_ID(), "edgtf_predefined_fonts_style_meta", true);
				switch ($predefinded_style) {
				 	case 'style-poppins':
						$predefined_font = 'Poppins';
				 		break;				 	
				 	case 'style-oswald':
						$predefined_font = 'Oswald';
				 		break;
				}
				$predefined_font = $predefined_font . ":".$font_weight_str;
				if(!in_array($predefined_font, $fonts_array)) {
					//include that font
					array_push($fonts_array, $predefined_font);
				}
			}
		endwhile;

		wp_reset_postdata();

		if (fair_edge_options()->getOptionValue('predefined_fonts_style') !== ''){
			$predefinded_style = fair_edge_options()->getOptionValue('predefined_fonts_style');
			switch ($predefinded_style) {
			 	case 'style-poppins':
					$predefined_font = 'Poppins';
			 		break;				 	
			 	case 'style-oswald':
					$predefined_font = 'Oswald';
			 		break;
			}
			$predefined_font = $predefined_font . ":".$font_weight_str;
			if(!in_array($predefined_font, $fonts_array)) {
				//include that font
				array_push($fonts_array, $predefined_font);
			}
		}

        $fonts_array         = array_diff($fonts_array, array('-1:'.$font_weight_str));
        $google_fonts_string = implode('|', $fonts_array);

        //default fonts should be separated with %7C because of HTML validation
        $default_font_string = 'Raleway:'.$font_weight_str.'|Playfair Display:'.$font_weight_str;
        $protocol = is_ssl() ? 'https:' : 'http:';

        //is google font option checked anywhere in theme?
        if (count($fonts_array) > 0) {

            //include all checked fonts
            $fonts_full_list = $default_font_string . '|' . str_replace('+', ' ', $google_fonts_string);
            $fonts_full_list_args = array(
                'family' => urlencode($fonts_full_list),
                'subset' => urlencode('latin,latin-ext'),
            );

            $fair_edge_fonts = add_query_arg( $fonts_full_list_args, $protocol.'//fonts.googleapis.com/css' );
            wp_enqueue_style( 'fair_edge_google_fonts', esc_url_raw($fair_edge_fonts), array(), '1.0.0' );

        } else {
            //include default google font that theme is using
            $default_fonts_args = array(
                'family' => urlencode($default_font_string),
                'subset' => urlencode('latin,latin-ext'),
            );
            $fair_edge_fonts = add_query_arg( $default_fonts_args, $protocol.'//fonts.googleapis.com/css' );
            wp_enqueue_style( 'fair_edge_google_fonts', esc_url_raw($fair_edge_fonts), array(), '1.0.0' );
        }

    }

	add_action('wp_enqueue_scripts', 'fair_edge_google_fonts_styles');
}

if(!function_exists('fair_edge_scripts')) {
    /**
     * Function that includes all necessary scripts
     */
    function fair_edge_scripts() {
        global $wp_scripts;

        //init theme core scripts
		wp_enqueue_script( 'jquery-ui-core');
		wp_enqueue_script( 'jquery-ui-tabs');
		wp_enqueue_script( 'jquery-ui-accordion');
		wp_enqueue_script( 'wp-mediaelement');

        wp_enqueue_script('fair_edge_third_party', EDGE_ASSETS_ROOT.'/js/third-party.min.js', array('jquery'), false, true);
        wp_enqueue_script('isotope', EDGE_ASSETS_ROOT.'/js/jquery.isotope.min.js', array('jquery'), false, true);

		if(fair_edge_is_smoth_scroll_enabled()) {
			wp_enqueue_script("fair_edge_smooth_page_scroll", EDGE_ASSETS_ROOT . "/js/smoothPageScroll.js", array(), false, true);
		}

        //include google map api script
		if(fair_edge_options()->getOptionValue('google_maps_api_key') != '') {
			$google_maps_api_key = fair_edge_options()->getOptionValue('google_maps_api_key');
			wp_enqueue_script('google_map_api', '//maps.googleapis.com/maps/api/js?key=' . $google_maps_api_key, array(), false, true);
		} else {
			wp_enqueue_script('google_map_api', '//maps.googleapis.com/maps/api/js', array(), false, true);
		}

        //wp_enqueue_script('edgt_default', EDGE_ASSETS_ROOT.'/js/default.js', array(), false, true);
        wp_enqueue_script('fair_edge_modules', EDGE_ASSETS_ROOT.'/js/modules.min.js', array('jquery'), false, true);

        if(fair_edge_load_blog_assets()) {
            wp_enqueue_script('fair_edge_blog', EDGE_ASSETS_ROOT.'/js/blog.min.js', array('jquery'), false, true);
        }

        //include comment reply script
        $wp_scripts->add_data('comment-reply', 'group', 1);
        if(is_singular() && comments_open() && get_option( 'thread_comments' )) {
            wp_enqueue_script("comment-reply");
        }

        //include Visual Composer script
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_script('wpb_composer_front_js');
        }
    }

    add_action('wp_enqueue_scripts', 'fair_edge_scripts');
}


if(!function_exists('fair_edge_is_ajax_request')) {
    /**
     * Function that checks if the incoming request is made by ajax function
     */
    function fair_edge_is_ajax_request() {

        return isset($_POST["ajaxReq"]) && $_POST["ajaxReq"] == 'yes';
                
    }
}

if(!function_exists('fair_edge_is_ajax_enabled')) {
    /**
     * Function that checks if ajax is enabled
     */
    function fair_edge_is_ajax_enabled() {

		return false;
                
    }
}

if(!function_exists('fair_edge_ajax_meta')) {
    /**
     * Function that echoes meta data for ajax
     *
     * @since 4.3
     * @version 0.2
     */
    function fair_edge_ajax_meta() {

		?>
		<div class="edgtf-seo-title"><?php echo wp_get_document_title(); ?></div>
		<?php
    }

    add_action('fair_edge_ajax_meta', 'fair_edge_ajax_meta');
}

if(!function_exists('fair_edge_no_ajax_pages')) {
    /**
     * Function that echoes pages on which ajax should not be applied
     *
     * @since 4.3
     * @version 0.2
     */
    function fair_edge_no_ajax_pages($global_variables) {

        //is ajax enabled?
        if(fair_edge_is_ajax_enabled()) {
            $no_ajax_pages = array();

            //is wpml installed?
            if(fair_edge_is_wpml_installed()) {
                //get translation pages for current page and merge with main array
                $no_ajax_pages = array_merge($no_ajax_pages, fair_edge_get_wpml_pages_for_current_page());
            }

            //is woocommerce installed?
            if(fair_edge_is_woocommerce_installed()) {
                //get all woocommerce pages and products and merge with main array
                $no_ajax_pages = array_merge($no_ajax_pages, fair_edge_get_woocommerce_pages());
            }

            //add logout url to main array
            $no_ajax_pages[] = htmlspecialchars_decode(wp_logout_url());

            $global_variables['no_ajax_pages'] = $no_ajax_pages;
        }

        return $global_variables;

    }

    add_filter('fair_edge_js_global_variables', 'fair_edge_no_ajax_pages');
}

//defined content width variable
if (!isset( $content_width )) $content_width = 1060;

if(!function_exists('fair_edge_theme_setup')) {
    /**
     * Function that adds various features to theme. Also defines image sizes that are used in a theme
     */
    function fair_edge_theme_setup() {
        //add support for feed links
        add_theme_support('automatic-feed-links');

        //add support for post formats
        add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));

        //add theme support for post thumbnails
        add_theme_support('post-thumbnails');

        //add theme support for title tag
		add_theme_support('title-tag');

        //define thumbnail sizes
        add_image_size('fair_edge_square', 550, 550, true);
        add_image_size('fair_edge_landscape', 800, 600, true);
        add_image_size('fair_edge_portrait', 600, 800, true);
        add_image_size('fair_edge_large_width', 1000, 500, true);
        add_image_size('fair_edge_large_height', 500, 1000, true);
        add_image_size('fair_edge_large_width_height', 1000, 1000, true);

        load_theme_textdomain( 'fair', get_template_directory().'/languages' );
    }

    add_action('after_setup_theme', 'fair_edge_theme_setup');
}


if(!function_exists('fair_edge_rgba_color')) {
    /**
     * Function that generates rgba part of css color property
     *
     * @param $color string hex color
     * @param $transparency float transparency value between 0 and 1
     *
     * @return string generated rgba string
     */
    function fair_edge_rgba_color($color, $transparency) {
        if($color !== '' && $transparency !== '') {
            $rgba_color = '';

            $rgb_color_array = fair_edge_hex2rgb($color);
            $rgba_color .= 'rgba('.implode(', ', $rgb_color_array).', '.$transparency.')';

            return $rgba_color;
        }
    }
}

if(!function_exists('fair_edge_wp_title')) {
    /**
     * Function that outputs title tag. It checks if _wp_render_title_tag function exists
     * and if it does'nt it generates output. Compatible with versions of WP prior to 4.1
     */
    function fair_edge_wp_title() {
        if(!function_exists('_wp_render_title_tag')) { ?>
            <title><?php wp_title(''); ?></title>
        <?php }
    }
}

if(!function_exists('fair_edge_header_meta')) {
    /**
     * Function that echoes meta data if our seo is enabled
     */
    function fair_edge_header_meta() { ?>

        <meta charset="<?php bloginfo('charset'); ?>"/>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>

    <?php }

    add_action('fair_edge_header_meta', 'fair_edge_header_meta');
}

if(!function_exists('fair_edge_user_scalable_meta')) {
    /**
     * Function that outputs user scalable meta if responsiveness is turned on
     * Hooked to fair_edge_header_meta action
     */
    function fair_edge_user_scalable_meta() {
        //is responsiveness option is chosen?
        if(fair_edge_is_responsive_on()) { ?>
            <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <?php } else { ?>
            <meta name="viewport" content="width=1200,user-scalable=yes">
        <?php }
    }

    add_action('fair_edge_header_meta', 'fair_edge_user_scalable_meta');
}

if(!function_exists('fair_edge_get_page_id')) {
	/**
	 * Function that returns current page / post id.
	 * Checks if current page is woocommerce page and returns that id if it is.
	 * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
	 * page that is created in WP admin.
	 *
	 * @return int
	 *
	 * @version 0.1
	 *
	 * @see fair_edge_is_woocommerce_installed()
	 * @see fair_edge_is_woocommerce_shop()
	 */
	function fair_edge_get_page_id() {
		if(fair_edge_is_woocommerce_installed() && fair_edge_is_woocommerce_shop()) {
			return fair_edge_get_woo_shop_page_id();
		}

		if(is_archive() || is_search() || is_404() || (is_home() && is_front_page())) {
			return -1;
		}

		return get_queried_object_id();
	}
}


if(!function_exists('fair_edge_is_default_wp_template')) {
    /**
     * Function that checks if current page archive page, search, 404 or default home blog page
     * @return bool
     *
     * @see is_archive()
     * @see is_search()
     * @see is_404()
     * @see is_front_page()
     * @see is_home()
     */
    function fair_edge_is_default_wp_template() {
        return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
    }
}

if(!function_exists('fair_edge_get_page_template_name')) {
    /**
     * Returns current template file name without extension
     * @return string name of current template file
     */
    function fair_edge_get_page_template_name() {
        $file_name = '';

        if(!fair_edge_is_default_wp_template()) {
            $file_name_without_ext = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename(get_page_template()));

            if($file_name_without_ext !== '') {
                $file_name = $file_name_without_ext;
            }
        }

        return $file_name;
    }
}

if(!function_exists('fair_edge_has_shortcode')) {
    /**
     * Function that checks whether shortcode exists on current page / post
     *
     * @param string shortcode to find
     * @param string content to check. If isn't passed current post content will be used
     *
     * @return bool whether content has shortcode or not
     */
    function fair_edge_has_shortcode($shortcode, $content = '') {
        $has_shortcode = false;

        if($shortcode) {
            //if content variable isn't past
            if($content == '') {
                //take content from current post
                $page_id = fair_edge_get_page_id();
                if(!empty($page_id)) {
                    $current_post = get_post($page_id);

                    if(is_object($current_post) && property_exists($current_post, 'post_content')) {
                        $content = $current_post->post_content;
                    }
                }
            }

            //does content has shortcode added?
            if(stripos($content, '['.$shortcode) !== false) {
                $has_shortcode = true;
            }
        }

        return $has_shortcode;
    }
}

if(!function_exists('fair_edge_rewrite_rules_on_theme_activation')) {
    /**
     * Function that flushes rewrite rules on deactivation
     */
    function fair_edge_rewrite_rules_on_theme_activation() {
        flush_rewrite_rules();
    }

    add_action('after_switch_theme', 'fair_edge_rewrite_rules_on_theme_activation');
}

if(!function_exists('fair_edge_get_dynamic_sidebar')) {
    /**
     * Return Custom Widget Area content
     *
     * @return string
     */
    function fair_edge_get_dynamic_sidebar($index = 1) {
        ob_start();
        dynamic_sidebar($index);
        $sidebar_contents = ob_get_clean();

        return $sidebar_contents;
    }
}

if(!function_exists('fair_edge_get_sidebar')) {
    /**
     * Return Sidebar
     *
     * @return string
     */
    function fair_edge_get_sidebar() {

        $id = fair_edge_get_page_id();

        $sidebar = "sidebar";

        if (get_post_meta($id, 'edgtf_custom_sidebar_meta', true) != '') {
            $sidebar = get_post_meta($id, 'edgtf_custom_sidebar_meta', true);
        } else {
            if (is_single() && fair_edge_options()->getOptionValue('blog_single_custom_sidebar') != '') {
                $sidebar = esc_attr(fair_edge_options()->getOptionValue('blog_single_custom_sidebar'));
            } elseif ((is_archive() || (is_home() && is_front_page())) && fair_edge_options()->getOptionValue('blog_custom_sidebar') != '') {
                $sidebar = esc_attr(fair_edge_options()->getOptionValue('blog_custom_sidebar'));
            } elseif (is_page() && fair_edge_options()->getOptionValue('page_custom_sidebar') != '') {
                $sidebar = esc_attr(fair_edge_options()->getOptionValue('page_custom_sidebar'));
            }
        }

        return $sidebar;
    }
}



if( !function_exists('fair_edge_sidebar_columns_class') ) {

    /**
     * Return classes for columns holder when sidebar is active
     *
     * @return array
     */

    function fair_edge_sidebar_columns_class() {

        $sidebar_class = array();
        $sidebar_layout = fair_edge_sidebar_layout();

        switch($sidebar_layout):
            case 'sidebar-33-right':
                $sidebar_class[] = 'edgtf-two-columns-66-33';
                break;
            case 'sidebar-25-right':
                $sidebar_class[] = 'edgtf-two-columns-75-25';
                break;
            case 'sidebar-33-left':
                $sidebar_class[] = 'edgtf-two-columns-33-66';
                break;
            case 'sidebar-25-left':
                $sidebar_class[] = 'edgtf-two-columns-25-75';
                break;

        endswitch;

        $sidebar_class[] = 'clearfix';

        return fair_edge_class_attribute($sidebar_class);

    }

}


if( !function_exists('fair_edge_sidebar_layout') ) {

    /**
     * Function that check is sidebar is enabled and return type of sidebar layout
     */

    function fair_edge_sidebar_layout() {

        $sidebar_layout = '';
        $page_id        = fair_edge_get_page_id();

        $page_sidebar_meta = get_post_meta($page_id, 'edgtf_sidebar_meta', true);

        if(($page_sidebar_meta !== '') && $page_id !== -1) {
            if($page_sidebar_meta == 'no-sidebar') {
                $sidebar_layout = '';
            } else {
                $sidebar_layout = $page_sidebar_meta;
            }
        } else {
            if(is_single() && fair_edge_options()->getOptionValue('blog_single_sidebar_layout')) {
                $sidebar_layout = esc_attr(fair_edge_options()->getOptionValue('blog_single_sidebar_layout'));
            } elseif((is_archive() || (is_home() && is_front_page())) && fair_edge_options()->getOptionValue('archive_sidebar_layout')) {
                $sidebar_layout = esc_attr(fair_edge_options()->getOptionValue('archive_sidebar_layout'));
            } elseif(is_page() && fair_edge_options()->getOptionValue('page_sidebar_layout')) {
                $sidebar_layout = esc_attr(fair_edge_options()->getOptionValue('page_sidebar_layout'));
            }
        }

        return $sidebar_layout;

    }

}


if( !function_exists('fair_edge_page_custom_style') ) {

    /**
     * Function that print custom page style
     */

    function fair_edge_page_custom_style() {
       $style = '';
       $html = '';
       $style = apply_filters('fair_edge_add_page_custom_style', $style);

		if($style !== '') {
			wp_add_inline_style( 'fair_edge_modules', implode(' ', $style));
		}
    }
	add_action('wp_enqueue_scripts', 'fair_edge_page_custom_style');
    
}


if( !function_exists('fair_edge_register_page_custom_style') ) {

    /**
     * Function that print custom page style
     */

    function fair_edge_register_page_custom_style() {
       add_action( (fair_edge_is_ajax_enabled() && fair_edge_is_ajax_request()) ? 'fair_edge_ajax_meta' : 'wp_head', 'fair_edge_page_custom_style' );
    }

    add_action( 'fair_edge_after_options_map', 'fair_edge_register_page_custom_style' );
}


if( !function_exists('fair_edge_vc_custom_style') ) {

    /**
     * Function that print custom page style
     */

    function fair_edge_vc_custom_style() {
        if(fair_edge_visual_composer_installed()) {
            $id = fair_edge_get_page_id();
            if(is_page() || is_single() || is_singular('portfolio-item')) {

                $shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
                if ( ! empty( $shortcodes_custom_css ) ) {
                    echo '<style type="text/css" data-type="vc_shortcodes-custom-css-'.esc_attr($id).'">';
                    echo get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
                    echo '</style>';
                }

                $post_custom_css = get_post_meta( $id, '_wpb_post_custom_css', true );
                if ( ! empty( $post_custom_css ) ) {
                    echo '<style type="text/css" data-type="vc_custom-css-'.esc_attr($id).'">';
                    echo get_post_meta( $id, '_wpb_post_custom_css', true );
                    echo '</style>';
                }
            }
        }
    }
    
}


if( !function_exists('fair_edge_register_vc_custom_style') ) {

    /**
     * Function that print custom page style
     */

    function fair_edge_register_vc_custom_style() {
        if (fair_edge_is_ajax_enabled() && fair_edge_is_ajax_request()) {
            add_action( 'fair_edge_ajax_meta', 'fair_edge_vc_custom_style' );
        }
       
    }

    add_action( 'fair_edge_after_options_map', 'fair_edge_register_vc_custom_style' );
}

if(!function_exists('fair_edge_get_unique_page_class')) {
	/**
	 * Returns unique page class based on post type and page id
	 *
	 * @return string
	 */
	function fair_edge_get_unique_page_class() {
		$id = fair_edge_get_page_id();
		$page_class = '';

		if(is_single()) {
			$page_class = '.postid-'.$id;
		} elseif($id === fair_edge_get_woo_shop_page_id()) {
			$page_class = '.archive';
		} else {
			$page_class .= '.page-id-'.$id;
		}

		return $page_class;
	}
}

if( !function_exists('fair_edge_container_style') ) {

    /**
     * Function that return container style
     */

    function fair_edge_container_style($style) {
        $id = fair_edge_get_page_id();
        $class_prefix = fair_edge_get_unique_page_class();

        $container_selector = array(
            $class_prefix.' .edgtf-content .edgtf-content-inner > .edgtf-container',
            $class_prefix.' .edgtf-content .edgtf-content-inner > .edgtf-full-width',
        );

        $container_class = array();
        $page_background_color = get_post_meta($id, "edgtf_page_background_color_meta", true);

        if($page_background_color){
            $container_class['background-color'] = $page_background_color;
        }

        $current_style = fair_edge_dynamic_css($container_selector, $container_class);
		$style[]       = $current_style;

        return $style;

    }
    add_filter('fair_edge_add_page_custom_style', 'fair_edge_container_style');
}

if( !function_exists('fair_edge_page_padding') ) {

    /**
     * Function that return container style
     */

    function fair_edge_page_padding( $style ) {
		
		$id = fair_edge_get_page_id();
		$class_prefix = fair_edge_get_unique_page_class();


        $page_selector = array(
			$class_prefix . ' .edgtf-content .edgtf-content-inner > .edgtf-container > .edgtf-container-inner',
			$class_prefix . ' .edgtf-content .edgtf-content-inner > .edgtf-full-width > .edgtf-full-width-inner'
        );
        $page_css = array();

        $page_padding = get_post_meta($id, 'edgtf_page_padding_meta', true);

        if($page_padding !== ''){
            $page_css['padding'] = $page_padding;
        }

        $current_style = fair_edge_dynamic_css($page_selector, $page_css);

		$style[]       = $current_style;

        return $style;

    }
    add_filter('fair_edge_add_page_custom_style', 'fair_edge_page_padding');
}

if( !function_exists('fair_edge_page_boxed_style') ) {

	/**
	 * Function that return container style
	 */

	function fair_edge_page_boxed_style( $style ) {

		$id = fair_edge_get_page_id();
		$class_prefix = fair_edge_get_unique_page_class();

		$page_selector = array(
			$class_prefix . '.edgtf-boxed .edgtf-wrapper'
		);
		$page_css = array();

		$page_background_color 				= get_post_meta($id, 'edgtf_page_background_color_in_box_meta', true);
		$page_background_image				= get_post_meta($id, 'edgtf_boxed_background_image_meta', true);
		$page_background_image_repeating	= get_post_meta($id, 'edgtf_boxed_background_image_repeating_meta', true);

		if($page_background_color !== ''){
			$page_css['background-color'] = $page_background_color;
		}
		if($page_background_image !== '' && $page_background_image_repeating != ''){
			$page_css['background-image'] = 'url(' .$page_background_image . ')';
			$page_css['background-repeat'] = $page_background_image_repeating;

			if($page_background_image_repeating == 'no') {
				$page_css['background-position']	= 'center 0';
				$page_css['background-repeat'] 		= 'no-repeat';
			} else {
				$page_css['background-position'] 	= '0 0';
				$page_css['background-repeat'] 		= 'repeat';
			}
		}

		$current_style = fair_edge_dynamic_css($page_selector, $page_css);

		$style[]       = $current_style;

		return $style;

	}
	add_filter('fair_edge_add_page_custom_style', 'fair_edge_page_boxed_style');
}

if(!function_exists('fair_edge_print_custom_css')) {
    /**
     * Prints out custom css from theme options
     */
    function fair_edge_print_custom_css() {
        $custom_css = fair_edge_options()->getOptionValue('custom_css');

        if($custom_css !== '') {
            wp_add_inline_style( 'fair_edge_modules', $custom_css);
        }
    }

    add_action('wp_enqueue_scripts', 'fair_edge_print_custom_css');
}

if(!function_exists('fair_edge_print_custom_js')) {
	/**
	 * Prints out custom css from theme options
	 */
	function fair_edge_print_custom_js() {
		$custom_js = fair_edge_options()->getOptionValue('custom_js');

		if($custom_js !== '') {
			wp_add_inline_script('fair_edge_modules', $custom_js);
		}
	}

	add_action('wp_enqueue_scripts', 'fair_edge_print_custom_js');
}


if(!function_exists('fair_edge_get_global_variables')) {
    /**
     * Function that generates global variables and put them in array so they could be used in the theme
     */
    function fair_edge_get_global_variables() {

        $global_variables = array();
        $element_appear_amount = -150;

        $global_variables['edgtfAddForAdminBar'] = is_admin_bar_showing() ? 32 : 0;
        $global_variables['edgtfElementAppearAmount'] = fair_edge_options()->getOptionValue('element_appear_amount') !== '' ? fair_edge_options()->getOptionValue('element_appear_amount') : $element_appear_amount;
        $global_variables['edgtfFinishedMessage'] = esc_html__('No more posts', 'fair');
        $global_variables['edgtfMessage'] = esc_html__('Loading new posts...', 'fair');

        $global_variables = apply_filters('fair_edge_js_global_variables', $global_variables);

        wp_localize_script('fair_edge_modules', 'edgtfGlobalVars', array(
            'vars' => $global_variables
        ));

    }

    add_action('wp_enqueue_scripts', 'fair_edge_get_global_variables');
}

if(!function_exists('fair_edge_per_page_js_variables')) {
	/**
	 * Outputs global JS variable that holds page settings
	 */
	function fair_edge_per_page_js_variables() {
        $per_page_js_vars = apply_filters('fair_edge_per_page_js_vars', array());

        wp_localize_script('fair_edge_modules', 'edgtfPerPageVars', array(
            'vars' => $per_page_js_vars
        ));
    }

    add_action('wp_enqueue_scripts', 'fair_edge_per_page_js_variables');
}

if(!function_exists('fair_edge_content_elem_style_attr')) {
    /**
     * Defines filter for adding custom styles to content HTML element
     */
    function fair_edge_content_elem_style_attr() {
        $styles = apply_filters('fair_edge_content_elem_style_attr', array());

        fair_edge_inline_style($styles);
    }
}

if(!function_exists('fair_edge_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function fair_edge_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }
}

if(!function_exists('fair_edge_visual_composer_installed')) {
    /**
     * Function that checks if visual composer installed
     * @return bool
     */
    function fair_edge_visual_composer_installed() {
        //is Visual Composer installed?
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('fair_edge_contact_form_7_installed')) {
    /**
     * Function that checks if contact form 7 installed
     * @return bool
     */
    function fair_edge_contact_form_7_installed() {
        //is Contact Form 7 installed?
        if(defined('WPCF7_VERSION')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('fair_edge_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function fair_edge_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if(!function_exists('fair_edge_max_image_width_srcset')) {
	/**
	 * Set max width for srcset to 1920
	 *
	 * @return int
	 */
	function fair_edge_max_image_width_srcset() {
        return 1920;
    }

	add_filter('max_srcset_image_width', 'fair_edge_max_image_width_srcset');
}