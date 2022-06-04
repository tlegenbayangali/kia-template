<?php

/*
Template Name: Страница Промо
 */
get_header();

?>

<div class="hero-model" style="background: url(<?= get_field('page_hero_img', get_the_ID()) ?>) no-repeat center center /cover gray;">
    <?php if (get_field('page_hero_video', get_the_ID())) : ?>
        <video class="hero-model-video" autoplay loop muted style="background: url(<?= get_field('page_hero_img', get_the_ID()) ?>) no-repeat center center /cover gray;">
            <?php if (get_field('page_hero_video', get_the_ID())['page_mp4']) : ?>
                <source src="<?= get_field('page_hero_video', get_the_ID())['page_mp4'] ?>">
            <?php endif; ?>
            <?php if (get_field('page_hero_video', get_the_ID())['page_webm']) : ?>
                <source src="<?= get_field('page_hero_video', get_the_ID())['page_webm'] ?>">
            <?php endif; ?>
        </video>
    <?php endif; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="hero-model-inner d-flex">
                    <div class="breadcrumbs">
                        <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(); ?>
                    </div>
                    <div class="hero-model-bottom d-flex">
                        <div class="hero-model-title">
                            <span class=""> <?= get_field('page_text_up_logo', get_the_ID()); ?> </span>
                            <div class="hero-model-title-name">
                                <?php if (get_field('page_hero_logo_img')) : ?>
                                    <img src="<?= get_field('page_hero_logo_img', get_the_ID()); ?>" alt="<?= get_the_title(get_the_ID()) ?>" style="width:594px">
                                <?php endif ?>
                                <h3 class=hero-model-promo-title><?= get_field('page_hero_title', get_the_ID()); ?></h3>
                            </div>
                            <div class="page-hero-title-sub">
                                <?= get_field('page_hero_short_text', get_the_ID()) ?>
                            </div>
                        </div>
                        <?php
                        if (have_rows('model_option')) : ?>
                            <div class="hero-model-desc">
                                <ul class="d-flex">
                                    <?php
                                    while (have_rows('model_option')) : the_row(); ?>
                                        <li>
                                            <div class="hero-model-desc-item">
                                                <div class="hero-model-desc-item-icon">
                                                    <img class="d-block" src="<?php the_sub_field('model_option_icon'); ?>" alt="description">
                                                </div>
                                                <div class="hero-model-desc-item-sub">
                                                    <?php the_sub_field('model_option_description'); ?>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php else : ?>
                            <div class="hero-btn btn-wrapper btn-wrapper-lg btn-wrapper-white">
                                <a href="<?= get_field('page_hero_link', get_the_ID()) ?>" class="btn">
                                    <?= get_field('page_hero_button', get_the_ID()) ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hero-model-padding"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <?php the_content(); ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>