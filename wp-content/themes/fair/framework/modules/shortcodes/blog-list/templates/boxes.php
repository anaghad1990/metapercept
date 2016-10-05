<li class="edgtf-blog-list-item clearfix">
	<div class="edgtf-blog-list-item-inner">
		<?php if ($show_image == 'yes') { ?>
			<div class="edgtf-item-image">
				<a href="<?php the_permalink(); ?>">
					<?php
						 echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
					?>
				</a>
			</div>
		<?php } ?>
		<div class="edgtf-item-text-holder">
			<?php if ($show_categories == 'yes') { ?>
				<h5 class="edgtf-item-categories-section">
					<span class="edgtf-post-info-category">
						<?php the_category(', '); ?>
					</span>
				</h5>
			<?php } ?>
			<div class="edgtf-item-title-holder">
				<<?php echo esc_html( $title_tag)?> class="edgtf-item-title">
					<a href="<?php echo esc_url(get_permalink()) ?>" >
						<?php echo esc_attr(get_the_title()) ?>
					</a>
				</<?php echo esc_html($title_tag) ?>>
				
				<?php 
				if ($show_separator == 'yes') {
					echo fair_edge_get_separator_html(array());
				}
				?>
			</div>
			<?php if ($text_length != '0') {
				$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
				<p class="edgtf-excerpt"><?php echo esc_html($excerpt)?>...</p>
			<?php } ?>
			<div class="edgtf-blog-slide-info-line-holder"><div class="edgtf-blog-slide-info-line"></div></div>
			<div class="edgtf-item-info-section">
				<?php fair_edge_post_info(array(
					'date' => 'yes'
				)) ?>
			</div>
		</div>
	</div>	
</li>