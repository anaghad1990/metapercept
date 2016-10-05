<?php do_action('fair_edge_before_site_logo'); ?>

<div class="edgtf-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php fair_edge_inline_style($logo_styles); ?>>
        <img class="edgtf-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="<?php esc_html_e('logo','fair'); ?>"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="edgtf-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="<?php esc_html_e('dark logo','fair'); ?>o"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="edgtf-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="<?php esc_html_e('light logo','fair'); ?>"/><?php } ?>
    </a>
</div>

<?php do_action('fair_edge_after_site_logo'); ?>