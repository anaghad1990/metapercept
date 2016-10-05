<?php

class devn_shortcodes {
	
	static $youTubePlayerReady = false;
	static $elements;
	
	public static function register() {
	
		global $devn;
		
		include dirname(__FILE__).DS.'assets.php';
		include dirname(__FILE__).DS.'tools.php';
		include dirname(__FILE__).DS.'elements.php';
		
		self::$elements = new devn_elements();
		
		foreach( array(
			'faq',
			'team',
			'work',
			'testimonials',
			'php',
			'piechart',
			'pricing',
			'progress',
			'flex_sliders',
			'fslider',
			'videobg',
			'divider',
			'titles',
			'flip_clients',
			'elements',
			'posts',
			'cf7'
		) as $name ){
			$devn->ext['asc']( $name, array( __CLASS__, $name ) );
		}
	}
	
	public static function faq( $atts = null, $content = null ) {

		$error = null;
		$atts = shortcode_atts( array( 'amount' => 20 ), $atts, 'faq' );
		
		global $wpdb;
		
		$faqs = $wpdb->get_results("SELECT * FROM `".$wpdb->posts."` WHERE `post_type`='faq' AND `post_status`='publish' LIMIT ".intval($atts['amount']));
		
		$out = '[vc_accordion collapsible="" disable_keyboard="" style="1" icon="icon-arrow"]';
		if( count( $faqs ) ){
			foreach( $faqs as $faq ){
				$title = $faq->post_title;
				$title = str_replace( array('&','"'), array('&amp; ','&quot;'), $title );
				$out .= '[vc_accordion_tab title="'.$title.'"]';
				$content = $faq->post_content;
				$content = str_replace( array('[',']'), array('{','}'), $content );
				$out .= $content.'[/vc_accordion_tab]';
			}
		}
		$out .= '[/vc_accordion]';
		
		return do_shortcode( $out );	
			
	}
	
	public static function team( $atts = null, $content = null ) {

		$error = null;

		$atts = shortcode_atts( array(
				'template'            => 'our-team.php',
				'id'                  => false,
				'items'     	 	  => get_option( 'posts_per_page' ),
				'style'     	 	  => 'grids',
				'post_type'           => 'our-team',
				'taxonomy'            => 'category',
				'words'       		  => 30,
				'category'            => false,
				'order'               => 'DESC',
				'orderby'             => 'date',
				'post_parent'         => false,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 'no'
			), $atts, 'team' );

		$original_atts = $atts;

		$author = '';
		$id = $atts['id'];
		$ignore_sticky_posts = ( bool ) ( $atts['ignore_sticky_posts'] === 'yes' ) ? true : false;
		$meta_key = '';
		$offset = '';
		$order = sanitize_key( $atts['order'] );
		$orderby = sanitize_key( $atts['orderby'] );
		$post_parent = $atts['post_parent'];
		$post_status = $atts['post_status'];
		$style = $atts['style'];
		$post_type = sanitize_text_field( $atts['post_type'] );
		$posts_per_page = intval( $atts['items'] );
		$items = $posts_per_page;
		$tag = '';
		$tax_operator = '';
		$tax_term = sanitize_text_field( $atts['category'] );
		$taxonomy = sanitize_key( $atts['taxonomy'] );
		$words = sanitize_key( $atts['words'] );

		$args = array(
			'category_name'  => '',
			'order'          => $order,
			'orderby'        => $orderby,
			'post_type'      => explode( ',', $post_type ),
			'posts_per_page' => $posts_per_page
		);

		if ( $ignore_sticky_posts ) $args['ignore_sticky_posts'] = true;

		if ( !empty( $meta_key ) ) $args['meta_key'] = $meta_key;

		if ( $id ) {
			$posts_in = array_map( 'intval', explode( ',', $id ) );
			$args['post__in'] = $posts_in;
		}

		$post_status = explode( ', ', $post_status );
		$validated = array();
		$available = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
		foreach ( $post_status as $unvalidated ) {
			if ( in_array( $unvalidated, $available ) ) $validated[] = $unvalidated;
		}
		if ( !empty( $validated ) ) $args['post_status'] = $validated;

		if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {

			$tax_term = explode( ',', $tax_term );
			// Validate operator
			if ( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ) $tax_operator = 'IN';
			$tax_args = array( 'tax_query' => array( array(
						'taxonomy' => $taxonomy,
						'field' => ( is_numeric( $tax_term[0] ) ) ? 'id' : 'slug',
						'terms' => $tax_term,
						'operator' => $tax_operator ) ) );
			// Check for multiple taxonomy queries
			$count = 2;
			$more_tax_queries = false;
			while ( isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) &&
				isset( $original_atts['tax_' . $count . '_term'] ) &&
				!empty( $original_atts['tax_' . $count . '_term'] ) ) {
				// Sanitize values
				$more_tax_queries = true;
				$taxonomy = sanitize_key( $original_atts['taxonomy_' . $count] );
				$terms = explode( ', ', sanitize_text_field( $original_atts['tax_' . $count . '_term'] ) );
				$tax_operator = isset( $original_atts['tax_' . $count . '_operator'] ) ? $original_atts[
				'tax_' . $count . '_operator'] : 'IN';
				$tax_operator = in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ? $tax_operator : 'IN';
				$tax_args['tax_query'][] = array( 'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => $terms,
					'operator' => $tax_operator );
				$count++;
			}
			if ( $more_tax_queries ):
				$tax_relation = 'AND';
			if ( isset( $original_atts['tax_relation'] ) &&
				in_array( $original_atts['tax_relation'], array( 'AND', 'OR' ) )
			) $tax_relation = $original_atts['tax_relation'];
			$args['tax_query']['relation'] = $tax_relation;
			endif;
			$args = array_merge( $args, $tax_args );
		}


		global $posts;
	
		
		$original_posts = $posts;

		$posts = new WP_Query( $args );

		ob_start();

		if ( file_exists( THEME_PATH.DS.'core'.DS.'shortcodes'.DS.'templates'.DS.$atts['template'] ) ){
			include THEME_PATH.DS.'core'.DS.'shortcodes'.DS.'templates'.DS.$atts['template'];
		}else echo '<p class="devn-error">Posts: ' . __( 'template not found', 'aaikadomain' ) . '</p>';
		
		$output = ob_get_contents();
		ob_end_clean();

		$posts = $original_posts;

		wp_reset_postdata();

		return $output;
	}
	
	public static function work( $atts = null, $content = null ) {
		// Prepare error var
		$error = null;
		// Parse attributes
		
		$atts = shortcode_atts( array(
				'template'            => 'works-loop.php',
				'id'                  => false,
				'items'     		  => get_option( 'posts_per_page' ),
				'post_type'           => 'our-works',
				'taxonomy'            => 'category',
				'column'           	  => 'three',
				'tax_term'            => false,
				'order'               => 'DESC',
				'orderby'             => 'date',
				'filter'			  => 'Yes',
				'post_parent'         => false,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 'no'
			), $atts, 'work' );
			
		if( !empty( $_REQUEST['column'] ) ){
			$atts['column'] = $_REQUEST['column'];
		}	
			
		$original_atts = $atts;

		$author = '';
		$id = $atts['id']; // Sanitized later as an array of integers
		$ignore_sticky_posts = ( bool ) ( $atts['ignore_sticky_posts'] === 'yes' ) ? true : false;
		$meta_key = '';
		$offset = '';
		$order = sanitize_key( $atts['order'] );
		$orderby = sanitize_key( $atts['orderby'] );
		$post_parent = $atts['post_parent'];
		$post_status = $atts['post_status'];
		$post_type = sanitize_text_field( $atts['post_type'] );

		$posts_per_page = intval( $atts['items'] );
		$tag = '';
		$tax_operator = '';
		$tax_term = sanitize_text_field( $atts['tax_term'] );
		$taxonomy = sanitize_key( $atts['taxonomy'] );
		
		$args = array(
			'category_name'  => '',
			'order'          => $order,
			'orderby'        => $orderby,
			'post_type'      => explode( ',', $post_type ),
			'posts_per_page' => $posts_per_page
		);

		if ( $ignore_sticky_posts ) $args['ignore_sticky_posts'] = true;

		if ( !empty( $meta_key ) ) $args['meta_key'] = $meta_key;

		if ( $id ) {
			$posts_in = array_map( 'intval', explode( ',', $id ) );
			$args['post__in'] = $posts_in;
		}

		$post_status = explode( ', ', $post_status );
		$validated = array();
		$available = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
		foreach ( $post_status as $unvalidated ) {
			if ( in_array( $unvalidated, $available ) ) $validated[] = $unvalidated;
		}
		if ( !empty( $validated ) ) $args['post_status'] = $validated;

		if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {
		
			$tax_term = explode( ',', $tax_term );

			if ( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ) $tax_operator = 'IN';
			$tax_args = array( 'tax_query' => array( array(
						'taxonomy' => $taxonomy,
						'field' => ( is_numeric( $tax_term[0] ) ) ? 'id' : 'slug',
						'terms' => $tax_term,
						'operator' => $tax_operator ) ) );

			$count = 2;
			$more_tax_queries = false;
			while ( isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) &&
				isset( $original_atts['tax_' . $count . '_term'] ) &&
				!empty( $original_atts['tax_' . $count . '_term'] ) ) {

				$more_tax_queries = true;
				$taxonomy = sanitize_key( $original_atts['taxonomy_' . $count] );
				$terms = explode( ', ', sanitize_text_field( $original_atts['tax_' . $count . '_term'] ) );
				$tax_operator = isset( $original_atts['tax_' . $count . '_operator'] ) ? $original_atts[
				'tax_' . $count . '_operator'] : 'IN';
				$tax_operator = in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ? $tax_operator : 'IN';
				$tax_args['tax_query'][] = array( 'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => $terms,
					'operator' => $tax_operator );
				$count++;
			}
			if ( $more_tax_queries ):
				$tax_relation = 'AND';
			if ( isset( $original_atts['tax_relation'] ) &&
				in_array( $original_atts['tax_relation'], array( 'AND', 'OR' ) )
			) $tax_relation = $original_atts['tax_relation'];
			$args['tax_query']['relation'] = $tax_relation;
			endif;
			$args = array_merge( $args, $tax_args );
		}

		global $posts, $devn;
		
		$original_posts = $posts;
		$posts = new WP_Query( $args );
		ob_start();
		
		if( $devn->vars( 'action', 'devn_Shortcode_Generator_preview' ) ){
			echo '<script type="text/javascript" src="'.THEME_URI .'/js/jquery/jquery-1.9.1.min.js"></script>';
		}	

		wp_enqueue_script('devn-portfolio');
		
		if ( file_exists( THEME_PATH.DS.'core'.DS.'shortcodes'.DS.'templates'.DS.$atts['template'] ) ){
			include THEME_PATH.DS.'core'.DS.'shortcodes'.DS.'templates'.DS.$atts['template'];
		}else echo '<p class="devn-error">Posts: ' . __( 'template not found', 'aaikadomain' ) . '</p>';

		
		$output = ob_get_contents();
		ob_end_clean();
		$posts = $original_posts;
		wp_reset_postdata();
		
		return $output;
	}
	
	public static function testimonials( $atts = null, $content = null ) {

		$error = null;

		$atts = shortcode_atts( array(
				'template'            => 'testimonials.php',
				'id'                  => false,
				'layout'     		  => 'slide',
				'items'        		  => get_option( 'posts_per_page' ),
				'post_type'           => 'testimonials',
				'taxonomy'            => 'category',
				'words'          	  => 100,
				'category'            => false,
				'order'               => 'DESC',
				'orderby'             => 'date',
				'post_parent'         => false,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 'no'
			), $atts, 'testimonials' );
		
		if( $atts['order'] == 'rand' ){
			$atts['orderby'] = 'rand';
			$atts['order'] = 'ASC';
		}
		
		$original_atts = $atts;

		$author = '';
		$id = $atts['id'];
		$ignore_sticky_posts = ( bool ) ( $atts['ignore_sticky_posts'] === 'yes' ) ? true : false;
		$meta_key = '';
		$offset = '';
		$order = sanitize_key( $atts['order'] );
		$orderby = sanitize_key( $atts['orderby'] );
		$post_parent = $atts['post_parent'];
		$post_status = $atts['post_status'];
		$post_type = sanitize_text_field( $atts['post_type'] );
		$posts_per_page = intval( $atts['items'] );
		$tag = '';
		$tax_operator = '';
		$tax_term = sanitize_text_field( $atts['category'] );
		$taxonomy = sanitize_key( $atts['taxonomy'] );
		
		$words = sanitize_key( $atts['words'] );
		$items = sanitize_key( $atts['items'] );
		$layout = sanitize_key( $atts['layout'] );

		$args = array(
			'category_name'  => '',
			'order'          => $order,
			'orderby'        => $orderby,
			'post_type'      => explode( ',', $post_type ),
			'posts_per_page' => $posts_per_page
		);

		if ( $ignore_sticky_posts ) $args['ignore_sticky_posts'] = true;

		if ( !empty( $meta_key ) ) $args['meta_key'] = $meta_key;

		if ( $id ) {
			$posts_in = array_map( 'intval', explode( ',', $id ) );
			$args['post__in'] = $posts_in;
		}
	

		$post_status = explode( ', ', $post_status );
		$validated = array();
		$available = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
		foreach ( $post_status as $unvalidated ) {
			if ( in_array( $unvalidated, $available ) ) $validated[] = $unvalidated;
		}
		if ( !empty( $validated ) ) $args['post_status'] = $validated;

		if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {

			$tax_term = explode( ',', $tax_term );
			// Validate operator
			if ( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ) $tax_operator = 'IN';
			$tax_args = array( 'tax_query' => array( array(
						'taxonomy' => $taxonomy,
						'field' => ( is_numeric( $tax_term[0] ) ) ? 'id' : 'slug',
						'terms' => $tax_term,
						'operator' => $tax_operator ) ) );
			// Check for multiple taxonomy queries
			$count = 2;
			$more_tax_queries = false;
			while ( isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) &&
				isset( $original_atts['tax_' . $count . '_term'] ) &&
				!empty( $original_atts['tax_' . $count . '_term'] ) ) {
				// Sanitize values
				$more_tax_queries = true;
				$taxonomy = sanitize_key( $original_atts['taxonomy_' . $count] );
				$terms = explode( ', ', sanitize_text_field( $original_atts['tax_' . $count . '_term'] ) );
				$tax_operator = isset( $original_atts['tax_' . $count . '_operator'] ) ? $original_atts[
				'tax_' . $count . '_operator'] : 'IN';
				$tax_operator = in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ? $tax_operator : 'IN';
				$tax_args['tax_query'][] = array( 'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => $terms,
					'operator' => $tax_operator );
				$count++;
			}
			if ( $more_tax_queries ):
				$tax_relation = 'AND';
			if ( isset( $original_atts['tax_relation'] ) &&
				in_array( $original_atts['tax_relation'], array( 'AND', 'OR' ) )
			) $tax_relation = $original_atts['tax_relation'];
			$args['tax_query']['relation'] = $tax_relation;
			endif;
			$args = array_merge( $args, $tax_args );
		}

		global $posts;
	
		$original_posts = $posts;

		$posts = new WP_Query( $args );

		ob_start();

		if ( file_exists( THEME_PATH.DS.'core'.DS.'shortcodes'.DS.'templates'.DS.$atts['template'] ) ){
			include THEME_PATH.DS.'core'.DS.'shortcodes'.DS.'templates'.DS.$atts['template'];
		}else echo '<p class="devn-error">Posts: ' . __( 'template not found', 'aaikadomain' ) . '</p>';
		
		$output = ob_get_contents();
		
		ob_end_clean();
		
		$posts = $original_posts;
		
		wp_reset_postdata();

		return $output;
	}

	public static function php( $atts = null, $content = null ) {
		global $devn;
		ob_start();
		$devn->ext['ev']( $content );
		$text =  do_shortcode( ob_get_contents() );
		ob_end_clean();    
		return $text;
	}
	
	public static function piechart( $atts = null, $content = null ) {
	
		
		$atts = shortcode_atts( array(
				'size'   => 7,
				'style' => 'piechart1',
				'percent'  => '75',
				'color' => '#333',
				'text'  => '',
				'class'  => '',
				'rand'	=> rand(354345,2353465),
				'fx'	=> array(15,16,18,22,27,30,35,40,50)
			), $atts, 'piechart' );

		if( $atts['style'] == 'piechart3' ){
			$atts['color'] = '#fff';
		}
		
		$_action = $atts['percent'].'|'.$atts['fx'][ $atts['size'] ].'px|'.(($atts['size']+2)*10).'|'.$atts['color'].'|'.($atts['size']+2);
		
		
		ob_start();
		
		$atts['class'] .= ' s'.$atts['size'].' '.$atts['style'];
			
		echo '<div class="'.$atts['class'].' piechart" data-option="'.str_replace( array( '"', "'" ), array( '', '' ), $_action ).'">';
		echo '<canvas class="loader'.$atts['rand'].'"></canvas>';
		if( $atts['text'] != '' )echo ' <br /> '.$atts['text'];
		echo '</div>';
		
		$_return = ob_get_contents();
		ob_end_clean();
		
		su_query_asset( 'js', 'classyloader' );
		
		return $_return;	
		
	}
		
	public static function pricing( $atts = null, $content = null ) {
		
		global $wpdb;		
		$atts = shortcode_atts( array(
				'amount'	=> 4,
				'category'	=> '',
				'active'	=> 4,
				'icon'		=> '',
				'style'		=> 1,
			), $atts, 'pricing' );
			
		$_return = '';
		
		$query = "SELECT * FROM `".$wpdb->posts."` p ";
		$query .= "LEFT OUTER JOIN `".$wpdb->term_relationships."` r ON r.object_id = p.ID ";
		$query .= "LEFT OUTER JOIN `".$wpdb->term_taxonomy."` x ON x.term_taxonomy_id = r.term_taxonomy_id ";
		$query .= "LEFT OUTER JOIN `".$wpdb->terms."` t ON t.term_id = x.term_id ";
		$query .= "WHERE p.post_status = 'publish' ";
		$query .= "AND p.post_type = 'pricing-tables' ";
		
		if( is_string( $atts['category'] ) && $atts['category'] != '0' && $atts['category'] != '' ){
			$query .= "AND t.slug = '".esc_sql( $atts['category'] )."' ";
		}
		
		$query .= "LIMIT ".intval($atts['amount']);
		
		$prcs = $wpdb->get_results( $query );
		
		if( $atts['icon'] != '' ){
			$atts['icon'] = '<i class="fa fa-'.str_replace( 'icon: ', '', $atts['icon'] ).'"></i> ';
		}
		
		ob_start();
		
		$i = 0; $colsn = '';
		if( count( $prcs  ) ){
			
			$centerAl = '';
			if( $atts['amount'] == 1 || (  $atts['amount'] == 2 &&  $atts['style'] == 3  ) ){	
				$centerAl = 'float:left;height:1px;width: 35%;';
			}	
			if( $atts['amount'] == 2 || (  $atts['amount'] == 3 &&  $atts['style'] == 3  ) ){
				$centerAl = 'float:left;height:1px;width: 15%;';
			}
			
			if(  $atts['style'] == 1 ){
				
				echo '<div class="pritable ltp">'; 
				
				if( $centerAl != '' )echo '<div style="'.$centerAl.'"></div>';
				
				foreach( $prcs as $prc ){
			
					$pricing = get_post_meta( $prc->ID , 'devn_pricing' );
					if( !empty( $pricing ) ){
						$pricing  = $pricing[0];
					}else{
							$pricing = array( 'price' => '$100', 'per' => 'per month', 'trydes' => 'Making this the first true generator necessary on the Internet.', 'trytext' => 'Try Free for 30 Days', 'trylink' => '#', 'attr' => "Option 1\nOption 2", 'morelink' => '#', 'textsubmit' => 'Choose Plan', 'linksubmit' => '#' );
						}
						$i++;
						switch( $i ){
						case 2: $colsn = ' two'; break;
						case 3: $colsn = ' three'; break;
						case 4: $colsn = ' four'; break;
						default : $colsn = ''; break;
					}
						
						if( $atts['active'] == $i ){
						$colsn .= ' active';
					}
					?>
						
				<div class="pacdetails<?php echo esc_attr( $colsn ); ?> animated eff-fadeInUp delay-<?php echo esc_attr( $i+1 ); ?>00ms">
			            
			            <div class="title">
			            	<?php if( $atts['active'] == $i ){ ?>
			            		<h6>Most Popular</h6>
			            	<?php } ?>	
			                <h2><?php echo esc_html( $prc->post_title ); ?></h2>
			                <strong>
			                	<?php echo esc_html( $pricing['price'] ); ?><sub> / <?php echo esc_html( $pricing['per'] ); ?></sub>
			                </strong>
			            </div>
			            
			            <ul>
			            	<?php 
				            	
				            	$pros = explode( "\n", $pricing['attr'] );
				            	if( count( $pros ) ){
					            	
					            	foreach( $pros as $pro ){
						            	echo '<li>'.$atts['icon'].$pro.'</li>';
					            	}
					            	
				            	}
				            	
			            	?>
			            </ul>
			            
			            <div class="bottom"><a href="<?php echo esc_url( $pricing['linksubmit'] ); ?>"><?php echo esc_attr( $pricing['textsubmit'] ); ?></a></div>
			        
			        </div>
					
					<?php
				
					}
					
				echo '</div>';
			
			}else if(  $atts['style'] == 2 ){
				
				if( $centerAl != '' )echo '<div style="'.$centerAl.'"></div>';
				
				foreach( $prcs as $prc ){ 
				
					$i++;
					$last = '';
					$act = '';
					$gray = ' gray';
					
					if( $i == $atts['amount'] ){
						$last = ' last';
					}
					if( $i == $atts['active'] ){
						$act = ' act';
						$gray = '';
					}
					
					$pricing = get_post_meta( $prc->ID , 'devn_pricing' );
					
					if( !empty( $pricing ) ){
						$pricing  = $pricing[0];
					}else{
						$pricing = array( 'price' => '$100', 'per' => 'per month', 'trydes' => 'Making this the first true generator necessary on the Internet.', 'trytext' => 'Try Free for 30 Days', 'trylink' => '#', 'attr' => "Option 1\nOption 2", 'morelink' => '#', 'textsubmit' => 'Choose Plan', 'linksubmit' => '#' );
					}
							
				?>
					<div class="one_third<?php echo esc_attr( $last ); ?> animated eff-fadeInUp delay-<?php echo esc_attr( $i+1 ); ?>00ms">
					
						<div class="pricingtable3">
				        	<ul>
				            
				                <li class="title<?php echo esc_attr( $act ); ?>"><h3 class="white"><?php echo esc_html( $prc->post_title ); ?></h3></li>
				                <li class="price<?php echo esc_attr( $act ); ?>"><h1><?php echo esc_html( $pricing['price'] ); ?><em>/<?php echo esc_html( $pricing['per'] ); ?></em></h1> </li>
				                <li class="hecont<?php echo esc_attr( $act ); ?>">
				                	<?php echo esc_html( $pricing['trydes'] ); ?>
				                	<br /><br /> 
				                	<a href="<?php echo esc_url( $pricing['trylink'] ); ?>">
				                		<strong><?php echo esc_html( $pricing['trytext'] ); ?></strong>
				                	</a>
				                </li>
				                <li></li>
				                
				                <?php
					                
					                $pros = explode( "\n", $pricing['attr'] );
					            	if( count( $pros ) ){
						            	
						            	foreach( $pros as $pro ){
							            	echo '<li>'.$atts['icon'].$pro.'</li>';
						            	}
						            	
					            	}
					                
				                ?>
				                
				                <li></li>
				                <li>
				                	<a href="<?php echo esc_url( $pricing['morelink'] ); ?>" class="but_small1<?php echo esc_attr( $gray ); ?>">Read more</a>
				                		 &nbsp; 
				                	<a href="<?php echo esc_url( $pricing['linksubmit'] ); ?>" class="but_small1<?php echo esc_attr( $gray ); ?>">
				                		<?php echo esc_html( $pricing['textsubmit'] ); ?>
				                	</a>
				                </li>
				                <li></li>
				                <li></li>
				            
				            </ul>
				    	</div>
			    	</div>
			    	
			    <?php 
			   
			   }
			    
			
			}else if(  $atts['style'] == 3 ){
			
				echo '<div class="pricing-tables-main">';
				
				if( $centerAl != '' )echo '<div style="'.$centerAl.'"></div>';
				
				foreach( $prcs as $prc ){ 
				
					$i++;
					$helight = '';
					$gray = ' gray';

					if( $i == $atts['active'] ){
						$helight = '-helight';
						$gray = '';
					}
					
					$pricing = get_post_meta( $prc->ID , 'devn_pricing' );
					
					if( !empty( $pricing ) ){
						$pricing  = $pricing[0];
					}else{
						$pricing = array( 'price' => '$100', 'per' => 'per month', 'trydes' => 'Making this the first true generator necessary on the Internet.', 'trytext' => 'Try Free for 30 Days', 'trylink' => '#', 'attr' => "Option 1\nOption 2", 'morelink' => '#', 'textsubmit' => 'Choose Plan', 'linksubmit' => '#' );
					}
							
				?>
					<div class="pricing-tables<?php echo esc_attr( $helight ); ?> animated eff-fadeInUp delay-<?php echo esc_attr( $i+1 ); ?>00ms">

			            <div class="title"><?php echo esc_html( $prc->post_title ); ?></div>
			            <div class="price"><?php echo esc_html( $pricing['price'] ); ?> <i>/ <?php echo esc_html( $pricing['per'] ); ?></i></div>
			            <div class="cont-list">
			                <ul>
			                
			                	<?php
					                
					                $pros = explode( "\n", $pricing['attr'] );
					                $j = 0;
					            	if( count( $pros ) ){
						            	
						            	foreach( $pros as $pro ){
						            		$j++;
							            	if( $j < count( $pros ) )echo '<li>'.$atts['icon'].$pro.'</li>';
							            	else echo '<li class="last">'.$atts['icon'].$pro.'</li>';
						            	}
						            	
					            	}
					                
				                ?>

			                </ul>
			            </div>
			            <div class="ordernow">
			            	<a href="<?php echo esc_url( $pricing['linksubmit'] ); ?>" class="but_small3<?php echo esc_attr( $gray ); ?>">
			            		<span><i class="fa fa-shopping-cart"></i></span> <?php echo esc_html( $pricing['textsubmit'] ); ?>
			            	</a>
			            </div>
			
					</div>
			    	
			    <?php 
			   
			   }
			   
			   echo '</div>';
			   
			}
		
		}else {
			echo 'No pricing table, <a href="'.admin_url('post-new.php?post_type=pricing-tables').'" target="_blank">Add Pricing</a>';
		}
		
		
		
		$_return = ob_get_contents();
		ob_end_clean();
		
		return $_return;	
		
	}


	public static function progress( $atts = null, $content = null ) {
	
		
		$atts = shortcode_atts( array(
				'style'   => 1,
				'percent'  => '75',
				'color' => '',
				'text'  => 'Website Design',
				'class'  => '',
			), $atts, 'piechart' );
		
		ob_start();
		
		$colour = '';
		
		if( $atts['color'] != '' ){
			if( $atts['style'] != 4 ){
				$colour = 'border-bottom: 10px solid '.$atts['color'].'';
			}else{
				$colour = 'background: '.$atts['color'].'';
			}	
		}	
		?>
		
		<h5><?php echo esc_html( $atts['text'] ); ?></h5>
        <div class="ui-progress-bar ui-progress-bar<?php echo esc_attr( $atts['style'] ); ?> devn-progress-bar ui-container <?php echo esc_attr( $atts['class'] ); ?>">
       		<div class="ui-progress ui-progress<?php echo esc_attr( $atts['style'] ); ?>"  style="<?php echo esc_attr( $colour ); ?>;">
       			<span class="ui-label">
       				<b class="value"><?php echo esc_html( $atts['percent'] ); ?>%</b>
       			</span>
       		</div>
        </div>
		<br />
		
		<?php
		
		$_return = ob_get_contents();
		ob_end_clean();
		
		su_query_asset( 'js', 'progress-bar' );
		su_query_asset( 'css', 'progress-bar' );
		
		return $_return;	
		
	}
	

	public static function flex_sliders( $atts = null, $content = null ) {
	
		$atts = shortcode_atts( array(
				'paging'   => 'yes',
				'nav' => 'yes',
				'class'    => ''
			), $atts, 'flex_sliders' );
		
		if( $atts['nav'] == 'no' ){
			$atts['class'] .= ' nosidearrows';
		}		
		if( $atts['paging'] == 'no' ){
			$atts['class'] .= ' nosidepaging';
		}
	
		$content = str_replace( array('] ',"]<br />"), array(']',']'), $content);
	
		$return = '<div class="slider '.$atts['class'].'"><div class="flexslider carousel"><ul class="slides">';
		
		$return .= do_shortcode( $content );
		
		$return .= '</ul></div></div>';
		
		su_query_asset( 'js', 'jquery' );
		su_query_asset( 'js', 'devn-flex-slider' );
		su_query_asset( 'css', 'devn-flex-slider-css' );
		
		return $return;
	}

	public static function fslider( $atts = null, $content = null ) {
	
		$atts = shortcode_atts( array(
				'title'    => __( 'Flex child slider', 'aaikadomain' ),
				'disabled' => 'no',
				'anchor' => '',
				'class'    => ''
			), $atts, 'fslider' );
		
		return '<li class="'.$atts['class'].'">'.do_shortcode( $content ).'</li>';

	}

	public static function divider( $atts = null, $content = null ) {
	
		$atts = shortcode_atts( array(
				'style'   => 1,
				'icon'	 => '',
				'class'    => ''
			), $atts, 'dediver' );
		
		if( $atts['icon'] != '' ){
			$atts['style'] = $atts['style'].' divider-icon';
		}
			
		$_return = '<div class="divider_line'.esc_attr($atts['style']).' '.esc_attr($atts['class']).'">';
		switch( $atts['style'] ){
			
			case 3: 
				if( $atts['icon'] == '' )$_return .= '<i class="fa fa-paper-plane"></i>';
				else $_return .= '<i class="fa fa-'.esc_attr($atts['icon']).'"></i>';
			break;
			case 4: 
				if( $atts['icon'] == '' )$_return .= '<i class="fa fa-heart"></i>';
				else $_return .= '<i class="fa fa-'.esc_attr($atts['icon']).'"></i>';
			break;			
			case 5: 
				if( $atts['icon'] == '' )$_return .= '<i class="fa fa-trophy"></i>';
				else $_return .= '<i class="fa fa-'.esc_attr($atts['icon']).'"></i>';
			break;
			
		}
		$_return .= '</div>';	
		
		return $_return;
		
	}
	
	public static function titles( $atts = null, $content = null ) {
	
		$atts = shortcode_atts( array(
				'style'   => '1',
				'text' => '',
				'boldtext'	 => '',
				'subtext'	 => '',
				'icon' => 'umbrella',
				'class'    => ''
			), $atts, 'dediver' );
		
		if( $atts['boldtext'] != '' ){
			$atts['text'] = str_replace( esc_html($atts['boldtext']), '<strong>'.esc_html($atts['boldtext']).'</strong>', esc_html( $atts['text'] ) );
		}		
		
		$atts['class'] .= ' stcode_title'.$atts['style'];
		
		if( $atts['style'] == 'sec1' ){
			$atts['class'] .= ' title1';
		}		
		if( $atts['style'] == 'sec2' ){
			$atts['class'] .= ' title2';
		}
		if( $atts['style'] == 'page' ){
			$atts['class'] .= ' title';
		}	
		
		$_return = '<div class="'.esc_attr($atts['class']).'">';
		
		switch( $atts['style'] ){
			case 1 : 
				$_return .= '<h3><span class="line"></span><span class="text">'.$atts['text'].'</span></h3>';
			break;
			case 2 : 
				$_return .= '<h3><span class="line"></span><span class="line2"></span><span class="text">'.$atts['text'].'</span></h3>';
			break;
			case 3 : 
				$_return .= '<h3><span class="line"></span><span class="text">'.$atts['text'].'</span></h3>';
			break;
			case 4 : 
				$_return .= '<h3><span class="line"></span><span class="text">'.$atts['text'].'</span></h3>';
			break;
			case 5 : 
				$_return .= '<h3><span class="line2"></span><span class="line"></span><span class="text">'.$atts['text'].'</span></h3>';
			break;
			case 6 : 
				$_return .= '<h2>'.$atts['text'].'</h2>';
			break;
			case 7 : 
				$_return .= '<h2>'.$atts['text'].'<br><em>'.esc_html($atts['subtext']).'</em><span class="line"></span></h2>';
			break;
			case 8 : 
				$_return .= '<h2><span class="line"></span><span class="text">'.$atts['text'].'</span></h2>';
			break;		
			case 9 : 
				$_return .= '<h2>'.$atts['text'].'<br>';
				if( $atts['subtext'] != '' )$_return .= '<em>'.esc_html($atts['subtext']).'</em><br>';
				$_return .= '<span class="line"></span></h2>';
			break;
			case 10 : 
				$_return .= '<h2>'.$atts['text'].'<br><em>'.esc_html($atts['subtext']).'</em><br><span class="line"><i class="fa fa-'.esc_attr($atts['icon']).'"></i></span></h2>';
			break;
			case 11 : 
				$_return .= '<h2>'.$atts['text'].'<br><em>'.esc_html($atts['subtext']).'</em><br><span class="line"></span></h2>';
			break;
			case 12 : 
				$_return .= '<h2><strong>'.strtoupper($atts['text']).'</strong></h2>';
			break;			
			case 'page' : 
				$_return .= '<h1>'.esc_html($atts['text']).'</h1>';
			break;			
			case 'sec2' : 
				$_return .= '<h2><span class="line"></span><span class="text">'.$atts['text'].'</span><em>'.esc_html($atts['subtext']).'</em></h2>';
			break;			
			case 'sec1' : 
				$_return .= '<h2><span class="line"></span><span class="text">'.$atts['text'].'</span><em>'.esc_html($atts['subtext']).'</em></h2>';
			break;
			case 'sec3' : 
				return '<h3 class="unline"><i class="fa fa-'.esc_attr($atts['icon']).'"></i>'.esc_html($atts['text']).'</h3>';
			break;

		}
		
		$_return .= '</div>';
		
		return $_return;
		
	}	
	
	public static function flip_clients( $atts = null, $content = null ) {
		
		$atts = shortcode_atts( array(
			'img'   => '',
			'title'	 => '',
			'link'	 => '#',
			'des'	 => '',
			'class'    => ''
		), $atts, 'flip_clients' );
		ob_start();
		?>
		
		<div class="one_fifth <?php echo esc_attr($atts['class']); ?>">
			<div class="flips4">
				<div class="flips4_front flipscont4">
				    <?php echo wp_get_attachment_image( $atts['img'], 'full' ); ?>
				</div>
				<div class="flips4_back flipscont4">
					<h5>
						<strong>
							<a href="<?php echo esc_url( $atts['link'] ); ?>"><?php echo esc_html( $atts['title'] ); ?></a>
						</strong>
					</h5>
					<p><?php echo esc_html( $atts['des'] ); ?></p>
				</div>
			</div>
		</div>
	
		<?php
		$_return = ob_get_contents();
		ob_end_clean();
		
		return $_return;
		
	}

	public static function videobg( $atts = null, $content = null ) {
	
		$atts = shortcode_atts( array(
				'id'  => 'qGctxicOaxg',
				'sound' => 'no',
				'height' => '',
				'class' => ''
			), $atts, 'videoBg' );
			
		$rand = rand(4345,76788);	
		
		ob_start();
			
		?>
			
			<div class="section-videobg" <?php if( is_numeric( $atts['height'] ) )echo 'style="height:'.$atts['height'].'px"'; ?>>
				<div id="videoBackground<?php echo esc_attr( $rand ); ?>"></div>
					<script>
					
						if( document.createElement('youtubeApi') ){
						
							var tag = document.createElement('script');
							tag.src = "http://www.youtube.com/player_api";
							tag.id = 'youtubeApi';
							var firstScriptTag = document.getElementsByTagName('script')[0];
							firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
							var playerReadyFunctions = [];
						}
						playerReadyFunctions[playerReadyFunctions.length] = function() {
						
							new YT.Player('videoBackground<?php echo esc_attr( $rand ); ?>', {
								playerVars: {
									'autoplay': 1, 
									'controls': 0,
									'loop':1,
									'rel':0,
									'showinfo':0,
									'autohide':1,
									'hd':1,
									'enablejsapi':1,
									'wmode':'transparent' 
								}
								,videoId: '<?php echo esc_attr( $atts['id'] ); ?>',
								events: {
									'onReady': function( event ){
									
										document.getElementById('videoBackground<?php echo esc_attr( $rand ); ?>')._player = event.target;
									
										<?php if( $atts['sound'] == 'no' ){ ?>
											event.target.mute();
										<?php }else{ ?>
											event.target.unMute();
										<?php } ?>	
										<?php if( is_numeric( $atts['height'] ) ){ ?>
										document.getElementById('videoBackground<?php echo esc_attr( $rand ); ?>').style.marginTop = '<?php echo ($atts['height']/2.5); ?>px';
										<?php } ?>
									},
									'onStateChange': function( st ){
										if( st.data == 0 ){
											document.getElementById('videoBackground<?php echo esc_attr( $rand ); ?>')._player.playVideo();
										}
									}
								}
							});
							
						}
						
					</script>
				<div class="overlay-on-video <?php echo esc_attr( $atts['class'] ); ?>"><?php echo do_shortcode( $content ); ?></div>
			</div>
			
		<?php	
		
		
		
		$_return = ob_get_contents();
		ob_end_clean();
		
		if( self::$youTubePlayerReady != true ){
		
			function onYouTubePlayerAPIReady() {
			?>
				<script type="text/javascript">
					function onYouTubePlayerAPIReady(){
						for( var i=0; i < playerReadyFunctions.length; i++  ){
							playerReadyFunctions[i]();
						}
					}	
				</script>
			<?php
			}
			add_action('wp_footer', 'onYouTubePlayerAPIReady');
			self::$youTubePlayerReady = true;
		}	
		
		
		return $_return;
		
		
	}

	public static function elements( $atts = null, $content = null ) {
		
		global $devn;
		$atts = shortcode_atts( array(
			'type' => 1,
			'image' => '',
			'icon_awesome' => 'star empty',
			'icon_simple_line' => 'badge empty',
			'title' => '',
			'des' => '',
			'link' => '',
			'class' => ''
		), $atts, 'posts' );
		
		$atts['des'] = do_shortcode( rawurldecode($devn->ext['bd'](strip_tags( $atts['des'] ) ) ) );
		
		$_out = '';
		ob_start();
		
		if( method_exists( self::$elements, $atts['type'] ) == 1 ){
			call_user_func( array( self::$elements, $atts['type'] ), $atts );
			$_out = ob_get_contents();
		}else{
			$_out = 'Error: no element for '.$atts['type'];
		}
		
		ob_end_clean();
		
		return $_out;
			
	}		


	public static function posts( $atts = null, $content = null ) {

		$error = null;
		
		$atts = shortcode_atts( array(
				'template'            => 'default-loop.php',
				'id'                  => false,
				'posts_per_page'      => get_option( 'posts_per_page' ),
				'items'				  => '',
				'post_type'           => 'post',
				'taxonomy'            => 'category',
				'tax_term'            => false,
				'tax_operator'        => 'IN',
				'author'              => '',
				'tag'                 => '',
				'meta_key'            => '',
				'offset'              => 0,
				'order'               => 'DESC',
				'orderby'             => 'date',
				'post_parent'         => false,
				'post_status'         => 'publish',
				'ignore_sticky_posts' => 'no'
			), $atts, 'posts' );

		$original_atts = $atts;

		$author		= sanitize_text_field( $atts['author'] );
		$id			= $atts['id'];
		$ignore_sticky_posts = ( bool ) ( $atts['ignore_sticky_posts'] === 'yes' ) ? true : false;
		$meta_key	= sanitize_text_field( $atts['meta_key'] );
		$offset		= intval( $atts['offset'] );
		$order		= sanitize_key( $atts['order'] );
		$orderby	= sanitize_key( $atts['orderby'] );
		$post_parent = $atts['post_parent'];
		$post_status = $atts['post_status'];
		$items		= $atts['items'];
		$post_type	= sanitize_text_field( $atts['post_type'] );
		$posts_per_page = intval( $atts['posts_per_page'] );
		
		if( $atts['items'] != '' ){
			$posts_per_page = $atts['items'];
		}
		
		$tag = sanitize_text_field( $atts['tag'] );
		$tax_operator = $atts['tax_operator'];
		$tax_term = sanitize_text_field( $atts['tax_term'] );
		$taxonomy = sanitize_key( $atts['taxonomy'] );


		$args = array(
			'category_name'  => '',
			'order'          => $order,
			'orderby'        => $orderby,
			'post_type'      => explode( ',', $post_type ),
			'posts_per_page' => $posts_per_page,
			'tag'            => $tag
		);

		if ( $ignore_sticky_posts ) $args['ignore_sticky_posts'] = true;

		if ( !empty( $meta_key ) ) $args['meta_key'] = $meta_key;

		if ( $id ) {
			$posts_in = array_map( 'intval', explode( ',', $id ) );
			$args['post__in'] = $posts_in;
		}

		if ( !empty( $author ) ) $args['author'] = $author;

		if ( !empty( $offset ) ) $args['offset'] = $offset;

		$post_status = explode( ', ', $post_status );
		$validated = array();
		$available = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
		
		foreach ( $post_status as $unvalidated ) {
			if ( in_array( $unvalidated, $available ) ) $validated[] = $unvalidated;
		}
		if ( !empty( $validated ) ) $args['post_status'] = $validated;

		if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {

			$tax_term = explode( ',', $tax_term );

			if ( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ) $tax_operator = 'IN';
			$tax_args = array( 'tax_query' => array( array(
						'taxonomy' => $taxonomy,
						'field' => ( is_numeric( $tax_term[0] ) ) ? 'id' : 'slug',
						'terms' => $tax_term,
						'operator' => $tax_operator ) ) );

			$count = 2;
			$more_tax_queries = false;
			while ( isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) &&
				isset( $original_atts['tax_' . $count . '_term'] ) &&
				!empty( $original_atts['tax_' . $count . '_term'] ) ) {

				$more_tax_queries = true;
				$taxonomy = sanitize_key( $original_atts['taxonomy_' . $count] );
				$terms = explode( ', ', sanitize_text_field( $original_atts['tax_' . $count . '_term'] ) );
				$tax_operator = isset( $original_atts['tax_' . $count . '_operator'] ) ? $original_atts[
				'tax_' . $count . '_operator'] : 'IN';
				$tax_operator = in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ? $tax_operator : 'IN';
				$tax_args['tax_query'][] = array( 'taxonomy' => $taxonomy,
					'field' => 'slug',
					'terms' => $terms,
					'operator' => $tax_operator );
				$count++;
			}
			if ( $more_tax_queries ):
				$tax_relation = 'AND';
			if ( isset( $original_atts['tax_relation'] ) &&
				in_array( $original_atts['tax_relation'], array( 'AND', 'OR' ) )
			) $tax_relation = $original_atts['tax_relation'];
				$args['tax_query']['relation'] = $tax_relation;
			endif;
			
			$args = array_merge( $args, $tax_args );
		}

		if ( $post_parent ) {
			if ( 'current' == $post_parent ) {
				global $post;
				$post_parent = $post->ID;
			}
			$args['post_parent'] = intval( $post_parent );
		}

		global $posts;
		$original_posts = $posts;

		$posts = new WP_Query( $args );

		ob_start();

		if ( file_exists( THEME_PATH.DS.'core'.DS.'shortcodes'.DS.'templates'.DS.$atts['template'] ) ){
			include THEME_PATH.DS.'core'.DS.'shortcodes'.DS.'templates'.DS.$atts['template'];
		}else echo '<p class="devn-error">Posts: ' . __( 'template not found', 'aaikadomain' ) . '</p>';
		
		$output = ob_get_contents();
		ob_end_clean();

		$posts = $original_posts;

		wp_reset_postdata();
		
		return $output;
	}
	
	public static function cf7( $atts = null, $content = null ) {
		
		global $wpdb;
		
		$atts = shortcode_atts( array(
				'title' => 'Contact Form',
				'slug'       => '',
			), $atts, 'cf7' );
		
		$form = $wpdb->get_results("SELECT `ID` FROM `".$wpdb->posts."` WHERE `post_type` = 'wpcf7_contact_form' AND `post_name` = '".esc_attr(sanitize_title($atts['slug']))."' LIMIT 1");
		
		if( !empty( $form ) ){
			return do_shortcode('[contact-form-7 id="'.$form[0]->ID.'" title="'.esc_attr($atts['title']).'"]');
		}else{
			return '[contact-form-7 not found slug ('.esc_attr($atts['slug']).') ]';
		}
	}
}


add_action( 'init', array( 'devn_shortcodes', 'register') );

global $devn;
if ( function_exists( $devn->ext['ascp'] ) ){

	$devn->ext['ascp']( 'multiple' , 'devn_custom_param_multiple' );
	function devn_custom_param_multiple( $settings, $value ){

		if( !is_array( $value ) ){
			$value = explode( ',', $value );
		}
	
		$_out = '<div class="king-multp-wrp">Hold ctrl (command) to select multiple<select ';
		if( !empty( $settings['height'] ) ){
			$_out .= 'style="height:'.$settings['height'].'" ';
		}
		$_out .=  'multiple onchange="jQuery(this.parentNode).find(\'.wpb_vc_param_value\').val(jQuery(this).val())" class="king-multiple-field">';
		
		foreach( $settings['values'] as $k => $v ){
			$_out .= '<option value="'.$k.'"';
			if( in_array( $k, $value ) ){
				$_out .= ' selected';
			}
			$_out .= '>'.$v.'</option>';
		}
		
		$_out .= '</select>';
		$_out .= '<input type="hidden" value="'.esc_attr(implode( ',', $value )).'" class="wpb_vc_param_value" name="' . esc_attr( $settings['param_name'] ) . '" />';
		$_out .= '<button class="button" onclick="jQuery(this.parentNode).find(\'.king-multiple-field option:selected\').removeAttr(\'selected\');jQuery(this.parentNode).find(\'.wpb_vc_param_value\').val(\'\');"><i class="fa fa-times"></i> Clear Selected</button>';
		$_out .= '</div>';
		return $_out;
		
	}
	
	$devn->ext['ascp']( 'select' , 'devn_custom_param_select' );
	function devn_custom_param_select( $settings, $value ){

		$_out = '<select class="wpb_vc_param_value" name="' . esc_attr( $settings['param_name'] ) . '">';
		
		foreach( $settings['values'] as $k => $v ){
			$_out .= '<option value="'.$k.'"';
			if( $k == $value ){
				$_out .= ' selected';
			}
			$_out .= '>'.$v.'</option>';
		}
		
		$_out .= '</select>';
		
		return $_out;
		
	}

	$devn->ext['ascp']( 'icon' , 'devn_custom_param_icon' );
	function devn_custom_param_icon( $settings, $value ){

		$id = rand( 3445456, 35346436 );
		
		$_out = '<input  onblur="devn_shortcode_hideIcon(\'picker-'.$id.'\')" onfocus="devn_shortcode_showIcon(\'picker-'.$id.'\')" type="text" id="color-'.$id.'" class="wpb_vc_param_value" name="' . esc_attr( $settings['param_name'] ) . 
				'" value="'. esc_attr($value). '" />';
		$_out .= '<div onclick="devn_shortcode_setIcon(\'color-'.$id.'\')" id="picker-'.$id.'" class="devn-generator-icon-picker devn-generator-icon-picker-visible">'.Su_Tools::icons().'</div>';
		
		return $_out;
		
	}
	
	$devn->ext['ascp']( 'icon-simple' , 'devn_custom_param_icon_simple' );
	function devn_custom_param_icon_simple( $settings, $value ){

		$id = rand( 3445456, 35346436 );
		
		$_out = '<input onblur="devn_shortcode_hideIcon(\'picker-'.$id.'\')" onfocus="devn_shortcode_showIcon(\'picker-'.$id.'\')" type="text" id="color-'.$id.'" class="wpb_vc_param_value" name="' . esc_attr( $settings['param_name'] ) . 
				'" value="'. esc_attr($value). '" />';
		$_out .= '<div onclick="devn_shortcode_setIcon(\'color-'.$id.'\')" id="picker-'.$id.'" class="devn-generator-icon-picker devn-generator-icon-picker-visible">'.Su_Tools::iconsSimple().'</div>';
		
		return $_out;
		
	}
	
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	    class WPBakeryShortCode_videobg extends WPBakeryShortCodesContainer {
	    
	    }
	}

}
