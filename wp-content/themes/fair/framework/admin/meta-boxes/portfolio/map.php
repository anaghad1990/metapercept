<?php

$edgt_pages = array();
$pages = get_pages(); 
foreach($pages as $page) {
	$edgt_pages[$page->ID] = $page->post_title;
}

//Portfolio Images

$edgtPortfolioImages = new FairEdgeMetaBox("portfolio-item", "Portfolio Images (multiple upload)", '', '', 'portfolio_images');
$fair_edge_Framework->edgtMetaBoxes->addMetaBox("portfolio_images",$edgtPortfolioImages);

	$edgt_portfolio_image_gallery = new FairEdgeMultipleImages("edgt_portfolio-image-gallery","Portfolio Images","Choose your portfolio images");
	$edgtPortfolioImages->addChild("edgt_portfolio-image-gallery",$edgt_portfolio_image_gallery);

//Portfolio Images/Videos 2

$edgtPortfolioImagesVideos2 = new FairEdgeMetaBox("portfolio-item", "Portfolio Images/Videos (single upload)");
$fair_edge_Framework->edgtMetaBoxes->addMetaBox("portfolio_images_videos2",$edgtPortfolioImagesVideos2);

	$edgt_portfolio_images_videos2 = new FairEdgeImagesVideosFramework("Portfolio Images/Videos 2","ThisIsDescription");
	$edgtPortfolioImagesVideos2->addChild("edgt_portfolio_images_videos2",$edgt_portfolio_images_videos2);

//Portfolio Additional Sidebar Items

$edgtAdditionalSidebarItems = fair_edge_add_meta_box(
    array(
        'scope' => array('portfolio-item'),
        'title' => 'Additional Portfolio Sidebar Items',
        'name' => 'portfolio_properties'
    )
);

	$edgt_portfolio_properties = fair_edge_add_options_framework(
	    array(
	        'label' => 'Portfolio Properties',
	        'name' => 'edgt_portfolio_properties',
	        'parent' => $edgtAdditionalSidebarItems
	    )
	);

if(!function_exists('fair_edge_add_attachment_custom_field')){
	function fair_edge_add_attachment_custom_field( $form_fields, $post = null ) {
		if(wp_attachment_is_image($post->ID)){
			$field_value = get_post_meta( $post->ID, '_ptf_single_masonry_image_size', true );

			$form_fields['ptf_single_masonry_image_size'] = array(
				'input' => 'html',
				'label' => esc_html__( 'Image Size', 'fair'),
				'helps' => esc_html__( 'Choose image size for masonry single', 'fair')
			);

			$form_fields['ptf_single_masonry_image_size']['html']  = "<select name='attachments[{$post->ID}][ptf_single_masonry_image_size]'>";
			$form_fields['ptf_single_masonry_image_size']['html'] .= '<option '.selected($field_value,'edgtf-default-masonry-item',false).' value="edgtf-default-masonry-item">'.esc_html__('Default Size','fair').'</option>';
			$form_fields['ptf_single_masonry_image_size']['html'] .= '<option '.selected($field_value,'edgtf-large-height-masonry-item',false).' value="edgtf-large-height-masonry-item">'.esc_html__('Large Height','fair').'</option>';
			$form_fields['ptf_single_masonry_image_size']['html'] .= '<option '.selected($field_value,'edgtf-large-width-masonry-item',false).' value="edgtf-large-width-masonry-item">'.esc_html__('Large Width','fair').'</option>';
			$form_fields['ptf_single_masonry_image_size']['html'] .= '<option '.selected($field_value,'edgtf-large-width-height-masonry-item',false).' value="edgtf-large-width-height-masonry-item">'.esc_html__('Large Width/Height','fair').'</option>';
			$form_fields['ptf_single_masonry_image_size']['html'] .= '</select>';

		}
		return $form_fields;
	}
	add_filter( 'attachment_fields_to_edit', 'fair_edge_add_attachment_custom_field' , 10, 2 );
}

if(!function_exists('fair_edge_image_attachment_fields_to_save')){
	/**
	 * @param array $post
	 * @param array $attachment
	 * @return array
	 */
	function fair_edge_image_attachment_fields_to_save($post, $attachment) {

		if( isset($attachment['ptf_single_masonry_image_size']) ){
			update_post_meta($post['ID'], '_ptf_single_masonry_image_size', $attachment['ptf_single_masonry_image_size']);
		}

		return $post;
	}
	add_filter( 'attachment_fields_to_save', 'fair_edge_image_attachment_fields_to_save',10,2 );
}