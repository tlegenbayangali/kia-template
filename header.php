<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kia
 */
$seo = DLCD_SEO_ACTIVE;
$title = '';
$description = '';

$template_slug = explode('/', get_single_template());
$template_slug = $template_slug[ count($template_slug) - 1 ];

$city = explode(',', get_field('dealer_info', 'options')[ 'dealer_address' ]);
$city = $city[ 0 ];

if (is_single()) {
    switch ($template_slug) {
        case 'single-models.php':
            $title = 'Обзор Kia ' . get_the_title() . ' у официального дилера Kia в ' . $city . ' - ' . get_bloginfo('name');
            $description = 'Купить новый автомобиль Kia ' . get_the_title() . ' в ' . $city . '. За подробной информацией обращайтесь по телефону: ' . get_field('dealer_info', 'options')[ 'dealer_phones' ][ 0 ][ 'dealer_phone' ];
            break;
        case 'single-models-complectations.php':
            $title = 'Комплектации и цены Kia ' . get_the_title() . ' у официального дилера Kia в ' . $city . ' - ' . get_bloginfo('name');
            $description = 'Ознакомьтесь с комплектациями и ценами на новый автомобиль Kia ' . get_the_title() . ' в ' . $city . '. За подробной информацией обращайтесь по телефону: ' . get_field('dealer_info', 'options')[ 'dealer_phones' ][ 0 ][ 'dealer_phone' ];
            break;
        case 'single-models-characteristics.php':
            $title = 'Технические характеристики Kia ' . get_the_title() . ' у официального дилера Kia в ' . $city . ' - ' . get_bloginfo('name');
            $description = 'Технические характеристики и с Kia ' . get_the_title() . ' в ' . $city . '. За подробной информацией обращайтесь по телефону: ' . get_field('dealer_info', 'options')[ 'dealer_phones' ][ 0 ][ 'dealer_phone' ];
            break;
    }
}
?>
<!doctype html>
<html <?php
language_attributes(); ?>>
<head>
    <meta charset="<?php
    bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    if ($seo && get_post_type(get_queried_object()->ID) === 'models') : ?>
        <meta name="description" content="<?= $description ?>">
        <title><?= $title ?></title>
    <?php
    endif; ?>
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <meta name="format-detection" content="telephone=no">
    <link rel="alternate" href="<?= get_site_url() ?>" hreflang="ru"/>
    <link rel="alternate" href="<?= get_site_url() ?>" hreflang="x-default"/>
    <?php
    wp_head(); ?>
</head>

<body <?php
body_class('is-loading'); ?>>
<?php
wp_body_open(); ?>
<div class="loader">
</div>
<div id="page" class="main-section">
    <!--HEADER SECTION-->
    <header class="header" id="header">
        <div class="header-top pos-r">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-top-inner d-flex justify-content-between align-items-center">
                            <div class="left d-flex align-items-center">
                                <a class="d-flex align-items-center" href="/">
                                    <svg class="left-icon d-block f-dark">
                                        <use xlink:href="<?php
                                        echo get_template_directory_uri(); ?>/dist/images/dist/sprite.svg#kia-logo-new"></use>
                                    </svg>
                                    <div class="left-text pos-r">
                                        <?php
                                        the_field('site_name', 'options'); ?>
                                        <div class="bottom">
                                            <?php
                                            the_field('site_description', 'options'); ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <a href="#" class="hamburger d-xl-none d-block">
                                <div class="hamburger-inner">
                                    <span class="d-block hamburger-stick top"></span>
                                    <span class="d-block hamburger-stick bottom"></span>
                                </div>
                            </a>
                            <div class="right">
                                <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.25 7.2C13.25 8.9657 12.2129 10.9683 10.8531 12.8025C9.5141 14.6086 7.95913 16.124 7.11791 16.8941C7.04771 16.9584 6.95229 16.9584 6.88209 16.8941L6.37565 17.4473L6.88209 16.8941C6.04087 16.124 4.4859 14.6086 3.14691 12.8025C1.78707 10.9683 0.75 8.9657 0.75 7.2C0.75 3.61771 3.568 0.75 7 0.75C10.432 0.75 13.25 3.61771 13.25 7.2Z" stroke="#05141F" stroke-width="1.5"/>
                                </svg>
                                <div class="right-adress-wrapper">
                                    <div class="right-adress">
                                        <?php
                                        the_field('address', 'options') ?>
                                    </div>
                                    <div class="right-adress-desc">
                                        дилерский центр
                                    </div>
                                    <!-- <a href="tel:<?php
                                    echo cleanPhone(get_field('phone', 'options')) ?>" class="right-number pos-r d-block">
										<?php
                                    the_field('phone', 'options') ?>
									</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom pos-r">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- MAIN MENU-->
                        <div class="menu">
                            <div class="menu-wrapper">

                                <?php
                                if (have_rows('menu-elements', 'option')): ?>

                                    <ul class="">
                                        <?php
                                        while (have_rows('menu-elements', 'option')): the_row(); ?>

                                            <!-- MAIN LI ITEM-->
                                            <li class="m_menu-item">
                                                <a href="<?php
                                                if (get_sub_field('menu-element-link')) {
                                                    the_sub_field('menu-element-link');
                                                } else echo '#' ?>">
                                                    <?php
                                                    the_sub_field('menu-element-title'); ?>
                                                </a>
                                                <!-- LI ITEM'S MEGA MENU STARTS(WILL BE SIDEBAR)-->
                                                <?php
                                                if (get_sub_field('has-children') === 'да') { ?>
                                                    <div class="m_menu-item-container-wr">
                                                        <!-- LI ITEM'S MEGA MENU CONTAINER-->
                                                        <div class="m_menu-item-container d-flex flex-column">
                                                            <!-- MEGA MENU ITEM __> (LINKS WIDJET) -->
                                                            <div class="m_menu-item-links-wr">
                                                                <div class="m_menu-item-links d-flex justify-content-between">
                                                                    <div class="m_menu-item-links-inn">
                                                                        <!-- LINKS WIDJET'S ITEM -->
                                                                        <?php
                                                                        while (have_rows('sub-menu-elements')): the_row(); ?>
                                                                            <div class="m_menu-item-link">
                                                                                <a href="<?php
                                                                                the_sub_field('sub-menu-element-link'); ?>">
                                                                                    <?php
                                                                                    the_sub_field('sub-menu-element-title'); ?>
                                                                                </a>
                                                                            </div>
                                                                        <?php
                                                                        endwhile; ?>
                                                                    </div>
                                                                    <!-- MEGA MENU ITEM __> (LINKS WIDJET) -->
                                                                    <?php
                                                                    $banner_info = get_sub_field('sub-menu-banner-element');
                                                                    if ($banner_info[ 'sub-menu-banner-title' ]): ?>
                                                                        <div class="m_menu-item-link-banner">
                                                                            <a href="<?php
                                                                            echo esc_url($banner_info[ 'sub-menu-banner-link' ]); ?>">
                                                                                <div class="top"
                                                                                     style="background: url(<?php
                                                                                     echo esc_url($banner_info[ 'sub-menu-banner-image' ]); ?>) no-repeat center center/cover;">
                                                                                </div>
                                                                                <div class="bottom">
                                                                                    <?php
                                                                                    echo esc_html($banner_info[ 'sub-menu-banner-title' ]); ?>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    <?php
                                                                    endif; ?>
                                                                </div>
                                                            </div>
                                                            <!-- MEGA MENU ITEM __> (BANNERS WIDJET) -->
                                                            <?php
                                                            if (have_rows('banner-list')): ?>
                                                                <div class="m_menu-item-banners">
                                                                    <?php
                                                                    while (have_rows('banner-list')): the_row(); ?>
                                                                        <a href="<?php
                                                                        the_sub_field('banner-list-link'); ?>" class="m_menu-item-banners-item" data-image-url="<?php
                                                                        echo get_template_directory_uri() . '/assets/images/quick-link-image-1.jpeg' ?>"
                                                                           style="background-image: url(<?php
                                                                           the_sub_field('banner-list-image'); ?>);
                                                                                   background-repeat: no-repeat; background-position: center center; background-size: cover;">
                                                                            <?php
                                                                            the_sub_field('banner-list-title'); ?>
                                                                        </a>
                                                                    <?php
                                                                    endwhile; ?>
                                                                </div>
                                                            <?php
                                                            endif; ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                } ?>
                                            </li>
                                        <?php
                                        endwhile; ?>
                                    </ul>
                                <?php
                                endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
