<?php
/**
*	This file has been preloaded, so you can wp_enqueue_style to out in wp_head();
*/	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	global $devn;
	
	wp_enqueue_style('devn-sticky');
	wp_enqueue_style('devn-menu-onepage');
	
?>
<!--Header Layout onepage: Location /templates/header/-->
<div id="header" class="sticky condensed">
	<div id="trueHeader">
		<div class="wrapper">
			<div class="container_full">
				<div class="col-md-12">
					<header>
						<!-- Logo -->
						<div class="logo onepage">
							<a href="#home">
								<img src="<?php echo esc_url( $devn->cfg['logo'] ); ?>" alt="<?php bloginfo('description'); ?>" />
							</a>
						</div>
						<!-- Menu -->
						<div class="menu_main" id="menu-onepage">
							<a href="javascript:void(0)" class="nav-toggle">
								<?php _e('Menu', 'aaikadomain' ); ?>
							</a>
							<nav class="nav-collapse">
								<ul>
									<?php
										
										if( !empty( $devn->cfg['menu1page'] ) ){
											$i = 0;
											foreach( explode( "\n", $devn->cfg['menu1page'] ) as $menu ){
												$menu = explode( ':', $menu );
												$i++;
											?>
												<li<?php if( $i == 1 )echo  ' class="active"'; ?>>
													<a href="<?php echo esc_url( trim( $menu[1] ) ); ?>">
														<?php echo esc_html( trim( $menu[0] ) ); ?>
													</a>
												</li>
											<?php	
											}
											
										}else{
											echo 'Menu for onepage is empty, go to <strong>theme panel</strong> -> <strong>header settings</strong> to update menu onepage';
										}
										
									?>
									
								</ul>
							</nav>
						</div>
						<!-- end menu -->  
					</header>
				</div>
			</div>
		</div>
	</div>
</div>
