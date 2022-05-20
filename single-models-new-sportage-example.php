<?php get_header();
$current_post = get_post(); ?>
<?php //get_template_part( 'template-parts/content', 'header-models', [ 'parent_post' => $current_post, ] ); 
?>
<div class="hero-model" style="background: url(<?= get_field('model_hero_bg', get_the_ID()) ?>) no-repeat center center /cover gray;">
    <?php if (get_field('model_hero_video', get_the_ID())) : ?>
        <video class="hero-model-video" autoplay="true" loop style="background: url(<?= get_field('model_hero_bg', get_the_ID()) ?>) no-repeat center center /cover gray;">
            <?php if (get_field('model_hero_video', get_the_ID())['mp4']) : ?>
                <source src="<?= get_field('model_hero_video', get_the_ID())['mp4'] ?>">
            <?php endif; ?>


            <?php if (get_field('model_hero_video', get_the_ID())['webm']) : ?>
                <source src="<?= get_field('model_hero_video', get_the_ID())['webm'] ?>">
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
                            <span class=""> <?= get_field('model_logo_top', get_the_ID()); ?> </span>
                            <div class="hero-model-title-name">
                                <?php if (get_field('model_logo')) : ?>
                                    <img src="<?= get_field('model_logo', get_the_ID()); ?>" alt="<?= get_the_title(get_the_ID()) ?>">
                                <?php endif ?>
                                <h3 class=hero-model-promo-title><?= get_field('model_title', get_the_ID()); ?></h3>
                            </div>
                            <div class="hero-model-title-sub">
                                <?= get_field('model_hero_short_text', get_the_ID()) ?>
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
                            <div class="btn-wrapper btn-wrapper-lg btn-wrapper-white" id="models-cars-promo">
                                <a href="#callback-form" class="btn">Подписаться на новости</a>
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
            <!-- BODY COLORS SECTIONS-->
            <?php if (have_rows('body_colors')) : ?>
                <div class="model-sections">
                    <!-- COLORS SECTION-->
                    <div class="model-sections-inner-wide">
                        <div class="model-sections-colors">
                            <!-- MAIN BLOCK FOR COLORS-->
                            <div class="model-sections-colors-image-wrapper d-flex justify-content-center">
                                <!-- COLORS IMAGE-->
                                <div class="model-sections-colors-image" id="model-sections-colors-image-0">
                                    <img src="" alt="model"> <!-- COLOR IMAGE-->
                                </div> <!-- REQUIRED CLASS MODEL SECTION COLORS IMAGE-->
                            </div>
                            <div class="row mt-30">
                                <div class="col-12 col-md-6">
                                    <div class="model-sections-colors-exterior colorpicker">
                                        <div class="description-list">
                                            <div id="model-sections-colors-exterior-desc-0" class="model-sections-colors-exterior-desc">
                                                Цвет:
                                                <span>
                                                    <!-- COLOR NAME-->
                                                </span>
                                            </div>
                                        </div>
                                        <!-- COLORS LIST EXTERIOR-->
                                        <div class="color-list">
                                            <?php
                                            $current_model_colors = get_field('body_colors');
                                            ?>
                                            <?php foreach ($current_model_colors as $color) : ?>
                                                <span data-text="<?= $color['body_color_name'] ?>" data-src="<?= $color['body_color_image'] ?>" class="color-list-item" data-color="<?= $color['body_colors_group']['body_colors_first'] ?>" style="background: <?= $color['body_colors_group']['body_colors_first'] ?>;"></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="model-sections-colors-interior colorpicker">
                                        <div class="description-list">
                                            <div id="model-sections-colors-exterior-desc-0" class="model-sections-colors-interior-desc">
                                                Интерьер:
                                                <span id="interior-color-name">Черный, Искусственная кожа с серой прострочкой (WK)</span>
                                            </div>
                                        </div>
                                        <!-- COLORS LIST INTERIOR-->
                                        <div class="color-list">
                                            <?php
                                            $current_model_interiors = get_field('interior_colors');
                                            ?>
                                            <?php foreach ((array)$current_model_interiors as $interior) : ?>
                                                <span id="model-sections-colors-interior-0" data-color="<?= $interior['interior_color_rgb'] ?>" data-text="<?= $interior['interior_color_name'] ?>" class="color-list-item" style="background: <?= $interior['interior_color_rgb'] ?>"></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endif;
            $current_model = $current_post->post_name;
            $configs = new WP_Query([
                'post_type' => 'configs',
                'model' => $current_model,
                'model' => $current_model,
                'order' => 'asc'
            ]);
            ?>
        </div>
        <!--ROW-->
    </div>
    <!--FLUID CONTAINER-->
</div>
<div id="callback-form" class="container pb-60 pt-30">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex callback-col justify-content-center">
                <div class="callback-form" id="offer-form">
                    <h5 class="mb-2">Подписаться на новости о новом Kia Sportage</h5>
                    <p>После отправки заявки, дилер свяжется с Вами для уточнения деталей.</p>
                    <p class="fz-12 mt-10 c-disabled">Поля, отмеченные *, обязательны для заполнения</p>
                    <?= do_shortcode('[contact-form-7 id="4581" title="Подписаться на новости о новом Kia Sportage"]') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>