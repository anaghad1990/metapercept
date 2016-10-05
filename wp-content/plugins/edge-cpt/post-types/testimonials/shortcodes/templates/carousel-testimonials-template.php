<div class="edgtf-testimonial-content edgtf-testimonials<?php echo esc_attr($current_id) ?>">
	<div class="edgtf-testimonial-content-inner">
		<div class="edgtf-testimonial-text-holder">
			<div class="edgtf-testimonial-text-inner">
				<?php if($show_title == "yes" && $title != ''){ ?>
					<h4 class="edgtf-testimonial-title">
						<?php echo esc_attr($title) ?>
					</h4>
				<?php }?>
				<p class="edgtf-testimonial-text"><?php echo trim($text) ?></p>
			</div>
			<span class="edgtf-testimonial-arrow"></span>
		</div>
		<div class="edgtf-testimonial-carousel-bottom">
			<?php if (has_post_thumbnail($current_id)) { ?>
				<div class="edgtf-testimonial-image-holder">
					<?php esc_html(the_post_thumbnail($current_id)) ?>
				</div>
			<?php } ?>
			<?php if ($show_author == "yes") { ?>
				<div class = "edgtf-testimonial-author">
					<h6 class="edgtf-testimonial-author-text">
						<?php echo esc_attr($author)?>
					</h6>
					<?php if($show_position == "yes" && $job !== ''){ ?>
						<span class="edgtf-testimonials-job"><?php echo esc_attr($job)?></span>
					<?php }?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
