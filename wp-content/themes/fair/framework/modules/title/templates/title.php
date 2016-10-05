<?php do_action('fair_edge_before_page_title'); ?>
<?php if($show_title_area) { ?>

    <div class="edgtf-title <?php echo fair_edge_title_classes(); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <div class="edgtf-title-image"><?php if($title_background_image_src != ""){ ?><img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;" /> <?php } ?></div>
        <div class="edgtf-title-holder" <?php fair_edge_inline_style($title_holder_height); ?>>
            <div class="edgtf-container clearfix">
                <div class="edgtf-container-inner">
                    <div class="edgtf-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="edgtf-title-subtitle-holder-inner">
                        <?php switch ($type){
                            case 'standard': ?>
                                <?php if($has_subtitle && $subtitle_position == 'above'){ ?>
                                    <span class="edgtf-subtitle" <?php fair_edge_inline_style($subtitle_color); ?>><span><?php fair_edge_subtitle_text(); ?></span></span>
                                <?php } ?>
                                <?php if (!$hide_title_text) { ?>
                                    <h1 <?php fair_edge_inline_style($title_color); ?>><span><?php fair_edge_title_text(); ?></span></h1>
                                <?php } ?>
								<?php if ($separator_show == 'yes'){
									echo fair_edge_get_separator_html($separator_params);
								} ?>
                                <?php if($has_subtitle && $subtitle_position == 'below'){ ?>
                                    <span class="edgtf-subtitle" <?php fair_edge_inline_style($subtitle_color); ?>><span><?php fair_edge_subtitle_text(); ?></span></span>
                                <?php } ?>
                                <?php if($enable_breadcrumbs){ ?>
                                    <div class="edgtf-breadcrumbs-holder"> <?php fair_edge_custom_breadcrumbs(); ?></div>
                                <?php } ?>
                            <?php break;
                            case 'breadcrumb': ?>
                                <div class="edgtf-breadcrumbs-holder"> <?php fair_edge_custom_breadcrumbs(); ?></div>
								<?php if ($separator_show == 'yes'){
									echo fair_edge_get_separator_html($separator_params);
								} ?>
                            <?php break;
                            }
                            ?>
                        </div>
                    </div>
					<?php if ($rounded_tab) { ?>
						<svg class="edgtf-rounded-tab edgtf-rounded-tab-top <?php echo esc_attr($animate_rounded_tab) ?>" <?php fair_edge_inline_style($rounded_tab_style); ?> x="0px" y="0px" width="134.983px" height="35.995px" viewBox="0 0 134.983 35.995" xml:space="preserve">
							<path d="M67.492,0C39.958,0,41.958,35.995,0,35.995c19.162,0,67.492,0,67.492,0s48.33,0,67.491,0	C93.026,35.995,95.026,0,67.492,0z"/>
						</svg>
					<?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<?php do_action('fair_edge_after_page_title'); ?>