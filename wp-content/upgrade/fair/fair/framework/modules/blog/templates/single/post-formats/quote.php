<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-mark edgtf-quote-mark">
			<span>&rdquo;</span>
		</div>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner clearfix">
				<h3 class="edgtf-post-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "edgtf_post_quote_text_meta", true)); ?></a>
				</h3>
				<?php echo fair_edge_get_separator_html(array());?>
				<span class="edgtf-quote-author">&mdash; <?php the_title(); ?></span>
			</div>
		</div>
		<?php the_content(); ?>
		<?php fair_edge_get_module_template_part('templates/lists/parts/pages-navigation', 'blog');  ?>
		<?php if(has_tag() || fair_edge_get_social_share_html() != '') : ?>
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
</article>