<?php if(!empty($lightbox)) : ?>
    <a title="<?php echo esc_attr($media['title']); ?>" data-rel="prettyPhoto[single_pretty_photo]" href="<?php echo esc_url($media['image_url']); ?>">
<?php endif; ?>

    <img src="<?php echo esc_url($media['image_url']); ?>" alt="<?php echo esc_attr($media['description']); ?>" />

<?php if(!empty($lightbox)) : ?>
    </a>
<?php endif; ?>
