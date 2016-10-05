<?php

/*** Audio Post Format ***/

$audio_post_format_meta_box = fair_edge_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Audio Post Format',
		'name' 	=> 'post_format_audio_meta'
	)
);

fair_edge_add_meta_box_field(
	array(
		'name'        => 'edgtf_audio_post_type_meta',
		'type'        => 'select',
		'label'       => 'Audio Type',
		'description' => 'Choose audio type',
		'parent'      => $audio_post_format_meta_box,
		'default_value' => 'self',
		'options'     => array(
			'self'			=> 'Self Hosted',
			'soundcloud'	=> 'Soundcloud'
		),
		'args' => array(
			'dependence' => true,
			'hide' => array(
				'self'		=> '#edgtf_edgtf_audio_soundcloud_container',
				'soundcloud' => '#edgtf_edgtf_audio_self_hosted_container'
			),
			'show' => array(
				'self'		=> '#edgtf_edgtf_audio_self_hosted_container',
				'soundcloud' => '#edgtf_edgtf_audio_soundcloud_container'
			)
		)
	)
);

$edgtf_audio_self_hosted_container = fair_edge_add_admin_container(
	array(
		'parent' => $audio_post_format_meta_box,
		'name' => 'edgtf_audio_self_hosted_container',
		'hidden_property' => 'edgtf_audio_post_type_meta',
		'hidden_value' => 'soundcloud'
	)
);

$edgtf_audio_soundcloud_container = fair_edge_add_admin_container(
	array(
		'parent' => $audio_post_format_meta_box,
		'name' => 'edgtf_audio_soundcloud_container',
		'hidden_property' => 'edgtf_audio_post_type_meta',
		'hidden_value' => 'self'
	)
);


fair_edge_add_meta_box_field(
	array(
		'name'        => 'edgtf_post_audio_link_meta',
		'type'        => 'text',
		'label'       => 'Self Hosted Link',
		'description' => 'Enter audio link',
		'parent'      => $edgtf_audio_self_hosted_container,

	)
);

fair_edge_add_meta_box_field(
	array(
		'name'        => 'edgtf_post_audio_soundcloud_link_meta',
		'type'        => 'text',
		'label'       => 'Soundcloud Link',
		'description' => 'Enter soundcloud link',
		'parent'      => $edgtf_audio_soundcloud_container,

	)
);