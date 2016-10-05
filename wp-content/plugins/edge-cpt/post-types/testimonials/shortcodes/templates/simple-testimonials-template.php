<div class="edgtf-testimonial-content edgtf-testimonials<?php echo esc_attr($current_id) ?>">
	<?php if (has_post_thumbnail($current_id)) { ?>
		<div class="edgtf-testimonial-image-holder">
			<?php esc_html(the_post_thumbnail($current_id)) ?>
		</div>
	<?php } ?>
	<div class="edgtf-testimonial-content-inner">
		<div class="edgtf-testimonial-text-holder">
			<div class="edgtf-testimonial-text-inner">
				<?php if($show_title == "yes" && $title != ''){ ?>
					<h3 class="edgtf-testimonial-title">
						<?php echo esc_attr($title) ?>
					</h3>
				<?php }?>
				<p class="edgtf-testimonial-text"><?php echo trim($text) ?></p>
				<?php if ($show_author == "yes") { ?>
					<div class = "edgtf-testimonial-author">
						<h6 class="edgtf-testimonial-author-text"><?php echo esc_attr($author)?>
							<?php if($show_position == "yes" && $job !== ''){ ?>
								<span class="edgtf-testimonials-job"> - <?php echo esc_attr($job)?></span>
							<?php }?>
						</h6>
					</div>
				<?php } ?>				
			</div>
		</div>
	</div>	
</div>
