<?php

include_once __DIR__ . '/currentMonth.php';

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kia
 */

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

get_header();

$models = new WP_Query(
    [
        'post_type'      => 'models',
        'post_parent'    => 0,
        'posts_per_page' => 20
    ]
);

$categories = [];

foreach ($models->posts as $model) {
    $category = get_field('category', $model->ID);
    if (!in_array($category, $categories)) {
        $categories[] = $category;
    }
}

?>
<?php
get_template_part('template-parts/breadcrumbs'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mb-40">Все модели</h1>
            </div>
        </div>
    </div>
    <section class="models models-grouped">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    foreach ($categories as $category) : ?>
                        <div class="group">
                            <div class="group-heading">
                                <h3 class="section-heading"><?= $category ?></h3>
                            </div>
                            <div class="group-models pb-60 d-flex flex-wrap">
                                <?php
                                foreach ($models->posts as $model) : ?>
                                    <?php
                                    if (get_field('category', $model->ID) === $category) : ?>
                                        <div class="swiper-slide d-flex flex-column justify-content-between model" data-option="<?= $model->post_name ?>">
                                            <div class="top">
                                                <div class="img">
                                                    <a href="<?= get_post_permalink($model->ID) ?>">
                                                        <?= get_the_post_thumbnail($model->ID, 'large') ?>
                                                    </a>
                                                </div>
                                                <div class="title">
                                                    <div class="d-flex">
                                                        <a href="<?= get_post_permalink($model->ID) ?>">
                                                            <span class="mr-2 title-content underlined underlined-black fz-18 fw-700"><?= $model->post_title ?></span>
                                                        </a>

                                                        <?php
                                                        if (get_field('is_new_model', $model->ID)) : ?>
                                                            <span class="mark-green">Новинка</span>
                                                        <?php
                                                        endif; ?>
                                                    </div>
                                                </div>
                                                <?php
                                                $priceListFileUrl = get_template_directory_uri() . '/prices/price_' . $model->post_name . '_' . $month . '.pdf';

                                                // Remote file url
                                                $handle = @fopen($priceListFileUrl, 'r'); // Check if file exist
                                                if ($handle) : ?>
                                                    <?php
                                                    $configs = json_decode(file_get_contents($link . '/wp-content/themes/kia/model_config_data/' . $model->post_name . '_details.json'));
                                                    ?>
                                                    <div class="model-row">
                                                        <div class="d-flex">
                                                            <?php
                                                            if (isset($configs[ 0 ]) && $configs[ 0 ]->price != 0) : ?>
                                                                <span class="mr-2 price-sm">от <?= $configs[ 0 ]->price ?></span>
                                                            <?php
                                                            endif; ?>
                                                            <?php
                                                            if (get_field('car_price_conditions', $model->ID)) : ?>
                                                                <svg class="info-additional conditions">
                                                                    <use xlink:href="<?php
                                                                    echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#info-circle"></use>
                                                                </svg>
                                                            <?php
                                                            endif; ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                endif; ?>
                                                <?php
                                                if (get_field('every_month_price', $model->ID)) : ?>
                                                    <div class="model-row">
                                                        <div class="d-flex">
                                                            <span class="mr-2 price-sm"><?= get_field('every_month_price', $model->ID) ?> ₸/мес</span>
                                                            <?php
                                                            if (get_field('car_credit_calc', $model->ID)) : ?>
                                                                <svg class="info-additional credit">
                                                                    <use xlink:href="<?php
                                                                    echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#info-circle"></use>
                                                                </svg>
                                                            <?php
                                                            endif; ?>
                                                        </div>
                                                    </div>
                                                <?php
                                                endif; ?>
                                                <?php
                                                if (get_field('profit', $model->ID)) : ?>
                                                    <div class="model-row">
                                                        <div class="d-flex">
                                                        <span class="mark-yellow">
                                                            Выгода до <?= get_field('profit', $model->ID) ?> ₸
                                                        </span>
                                                        </div>
                                                    </div>
                                                <?php
                                                endif; ?>

                                                <?php
                                                if (get_field('car_price_conditions', $model->ID)) : ?>
                                                    <div class="model-conditions">
                                                        <?= get_field('car_price_conditions', $model->ID) ?>
                                                    </div>
                                                <?php
                                                endif; ?>

                                                <?php
                                                if (get_field('car_credit_calc', $model->ID)) : ?>
                                                    <div class="model-credit">
                                                        <?= get_field('car_credit_calc', $model->ID) ?>
                                                    </div>
                                                <?php
                                                endif; ?>
                                            </div>
                                            <div class="bottom">
                                                <div class="model-row justify-content-end">
                                                    <div class="d-flex links">
                                                        <?php
                                                        if (get_field('show_or_hide_price_models', $model->ID)) : ?>
                                                            <a href="<?= get_post_permalink($model->ID) . 'complectations' ?>" class="underlined underlined-black readmore">
                                                                Цены
                                                            </a>
                                                        <?php
                                                        endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    endif; ?>
                                <?php
                                endforeach; ?>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
