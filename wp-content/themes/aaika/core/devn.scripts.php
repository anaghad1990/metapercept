<?php


add_action( 'wp_enqueue_scripts', 'devn_enqueue_content', 9998 );
add_action( 'wp_enqueue_scripts', 'devn_enqueue_content_last', 9999 );
add_action( 'admin_enqueue_scripts', 'devn_enqueue_admin' );
add_action( 'admin_head', 'devn_admin_head' );

function devn_enqueue_content() {
	
	global $devn;

	$css_dir = THEME_URI.'/assets/css/'; 
	$js_dir = THEME_URI.'/assets/js/'; 
	
	wp_enqueue_style('devn-bootstrap', devn_child_theme_enqueue( $css_dir.'bootstrap3/css/bootstrap.min.gsr.css' ), false, DEVN_VERSION );
	wp_enqueue_style('devn-bootstrap-resp', devn_child_theme_enqueue( $css_dir.'bootstrap_responsive.css' ), false, DEVN_VERSION );
	
	wp_enqueue_style('devn-default', devn_child_theme_enqueue( $css_dir.'default.css'  ), false, DEVN_VERSION );
	wp_enqueue_style('devn-core', devn_child_theme_enqueue( $css_dir.'devn.css'  ), false, DEVN_VERSION );
	wp_enqueue_style('devn-stylesheet', devn_child_theme_enqueue( THEME_URI.'/style.css' ), false, DEVN_VERSION );
	
	if( empty($devn->cfg['effects']) ){
		$devn->cfg['effects'] = 1;
	}
	if( $devn->cfg['effects'] !== 0 ){
		wp_enqueue_style('devn-effects', THEME_URI.'/core/assets/css/animate.css', false, DEVN_VERSION );
	}

	
	wp_register_style('devn-menu-1', devn_child_theme_enqueue( $css_dir.'menu.css' ), false, DEVN_VERSION );
	wp_register_style('devn-menu-2', devn_child_theme_enqueue( $css_dir.'menu-2.css' ), false, DEVN_VERSION );
	wp_register_style('devn-menu-3', devn_child_theme_enqueue( $css_dir.'menu-3.css' ), false, DEVN_VERSION );
	wp_register_style('devn-menu-4', devn_child_theme_enqueue( $css_dir.'menu-4.css' ), false, DEVN_VERSION );
	wp_register_style('devn-menu-5', devn_child_theme_enqueue( $css_dir.'menu-5.css' ), false, DEVN_VERSION );
	wp_register_style('devn-menu-6', devn_child_theme_enqueue( $css_dir.'menu-6.css' ), false, DEVN_VERSION );
	wp_register_style('devn-menu-7', devn_child_theme_enqueue( $css_dir.'menu-7.css' ), false, DEVN_VERSION );
	wp_register_style('devn-menu-onepage', devn_child_theme_enqueue( $css_dir.'menu-onepage.css' ), false, DEVN_VERSION );
	
	wp_enqueue_style('devn-shortcodes', devn_child_theme_enqueue( $css_dir.'shortcodes.css' ), false, DEVN_VERSION );
	
	
	wp_enqueue_script('jquery');
	
	wp_register_script('devn-custom', devn_child_theme_enqueue( $js_dir.'custom.js' ), false, DEVN_VERSION, true );
	wp_register_script('devn-viewportchecker', devn_child_theme_enqueue( $js_dir.'viewportchecker.js' ), false, DEVN_VERSION, true );
	wp_register_script('devn-prettyphoto', devn_child_theme_enqueue( $js_dir.'pretty/js/jquery.prettyPhoto.js' ), false, DEVN_VERSION, true );
	wp_register_script('devn-flexslider', devn_child_theme_enqueue( $js_dir.'jquery.flexslider.js' ), false, DEVN_VERSION, true );
	wp_register_script('devn-bacslider', devn_child_theme_enqueue( $js_dir.'bacslider.js' ), false, DEVN_VERSION, true );
	wp_register_script('devn-portfolio', devn_child_theme_enqueue( $js_dir.'devn_portfolio.js' ), false, DEVN_VERSION, true );
	
	
	wp_enqueue_style('devn-portfolio', devn_child_theme_enqueue( $css_dir.'devn_portfolio.css' ), false, DEVN_VERSION );
	wp_register_style('devn-sticky', devn_child_theme_enqueue( $css_dir.'sticky.css' ), false, DEVN_VERSION );
	wp_enqueue_style('devn-slidepanel', devn_child_theme_enqueue( $css_dir.'slidepanel.css' ), false, DEVN_VERSION );
	
	if( empty($devn->cfg['blog_layout']) ){
	   $devn->cfg['blog_layout'] = '';
	}
	
	wp_enqueue_script('devn-custom');
	wp_enqueue_script('devn-viewportchecker');
	
	wp_enqueue_script('devn-prettyphoto');
	wp_enqueue_script('devn-flexslider');
	
	wp_register_style('devn-masonry', devn_child_theme_enqueue( $css_dir.'blog-masonry.css' ), false, DEVN_VERSION );
   	wp_register_script('devn-masonry', devn_child_theme_enqueue( $js_dir.'jquery.masonry.min.js' ), false, DEVN_VERSION, true );
	
	wp_enqueue_style('devn-timeline', devn_child_theme_enqueue( $css_dir.'timeline.css' ), false, DEVN_VERSION );
	
	if ( is_singular() ){
			wp_enqueue_script( "comment-reply" );
	}

   /* Register google fonts */
   $protocol = is_ssl() ? 'https' : 'http';
   wp_enqueue_style( 'devn-google-fonts', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic|Raleway:400,100,200,300,500,600,700,800,900|Dancing+Script:400,700|Josefin+Sans:400,100,100italic,300,300italic,400italic,600,600italic,700,700italic" );
   
	ob_start();
	$header = $devn->path( 'header' );
	if( $header == true ){
		$devn->path['header'] = ob_get_contents();
	}
	ob_end_clean();
   
}

function devn_enqueue_admin() {
	
	global $devn;

	if( $devn->page == 'aaika-panel' ||  $devn->page == 'page' ){
		wp_enqueue_style('devn-admin', THEME_URI.'/core/assets/css/devn-admin.css', false, time() );
	}
	if( $devn->page == 'aaika-importer' ){
		add_thickbox();
	}
	if( $devn->page == 'page' ){	
		wp_enqueue_style('devn-simple-line-icons.', THEME_URI.'/core/assets/css/simple-line-icons.css', false, time() );
		wp_register_script('devn-admin', THEME_URI.'/core/assets/js/devn-admin.js', false, DEVN_VERSION, true );
		wp_register_script('devn-bs64', THEME_URI.'/core/assets/js/base'.'64.js', false, DEVN_VERSION, true );
		wp_enqueue_script('devn-admin');
		wp_enqueue_script('devn-bs64');
		
		__loadMirror();
		
	}
			
   /* Register google fonts */
   $protocol = is_ssl() ? 'https' : 'http';
   wp_enqueue_style( 'devn-opensans', "$protocol://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900" );

}

function devn_enqueue_content_last(){
	
	global $devn;
	
	$css_dir = THEME_URI.'/assets/css/'; 
	
	if( !empty( $devn->cfg['opt_version'] ) ){ $opt_version = $devn->cfg['opt_version']; }else{ $opt_version = time(); }	
	wp_enqueue_style('devn-options', $css_dir.'options.css', false, $opt_version );
	wp_enqueue_style('devn-responsive', devn_child_theme_enqueue( $css_dir.'responsive.css' ), false, DEVN_VERSION );

}

function devn_admin_head() {
	global $devn;
	if( $devn->page == 'page' ){
		echo '<script type="text/javascript">var site_uri = "'.SITE_URI.'";var site_url = "'.SITE_URI.'";var THEME_URI = "'.THEME_URI.'";var THEME_URI = "'.THEME_URI.'";var theme_name = "'.THEME_NAME.'";</script>';
	}
	echo '<script type="text/javascript">jQuery(document).ready(function(){jQuery("#sc_select").change(function() {send_to_editor(jQuery("#sc_select :selected").val());return false;});});</script>';
	echo '<style type="text/css">.vc_license-activation-notice,.ls-plugins-screen-notice{display: none;}</style>';
}

function __loadMirror(){
	
	global $devn;
	
	$uri = THEME_URI.'/core/assets/';
	
	$footer = true; 
	$u = $uri.'codemirror/lib/';
	$ut = $uri.'codemirror/lib/util/';
	$m = $uri.'codemirror/mode/';
	
	wp_enqueue_style('devn-codemirror', $u.'codemirror.css', false, DEVN_VERSION );
	wp_enqueue_style('devn-dialog', $u.'util/dialog.css', false, DEVN_VERSION );
	wp_enqueue_style('devn-themeeclipse', $uri.'codemirror/theme/eclipse.css', false, DEVN_VERSION );
	
	wp_register_script( 'devn-codemirror', $u.'codemirror.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorhighlighter', $ut.'match-highlighter.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorclosetag', $ut.'closetag.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorformatting', $ut.'formatting.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrordialog', $ut.'dialog.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorsearchcursor', $ut.'searchcursor.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorsearch', $ut.'search.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorhtmlmixed', $m.'htmlmixed/htmlmixed.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorxml', $m.'xml/xml.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorjs', $m.'javascript/javascript.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorcss', $m.'css/css.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorclike', $m.'clike/clike.js', false, DEVN_VERSION, $footer );
	wp_register_script( 'devn-mirrorphp', $m.'php/php.js', false, DEVN_VERSION, $footer );
	
	wp_enqueue_script('devn-codemirror');
	wp_enqueue_script('devn-mirrorhighlighter');
	wp_enqueue_script('devn-mirrorclosetag');
	wp_enqueue_script('devn-mirrorformatting');
	wp_enqueue_script('devn-mirrordialog');
	wp_enqueue_script('devn-mirrorsearchcursor');
	wp_enqueue_script('devn-mirrorsearch');
	wp_enqueue_script('devn-mirrorhtmlmixed');
	wp_enqueue_script('devn-mirrorxml');
	wp_enqueue_script('devn-mirrorjs');
	wp_enqueue_script('devn-mirrorcss');
	wp_enqueue_script('devn-mirrorclike');
	wp_enqueue_script('devn-mirrorphp');
	
}


