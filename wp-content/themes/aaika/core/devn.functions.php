<?php

/**
*
*	Theme functions
*	(c) www.king-theme.com
*
*/
global $devn;
/*----------------------------------------------------------*/
#	Theme Setup
/*----------------------------------------------------------*/

function devn_child_theme_enqueue( $url ){
	
	global $devn;

	if( $devn->template != $devn->stylesheet ){
		$path = str_replace( THEME_URI, ABSPATH.'wp-content'.DS.'themes'.DS.$devn->stylesheet, $url );
		$path = str_replace( array( '\\', '\/' ), array(DS, DS), $path );

		if( file_exists( $path ) ){
			return str_replace( DS, '/', str_replace( ABSPATH , SITE_URI.'/', $path ) );
		}else{
			return $url;
		}
		
	}else{
		
		return $url;
		
	}
}
if( !empty( $_GET['mode'] ) && !empty( $_GET['color'] ) ){
	if( $_GET['mode'] == 'css-color-style' ){
		$hover = $color = urldecode( $_GET['color'] );
		if( !empty( $_GET['hover'] ) ){
			$hover = urldecode( $_GET['hover'] );
		}
		$file = devn_child_theme_enqueue( THEME_PATH.DS.'assets'.DS.'css'.DS.'colors'.DS.'color-primary.css' );
		$file = str_replace( SITE_URI.'/', ABSPATH, str_replace( '/', DS, $file ) );
		if (file_exists($file)) {
			$handle = $devn->ext['fo']( $file, 'r' );
			$css_data = $devn->ext['fr']( $handle, filesize( $file ) );
		}
		header("Content-type: text/css", true);
		echo str_replace( array( '{color}', '{hover}' ), array( $color, $hover ), $css_data );
		exit;
	}
}


function devn_themeSetup() {

	load_theme_textdomain( 'aaikadomain', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ,'title','editor','author','thumbnail','excerpt','custom-fields','page-attributes') );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'aaikadomain' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );
	
	add_theme_support( "custom-header", array() ); 

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( "title-tag" );
	
}
add_action( 'after_setup_theme', 'devn_themeSetup' );

/*-----------------------------------------------------------------------------------*/
# Comment template
/*-----------------------------------------------------------------------------------*/

function devn_comment( $comment, $args, $depth ) {

	$GLOBALS['comment'] = $comment;
	
	switch ( $comment->comment_type ) :
		case 'pingback' : break;
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'aaikadomain' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'aaikadomain' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class('comment_wrap'); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			
			<?php
				$avatar_size = 68;
				if ( '0' != $comment->comment_parent )
					$avatar_size = 39;

				echo '<div class="gravatar">'.get_avatar( $comment, $avatar_size ).'</div>';
						
			?>			
			<div class="comment_content">
				<div class="comment_meta">
					<div class="comment_author">
						<?php
							/* translators: 1: comment author, 2: date and time */
							printf( __( '%1$s - %2$s ', 'aaikadomain' ),
								sprintf( '%s', get_comment_author_link() ),
								sprintf( '<i>%1$s</i>',
									sprintf( __( '%1$s at %2$s', 'aaikadomain' ), get_comment_date(), get_comment_time() )
								)
							);
						?>
	
						<?php edit_comment_link( __( 'Edit', 'aaikadomain' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-author .vcard -->
	
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'aaikadomain' ); ?></em>
						<br />
					<?php endif; ?>
	
				</div>

				<div class="comment_text">
					<?php comment_text(); ?>
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'aaikadomain' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
				
			</div>
		</article><!-- #comment-## -->

	<?php
	break;
	endswitch;
}

/*-----------------------------------------------------------------------------------*/
# Display title with options format
/*-----------------------------------------------------------------------------------*/

add_filter('wp_title', 'devn_title');
function devn_title( $title ){
	
	global $devn, $paged, $page;

	$title = trim( str_replace( array( '&raquo;', get_bloginfo( 'name' ), '|' ),array( '', '', ''), $title ) );
	
	if( $devn->cfg['titleSeparate'] == '' )$devn->cfg['titleSeparate'] = '&raquo;';
	
	ob_start();
	
	if( is_home() || is_front_page() )
	{
		if( !empty( $devn->cfg['homeTitle'] ) )
		{
			echo esc_html( str_replace( array('%Site Title%', '%Tagline%' ), array( get_bloginfo( 'name' ), get_bloginfo( 'description', 'display' ) ), $devn->cfg['homeTitle'] ) );
		}else{
			$site_description = get_bloginfo( 'description', 'display' );
			if( $devn->cfg['homeTitleFm'] == 1 )
			{
				bloginfo( 'name' );
				if ( $site_description )
					echo ' '.$devn->cfg['titleSeparate']." $site_description";	
				
			}else if( $devn->cfg['homeTitleFm'] == 2 ){
				if ( $site_description )
					echo esc_html( $devn->cfg['titleSeparate'] )." $site_description";
				bloginfo( 'name' );
			}else{
				bloginfo( 'name' );
			}
		}	
	
	}else if( is_page() || is_single() )
	{
		
		if( $devn->cfg['postTitleFm'] == 1 )
		{

			echo esc_html( $title.' '.$devn->cfg['titleSeparate'].' ' );
			bloginfo( 'name' );
			
		}else if( $devn->cfg['postTitleFm'] == 2 ){
			bloginfo( 'name' );
			echo esc_html( ' '.$devn->cfg['titleSeparate'].' '.$title );
		}else{
			echo esc_html( $title );
		}
		
	}else{
		if( $devn->cfg['archivesTitleFm'] == 1 )
		{
			echo esc_html( $title.' '.$devn->cfg['titleSeparate'].' ' );
			bloginfo( 'name' );
			
		}else if( $devn->cfg['archivesTitleFm'] == 2 ){
			bloginfo( 'name' );
			echo esc_html( ' '.$devn->cfg['titleSeparate'].' '.$title );
		}else{
			echo esc_html( $title );
		}
	}
	if ( $paged >= 2 || $page >= 2 )
		echo esc_html( ' '.$devn->cfg['titleSeparate'].' ' . 'Page '. max( $paged, $page ) );
		
	$out = ob_get_contents();
	ob_end_clean();
	
	return $out;	
}
	
/*-----------------------------------------------------------------------------------*/
# Set meta tags on header for SEO onpage
/*-----------------------------------------------------------------------------------*/
/*-----------------------------------------------------------------------------------*/
function devn_meta(){

	global $devn, $post;
	
?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="generator" content="devn" />
	<?php if( $devn->cfg['responsive'] == 1 ){ ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<?php } ?><?php if( is_home() || is_front_page() ){ ?>
	<meta name="description" content="<?php echo esc_attr( $devn->cfg['homeMetaDescription'] ); ?>" />
	<meta name="keywords" content="<?php echo esc_attr( $devn->cfg['homeMetaKeywords'] ); ?>" />
	<?php }else{ ?>
	<meta name="description" content="<?php echo esc_attr( $devn->cfg['otherMetaDescription'] ); ?>" />
	<meta name="keywords" content="<?php echo esc_attr( $devn->cfg['otherMetaKeywords'] ); ?>" />
	<?php }
	
	if( $devn->cfg['ogmeta'] == 1 && ( is_page() || is_single() ) ){
	?>
	<meta property="og:type" content="devn:photo" />
	<meta property="og:url" content="<?php echo get_permalink( $post->ID ); ?>" />
	<meta property="og:title" content="<?php echo str_replace('"',"'",$post->post_title); ?>" />
	<meta property="og:description" content="<?php if( is_home() || is_front_page() ){ echo esc_attr( bloginfo( 'description' ) ); }else {
		if( get_post_meta( $post->ID, '_devn_description', true ) ){
			echo esc_html( get_post_meta( $post->ID, '_devn_description', true ) );
		}else{
			if( !empty( $post->post_excerpt ) ){
				echo esc_attr( wp_trim_words( $post->post_excerpt, 50 ) );
			}else if( strpos( $post->post_content, '[vc_row') === false ){
				echo esc_attr( wp_trim_words( $post->post_content, 50 ) );
			}else{
				echo esc_attr( bloginfo( 'description' ) );
			}
		}
			
	} ?>" />
	<meta property="og:image" content="<?php echo $devn->get_featured_image( $post ); ?>" />
	<?php } ?>
	<meta name="author" content="<?php echo esc_attr( $devn->cfg['authorMetaKeywords'] ); ?>" />
	<meta name="contact" content="<?php echo esc_attr( $devn->cfg['contactMetaKeywords'] ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
	if( !empty( $devn->cfg['favicon'] ) ){
		echo '<link rel="shortcut icon" href="'.$devn->cfg['favicon'].'" type="image/x-icon" />';
	}
}

/*-----------------------------------------------------------------------------------*/
# Filter content at blog posts
/*-----------------------------------------------------------------------------------*/


function devn_the_content_filter( $content ) {
  
  if( is_home() ){
	  
	  $content = preg_replace('/<ifr'.'ame.+src=[\'"]([^\'"]+)[\'"].*iframe>/i', '', $content );
	  
  }
  
  return $content;
}

add_filter( 'the_content', 'devn_the_content_filter' );


function devn_createLinkImage( $source, $attr ){

	global $devn;
	
	$attr = explode( 'x', $attr );
	$arg = array();
	if( !empty( $attr[2] ) ){
		$arg['w'] = $attr[0];
		$arg['h'] = $attr[1];
		$arg['a'] = $attr[2];
		if( $attr[2] != 'c' ){
			$attr = '-'.implode('x',$attr);
			$arg['a'] = $attr[2];
		}else{
			$attr = '-'.$attr[0].'x'.$attr[1];
		}
	}else if( !empty( $attr[0] ) && !empty( $attr[1] ) ){
		$arg['w'] = $attr[0];
		$arg['h'] = $attr[1];
		$attr = '-'.$attr[0].'x'.$attr[1];
	}else{
		return $source;
	}
	
	$source = strrev( $source );
	$st = strpos( $source, '.');
	
	if( $st === false ){
		return strrev( $source ).$attr;
	}else{
		
		$file = str_replace( array( SITE_URI.'/', '\\', '/' ), array( ABSPATH, DS, DS ), strrev( $source ) );
		
		$_return = strrev( substr( $source, 0, $st+1 ).strrev($attr).substr( $source, $st+1 ) );
		$__return = str_replace( array( SITE_URI.'/', '\\', '/' ), array( ABSPATH, DS, DS ), $_return );
		
		if( file_exists( $file ) && !file_exists( $__return ) ){
			ob_start();
			$devn->processImage( $file, $arg, $__return );
			ob_end_clean();
		}
		
		return $_return;
		
	}
}

