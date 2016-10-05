<?php
$icon_html = fair_edge_icon_collections()->renderIcon($icon, $icon_pack, $params);
?>
<div class="edgtf-item <?php echo esc_attr($item_showcase_list_item_class); ?>">
	<?php if (!empty($icon)) { ?>
		<div class="edgtf-item-icon">
			<?php
			print $icon_html;
			?>
		</div>
	<?php } ?>
	<div class="edgtf-item-content">
		<?php if ($item_title != '') { ?>
		<div class="edgtf-showcase-title-holder">
			<h5 class="edgtf-showcase-title">
				<?php if ($item_link != '' ) { ?>
					<a href="<?php echo esc_url($item_link) ?>" target="_blank">
				<?php } ?>
					<?php echo esc_attr($item_title) ?>
				<?php if ($item_link != '' ) { ?>
					</a>
				<?php } ?>
			</h5>
		</div>
		<?php } if ($item_text != '') { ?>
		<div class="edgtf-showcase-text-holder">
			<p class="edgtf-showcase-text"><?php echo esc_attr($item_text) ?></p>
		</div>
		<?php } ?>
	</div>
</div>