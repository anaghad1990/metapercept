<?php

class devn_elements {
	
	static $var = false;
	
	public static function sec1( $atts ){
	?>	
		<h4 class="white">
			<i class="fa fa-<?php echo esc_attr($atts['icon_awesome']); ?>"></i>
			<?php 
				if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
				echo esc_html($atts['title']);
				if( $atts['link'] != '' )echo '</a>'; 
			?>
		</h4>
		<p>
			<?php print( $atts['des'] ); ?>
		</p>
	<?php	
	}	
	
	public static function sec2( $atts ){
		
		$image = $atts['image'];
		if((int)$image > 0 && ($image_url = wp_get_attachment_url( $image, 'thumbnail' )) !== false) {
	        
	    }else{
		    $image_url = THEME_URI.'/assets/images/default.png';
	    }
    
	?>	
		<div class="box">
			<img src="<?php echo esc_url( $image_url ); ?>" alt="">
			<h5>
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h5>
			<p>
				<?php print( $atts['des'] ); ?>
			</p>
		</div>
		
	<?php	
	}	
	
	public static function sec3( $atts ){
    
	?>	
		<div class="box <?php echo esc_attr( $atts['class'] ); ?>">
			<div class="ciref outline-outward left <?php if( strpos($atts['class'], 'active') !== false )echo 'active'; ?>">
				<span aria-hidden="true" class="icon-<?php echo esc_attr( $atts['icon_simple_line'] ); ?>"></span>
			</div>
			<div class="right">
				<h5>
					<?php 
						if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
						echo esc_html($atts['title']);
						if( $atts['link'] != '' )echo '</a>'; 
					?>
				</h5>
				<p>
					<?php print( $atts['des'] ); ?>
				</p>
				
			</div>
		</div>
		
	<?php	
	}
		
	public static function sec4( $atts ){
    	$image = $atts['image'];
		if((int)$image > 0 && ($image_url = wp_get_attachment_url( $image, 'thumbnail' )) !== false) {
	        
	    }else{
		    $image_url = THEME_URI.'/assets/images/default.png';
	    }
	?>	
		<div class="box <?php echo esc_attr( $atts['class'] ); ?>">
			<img src="<?php echo esc_url( $image_url ); ?>" alt="">
			<h6>
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h6>
		</div>
		
	<?php	
	}
	
	public static function sec6( $atts ){

	?>	
		<div class="ibox <?php echo esc_attr( $atts['class'] ); ?>">
			<div class="left">
				<i class="fa fa-<?php echo esc_attr( $atts['icon_awesome'] ); ?>">
				</i>
			</div>
			<div class="right">
				<h5 class="white">
					<?php 
						if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
						echo esc_html($atts['title']);
						if( $atts['link'] != '' )echo '</a>'; 
					?>
				</h5>
				<p>
					<?php echo esc_html($atts['des']); ?>
				</p>
			</div>
		</div>
		
	<?php	
	}	
	
	public static function sec7( $atts ){
		
		$image = $atts['image'];
		if((int)$image > 0 && ($image_url = wp_get_attachment_url( $image, 'thumbnail' )) !== false) {
	        
	    }else{
		    $image_url = THEME_URI.'/assets/images/default.png';
	    }
		
	?>	
		<div class="box <?php echo esc_attr( $atts['class'] ); ?>">
			<div class="ibox">
				<img src="<?php echo esc_url( $image_url ); ?>" alt="">
				<h6>
					<?php 
						if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
						echo esc_html($atts['title']);
						if( $atts['link'] != '' )echo '</a>'; 
					?>
				</h6>
			</div>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
			<a href="<?php echo esc_url($atts['link']); ?>" class="tbut">
				<?php _e('Read More', 'aaikadomain' ); ?>
			</a>
		</div>
		
	<?php	
	}
	
	public static function sec12( $atts ){
		
		$image = $atts['image'];
		if((int)$image > 0 && ($image_url = wp_get_attachment_url( $image, 'thumbnail' )) !== false) {
	        
	    }else{
		    $image_url = THEME_URI.'/assets/images/default.png';
	    }
		
	?>	
		<div class="box">
			<img src="<?php echo esc_url( $image_url ); ?>" alt="" />
			<h5>
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h5>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
			<br>
			<a href="<?php echo esc_url($atts['link']); ?>">
				<?php _e('Read More', 'aaikadomain' ); ?>
			</a>
		</div>
		
	<?php	
	}
	
	public static function sec30( $atts ) {
	
		?>
		<div class="<?php echo esc_attr($atts['class']); ?>">
			<div class="left">
				<span aria-hidden="true" class="icon-<?php echo esc_attr($atts['icon_simple_line']); ?>"></span>
			</div>
			<div class="right">
				<h5 class="light">
					<?php 
						if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
						echo esc_html($atts['title']);
						if( $atts['link'] != '' )echo '</a>'; 
					?>
				</h5>
				<p>
					<?php echo esc_html($atts['des']); ?>
				</p>
			</div>
		</div>
		
	<?php		
			
	}
		
	public static function sec32( $atts ) {
	
	?>
		<div class="box <?php echo esc_attr($atts['class']); ?>">
			<span aria-hidden="true" class="icon-<?php echo esc_attr($atts['icon_simple_line']); ?>">
			</span>
			<br>
			<br>
			<h5>
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h5>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
		</div>
	<?php		
				
	}	
		
	public static function sec33( $atts ) {
	
	?>
		<div class="<?php echo esc_attr($atts['class']); ?>">
			<?php
				if( $atts['icon_awesome'] != 'star empty' ){
					echo '<i class="fa fa-'.esc_attr($atts['icon_awesome']).'"></i>';
				}
			?>		
			<h6>
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h6>
			<?php
				if( $atts['icon_awesome'] == 'star empty' ){
					echo '<span></span><br />';
				}
			?>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
		</div>
	<?php		
			
	}
			
	public static function sec34( $atts ) {
	
		$image = $atts['image'];
		if((int)$image > 0 && ($image_url = wp_get_attachment_url( $image, 'thumbnail' )) !== false) {
	        
	    }else{
		    $image_url = THEME_URI.'/assets/images/default.png';
	    }
	    
	?>
		<div class="box <?php echo esc_attr($atts['class']); ?>">
			<img src="<?php echo esc_url( $image_url ); ?>" alt="">
			<h5>
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h5>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
		</div>
	<?php		
			
	}
				
	public static function sec35( $atts ) {
	    
	?>
		<div class="box <?php echo esc_attr($atts['class']); ?>">
			<div class="icon">
				<i class="fa fa-<?php echo esc_attr($atts['icon_awesome']); ?>">
				</i>
			</div>
			<div class="right">
				<h5 class="light">
					<?php 
						if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
						echo esc_html($atts['title']);
						if( $atts['link'] != '' )echo '</a>'; 
					?>
				</h5>
				<p>
					<?php echo esc_html($atts['des']); ?>
				</p>
			</div>
			<!-- end section -->
		</div>
	<?php		
			
	}
					
	public static function sec37( $atts ) {
	   
	   $image = $atts['image'];
		if((int)$image > 0 && ($image_url = wp_get_attachment_url( $image, 'thumbnail' )) !== false) {
	        
	    }else{
		    $image_url = THEME_URI.'/assets/images/default.png';
	    }
	     
	?>
		<div class="pop-wrapper <?php echo esc_attr($atts['class']); ?>">
			<ul>
				<li>
					<div>
						<img src="<?php echo esc_url( $image_url ); ?>" alt="">
						<h6>
							<?php 
								if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
								echo esc_html($atts['title']);
								if( $atts['link'] != '' )echo '</a>'; 
							?>
						</h6>
						<span>
							<?php echo esc_html($atts['des']); ?>
						</span>
					</div>
				</li>
			</ul>	
		</div>
	<?php		
			
	}
						
	public static function sec40( $atts ) {
	     
	?>
		<div class="ibox <?php echo esc_attr($atts['class']); ?>">
			<i class="fa fa-<?php echo esc_attr($atts['icon_awesome']); ?>"></i>
			<h6>
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h6>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
		</div>
	<?php		
			
	}
							
	public static function sec41( $atts ) {
	     
	?>
		<div class="<?php echo esc_attr($atts['class']); ?>">
			<div class="ciric">
				<span aria-hidden="true" class="icon-<?php echo esc_attr($atts['icon_simple_line']); ?>"></span>
			</div>
			<h5 class="white">
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h5>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
		</div>	
	<?php		
			
	}
								
	public static function sec44( $atts ) {
	     
	?>
		<div class="box <?php echo esc_attr($atts['class']); ?>">
			<div class="ciref2 outline-outward left <?php if( strpos($atts['class'], 'active') !== false )echo 'active'; ?>">
				<span aria-hidden="true" class="icon-<?php echo esc_attr($atts['icon_simple_line']); ?>"></span>
			</div>
			<h5>
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h5>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
		</div>	
	<?php		
			
	}
	
	public static function sec48( $atts ) {
		
		$delay = 200;
		$gdelay = 0;
		if( strpos( $atts['class'], 'delay-' ) !== false ){
			$gdelay = explode( 'delay-', $atts['class'] );
			$gdelay = intval( $gdelay[1] );
		}
	    $delay = 'animated eff-fadeInUp delay-'.($delay+$gdelay).'ms'; 
	?>
		<div class="<?php echo esc_attr($atts['class']); ?>">
			<span aria-hidden="true" class="icon-<?php echo esc_attr($atts['icon_simple_line']); ?> animated eff-rotateIn delay-<?php echo esc_attr($gdelay); ?>ms"></span>
			<h6 class="light lessmb <?php echo esc_attr($delay); ?>">
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h6>
			<div class="smlined"></div>
		</div>	
	<?php		
			
	}	
								
	public static function sec53( $atts ) {
	     
	?>
		<div class="box <?php echo esc_attr($atts['class']); ?>">
			<span aria-hidden="true" class="icon-<?php echo esc_attr($atts['icon_simple_line']); ?>">
			</span>
			<h5 class="light">
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h5>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
		</div>	
	<?php		
			
	}
									
	public static function sec62( $atts ) {
	     
	?>
		<div class="box <?php echo esc_attr($atts['class']); ?>">
			<div class="icon">
				<span aria-hidden="true" class="icon-<?php echo esc_attr($atts['icon_simple_line']); ?>"></span>
			</div>
			<div class="right">
				<h5 class="light">
					<?php 
						if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
						echo esc_html($atts['title']);
						if( $atts['link'] != '' )echo '</a>'; 
					?>
				</h5>
				<p>
					<?php echo esc_html($atts['des']); ?>
				</p>
			</div>		
		</div>
	<?php		
			
	}
										
	public static function sec63( $atts ) {
	     
	?>
		<div class="box <?php echo esc_attr($atts['class']); ?>">
			<span class="icon-<?php echo esc_attr($atts['icon_simple_line']); ?>"></span>
			<h6 class="gray">
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h6>
		</div>
	<?php		
			
	}
	
	public static function psec7( $atts ) {
	  
	  	$image = $atts['image'];
		if((int)$image > 0 && ($image_url = wp_get_attachment_url( $image, 'thumbnail' )) !== false) {
	        
	    }else{
		    $image_url = '';
	    }
	     
	?>
		<h5 class="light <?php echo esc_attr($atts['class']); ?>">
			<?php 
				if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
				echo esc_html($atts['title']);
				if( $atts['link'] != '' )echo '</a>'; 
			?>
		</h5>
		<?php
		if( $image_url != '' ){ ?>
			<img src="<?php echo esc_url($image_url); ?>" alt="" class="marb1 rimg">
		<?php 
		}
		if( $atts['des'] != '' ){ ?>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
		<?php 
		}
		if( $atts['link'] != '' ){ ?>
			<br />
			<br />
			<a href="<?php echo esc_url($atts['link']); ?>" class="but_small1">
				<?php _e( 'Read more', 'aaikadomain' ); ?>
			</a>
		<?php } ?>
	<?php		
			
	}
	
			
	public static function cbox2( $atts ){
		
		$image = $atts['image'];
		if((int)$image > 0 && ($image_url = wp_get_attachment_url( $image, 'thumbnail' )) !== false) {
	        
	    }else{
		    $image_url = THEME_URI.'/assets/images/default.png';
	    }
    
	?>	
		<div class="box">
			<img src="<?php echo esc_url( $image_url ); ?>" alt="" class="marb3 rimg">
			<h5>
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h5>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
		</div>
		
	<?php	
	}
	
				
	public static function hexagon( $atts ){
		
	?>	
		<div class="hexagon <?php echo esc_attr($atts['class']); ?>">
			<i class="fa fa-<?php echo esc_attr($atts['icon_awesome']); ?>"></i>
			<h6>
				<?php 
					if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
					echo esc_html($atts['title']);
					if( $atts['link'] != '' )echo '</a>'; 
				?>
			</h6>
			<p>
				<?php echo esc_html($atts['des']); ?>
			</p>
		</div>
		
	<?php	
	}
	
	public static function flip( $atts ) {

	?>
	
		<div class="flips3 <?php echo esc_attr($atts['class']); ?>">
			<div class="flips3_front flipscont3">
				<i class="fa fa-<?php echo esc_attr($atts['icon_awesome']); ?>"></i>
				<h5>
					<?php 
						if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
						echo esc_html($atts['title']);
						if( $atts['link'] != '' )echo '</a>'; 
					?>
				</h5>
			</div>
			<div class="flips3_back flipscont3">
				<h5 class="white">
					<?php 
						if( $atts['link'] != '' )echo '<a href="'.esc_url( $atts['link'] ).'">';
						echo esc_html($atts['title']);
						if( $atts['link'] != '' )echo '</a>'; 
					?>
				</h5>
				<p>
					<?php echo esc_html($atts['des']); ?>
				</p>
				<br>
				<a href="<?php echo esc_url($atts['link']); ?>" class="but_small5 light2">
					<i class="fa fa-<?php echo esc_attr($atts['icon_awesome']); ?>"></i>
					<?php _e( 'Read more', 'aaikadomain' ); ?>
				</a>
			</div>
		</div>
		
	<?php		
			
	}
	
	public static function flex_sliders( $content, $class ) {
	 
		$rgex = '\[(\[?)(vc_tab)(?![\w-])([^\]\/]*(?:\/(?!\])[^\]\/]*)*?)(?:(\/)\]|\](?:([^\[]*+(?:\[(?!\/\2\])[^\[]*+)*+)\[\/\2\])?)(\]?)';
		$content = preg_replace( '/'.$rgex.'/s', '<li>$5</li>', $content );
	?>
		<div class="slider ">
			<div class="flexslider carousel">
				<ul class="slides">';
					<?php echo do_shortcode( $content ); ?>
				</ul>
			</div>
		</div>
		
	<?php		
			
	}
	
	
}	