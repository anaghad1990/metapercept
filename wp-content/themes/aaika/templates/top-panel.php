<?php
/**
 * (c) www.king-theme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<div class="devn-group container-group__top-panel" id="sliderContent">
	<div class="row limit-width container">
		<div class="col-md-3">
			<div class="widgetdevn">
				<?php if ( is_active_sidebar( 'panel-c1' ) ) : ?>
						<?php dynamic_sidebar( 'panel-c1' ); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="spanlevelone col-md-3">
			<div class="widgetdevn">
				<?php if ( is_active_sidebar( 'panel-c2' ) ) : ?>
						<?php dynamic_sidebar( 'panel-c2' ); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="spanlevelone col-md-3">
			<div class="widgetdevn">
				<?php if ( is_active_sidebar( 'panel-c3' ) ) : ?>
						<?php dynamic_sidebar( 'panel-c3' ); ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="spanlevelone col-md-3">
			<div class="widgetdevn">
				<?php if ( is_active_sidebar( 'panel-c4' ) ) : ?>
						<?php dynamic_sidebar( 'panel-c4' ); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="openCloseWrap">
		<a href="#" class="topMenuAction" id="topMenuImage">
			<img class="open" src="<?php echo esc_url( THEME_URI.'/assets/images/open.png' ); ?>" alt="">
			<img class="close hide" src="<?php echo esc_url( THEME_URI.'/assets/images/close.png' ); ?>" alt="">
		</a>
	</div>
</div>