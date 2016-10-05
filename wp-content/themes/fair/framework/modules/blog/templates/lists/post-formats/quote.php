<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<div class="edgtf-post-mark edgtf-quote-mark">
					<span>&rdquo;</span>
				</div>
				<div class="edgtf-ql-content">
					<h4 class="edgtf-post-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "edgtf_post_quote_text_meta", true)); ?></a>
					</h4>
					<?php echo fair_edge_get_separator_html(array());?>
					<span class="edgtf-quote-author">&mdash; <?php the_title(); ?></span>
					<?php if ($type == 'standard') { ?>
					<div class="edgtf-post-info">
						<div class="edgtf-post-info-top">
							<?php fair_edge_post_info(array('category' => 'yes', 'date' => 'yes')) ?>
						</div>
						<?php if((has_tag() || fair_edge_get_social_share_html() != '') && $type == 'standard') : ?>
							<div class="edgtf-post-info-bottom">
								<div class="edgtf-post-info-bottom-left">
									<?php has_tag() ? the_tags('', ', ', '') : ''; ?>
								</div>
								<div class="edgtf-post-info-bottom-right">
									<?php fair_edge_post_info(array('share' => 'yes')) ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</article>