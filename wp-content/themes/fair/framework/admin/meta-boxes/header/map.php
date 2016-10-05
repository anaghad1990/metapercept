<?php

$header_meta_box = fair_edge_add_meta_box(
    array(
        'scope' => array('page', 'portfolio-item', 'post'),
        'title' => 'Header',
        'name' => 'header_meta'
    )
);

$temp_holder_show = '';
$temp_holder_hide = '';
$temp_array_standard = array();
$temp_array_vertical = array();
$temp_array_full_screen = array();
$temp_array_behaviour = array();
switch (fair_edge_options()->getOptionValue('header_type')) {

	case 'header-standard':
		$temp_holder_show = '#edgtf_edgtf_header_standard_type_meta_container,#edgtf_edgtf_header_behaviour_meta_container';
		$temp_holder_hide = '#edgtf_edgtf_header_vertical_type_meta_container,#edgtf_edgtf_header_full_screen_type_meta_container';

		$temp_array_standard = array(
			'hidden_value' => 'default',
			'hidden_values' => array('header-vertical','header-full-screen')
		);
		$temp_array_vertical = array(
			'hidden_values' => array('','header-standard','header-full-screen')
		);
		$temp_array_full_screen = array(
			'hidden_values' => array('','header-standard', 'header-vertical')
		);
		$temp_array_behaviour = array(
			'hidden_value' => 'header-vertical'
		);
		break;

	case 'header-vertical':
		$temp_holder_show = '#edgtf_edgtf_header_vertical_type_meta_container';
		$temp_holder_hide = '#edgtf_edgtf_header_standard_type_meta_container,#edgtf_edgtf_header_full_screen_type_meta_container,#edgtf_edgtf_header_behaviour_meta_container';

		$temp_array_standard = array(
			'hidden_values' => array('', 'header-vertical', 'header-full-screen')
		);
		$temp_array_vertical = array(
			'hidden_value' => 'default',
			'hidden_values' => array('header-standard','header-full-screen')
		);
		$temp_array_full_screen = array(
			'hidden_values' => array('','header-standard', 'header-vertical')
		);
		$temp_array_behaviour = array(
			'hidden_value' => 'default',
			'hidden_values' => array('','header-vertical')
		);
		break;
	case 'header-full-screen':
		$temp_holder_show = '#edgtf_edgtf_header_full_screen_type_meta_container,#edgtf_edgtf_header_behaviour_meta_container';
		$temp_holder_hide = '#edgtf_edgtf_header_standard_type_meta_container,#edgtf_edgtf_header_vertical_type_meta_container';
		$temp_array_standard = array(
			'hidden_values' => array('', 'header-vertical', 'header-standard')
		);

		$temp_array_vertical = array(
			'hidden_values' => array('', 'header-standard','header-full-screen')
		);

		$temp_array_full_screen = array(
			'hidden_value' => 'default',
			'hidden_values' => array('header-vertical','header-full-screen')
		);
		$temp_array_behaviour = array(
			'hidden_value' => 'header-vertical'
		);
		break;
}



fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_header_type_meta',
		'type' => 'select',
		'default_value' => '',
		'label' => 'Choose Header Type',
		'description' => 'Select header type layout',
		'parent' => $header_meta_box,
		'options' => array(
			'' => 'Default',
			'header-standard' => 'Standard Header Layout',
			'header-vertical' => 'Vertical Header Layout',
			'header-full-screen' => 'Full Screen Header Layout'
		),
		'args' => array(
			"dependence" => true,
			"hide" => array(
				"" => $temp_holder_hide,
				'header-standard' 		=> '#edgtf_edgtf_header_vertical_type_meta_container,#edgtf_edgtf_header_full_screen_type_meta_container',
				'header-vertical' 		=> '#edgtf_edgtf_header_standard_type_meta_container,#edgtf_edgtf_header_full_screen_type_meta_container,#edgtf_edgtf_header_behaviour_meta_container',
				'header-full-screen'	=> '#edgtf_edgtf_header_standard_type_meta_container,#edgtf_edgtf_header_vertical_type_meta_container'
			),
			"show" => array(
				"" => $temp_holder_show,
				"header-standard" 		=> '#edgtf_edgtf_header_standard_type_meta_container,#edgtf_edgtf_header_behaviour_meta_container',
				"header-vertical" 		=> '#edgtf_edgtf_header_vertical_type_meta_container',
				"header-full-screen" 	=> '#edgtf_edgtf_header_full_screen_type_meta_container,#edgtf_edgtf_header_behaviour_meta_container'
			)
		)
	)
);
fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_header_style_meta',
		'type' => 'select',
		'default_value' => '',
		'label' => 'Header Skin',
		'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
		'parent' => $header_meta_box,
		'options' => array(
			'' => '',
			'light-header' => 'Light',
			'dark-header' => 'Dark'
		)
	)
);

fair_edge_add_meta_box_field(
	array(
		'parent' => $header_meta_box,
		'type' => 'select',
		'name' => 'edgtf_enable_header_style_on_scroll_meta',
		'default_value' => '',
		'label' => 'Enable Header Style on Scroll',
		'description' => 'Enabling this option, header will change style depending on row settings for dark/light style',
		'options' => array(
			'' => '',
			'no' => 'No',
			'yes' => 'Yes'
		)
	)
);



$header_standard_type_meta_container = fair_edge_add_admin_container(
	array_merge(
		array(
			'parent' => $header_meta_box,
			'name' => 'edgtf_header_standard_type_meta_container',
			'hidden_property' => 'edgtf_header_type_meta',

		),
		$temp_array_standard
	)
);

fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_menu_area_background_color_header_standard_meta',
		'type' => 'color',
		'label' => 'Background Color',
		'description' => 'Choose a background color for header area',
		'parent' => $header_standard_type_meta_container
	)
);

fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_menu_area_background_transparency_header_standard_meta',
		'type' => 'text',
		'label' => 'Background Color Transparency',
		'description' => 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)',
		'parent' => $header_standard_type_meta_container,
		'args' => array(
			'col_width' => 2
		)
	)
);

fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_menu_area_border_bottom_color_header_standard_meta',
		'type' => 'color',
		'label' => 'Border Color',
		'description' => 'Choose a border bottom color for header area and border left for widget section',
		'parent' => $header_standard_type_meta_container
	)
);

fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_menu_area_border_bottom_transparency_header_standard_meta',
		'type' => 'text',
		'label' => 'Border Transparency',
		'description' => 'Choose a transparency for the header border bottom color and border left color for widget section (0 = fully transparent, 1 = opaque)',
		'parent' => $header_standard_type_meta_container,
		'args' => array(
			'col_width' => 2
		)
	)
);

$header_vertical_type_meta_container = fair_edge_add_admin_container(
	array_merge(
		array(
			'parent' => $header_meta_box,
			'name' => 'edgtf_header_vertical_type_meta_container',
			'hidden_property' => 'edgtf_header_type_meta',
			'hidden_values' => array('header-standard')
		),
		$temp_array_vertical
	)
);

fair_edge_add_meta_box_field(array(
	'name'        => 'edgtf_vertical_header_background_color_meta',
	'type'        => 'color',
	'label'       => 'Background Color',
	'description' => 'Set background color for vertical menu',
	'parent'      => $header_vertical_type_meta_container
));

fair_edge_add_meta_box_field(array(
	'name'        => 'edgtf_vertical_header_transparency_meta',
	'type'        => 'text',
	'label'       => 'Background Color Transparency',
	'description' => 'Enter transparency for vertical menu (value from 0 to 1)',
	'parent'      => $header_vertical_type_meta_container,
	'args'        => array(
		'col_width' => 1
	)
));

fair_edge_add_meta_box_field(
	array(
		'name'          => 'edgtf_vertical_header_background_image_meta',
		'type'          => 'image',
		'default_value' => '',
		'label'         => 'Background Image',
		'description'   => 'Set background image for vertical menu',
		'parent'        => $header_vertical_type_meta_container
	)
);

fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_disable_vertical_header_background_image_meta',
		'type' => 'yesno',
		'default_value' => 'no',
		'label' => 'Disable Background Image',
		'description' => 'Enabling this option will hide background image in Vertical Menu',
		'parent' => $header_vertical_type_meta_container
	)
);

$header_full_screen_type_meta_container = fair_edge_add_admin_container(
	array_merge(
		array(
			'parent' => $header_meta_box,
			'name' => 'edgtf_header_full_screen_type_meta_container',
			'hidden_property' => 'edgtf_header_type_meta',

		),
		$temp_array_full_screen
	)
);

fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_menu_area_background_color_header_full_screen_meta',
		'type' => 'color',
		'label' => 'Background Color',
		'description' => 'Choose a background color for Full Screen header area',
		'parent' => $header_full_screen_type_meta_container
	)
);

fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_menu_area_background_transparency_header_full_screen_meta',
		'type' => 'text',
		'label' => 'Background Color Transparency',
		'description' => 'Choose a transparency for the Full Screen header background color (0 = fully transparent, 1 = opaque)',
		'parent' => $header_full_screen_type_meta_container,
		'args' => array(
			'col_width' => 2
		)
	)
);

fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_menu_area_border_bottom_color_header_full_screen_meta',
		'type' => 'color',
		'label' => 'Border Bottom Color',
		'description' => 'Choose a border bottom color for Full Screen header area',
		'parent' => $header_full_screen_type_meta_container
	)
);

fair_edge_add_meta_box_field(
	array(
		'name' => 'edgtf_menu_area_border_bottom_transparency_header_full_screen_meta',
		'type' => 'text',
		'label' => 'Border Bottom Transparency',
		'description' => 'Choose a transparency for the Full Screen header border bottom color (0 = fully transparent, 1 = opaque)',
		'parent' => $header_full_screen_type_meta_container,
		'args' => array(
			'col_width' => 2
		)
	)
);


$header_behaviour_meta_container = fair_edge_add_admin_container(
	array_merge(
		array(
			'parent' => $header_meta_box,
			'name' => 'edgtf_header_behaviour_meta_container',
			'hidden_property' => 'edgtf_header_type_meta',

		),
		$temp_array_behaviour
	)
);

fair_edge_add_meta_box_field(
	array(
		'name'            => 'edgtf_scroll_amount_for_sticky_meta',
		'type'            => 'text',
		'label'           => 'Scroll amount for sticky header appearance',
		'description'     => 'Define scroll amount for sticky header appearance',
		'parent'          => $header_behaviour_meta_container,
		'args'            => array(
			'col_width' => 2,
			'suffix'    => 'px'
		),
		'hidden_property' => 'edgtf_header_behaviour',
		'hidden_values'   => array("sticky-header-on-scroll-up", "fixed-on-scroll")
	)
);


fair_edge_add_admin_section_title(array(
	'name'   => 'top_bar_section_title',
	'parent' => $header_meta_box,
	'title'  => 'Top Bar'
));

$top_bar_global_option      = fair_edge_options()->getOptionValue('top_bar');
$top_bar_default_dependency = array(
	'' => '#edgtf_top_bar_container_no_style'
);

$top_bar_show_array = array(
	'yes' => '#edgtf_top_bar_container_no_style'
);

$top_bar_hide_array = array(
	'no' => '#edgtf_top_bar_container_no_style'
);

if($top_bar_global_option === 'yes') {
	$top_bar_show_array = array_merge($top_bar_show_array, $top_bar_default_dependency);
	$temp_top_no = array(
		'hidden_value' => 'no'
	);
} else {
	$top_bar_hide_array = array_merge($top_bar_hide_array, $top_bar_default_dependency);
	$temp_top_no = array(
		'hidden_values'   => array('','no')
	);
}


fair_edge_add_meta_box_field(array(
	'name'          => 'edgtf_top_bar_meta',
	'type'          => 'select',
	'label'         => 'Enable Top Bar on This Page',
	'description'   => 'Enabling this option will enable top bar on this page',
	'parent'        => $header_meta_box,
	'default_value' => '',
	'options'       => array(
		''    => 'Default',
		'yes' => 'Yes',
		'no'  => 'No'
	),
	'args' => array(
		"dependence" => true,
		'show'       => $top_bar_show_array,
		'hide'       => $top_bar_hide_array
	)
));

$top_bar_container = fair_edge_add_admin_container_no_style(array_merge(array(
	'name'            => 'top_bar_container_no_style',
	'parent'          => $header_meta_box,
	'hidden_property' => 'edgtf_top_bar_meta'
),
	$temp_top_no));

fair_edge_add_meta_box_field(array(
	'name'    => 'edgtf_top_bar_skin_meta',
	'type'    => 'select',
	'label'   => 'Top Bar Skin',
	'options' => array(
		''      => 'Default',
		'light' => 'Light',
		'dark'  => 'Dark'
	),
	'parent'  => $top_bar_container
));

fair_edge_add_meta_box_field(array(
	'name'   => 'edgtf_top_bar_background_color_meta',
	'type'   => 'color',
	'label'  => 'Top Bar Background Color',
	'parent' => $top_bar_container
));

fair_edge_add_meta_box_field(array(
	'name'        => 'edgtf_top_bar_background_transparency_meta',
	'type'        => 'text',
	'label'       => 'Top Bar Background Color Transparency',
	'description' => 'Set top bar background color transparenct. Value should be between 0 and 1',
	'parent'      => $top_bar_container,
	'args'        => array(
		'col_width' => 3
	)
));
