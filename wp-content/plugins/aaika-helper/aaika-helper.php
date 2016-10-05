<?php
/*
Plugin Name: Aaika Theme Helper
Plugin URI: http://devn-theme.com/plugins
Description: Help Themes of devn-Theme works correctly.
Version: 1.0
Author: devn-Theme
Author URI: http://devn-theme.com

*/



/********************************************************/
/*                        Actions                       */
/********************************************************/


if( !function_exists( 'devn_aaika_helper_init' ) ){
	
	/* Add post type */

	function devn_aaika_helper_init() {
	    	
	    foreach( devn_aaika_register_type( 'post' ) as $postType => $cofg ){
		    if( !post_type_exists( $postType ) ){
		    	register_post_type( $postType, $cofg );
		    }	
	    }
		
		if( !post_type_exists( 'mega_menu' ) ){
			$labels = array(
		        'name' => __('devn - Mega Menu', 'devn'),
		        'singular_name' => __('devn - Mega Menu', 'devn'),
		        'add_new' => __('Add New', 'devn'),
		        'add_new_item' => __('Add New devn Mega Menu Item', 'devn'),
		        'edit_item' => __('Edit devn Mega Menu Item', 'devn'),
		        'new_item' => __('New devn Mega Menu Item', 'devn'),
		        'view_item' => __('View devn Mega Menu Item', 'devn'),
		        'search_items' => __('Search devn Mega Menu Items', 'devn'),
		        'not_found' => __('No devn Mega Menu Items found', 'devn'),
		        'not_found_in_trash' => __('No devn Mega Menu Items found in Trash', 'devn'),
		        'parent_item_colon' => __('Parent devn Mega Menu Item:', 'devn'),
		        'menu_name' => __('Mega Menu', 'devn'),
		    );
		
		    $args = array(
		        'labels' => $labels,
		        'hierarchical' => false,
		        'description' => __('Mega Menus entries for Slowave.', 'devn'),
		        'supports' => array('title', 'editor'),
		        'public' => false,
		        'show_ui' => true,
		        'show_in_menu' => true,
		        'menu_position' => 40,
		
		        'show_in_nav_menus' => true,
		        'publicly_queryable' => false,
		        'exclude_from_search' => true,
		        'has_archive' => false,
		        'query_var' => true,
		        'can_export' => true,
		        'rewrite' => false,
		        'capability_type' => 'post'
		    );
			
		    register_post_type('mega_menu', $args);
		}    
		
	}
	add_action( 'init', 'devn_aaika_helper_init' );
	
	
	function devn_aaika_register_type( $type = 'post' ){
		
		$devn_DOMAIN = 'devn';
		
		$args = array(
			array( __('Our Team', $devn_DOMAIN ), 'our-team', 'Staff', 'dashicons-groups', array('title','editor','thumbnail','page-attributes') ),
			array( __('Our Works', $devn_DOMAIN ), 'our-works', 'Project', 'dashicons-book', array('title','editor','author','thumbnail','excerpt','page-attributes') ),
			array( __('Testimonials', $devn_DOMAIN ), 'testimonials', 'Testimonial', 'dashicons-admin-comments', array('title','editor','thumbnail','page-attributes') ),
			array( __('FAQs', $devn_DOMAIN ), 'faq', 'FAQ', 'dashicons-editor-help', array('title','editor','page-attributes') ),
			array( __('Pricing Tables', $devn_DOMAIN ), 'pricing-tables', 'Pricing', 'dashicons-slides', array('title','page-attributes') ),
			array( __('Newsleter Subcribers', $devn_DOMAIN ), 'subcribers', 'Subcriber', 'dashicons-email-alt', array('title','page-attributes') ),
		);
		
		$arg_return = array();
		
		if( $type == 'post' ){
		
			foreach( $args as $arg ){
			
				$arg_return[ $arg[1] ] = array(
					'menu_icon' => $arg[3],
				    'labels' => array(
					    'name' => $arg[0],
					    'singular_name' => $arg[1],
					    'add_new' => 'Add new '.$arg[2],
					    'edit_item' => 'Edit '.$arg[2],
					    'new_item' => 'New '.$arg[2],
					    'add_new_item' => 'New '.$arg[2],
					    'view_item' => 'View '.$arg[2],
					    'search_items' => 'Search '.$arg[2].'s',
					    'not_found' => 'No '.$arg[2].' found',
					    'not_found_in_trash' => 'No '.$arg[2].' found in Trash'
				    ),
				    'public' => true,
				    'supports' => $arg[4],
				    'taxonomies' => array( 'category' )
			    );
			}
		}else if( $type == 'taxanomy' ){
			
			foreach( $args as $arg ){
			
				$arg_return[ $arg[1] ] = array(
					'hierarchical'          => false,
					'labels'                => array(
							'name'                       => _x( $arg[2].' Categories', 'taxonomy general name' ),
							'singular_name'              => _x( $arg[2].' Category', 'taxonomy singular name' ),
							'search_items'               => 'Search '.$arg[2].' Categories',
							'popular_items'              => 'Popular '.$arg[2].' Categories',
							'all_items'                  => 'All '.$arg[2].' Categories',
							'parent_item'                => null,
							'parent_item_colon'          => null,
							'edit_item'                  => 'Edit '.$arg[2].' Category',
							'update_item'                => 'Update '.$arg[2].' Category',
							'add_new_item'               => 'Add New '.$arg[2].' Category',
							'new_item_name'              => 'New '.$arg[2].' Category Name',
							'separate_items_with_commas' => 'Separate '.$arg[2].' Category with commas',
							'add_or_remove_items'        => 'Add or remove '.$arg[2].' Category',
							'choose_from_most_used'      => 'Choose from the most used '.$arg[2].' Category',
							'not_found'                  => 'No '.$arg[2].' Category found.',
							'menu_name'                  => $arg[2].' Categories',
						),
					'show_ui'               => true,
					'show_admin_column'     => true,
					'update_count_callback' => '_update_post_term_count',
					'query_var'             => true,
					'rewrite'               => array( 'slug' => $arg[1].'-category' ),
				);
			}
		}
		
		return $arg_return;
	
	}
	
		
	if( !function_exists( 'devn_mega_menu' ) ){
	
		function devn_add_sc_select() {
		
		    global $post;
		    if(isset($post -> ID)) {
		        if (!(get_post_type($post->ID) == 'mega_menu'))
		            return false;
		    } else {
		        return false;
		    }
		
		    echo '<select id="sc_select"><option>Insert Mega Menu</option>';
		    $menus = get_terms('nav_menu');
		    foreach($menus as $menu) {
		        echo '<option value="[mega_menu col=\'3\' title=\''.$menu->name.
		        '\' menu=\''.$menu->slug.
		        '\']">'.$menu->name.
		        '</option>';
		    }
		    echo '</select>';
		}
		add_action('media_buttons', 'devn_add_sc_select', 1003);
	
	
		function devn_mega_menu($atts, $content = null) {
			
			$_server = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			
		    extract( shortcode_atts( array('menu' => '', 'title' => '', 'col' => 12 ), $atts ) );
		    
			global $wpdb;
			
			$menuID = $wpdb->get_results('SELECT `term_id` FROM `'.$wpdb->prefix.'terms` WHERE `'.$wpdb->prefix.'terms`.`slug` = "'.esc_attr($menu).'"');
			
			
			if( empty( $menuID[0] ) ){
				return;
			}
			if( empty( $menuID[0]->term_id ) ){
				return;
			}
			
			$menu = $menuID[0]->term_id;
		    $items = wp_get_nav_menu_items( $menu );
		
		    $output = '<ul class="col-md-'.$col.' col-sm-'.($col*2).' list-unstyled">';
			if ($title)$output.= '<li><p>'.$title.'</p></li>';
		    if ($items) {
		        foreach($items as $item) {
		        	
		        	if( $item->url == 'http://'.$_server || $item->url == 'https://'.$_server ){
			        	$_class = ' class="active"';
		        	}else{
			        	$_class = '';
		        	}
		            $output .= '<li><a href="'.$item->url.'" '.$_class.'>';
		            if( strpos( $item->description, 'icon:') !== false ){
						$output .= ' <i class="fa fa-'.trim(str_replace( 'icon:', '', $item->description )).'"></i> ';	
					}else{
						$output .= ' <i class="fa fa-angle-right"></i> ';
					}
		            $output .= $item->title.'</a></li>';
		        }
		    }
		
		    $output.= '</ul>';
		
		    return $output;
		    
		}
		
		add_shortcode('mega_menu', 'devn_mega_menu');
	
	}
	  

}	 
