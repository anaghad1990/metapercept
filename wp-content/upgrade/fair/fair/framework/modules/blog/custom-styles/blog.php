<?php
if(!function_exists('fair_edge_blog_single_with_title_image_styles')) {
    /**
     * Generates styles for blog single
     */
    function fair_edge_blog_single_with_title_image_styles() {
    	$bottom_width_selectors = array(
    		'.edgtf-blog-with-title-image .edgtf-post-info-outer',
    		'.edgtf-blog-with-title-image .edgtf-comments-holder-outer',
    		'.edgtf-blog-with-title-image .edgtf-author-description',
    		'.edgtf-blog-with-title-image .edgtf-related-posts-holder',
		);

        $bottom_content_width = fair_edge_options()->getOptionValue('blog_single_image_bottom_width');

        if($bottom_content_width !== '') {
            echo fair_edge_dynamic_css($bottom_width_selectors, array('width' => $bottom_content_width.'%'));
        }

    }

    add_action('fair_edge_style_dynamic', 'fair_edge_blog_single_with_title_image_styles');
}
