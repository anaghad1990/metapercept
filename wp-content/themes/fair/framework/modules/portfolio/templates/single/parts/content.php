<div class="edgtf-portfolio-info-item edgtf-content-item">
	<?php if($params['type'] !== 'big-images' && $params['type'] !== 'big-slider' && $params['type'] !== 'big-images-bottom' && $params['type'] !== 'big-masonry' && $params['type'] !== 'full-width-images' && $params['type'] !== 'gallery'): ?>
    	<h3 class="edgtf-portfolio-title"><?php the_title(); ?></h3>
		<?php echo fair_edge_execute_shortcode('edgtf_separator',array()); ?>
	<?php endif; ?>
    <div class="edgtf-portfolio-content">
        <?php the_content(); ?>
    </div>
</div>