<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kia
 */

get_header();
?>

<?php
if (get_field('main_slider_slides', 'options')) : ?>
    <div class="hero">
        <!-- Slider main container -->
        <div class="pos-r hero-slider-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <?php
                foreach (get_field('main_slider_slides', 'options') as $slide) : ?>
                    <div class="swiper-slide">
                        <div class="hero-slider-item">
                            <div class="img">
                                <?php
                                echo wp_get_attachment_image($slide[ 'main_slider_slide_image' ], 'full'); ?>
                            </div>
                            <div class="info d-flex justify-content-between flex-column">
                                <div class="info-top">
                                    <div class="slider-heading">
                                        <?php
                                        echo $slide[ 'main_slider_slide_heading' ] ?>
                                    </div>
                                    <span class="slider-description">
								<?php
                                echo $slide[ 'main_slider_slide_description' ] ?>
                            </span>
                                </div>
                                <div class="info-bottom">
                                    <div class="btn-wrapper btn-wrapper-lg btn-wrapper-white">
                                        <a href="<?= $slide[ 'main_slider_slide_button' ][ 'main_slider_slide_button_link' ] ?>" class="btn">
                                            <?php
                                            echo $slide[ 'main_slider_slide_button' ][ 'main_slider_slide_button_text' ] ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach; ?>
            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <button class="arrow arrow-prev swiper-button-prev">
                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                     xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                    <path d="M8 4l-6 6 6 6M2.5 10H21" stroke="currentColor" stroke-width="1.5"></path>
                </svg>
            </button>
            <button class="arrow arrow-next swiper-button-next">
                <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                     xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                    <path d="M13 16l6-6-6-6M18.5 10H0" stroke="currentColor" stroke-width="1.5"></path>
                </svg>
            </button>
        </div>

    </div>
<?php
endif; ?>

<?php
if (get_field('is_models_slider', 'options')) : ?>
    <?php
    $models = new WP_Query([
        'post_type'   => 'models',
        'post_parent' => 0
    ]);
    ?>
    <section class="models section pt-80 pb-80">
        <div class="overflow-fix-y">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="section-heading"><?php
                            the_field('models_slider_heading', 'options') ?></h1>
                    </div>
                </div>

                <?php
                if (get_field('is_models_slider_filter', 'options')) : ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dalacode-selector mb-8" data-container="models-container">
                                <input value="Все модели" type="text" hidden="true">
                                <div class="current d-flex justify-content-between align-items-center">
                                    <span></span>
                                    <svg>
                                        <use xlink:href="<?php
                                        echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#arrow-right"></use>
                                    </svg>
                                </div>
                                <div class="options">
                                    <ul>
                                        <li data-option="all">
                                            Все модели
                                        </li>
                                        <?php
                                        foreach ($models->posts as $model) : ?>
                                            <li data-option="<?= $model->post_name ?>">
                                                <?= $model->post_title ?>
                                            </li>
                                        <?php
                                        endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endif; ?>

            </div>
            <!-- Slider main container -->
            <div class="container-fluid">
                <div class="pos-r models-container dalacode-slider">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        <?php
                        foreach ($models->posts as $model) : ?>
                            <div class="swiper-slide d-flex flex-column justify-content-between model" data-option="<?= $model->post_name ?>">
                                <div class="top">
                                    <div class="img">
                                        <a href="<?= get_post_permalink($model->ID) ?>">
                                            <?= get_the_post_thumbnail($model->ID, 'full') ?>
                                        </a>
                                    </div>
                                    <div class="title">
                                        <div class="d-flex">
                                            <a href="<?= get_post_permalink($model->ID) ?>">
                                                <span class="title-content underlined mr-2 underlined-black fz-18 fw-700"><?= $model->post_title ?></span>
                                            </a>

                                            <?php
                                            if (get_field('is_new_model', $model->ID)) : ?>
                                                <span class="mark-green">Новинка</span>
                                            <?php
                                            endif; ?>
                                        </div>
                                    </div>
                                    <div class="model-row">
                                        <div class="d-flex">
                                            <span class="price-sm mr-2">от <?= get_field('starting_price',
                                                    $model->ID) ?> ₸</span>
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
                                    if (get_field('every_month_price', $model->ID)) : ?>
                                        <div class="model-row">
                                            <div class="d-flex">
                                                <span class="price-sm mr-2"><?= get_field('every_month_price',
                                                        $model->ID) ?> ₸/мес</span>
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
                                            <a href="<?= get_post_permalink($model->ID) ?>" class="underlined underlined-black readmore">
                                                О модели
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endforeach; ?>
                    </div>

                    <!-- If we need navigation buttons -->
                    <button class="arrow arrow-prev swiper-button-prev">
                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                             xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                            <path d="M8 4l-6 6 6 6M2.5 10H21" stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                    </button>
                    <button class="arrow arrow-next swiper-button-next">
                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                             xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                            <path d="M13 16l6-6-6-6M18.5 10H0" stroke="currentColor" stroke-width="1.5"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
<?php
endif; ?>

<?php
if (get_field('is_online_services', 'options')) : ?>
    <section class="service section pt-80 pb-80">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="section-heading">Онлайн сервисы</h4>
                    <div class="pos-r dalacode-slider">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php

                            $online_services = new WP_Query([
                                'post_type' => 'online-services',
                                'order'     => 'ASC',
                                'orderby'   => 'ID'
                            ]);

                            foreach ($online_services->posts as $service) :

                                ?>
                                <div class="swiper-slide d-flex flex-column justify-content-between services-item">
                                    <a href="<?= get_post_permalink($service->ID) ?>" class="service-block">
                                <span class="service-img">
									<?= get_the_post_thumbnail($service->ID, 'full') ?>
                                </span>
                                        <span class="service-text">
                                    <?= $service->post_title ?>
                                </span>
                                    </a>
                                </div>
                            <?php
                            endforeach; ?>
                        </div>
                        <button class="arrow arrow-prev swiper-button-prev">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                <path d="M8 4l-6 6 6 6M2.5 10H21" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                        <button class="arrow arrow-next swiper-button-next">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                <path d="M13 16l6-6-6-6M18.5 10H0" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
endif; ?>

<?php
if (get_field('is_available_cars', 'options')) : ?>
    <?php

    $cars = new WP_Query([
        'post_type'      => 'configs',
        'orderby'        => 'rand',
        'posts_per_page' => 100
    ]);

    $available_cars = [];

    foreach ($cars->posts as $car) {
        if (get_field('is_available_car', $car->ID)) {
            array_push($available_cars, $car);
        }
    }

    ?>
    <section class="models section pt-80 pb-80">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="section-heading">Авто в наличии</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="dalacode-selector mb-8" data-container="available-models-slider">
                        <input value="Все модели" type="text" hidden="true">
                        <div class="current d-flex justify-content-between align-items-center">
                            <span></span>
                            <svg class="info-aditional">
                                <use xlink:href="<?php
                                echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#arrow-right"></use>
                            </svg>
                        </div>
                        <div class="options">
                            <ul>
                                <li data-option="all">
                                    Все модели
                                </li>
                                <?php
                                $models = [];
                                foreach ($available_cars as $car) :
                                    $terms = wp_get_post_terms($car->ID, 'model');
                                    ?>
                                    <?php
                                    if (!in_array($terms[ 0 ]->name, $models)) :
                                        array_push($models, $terms[ 0 ]->name); ?>
                                        <li data-option="<?= $terms[ 0 ]->slug ?>">
                                            <?= $terms[ 0 ]->name ?>
                                        </li>
                                    <?php
                                    endif; ?>
                                <?php
                                endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Slider main container -->
        <div class="container-fluid">
            <div class="pos-r available-models-slider dalacode-slider">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php
                    foreach ($available_cars as $car) :
                        $terms = wp_get_post_terms($car->ID, 'model');
                        ?>
                        <div class="swiper-slide d-flex flex-column justify-content-between model model-wide" data-option="<?= $terms[ 0 ]->slug ?>">
                            <div class="top">
                                <div class="img">
                                    <a class="d-block" href="<?= get_the_permalink($car->ID) ?>">
                                        <?= get_the_post_thumbnail($car->ID, 'full') ?>
                                    </a>
                                </div>
                                <div class="title">
                                    <div class="d-flex">
                                        <a href="<?= get_the_permalink($car->ID) ?>">
                                            <span class="underlined mr-2 underlined-black fz-18 fw-700"><?= $terms[ 0 ]->name ?> <?= $car->post_title ?></span>
                                        </a>
                                    </div>
                                </div>
                                <?php
                                if (get_field('short_description', $car->ID)) : ?>
                                    <div class="description">
                                        <?= get_field('short_description', $car->ID) ?>
                                    </div>
                                <?php
                                endif; ?>
                                <?php
                                if (get_field('price', $car->ID)) : ?>
                                    <div class="price mt-2">
                                        <?= get_field('price', $car->ID) ?> ₸
                                        <span class="price-sm"><?= price_for_month('price', $car->ID,
                                                36) ?> ₸/мес.</span>
                                    </div>
                                <?php
                                endif; ?>
                            </div>
                        </div>
                    <?php
                    endforeach; ?>
                </div>

                <!-- If we need navigation buttons -->
                <button class="arrow arrow-prev swiper-button-prev">
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                        <path d="M8 4l-6 6 6 6M2.5 10H21" stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                </button>
                <button class="arrow arrow-next swiper-button-next">
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                        <path d="M13 16l6-6-6-6M18.5 10H0" stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="container-fluid mt-40">
            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
                        <a href="<?= get_site_url() ?>/available-cars" class="btn">
                            Все авто в наличии
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
endif; ?>
    <section class="offers section pt-80 pb-80">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="section-heading">
                        Акции и спецпредложения на автомобили Kia
                    </h4>
                    <div class="pos-r dalacode-slider">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php

                            $offers_cars = new WP_Query([
                                'post_type' => 'offers-cars'
                            ]);

                            ?>
                            <?php
                            foreach ($offers_cars->posts as $offer) : ?>
                                <div class="swiper-slide d-flex flex-column justify-content-between model">
                                    <div class="offers-card">
                                        <div class="img">
                                            <a href="<?= get_the_permalink($offer->ID) ?>">
                                                <?= get_the_post_thumbnail($offer->ID, 'full') ?>
                                            </a>
                                        </div>
                                        <div class="title">
                                            <div class="d-flex flex-column">
                                                <a href="<?= get_the_permalink($offer->ID) ?>">
                                            <span class="mr-2 underlined-black fz-15 fw-700">
                                                <?= $offer->post_title ?>
                                            </span>
                                                </a>
                                                <p class="offers-desc">
                                                    <?= get_field('short_description', $offer->ID) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach; ?>
                        </div>
                        <button class="arrow arrow-prev swiper-button-prev">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                <path d="M8 4l-6 6 6 6M2.5 10H21" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                        <button class="arrow arrow-next swiper-button-next">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                <path d="M13 16l6-6-6-6M18.5 10H0" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-40">
            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
                        <a href="<?= get_site_url() ?>/offers-cars" class="btn">
                            Все предложения
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="separator">
    <section class="callback pt-80 pb-80" id="callback">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 callback-col d-flex justify-content-center">
                    <div class="callback-form">
                        <h5 class="mb-2">Закажите звонок</h5>
                        <p>Поля, отмеченные *, обязательны для заполнения</p>
                        <?= do_shortcode('[contact-form-7 id="139" title="Форма заявки"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="separator">
<?php
if (false) : ?>
    <section class="offers section pt-80 pb-80">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="section-heading">
                        Акции и спецпредложения на сервисное обслуживание
                    </h4>
                    <div class="pos-r dalacode-slider">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php

                            $offers_service = new WP_Query([
                                'post_type' => 'offers-service'
                            ]);

                            ?>
                            <?php
                            foreach ($offers_service->posts as $offer) : ?>
                                <div class="swiper-slide d-flex flex-column justify-content-between model">
                                    <div class="offers-card">
                                        <div class="img">
                                            <a href="<?= get_the_permalink($offer->ID) ?>">
                                                <?= get_the_post_thumbnail($offer->ID, 'full') ?>
                                            </a>
                                        </div>
                                        <div class="title">
                                            <div class="d-flex flex-column">
                                                <a href="<?= get_the_permalink($offer->ID) ?>">
                                            <span class="mr-2 underlined-black fz-15 fw-700">
                                                <?= $offer->post_title ?>
                                            </span>
                                                </a>
                                                <p class="offers-desc">
                                                    <?= get_field('short_description', $offer->ID) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach; ?>
                        </div>
                        <button class="arrow arrow-prev swiper-button-prev">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                <path d="M8 4l-6 6 6 6M2.5 10H21" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                        <button class="arrow arrow-next swiper-button-next">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                <path d="M13 16l6-6-6-6M18.5 10H0" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-40">
            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
                        <a href="<?= get_site_url() ?>/offers-service" class="btn">
                            Все предложения
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
endif; ?>
    <section class="offers d-none section pt-80 pb-80">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="section-heading">
                        Новости компании
                    </h4>
                    <div class="pos-r dalacode-slider">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php

                            $company_news = new WP_Query([
                                'category' => 'news'
                            ]);

                            ?>
                            <?php
                            foreach ($company_news->posts as $post) : ?>
                                <div class="swiper-slide d-flex flex-column justify-content-between model">
                                    <div class="offers-card">
                                        <div class="img">
                                            <a href="<?= get_the_permalink($post->ID) ?>">
                                                <?= get_the_post_thumbnail($post->ID, 'full') ?>
                                            </a>
                                        </div>
                                        <div class="title">
                                            <div class="d-flex flex-column">
                                                <a href="<?= get_the_permalink($post->ID) ?>">
                                            <span class="mr-2 underlined-black fz-15 fw-700">
                                                <?= $post->post_title ?>
                                            </span>
                                                </a>
                                                <p class="offers-desc">
                                                    <?= get_field('short_description', $post->ID) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach; ?>
                        </div>
                        <button class="arrow arrow-prev swiper-button-prev">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                <path d="M8 4l-6 6 6 6M2.5 10H21" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                        <button class="arrow arrow-next swiper-button-next">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none"
                                 xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                <path d="M13 16l6-6-6-6M18.5 10H0" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid mt-40">
            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
                        <a href="<?= get_site_url() ?>/category/news/" class="btn">
                            Все новости
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div style="height:52px"></div>
<?php
get_footer();
