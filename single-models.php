<?php get_header();
$current_post = get_post(); ?>
<?php get_template_part('template-parts/content', 'header-models', ['parent_post' => $current_post,]); ?>
<div class="hero-model" style="background: url(<?= get_field('model_hero_bg', get_the_ID()) ?>) no-repeat center center /cover gray;">
    <?php if (get_field('model_hero_video', get_the_ID())) : ?>
        <video class="hero-model-video" autoplay muted loop style="background: url(<?= get_field('model_hero_bg', get_the_ID()) ?>) no-repeat center center /cover gray;">
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
                                        <?php
                                        $current_model_interiors = get_field('interior_colors');
                                        ?>
                                        <?php if ($current_model_interiors) : ?>
                                            <!-- COLORS LIST INTERIOR-->
                                            <div class="color-list">
                                                <?php foreach ((array)$current_model_interiors as $interior) : ?>
                                                    <span id="model-sections-colors-interior-0" data-color="<?= $interior['interior_color_rgb'] ?>" data-text="<?= $interior['interior_color_name'] ?>" class="color-list-item" style="background: <?= $interior['interior_color_rgb'] ?>"></span>
                                                <?php endforeach; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php
            $current_model = $current_post->post_name;
            $configs = new WP_Query([
                'post_type' => 'configs',
                'model' => $current_model,
                'order' => 'asc'
            ]);
            ?>
            <?php if (get_field('show_complectations')) : ?>
                <div class="model-sections">
                    <!-- VARIATIONS OF EQUIPMENT-->
                    <div class="model-sections-inner background-gray">
                        <div class="model-sections-variations">
                            <div class="model-sections-title-centered model-sections-title">
                                <span class="model-sections-title-sub">
                                    Комплектации
                                </span>
                                <h3 class="model-sections-title-header">
                                    Варианты <?php the_title(); ?>
                                </h3>
                            </div>
                            <div class="model-sections-variations-bottom">
                                <div class="model-sections-variations-bottom-sub">
                                    <?php echo count($configs->posts) . ' '; ?> доступных комплектаций
                                </div>
                                <!-- MORE BUTTON TO ANOTHER PAGE-->
                                <a href="/models/<?= $current_model ?>/complectations/" class="model-sections-variations-bottom-more model-sections-desc-more underlined underlined-black">
                                    Комплектации и цены
                                </a>
                            </div>

                            <div class="model-sections-variations-slider">
                                <!-- SLIDER MAIN CONTAINER -->
                                <div class="swiper-container model-sections-variations-container">
                                    <!-- ADDITIONAL REQUIRED WRAPPER -->
                                    <div class="swiper-wrapper model-sections-variations-wrapper">
                                        <?php foreach ($configs->posts as $post) : ?>
                                            <?php
                                            $current_post_ID = $post->ID;
                                            ?>
                                            <!-- SLIDES -->
                                            <div class="swiper-slide model-sections-variations-slide">
                                                <div class="model-sections-variations-slide-inner">
                                                    <div class="title">
                                                        <h5><?php echo esc_html(get_the_title($current_post_ID)); ?></h5>
                                                        <span class="price">
                                                            <span><?php echo esc_attr(the_field('price', $current_post_ID)) ?></span> ₸
                                                        </span>
                                                    </div>
                                                    <div class="content">
                                                        <ul>
                                                            <li>
                                                                <span class="content-header">Двигатель и трансмиссия</span>
                                                                <p>
                                                                    <?php echo get_field('common_chars', $current_post_ID)['engine'] . ' / ' .
                                                                        get_field('common_chars', $current_post_ID)['power'] . ' л.с / ' .
                                                                        get_field('common_chars', $current_post_ID)['engine_type'] . ' / ' .
                                                                        get_field('common_chars', $current_post_ID)['transmission'] . ' / ' .
                                                                        get_field('common_chars', $current_post_ID)['drive_wheels']; ?>
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <span class="content-header">Основные опции</span>
                                                                <?php while (have_rows('main_options', $current_post_ID)) : the_row(); ?>
                                                                    <p><?php the_sub_field('options_item'); ?></p>
                                                                <?php endwhile; ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- MORE BUTTON TO ANOTHER PAGE-->
                                                    <div class="button">
                                                        <a href="/models/<?= $current_model ?>/complectations/" class="content-more model-sections-desc-more underlined underlined-green">
                                                            Комплектации и цены
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                        <button class="variations-button-prev model-sections-swiper-arrow-prev model-sections-swiper-arrow arrow">
                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                                <path d="M8 4l-6 6 6 6M2.5 10H21" stroke="currentColor" stroke-width="1.5">
                                                </path>
                                            </svg>
                                        </button>
                                        <button class="variations-button-next model-sections-swiper-arrow-next model-sections-swiper-arrow arrow">
                                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                                <path d="M13 16l6-6-6-6M18.5 10H0" stroke="currentColor" stroke-width="1.5">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
            <!-- BOTTOM SECTION-->
            <div class="model-sections">
                <div class="model-sections-bottom-block">
                    <div class="model-sections-bottom-block-bg">
                        <?php wp_reset_query(); ?>
                        <img src="<?php the_field('bottom_section_image', get_the_ID()) ?>" alt="background">
                    </div>
                    <div class="model-sections-inner-wide">
                        <div class="model-sections-bottom-block-inner">
                            <div class="model-sections-title-centered">
                                <span class="model-sections-title-sub model-sections-bottom-block-sub">
                                    Консультация
                                </span>
                                <h3 class="model-sections-title-header model-sections-bottom-block-header">
                                    Узнайте больше о <?php the_title(); ?>
                                </h3>

                                <div class="model-sections-bottom-block-btn btn-wrapper btn-wrapper-lg btn-wrapper-white">
                                    <a href="/callback/?current_model=<?= $current_post->post_name ?>" class="btn">
                                        Заказать звонок дилера
                                    </a>
                                </div>
                            </div>
                            <div class="model-sections-bottom-block-image">
                                <picture>
                                    <source media="(max-width: 524px)" srcset="<?php the_field('bottom_section_car_image_small', get_the_ID()); ?>">
                                    <img src="<?php the_field('bottom_section_car_image_medium', get_the_ID()); ?>" alt="model">
                                </picture>
                            </div>
                        </div>
                        <?php
                        if (have_rows('useful_links', get_the_ID()) || have_rows('useful_docs', get_the_ID())) :
                            $useful_links = get_field('useful_links', get_the_ID());
                            $useful_docs = get_field('useful_docs', get_the_ID()); ?>
                            <?php if (get_field('show_complectations')) : ?>
                                <div class="model-sections-bottom-block-links">
                                    <?php
                                    foreach ($useful_links as $link) {
                                        $link_text =  $link['useful_link']['useful_link_text'];
                                        $link_link = $link['useful_link']['useful_link_link'];
                                    ?>
                                        <a href="<?php echo esc_url($link_link) ?>" class="model-sections-bottom-block-links-item">
                                            <img src="<?php echo esc_url($link['choose_link_icon']) ?>" alt="icon">
                                            <span class="underlined underlined-black model-sections-bottom-block-more d-flex align-items-center">
                                                <?php echo esc_html($link_text) ?>
                                            </span>
                                        </a>
                                    <?php }

                                    foreach ($useful_docs as $doc) {
                                        $doc_text =  $doc['useful_doc']['useful_doc_text'];
                                        $doc_link = $doc['useful_doc']['useful_doc_link'];
                                    ?>
                                        <a href="<?php echo esc_url($doc_link) ?>" class="model-sections-bottom-block-links-item">
                                            <img src="<?php echo esc_url($doc['choose_doc_icon']) ?>" alt="icon">
                                            <span class="underlined underlined-black model-sections-bottom-block-more d-flex align-items-center">
                                                <?php echo esc_html($doc_text) ?>
                                            </span>
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!--ROW-->
    </div>
    <!--FLUID CONTAINER-->
</div>
<?php get_footer(); ?>