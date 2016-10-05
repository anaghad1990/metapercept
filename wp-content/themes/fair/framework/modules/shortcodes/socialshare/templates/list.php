<div class="edgtf-social-share-holder edgtf-list">
	<span class="edgtf-social-share-title"><?php esc_html_e('Share: ', 'fair'); ?></span>
	<ul>
		<?php foreach ($networks as $net) {
			print $net;
		} ?>
	</ul>
</div>