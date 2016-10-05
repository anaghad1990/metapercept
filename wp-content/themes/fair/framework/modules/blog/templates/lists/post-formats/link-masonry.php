<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<div class="edgtf-post-mark edgtf-link-mark">
					<span class="icon_link"></span>
				</div>
				<div class="edgtf-ql-content">
					<?php fair_edge_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
					<div class="edgtf-blog-slide-info-line-holder"><div class="edgtf-blog-slide-info-line"></div></div>
					<div class="edgtf-post-info">
						<div class="edgtf-post-info-top">
							<?php fair_edge_post_info(array('author' => 'yes','category' => 'yes', 'date' => 'yes')) ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>