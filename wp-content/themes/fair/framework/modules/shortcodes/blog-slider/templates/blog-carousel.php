<div class="edgtf-blog-carousel-item">
	<?php if($show_image != 'no' && has_post_thumbnail()) { ?>
		<div class="edgtf-blog-slide-image">
				<a href="<?php the_permalink(); ?>">
					<?php
                        the_post_thumbnail($image_size);
                    ?>
				</a>
		</div>
	<?php } ?>
	<div class="edgtf-blog-slide-info-holder clearfix">
		<?php if ($show_categories == 'yes') { ?>
			<h5 class="edgtf-item-categories-section">
				<span class="edgtf-post-info-category">
					<?php the_category(', '); ?>
				</span>
			</h5>
		<?php } ?>
		<div class="edgtf-item-title-holder">
			<h4 class="edgtf-blog-slide-title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h4>

			<?php 
			if ($show_separator == 'yes') {
				echo fair_edge_get_separator_html(array());
			}
			?>
		</div>
		<?php if ($text_length != '0') {
			$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
			<p class="edgtf-blog-slide-excerpt"><?php echo esc_html($excerpt)?>...</p>
		<?php } ?>
		<div class="edgtf-blog-slide-info-line-holder"><div class="edgtf-blog-slide-info-line"></div></div>
		<div class="edgtf-blog-slide-post-info">
			<?php fair_edge_post_info(array('date' => 'yes')) ?>
		</div>
	</div>
</div>