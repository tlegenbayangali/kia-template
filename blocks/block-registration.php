<?php
add_action('acf/init', 'my_acf_blocks_init');
function my_acf_blocks_init() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

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
    }
}