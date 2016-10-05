<?php

/*
*	Register extend component for Visual Composer
*	king-theme.com
*/



if (function_exists('vc_map')) {

	if(!function_exists('devn_extend_visual_composer')){
		
		add_action( 'init', 'devn_extend_visual_composer' );
		function devn_extend_visual_composer(){
			
			global $vc_column_width_list, $devn;
			$vc_is_wp_version_3_6_more = version_compare( preg_replace( '/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo( 'version' ) ), '3.6' ) >= 0;
			
			vc_map( array(
		    
		        "name" => __("Row", "js_composer"),
		        "base" => "vc_row",
		        "is_container" => true,
		        "icon" => "icon-wpb-row",
		        "show_settings_on_create" => true,
		        "category" => THEME_NAME.' Theme',
		        "description" => __('Place content elements inside the row', 'aaikadomain' ),
		        "params" => array(
		          array(
		            "type" => "textfield",
		            "heading" => __("ID Name for Navigation", "js_composer"),
		            "param_name" => "devn_id",
		            "description" => __("If this row wraps the content of one of your sections, set an ID. You can then use it for navigation. Ex: work", "js_composer")
		          ),
		           array(
		            "type" => "attach_image",
		            "heading" => __("Background Image", "js_composer"),
		            "param_name" => "bg_image",
		            "description" => __("Select backgound color for the row.", "js_composer")
		          ),
		          array(
		            "type" => "dropdown",
		            "heading" => __('Background Repeat', 'aaikadomain' ),
		            "param_name" => "devn_bg_repeat",
		            "value" => array(
		              __("Repeat-Y", 'aaikadomain' ) => 'repeat-y',
		              __("Repeat", 'aaikadomain' ) => 'repeat',
		              __('No Repeat', 'aaikadomain' ) => 'no-repeat',
		              __('Repeat-X', 'aaikadomain' ) => 'repeat-x'
		            )
		          ),
		          array(
		            "type" => "colorpicker",
		            "heading" => __('Background Color', 'aaikadomain' ),
		            "param_name" => "bg_color",
		            "description" => __("You can set a color over the background image. You can make it more or less opaque, by using the next setting. Default: white ", "js_composer")
		          ),
		          array(
		            "type" => "textfield",
		            "heading" => __('Background Color Opacity', 'aaikadomain' ),
		            "param_name" => "devn_color_opacity",
		            "description" => __("Set an opacity value for the color(values between 0-100). 0 means no color while 100 means solid color. Default: 70 ", "js_composer")
		          ),
		          array(
		            "type" => "textfield",
		            "heading" => __("Padding Top", "js_composer"),
		            "param_name" => "devn_padding_top",
		            "description" => __("Enter a value and it will be used for padding-top(px). As an alternative, use the 'Space' element.", "js_composer")
		          ),
		          array(
		            "type" => "textfield",
		            "heading" => __("Padding Bottom", "js_composer"),
		            "param_name" => "devn_padding_bottom",
		            "description" => __("Enter a value and it will be used for padding-bottom(px). As an alternative, use the 'Space' element.", "js_composer")
		          ),
		          array(
		            "type" => "dropdown",
		            "heading" => __('Remove margin bottom?', 'aaikadomain' ),
		            "param_name" => "devn_no_mb",
		            "description" => __("The row has a bottom margin of 20px. You can remove it.", "js_composer"),
		            "value" => array(
		           		 __("Yes Please!", 'aaikadomain' ) => 'no-margin',
				   		 __("No thanks!", 'aaikadomain' ) => '',
		            ),
		          ),
		          array(
		            "type" => "textfield",
		            "heading" => __("Container class name", "js_composer"),
		            "param_name" => "devn_class_container",
		            "description" => __("Custom class name for container of this row", "js_composer")
		          ),		          
		          array(
		            "type" => "textfield",
		            "heading" => __("Section class name", "js_composer"),
		            "param_name" => "devn_class",
		            "description" => __("Custom class for outermost wrapper.", "js_composer")
		          ),
		          array(
		            "type" => "dropdown",
		            "heading" => __('Type', 'aaikadomain' ),
		            "param_name" => "devn_row_type",
		            "description" => __("Select template full-width if you want to background full of screen", "js_composer"),
		            "value" => array(
		              __("Content In Container", 'aaikadomain' ) => 'container',
		              __("Fullwidth All", 'aaikadomain' )    => 'container_full',
		              __("Parallax", 'aaikadomain' )     => 'parallax'
		            )
		          ),
		        ),
		        "js_view" => 'VcRowView'
		      ) );
		      
		      
		      vc_map( array(
				'name' => __( 'Row', 'aaikadomain'  ), //Inner Row
				'base' => 'vc_row_inner',
				'content_element' => false,
				'is_container' => true,
				'icon' => 'icon-wpb-row',
				'weight' => 1000,
				'show_settings_on_create' => false,
				'description' => __( 'Place content elements inside the row', 'aaikadomain'  ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'aaikadomain'  ),
						'param_name' => 'devn_class',
						'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aaikadomain'  )
					),
					array(
			            "type" => "dropdown",
			            "heading" => __('Remove margin bottom?', 'aaikadomain' ),
			            "param_name" => "devn_no_mb",
			            "description" => __("The row has a bottom margin of 20px. You can remove it.", "js_composer"),
			            "value" => array(
			           		 __("Yes Please!", 'aaikadomain' ) => 'no-margin',
					   		 __("No thanks!", 'aaikadomain' ) => '',
			            )
			        ),
				),
				'js_view' => 'VcRowView'
			) );
		      
		      
		      vc_map( array(
				'name' => __( 'Column', 'aaikadomain'  ),
				'base' => 'vc_column',
				'is_container' => true,
				'content_element' => false,
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'aaikadomain'  ),
						'param_name' => 'el_class',
						'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aaikadomain'  )
					),					
					array(
						'type' => 'dropdown',
						'heading' => __( 'Animate Effect', 'aaikadomain'  ),
						'param_name' => 'el_animate',
						'value' => array(
							'---Select an animate---' => '',
							'Fade In' => 'animated eff-fadeIn',
							'From bottom up' => 'animated eff-fadeInUp',
							'From top down' => 'animated eff-fadeInDown',
							'From left' => 'animated eff-fadeInLeft',
							'From right' => 'animated eff-fadeInRight',
							'Zoom In' => 'animated eff-zoomIn',
							'Bounce In' => 'animated eff-bounceIn',
							'Bounce In Up' => 'animated eff-bounceInUp',
							'Bounce In Down' => 'animated eff-bounceInDown',
							'Bounce In Out' => 'animated eff-bounceInOut',
						),
						'description' => __( 'Select animate effects to show this column when port-viewer scroll over', 'aaikadomain'  )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Animate Delay', 'aaikadomain'  ),
						'param_name' => 'el_delay',
						'description' => __( 'Delay animate effect after number of mili seconds, e.g: 200 ', 'aaikadomain'  )
					),
					array(
						'type' => 'css_editor',
						'heading' => __( 'Css', 'aaikadomain'  ),
						'param_name' => 'css',
						// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aaikadomain'  ),
						'group' => __( 'Design options', 'aaikadomain'  )
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Width', 'aaikadomain'  ),
						'param_name' => 'width',
						'value' => $vc_column_width_list,
						'group' => __( 'Width & Responsiveness', 'aaikadomain'  ),
						'description' => __( 'Select column width.', 'aaikadomain'  ),
						'std' => '1/1'
					),
					array(
						'type' => 'column_offset',
						'heading' => __( 'Responsiveness', 'aaikadomain'  ),
						'param_name' => 'offset',
						'group' => __( 'Width & Responsiveness', 'aaikadomain'  ),
						'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'aaikadomain'  )
					)
				),
				'js_view' => 'VcColumnView'
			) );
			
			
			vc_map( array(
				"name" => __( "Column", "js_composer" ),
				"base" => "vc_column_inner",
				"class" => "",
				"icon" => "",
				"wrapper_class" => "",
				"controls" => "full",
				"allowed_container_element" => false,
				"content_element" => false,
				"is_container" => true,
				"params" => array(
					array(
						"type" => "textfield",
						"heading" => __( "Extra class name", "js_composer" ),
						"param_name" => "el_class",
						"value" => "",
						"description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" )
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Animate Effect', 'aaikadomain'  ),
						'param_name' => 'el_animate',
						'value' => array(
							'---Select an animate---' => '',
							'Fade In' => 'animated eff-fadeIn',
							'From bottom up' => 'animated eff-fadeInUp',
							'From top down' => 'animated eff-fadeInDown',
							'From left' => 'animated eff-fadeInLeft',
							'From right' => 'animated eff-fadeInRight',
							'Zoom In' => 'animated eff-zoomIn',
							'Bounce In' => 'animated eff-bounceIn',
							'Bounce In Up' => 'animated eff-bounceInUp',
							'Bounce In Down' => 'animated eff-bounceInDown',
							'Bounce In Out' => 'animated eff-bounceInOut',
						),
						'description' => __( 'Select animate effects to show this column when port-viewer scroll over', 'aaikadomain'  )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Animate Delay', 'aaikadomain'  ),
						'param_name' => 'el_delay',
						'description' => __( 'Delay animate effect after number of mili seconds, e.g: 200 ', 'aaikadomain'  )
					),
					array(
						"type" => "css_editor",
						"heading" => __( 'Css', "js_composer" ),
						"param_name" => "css",
						// "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
						"group" => __( 'Design options', 'aaikadomain'  )
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Width', 'aaikadomain'  ),
						'param_name' => 'width',
						'value' => $vc_column_width_list,
						'group' => __( 'Width & Responsiveness', 'aaikadomain'  ),
						'description' => __( 'Select column width.', 'aaikadomain'  ),
						'std' => '1/1'
					)
				),
				"js_view" => 'VcColumnView'
			) );
			
		    vc_map( array(
				'name' => __( 'X-Code Editor', 'aaikadomain'  ),
				'base' => 'vc_raw_html',
				'icon' => 'icon-wpb-raw-html',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'Custom code php, html, javascript, css, shortcodes', 'aaikadomain'  ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __( 'Title', 'aaikadomain'  ),
						'param_name' => 'title',
						'holder' => 'i',
						'description' => __( 'Label will display at VisualComposer admin', 'aaikadomain'  ),
						'admin_label' => true,
					),
					array(
						'type' => 'textarea_raw_html',
						'heading' => __( 'X-Code - PHP, HTML, Javascript, CSS, ShortCodes', 'aaikadomain'  ),
						'param_name' => 'content',
						'holder' => 'div',
						'value' => $devn->ext['be']( '<p>I am X-Code Editor (king-theme.com)<br/>Click edit button to change this code</p>' ),
						'description' => __( 'Enter your HTML, PHP, JavaScript, Css, Shortcodes.', 'aaikadomain'  )
					),
				)
			));	
				      
		    vc_map( array(
				'name' => __( 'FAQs', 'aaikadomain'  ),
				'base' => 'faq',
				'icon' => 'fa fa-question-circle',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'Output FAQs as accordion from faqs post type.', 'aaikadomain'  ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __( 'Amount', 'aaikadomain'  ),
						'param_name' => 'amount',
						'value' => 20,
						'admin_label' => true,
						'description' => __( 'Enter number of FAQs that you want to display. To edit FAQs, go to ', 'aaikadomain'  ).'/wp-admin/edit.php?post_type=faq'
					),
				)
			));
							      
		    vc_map( array(
				'name' => __( 'Our Team', 'aaikadomain'  ),
				'base' => 'team',
				'icon' => 'fa fa-group',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'Output our team template', 'aaikadomain'  ),
				'params' => array(
					array(
						'type' => 'multiple',
						'heading' => __( 'Select Category ( hold ctrl or shift to select multiple )', 'aaikadomain'  ),
						'param_name' => 'category',
						'values' => Su_Tools::get_terms( 'category', 'slug', 'our-team' ),
						'height' => '150px',
						'description' => __( 'Select category to display team', 'aaikadomain'  )
					),					
					array(
						'type' => 'dropdown',
						'heading' => __( 'Choose Style', 'aaikadomain'  ),
						'param_name' => 'style',
						'admin_label' => true,
						'value' => array(
							'Grids'				=> 'grids',
							'2 Columns'		=> '2-columns',
							'Circle' 			=> 'circle',
							'Circle Style 2'	=> 'circle-2',
							'Grids Style 2'		=> 'grids-2'
						),
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Amount', 'aaikadomain'  ),
						'param_name' => 'items',
						'value' => 20,
						'description' => __( 'Enter number of people to show', 'aaikadomain'  )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Words Limit', 'aaikadomain'  ),
						'param_name' => 'words',
						'value' => 20,
						'description' => __( 'Limit words you want show as short description', 'aaikadomain'  )
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Order By', 'aaikadomain'  ),
						'param_name' => 'order',
						'value' => array(
							'Descending' => 'desc',
							'Ascending' => 'asc'
						),
						'description' => ' &nbsp; '
					)
				)
			));
			
			vc_map( array(
				'name' => __( 'Our Work (Portfolio)', 'aaikadomain'  ),
				'base' => 'work',
				'icon' => 'fa fa-send-o',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'Our work for portfolio template.', 'aaikadomain'  ),
				'params' => array(
					array(
						'type' => 'multiple',
						'heading' => __( 'Select Category', 'aaikadomain'  ),
						'param_name' => 'tax_term',
						'values' => Su_Tools::get_terms( 'category', 'slug', 'our-works' ),
						'height' => '120px',
						'admin_label' => true,
						'description' => __( 'Select category which you chosen for Team items', 'aaikadomain'  )
					),					
					array(
						'type' => 'dropdown',
						'heading' => __( 'Show Filter', 'aaikadomain'  ),
						'param_name' => 'filter',
						'value' => array(
							'Yes'	=> 'Yes',
							'No'	=> 'No',
						),
					),
					array(
						'type' => 'select',
						'heading' => __( 'Items on Row', 'aaikadomain'  ),
						'param_name' => 'column',
						'values' => array(
							'two' => 2,
							' ' => 3,
							'four' => 4,
							'flat' => 'Flat Piece Style'
						),
						'description' => __( 'Choose number of items display on a row', 'aaikadomain'  )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Items Limit', 'aaikadomain'  ),
						'param_name' => 'items',
						'value' => get_option( 'posts_per_page' ),
						'description' => __( 'Specify number of team that you want to show. Enter -1 to get all team', 'aaikadomain'  )
					),
					array(
						'type' => 'select',
						'heading' => __( 'Order By', 'aaikadomain'  ),
						'param_name' => 'order',
						'values' => array(
								'desc' => __( 'Descending', 'aaikadomain' ),
								'asc' => __( 'Ascending', 'aaikadomain' )
						),
						'description' => ' &nbsp; '
					)
				)
			));
			
			vc_map( array(
				'name' => __( 'Testimonials', 'aaikadomain'  ),
				'base' => 'testimonials',
				'icon' => 'fa fa-group',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'Out testimonians post type.', 'aaikadomain'  ),
				'params' => array(
					array(
						'type' => 'select',
						'heading' => __( 'Select Layout', 'aaikadomain'  ),
						'param_name' => 'layout',
						'values' => array(
							'slider-1' => 'Slider Style 1',
							'slider-2' => 'Slider Style 2'
						),
						'admin_label' => true,
						'description' => __( 'Select layout to display testimonials', 'aaikadomain'  )
					),	
					array(
						'type' => 'textfield',
						'heading' => __( 'Items Limit', 'aaikadomain'  ),
						'param_name' => 'items',
						'value' => get_option( 'posts_per_page' ),
						'description' => __( 'Specify number of team that you want to show. Enter -1 to get all', 'aaikadomain'  )
					),						
					array(
						'type' => 'textfield',
						'heading' => __( 'Limit Words', 'aaikadomain'  ),
						'param_name' => 'words',
						'value' => 20,
						'description' => __( 'Limit words you want show as short description', 'aaikadomain'  )
					),
					array(
						'type' => 'select',
						'heading' => __( 'Order By', 'aaikadomain'  ),
						'param_name' => 'order',
						'values' => array(
								'desc' => __( 'Descending', 'aaikadomain' ),
								'asc' => __( 'Ascending', 'aaikadomain' ),
								'rand' => __( 'Random', 'aaikadomain' )
						),
						'description' => ' &nbsp; '
					)
				)
			));
						
			vc_map( array(
			
				'name' => __( 'Pie Chart', 'aaikadomain'  ),
				'base' => 'piechart',
				'icon' => 'fa fa-pie-chart',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'Out testimonians post type.', 'aaikadomain'  ),
				'params' => array(

					array(
						'type' => 'select',
						'param_name' => 'size',
						'values' => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
							'5' => '5',
							'6' => '6',
							'7' => '7',
							'8' => '8',
						),
						'value' => 7,
						'heading' => __( 'Size', 'aaikadomain' ),
						'description' => __( 'Size of chart', 'aaikadomain' )
					),
					
					array(
						'type' => 'select',
						'param_name' => 'style',
						'values' => array(
							'piechart1' => 'Pie Chart 1',
							'piechart2' => 'Pie Chart 2 (auto width by size)',
							'piechart3' => 'Pie Chart 3 (white color)'
						),
						'value' => 7,
						'heading' => __( 'Size', 'aaikadomain' ),
						'description' => __( 'Size of chart', 'aaikadomain' )
					),
					array(
						'param_name' => 'percent',
						'type' 	=> 'textfield',
						'value' => 75,
						'admin_label' => true,
						'heading' => __( 'Percent', 'aaikadomain' ),
						'description' => __( 'Percent value of chart', 'aaikadomain' )
					),
					array(
			            "type" => "colorpicker",
			            "heading" => __('Color', 'aaikadomain' ),
			            "param_name" => "color",
			            "description" => __("Color of chart", "js_composer")
			        ),
					array(
						'param_name' => 'text',
						'type' 	=> 'textfield',
						'heading' => __( 'Text', 'aaikadomain' ),
						'description' => __( 'The text bellow chart', 'aaikadomain' ),
						'admin_label' => true,
					),
					array(
						'param_name' => 'class',
						'type' 	=> 'textfield',
						'heading' => __( 'Class', 'aaikadomain' ),
						'description' => __( 'Extra CSS class', 'aaikadomain' )
					)
					
				)
			));

			vc_map( array(
			
				'name' => __( 'Pricing Table', 'aaikadomain'  ),
				'base' => 'pricing',
				'icon' => 'fa fa-table',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'Display Pricing Plan Table', 'aaikadomain'  ),
				'params' => array(

					array(
						'type' => 'select',
						'param_name' => 'amount',
						'values' => array(
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
						),
						'value' => 4,
						'heading' => __( 'Amount', 'aaikadomain' ),
						'description' => __( 'Number of columns', 'aaikadomain' )
					),
					array(
						'type' => 'select',
						'heading' => __( 'Select Category', 'aaikadomain'  ),
						'param_name' => 'category',
						'values' => Su_Tools::get_terms( 'category', 'slug', 'pricing-tables', 'Select Category' ),
						'admin_label' => true,
						'description' => __( 'Select category which you chosen for Pricing Table', 'aaikadomain'  )
					),	
					array(
						'type' => 'select',
						'param_name' => 'active',
						'values' => array(
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
						),
						'value' => 3,
						'heading' => __( 'Active Column', 'aaikadomain' ),
						'description' => __( 'Select column to highlight', 'aaikadomain' )
					),
					array(
						'type' => 'select',
						'param_name' => 'style',
						'values' => array(
								'1' => '1',
								'2' => '2',
								'3' => '3'
						),
						'heading' => __( 'Style', 'aaikadomain' ),
						'description' => __( 'Select style for pricing table', 'aaikadomain' )
					),
					array(
						'param_name' => 'icon',
						'type' 	=> 'icon',
						'heading' => __( 'Icon', 'aaikadomain' ),
						'description' => __( 'the icon display on per row', 'aaikadomain' )
					),
					array(
						'param_name' => 'class',
						'type' 	=> 'textfield',
						'heading' => __( 'Class', 'aaikadomain' ),
						'description' => __( 'Extra CSS class', 'aaikadomain' )
					)
					
				)
			));

			vc_map( array(
			
				'name' => __( 'Progress Bars', 'aaikadomain'  ),
				'base' => 'progress',
				'icon' => 'fa fa-line-chart',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'Display Progress Bars', 'aaikadomain'  ),
				'params' => array(

					array(
						'type' => 'select',
						'param_name' => 'style',
						'values' => array(
								'1' => '1',
								'2' => '2',
								'3' => '3',
								'4' => '4',
						),
						'heading' => __( 'Style', 'aaikadomain' ),
						'description' => __( 'Style of progress bar', 'aaikadomain' )
					),
					array(
						'type' => 'textfield',
						'param_name' => 'percent',
						'value' => 75,
						'admin_label' => true,
						'heading' => __( 'Percent', 'aaikadomain' ),
						'description' => __( 'Percent value of progress bar', 'aaikadomain' )
					),
					array(
						'type' => 'colorpicker',
						'param_name' => 'color',
						'value' => '#333333',
						'heading' => __( 'Color', 'aaikadomain' ),
						'description' => __( 'Color of progress bar', 'aaikadomain' )
					),
					array(
						'type' => 'textfield',
						'param_name' => 'text',
						'admin_label' => true,
						'heading' => __( 'Text', 'aaikadomain' ),
						'description' => __( 'The text bellow chart', 'aaikadomain' )
					),
					array(
						'type' => 'textfield',
						'param_name' => 'class',
						'heading' => __( 'Class', 'aaikadomain' ),
						'description' => __( 'Extra CSS class', 'aaikadomain' )
					)
					
				)
			));
			
			vc_map( array(
			
				'name' => __( 'Divider', 'aaikadomain'  ),
				'base' => 'divider',
				'icon' => 'icon-wpb-ui-separator',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'List of horizontal divider line', 'aaikadomain'  ),
				'params' => array(

					array(
						'type' => 'select',
						'param_name' => 'style',
						'values' => array(
								'1' => 'Style 1',
								'2' => 'Style 2',
								'3' => 'Style 3',
								'4' => 'Style 4',
								'5' => 'Style 5',
								'6' => 'Style 6',
								'7' => 'Style 7',
								'8' => 'Style 8',
								'9' => 'Style 9',
								'10' => 'Style 10',
								'11' => 'Style 11',
								'12' => 'Style 12',
								'13' => 'Style 13',
						),
						'admin_label' => true,
						'heading' => __( 'Style', 'aaikadomain' ),
						'description' => __( 'Style of divider', 'aaikadomain' )
					),
					array(
						'type' => 'icon',
						'param_name' => 'icon',
						'heading' => __( 'Icon', 'aaikadomain' ),
						'description' => __( 'Select icon on divider', 'aaikadomain' )
					),
					array(
						'type' => 'textfield',
						'param_name' => 'class',
						'heading' => __( 'Class', 'aaikadomain' ),
						'description' => __( 'Extra CSS class', 'aaikadomain' )
					)
					
				)
			));
						
			vc_map( array(
			
				'name' => __( 'Title Styles', 'aaikadomain'  ),
				'base' => 'titles',
				'icon' => 'fa fa-university',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'List of Title Styles', 'aaikadomain'  ),
				'params' => array(

					array(
						'type' => 'select',
						'param_name' => 'style',
						'values' => array(
								'1' => 'Style 1',
								'2' => 'Style 2',
								'3' => 'Style 3',
								'4' => 'Style 4',
								'5' => 'Style 5',
								'6' => 'Style 6',
								'7' => 'Style 7',
								'8' => 'Style 8',
								'9' => 'Style 9',
								'10' => 'Style 10 (with icon)',
								'11' => 'Style 11',
								'12' => 'Style 12',
								'page' => 'Page Title',
								'sec1' => 'Section Title 1',
								'sec2' => 'Section Title 2',
								'sec3' => 'Section Title 3 ( icon)'
						),
						'admin_label' => true,
						'heading' => __( 'Style', 'aaikadomain' ),
						'description' => __( 'Style of divider', 'aaikadomain' )
					),
					array(
						'type' => 'textfield',
						'param_name' => 'text',
						'heading' => __( 'Title Text', 'aaikadomain' ),
						'admin_label' => true,
					),						
					array(
						'type' => 'textfield',
						'param_name' => 'boldtext',
						'heading' => __( 'Title Bold Text', 'aaikadomain' ),
						'description' => __( 'Put the text you want to be bold', 'aaikadomain' )
					),					
					array(
						'type' => 'textfield',
						'param_name' => 'subtext',
						'heading' => __( 'Sub Title Text', 'aaikadomain' ),
						'admin_label' => true,
					),					
					array(
						'type' => 'icon',
						'param_name' => 'icon',
						'heading' => __( 'Icon', 'aaikadomain' ),
						'description' => __( 'Select icon to use ONLY for style 10', 'aaikadomain' )
					),
					array(
						'type' => 'textfield',
						'param_name' => 'class',
						'heading' => __( 'Class', 'aaikadomain' ),
						'description' => __( 'Extra CSS class', 'aaikadomain' )
					)
					
				)
			));
			
			vc_map( array(
			
				'name' => __( 'Flip Clients', 'aaikadomain'  ),
				'base' => 'flip_clients',
				'icon' => 'fa fa-apple',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'Display clients with flip styles', 'aaikadomain'  ),
				'params' => array(

					array(
						'type' => 'attach_image',
						'param_name' => 'img',
						'heading' => __( 'Logo Image', 'aaikadomain' ),
						'description' => __( 'Upload the client\'s logo', 'aaikadomain' )
					),
					array(
						'type' => 'textfield',
						'param_name' => 'title',
						'heading' => __( 'Title', 'aaikadomain' ),
						'admin_label' => true,
						'description' => __( 'The name of client', 'aaikadomain' )
					),						
					array(
						'type' => 'textfield',
						'param_name' => 'link',
						'heading' => __( 'Link', 'aaikadomain' ),
						'description' => __( 'Link to client website', 'aaikadomain' )
					),					
					array(
						'type' => 'textfield',
						'param_name' => 'des',
						'heading' => 'Description',
						'description' => __( 'Short Descript will show when hover', 'aaikadomain' ),
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'param_name' => 'class',
						'heading' => __( 'Class', 'aaikadomain' ),
						'description' => __( 'Extra CSS class', 'aaikadomain' )
					)
					
				)
			));
						
			vc_map( array(
			
				'name' => __( 'Posts - '.THEME_NAME, 'aaikadomain'  ),
				'base' => 'posts',
				'icon' => 'fa fa-th-list',
				'category' => THEME_NAME.' Theme',
				'wrapper_class' => 'clearfix',
				'description' => __( 'List posts by other layouts of theme', 'aaikadomain'  ),
				'params' => array(

					array(
						'type' => 'select',
						'param_name' => 'template',
						'values' => array(
								'default-loop.php' => 'Default Loop',
								'single-post.php' => 'Single Post',
								'list-loop.php' => 'List Loop',
								'flip-horizontal.php' => 'Flip Horizontal',
								'flip-vertical.php' => 'Flip Vertical',
								'footer-loop.php' => 'Footer Loop',
								'home-news-metro.php' => 'Home News Metro',
								'home-news.php' => 'Home News',
								'recent-onepage.php' => 'Recent Onepage',
								'recents-slider.php' => 'Recents Slider',
								'services-loop.php' => 'Services Loop'
						),
						'admin_label' => true,
						'heading' => __( 'Template', 'aaikadomain' ),
						'description' => __( 'List posts under templates of theme', 'aaikadomain' )
					),
					array(
						'type' => 'textfield',
						'param_name' => 'id',
						'heading' => __( 'Post ID\'s', 'aaikadomain' ),
						'description' => __( 'Enter comma separated ID\'s of the posts that you want to show', 'aaikadomain' )
					),				
					array(
						'type' => 'textfield',
						'param_name' => 'posts_per_page',
						'value' => get_option( 'posts_per_page' ),
						'heading' => __( 'Posts per page', 'aaikadomain' ),
						'description' => __( 'Specify number of posts that you want to show. Enter -1 to get all posts', 'aaikadomain' )
					),					
					array(
						'type' => 'select',
						'param_name' => 'post_type',
						'values' => Su_Tools::get_types(),
						'value' => 'post',
						'heading' => __( 'Post types', 'aaikadomain' ),
						'description' => __( 'Select post types. Hold Ctrl key to select multiple post types', 'aaikadomain' )
					),					
					array(
						'type' => 'select',
						'param_name' => 'taxonomy',
						'values' => Su_Tools::get_taxonomies(),
						'value' => 'category',
						'heading' => __( 'Taxonomy', 'aaikadomain' ),
						'description' => __( 'Select taxonomy to show posts from', 'aaikadomain' )
					),
					array(
						'type' => 'multiple',
						'param_name' => 'tax_term',
						'values' => Su_Tools::get_terms( 'category', 'slug' ),
						'heading' => __( 'Terms', 'aaikadomain' ),
						'description' => __( 'Select terms to show posts from', 'aaikadomain' )
					),					
					array(
						'type' => 'select',
						'param_name' => 'tax_operator',
						'values' => array( 'IN' => 'IN', 'NOT IN' => 'NOT IN', 'AND' => 'AND' ),
						'value' => 'IN',
						'heading' => __( 'Taxonomy term operator', 'aaikadomain' ),
						'description' => __( 'IN - posts that have any of selected categories terms<br/>NOT IN - posts that is does not have any of selected terms<br/>AND - posts that have all selected terms', 'aaikadomain' )
					),					
					array(
						'type' => 'multiple',
						'param_name' => 'author',
						'values' => Su_Tools::get_users(),
						'value' => 'default',
						'heading' => __( 'Authors', 'aaikadomain' ),
						'description' => __( 'Choose the authors whose posts you want to show', 'aaikadomain' )
					),
					array(
						'type' => 'textfield',
						'param_name' => 'meta_key',
						'heading' => __( 'Meta key', 'aaikadomain' ),
						'description' => __( 'Enter meta key name to show posts that have this key', 'aaikadomain' )
					),					
					array(
						'type' => 'textfield',
						'param_name' => 'offset',
						'value' => '0',
						'heading' => __( 'Offset', 'aaikadomain' ),
						'description' => __( 'Specify offset to start posts loop not from first post', 'aaikadomain' )
					),
					array(
						'type' => 'select',
						'values' => array(
							'desc' => __( 'Descending', 'aaikadomain' ),
							'asc' => __( 'Ascending', 'aaikadomain' )
						),
						'param_name' => 'order',
						'heading' => __( 'Offset', 'aaikadomain' ),
						'description' => __( 'Posts order', 'aaikadomain' )
					),
					array(
						'type' => 'select',
						'values' => array(
							'none' => __( 'None', 'aaikadomain' ),
							'id' => __( 'Post ID', 'aaikadomain' ),
							'author' => __( 'Post author', 'aaikadomain' ),
							'title' => __( 'Post title', 'aaikadomain' ),
							'name' => __( 'Post slug', 'aaikadomain' ),
							'date' => __( 'Date', 'aaikadomain' ), 'modified' => __( 'Last modified date', 'aaikadomain' ),
							'parent' => __( 'Post parent', 'aaikadomain' ),
							'rand' => __( 'Random', 'aaikadomain' ), 'comment_count' => __( 'Comments number', 'aaikadomain' ),
							'menu_order' => __( 'Menu order', 'aaikadomain' ), 'meta_value' => __( 'Meta key values', 'aaikadomain' ),
						),
						'value' => 'date',
						'param_name' => 'orderby',
						'heading' => __( 'Order by', 'aaikadomain' ),
						'description' => __( 'Order posts by', 'aaikadomain' )
					),					
					array(
						'type' => 'textfield',
						'param_name' => 'post_parent',
						'heading' => __( 'Post parent', 'aaikadomain' ),
						'description' => __( 'Show childrens of entered post (enter post ID)', 'aaikadomain' )
					),					
					array(
						'type' => 'select',
						'values' => array(
							'publish' => __( 'Published', 'aaikadomain' ),
							'pending' => __( 'Pending', 'aaikadomain' ),
							'draft' => __( 'Draft', 'aaikadomain' ),
							'auto-draft' => __( 'Auto-draft', 'aaikadomain' ),
							'future' => __( 'Future post', 'aaikadomain' ),
							'private' => __( 'Private post', 'aaikadomain' ),
							'inherit' => __( 'Inherit', 'aaikadomain' ),
							'trash' => __( 'Trashed', 'aaikadomain' ),
							'any' => __( 'Any', 'aaikadomain' ),
						),
						'value' => 'publish',
						'param_name' => 'post_status',
						'heading' => __( 'Post status', 'aaikadomain' ),
						'description' => __( 'Show only posts with selected status', 'aaikadomain' )
					),					
					array(
						'type' => 'select',
						'values' => array( 'no' => 'no', 'yes' => 'yes' ),
						'param_name' => 'ignore_sticky_posts',
						'heading' => __( 'Ignore sticky', 'aaikadomain' ),
						'description' => __( 'Select Yes to ignore posts that is sticked', 'aaikadomain' )
					),
					
				)
			));

			vc_map( array(
				'name' => __( 'Accordion', 'aaikadomain'  ),
				'base' => 'vc_accordion',
				'show_settings_on_create' => false,
				'is_container' => true,
				'icon' => 'icon-wpb-ui-accordion',
				'category' => THEME_NAME.' Theme',
				'description' => __( 'Collapsible content panels', 'aaikadomain'  ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __( 'Widget title', 'aaikadomain'  ),
						'param_name' => 'title',
						'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'aaikadomain'  )
					),
					array(
						'type' => 'select',
						'heading' => __( 'Style', 'aaikadomain'  ),
						'param_name' => 'style',
						'values' => array(
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'2 white' => 'white color',
						),
						'description' => __( 'Select style of accordion.', 'aaikadomain'  )
					),
					array(
						'type' => 'select',
						'heading' => __( 'Icon', 'aaikadomain'  ),
						'param_name' => 'icon',
						'values' => array(
							'icon-plus' => 'Icon Plus',
							'icon-plus-circle' => 'Plus Circle',
							'icon-plus-square-1' => 'Plus Square 1',
							'icon-plus-square-2' => 'Plus Square 2',
							'icon-arrow' => 'Icon Arrow',
							'icon-arrow-circle-1' => 'Arrow Circle 1',
							'icon-arrow-circle-2' => 'Arrow Circle 2',
							'icon-chevron' => 'Icon Chevron',
							'icon-chevron-circle' => 'Icon Chevron Circle',
							'icon-caret' => 'Icon Caret',
							'icon-caret-square' => 'Icon Caret Square',
							'icon-folder-1' => 'Icon Folder 1',
							'icon-folder-2' => 'Icon Folder 2',
						),
						'description' => __( 'Select icon display on each spoiler', 'aaikadomain'  )
					),	
					array(
						'type' => 'textfield',
						'heading' => __( 'Active section', 'aaikadomain'  ),
						'param_name' => 'active_tab',
						'description' => __( 'Enter section number to be active on load or enter false to collapse all sections.', 'aaikadomain'  )
					),
					array(
						'type' => 'checkbox',
						'heading' => __( 'Allow collapsible all', 'aaikadomain'  ),
						'param_name' => 'collapsible',
						'description' => __( 'Select checkbox to allow all sections to be collapsible.', 'aaikadomain'  ),
						'value' => array( __( 'Allow', 'aaikadomain'  ) => 'yes' )
					),
					array(
						'type' => 'checkbox',
						'heading' => __( 'Disable keyboard interactions', 'aaikadomain'  ),
						'param_name' => 'disable_keyboard',
						'description' => __( 'Disables keyboard arrows interactions LEFT/UP/RIGHT/DOWN/SPACES keys.', 'aaikadomain'  ),
						'value' => array( __( 'Disable', 'aaikadomain'  ) => 'yes' )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'aaikadomain'  ),
						'param_name' => 'el_class',
						'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aaikadomain'  )
					)
				),
				'custom_markup' => '
					<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">
					%content%
					</div>
					<div class="tab_controls">
					    <a class="add_tab" title="' . __( 'Add section', 'aaikadomain'  ) . '"><span class="vc_icon"></span> <span class="tab-label">' . __( 'Add section', 'aaikadomain'  ) . '</span></a>
					</div>
				',
					'default_content' => '
				    [vc_accordion_tab title="' . __( 'Section 1', 'aaikadomain'  ) . '"][/vc_accordion_tab]
				    [vc_accordion_tab title="' . __( 'Section 2', 'aaikadomain'  ) . '"][/vc_accordion_tab]
				',
				'js_view' => 'VcAccordionView'
			));

			
			$tab_id_1 = 'def' . time() . '-1-' . rand( 0, 100 );
			$tab_id_2 = 'def' . time() . '-2-' . rand( 0, 100 );
			vc_map( array(
				"name" => __( 'Tabs - Sliders', 'aaikadomain'  ),
				'base' => 'vc_tabs',
				'show_settings_on_create' => false,
				'is_container' => true,
				'icon' => 'icon-wpb-ui-tab-content',
				'category' => THEME_NAME.' Theme',
				'description' => __( 'Custom Tabs, Sliders', 'aaikadomain'  ),
				'params' => array(
					array(
						'type' => 'select',
						'heading' => __( 'Display as', 'aaikadomain'  ),
						'values' => array(
							'tabs' => 'Display as Tabs',
							'sliders' => 'Display as Flex Sliders'
						),
						'admin_label' => true,
						'param_name' => 'type',
						'description' => __( 'You can choose to display as tabs or sliders', 'aaikadomain'  )
					),
					array(
						'type' => 'select',
						'heading' => __( 'Style', 'aaikadomain'  ),
						'param_name' => 'style',
						'values' => array(
							'style-1' => 'Style 1',
							'vertical ' => 'Style 2 ( Vertical )',
							'style-3 style2' => 'Style 3'
						),
						'description' => __( 'Select style for Tabs (Only display as tabs).', 'aaikadomain'  )
					),					
					array(
						'type' => 'dropdown',
						'heading' => __( 'Auto rotate tabs', 'aaikadomain'  ),
						'param_name' => 'interval',
						'value' => array( __( 'Disable', 'aaikadomain'  ) => 0, 3, 5, 10, 15 ),
						'std' => 0,
						'description' => __( 'Auto rotate tabs each X seconds.', 'aaikadomain'  )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'aaikadomain'  ),
						'param_name' => 'el_class',
						'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'aaikadomain'  )
					)
				),
				'custom_markup' => '
			<div class="wpb_tabs_holder wpb_holder vc_container_for_children">
			<ul class="tabs_controls">
			</ul>
			%content%
			</div>'
			,
			'default_content' => '
			[vc_tab title="' . __( 'Tab 1', 'aaikadomain'  ) . '" tab_id="' . $tab_id_1 . '"][/vc_tab]
			[vc_tab title="' . __( 'Tab 2', 'aaikadomain'  ) . '" tab_id="' . $tab_id_2 . '"][/vc_tab]
			',
				'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabsView' : 'VcTabsView35'
			) );


			vc_map( array(
				'name' => __( 'Tab', 'aaikadomain'  ),
				'base' => 'vc_tab',
				'allowed_container_element' => 'vc_row',
				'is_container' => true,
				'content_element' => false,
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __( 'Title', 'aaikadomain'  ),
						'param_name' => 'title',
						'description' => __( 'Tab title.', 'aaikadomain'  )
					),	
					array(
						'type' => 'attach_image',
						'heading' => __( 'Background Image', 'aaikadomain'  ),
						'param_name' => 'bg',
						'description' => __( 'Upload image to display as background of tab', 'aaikadomain'  )
					),					
					array(
						'type' => 'icon',
						'heading' => __( 'Icon', 'aaikadomain'  ),
						'param_name' => 'icon',
						'description' => __( 'Select Icon to display near title', 'aaikadomain'  )
					),
					array(
						'type' => 'tab_id',
						'heading' => __( 'Tab ID', 'aaikadomain'  ),
						'param_name' => "tab_id"
					)
				),
				'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35'
			) );

			vc_map( array(
				'name' => __( 'Video Background', 'aaikadomain'  ),
				'base' => 'videobg',
				
				'allowed_container_element' => 'vc_row',
				'content_element' => true,
				'is_container' => true,
				'show_settings_on_create' => false,
				
				'icon' => 'fa fa-file-video-o',
				'category' => THEME_NAME.' Theme',
				
				'description' => __( 'Background video for sections', 'aaikadomain'  ),
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __( 'Background Video ID', 'aaikadomain'  ),
						'param_name' => 'id',
						'admin_label' => true,
						'description' => __( 'Imput video id from you, E.g: cUhPA5qIxDQ', 'aaikadomain'  )
					),					
					array(
						'type' => 'select',
						'heading' => __( 'Sound', 'aaikadomain'  ),
						'param_name' => 'sound',
						'values' => array(
							'no' => 'No, Thanks!',
							'yes' => 'Yes, Please!',
						),
						'admin_label' => true,
						'description' => __( 'Play sound or mute mode when video playing', 'aaikadomain'  )
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => __( 'Height', 'aaikadomain'  ),
						'param_name' => "height",
						'description' => __( 'Height of area video. E.g: 500', 'aaikadomain'  )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'aaikadomain'  ),
						'param_name' => 'class',
						'description' => __( 'Use this field to add a class name and then refer to it in your css file.', 'aaikadomain'  )
					)
				),
				'js_view' => 'VcColumnView'
				
			) );

			vc_map( array(
			
				'name' => THEME_NAME.' Elements',
				'base' => 'elements',
				'icon' => 'fa fa-graduation-cap',
				'category' => THEME_NAME.' Theme',
				'description' => __( 'All elements use in theme', 'aaikadomain'  ),
				'params' => array(

					array(
						'type' => 'select',
						'param_name' => 'type',
						'heading' => __( 'Type', 'aaikadomain'  ),
						'description' => __( 'NOTICE: Use type must corresponding to the class name of section, E.g: feature_sec12', 'aaikadomain'  ),
						'admin_label' => true,
						'values' => array(
							'cbox2' => 'Element Box ( image + text )',
							'hexagon' => 'Element Hexagon ( awesome icons )',
							'sec1' => 'Element (section 1 - awesome icons)',
							'sec2' => 'Element (section 2 - image )',
							'sec3' => 'Element (section 3 - simple-line icons)',
							'sec4' => 'Element (section 5 - image)',
							'sec6' => 'Element (section 6 - awesome icons)',
							'sec7' => 'Element (section 7 - image)',
							'sec12' => 'Element (section 12 - image)',
							'sec30' => 'Element (section 30 - simple-line icons)',
							'sec32' => 'Element (section 32 - simple-line icons)',
							'sec33' => 'Element (section 33 - awesome icons)',
							'sec34' => 'Element (section 34 - image)',
							'sec35' => 'Element (section 35 - awesome icons)',
							'sec37' => 'Element (section 37 - image)',
							'sec40' => 'Element (section 40 - awesome icons)',
							'sec41' => 'Element (section 41 - simple-line icons)',
							'sec44' => 'Element (section 44 - simple-line icons)',
							'sec48' => 'Element (section 48 - simple-line icons)',
							'sec53' => 'Element (section 53 - simple-line icons)',
							'sec62' => 'Element (section 62 - simple-line icons)',
							'sec63' => 'Element (section 63 - simple-line icons)',
							'psec7' => 'Element (parallax section 7)',
							'flip' => 'Element (flip box - awesome icons)',
						)
					),
					array(
						'type' => 'attach_image',
						'param_name' => 'image',
						'heading' => __( 'Image ', 'aaikadomain'  ),
						'description' => __( 'Select image for service box', 'aaikadomain'  ),
						'admin_label' => true,
					),
					array(
						'type' => 'icon',
						'param_name' => 'icon_awesome',
						'heading' => __( 'Awesome Icon ', 'aaikadomain'  ),
						'description' => __( 'Select Icon for service box', 'aaikadomain'  ),
						'admin_label' => true,
					),					
					array(
						'type' => 'icon-simple',
						'param_name' => 'icon_simple_line',
						'heading' => __( 'Simple-line Icon ', 'aaikadomain'  ),
						'description' => __( 'Select Icon for service box', 'aaikadomain'  ),
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => __( 'Title', 'aaikadomain'  ),
						'param_name' => "title",
						'description' => __( 'Title of service box', 'aaikadomain'  )
					),
					array(
						'type' => 'textarea_raw_html',
						'heading' => __( 'Short Description', 'aaikadomain'  ),
						'param_name' => 'des',
						'value' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'External link', 'aaikadomain'  ),
						'param_name' => 'link',
						'description' => __( 'External link read more', 'aaikadomain'  )
					),
					array(
						'type' => 'textfield',
						'heading' => __( 'Extra class name', 'aaikadomain'  ),
						'param_name' => 'class',
						'description' => __( 'Use this field to add a class name and then refer to it in your css file.', 'aaikadomain'  )
					)
				)
			) );
			
			
		}
	}

}
      