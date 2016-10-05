<div <?php post_class('edgtf-article-top-part'); ?>>
	<div class="edgtf-post-image">
		<?php the_post_thumbnail('full'); ?>
	</div>
	<div class="edgtf-article-top-part-inner">
		<div class="edgtf-article-top-part-text">
			<div class="edgtf-article-top-part-text-inner">
				<div class="edgtf-grid-section">
					<div class="edgtf-section-inner">
						<span class="edgtf-post-top-category"><?php the_category(', '); ?></span>
						<h1><?php the_title(); ?></h1>
						<span class="edgtf-post-top-date">
							<?php the_time(get_option('date_format')); ?>
						</span>
						<?php echo fair_edge_get_separator_html(array('position' => 'center')); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>