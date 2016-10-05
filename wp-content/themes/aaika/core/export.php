<?php
/*
	(c) www.king-theme.com
*/

global $wpdb,$devn;

$wgs = $wpdb->get_results( "SELECT * FROM `".$wpdb->options."` WHERE ".

			"`".$wpdb->options."`.`option_name` LIKE 'widget_%' ".
			" OR ". 
			"`".$wpdb->options."`.`option_name` = 'sidebars_widgets'" );
							
							
$data = array();
if( count( $wgs ) ){
	foreach( $wgs as $wg ){
		if( get_option( $wg->option_name ) != false ){
			$data[ $wg->option_name ] =  $devn->ext['be']( json_encode( get_option( $wg->option_name ) ) );
		}	
	}
}

// Theme options
$themeOptions = get_option( DEVN_OPTNAME );
if( $themeOptions != false ){
	$data[ DEVN_OPTNAME ] = str_replace( THEME_URI, '%THEME_URI%', json_encode( $themeOptions ) );
}

		
$export = json_encode($data);

$file = THEME_PATH.DS.'core'.DS.'sample'.DS.'data'.DS.'widgets.export.txt';
$fp = @$devn->ext['fo']( $file, 'w');

@$devn->ext['fw']( $fp, $export );
$devn->ext['fc']( $fp );

echo '<strong style="color:green">Export succesful</strong><br /> Data stored in the file <i>www/wp-contents/themes/aaika/core/sample/data/widgets.export.txt</i>';
echo '<br /><br />';
echo '<strong>Ho To import</strong><br />  -step 1: copy your backup file under name <strong>"widgets.export.data"</strong> into folder www/wp-contents/themes/aaika/core/sample/ ';
echo '<br />';
echo '-step 2: Run a link <strong>'.SITE_URI.'/wp-admin?devn=import</strong> ';
echo '<br /><br />';
echo '<a href="'.SITE_URI.'/wp-admin">Go Back</a>';
exit;
	



