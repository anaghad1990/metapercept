<?php

if ( ! function_exists('fair_edge_general_options_map') ) {
    /**
     * General options page
     */
    function fair_edge_general_options_map() {

        fair_edge_add_admin_page(
            array(
                'slug'  => '',
                'title' => 'General',
                'icon'  => 'fa fa-institution'
            )
        );

        $panel_design_style = fair_edge_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_design_style',
                'title' => 'Design Style'
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose a default Google font for your site',
                'parent' => $panel_design_style
            )
        );
		fair_edge_add_admin_field(
			array(
				'name'          => 'google_fonts_second',
				'type'          => 'font',
				'default_value' => '-1',
				'label'         => 'Second Font Family',
				'description'   => 'Choose a default Google font for your site(default is Playfair Display)',
				'parent' 		=> $panel_design_style
			)
		);
        fair_edge_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => 'Additional Google Fonts',
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#edgtf_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = fair_edge_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'additional_google_fonts_container',
                'hidden_property'   => 'additional_google_fonts',
                'hidden_value'      => 'no'
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose additional Google font for your site',
                'parent'        => $additional_google_fonts_container
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose additional Google font for your site',
                'parent'        => $additional_google_fonts_container
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose additional Google font for your site',
                'parent'        => $additional_google_fonts_container
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose additional Google font for your site',
                'parent'        => $additional_google_fonts_container
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose additional Google font for your site',
                'parent'        => $additional_google_fonts_container
            )
        );

		fair_edge_add_admin_field(
			array(
				'name'        => 'predefined_fonts_style',
				'type'        => 'select',
				'label'       => 'Predefined Fonts Styles',
				'description' => 'Choose predefined style',
				'parent'      => $panel_design_style,
				'default_value' => '',
				'options'     => array(
					'' => 'Default',
					'style-poppins' => 'Poppins',
					'style-oswald' => 'Oswald',
				)
			)
		);

        fair_edge_add_admin_field(
            array(
                'name'          => 'first_color',
                'type'          => 'color',
                'label'         => 'First Main Color',
                'description'   => 'Choose the most dominant theme color. Default color is #387ce0',
                'parent'        => $panel_design_style
            )
        );

		$group_gradient = fair_edge_add_admin_group(array(
			'name'        => 'group_gradient',
			'title'       => 'Gradient Colors',
			'description' => 'Define colors for gradient styles',
			'parent'      => $panel_design_style
		));

		$row_gradient_style1 = fair_edge_add_admin_row(array(
			'name'   => 'row_gradient_style1',
			'parent' => $group_gradient
		));

		fair_edge_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'gradient_style1_start_color',
			'default_value' => '',
			'label'         => 'Style 1 - Start Color (def. #f241a4)',
			'parent'        => $row_gradient_style1
		));

		fair_edge_add_admin_field(array(
			'type'          => 'colorsimple',
			'name'          => 'gradient_style1_end_color',
			'default_value' => '',
			'label'         => 'Style 1 - End Color (def. #6c69e8)',
			'parent'        => $row_gradient_style1
		));

        fair_edge_add_admin_field(
            array(
                'name'          => 'page_background_color',
                'type'          => 'color',
                'label'         => 'Page Background Color',
                'description'   => 'Choose the background color for page content. Default color is #ffffff',
                'parent'        => $panel_design_style
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'selection_color',
                'type'          => 'color',
                'label'         => 'Text Selection Color',
                'description'   => 'Choose the color users see when selecting text',
                'parent'        => $panel_design_style
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => 'Boxed Layout',
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#edgtf_boxed_container"
                )
            )
        );

        $boxed_container = fair_edge_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'boxed_container',
                'hidden_property'   => 'boxed',
                'hidden_value'      => 'no'
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'page_background_color_in_box',
                'type'          => 'color',
                'label'         => 'Page Background Color',
                'description'   => 'Choose the page background color outside box.',
                'parent'        => $boxed_container
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'boxed_background_image',
                'type'          => 'image',
                'label'         => 'Background Image',
                'description'   => 'Choose an image to be displayed in background',
                'parent'        => $boxed_container
            )
        );

		fair_edge_add_admin_field(
			array(
				'name'          => 'boxed_background_image_repeating',
				'type'          => 'select',
				'default_value' => 'no',
				'label'         => 'Use Background Image as Pattern',
				'description'   => 'Set this option to "yes" to use the background image as repeating pattern',
				'parent'        => $boxed_container,
				'options'       => array(
					'no'	=>	'No',
					'yes'	=>	'Yes'
				)
			)
		);

        fair_edge_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => 'Background Image Behaviour',
                'description'   => 'Choose background image behaviour',
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'     => 'Fixed',
                    'scroll'    => 'Scroll'
                )
            )
        );

		fair_edge_add_admin_field(
			array(
				'name'          => 'passepartout',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => 'Passepartout',
				'description'   => 'Enabling this option will display passepartout around site content',
				'parent'        => $panel_design_style,
				'args'          => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#edgtf_passepartout_container"
				)
			)
		);

		$passepartout_container = fair_edge_add_admin_container(
			array(
				'parent'            => $panel_design_style,
				'name'              => 'passepartout_container',
				'hidden_property'   => 'passepartout',
				'hidden_value'      => 'no'
			)
		);

		fair_edge_add_admin_field(
			array(
				'name'          => 'passepartout_color',
				'type'          => 'color',
				'label'         => 'Passepartout Color',
				'description'   => 'Choose Passepartout color.',
				'parent'        => $passepartout_container
			)
		);

        fair_edge_add_admin_field(
            array(
                'name'          => 'initial_content_width',
                'type'          => 'select',
                'default_value' => '',
                'label'         => 'Initial Width of Content',
                'description'   => 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid"',
                'parent'        => $panel_design_style,
                'options'       => array(
                    ""          => "1300px - default",
                    "grid-1300" => "1300px",
                    "grid-1200" => "1200px",
                    "grid-1000" => "1000px",
                    "grid-800"  => "800px"
                )
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'preload_pattern_image',
                'type'          => 'image',
                'label'         => 'Preload Pattern Image',
                'description'   => 'Choose preload pattern image to be displayed until images are loaded ',
                'parent'        => $panel_design_style
            )
        );

        fair_edge_add_admin_field(
            array(
                'name' => 'element_appear_amount',
                'type' => 'text',
                'label' => 'Element Appearance',
                'description' => 'For animated elements, set distance (related to browser bottom) to start the animation',
                'parent' => $panel_design_style,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => 'px'
                )
            )
        );

        $panel_settings = fair_edge_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => 'Settings'
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'smooth_scroll',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => 'Smooth Scroll',
                'description'   => 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)',
                'parent'        => $panel_settings
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'smooth_page_transitions',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => 'Smooth Page Transitions',
                'description'   => 'Enabling this option will perform a smooth transition between pages when clicking on links.',
                'parent'        => $panel_settings,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#edgtf_page_transitions_container"
                )
            )
        );

        $page_transitions_container = fair_edge_add_admin_container(
            array(
                'parent'            => $panel_settings,
                'name'              => 'page_transitions_container',
                'hidden_property'   => 'smooth_page_transitions',
                'hidden_value'      => 'no'
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'smooth_pt_bgnd_color',
                'type'          => 'color',
                'label'         => 'Page Loader Background Color',
                //'description'   => 'Enabling this option will perform a smooth transition between pages when clicking on links.',
                'parent'        => $page_transitions_container
            )
        );

        $group_pt_spinner_animation = fair_edge_add_admin_group(array(
            'name'          => 'group_pt_spinner_animation',
            'title'         => 'Loader Style',
            'description'   => 'Define styles for loader spinner animation',
            'parent'        => $page_transitions_container
        ));

        $row_pt_spinner_animation = fair_edge_add_admin_row(array(
            'name'      => 'row_pt_spinner_animation',
            'parent'    => $group_pt_spinner_animation
        ));

        fair_edge_add_admin_field(array(
            'type'          => 'selectsimple',
            'name'          => 'smooth_pt_spinner_type',
            'default_value' => '',
            'label'         => 'Spinner Type',
            'parent'        => $row_pt_spinner_animation,
            'options'       => array(
                "color_spinner" => "Color Spinner",
                "pulse" => "Pulse",
                "double_pulse" => "Double Pulse",
                "cube" => "Cube",
                "rotating_cubes" => "Rotating Cubes",
                "stripes" => "Stripes",
                "wave" => "Wave",
                "two_rotating_circles" => "2 Rotating Circles",
                "five_rotating_circles" => "5 Rotating Circles",
                "atom" => "Atom",
                "clock" => "Clock",
                "mitosis" => "Mitosis",
                "lines" => "Lines",
                "fussion" => "Fussion",
                "wave_circles" => "Wave Circles",
                "pulse_circles" => "Pulse Circles"
            ),
            'args'          => array(
                "dependence"             => true,
                'show'        => array(
                    "color_spinner"         => '#edgtf_color_spinner_container',
                    "pulse"                 => "",
                    "double_pulse"          => "",
                    "cube"                  => "",
                    "rotating_cubes"        => "",
                    "stripes"               => "",
                    "wave"                  => "",
                    "two_rotating_circles"  => "",
                    "five_rotating_circles" => "",
                    "atom"                  => "",
                    "clock"                 => "",
                    "mitosis"               => "",
                    "lines"                 => "",
                    "fussion"               => "",
                    "wave_circles"          => "",
                    "pulse_circles"         => ""
                ),
                'hide'        => array(
                    "color_spinner"         => '',
                    "pulse"                 => "#edgtf_color_spinner_container",
                    "double_pulse"          => "#edgtf_color_spinner_container",
                    "cube"                  => "#edgtf_color_spinner_container",
                    "rotating_cubes"        => "#edgtf_color_spinner_container",
                    "stripes"               => "#edgtf_color_spinner_container",
                    "wave"                  => "#edgtf_color_spinner_container",
                    "two_rotating_circles"  => "#edgtf_color_spinner_container",
                    "five_rotating_circles" => "#edgtf_color_spinner_container",
                    "atom"                  => "#edgtf_color_spinner_container",
                    "clock"                 => "#edgtf_color_spinner_container",
                    "mitosis"               => "#edgtf_color_spinner_container",
                    "lines"                 => "#edgtf_color_spinner_container",
                    "fussion"               => "#edgtf_color_spinner_container",
                    "wave_circles"          => "#edgtf_color_spinner_container",
                    "pulse_circles"         => "#edgtf_color_spinner_container"
                )
            )
        ));

        fair_edge_add_admin_field(array(
            'type'          => 'colorsimple',
            'name'          => 'smooth_pt_spinner_color',
            'default_value' => '',
            'label'         => 'Spinner Color',
            'parent'        => $row_pt_spinner_animation
        ));

        $color_spinner_container = fair_edge_add_admin_container(
            array(
                'parent'          => $panel_settings,
                'name'            => 'color_spinner_container',
                'hidden_property' => 'smooth_pt_spinner_type',
                'hidden_value'    => '',
                'hidden_values'   =>array(
                    "pulse",
                    "double_pulse",
                    "cube",
                    "rotating_cubes",
                    "stripes",
                    "wave",
                    "two_rotating_circles",
                    "five_rotating_circles",
                    "atom",
                    "clock",
                    "mitosis",
                    "lines",
                    "fussion",
                    "wave_circles",
                    "pulse_circles"
                )
            )
        );

        $group_pt_spinner_additional_colors = fair_edge_add_admin_group(array(
            'name'          => 'group_pt_spinner_additional_colors',
            'title'         => 'Additional Colors',
            'description'   => 'Define additional colors for Color Spinner',
            'parent'        => $color_spinner_container
        ));

        $row_pt_spinner_additional_colors = fair_edge_add_admin_row(array(
            'name'      => 'row_pt_spinner_additional_colors',
            'parent'    => $group_pt_spinner_additional_colors
        ));

        fair_edge_add_admin_field(
            array(
                'type'          => 'colorsimple',
                'name'          => 'additional_color_1',
                'default_value' => '',
                'label'         => 'First Additional Color',
                'parent'        => $row_pt_spinner_additional_colors
            )
        );

        fair_edge_add_admin_field(
            array(
                'type'          => 'colorsimple',
                'name'          => 'additional_color_2',
                'default_value' => '',
                'label'         => 'Second Additional Color',
                'parent'        => $row_pt_spinner_additional_colors
            )
        );

        fair_edge_add_admin_field(
            array(
                'type'          => 'colorsimple',
                'name'          => 'additional_color_3',
                'default_value' => '',
                'label'         => 'Third Additional Color',
                'parent'        => $row_pt_spinner_additional_colors
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => 'Show "Back To Top Button"',
                'description'   => 'Enabling this option will display a Back to Top button on every page',
                'parent'        => $panel_settings
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => 'Responsiveness',
                'description'   => 'Enabling this option will make all pages responsive',
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = fair_edge_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => 'Custom Code'
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'custom_css',
                'type'          => 'textarea',
                'label'         => 'Custom CSS',
                'description'   => 'Enter your custom CSS here',
                'parent'        => $panel_custom_code
            )
        );

        fair_edge_add_admin_field(
            array(
                'name'          => 'custom_js',
                'type'          => 'textarea',
                'label'         => 'Custom JS',
                'description'   => 'Enter your custom Javascript here',
                'parent'        => $panel_custom_code
            )
        );

		$panel_google_api = fair_edge_add_admin_panel(
			array(
				'page'  => '',
				'name'  => 'panel_google_api',
				'title' => 'Google API'
			)
		);

		fair_edge_add_admin_field(
			array(
				'name'        => 'google_maps_api_key',
				'type'        => 'text',
				'label'       => 'Google Maps Api Key',
				'description' => 'Insert your Google Maps API key here. For instructions on how to create a Google Maps API key, please refer to our documentation. Temporarily you can use "AIzaSyAidINa74sv7bt7Y3vqjKjM7m0PgJN1bhk"',
				'parent'      => $panel_google_api
			)
		);
    }

    add_action( 'fair_edge_options_map', 'fair_edge_general_options_map', 1);

}