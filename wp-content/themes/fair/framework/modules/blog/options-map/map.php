<?php

if ( ! function_exists('fair_edge_blog_options_map') ) {

	function fair_edge_blog_options_map() {

		fair_edge_add_admin_page(
			array(
				'slug' => '_blog_page',
				'title' => 'Blog',
				'icon' => 'fa fa-files-o'
			)
		);

		/**
		 * Blog Lists
		 */

		$custom_sidebars = fair_edge_get_custom_sidebars();

		$panel_blog_lists = fair_edge_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_lists',
				'title' => 'Blog Lists'
			)
		);

		fair_edge_add_admin_field(array(
			'name'        => 'blog_list_type',
			'type'        => 'select',
			'label'       => 'Blog Layout for Archive Pages',
			'description' => 'Choose a default blog layout',
			'default_value' => 'standard',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'standard'				=> 'Blog: Standard',
				'masonry' 				=> 'Blog: Masonry',
				'masonry-full-width' 	=> 'Blog: Masonry Full Width',
				'standard-whole-post' 	=> 'Blog: Standard Whole Post',
				'narrow'				=> 'Blog: Narrow'
			)
		));

		fair_edge_add_admin_field(array(
			'name'        => 'archive_sidebar_layout',
			'type'        => 'select',
			'label'       => 'Archive and Category Sidebar',
			'description' => 'Choose a sidebar layout for archived Blog Post Lists and Category Blog Lists',
			'parent'      => $panel_blog_lists,
			'options'     => array(
				'default'			=> 'No Sidebar',
				'sidebar-33-right'	=> 'Sidebar 1/3 Right',
				'sidebar-25-right' 	=> 'Sidebar 1/4 Right',
				'sidebar-33-left' 	=> 'Sidebar 1/3 Left',
				'sidebar-25-left' 	=> 'Sidebar 1/4 Left',
			)
		));


		if(count($custom_sidebars) > 0) {
			fair_edge_add_admin_field(array(
				'name' => 'blog_custom_sidebar',
				'type' => 'selectblank',
				'label' => 'Sidebar to Display',
				'description' => 'Choose a sidebar to display on Blog Post Lists and Category Blog Lists. Default sidebar is "Sidebar Page"',
				'parent' => $panel_blog_lists,
				'options' => fair_edge_get_custom_sidebars()
			));
		}

		fair_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'pagination',
				'default_value' => 'yes',
				'label' => 'Pagination',
				'parent' => $panel_blog_lists,
				'description' => 'Enabling this option will display pagination links on bottom of Blog Post List',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_edgtf_pagination_container'
				)
			)
		);

		$pagination_container = fair_edge_add_admin_container(
			array(
				'name' => 'edgtf_pagination_container',
				'hidden_property' => 'pagination',
				'hidden_value' => 'no',
				'parent' => $panel_blog_lists,
			)
		);

		fair_edge_add_admin_field(
			array(
				'parent' => $pagination_container,
				'type' => 'text',
				'name' => 'blog_page_range',
				'default_value' => '',
				'label' => 'Pagination Range limit',
				'description' => 'Enter a number that will limit pagination to a certain range of links',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		fair_edge_add_admin_field(array(
			'name'        => 'masonry_pagination',
			'type'        => 'select',
			'label'       => 'Pagination on Masonry',
			'description' => 'Choose a pagination style for Masonry Blog List',
			'parent'      => $pagination_container,
			'options'     => array(
				'standard'			=> 'Standard',
				'load-more'			=> 'Load More',
				'infinite-scroll' 	=> 'Infinite Scroll'
			),
			
		));

		fair_edge_add_admin_field(array(
			'name'        => 'masonry_gallery_pagination',
			'type'        => 'selectblank',
			'default_value'=> '',
			'label'       => 'Pagination on Masonry Gallery',
			'description' => 'Choose a pagination style for Masonry Gallery Blog List',
			'parent'      => $pagination_container,
			'options'     => array(
				'standard'			=> 'Standard',
				'load-more'			=> 'Load More',
				'infinite-scroll' 	=> 'Infinite Scroll'
			),
			
		));

		fair_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'masonry_gallery_appear_animation',
				'default_value' => 'yes',
				'label' => 'Masonry Gallery Appear Animation',
				'parent' => $panel_blog_lists,
				'description' => 'Enabling this option will trigger appear animation effect for Blog Masonry Gallery page templates',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		fair_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'masonry_filter',
				'default_value' => 'no',
				'label' => 'Masonry Filter',
				'parent' => $panel_blog_lists,
				'description' => 'Enabling this option will display category filter on Masonry and Masonry Full Width Templates',
				'args' => array(
					'col_width' => 3
				)
			)
		);		
		fair_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'number_of_chars',
				'default_value' => '',
				'label' => 'Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);
		fair_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'standard_number_of_chars',
				'default_value' => '',
				'label' => 'Standard Type Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);
		fair_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'masonry_number_of_chars',
				'default_value' => '',
				'label' => 'Masonry Type Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);
		fair_edge_add_admin_field(
			array(
				'type' => 'text',
				'name' => 'narrow_number_of_chars',
				'default_value' => '',
				'label' => 'Narrow Type Number of Words in Excerpt',
				'parent' => $panel_blog_lists,
				'description' => 'Enter a number of words in excerpt (article summary)',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		/**
		 * Blog Single
		 */
		$panel_blog_single = fair_edge_add_admin_panel(
			array(
				'page' => '_blog_page',
				'name' => 'panel_blog_single',
				'title' => 'Blog Single'
			)
		);

		fair_edge_add_admin_field(array(
			'name'        => 'blog_single_type',
			'type'        => 'select',
			'label'       => 'Single Post Type',
			'description' => 'Choose type for Single Post pages',
			'parent'      => $panel_blog_single,
			'options'     => array(
				'standard'            => 'Standard',
				'with-title-image'   => 'With Title Image'
			),
			'default_value'	=> 'standard',
			'args' => array(
				'dependence' => true,
				'show' => array(
					'standard' => '',
					'with-title-image' => '#edgtf_single_with_title_image_container'
				),
				'hide' => array(
					'standard' => '#edgtf_single_with_title_image_container',
					'with-title-image' => ''
				)
			)
		));

		$single_with_title_image_container = fair_edge_add_admin_container(
			array(
				'name' => 'single_with_title_image_container',
				'parent' => $panel_blog_single,
				'hidden_property' => 'blog_single_type',
				'hidden_value' => 'standard'
			)
		);

		fair_edge_add_admin_field(array(
			'name'        => 'blog_single_image_bottom_width',
			'type'        => 'text',
			'label'       => 'Info Section Width',
			'description' => 'Here you can define the width of the post info section (the section at the bottom of the post that displays the post author, share buttons, comments, related posts, etc.)',
			'parent'      => $single_with_title_image_container,
			'args'        => array(
				'col_width' => 3,
				'suffix' => '%'
			)
		));

		fair_edge_add_admin_field(array(
			'name'        => 'blog_single_sidebar_layout',
			'type'        => 'select',
			'label'       => 'Sidebar Layout',
			'description' => 'Choose a sidebar layout for Blog Single pages',
			'parent'      => $panel_blog_single,
			'options'     => array(
				'default'			=> 'No Sidebar',
				'sidebar-33-right'	=> 'Sidebar 1/3 Right',
				'sidebar-25-right' 	=> 'Sidebar 1/4 Right',
				'sidebar-33-left' 	=> 'Sidebar 1/3 Left',
				'sidebar-25-left' 	=> 'Sidebar 1/4 Left',
			),
			'default_value'	=> 'default'
		));


		if(count($custom_sidebars) > 0) {
			fair_edge_add_admin_field(array(
				'name' => 'blog_single_custom_sidebar',
				'type' => 'selectblank',
				'label' => 'Sidebar to Display',
				'description' => 'Choose a sidebar to display on Blog Single pages. Default sidebar is "Sidebar"',
				'parent' => $panel_blog_single,
				'options' => fair_edge_get_custom_sidebars()
			));
		}


		fair_edge_add_admin_field(array(
			'name'          => 'blog_single_title_in_title_area',
			'type'          => 'yesno',
			'label'         => 'Show Post Title in Title Area',
			'description'   => 'Enabling this option will show post title in title area on single post pages (will not take any effect on With Title Image type)',
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		fair_edge_add_admin_field(array(
			'name'			=> 'blog_single_related_posts',
			'type'			=> 'yesno',
			'label'			=> 'Show Related Posts',
			'description'   => 'Enabling this option will show related posts on your single post.',
			'parent'        => $panel_blog_single,
			'default_value' => 'no'
		));

		fair_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_single_navigation',
				'default_value' => 'no',
				'label' => 'Enable Prev/Next Single Post Navigation Links',
				'parent' => $panel_blog_single,
				'description' => 'Enable navigation links through the blog posts (left and right arrows will appear)',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_edgtf_blog_single_navigation_container'
				)
			)
		);

		$blog_single_navigation_container = fair_edge_add_admin_container(
			array(
				'name' => 'edgtf_blog_single_navigation_container',
				'hidden_property' => 'blog_single_navigation',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		fair_edge_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_navigation_through_same_category',
				'default_value' => 'no',
				'label'       => 'Enable Navigation Only in Current Category',
				'description' => 'Limit your navigation only through current category',
				'parent'      => $blog_single_navigation_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

		fair_edge_add_admin_field(
			array(
				'type' => 'yesno',
				'name' => 'blog_author_info',
				'default_value' => 'no',
				'label' => 'Show Author Info Box',
				'parent' => $panel_blog_single,
				'description' => 'Enabling this option will display author name and descriptions on Blog Single pages',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#edgtf_edgtf_blog_single_author_info_container'
				)
			)
		);

		$blog_single_author_info_container = fair_edge_add_admin_container(
			array(
				'name' => 'edgtf_blog_single_author_info_container',
				'hidden_property' => 'blog_author_info',
				'hidden_value' => 'no',
				'parent' => $panel_blog_single,
			)
		);

		fair_edge_add_admin_field(
			array(
				'type'        => 'yesno',
				'name' => 'blog_author_info_email',
				'default_value' => 'no',
				'label'       => 'Show Author Email',
				'description' => 'Enabling this option will show author email',
				'parent'      => $blog_single_author_info_container,
				'args' => array(
					'col_width' => 3
				)
			)
		);

	}

	add_action( 'fair_edge_options_map', 'fair_edge_blog_options_map', 12);

}











