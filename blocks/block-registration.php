<?php
add_action('acf/init', 'my_acf_blocks_init');
function my_acf_blocks_init()
{

    // Check function exists.
    if (function_exists('acf_register_block_type')) {

        // Register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'popup',
            'title'             => __('Текстовый блок с всплывающим окном'),
            'description'       => __('Текстовый блок с всплывающим окном.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-popup.php',
        ));

        acf_register_block_type(array(
            'name'              => 'vertical-list',
            'title'             => __('Блок с вертикальным списком'),
            'description'       => __('Блок с вертикальным списком.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-list.php',
        ));

        acf_register_block_type(array(
            'name'              => 'parameters-list',
            'title'             => __('Блок со списком параметров'),
            'description'       => __('Блок со списком параметров.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-parameters.php',
        ));

        acf_register_block_type(array(
            'name'              => 'horizontal-list',
            'title'             => __('Блок с горизонтальным списком'),
            'description'       => __('Блок с горизонтальным списком.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-horizontal-list.php',
        ));

        acf_register_block_type(array(
            'name'              => 'youtube-block',
            'title'             => __('Блок с видео из Youtube'),
            'description'       => __('Блок с видео из Youtube.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-youtube.php',
        ));

        acf_register_block_type(array(
            'name'              => 'image-and-description',
            'title'             => __('Блок описание и изображение'),
            'description'       => __('Блок описание и изображение.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-without-list.php',
        ));
        acf_register_block_type(array(
            'name'              => 'carousel-block',
            'title'             => __('Блок со слайдером'),
            'description'       => __('Блок со слайдером.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-carousel.php',
        ));
        acf_register_block_type(array(
            'name'              => 'carousel-bg-block',
            'title'             => __('Блок с фоновым видео'),
            'description'       => __('Блок с фоновым видео.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-bg-video.php',
        ));
        acf_register_block_type(array(
            'name'              => 'image-margin-block',
            'title'             => __('Блок с изображения и отступом.'),
            'description'       => __('Блок с изображения и отступом.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-without-description-and-img.php',
        ));
        acf_register_block_type(array(
            'name'              => 'repeater-block-border',
            'title'             => __('Блок с границей.'),
            'description'       => __('Блок с границей.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-repeater-block-border.php',
        ));
        acf_register_block_type(array(
            'name'              => 'block-qr',
            'title'             => __('Блок с qr.'),
            'description'       => __('Блок с qr.'),
            'category'          => 'formatting',
            'render_template'   => 'blocks/block-qr.php',
        ));
    }
}
