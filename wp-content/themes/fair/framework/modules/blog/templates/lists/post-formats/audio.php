<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="edgtf-post-content">
		<?php if (!$soundcloud) {
			fair_edge_get_module_template_part('templates/lists/parts/image', 'blog');
		} ?>
		<?php fair_edge_get_module_template_part('templates/parts/audio', 'blog'); ?>
		<div class="edgtf-post-text">
			<div class="edgtf-post-text-inner">
				<?php fair_edge_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
				<?php echo fair_edge_get_separator_html(array());?>
				<?php  if ($type == 'standard-whole-post') {
					the_content();
				}
				else{
					fair_edge_excerpt($excerpt_length);
				}
				?>
				<?php fair_edge_get_module_template_part('templates/lists/parts/pages-navigation', 'blog');  ?>
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
			</div>
		</div>
	</div>
</article>