<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php fair_edge_inline_style($button_styles); ?> <?php fair_edge_class_attribute($button_classes); ?> <?php echo fair_edge_get_inline_attrs($button_data); ?> <?php echo fair_edge_get_inline_attrs($button_custom_attrs); ?>>
    <span class="edgtf-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo fair_edge_icon_collections()->renderIcon($icon, $icon_pack); ?>
</a>