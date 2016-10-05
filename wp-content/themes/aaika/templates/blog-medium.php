<?php
/**
 * (c) www.king-theme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $devn;

get_header();

?>

	<?php $devn->breadcrumb(); ?>

	<div id="primary" class="site-content container-content content ">
		<div id="content" class="row row-content container">
			<div class="col-md-9">
				<?php
					
					$i = 0;
					while ( have_posts() ) : the_post();
					
						$i++;
						
						echo '<div class="content_halfsite';
						if( $i%2 == 0 )echo ' last';
						echo '">';
						
							get_template_part( 'content', get_post_format() );
						
						echo '</div>';
						
					endwhile;
					
				?>
			</div>
			<div class="col-md-3">
				<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
					<div id="sidebar" class="widget-area devn-sidebar">
						<?php dynamic_sidebar( 'sidebar' ); ?>
					</div><!-- #secondary -->
				<?php endif; ?>
			</div>
		</div>
	</div>
				
<?php get_footer(); ?>		



		