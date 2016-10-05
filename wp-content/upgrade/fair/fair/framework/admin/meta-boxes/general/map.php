<?php

$general_meta_box = fair_edge_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'General',
        'name' => 'general_meta'
    )
);

	fair_edge_add_meta_box_field(
		array(
			'name'        => 'edgtf_predefined_fonts_style_meta',
			'type'        => 'select',
			'label'       => 'Predefined Fonts Styles',
			'description' => 'Choose predefined style',
			'parent'      => $general_meta_box,
			'default_value' => '',
			'options'     => array(
				'' => 'Default',
				'style-poppins' => 'Poppins',
				'style-oswald' => 'Oswald',
			)
		)
	);

    fair_edge_add_meta_box_field(
        array(
            'name' => 'edgtf_page_background_color_meta',
            'type' => 'color',
            'default_value' => '',
            'label' => 'Page Background Color',
            'description' => 'Choose background color for page content',
            'parent' => $general_meta_box
        )
    );
	
	fair_edge_add_meta_box_field(
		array(
			'name' => 'edgtf_page_padding_meta',
			'type' => 'text',
			'default_value' => '',
			'label' => 'Page Padding',
			'description' => 'Insert padding in format 10px 10px 10px 10px',
			'parent' => $general_meta_box
		)
	);

    fair_edge_add_meta_box_field(
        array(
            'name' => 'edgtf_page_slider_meta',
            'type' => 'text',
            'default_value' => '',
            'label' => 'Slider Shortcode',
            'description' => 'Paste your slider shortcode here',
            'parent' => $general_meta_box
        )
    );

	$passepartout_option      = fair_edge_options()->getOptionValue('passepartout');
	$passepartout_default_dependency = array(
		'' => '#edgtf_passepartout_container'
	);
	
	$passepartout_show_array = array(
		'yes' => '#edgtf_passepartout_container'
	);
	
	$passepartout_hide_array = array(
		'no' => '#edgtf_passepartout_container'
	);
	
	if($passepartout_option === 'yes') {
		$passepartout_show_array = array_merge($passepartout_show_array, $passepartout_default_dependency);
		$temp_passepartout_no = array(
			'hidden_value' => 'no'
		);
	} else {
		$passepartout_hide_array = array_merge($passepartout_hide_array, $passepartout_default_dependency);
		$temp_passepartout_no = array(
			'hidden_values'   => array('','no')
		);
	}
	
	fair_edge_add_meta_box_field(
		array(
			'name'          => 'edgtf_passepartout_meta',
			'type'          => 'select',
			'default_value' => '',
			'label'         => 'Passepartout',
			'description'   => 'Enabling this option will display passepartout around site content',
			'parent'        => $general_meta_box,
			'options'     => array(
				''		=> 'Default',
				'yes'	=> 'Yes',
				'no'	=> 'No'
			),
			'args' => array(
				"dependence" => true,
				'show'       => $passepartout_show_array,
				'hide'       => $passepartout_hide_array
			)
		)
	);
	
	$passepartout_container = fair_edge_add_admin_container(
		array_merge(
			array(
				'parent'            => $general_meta_box,
				'name'              => 'passepartout_container',
				'hidden_property'   => 'edgtf_passepartout_meta'
			),
			$temp_passepartout_no
		)
	);
	fair_edge_add_meta_box_field(
		array(
			'name'          => 'edgtf_passepartout_color_meta',
			'type'          => 'color',
			'label'         => 'Passepartout Color',
			'description'   => 'Choose Passepartout color.',
			'parent'        => $passepartout_container
		)
	);

	$boxed_option      = fair_edge_options()->getOptionValue('boxed');
	$boxed_default_dependency = array(
		'' => '#edgtf_boxed_container'
	);

	$boxed_show_array = array(
		'yes' => '#edgtf_boxed_container'
	);

	$boxed_hide_array = array(
		'no' => '#edgtf_boxed_container'
	);

	if($boxed_option === 'yes') {
		$boxed_show_array = array_merge($boxed_show_array, $boxed_default_dependency);
		$temp_boxed_no = array(
			'hidden_value' => 'no'
		);
	} else {
		$boxed_hide_array = array_merge($boxed_hide_array, $boxed_default_dependency);
		$temp_boxed_no = array(
			'hidden_values'   => array('','no')
		);
	}

	fair_edge_add_meta_box_field(
		array(
			'name'          => 'edgtf_boxed_meta',
			'type'          => 'select',
			'label'         => 'Boxed Layout',
			'description'   => '',
			'parent'        => $general_meta_box,
			'default_value' => '',
			'options'     => array(
				''		=> 'Default',
				'yes'	=> 'Yes',
				'no'	=> 'No'
			),
			'args' => array(
				"dependence" => true,
				'show'       => $boxed_show_array,
				'hide'       => $boxed_hide_array
			)
		)
	);

	$boxed_container = fair_edge_add_admin_container_no_style(
		array_merge(
			array(
				'parent'            => $general_meta_box,
				'name'              => 'boxed_container',
				'hidden_property'   => 'edgtf_boxed_meta'
			),
			$temp_boxed_no
		)
	);

	fair_edge_add_meta_box_field(
		array(
			'name'          => 'edgtf_page_background_color_in_box_meta',
			'type'          => 'color',
			'label'         => 'Page Background Color',
			'description'   => 'Choose the page background color outside box.',
			'parent'        => $boxed_container
		)
	);

	fair_edge_add_meta_box_field(
		array(
			'name'          => 'edgtf_boxed_background_image_meta',
			'type'          => 'image',
			'label'         => 'Background Image',
			'description'   => 'Choose an image to be displayed in background',
			'parent'        => $boxed_container
		)
	);

	fair_edge_add_meta_box_field(
		array(
			'name'          => 'edgtf_boxed_background_image_repeating_meta',
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

	fair_edge_add_meta_box_field(
		array(
			'name'          => 'edgtf_boxed_background_image_attachment_meta',
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