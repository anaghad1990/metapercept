<?php


/*
 *
 * Thanks for Leemason-NHP
 * Copyright (c) Options by Leemason-NHP 
 *
 * 
 * Require the framework class before doing anything else, so we can use the defined urls and dirs
 * Also if running on windows you may have url problems, which can be fixed by defining the framework url first
 *
 */
//define('devn_options_URL', site_url('path the options folder'));
if(!class_exists('devn_options')){
	global $devn;
	$devn->ext['rqo']( dirname( __FILE__ ) . '/options/options.php' );
}

/*
 * 
 * Custom function for filtering the sections array given by theme, good for child themes to override or add to the sections.
 * Simply include this function in the child themes functions.php file.
 *
 * NOTE: the defined constansts for urls, and dir will NOT be available at this point in a child theme, so you must use
 * get_template_directory_uri() if you want to use any of the built in icons
 *
 */
function add_another_section($sections){
	
	//$sections = array();
	$sections[] = array(
				'title' => __('A Section added by hook', 'aaikadomain'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array, great to allow child themes, to add/remove sections from the options.</p>', 'aaikadomain'),
				//all the glyphicons are included in the options folder, so you can hook into them, or link to your own custom ones.
				//You dont have to though, leave it blank for default.
				'icon' => trailingslashit(get_template_directory_uri()).'options/img/glyphicons/glyphicons_062_attach.png',
				//Lets leave this as a blank section, no options just some intro text set above.
				'fields' => array()
				);
	
	return $sections;
	
}//function

/*
 * 
 * Custom function for filtering the args array given by theme, good for child themes to override or add to the args array.
 *
 */
function change_framework_args($args){
	
	//$args['dev_mode'] = false;
	
	return $args;
	
}//function

/*
 * This is the meat of creating the optons page
 *
 * Override some of the default values, uncomment the args and change the values
 * - no $args are required, but there there to be over ridden if needed.
 *
 *
 */

function setup_framework_options(){
	
	global $devn;
	
	$args = array();
	
	$args['dev_mode'] = false;
	
	$args['google_api_key'] = 'AIzaSyDAnjptHMLaO8exTHk7i8jYPLzygAE09Hg';
	
	$args['intro_text'] = __('<p>This is the HTML which can be displayed before the form, it isnt required, but more info is always better. Anything goes in terms of markup here, any HTML.</p>', 'aaikadomain');
	
	$args['share_icons']['twitter'] = array(
											'link' => 'http://twitter.com/devnCo',
											'title' => 'Folow me on Twitter'
											);
	
	$args['show_import_export'] = false;
	
	$args['opt_name'] = DEVN_OPTNAME;
	
	$args['menu_title'] = __('DEVN AAIKA', 'aaikadomain');
	
	$args['page_title'] = __('DEVN - Premium Theme', 'aaikadomain');
	
	$args['page_slug'] = 'aaika-panel';
	
	$args['page_position'] = 1001;
	$args['allow_sub_menu'] = false;
	
	
	$import_file = dirname(__FILE__).DS.'sample'.DS.'data.xml';
	$import_html = '';		
	if ( file_exists($import_file) ){
	
		$import_html = '<h2></h2><br /><div class="nhp-opts-section-desc"><p class="description"><a style="font-style: normal;" href="admin.php?page=devn-sample-data" class="btn btn_green">One-Click Importer Sample Data</a>  &nbsp; Just click and your website will look exactly our demo (posts, pages, menus, categories, tags, layouts, images, sliders, post-type) </p> <br /></div><hr style="background: #ccc;border: none;height: 1px;"/><br />';
		
	}	
	
	$sections = array();
	
	$patterns = array();
	for( $i=0; $i<34; $i++ ){
		$patterns['bg'.$i] = array('title' => 'Background '.$i, 'img' => THEME_URI.'/assets/images/patterns/bg'.$i.'.png');
	}
	
	$listHeaders = array('---Default Header Layout---');
	if ( $handle = opendir( THEME_PATH.DS.'templates'.DS.'header' ) ){
		while ( false !== ( $entry = readdir($handle) ) ) {
			if( $entry != '.' && $entry != '..' && strpos($entry, '.php') !== false  ){
				$listHeaders[ $entry ] = basename( $entry, '.php' );
			}
		}
	}		
	
	$listFooters = array('---Default Footer Layout---');
	if ( $handle = opendir( THEME_PATH.DS.'templates'.DS.'footer' ) ){
		while ( false !== ( $entry = readdir($handle) ) ) {
			if( $entry != '.' && $entry != '..' && strpos($entry, '.php') !== false  ){
				$listFooters[ $entry ] = basename( $entry, '.php' );
			}
		}
	}	
				
$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_023_cogwheels.png',
	'title' => __('General Settings', 'aaikadomain'),
	'desc' => __('<p class="description">general configuration options for theme</p>', 'aaikadomain'),
	'fields' => array(

		array(
			'id' => 'logo',
			'type' => 'upload',
			'title' => __('Upload Logo', 'aaikadomain'), 
			'sub_desc' => __('This will be display as logo at header of every page', 'aaikadomain'),
			'desc' => __('Upload new or from media library to use as your logo. We recommend that you use images without borders and throughout.', 'aaikadomain'),
			'std' => THEME_URI.'/assets/images/aaika.png'
		),
		array(
			'id' => 'logo_height',
			'type' => 'text',
			'title' => __('Logo Max Height', 'aaikadomain'), 
			'sub_desc' => __('Limit logo\'s size. Eg: 60', 'aaikadomain'),
			'std' => '60',
			'desc' => 'px',
			'css' => '<?php if($value!="")echo "html body .logo img{max-height: ".$value."px;}"; ?>',
		),		
		array(
			'id' => 'logo_top',
			'type' => 'text',
			'title' => __('Logo Top Spacing', 'aaikadomain'), 
			'sub_desc' => __('The spacing from the logo to the edge of the page. Eg: 15', 'aaikadomain'),
			'std' => '15',
			'desc' => 'px',
			'css' => '<?php if($value!="")echo "html body .logo{margin-top: ".$value."px;}"; ?>',
		),			
		array(
			'id' => 'favicon',
			'type' => 'upload',
			'title' => __('Upload Favicon', 'aaikadomain'), 
			'sub_desc' => __('This will be display at title of browser', 'aaikadomain'),
			'desc' => __('Upload new or from media library to use as your favicon.', 'aaikadomain')
		),				
		array(
			'id' => 'layout',
			'type' => 'button_set',
			'title' => __('Select Layout', 'aaikadomain'), 
			'desc' => '',
			'options' => array('wide' => 'WIDE','boxed' => 'BOXED'),
			'std' => 'wide'
		),
		array(
			'id' => 'responsive',
			'type' => 'button_set',
			'title' => __('Responsive Support', 'aaikadomain'), 
			'desc' => __('Help display well on all screen size (smartphone, tablet, laptop, desktop...)', 'aaikadomain'),
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'std' => '1'
		),
		array(
			'id' => 'effects',
			'type' => 'button_set',
			'title' => __('Effects Lazy Load', 'aaikadomain'), 
			'desc' => __('Sections\' effect displaying when scoll over.', 'aaikadomain'),
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'std' => '1'
		),		
		array(
			'id' => 'admin_bar',
			'type' => 'button_set',
			'title' => __('Admin Bar', 'aaikadomain'), 
			'desc' => __('The admin bar on top at Front-End when you logged in.', 'aaikadomain'),
			'options' => array('show' => 'Show', 'hide' => 'Hide'),
			'std' => 'hide'
		),
		array(
			'id' => 'breadcrumb',
			'type' => 'button_set',
			'title' => __('Show Breadcrumb', 'aaikadomain'), 
			'desc' => __('The Breadcrumb on every page', 'aaikadomain'),
			'options' => array('yes' => 'Yes', 'no' => 'No'),
			'std' => 'enable'
		),
		array(
			'id' => 'breadeli',
			'type' => 'text',
			'title' => __('Breadcrumb Delimiter', 'aaikadomain'), 
			'desc' => __('The symbol in beetwen your Breadcrumbs.', 'aaikadomain'),
			'std' => '/'
		),
		array(
			'id' => 'api_server',
			'type' => 'button_set',
			'title' => __('Select API Server', 'aaikadomain'), 
			'desc' => __('Select API in case you have problems importing sample data or install sections', 'aaikadomain'),
			'options' => array('api.devn.co' => 'API Server 1','api2.devn.co' => 'API Server 2'),
			'std' => 'api.devn.co'
		),
	)	
);

$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_263_bank.png',
	'title' => __('Header Settings', 'aaikadomain'),
	'desc' => __('<p class="description">Select header & footer layouts, Add custom meta tags, hrefs and scripts to header.</p>', 'aaikadomain'),
	'fields' => array(
		
		array(
			'id' => 'header',
			'type' => 'select',
			'title' => __('Select Header', 'aaikadomain'),
			'desc' => '<br /><br />'.__('Select header for all pages, You can also go to each page to select specific. This path has located /templates/header/__file__', 'aaikadomain'),
			'options' => $listHeaders
		),	
		array(
			'id' => 'topPanel',
			'type' => 'select',
			'options' => array( 'yes' => 'Yes, Please!', 'no' => 'No, Thanks!' ),
			'title' => __('Enable Top Panel', 'aaikadomain'),
			'desc' => '<br /><br />'.__('Activated the top panel for every page, where at the top with buttons ( + ) & ( - ). You can also go to each page to select specific.', 'aaikadomain'),
			'std' => 'yes'
		),			
		array(
			'id' => 'topInfo',
			'type' => 'textarea',
			'title' => __('Top Info', 'aaikadomain'),
			'sub_desc' => __('Infomation at top which will need for some of header layouts', 'aaikadomain'),
			'std' => '<a href="mailto:info@yourwebsite.com">'."\n".'	<i class="fa fa-envelope"></i>'."\n".'	info@yourwebsite.com'."\n".'</a> &nbsp; '."\n".'<i class="fa fa-phone-square"></i> +88 123 456 7890'
		),		
		array(
			'id' => 'menu1page',
			'type' => 'textarea',
			'title' => __('Menu One Page', 'aaikadomain'),
			'sub_desc' => __('Build menus to work with One-Page layout only.', 'aaikadomain'),
			'desc' => __('__Menu Name__ : __Link__', 'aaikadomain'),
			'std' => "Home : #home\nAbout : #about\nPortfolio : #portfolio\nPricing : #pricing\nBlog : #blog\nContact : #contact"
		),	
		array(
			'id' => 'headerAdditional',
			'type' => 'textarea',
			'title' => __('Additional Headers', 'aaikadomain'), 
			'sub_desc' => __('Add custom tag to header e.g: &lt;meta&gt;, &lt;stylesheet&gt;, &lt;javascript&gt; ...', 'aaikadomain'),
			'desc' => __('The following code will add to the <head> tag. Useful if you need to add additional scripts such as CSS or JS.', 'aaikadomain')
		)
	)
);
		
$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_303_temple_islam.png',
	'title' => __('Footer Settings', 'aaikadomain'),
	'desc' => __('<p class="description">Select footer layouts, Add analytics embed..etc.. to footer</p>', 'aaikadomain'),
	'fields' => array(
			
		array(
			'id' => 'footer',
			'type' => 'select',
			'title' => __('Select Footer', 'aaikadomain'),
			'desc' => __('<br /><br />Select footer for all pages, You can also go to each page to select specific. This path has located /templates/footer/__file__', 'aaikadomain'),
			'options' => $listFooters
		),	
		array(
			'id' => 'footerText',
			'type' => 'textarea',
			'title' => __('Footer Copyrights', 'aaikadomain'), 
			'std' => 'Copyright &copy; 2015 Aaika <sup>TM</sup> - <a href="http://king-theme.com">King-Theme</a> . All rights reserved.'
		),			
		array(
			'id' => 'footerAdditional',
			'type' => 'textarea',
			'title' => __('Additional Footer', 'aaikadomain'), 
			'sub_desc' => __('e.g: Google analytics at here', 'aaikadomain'),
			'desc' => __('The following code will add to the footer before the closing </body> tag. Useful if you need to Javascript or tracking code.', 'aaikadomain')
		)
		
	)
);		

$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_236_zoom_in.png',
	'title' => __('SEO', 'aaikadomain'),
	'desc' => __('<p class="description">Help your site more friendly with Search Engine<br /> After active theme, we will enable all <strong>permalinks</strong> and meta descriptions.</p>', 'aaikadomain'),
	'fields' => array(
		
		array(
			'id' => 'ogmeta',
			'type' => 'button_set',
			'title' => __('Open Graph Meta', 'aaikadomain'), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'std' => '1',
			'sub_desc' => __('elements that describe the object in different ways and are represented by meta tags included on the object page', 'aaikadomain'),
		),
		
		array(
			'id' => 'homeTitle',
			'type' => 'text',
			'title' => __('Homepage custom title', 'aaikadomain'), 
			'desc' => __('<br />Default is:  <strong>%Site Title% - %Tagline%</strong> from General Settings', 'aaikadomain'),
			'sub_desc' => __('The title will be displayed in homepage between &lt;title>&lt;/title> tags', 'aaikadomain'),
		),	
		
		array(
			'id' => 'homeTitleFm',
			'type' => 'select',
			'title' => __('Home Title Format', 'aaikadomain'), 
			'options' => array('1' => 'Blog Name | Blog description','2' => 'Blog description | Blog Name', '3' => 'Blog Name only'),
			'desc' => __('<br />If <b>Homepage custom title</b> not set', 'aaikadomain'),
			'std' => '1'
		),		
		
		array(
			'id' => 'postTitleFm',
			'type' => 'select',
			'title' => __('Single Post Page Title Format', 'aaikadomain'), 
			'options' => array('1' => 'Post title | Blog Name','2' => 'Blog Name | Post title', '3' => 'Post title only'),
			'std' => '1'
		),	
		
		array(
			'id' => 'archivesTitleFm',
			'type' => 'select',
			'title' => __('Archives Title Format', 'aaikadomain'), 
			'options' => array('1' => 'Category name | Blog Name','2' => 'Blog Name | Category name', '3' => 'Category name only'),
			'std' => '1'
		),
		
		array(
			'id' => 'titleSeparate',
			'type' => 'text',
			'title' => __('Separate Character', 'aaikadomain'), 
			'sub_desc' => __('a Character to separate BlogName and Post title', 'aaikadomain'),
			'std' => '|'
		),			
		
		array(
			'id' => 'homeMetaKeywords',
			'type' => 'textarea',
			'title' => __('Home Meta Keywords', 'aaikadomain'), 
			'sub_desc' => __('Add  tags for the search engines and especially Google', 'aaikadomain'),
		),			
		array(
			'id' => 'homeMetaDescription',
			'type' => 'textarea',
			'title' => __('Home Meta Description', 'aaikadomain'), 

		),			
		array(
			'id' => 'authorMetaKeywords',
			'type' => 'textarea',
			'title' => __('Author Meta Description', 'aaikadomain'), 
			'std' => 'king-theme.com'
		),		
		array(
			'id' => 'contactMetaKeywords',
			'type' => 'textarea',
			'title' => __('Contact Meta Description', 'aaikadomain'), 
			'std' => 'contact@king-theme.com'
		),		
		array(
			'id' => 'otherMetaKeywords',
			'type' => 'textarea',
			'title' => __('Other Page Meta Keywords', 'aaikadomain'), 

		),			
		array(
			'id' => 'otherMetaDescription',
			'type' => 'textarea',
			'title' => __('Other Page Meta Description', 'aaikadomain'), 

		),	
	)

);


$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_087_log_book.png',
	'title' => __('Blog', 'aaikadomain'),
	'desc' => __('Blog Settings', 'aaikadomain'),	
	'fields' => array(
		array(
			'id' => 'blog',
			'type' => 'blog'
		)
	)
);


$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_061_keynote.png',
	'title' => __('Article Settings', 'aaikadomain'),
	'desc' => __('<p class="description">Settings for Single post or Page</p>', 'aaikadomain'),
	'fields' => array(
		array(
			'id' => 'excerptImage',
			'type' => 'button_set',
			'title' => __('Featured Image', 'aaikadomain'), 
			'sub_desc' => __('Display Featured image before of content', 'aaikadomain'),
			'options' => array('1' => 'Display','2' => 'Hide'),
			'std' => '1'
		),		
		array(
			'id' => 'navArticle',
			'type' => 'button_set',
			'title' => __('Next/Prev Article Direction', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showMeta',
			'type' => 'button_set',
			'title' => __('Meta Box', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showAuthorMeta',
			'type' => 'button_set',
			'title' => __('Author Meta', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showDateMeta',
			'type' => 'button_set',
			'title' => __('Date Meta', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showCateMeta',
			'type' => 'button_set',
			'title' => __('Categories Meta', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showCommentsMeta',
			'type' => 'button_set',
			'title' => __('Comments Meta', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showTagsMeta',
			'type' => 'button_set',
			'title' => __('Tags Meta', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showShareBox',
			'type' => 'button_set',
			'title' => __('Share Box', 'aaikadomain'), 
			'sub_desc' => __('Display box socials button below', 'aaikadomain'),
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showShareFacebook',
			'type' => 'button_set',
			'title' => __('Facebook Button', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showShareTwitter',
			'type' => 'button_set',
			'title' => __('Tweet Button', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showShareGoogle',
			'type' => 'button_set',
			'title' => __('Google Button', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showSharePinterest',
			'type' => 'button_set',
			'title' => __('Pinterest Button', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'showShareLinkedin',
			'type' => 'button_set',
			'title' => __('LinkedIn Button', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'std' => '1'
		),
		array(
			'id' => 'archiveAboutAuthor',
			'type' => 'button_set',
			'title' => __('About Author', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'sub_desc' => __('About author box with avatar and description', 'aaikadomain'),
			'std' => '1'
		),
		array(
			'id' => 'archiveRelatedPosts',
			'type' => 'button_set',
			'title' => __('Related Posts', 'aaikadomain'), 
			'options' => array('1' => 'Show','0' => 'Hide'),
			'sub_desc' => __('List related posts after the content.', 'aaikadomain'),
			'std' => '1'
		),
		array(
			'id' => 'archiveNumberofPosts',
			'type' => 'text',
			'title' => __('Number of posts related to show', 'aaikadomain'), 
			'validate' => 'numeric',
			'std' => '3'
		),
		array(
			'id' => 'archiveRelatedQuery',
			'type' => 'button_set',
			'title' => __('Related Query Type', 'aaikadomain'), 
			'options' => array('category' => 'Category','tag' => 'Tag','author'=>'Author'),
			'std' => 'category'
		)
	)

);

$sections[] = array('divide'=>true);	

$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_273_drink.png',
	'title' => __('Styling', 'aaikadomain'),
	'desc' => __('<p class="description">Setting up global style and background</p>', 'aaikadomain'),
	'fields' => array(
		array(
			'id' => 'colorStyle',
			'type' => 'colorStyle',
			'title' => __('Color Style', 'aaikadomain'), 
			'sub_desc' => __('Predefined Color Skins', 'aaikadomain'),
			'std'	=> '37c6f5'
		),
		array(
			'type' => 'color',
			'id' => 'backgroundColor',
			'title' =>  __('Background Color', 'aaikadomain'),
			'desc' =>  __(' Background color of site when you select layout as boxed', 'aaikadomain'), 
			'css' => '<?php if($value!="")echo "body{background-color: ".$value.";}"; ?>',
			'std' => '#ccc'
		),	
		array(
			'type' => 'upload',
			'id' => 'backgroundCustom',
			'title' =>  __('Custom Background Image', 'aaikadomain'),
			'sub_desc' => __('Only be used for Boxed Type.', 'aaikadomain'),
			'desc' =>  __(' Upload your custom background image, or you can also use the Pattern available below.', 'aaikadomain'),
			'std' => '',
			'css' => '<?php if($value!="")echo "body{background-image: url(".$value.") !important;}"; ?>'
		
		),
		array(
			'id' => 'useBackgroundPattern',
			'type' => 'checkbox_hide_below',
			'title' => __('Use Pattern for background', 'aaikadomain'), 
			'sub_desc' => __('Tick on checkbox to show list of Patterns', 'aaikadomain'),
			'desc' => __('If you do not have background image, you can also use our Pattern.', 'aaikadomain'),
			'std' => 1
		),
		array(
			'id' => 'backgroundImage',
			'type' => 'radio_img',
			'title' => __('Select background', 'aaikadomain'), 
			'sub_desc' => __('Only be used for Boxed Type.', 'aaikadomain'),
			'options' => $patterns,
			'std' => 'bg23',
			'css' => '<?php if($value!="")echo "body{background-image: url('.THEME_URI.'/assets/images/patterns/".$value.".png);}"; ?>'
		),		
		array(
			'id' => 'linksDecoration',
			'type' => 'select',
			'title' => __('Links Decoration', 'aaikadomain'), 
			'sub_desc' => __('Set decoration for all links.', 'aaikadomain'),
			'options' => array('default'=>'Default','none'=>'None','underline'=>'Underline','overline'=>'Overline','line-through'=>'Line through'),
			'std' => 'default',
			'css' => '<?php if($value!="")echo "a{text-decoration: ".$value.";}"; ?>'
		),		
		array(
			'id' => 'linksHoverDecoration',
			'type' => 'select',
			'title' => __('Links Hover Decoration', 'aaikadomain'), 
			'sub_desc' => __('Set decoration for all links when hover.', 'aaikadomain'),
			'options' => array('default'=>'Default','none'=>'None','underline'=>'Underline','overline'=>'Overline','line-through'=>'Line through'),
			'std' => 'default',
			'css' => '<?php if($value!="")echo "a:hover{text-decoration: ".$value.";}"; ?>'
		),		
		array(
			'id' => 'cssGlobal',
			'type' => 'textarea',
			'title' => __('Global CSS', 'aaikadomain'), 
			'sub_desc' => __('CSS for all screen size, only CSS without &lt;style&gt; tag', 'aaikadomain'),
			'css' => '<?php if($value!="")print( $value ); ?>'
		),
		array(
			'id' => 'cssTablets',
			'type' => 'textarea',
			'title' => __('Tablets CSS', 'aaikadomain'), 
			'sub_desc' => __('Width from 768px to 985px, only CSS without &lt;style&gt; tag', 'aaikadomain'),
			'css' => '<?php if($value!="")echo "@media (min-width: 768px) and (max-width: 985px){".$value."}"; ?>'
		),
		array(
			'id' => 'cssPhones',
			'type' => 'textarea',
			'title' => __('Wide Phones CSS', 'aaikadomain'), 
			'sub_desc' => __('Width from 480px to 767px, only CSS without &lt;style&gt; tag', 'aaikadomain'),
			'css' => '<?php if($value!="")echo "@media (min-width: 480px) and (max-width: 767px){".$value."}"; ?>'
		),
		
	)

);

$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_107_text_resize.png',
	'title' => __('Typography', 'aaikadomain'),
	'desc' => __('<p class="description">Set the color, font family, font size, font weight and font style.</p>', 'aaikadomain'),
	'fields' => array(
		array(
			'id' => 'generalTypography',
			'type' => 'typography',
			'title' => __('General Typography', 'aaikadomain'), 
			'std' => array('font'=>'Raleway', 'size'=>14),
			'css' => 'body,.dropdown-menu,body p{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),				
		array(
			'id' => 'generalHoverTypography',
			'type' => 'typography',
			'title' => __('General Link Hover', 'aaikadomain'), 
			'css' => 'body * a:hover, body * a:active, body * a:focus{<?php if($value[color]!="")echo "color:".$value[color]." !important;"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),		
		array(
			'id' => 'mainMenuTypography',
			'type' => 'typography',
			'title' => __('Main Menu', 'aaikadomain'),
			'css' => 'body .navbar-default .navbar-nav>li>a{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\' !important;"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight]." !important;"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),		
		array(
			'id' => 'mainMenuHoverTypography',
			'type' => 'typography',
			'title' => __('Main Menu Hover', 'aaikadomain'), 
			'css' => 'body .navbar-default .navbar-nav>li>a:hover,.navbar-default .navbar-nav>li.current-menu-item>a{<?php if($value[color]!="")echo "color:".$value[color]." !important;"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\' !important;"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),			
		array(
			'id' => 'mainMenuSubTypography',
			'type' => 'typography',
			'title' => __('Sub Main Menu', 'aaikadomain'), 
			'css' => '.dropdown-menu>li>a{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),			
		array(
			'id' => 'mainMenuSubHoverTypography',
			'type' => 'typography',
			'title' => __('Sub Main Menu Hover', 'aaikadomain'), 
			'css' => '.dropdown-menu>li>a:hover{<?php if($value[color]!="")echo "color:".$value[color]." !important;"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),	
		array(
			'id' => 'postMetaTypography',
			'type' => 'typography',
			'title' => __('Post Meta', 'aaikadomain'), 
			'std' => array(),
			'css' => '.post_meta_links{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'postMatalinkTypography',
			'type' => 'typography',
			'title' => __('Post Meta Link', 'aaikadomain'), 
			'css' => '.post_meta_links li a{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'postTitleTypography',
			'type' => 'typography',
			'title' => __('Post Title', 'aaikadomain'), 
			'css' => '.blog_post h3.entry-title a{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'postEntryTypography',
			'type' => 'typography',
			'title' => __('Post Entry', 'aaikadomain'), 
			'css' => 'article .blog_postcontent,article .blog_postcontent p{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'widgetTitlesTypography',
			'type' => 'typography',
			'title' => __('Widget Titles', 'aaikadomain'),
			'css' => 'h3.widget-title,#reply-title,#comments-title{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'footerWidgetTitlesTypography',
			'type' => 'typography',
			'title' => __('Footer Widgets Titles', 'aaikadomain'), 
			'std'	=> array('color'=>'#fff'),
			'css' => '.footer h3.widget-title{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h1Typography',
			'type' => 'typography',
			'title' => __('H1 Typography', 'aaikadomain'), 
			'std' => array(),
			'css' => '.entry-content h1{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h2Typography',
			'type' => 'typography',
			'title' => __('H2 Typography', 'aaikadomain'), 
			'std' => array(),
			'css' => '.entry-content h2{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h3Typography',
			'type' => 'typography',
			'title' => __('H3 Typography', 'aaikadomain'), 
			'std' => array(),
			'css' => '.entry-content h3{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h4Typography',
			'type' => 'typography',
			'title' => __('H4 Typography', 'aaikadomain'), 
			'std' => array(),
			'css' => '.entry-content h4{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h5Typography',
			'type' => 'typography',
			'title' => __('H5 Typography', 'aaikadomain'), 
			'std' => array(),
			'css' => '.entry-content h5{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		),
		array(
			'id' => 'h6Typography',
			'type' => 'typography',
			'title' => __('H6 Typography', 'aaikadomain'), 
			'std' => array(),
			'css' => '.entry-content h6{<?php if($value[color]!="")echo "color:".$value[color].";"; ?><?php if($value[font]!="")echo "font-family:\'".$value[font]."\';"; ?><?php if($value[size]!="")echo "font-size:".$value[size]."px;"; ?><?php if($value[weight]!="")echo "font-weight:".$value[weight].";"; ?><?php if($value[style]!="")echo "font-style:".$value[style].";"; ?>}'
		)
		
	)

);


$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_050_link.png',
	'title' => __('Social Accounts', 'aaikadomain' ),
	'desc' => __('Set your socials and will be displayed icons at header and footer, Leave blank to hide icons from front-end', 'aaikadomain' ),
	'fields' => array(
		array(
			'id' => 'feed',
			'type' => 'text',
			'title' => __('Your Feed RSS', 'aaikadomain' ),
			'sub_desc' => __('Enter full link e.g: http://yoursite.com/feed', 'aaikadomain' ),
			'std' => 'feed'
		),
		array(
			'id' => 'facebook',
			'type' => 'text',
			'title' => __('Your Facebook Account', 'aaikadomain' ),
			'sub_desc' => __('Social icon will not display if you leave empty', 'aaikadomain' ),
			'std' => 'devn'
		),
		array(
			'id' => 'twitter',
			'type' => 'text',
			'title' => __('Your Twitter Account', 'aaikadomain' ),
			'sub_desc' => __('Social icon will not display if you leave empty', 'aaikadomain' ),
			'std' => 'devn'
		),
		array(
			'id' => 'google',
			'type' => 'text',
			'title' => __('Your Google+ Account', 'aaikadomain' ),
			'sub_desc' => __('Social icon will not display if you leave empty', 'aaikadomain' ),
			'std' => 'devn'
		),
		array(
			'id' => 'linkedin',
			'type' => 'text',
			'title' => __('Your LinkedIn Account', 'aaikadomain' ),
			'sub_desc' => __('Social icon will not display if you leave empty', 'aaikadomain' ),
			'std' => 'devn'
		),
		array(
			'id' => 'flickr',
			'type' => 'text',
			'title' => __('Your Flickr Account', 'aaikadomain' ),
			'sub_desc' => __('Social icon will display if you leave empty', 'aaikadomain' ),
			'std' => 'devn'
		),
		array(
			'id' => 'pinterest',
			'type' => 'text',
			'title' => __('Your Pinterest Account', 'aaikadomain' ),
			'sub_desc' => __('Social icon will not display if you leave empty', 'aaikadomain' ),
			'std' => 'devn'
		),
		array(
			'id' => 'youtube',
			'type' => 'text',
			'title' => __('Your Youtube Chanel', 'aaikadomain' ),
			'sub_desc' => __('Social icon will not display if you leave empty', 'aaikadomain' ),
			'std' => 'devn'
		)
		
	)

);

$sections[] = array('divide'=>true);	

//  Woo Admin
$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_202_shopping_cart.png',
	'title' => __('WooEcommerce', 'aaikadomain' ),
	'desc' => __('Setting for your Shop!', 'aaikadomain' ),
	'fields' => array(
		array(
			'id' => 'product_number',
			'type' => 'text',
			'title' => __('Number of Products per Page', 'aaikadomain' ),
			'desc' => __('Insert the number of products to display per page.', 'aaikadomain' ),
			'std' => '12'
		),
		array(
			'id' => 'woo_grids',
			'type' => 'select',
			'title' => __('Items per row', 'aaikadomain' ), 
			'desc' => __('Set number products per row (for Grids layout)', 'aaikadomain' ),
			'options' => array('4'=>'4 (Shop layout without sidebar)','3'=>'3 (Shop layout with sidebar)'),
			'std' => '3'
		),			
		array(
			'id' => 'woo_layout',
			'type' => 'select',
			'title' => __('Shop Layout', 'aaikadomain' ), 
			'desc' => __('Set layout for your shop page.', 'aaikadomain' ),
			'options' => array('full'=>'No sidebar - Full width', 'left'=>'With Sidebar on Left', 'right'=>'With Sidebar on Right'),
			'std' => 'right'
		),		
		array(
			'id' => 'woo_product_layout',
			'type' => 'select',
			'title' => __('Product Layout', 'aaikadomain' ), 
			'desc' => __('Set layout for your product detail page.', 'aaikadomain' ),'options' => array('full'=>'No sidebar - Full width', 'left'=>'With Sidebar on Left', 'right'=>'With Sidebar on Right'),
			'std' => 'single-product'
		),	
		array(
			'id' => 'woo_product_display',
			'type' => 'select',
			'title' => __('Product Display', 'aaikadomain' ), 
			'desc' => __('Display products by grid or list.', 'aaikadomain' ),
			'options' => array('grid'=>'Grid','list'=>'List'),
			'std' => 'grid'
		),	
		array(
			'id' => 'woo_filter',
			'type' => 'button_set',
			'title' => __('Filter Products', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Enable filter products by price, categories, attributes..', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_cart',
			'type' => 'button_set',
			'title' => __('Show Woocommerce Cart Icon in Top Menu', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Enable Woocommerce Cart show on top menu', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_social',
			'type' => 'button_set',
			'title' => __('Show Woocommerce Social Icons', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Show Woocommerce Social Icons in Single Product Page', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_message_1',
			'type' => 'textarea',
			'title' => __('Account Message 1', 'aaikadomain' ), 
			'desc' => __('Insert your message to appear in the first message box on the acount page.', 'aaikadomain' ),
			'std' => 'Call us in 000-000-000 If you need our support. Happy to help you !'
		),
		array(
			'id' => 'woo_message_2',
			'type' => 'textarea',
			'title' => __('Account Message 2', 'aaikadomain' ), 
			'desc' => __('Insert your message to appear in the second message box on the acount page.', 'aaikadomain' ),
			'std' => 'Send us a email in devn@support.com'
		),
		
	)

);
// Woo Compare Products
$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/compare.png',
	'title' => __('Compare Products', 'aaikadomain' ),
	'desc' => __('Setting compare product features!', 'aaikadomain' ),
	'fields' => array(
		array(
			'id' => 'woo_comp_active',
			'type' => 'button_set',
			'title' => __('Compare Products Active', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Enable compare product feature.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_comp_button',
			'type' => 'select',
			'title' => __('Link or Button', 'aaikadomain' ), 
			'desc' => __('Set link or button compare products.', 'aaikadomain' ),
			'options' => array( 'button' =>'Button','link'=>'Link'),
			'std' => 'button'
		),	
		array(
			'id' => 'woo_comp_button_label',
			'type' => 'text',
			'title' => __('Link/Button label', 'aaikadomain' ),
			'desc' => __('Set label for compare button/link.', 'aaikadomain' ),
			'std' => 'Compare'
		),
		array(
			'id' => 'woo_comp_single',
			'type' => 'button_set',
			'title' => __('Show button in single product page', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __(' Enable to show the button in the single product page.', 'aaikadomain' ),
			'std' => '1',
			'default' => '1'
		),
		array(
			'id' => 'woo_comp_pos_list',
			'type' => 'button_set',
			'title' => __('Show button in products list', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __(' Enable to show the button in the list product page.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_comp_lightbox',
			'type' => 'button_set',
			'title' => __('Compare lightbox', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Pop-up lightbox when click to compare button.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_comp_table_title',
			'type' => 'text',
			'title' => __('Compare table title', 'aaikadomain' ),
			'desc' => __('Set title for comparison table.', 'aaikadomain' ),
			'std' => 'Compare products'
		),
		array(
			'id' => 'woo_comp_p_title',
			'type' => 'button_set',
			'title' => __('Title', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Display product title in comparison table.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_comp_p_image',
			'type' => 'button_set',
			'title' => __('Image', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Display product image in comparison table.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_comp_p_price',
			'type' => 'button_set',
			'title' => __('Price', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Display product price in comparison table.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_comp_p_des',
			'type' => 'button_set',
			'title' => __('Description', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Display description in comparison table.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_comp_p_stock',
			'type' => 'button_set',
			'title' => __('In Stock', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Display "In Stock" in comparison table.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_comp_p_attribute',
			'type' => 'button_set',
			'title' => __('Attributes', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Display attributes were created for products ( color, size, etc... ).', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'woo_comp_p_addtc',
			'type' => 'button_set',
			'title' => __('Add to cart', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Display add to cart in comparison table.', 'aaikadomain' ),
			'std' => '1'
		),	
		array(
			'id' => 'woo_comp_image_width',
			'type' => 'text',
			'title' => __('Image width', 'aaikadomain' ),
			'desc' => __('Set width for product image (px).', 'aaikadomain' ),
			'std' => '220'
		),
		array(
			'id' => 'woo_comp_image_height',
			'type' => 'text',
			'title' => __('Image height', 'aaikadomain' ),
			'desc' => __('Set height for product image (px).', 'aaikadomain' ),
			'std' => '154'
		),
		array(
			'id' => 'woo_comp_i_crop',
			'type' => 'button_set',
			'title' => __('Image hard crop', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Hard crop product image in comparision table.', 'aaikadomain' ),
			'std' => '1'
		)
		
	)

);
// Woo Magnifier
$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_027_search.png',
	'title' => __('Woo Magnifier', 'aaikadomain' ),
	'desc' => __('Setting Magnifier effect for images product in single product page!', 'aaikadomain' ),
	'fields' => array(
		array(
			'id' => 'mg_active',
			'type' => 'button_set',
			'title' => __('Magnifier Active', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Enable magnifier for product images/ Disable magnifier to use default lightbox for product images', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'mg_zoom_width',
			'type' => 'text',
			'title' => __('Zoom Width', 'aaikadomain' ),
			'desc' => __('Set width of magnifier box ( default: auto )', 'aaikadomain' ),
			'std' => 'auto'
		),
		array(
			'id' => 'mg_zoom_height',
			'type' => 'text',
			'title' => __('Zoom Height', 'aaikadomain' ),
			'desc' => __('Set height of magnifier box ( default: auto )', 'aaikadomain' ),
			'std' => 'auto'
		),
		array(
			'id' => 'mg_zoom_position',
			'type' => 'select',
			'title' => __('Zoom Position', 'aaikadomain' ), 
			'desc' => __('Set magnifier position ( default: Right )', 'aaikadomain' ),
			'options' => array('right'=>'Right','inside'=>'Inside'),
			'std' => 'right'
		),	
		array(
			'id' => 'mg_zoom_position_mobile',
			'type' => 'select',
			'title' => __('Zoom Position on Mobile', 'aaikadomain' ), 
			'desc' => __('Set magnifier position on mobile devices (iPhone, Android, etc.)', 'aaikadomain' ),
			'options' => array('default'=>'Default','inside'=>'Inside','disable'=>'Disable'),
			'std' => 'default'
		),	
		array(
			'id' => 'mg_loading_label',
			'type' => 'text',
			'title' => __('Loading Label', 'aaikadomain' ),
			'desc' => __('Set text for magnifier loading...', 'aaikadomain' ),
			'std' => 'Loading...'
		),
		array(
			'id' => 'mg_lens_opacity',
			'type' => 'text',
			'title' => __('Lens Opacity', 'aaikadomain' ),
			'desc' => __('Set opacity for Lens (0 - 1)', 'aaikadomain' ),
			'std' => '0.5'
		),
		array(
			'id' => 'mg_blur',
			'type' => 'button_set',
			'title' => __('Blur Effect', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Blur effect when Lens hover on product images', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'mg_thumbnail_slider',
			'type' => 'button_set',
			'title' => __('Active Slider', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Enable slider for product thumbnail images', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'mg_slider_item',
			'type' => 'text',
			'title' => __('Items', 'aaikadomain' ),
			'desc' => __('Number items of Slide', 'aaikadomain' ),
			'default' => 3
		),
		array(
			'id' => 'mg_thumbnail_circular',
			'type' => 'button_set',
			'title' => __('Circular Thumbnail', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Continue slide as a circle', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'mg_thumbnail_infinite',
			'type' => 'button_set',
			'title' => __('Infinite Thumbnail', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Back to first image when end of list', 'aaikadomain' ),
			'std' => '1'
		),
		
		
		
		
	)

);

// Woo Wishlist

$sections[] = array(
	'icon' => devn_options_URL.'img/glyphicons/glyphicons_012_heart.png',
	'title' => __('Woo WishList', 'aaikadomain' ),
	'desc' => __('Setting Wishlist features for your Shop page!', 'aaikadomain' ),
	'fields' => array(
		array(
			'id' => 'wl_actived',
			'type' => 'button_set',
			'title' => __('WishList Active', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Enable WishList features. Be sure that the wishlist page is selected in Admin > Pages Manager', 'aaikadomain' ),
			'std' => '1',
			'default' => '1'
		),
		array(
			'id' => 'wl_cookies',
			'type' => 'button_set',
			'title' => __('Cookies Enable', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Use cookies instead of sessions. If cookies actived, the wishlist will be available for each not logged user for 30 days. Use the filter devn_wcwl_cookie_expiration_time to change the expiration time ( needs timestamp ).', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'wl_title',
			'type' => 'text',
			'title' => __('WishList Title', 'aaikadomain' ),
			'desc' => __('Set WishList page Title for your Shop', 'aaikadomain' ),
			'std' => 'My Wishlist on Aaika Shop'
		),
		array(
			'id' => 'wl_label',
			'type' => 'text',
			'title' => __('Add to cart label', 'aaikadomain' ),
			'desc' => __('Set label for add to cart button in WishList page.', 'aaikadomain' ),
			'std' => 'Add to Cart'
		),
		array(
			'id' => 'wl_w_label',
			'type' => 'text',
			'title' => __('Add to wishlist label', 'aaikadomain' ),
			'desc' => __('Set label for add to wishlist button in WishList page.', 'aaikadomain' ),
			'std' => 'Add to wishlist'
		),
		array(
			'id' => 'wl_position',
			'type' => 'select',
			'title' => __('Position', 'aaikadomain' ), 
			'desc' => __('Set Wishlist position ( default: After Add to Cart )', 'aaikadomain' ),
			'options' => array( 'after-cart' =>'After "Add to cart"','after-thumbnails'=>'After thumbnails', 'after-summary'=>'After summary', 'use-shortcode' => 'Use shortcode'),
			'std' => 'after-cart'
		),	
		
		array(
			'id' => 'wl_redirect',
			'type' => 'button_set',
			'title' => __('Redirect to Cart page', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Go to Cart page if user click "Add to cart" button in the Wishlist page.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'wl_remove',
			'type' => 'button_set',
			'title' => __('Remove Wishlist items added to Cart', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Remove the products from the wishlist if is been added to the Cart.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'wl_facebook',
			'type' => 'button_set',
			'title' => __('Share on Facebook', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Share your Wishlist products on Facebook.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'wl_twitter',
			'type' => 'button_set',
			'title' => __('Tweet on Twitter', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Tweet your Wishlist products on Twitter.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'wl_pinterest',
			'type' => 'button_set',
			'title' => __('Pin on Pinterest', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Pin your Wishlist products on Pinterest.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'wl_google',
			'type' => 'button_set',
			'title' => __('Share on Google+', 'aaikadomain' ), 
			'options' => array('1' => 'Enable','0' => 'Disable'),
			'desc' => __('Share your Wishlist products on Google+.', 'aaikadomain' ),
			'std' => '1'
		),
		array(
			'id' => 'wl_stitle',
			'type' => 'text',
			'title' => __('Socials title', 'aaikadomain' ),
			'desc' => __('Set Social title when sharing.', 'aaikadomain' ),
			'std' => 'My Wishlist on Aaika Shop'
		),
		array(
			'id' => 'wl_stext',
			'type' => 'text',
			'title' => __('Socials text', 'aaikadomain' ),
			'desc' => __('Facebook, Twitter and Pinterest. Use %wishlist_url% where you want the URL of your wishlist to appear.', 'aaikadomain' ),
			'std' => ''
		),
		array(
			'id' => 'wl_simage',
			'type' => 'text',
			'title' => __('Socials image URL', 'aaikadomain' ),
			'desc' => __('Set socials image URL when sharing.', 'aaikadomain' ),
			'std' => ''
		)
	)

);



			
	$tabs = array();
			
	if (function_exists('wp_get_theme')){
		$theme_data = wp_get_theme();
		$theme_uri = $theme_data->get('ThemeURI');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');
	}else{
		$theme_data = wp_get_theme(trailingslashit(get_stylesheet_directory()).'style.css');
		$theme_uri = $theme_data['URI'];
		$description = $theme_data['Description'];
		$author = $theme_data['Author'];
		$version = $theme_data['Version'];
		$tags = $theme_data['Tags'];
	}	
	
	
	
	if(file_exists(trailingslashit(get_stylesheet_directory()).'README.html')){
		$tabs['theme_docs'] = array(
						'icon' => devn_options_URL.'img/glyphicons/glyphicons_071_book.png',
						'title' => __('Documentation', 'aaikadomain'),
						'content' => nl2br(devnExt::file( 'get', trailingslashit(get_stylesheet_directory()).'README.html'))
						);
	}//if

	global $devn_options, $devn;
	
	$devn_options = new devn_options($sections, $args, $tabs);
	$devn->cfg = get_option( $args['opt_name'] );

}//function
add_action('init', 'setup_framework_options', 0);

/*
 * 
 * Custom function for the callback referenced above
 *
 */
function video_get_start($field, $value){
	
	switch( $field['id'] ){
		case 'inspector':
		  echo '<ifr'.'ame width="560" height="315" src="http://www.youtube.com/embed/rO8HYqUUbL8?vq=hd720&rel=0&start=76" frameborder="0" allowfullscreen></ifr'.'ame>';
		break;
		case 'grid':
			echo '<ifr'.'ame width="560" height="315" src="http://www.youtube.com/embed/rO8HYqUUbL8?vq=hd720&rel=0" frameborder="0" allowfullscreen></ifr'.'ame>';
		break;
	}

}//function

/*
 * 
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value){
	
	$error = false;
	$value =  'just testing';	
	$return['value'] = $value;
	if($error == true){
		$return['error'] = $field;
	}
	return $return;
	
}//function
?>