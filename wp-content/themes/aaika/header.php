<?php
/**
 *
 * (c) king-theme.com
 *
 * The Header of theme.
 *
 */
 
 
global $devn;

if ( ! isset( $content_width ) ) $content_width = 1170;

?><!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<?php 
	wp_head();
	$mclass =  $devn->cfg['layout']; 
	if( !empty( $post->post_name ) ){
		if( $post->post_type == 'page' )$mclass .= ' page-'.$post->post_name; 
	}
?>
</head>
<body <?php body_class('bg-cover'); ?>>
	<div id="main" class="layout-<?php echo esc_attr( $mclass ); ?> site_wrapper">
	<?php
		
		/**
		* Load header path, change header via theme panel, files location themes/aaika/templates/header/
		*/
		
		devn::path( 'header' ); 
		
	?>
	
