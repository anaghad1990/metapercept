<?php
	$author_info_box = esc_attr(fair_edge_options()->getOptionValue('blog_author_info'));
	$author_info_email = esc_attr(fair_edge_options()->getOptionValue('blog_author_info_email'));
?>
<?php if($author_info_box === 'yes') { ?>
	<div class="edgtf-author-description">
		<div class="edgtf-author-description-inner clearfix">
			<div class="edgtf-author-description-image">
				<?php echo fair_edge_kses_img(get_avatar(get_the_author_meta( 'ID' ), 165)); ?>
			</div>
			<div class="edgtf-author-description-text-holder">
				<h4 class="edgtf-author-name">
					<?php
						if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
							echo esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
						} else {
							echo esc_attr(get_the_author_meta('display_name'));
						}
					?>
				</h4>
				<?php if($author_info_email === 'yes' && is_email(get_the_author_meta('email'))){ ?>
					<p class="edgtf-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
				<?php } ?>
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="edgtf-author-text">
						<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>