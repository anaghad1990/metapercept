<?php

/*** Post Settings ***/

$post_meta_box = fair_edge_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Post',
		'name' 	=> 'post-meta'
	)
);

fair_edge_add_meta_box_field(array(
	'name'        => 'edgtf_blog_single_type_meta',
	'type'        => 'select',
	'label'       => 'Single Post Type',
	'description' => 'Choose type for Single Post pages',
	'parent'      => $post_meta_box,
	'options'     => array(
		''					=> 'Default',
		'standard'			=> 'Standard',
		'with-title-image'	=> 'With Title Image'
	),
	'default_value' => '',
	'args' => array(
		'dependence' => true,
		'show' => array(
			'' => '',
			'standard' => '',
			'with-title-image' => '#edgtf_edgtf_single_with_title_image_meta_container'
		),
		'hide' => array(
			'' => '#edgtf_edgtf_single_with_title_image_meta_container',
			'standard' => '#edgtf_edgtf_single_with_title_image_meta_container',
			'with-title-image' => ''
		)
	)
));


$single_with_title_image_meta_container = fair_edge_add_admin_container(
	array(
		'name' => 'edgtf_single_with_title_image_meta_container',
		'parent' => $post_meta_box,
		'hidden_property' => 'edgtf_blog_single_type_meta',
		'hidden_value' => '',
		'hidden_values' => array(
			'','standard'
		)
	)
);

fair_edge_add_meta_box_field(array(
	'name'        => 'edgtf_blog_single_image_bottom_width_meta',
	'type'        => 'text',
	'label'       => 'Info Section Width',
	'description' => 'Here you can define the width of the post info section (the section at the bottom of the post that displays the post author, share buttons, comments, related posts, etc.)',
	'parent'      => $single_with_title_image_meta_container,
	'args'        => array(
		'col_width' => 3,
		'suffix' => '%'
	)
));

fair_edge_add_meta_box_field(array(
	'name'        => 'edgtf_blog_masonry_gallery_dimensions',
	'type'        => 'select',
	'label'       => 'Dimensions for Masonry Gallery',
	'description' => 'Choose image layout when it appears in Masonry Gallery list',
	'parent'      => $post_meta_box,
	'options'     => array(
		'default'            => 'Default',
		'large-width'        => 'Large width',
		'large-height'       => 'Large height',
		'large-width-height' => 'Large width/height'
	),
	'default_value' => 'default'
));
fair_edge_add_meta_box_field(array(
	'name'        => 'edgtf_blog_masonry_gallery_skin',
	'type'        => 'select',
	'label'       => 'Skin for Masonry Gallery',
	'description' => 'Choose skin for Masonry Gallery Layout items (Link and Quote post formats)',
	'parent'      => $post_meta_box,
	'options'     => array(
		''      => 'Default',
		'light'	=> 'Light',
		'dark'	=> 'Dark'
	),
	'default_value' => ''
));