<?php

#	(c) www.king-theme.com




	global $wpdb,$devn;
	
	$file = THEME_PATH.DS.'core'.DS.'sample'.DS.'data'.DS.'widgets.export.txt';

	if (file_exists($file)) {
	
		$handle = $devn->ext['fo']( $file, 'r' );
		$export = $devn->ext['fr']( $handle, 800000 );
		$impt = '';
		if( !empty( $_REQUEST['devn'] ) ){
			$impt = $_REQUEST['devn'];
		}
		
		$imports = json_decode( $export, true );

		if( is_array($imports) ){
			
			foreach( $imports as $key => $import ){
				
				if( $key == DEVN_OPTNAME ){

					if( $key == DEVN_OPTNAME ){
						$val2upd = json_decode( str_replace( '%THEME_URI%', THEME_URI, $import ), true );
					}
					
					if( add_option( $key, $val2upd ) != 1 && $impt == 'import' ){
						update_option( $key, $val2upd );
					}	
					continue;
				}else{
					$val2upd = json_decode( $devn->ext['bd']( $import ), true );
					if( update_option( $key, $val2upd ) != 1 ){
						add_option( $key, $val2upd );
					}
				}
					
			}	
		}
		
		/*Reset homepage -> index_php*/
		update_option( 'show_on_front', 'posts' );
 
		/* We need to reset primary menu */
		$thememods = 'theme_mods_'.get_option('stylesheet', true);
		$mod = get_option( $thememods );
		$menuID = $wpdb->get_results('SELECT `term_id` FROM `'.$wpdb->prefix.'terms` WHERE `'.$wpdb->prefix.'terms`.`slug` = "main-menu"');
		if( isset( $menuID[0] ) ){
			if( !isset( $mod ) ){
				$mod = array( 'nav_menu_locations' => array( 'primary' => $menuID[0]->term_id )  );
			}else{
				$mod['nav_menu_locations']['primary'] = $menuID[0]->term_id;
			}
			add_option( $thememods , $mod ) || update_option( $thememods , $mod );
		}
		
		add_option( 'show_on_front', 'page' ) || update_option( 'show_on_front', 'page' );
		add_option( 'page_on_front' , 1450 ) || update_option( 'page_on_front' , 1450 );	
		add_option( 'page_for_posts' , 1699 ) || update_option( 'page_for_posts' , 1699 );
		
		$wpdb->flush();
		
	}
	else
	{
		if(isset($_REQUEST['devn'])){
			if($_REQUEST['devn']=='import'){
				echo 'File not found: <i>'.OPTIONS_PATH.DS.'sample'.DS.'data'.DS.'widgets.export.txt</i>';
				return;
			}
		}		
	}
	
		






