<?php

class FairEdgeFullScreenMenuOpener extends FairEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edgtf_full_screen_menu_opener', // Base ID
            'Edge Full Screen Menu Opener' // Name
        );

		$this->setParams();
    }

	protected function setParams() {

		$this->params = array(
			array(
				'name'			=> 'fullscreen_menu_opener_icon_color',
				'type'			=> 'textfield',
				'title'			=> 'Icon Color',
				'description'	=> 'Define color for Side Area opener icon'
			)
		);

	}

    public function widget($args, $instance) {
		global $fair_edge_options;

		$fullscreen_icon_styles = array();

		if ( !empty($instance['fullscreen_menu_opener_icon_color']) ) {
			$fullscreen_icon_styles[] = 'background-color: ' . $instance['fullscreen_menu_opener_icon_color'];
		}


		$icon_size = '';
		if ( isset($fair_edge_options['edgtf_fullscreen_menu_icon_size']) && $fair_edge_options['edgtf_fullscreen_menu_icon_size'] !== '' ) {
			$icon_size = $fair_edge_options['edgtf_fullscreen_menu_icon_size'];
		}
		?>
<!--        <a href="javascript:void(0)" class="popup_menu">-->
        <a href="javascript:void(0)" class="edgtf-fullscreen-menu-opener <?php echo esc_attr( $icon_size )?>">
<!--            <span class="popup_menu_inner">-->
            <span class="edgtf-fullscreen-menu-opener-inner">
                <i class="edgtf-line" <?php fair_edge_inline_style($fullscreen_icon_styles); ?>>&nbsp;</i>
            </span>
        </a>
    <?php }

}