<?php do_action('fair_edge_before_sticky_header'); ?>

<div class="edgtf-sticky-header">
    <?php do_action( 'fair_edge_after_sticky_menu_html_open' ); ?>
    <div class="edgtf-sticky-holder">
    <?php if($sticky_header_in_grid) : ?>
        <div class="edgtf-grid">
            <?php endif; ?>
            <div class=" edgtf-vertical-align-containers">
                <div class="edgtf-position-left">
                    <div class="edgtf-position-left-inner">
                        <?php if(!$hide_logo) {
                            fair_edge_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="edgtf-position-right">
                    <div class="edgtf-position-right-inner">
						<?php
							switch($header_type):

								case 'header-standard':
									fair_edge_get_sticky_menu('edgtf-sticky-nav');
									break;
								case 'header-full-screen':
									fair_edge_get_full_screen_opener();
									break;
							endswitch;
						?>
						<div class="edgtf-sticky-right-from-main-menu-holder">
						<?php
							switch($header_type):

								case 'header-standard':
									if(is_active_sidebar('edgtf-sticky-right')) :
										dynamic_sidebar('edgtf-sticky-right');
									endif;
									break;
								case 'header-full-screen':
									if(is_active_sidebar('edgtf-full-screen-sticky-right')) :
										dynamic_sidebar('edgtf-full-screen-sticky-right');
									endif;
									break;
							endswitch;
						?>
						</div>
                    </div>
                </div>
            </div>
            <?php if($sticky_header_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php do_action('fair_edge_after_sticky_header'); ?>