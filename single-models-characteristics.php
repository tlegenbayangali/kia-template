<?php

get_header();
$parent_post = get_post($post->post_parent);
$parent_post_id = get_post()->post_parent;

// Program to display URL of current page.
if (isset($_SERVER[ 'HTTPS' ]) && $_SERVER[ 'HTTPS' ] === 'on') {
    $link = "https";
} else {
    $link = "http";
}

// Here append the common URL characters.
$link .= "://";

// Append the host(domain name, ip) to the URL.
$link .= $_SERVER[ 'HTTP_HOST' ];

?>
<?php
get_template_part('template-parts/content', 'header-models', ['parent_post' => $parent_post,]); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs equip-breadcrumbs d-flex justify-content-between">
                    <?php
                    if (function_exists('kama_breadcrumbs')) {
                        kama_breadcrumbs();
                    } ?>
                    <div class="equip-breadcrumbs-right d-flex align-items-md-center">
                        <?php
                        if (get_field('model_price_list', $parent_post_id)) : ?>
                            <div class="equip-breadcrumbs-right-price">
                                <a target="_blank" class="d-flex align-items-center underlined underlined-black" href="<?= get_field('model_price_list', $parent_post_id)[ 'url' ] ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="mr-1" data-v-bee0cc60="">
                                        <path d="M2.75.75h9.94l4.56 4.56v13.94H2.75V.75z" stroke="currentColor" stroke-width="1.5" data-v-bee0cc60=""></path>
                                        <path d="M12.5 1v5h4" stroke="currentColor" stroke-width="1.5" data-v-bee0cc60="">
                                        </path>
                                    </svg>
                                    Скачать прайс-лист
                                </a>
                            </div>
                        <?php
                        endif; ?>
                        <?php
                        if (get_field('brochure', $parent_post_id)) : ?>
                            <div class="equip-breadcrumbs-right-price">
                                <a class="d-flex align-items-center underlined underlined-black" href="<?= get_field('brochure', $parent_post_id)[ 'url' ] ?>">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="mr-1" data-v-bee0cc60="">
                                        <path d="M2.75.75h9.94l4.56 4.56v13.94H2.75V.75z" stroke="currentColor" stroke-width="1.5" data-v-bee0cc60=""></path>
                                        <path d="M12.5 1v5h4" stroke="currentColor" stroke-width="1.5" data-v-bee0cc60="">
                                        </path>
                                    </svg>
                                    Скачать брошюру
                                </a>
                            </div>
                        <?php
                        endif; ?>
                        <div class="equip-breadcrumbs-right-call">
                            <a class="d-flex align-items-center underlined underlined-black" href="/callback/?current_model=<?= $parent_post->post_name ?>">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="mr-1" data-v-3802aeb3="">
                                    <path d="M2.494 3.506l1.299-1.299a1 1 0 011.414 0l2.66 2.66A1 1 0 017.941 6.2l-.681.851c-.467.584-.583 1.388-.203 2.032 1.318 2.23 3.191 3.5 4.511 4.086.57.254 1.218.103 1.706-.287l1.027-.822a1 1 0 011.332.074l2.603 2.603a1 1 0 01-.056 1.467l-1.691 1.45c-.63.54-1.46.82-2.286.734-1.801-.19-4.602-.786-7.703-3.887-3.716-3.716-4.577-6.634-4.855-8.603-.125-.882.219-1.761.849-2.39zM11 5c1.333 0 4 .8 4 4M10 2c2.667 0 8 1.6 8 8" stroke="currentColor" stroke-width="1.5" data-v-3802aeb3="">
                                    </path>
                                </svg>
                                Обратная связь
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
$post_data = get_post($post->post_parent);
$parent_slug = $post_data->post_name;

$configs = new WP_Query(
    [
        'post_type'      => 'configs',
        'model'          => $parent_slug,
        'posts_per_page' => -1,
        'meta_key'       => 'price',
        'order'          => 'ASC',
        'orderby'        => ['meta_value_num' => 'ASC'],
    ]
);

$prices_array = [];

foreach ($configs->posts as $post) :
    $prices_array[] = get_field('price', $post->ID);
endforeach;
if (count($prices_array) > 1) :
    $model_min_price = min(...$prices_array);
else :
    $model_min_price = $prices_array[ 0 ];
endif;
$GLOBALS[ 'model_min_price' ] = $model_min_price;
// wp_reset_query();
?>
    <div class="equip-hero">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="equip-hero-inner">
                        <div class="equip-hero-title">
                        <span class="d-block">
                            Характеристики <?php
                            echo esc_html(get_the_title($parent_post_id)); ?>
                        </span>
                        </div>
                        <div class="equip-hero-min-price">
                            Минимальная цена
                        </div>
                        <div class="equip-hero-min-price-val d-flex align-items-center">
                        <span class="val">
                            <?= get_field('starting_price', $post_data->ID) ?> ₸
                        </span>
                            <span class="equip-hero-min-price-info d-block">
                            <svg class="info">
                                <use xlink:href="images/dist/sprite.svg#info"></use>
                            </svg>
                        </span>
                        </div>
                        <div class="equip-hero-banner">
                            <img src="<?php
                            the_field('bottom_section_car_image_medium', $parent_post_id); ?>" alt="banner">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="equip-wrapper">
        <div class="equip-inner">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- WILL BE FIXED-->
                        <div class="equip-header">
                            <!-- HEADER-->
                            <div class="equip-variants">
                                <div class="equip-variants-carousel">
                                    <!-- SWIPER INNER CONTAINER-->
                                    <div class="equip-variants-container swiper-container">
                                        <div class="equip-variants-wrapper swiper-wrapper">
                                            <?php
                                            $configs = json_decode(file_get_contents($link . '/wp-content/themes/kia/model_config_data/' . $parent_slug . '_details.json')) ?>
                                            <?php
                                            foreach ($configs as $config) : ?>
                                                <div class="equip-variants-slide swiper-slide d-flex flex-column justify-content-between">
                                                    <div>
                                                        <a class="equip-variants-slide-title d-flex align-items-center" href="#">
                                                            <span><?= $config->title ?></span>
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                                                <path d="M8.5 14l4-4-4-4" stroke="currentColor" stroke-width="2"></path>
                                                            </svg>
                                                        </a>
                                                        <div class="equip-variants-slide-desc">
                                                            <span class="d-block equip-variants-slide-param">
                                                                <?= $config->years->model_year ?>
                                                            </span>
                                                            <span class="d-block equip-variants-slide-param">
                                                                <?= $config->years->manufacture_year ?>
                                                            </span>
                                                            <span class="d-block equip-variants-slide-param">
                                                                <?= $config->tech_characteristics ?>
                                                            </span>
                                                            <span class="d-block equip-variants-slide-price">
                                                                <?= $config->price ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            endforeach; ?>
                                        </div>
                                    </div>
                                    <!-- SWIPER ARROWS-->
                                    <div class="equip-variants-carousel-arrows">
                                        <div class="equip-variants-carousel-right-arrow equip-variants-carousel-arrow">
                                            <svg width="15" height="14" viewBox="0 0 21 20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                                <path d="M13 16l6-6-6-6M18.5 10H0" stroke-width="1.5">
                                                </path>
                                            </svg>
                                        </div>
                                        <div class="equip-variants-carousel-left-arrow
                                    equip-variants-carousel-arrow">
                                            <svg width="15" height="14" viewBox="0 0 21 20" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                                <path d="M8 4l-6 6 6 6M2.5 10H21" stroke-width="1.5">
                                                </path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (true): ?>
                    <div class="equip-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- TOP PADDING-->
                                <div class="equip-header-top-padding">
                                </div>
                                <div class="equip-content-inner">
                                    <?php
                                    $options = json_decode(file_get_contents($link . '/wp-content/themes/kia/model_config_data/' . $parent_slug . '_props.json'));
                                    ?>

                                    <?php
                                    if (count($options)) : ?>
                                        <?php
                                        foreach ($options as $option_type) : ?>
                                            <div class="equip-config">
                                                <!-- ONE SECTION -->
                                                <section class="equip-config-section">
                                                    <!-- MAIN TITLE-->
                                                    <h2 class="equip-config-section-title">
                                                        <?= $option_type->options_category ?>
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                                        </svg>
                                                    </h2>
                                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                                    <div class="equip-config-section-items">
                                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                                        <?php
                                                        foreach ($option_type->options as $option) : ?>
                                                            <div class="equip-config-section-item">
                                                                <div class="equip-config-section-item-header">
                                                                    <?= $option->option_title ?>
                                                                </div>
                                                                <div class="equip-config-section-item-carousel">
                                                                    <!-- SWIPER STARTS-->
                                                                    <div class="swiper-container equip-config-section-item-carousel-container">
                                                                        <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                                            <?php
                                                                            foreach ($option->available_on_config as $config) : ?>
                                                                                <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                                    <div>
                                                                                        <?php
                                                                                        if ($config) : ?>
                                                                                            <?php
                                                                                            if (is_bool($config)): ?>
                                                                                                <svg>
                                                                                                    <use xlink:href="<?php
                                                                                                    echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                                                </svg>
                                                                                            <?php
                                                                                            else: ?>
                                                                                                <?= $config ?>
                                                                                            <?php
                                                                                            endif; ?>
                                                                                        <?php
                                                                                        else : ?>
                                                                                            <span class="d-block"> — </span>
                                                                                        <?php
                                                                                        endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            <?php
                                                                            endforeach; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        endforeach; ?>
                                                    </div>
                                                </section>
                                            </div>
                                        <?php
                                        endforeach; ?>
                                    <?php
                                    else: ?>
                                        <p style="display: block; padding: 30px 0;">Информация в разработке...</p>
                                    <?php
                                    endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                else: ?>
                    <p style="display: block; padding: 30px 0;">Информация в разработке...</p>
                <?php
                endif; ?>
            </div>
        </div>
    </div>
<?php
get_footer(); ?>