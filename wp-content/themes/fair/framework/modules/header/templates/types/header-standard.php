<?php do_action('fair_edge_before_page_header'); ?>

<header class="edgtf-page-header">
    <?php if($show_fixed_wrapper) : ?>
        <div class="edgtf-fixed-wrapper">
    <?php endif; ?>
    <div class="edgtf-menu-area" <?php fair_edge_inline_style(array($menu_area_background_color, $menu_area_border_bottom_color)); ?>>
        <?php if($menu_area_in_grid) : ?>
            <div class="edgtf-grid">
        <?php endif; ?>
			<?php do_action( 'fair_edge_after_header_menu_area_html_open' )?>
            <div class="edgtf-vertical-align-containers">
                <div class="edgtf-position-left">
                    <div class="edgtf-position-left-inner">
                        <?php if(!$hide_logo) {
                            fair_edge_get_logo();
                        } ?>
                    </div>
                </div>
                <div class="edgtf-position-right">
                    <div class="edgtf-position-right-inner">
                        <?php fair_edge_get_main_menu(); ?>
                        <?php if(is_active_sidebar('edgtf-right-from-main-menu')) : ?>
                            <div class="edgtf-right-from-main-menu-holder <?php echo esc_attr($menu_area_widget_right_class);?>" <?php fair_edge_inline_style(array($menu_area_right_section_border_left_color)); ?>>
								<?php dynamic_sidebar('edgtf-right-from-main-menu'); ?>
							</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php if($menu_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if($show_fixed_wrapper) : ?>
        </div>
    <?php endif; ?>
    <?php if($show_sticky) {
        fair_edge_get_sticky_header();
    } ?>
</header>

<?php do_action('fair_edge_after_page_header'); ?>

