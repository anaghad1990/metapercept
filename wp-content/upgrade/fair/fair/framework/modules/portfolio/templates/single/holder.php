<?php $type = fair_edge_get_portfolio_single_type(); ?>
<?php if(have_posts()): while(have_posts()) : the_post(); ?>
	<div <?php fair_edge_class_attribute($holder_class); ?>>
	<?php if($fullwidth || $type === 'split-screen' || $type === 'full-width-images') : ?>
		<div class="edgtf-full-width">
		    <div class="edgtf-full-width-inner">
		<?php else: ?>
		<div class="edgtf-container">
		    <div class="edgtf-container-inner clearfix">
		<?php endif; ?>
	            <?php if(post_password_required()) {
	                echo get_the_password_form();
	            } else {
	                //load proper portfolio template
	                fair_edge_get_module_template_part('templates/single/single', 'portfolio', $portfolio_template);
	            } ?>
				<?php
					//load portfolio comments
					fair_edge_get_module_template_part('templates/single/parts/comments', 'portfolio');
				?>
	        </div>
	    </div>
		<?php
			//load portfolio navigation
			fair_edge_get_module_template_part('templates/single/parts/navigation', 'portfolio');

		?>
	</div>
<?php
	endwhile;
	endif;
?>