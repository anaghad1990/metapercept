<?php
if(!function_exists('fair_edge_design_styles')) {
    /**
     * Generates general custom styles
     */
    function fair_edge_design_styles() {

        $preload_background_styles = array();

        if(fair_edge_options()->getOptionValue('preload_pattern_image') !== ""){
            $preload_background_styles['background-image'] = 'url('.fair_edge_options()->getOptionValue('preload_pattern_image').') !important';
        }else{
            $preload_background_styles['background-image'] = 'url('.esc_url(EDGE_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo fair_edge_dynamic_css('.edgtf-preload-background', $preload_background_styles);

		if (fair_edge_options()->getOptionValue('google_fonts')){
			$font_family = fair_edge_options()->getOptionValue('google_fonts');
			if(fair_edge_is_font_option_valid($font_family)) {
				echo fair_edge_dynamic_css('body', array('font-family' => fair_edge_get_font_option_val($font_family)));
			}
		}

		if (fair_edge_options()->getOptionValue('google_fonts_second')){
			$font_family_second = fair_edge_options()->getOptionValue('google_fonts_second');
			if(fair_edge_is_font_option_valid($font_family_second)) {

				$font_family_second_selector = array(
					'h1',
					'h2',
					'h3',
					'h4',
					'.edgtf-404-page .edgtf-page-not-found .edgtf-number-holder',
					'nav.edgtf-fullscreen-menu ul li a',
					'nav.edgtf-fullscreen-menu ul li ul li a',
					'.edgtf-search-cover .edgtf-form-holder input[type="text"]',
					'.edgtf-search-cover input:focus',
					'.edgtf-fullscreen-search-holder .edgtf-search-field',
					'.edgtf-fullscreen-search-opened .edgtf-form-holder .edgtf-search-field',
					'.edgtf-portfolio-single-holder .edgtf-portfolio-single-nav a',
					'.edgtf-counter-holder .edgtf-counter',
					'.countdown-amount',
					'.edgtf-progress-bar .edgtf-progress-number-wrapper .edgtf-progress-number',
					'.edgtf-testimonials.edgtf-testimonials-type-simple .edgtf-testimonial-text',
					'.edgtf-price-table .edgtf-price-table-inner ul li.edgtf-table-prices .edgtf-price',
					'.edgtf-pie-chart-holder .edgtf-to-counter',
					'.edgtf-pie-chart-holder .edgtf-percent-sign',
					'.edgtf-process-holder .edgtf-process-item-holder .edgtf-pi-number-holder .edgtf-pi-number',
					'blockquote .edgtf-blockquote-text',
					'.edgtf-banner .edgtf-banner-info .edgtf-banner-content-holder span.edgtf-banner-content',
					'.edgtf-numbered-boxes-holder .edgtf-numbered-box .edgtf-numbered-box-number ',
					'.edgtf-blog-single-navigation .edgtf-blog-single-prev a .edgtf-single-navigation-text',
					'.edgtf-blog-single-navigation .edgtf-blog-single-next a .edgtf-single-navigation-text',
				);

				echo fair_edge_dynamic_css($font_family_second_selector, array('font-family' => fair_edge_get_font_option_val($font_family_second)));
			}
		}

        if(fair_edge_options()->getOptionValue('first_color') !== "") {
            $color_selector = array(
				'a',
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'h6 a:hover',
				'p a',
				'.edgtf-comment-holder .edgtf-comment-text .comment-edit-link:hover',
				'.edgtf-comment-holder .edgtf-comment-text .comment-reply-link:hover',
				'.edgtf-comment-holder .edgtf-comment-text .replay:hover',
				'#submit_comment:hover',
				'.post-password-form input[type=submit]:hover',
				'input.wpcf7-form-control.wpcf7-submit:hover',
				'.edgtf-main-menu ul li.edgtf-active-item a',
				'.edgtf-main-menu ul li:hover a',
				'.edgtf-main-menu>ul>li.edgtf-active-item>a',
				'body:not(.edgtf-menu-item-first-level-bg-color) .edgtf-main-menu>ul>li:hover>a',
				'.edgtf-mobile-header .edgtf-mobile-nav a:hover',
				'.edgtf-mobile-header .edgtf-mobile-nav h4:hover',
				'.edgtf-mobile-header .edgtf-mobile-menu-opener a:hover',
				'footer .widget .tagcloud a:hover',
				'.edgtf-side-menu-button-opener:hover',
				'.edgtf-side-menu .tagcloud a:hover',
				'nav.edgtf-fullscreen-menu ul li ul li a:hover',
				'.edgtf-search-cover .edgtf-search-close a:hover',
				'.edgtf-team .edgtf-team-social-wrapp .edgtf-icon-shortcode a:hover',
				'.edgtf-team.main-info-below-image .edgtf-team-social-wrapp .edgtf-icon-shortcode a:hover',
				'.edgtf-message .edgtf-message-inner a.edgtf-close',
				'.edgtf-ordered-list ol>li:before',
				'.edgtf-icon-list-item .edgtf-icon-list-icon-holder-inner i',
				'.edgtf-icon-list-item .edgtf-icon-list-icon-holder-inner span',
				'.edgtf-accordion-holder .edgtf-title-holder .edgtf-accordion-mark',
				'.edgtf-blog-list-holder .edgtf-item-categories-section a:hover',
				'.edgtf-blog-slider .edgtf-item-categories-section a:hover',
				'.edgtf-dropcaps',
				'.edgtf-portfolio-slider-holder .edgtf-portfolio-list-holder.owl-carousel .owl-buttons .edgtf-next-icon i',
				'.edgtf-portfolio-slider-holder .edgtf-portfolio-list-holder.owl-carousel .owl-buttons .edgtf-prev-icon i',
				'.edgtf-portfolio-filter-holder .edgtf-portfolio-filter-holder-inner ul li.active span',
				'.edgtf-portfolio-filter-holder .edgtf-portfolio-filter-holder-inner ul li.current span',
				'.edgtf-social-share-holder.edgtf-list li a:hover',
				'.edgtf-sidebar .widget ul li>a:hover',
				'.edgtf-sidebar .widget .recentcomments:hover a',
				'.edgtf-sidebar .widget .tagcloud a:hover',
				'.edgtf-sidebar .widget.widget_archive li:hover',
				'.edgtf-sidebar .widget.widget_calendar #next a',
				'.edgtf-sidebar .widget.widget_calendar #prev a',
				'.edgtf-blog-holder article.sticky .edgtf-post-title a',
				'.edgtf-blog-holder article .edgtf-post-info .edgtf-post-info-category a:hover',
				'.edgtf-blog-holder article .edgtf-post-info-bottom .edgtf-post-info-bottom-left a:hover',
				'.edgtf-blog-holder.edgtf-blog-type-masonry article .edgtf-post-info a:hover',
				'.edgtf-blog-holder.edgtf-blog-type-narrow article .edgtf-post-info a:hover',
				'.edgtf-blog-holder.edgtf-blog-type-masonry-gallery article.format-link.edgtf-masonry-gallery-item-skin-dark .edgtf-post-title a:hover',
				'.edgtf-blog-holder.edgtf-blog-type-masonry-gallery article.format-quote.edgtf-masonry-gallery-item-skin-dark .edgtf-post-title a:hover',
				'.edgtf-woocommerce-page .price>.amount',
				'.edgtf-woocommerce-page ins',
				'.woocommerce .price>.amount',
				'.woocommerce ins',
				'.edgtf-single-product-wrapper-top .edgtf-tabs.edgtf-horizontal-tab .edgtf-tabs-nav li.ui-state-active a',
				'.edgtf-single-product-wrapper-top .edgtf-tabs.edgtf-horizontal-tab .edgtf-tabs-nav li.ui-state-hover a',
				'.edgtf-shopping-cart-dropdown ul li a:hover',
				'.star-rating span',
				'.edgtf-blog-list-holder.edgtf-boxes .edgtf-item-image:hover~.edgtf-item-text-holder .edgtf-item-title',
				'.product-type-grouped .edgtf-single-product-summary p.price'
            );

            $color_important_selector = array(
				'.edgtf-light-header .edgtf-top-bar .widget .edgtf-icon-shortcode>a:hover',
				'.edgtf-top-bar-light .edgtf-top-bar .widget .edgtf-icon-shortcode>a:hover',
				'.edgtf-dark-header .edgtf-top-bar .widget .edgtf-icon-shortcode>a:hover',
				'.edgtf-top-bar-dark .edgtf-top-bar .widget .edgtf-icon-shortcode>a:hover'
            );

            $background_color_selector = array(
				'.edgtf-st-loader .pulse',
				'.edgtf-st-loader .double_pulse .double-bounce1',
				'.edgtf-st-loader .double_pulse .double-bounce2',
				'.edgtf-st-loader .cube',
				'.edgtf-st-loader .rotating_cubes .cube1',
				'.edgtf-st-loader .rotating_cubes .cube2',
				'.edgtf-st-loader .stripes>div',
				'.edgtf-st-loader .wave>div',
				'.edgtf-st-loader .two_rotating_circles .dot1',
				'.edgtf-st-loader .two_rotating_circles .dot2',
				'.edgtf-st-loader .five_rotating_circles .container1>div',
				'.edgtf-st-loader .five_rotating_circles .container2>div',
				'.edgtf-st-loader .five_rotating_circles .container3>div',
				'.edgtf-st-loader .atom .ball-1:before',
				'.edgtf-st-loader .atom .ball-2:before',
				'.edgtf-st-loader .atom .ball-3:before',
				'.edgtf-st-loader .atom .ball-4:before',
				'.edgtf-st-loader .clock .ball:before',
				'.edgtf-st-loader .mitosis .ball',
				'.edgtf-st-loader .lines .line1',
				'.edgtf-st-loader .lines .line2',
				'.edgtf-st-loader .lines .line3',
				'.edgtf-st-loader .lines .line4',
				'.edgtf-st-loader .fussion .ball',
				'.edgtf-st-loader .fussion .ball-1',
				'.edgtf-st-loader .fussion .ball-2',
				'.edgtf-st-loader .fussion .ball-3',
				'.edgtf-st-loader .fussion .ball-4',
				'.edgtf-st-loader .wave_circles .ball',
				'.edgtf-st-loader .pulse_circles .ball',
				'#submit_comment',
				'.post-password-form input[type=submit]',
				'input.wpcf7-form-control.wpcf7-submit',
				'.edgtf-slick-slider-navigation-style .edgtf-slick-dots li.slick-active',
				'.slick-slider .edgtf-slick-dots li.slick-active',
				'#edgtf-back-to-top>span',
				'.edgtf-header-vertical .edgtf-vertical-menu>ul>li>a:before',
				'.edgtf-header-vertical .edgtf-vertical-menu>ul>li>a:after',
				'.edgtf-fullscreen-menu-opener:hover .edgtf-line',
				'.edgtf-fullscreen-menu-opener.opened:hover .edgtf-line:after',
				'.edgtf-fullscreen-menu-opener.opened:hover .edgtf-line:before',
				'.edgtf-icon-shortcode.circle',
				'.edgtf-icon-shortcode.square',
				'.edgtf-progress-bar .edgtf-progress-content-outer .edgtf-progress-content',
				'.edgtf-price-table.edgtf-active .edgtf-table-title',
				'.edgtf-pie-chart-doughnut-holder .edgtf-pie-legend ul li .edgtf-pie-color-holder',
				'.edgtf-pie-chart-pie-holder .edgtf-pie-legend ul li .edgtf-pie-color-holder',
				'.edgtf-carousel-holder .edgtf-carousel-item-holder .edgtf-carousel-first-image-holder.edgtf-underline .edgtf-carousel-underline',
				'.edgtf-image-gallery .owl-pagination .owl-page.active span',
				'.edgtf-dropcaps.edgtf-circle',
				'.edgtf-dropcaps.edgtf-square',
				'.edgtf-portfolio-list-holder-outer article.edgtf-hover-push .edgtf-item-text-overlay',
				'.edgtf-sidebar .edgtf-widget-title:after',
				'.edgtf-blog-audio-holder .mejs-container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current',
				'.edgtf-blog-audio-holder .mejs-container .mejs-controls .mejs-time-rail .mejs-time-current',
				'.edgtf-woocommerce-page .product .edgtf-product-badge.edgtf-onsale',
				'.woocommerce .product .edgtf-product-badge.edgtf-onsale',
				'.edgtf-woocommerce-page .product .edgtf-btn.add_to_cart_button:hover',
				'.edgtf-woocommerce-page .product .edgtf-btn.added_to_cart:hover',
				'.woocommerce .product .edgtf-btn.add_to_cart_button:hover',
				'.woocommerce .product .edgtf-btn.added_to_cart:hover',
				'.edgtf-btn.add_to_cart_button',
				'.edgtf-btn.added_to_cart',
				'.edgtf-woocommerce-page .edgtf-quantity-buttons .edgtf-quantity-minus:hover',
				'.edgtf-woocommerce-page .edgtf-quantity-buttons .edgtf-quantity-plus:hover',
				'.woocommerce-account input[type=submit]:hover',
				'.woocommerce-checkout input[type=submit]:hover',
				'.woocommerce.widget button',
				'.woocommerce.widget input[type=submit]',
				'.edgtf-team.main-info-below-image:not(.edgtf-image-rounded) .edgtf-team-social-wrapp:before',
				'.edgtf-fullscreen-menu-opener:hover .edgtf-line',
				'.edgtf-blog-holder.edgtf-blog-type-masonry article .edgtf-blog-slide-info-line-holder .edgtf-blog-slide-info-line',
				'#edgtf-back-to-top:before',
				'.edgtf-btn.edgtf-btn-solid-two',
				'.edgtf-portfolio-list-holder-outer article.edgtf-hover-launch .edgtf-portfolio-link-launch'
            );

            $background_color_important_selector = array(
                '.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-hover-bg):hover',
                '.edgtf-btn.edgtf-btn-outline-white:not(.edgtf-btn-custom-hover-bg):hover'
            );

            $border_color_selector = array(
				'.edgtf-st-loader .pulse_circles .ball',
				'#respond input[type=text]:focus',
				'#respond textarea:focus',
				'.post-password-form input[type=password]:focus',
				'.wpcf7-form-control.wpcf7-date:focus',
				'.wpcf7-form-control.wpcf7-number:focus',
				'.wpcf7-form-control.wpcf7-quiz:focus',
				'.wpcf7-form-control.wpcf7-select:focus',
				'.wpcf7-form-control.wpcf7-text:focus',
				'.wpcf7-form-control.wpcf7-textarea:focus',
				'#submit_comment',
				'.post-password-form input[type=submit]',
				'input.wpcf7-form-control.wpcf7-submit',
				'.edgtf-slick-slider-navigation-style .edgtf-slick-dots li.slick-active',
				'.slick-slider .edgtf-slick-dots li.slick-active',
				'.edgtf-testimonials.edgtf-testimonials-light .edgtf-slick-dots li.slick-active',
				'.edgtf-image-gallery .edgtf-image-gallery-slider .slick-dots li.slick-active .edgtf-slick-dot-inner',
				'.edgtf-single-product-related-products-holder .edgtf-separator',
				'.edgtf-single-product-wrapper-top .edgtf-tabs.edgtf-horizontal-tab .edgtf-tabs-nav li.ui-state-active a',
				'.edgtf-single-product-wrapper-top .edgtf-tabs.edgtf-horizontal-tab .edgtf-tabs-nav li.ui-state-hover a',
				'.woocommerce-account input[type=submit]:hover',
				'.woocommerce-checkout input[type=submit]:hover',
				'.woocommerce.widget button',
				'.woocommerce.widget input[type=submit]',
				'.woocommerce.widget input[type=search]:focus',
				'.edgtf-btn.edgtf-btn-solid-two',
				'.edgtf-drop-down .edgtf-menu-narrow .edgtf-menu-second .edgtf-menu-inner ul .edgtf-narrow-menu-line',
				'.edgtf-drop-down .edgtf-menu-wide .edgtf-wide-menu-line',
				'.edgtf-header-vertical .edgtf-vertical-menu ul .edgtf-vertical-menu-line',
				'.edgtf-header-vertical .edgtf-vertical-menu>ul>li>a .edgtf-item-outer:after'
            );

			$border_color_important_selector = array(
				'.edgtf-btn.edgtf-btn-solid:not(.edgtf-btn-custom-border-hover):hover',
				'.edgtf-btn.edgtf-btn-outline-white:not(.edgtf-btn-custom-border-hover):hover',
				'.edgtf-image-gallery .edgtf-image-gallery-slider .slick-dots li.slick-active .edgtf-slick-dot-inner',
			);

			$border_bottom_color_selector = array(
				'.edgtf-tabs .edgtf-tabs-nav li.ui-state-active a',
				'.edgtf-tabs .edgtf-tabs-nav li.ui-state-hover a',
				'.edgtf-accordion-holder .edgtf-title-holder.ui-state-active',
				'.edgtf-accordion-holder .edgtf-title-holder.ui-state-hover',
				'.edgtf-sidebar .widget .edgtf-search-wrapper input[type=text]:focus',
				'.edgtf-separator',
				'.woocommerce-account .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link.is-active a',
				'.woocommerce-account .woocommerce-MyAccount-navigation .woocommerce-MyAccount-navigation-link:hover a'
			);

			$border_left_color_selector = array(
				'.edgtf-video-button-play .edgtf-video-button-wrapper .edgtf-video-button-icon'
			);

			$border_top_color_selector = array(
				'.edgtf-main-menu .edgtf-main-menu-line'
			);

            echo fair_edge_dynamic_css($color_selector, array('color' => fair_edge_options()->getOptionValue('first_color')));
            echo fair_edge_dynamic_css($color_important_selector, array('color' => fair_edge_options()->getOptionValue('first_color').'!important'));
            echo fair_edge_dynamic_css('::selection', array('background' => fair_edge_options()->getOptionValue('first_color')));
            echo fair_edge_dynamic_css('::-moz-selection', array('background' => fair_edge_options()->getOptionValue('first_color')));
            echo fair_edge_dynamic_css($background_color_selector, array('background-color' => fair_edge_options()->getOptionValue('first_color')));
            echo fair_edge_dynamic_css($background_color_important_selector, array('background-color' => fair_edge_options()->getOptionValue('first_color').'!important'));
            echo fair_edge_dynamic_css($border_color_selector, array('border-color' => fair_edge_options()->getOptionValue('first_color')));
            echo fair_edge_dynamic_css($border_color_important_selector, array('border-color' => fair_edge_options()->getOptionValue('first_color').'!important'));
            echo fair_edge_dynamic_css($border_bottom_color_selector, array('border-bottom-color' => fair_edge_options()->getOptionValue('first_color')));
            echo fair_edge_dynamic_css($border_left_color_selector, array('border-left-color' => fair_edge_options()->getOptionValue('first_color')));
            echo fair_edge_dynamic_css($border_top_color_selector, array('border-top-color' => fair_edge_options()->getOptionValue('first_color')));
        }

		if (fair_edge_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
				'.edgtf-wrapper-inner',
				'.edgtf-content',
				'.edgtf-content-inner > .edgtf-container'
			);
			echo fair_edge_dynamic_css($background_color_selector, array('background-color' => fair_edge_options()->getOptionValue('page_background_color')));
		}

		if (fair_edge_options()->getOptionValue('selection_color')) {
			echo fair_edge_dynamic_css('::selection', array('background' => fair_edge_options()->getOptionValue('selection_color')));
			echo fair_edge_dynamic_css('::-moz-selection', array('background' => fair_edge_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (fair_edge_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = fair_edge_options()->getOptionValue('page_background_color_in_box');
		}

		if (fair_edge_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(fair_edge_options()->getOptionValue('boxed_background_image')).')';
			if(fair_edge_options()->getOptionValue('boxed_background_image_repeating') == 'yes') {
				$boxed_background_style['background-position'] = '0px 0px';
				$boxed_background_style['background-repeat'] = 'repeat';
			} else {
				$boxed_background_style['background-position'] = 'center 0px';
				$boxed_background_style['background-repeat'] = 'repeat';
			}
		}


		if (fair_edge_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (fair_edge_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo fair_edge_dynamic_css('.edgtf-boxed .edgtf-wrapper', $boxed_background_style);
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_design_styles');
}

if (!function_exists('fair_edge_h1_styles')) {

    function fair_edge_h1_styles() {

        $h1_styles = array();

        if(fair_edge_options()->getOptionValue('h1_color') !== '') {
            $h1_styles['color'] = fair_edge_options()->getOptionValue('h1_color');
        }
        if(fair_edge_options()->getOptionValue('h1_google_fonts') !== '-1') {
            $h1_styles['font-family'] = fair_edge_get_formatted_font_family(fair_edge_options()->getOptionValue('h1_google_fonts'));
        }
        if(fair_edge_options()->getOptionValue('h1_fontsize') !== '') {
            $h1_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h1_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h1_lineheight') !== '') {
            $h1_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h1_lineheight')).'px';
        }
        if(fair_edge_options()->getOptionValue('h1_texttransform') !== '') {
            $h1_styles['text-transform'] = fair_edge_options()->getOptionValue('h1_texttransform');
        }
        if(fair_edge_options()->getOptionValue('h1_fontstyle') !== '') {
            $h1_styles['font-style'] = fair_edge_options()->getOptionValue('h1_fontstyle');
        }
        if(fair_edge_options()->getOptionValue('h1_fontweight') !== '') {
            $h1_styles['font-weight'] = fair_edge_options()->getOptionValue('h1_fontweight');
        }
        if(fair_edge_options()->getOptionValue('h1_letterspacing') !== '') {
            $h1_styles['letter-spacing'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h1_letterspacing')).'px';
        }

        $h1_selector = array(
            'h1'
        );

        if (!empty($h1_styles)) {
            echo fair_edge_dynamic_css($h1_selector, $h1_styles);
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_h1_styles');
}

if (!function_exists('fair_edge_h2_styles')) {

    function fair_edge_h2_styles() {

        $h2_styles = array();

        if(fair_edge_options()->getOptionValue('h2_color') !== '') {
            $h2_styles['color'] = fair_edge_options()->getOptionValue('h2_color');
        }
        if(fair_edge_options()->getOptionValue('h2_google_fonts') !== '-1') {
            $h2_styles['font-family'] = fair_edge_get_formatted_font_family(fair_edge_options()->getOptionValue('h2_google_fonts'));
        }
        if(fair_edge_options()->getOptionValue('h2_fontsize') !== '') {
            $h2_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h2_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h2_lineheight') !== '') {
            $h2_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h2_lineheight')).'px';
        }
        if(fair_edge_options()->getOptionValue('h2_texttransform') !== '') {
            $h2_styles['text-transform'] = fair_edge_options()->getOptionValue('h2_texttransform');
        }
        if(fair_edge_options()->getOptionValue('h2_fontstyle') !== '') {
            $h2_styles['font-style'] = fair_edge_options()->getOptionValue('h2_fontstyle');
        }
        if(fair_edge_options()->getOptionValue('h2_fontweight') !== '') {
            $h2_styles['font-weight'] = fair_edge_options()->getOptionValue('h2_fontweight');
        }
        if(fair_edge_options()->getOptionValue('h2_letterspacing') !== '') {
            $h2_styles['letter-spacing'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h2_letterspacing')).'px';
        }

        $h2_selector = array(
            'h2'
        );

        if (!empty($h2_styles)) {
            echo fair_edge_dynamic_css($h2_selector, $h2_styles);
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_h2_styles');
}

if (!function_exists('fair_edge_h3_styles')) {

    function fair_edge_h3_styles() {

        $h3_styles = array();

        if(fair_edge_options()->getOptionValue('h3_color') !== '') {
            $h3_styles['color'] = fair_edge_options()->getOptionValue('h3_color');
        }
        if(fair_edge_options()->getOptionValue('h3_google_fonts') !== '-1') {
            $h3_styles['font-family'] = fair_edge_get_formatted_font_family(fair_edge_options()->getOptionValue('h3_google_fonts'));
        }
        if(fair_edge_options()->getOptionValue('h3_fontsize') !== '') {
            $h3_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h3_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h3_lineheight') !== '') {
            $h3_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h3_lineheight')).'px';
        }
        if(fair_edge_options()->getOptionValue('h3_texttransform') !== '') {
            $h3_styles['text-transform'] = fair_edge_options()->getOptionValue('h3_texttransform');
        }
        if(fair_edge_options()->getOptionValue('h3_fontstyle') !== '') {
            $h3_styles['font-style'] = fair_edge_options()->getOptionValue('h3_fontstyle');
        }
        if(fair_edge_options()->getOptionValue('h3_fontweight') !== '') {
            $h3_styles['font-weight'] = fair_edge_options()->getOptionValue('h3_fontweight');
        }
        if(fair_edge_options()->getOptionValue('h3_letterspacing') !== '') {
            $h3_styles['letter-spacing'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h3_letterspacing')).'px';
        }

        $h3_selector = array(
            'h3'
        );

        if (!empty($h3_styles)) {
            echo fair_edge_dynamic_css($h3_selector, $h3_styles);
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_h3_styles');
}

if (!function_exists('fair_edge_h4_styles')) {

    function fair_edge_h4_styles() {

        $h4_styles = array();

        if(fair_edge_options()->getOptionValue('h4_color') !== '') {
            $h4_styles['color'] = fair_edge_options()->getOptionValue('h4_color');
        }
        if(fair_edge_options()->getOptionValue('h4_google_fonts') !== '-1') {
            $h4_styles['font-family'] = fair_edge_get_formatted_font_family(fair_edge_options()->getOptionValue('h4_google_fonts'));
        }
        if(fair_edge_options()->getOptionValue('h4_fontsize') !== '') {
            $h4_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h4_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h4_lineheight') !== '') {
            $h4_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h4_lineheight')).'px';
        }
        if(fair_edge_options()->getOptionValue('h4_texttransform') !== '') {
            $h4_styles['text-transform'] = fair_edge_options()->getOptionValue('h4_texttransform');
        }
        if(fair_edge_options()->getOptionValue('h4_fontstyle') !== '') {
            $h4_styles['font-style'] = fair_edge_options()->getOptionValue('h4_fontstyle');
        }
        if(fair_edge_options()->getOptionValue('h4_fontweight') !== '') {
            $h4_styles['font-weight'] = fair_edge_options()->getOptionValue('h4_fontweight');
        }
        if(fair_edge_options()->getOptionValue('h4_letterspacing') !== '') {
            $h4_styles['letter-spacing'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h4_letterspacing')).'px';
        }

        $h4_selector = array(
            'h4'
        );

        if (!empty($h4_styles)) {
            echo fair_edge_dynamic_css($h4_selector, $h4_styles);
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_h4_styles');
}

if (!function_exists('fair_edge_h5_styles')) {

    function fair_edge_h5_styles() {

        $h5_styles = array();

        if(fair_edge_options()->getOptionValue('h5_color') !== '') {
            $h5_styles['color'] = fair_edge_options()->getOptionValue('h5_color');
        }
        if(fair_edge_options()->getOptionValue('h5_google_fonts') !== '-1') {
            $h5_styles['font-family'] = fair_edge_get_formatted_font_family(fair_edge_options()->getOptionValue('h5_google_fonts'));
        }
        if(fair_edge_options()->getOptionValue('h5_fontsize') !== '') {
            $h5_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h5_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h5_lineheight') !== '') {
            $h5_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h5_lineheight')).'px';
        }
        if(fair_edge_options()->getOptionValue('h5_texttransform') !== '') {
            $h5_styles['text-transform'] = fair_edge_options()->getOptionValue('h5_texttransform');
        }
        if(fair_edge_options()->getOptionValue('h5_fontstyle') !== '') {
            $h5_styles['font-style'] = fair_edge_options()->getOptionValue('h5_fontstyle');
        }
        if(fair_edge_options()->getOptionValue('h5_fontweight') !== '') {
            $h5_styles['font-weight'] = fair_edge_options()->getOptionValue('h5_fontweight');
        }
        if(fair_edge_options()->getOptionValue('h5_letterspacing') !== '') {
            $h5_styles['letter-spacing'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h5_letterspacing')).'px';
        }

        $h5_selector = array(
            'h5'
        );

        if (!empty($h5_styles)) {
            echo fair_edge_dynamic_css($h5_selector, $h5_styles);
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_h5_styles');
}

if (!function_exists('fair_edge_h6_styles')) {

    function fair_edge_h6_styles() {

        $h6_styles = array();

        if(fair_edge_options()->getOptionValue('h6_color') !== '') {
            $h6_styles['color'] = fair_edge_options()->getOptionValue('h6_color');
        }
        if(fair_edge_options()->getOptionValue('h6_google_fonts') !== '-1') {
            $h6_styles['font-family'] = fair_edge_get_formatted_font_family(fair_edge_options()->getOptionValue('h6_google_fonts'));
        }
        if(fair_edge_options()->getOptionValue('h6_fontsize') !== '') {
            $h6_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h6_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('h6_lineheight') !== '') {
            $h6_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h6_lineheight')).'px';
        }
        if(fair_edge_options()->getOptionValue('h6_texttransform') !== '') {
            $h6_styles['text-transform'] = fair_edge_options()->getOptionValue('h6_texttransform');
        }
        if(fair_edge_options()->getOptionValue('h6_fontstyle') !== '') {
            $h6_styles['font-style'] = fair_edge_options()->getOptionValue('h6_fontstyle');
        }
        if(fair_edge_options()->getOptionValue('h6_fontweight') !== '') {
            $h6_styles['font-weight'] = fair_edge_options()->getOptionValue('h6_fontweight');
        }
        if(fair_edge_options()->getOptionValue('h6_letterspacing') !== '') {
            $h6_styles['letter-spacing'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('h6_letterspacing')).'px';
        }

        $h6_selector = array(
            'h6'
        );

        if (!empty($h6_styles)) {
            echo fair_edge_dynamic_css($h6_selector, $h6_styles);
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_h6_styles');
}

if (!function_exists('fair_edge_text_styles')) {

    function fair_edge_text_styles() {

        $text_styles = array();

        if(fair_edge_options()->getOptionValue('text_color') !== '') {
            $text_styles['color'] = fair_edge_options()->getOptionValue('text_color');
        }
        if(fair_edge_options()->getOptionValue('text_google_fonts') !== '-1') {
            $text_styles['font-family'] = fair_edge_get_formatted_font_family(fair_edge_options()->getOptionValue('text_google_fonts'));
        }
        if(fair_edge_options()->getOptionValue('text_fontsize') !== '') {
            $text_styles['font-size'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('text_fontsize')).'px';
        }
        if(fair_edge_options()->getOptionValue('text_lineheight') !== '') {
            $text_styles['line-height'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('text_lineheight')).'px';
        }
        if(fair_edge_options()->getOptionValue('text_texttransform') !== '') {
            $text_styles['text-transform'] = fair_edge_options()->getOptionValue('text_texttransform');
        }
        if(fair_edge_options()->getOptionValue('text_fontstyle') !== '') {
            $text_styles['font-style'] = fair_edge_options()->getOptionValue('text_fontstyle');
        }
        if(fair_edge_options()->getOptionValue('text_fontweight') !== '') {
            $text_styles['font-weight'] = fair_edge_options()->getOptionValue('text_fontweight');
        }
        if(fair_edge_options()->getOptionValue('text_letterspacing') !== '') {
            $text_styles['letter-spacing'] = fair_edge_filter_px(fair_edge_options()->getOptionValue('text_letterspacing')).'px';
        }

        $text_selector = array(
            'p'
        );

        if (!empty($text_styles)) {
            echo fair_edge_dynamic_css($text_selector, $text_styles);
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_text_styles');
}

if (!function_exists('fair_edge_link_styles')) {

    function fair_edge_link_styles() {

        $link_styles = array();

        if(fair_edge_options()->getOptionValue('link_color') !== '') {
            $link_styles['color'] = fair_edge_options()->getOptionValue('link_color');
        }
        if(fair_edge_options()->getOptionValue('link_fontstyle') !== '') {
            $link_styles['font-style'] = fair_edge_options()->getOptionValue('link_fontstyle');
        }
        if(fair_edge_options()->getOptionValue('link_fontweight') !== '') {
            $link_styles['font-weight'] = fair_edge_options()->getOptionValue('link_fontweight');
        }
        if(fair_edge_options()->getOptionValue('link_fontdecoration') !== '') {
            $link_styles['text-decoration'] = fair_edge_options()->getOptionValue('link_fontdecoration');
        }

        $link_selector = array(
            'a',
            'p a'
        );

        if (!empty($link_styles)) {
            echo fair_edge_dynamic_css($link_selector, $link_styles);
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_link_styles');
}

if (!function_exists('fair_edge_link_hover_styles')) {

    function fair_edge_link_hover_styles() {

        $link_hover_styles = array();

        if(fair_edge_options()->getOptionValue('link_hovercolor') !== '') {
            $link_hover_styles['color'] = fair_edge_options()->getOptionValue('link_hovercolor');
        }
        if(fair_edge_options()->getOptionValue('link_hover_fontdecoration') !== '') {
            $link_hover_styles['text-decoration'] = fair_edge_options()->getOptionValue('link_hover_fontdecoration');
        }

        $link_hover_selector = array(
            'a:hover',
            'p a:hover'
        );

        if (!empty($link_hover_styles)) {
            echo fair_edge_dynamic_css($link_hover_selector, $link_hover_styles);
        }

        $link_heading_hover_styles = array();

        if(fair_edge_options()->getOptionValue('link_hovercolor') !== '') {
            $link_heading_hover_styles['color'] = fair_edge_options()->getOptionValue('link_hovercolor');
        }

        $link_heading_hover_selector = array(
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover'
        );

        if (!empty($link_heading_hover_styles)) {
            echo fair_edge_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_link_hover_styles');
}

if (!function_exists('fair_edge_smooth_page_transition_styles')) {

    function fair_edge_smooth_page_transition_styles() {
        
        $loader_style = array();

        if(fair_edge_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
            $loader_style['background-color'] = fair_edge_options()->getOptionValue('smooth_pt_bgnd_color');
        }

        $loader_selector = array('.edgtf-smooth-transition-loader');

        if (!empty($loader_style)) {
            echo fair_edge_dynamic_css($loader_selector, $loader_style);
        }

        $spinner_style = array();

        if(fair_edge_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
            $spinner_style['background-color'] = fair_edge_options()->getOptionValue('smooth_pt_spinner_color');
        }

        $spinner_selectors = array(
            '.edgtf-st-loader .pulse',
            '.edgtf-st-loader .double_pulse .double-bounce1',
            '.edgtf-st-loader .double_pulse .double-bounce2',
            '.edgtf-st-loader .cube',
            '.edgtf-st-loader .rotating_cubes .cube1',
            '.edgtf-st-loader .rotating_cubes .cube2',
            '.edgtf-st-loader .stripes > div',
            '.edgtf-st-loader .wave > div',
            '.edgtf-st-loader .two_rotating_circles .dot1',
            '.edgtf-st-loader .two_rotating_circles .dot2',
            '.edgtf-st-loader .five_rotating_circles .container1 > div',
            '.edgtf-st-loader .five_rotating_circles .container2 > div',
            '.edgtf-st-loader .five_rotating_circles .container3 > div',
            '.edgtf-st-loader .atom .ball-1:before',
            '.edgtf-st-loader .atom .ball-2:before',
            '.edgtf-st-loader .atom .ball-3:before',
            '.edgtf-st-loader .atom .ball-4:before',
            '.edgtf-st-loader .clock .ball:before',
            '.edgtf-st-loader .mitosis .ball',
            '.edgtf-st-loader .lines .line1',
            '.edgtf-st-loader .lines .line2',
            '.edgtf-st-loader .lines .line3',
            '.edgtf-st-loader .lines .line4',
            '.edgtf-st-loader .fussion .ball',
            '.edgtf-st-loader .fussion .ball-1',
            '.edgtf-st-loader .fussion .ball-2',
            '.edgtf-st-loader .fussion .ball-3',
            '.edgtf-st-loader .fussion .ball-4',
            '.edgtf-st-loader .wave_circles .ball',
            '.edgtf-st-loader .pulse_circles .ball'
        );

        if (!empty($spinner_style)) {
            echo fair_edge_dynamic_css($spinner_selectors, $spinner_style);
        }

        //color spinner
        if(fair_edge_options()->getOptionValue('smooth_pt_spinner_type') == 'color_spinner') {
        	$first_cs_color = array();

        	if(fair_edge_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
        	    $first_cs_color['border-color'] = fair_edge_options()->getOptionValue('smooth_pt_spinner_color');
        	}

        	$first_cs_selector = array('.edgtf-st-loader .edgtf-color-spinner .edgtf-cs-line-1');

        	if (!empty($first_cs_selector)) {
        	    echo fair_edge_dynamic_css($first_cs_selector, $first_cs_color);
        	}

        	$first_additional_color = array();

        	if(fair_edge_options()->getOptionValue('additional_color_1') !== '') {
        	    $first_additional_color['border-color'] = fair_edge_options()->getOptionValue('additional_color_1');
        	}

        	$second_cs_selector = array('.edgtf-st-loader .edgtf-color-spinner .edgtf-cs-line-2');

        	if (!empty($second_cs_selector)) {
        	    echo fair_edge_dynamic_css($second_cs_selector, $first_additional_color);
        	}

        	$second_additional_color = array();

        	if(fair_edge_options()->getOptionValue('additional_color_1') !== '') {
        	    $second_additional_color['border-color'] = fair_edge_options()->getOptionValue('additional_color_2');
        	}

        	$third_cs_selector = array('.edgtf-st-loader .edgtf-color-spinner .edgtf-cs-line-3');

        	if (!empty($third_cs_selector)) {
        	    echo fair_edge_dynamic_css($third_cs_selector, $second_additional_color);
        	}

        	$third_additional_color = array();

        	if(fair_edge_options()->getOptionValue('additional_color_3') !== '') {
        	    $third_additional_color['border-color'] = fair_edge_options()->getOptionValue('additional_color_3');
        	}

        	$fourth_cs_selector = array('.edgtf-st-loader .edgtf-color-spinner .edgtf-cs-line-4');

        	if (!empty($third_cs_selector)) {
        	    echo fair_edge_dynamic_css($fourth_cs_selector, $third_additional_color);
        	}
        }
    }

    add_action('fair_edge_style_dynamic', 'fair_edge_smooth_page_transition_styles');
}

if(!function_exists('fair_edge_gradient_styles')) {
	/**
	 * Generates gradient custom styles
	 */
	function fair_edge_gradient_styles() {

		if(fair_edge_options()->getOptionValue('gradient_style1_start_color') !== '' && fair_edge_options()->getOptionValue('gradient_style1_end_color') !== ''
		) {

			echo fair_edge_dynamic_css('.edgtf-type1-gradient-left-to-right', array(
				'background' => '-webkit-linear-gradient(left,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
				'background' => '-o-linear-gradient(right,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
				'background' => '-moz-linear-gradient(right,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
				'background' => 'linear-gradient(to right,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
			));

			echo fair_edge_dynamic_css('.edgtf-type1-gradient-bottom-to-top, .edgtf-type1-gradient-bottom-to-top-after:after', array(
				'background' => '-webkit-linear-gradient(bottom,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
				'background' => '-o-linear-gradient(top,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
				'background' => '-moz-linear-gradient(top,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
				'background' => 'linear-gradient(to top,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
			));

			echo fair_edge_dynamic_css('.edgtf-type1-gradient-left-bottom-to-right-top', array(
				'background' => '-webkit-linear-gradient(right top,'.fair_edge_options()->getOptionValue('gradient_style1_end_color').', '.fair_edge_options()->getOptionValue('gradient_style1_start_color').')',
				'background' => '-o-linear-gradient(right top,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
				'background' => '-moz-linear-gradient(right top,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
				'background' => 'linear-gradient(to right top,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').', '.fair_edge_options()->getOptionValue('gradient_style1_end_color').')',
			));

			echo fair_edge_dynamic_css('.edgtf-type1-gradient-left-to-right-2x', array(
				'background'      => '-webkit-linear-gradient(left,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').' 0%, '.fair_edge_options()->getOptionValue('gradient_style1_end_color').' 50% ,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').' 100%)',
				'background'      => '-o-linear-gradient(right,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').' 0%, '.fair_edge_options()->getOptionValue('gradient_style1_end_color').' 50% ,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').' 100%)',
				'background'      => '-moz-linear-gradient(right,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').' 0%, '.fair_edge_options()->getOptionValue('gradient_style1_end_color').' 50% ,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').' 100%)',
				'background'      => 'linear-gradient(to right,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').' 0%, '.fair_edge_options()->getOptionValue('gradient_style1_end_color').' 50%,'.fair_edge_options()->getOptionValue('gradient_style1_start_color').' 100%)',
				'background-size' => '200% 200%'
			));

			echo fair_edge_dynamic_css('.edgtf-type1-gradient-left-to-right-text i, .edgtf-type1-gradient-left-to-right-text i:before, .edgtf-type1-gradient-left-to-right-text span', array(
				'background'              => '-webkit-linear-gradient(right top,'.fair_edge_options()->getOptionValue('gradient_style1_end_color').', '.fair_edge_options()->getOptionValue('gradient_style1_start_color').')',
				'color'                   => fair_edge_options()->getOptionValue('gradient_style1_start_color'),
				'-webkit-background-clip' => 'text',
				'-webkit-text-fill-color' => 'transparent'
			));

			echo fair_edge_dynamic_css('.edgtf-type1-gradient-bottom-to-top-text i, .edgtf-type1-gradient-bottom-to-top-text i:before, .edgtf-type1-gradient-bottom-to-top-text span, .edgtf-type1-gradient-bottom-to-top-text span span', array(
				'background'              => '-webkit-linear-gradient(bottom,'.fair_edge_options()->getOptionValue('gradient_style1_end_color').', '.fair_edge_options()->getOptionValue('gradient_style1_start_color').')',
				'color'                   => fair_edge_options()->getOptionValue('gradient_style1_start_color'),
				'-webkit-background-clip' => 'text',
				'-webkit-text-fill-color' => 'transparent'
			));

			echo fair_edge_dynamic_css('.edgtf-type1-gradient-bottom-to-top-text-hover:hover i, .edgtf-type1-gradient-bottom-to-top-text-hover:hover i:before, .edgtf-type1-gradient-bottom-to-top-text-hover:hover span, .edgtf-type1-gradient-bottom-to-top-text-hover:hover span span', array(
				'background'              => '-webkit-linear-gradient(bottom,'.fair_edge_options()->getOptionValue('gradient_style1_end_color').', '.fair_edge_options()->getOptionValue('gradient_style1_start_color').')',
				'color'                   => fair_edge_options()->getOptionValue('gradient_style1_start_color'),
				'-webkit-background-clip' => 'text',
				'-webkit-text-fill-color' => 'transparent'
			));

		}

	}

	add_action('fair_edge_style_dynamic', 'fair_edge_gradient_styles');
}