<?php
if(get_post_meta(get_the_ID(), "edgtf_audio_post_type_meta", true) == 'self' && get_post_meta(get_the_ID(), "edgtf_post_audio_link_meta", true) !== ""){ ?>
	<div class="edgtf-blog-audio-holder">
		<audio class="edgtf-blog-audio" src="<?php echo esc_url(get_post_meta(get_the_ID(), "edgtf_post_audio_link_meta", true)) ?>" controls="controls">
			<?php esc_html_e("Your browser don't support audio player","fair"); ?>
		</audio>
	</div>
<?php } else if(get_post_meta(get_the_ID(), "edgtf_audio_post_type_meta", true) == 'soundcloud' && get_post_meta(get_the_ID(), "edgtf_post_audio_soundcloud_link_meta", true) !== ""){ ?>
	<?php fair_edge_get_module_template_part('templates/parts/soundcloud', 'blog'); ?>
<?php } ?>