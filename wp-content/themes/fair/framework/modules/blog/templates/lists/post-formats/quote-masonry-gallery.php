<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-mark edgtf-quote-mark">
			<span>&rdquo;</span>
		</div>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<h4 class="edgtf-post-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_post_meta(get_the_ID(), "edgtf_post_quote_text_meta", true)); ?></a>
				</h4>
				<?php echo fair_edge_get_separator_html(array('position'=>'center'));?>
				<span class="edgtf-quote-author"><?php the_title(); ?></span>
			</div>
		</div>
		<a class="edgtf-blog-masonry-gallery-link" href="<?php the_permalink(); ?>"></a>
	</div>
</article>