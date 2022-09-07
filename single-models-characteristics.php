<?php get_header();
$parent_post = get_post($post->post_parent);
$parent_post_id = get_post()->post_parent;
?>
<?php get_template_part('template-parts/content', 'header-models', ['parent_post' => $parent_post,]); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumbs equip-breadcrumbs d-flex justify-content-between">
                <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(); ?>
                <div class="equip-breadcrumbs-right d-flex align-items-md-center">
                    <div class="equip-breadcrumbs-right-price">
                        <a class="d-flex align-items-center underlined underlined-black" href="<?= get_field('model_price_list', $parent_post_id)['url'] ?>">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="mr-1" data-v-bee0cc60="">
                                <path d="M2.75.75h9.94l4.56 4.56v13.94H2.75V.75z" stroke="currentColor" stroke-width="1.5" data-v-bee0cc60=""></path>
                                <path d="M12.5 1v5h4" stroke="currentColor" stroke-width="1.5" data-v-bee0cc60="">
                                </path>
                            </svg>
                            Скачать прайс-лист
                        </a>
                    </div>
                    <div class="equip-breadcrumbs-right-price">
                        <a class="d-flex align-items-center underlined underlined-black" href="<?= get_field('brochure', $parent_post_id)['url'] ?>">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="mr-1" data-v-bee0cc60="">
                                <path d="M2.75.75h9.94l4.56 4.56v13.94H2.75V.75z" stroke="currentColor" stroke-width="1.5" data-v-bee0cc60=""></path>
                                <path d="M12.5 1v5h4" stroke="currentColor" stroke-width="1.5" data-v-bee0cc60="">
                                </path>
                            </svg>
                            Скачать брошюру
                        </a>
                    </div>
                    <div class="equip-breadcrumbs-right-call">
                        <a class="d-flex align-items-center underlined underlined-black" href="/callback/?current_model=<?= $parent_post->post_name ?>">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="mr-1" data-v-3802aeb3="">
                                <path d="M2.494 3.506l1.299-1.299a1 1 0 011.414 0l2.66 2.66A1 1 0 017.941 6.2l-.681.851c-.467.584-.583 1.388-.203 2.032 1.318 2.23 3.191 3.5 4.511 4.086.57.254 1.218.103 1.706-.287l1.027-.822a1 1 0 011.332.074l2.603 2.603a1 1 0 01-.056 1.467l-1.691 1.45c-.63.54-1.46.82-2.286.734-1.801-.19-4.602-.786-7.703-3.887-3.716-3.716-4.577-6.634-4.855-8.603-.125-.882.219-1.761.849-2.39zM11 5c1.333 0 4 .8 4 4M10 2c2.667 0 8 1.6 8 8" stroke="currentColor" stroke-width="1.5" data-v-3802aeb3="">
                                </path>
                            </svg>
                            Обратный звонок
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="equip-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="equip-hero-inner">
                    <div class="equip-hero-title">
                        <span class="d-block">
                            Характеристики <?php echo esc_html(get_the_title($parent_post_id)); ?>
                        </span>
                    </div>
                    <div class="equip-hero-min-price">
                        Минимальная цена
                    </div>
                    <div class="equip-hero-min-price-val d-flex align-items-center">
                        <span class="val">
                            <?php the_field('starting_price', $parent_post_id); ?> ₸
                        </span>
                        <!--<span class="equip-hero-min-price-info d-block">
                            <svg class="info info-additional conditions">
                                <use xlink:href="<?= get_template_directory_uri() ?>/dist/images/dist/sprite.svg#info"></use>
                            </svg>
                        </span>-->
                    </div>
                    <div class="equip-hero-banner">
                        <img src="<?php the_field('bottom_section_car_image_medium', $parent_post_id); ?>" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$post_data = get_post($post->post_parent);
$parent_slug = $post_data->post_name;
$configs = new WP_Query([
    'post_type' => 'configs',
    'model' => $parent_slug,
    'posts_per_page' => 99
]);
?>

<div class="equip-wrapper">
    <div class="equip-inner">
        <div class="container">
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
                                        foreach ($configs->posts as $post) {
                                            $current_post_ID = $post->ID; ?>
                                            <div class="equip-variants-slide swiper-slide d-flex flex-column justify-content-between">
                                                <div class="">
                                                    <a class="equip-variants-slide-title d-flex align-items-center" href="#">
                                                        <span><?php echo esc_html(get_the_title($current_post_ID)); ?></span>
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                                            <path d="M8.5 14l4-4-4-4" stroke="currentColor" stroke-width="2"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="equip-variants-slide-desc">
                                                        <span class="d-block equip-variants-slide-param">
                                                            <?php $common_chars = get_field('common_chars', $current_post_ID); ?>
                                                            <?php echo $common_chars['engine'] . ' / ' .
                                                                $common_chars['power'] . ' л.с / ' .
                                                                $common_chars['engine_type'] . ' / ' .
                                                                $common_chars['transmission'] . ' / ' .
                                                                $common_chars['drive_wheels'];
                                                            ?>
                                                        </span>
                                                        <span class="d-block equip-variants-slide-price">
                                                            <?php echo esc_html(get_field('price', $current_post_ID)); ?> ₸
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
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
            <div class="equip-content">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- TOP PADDING-->
                        <div class="equip-header-top-padding" data-height="">
                        </div>
                        <div class="equip-content-inner">
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Размеры
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Тип кузова
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dimensions = get_field('dimensions', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dimensions['body_type']) : ?>
                                                                        <?= $dimensions['body_type'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Габариты (длина/ширина/высота), мм
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dimensions = get_field('dimensions', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dimensions['dimensions']) : ?>
                                                                        <?= $dimensions['dimensions'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Колесная база, мм
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dimensions = get_field('dimensions', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dimensions['wheels_base']) : ?>
                                                                        <?= $dimensions['wheels_base'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Дорожный просвет, мм
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dimensions = get_field('dimensions', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dimensions['clearance']) : ?>
                                                                        <?= $dimensions['clearance'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Объём багажника (VDA), л
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dimensions = get_field('dimensions', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dimensions['trunk_volume']) : ?>
                                                                        <?= $dimensions['trunk_volume'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Двигатель и трансмиссия
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Двигатель
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $engine = get_field('engine', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($engine) : ?>
                                                                        <?= $engine ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Мощность, л.с.
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $power = get_field('power', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($power) : ?>
                                                                        <?= $power ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Крутящий момент, Н·м
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $rotate_moment = get_field('rotate_moment', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($rotate_moment) : ?>
                                                                        <?= $rotate_moment ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Тип двигателя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $engine_type = get_field('engine_type', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($engine_type) : ?>
                                                                        <?= $engine_type ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Коробка передач
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $transmission = get_field('transmission', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($transmission) : ?>
                                                                        <?= $transmission ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Привод
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_wheels = get_field('drive_wheels', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($drive_wheels) : ?>
                                                                        <?= $drive_wheels ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Время разгона 0-100 км/ч, с
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $zero_hundred = get_field('zero_hundred', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($zero_hundred) : ?>
                                                                        <?= $zero_hundred ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Расход топлива комбинированный, л/100 км
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $consumption = get_field('consumption', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($consumption) : ?>
                                                                        <?= $consumption ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Выбросы CO2
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Город, г/км
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $co2_city = get_field('co2_city', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($co2_city) : ?>
                                                                        <?= $co2_city ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Трасса, г/км
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $co2_track = get_field('co2_track', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($co2_track) : ?>
                                                                        <?= $co2_track ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                В комбинированном цикле
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $co2_combine = get_field('co2_combine', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($co2_combine) : ?>
                                                                        <?= $co2_combine ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Спецификация
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Код модели
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $model_code = get_field('model_code', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($model_code) : ?>
                                                                        <?= $model_code ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                OCN
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $ocn = get_field('ocn', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($ocn) : ?>
                                                                        <?= $ocn ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Модельный год
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $model_year = get_field('model_year', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($model_year) : ?>
                                                                        <?= $model_year ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Электрооборудование
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Аккумулятор (ампер-часов)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $elektrooborudovanie = get_field('elektrooborudovanie', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($elektrooborudovanie['akkumulyator_amper-chasov']) : ?>
                                                                        <?= $elektrooborudovanie['akkumulyator_amper-chasov'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Генератор
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $elektrooborudovanie = get_field('elektrooborudovanie', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($elektrooborudovanie['generator']) : ?>
                                                                        <?= $elektrooborudovanie['generator'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Стартер
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $elektrooborudovanie = get_field('elektrooborudovanie', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($elektrooborudovanie['starter']) : ?>
                                                                        <?= $elektrooborudovanie['starter'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Объем масла в двигателе (л.)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $elektrooborudovanie = get_field('elektrooborudovanie', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($elektrooborudovanie['obem_masla_v_dvigatele_l']) : ?>
                                                                        <?= $elektrooborudovanie['obem_masla_v_dvigatele_l'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Динамические характеристики
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Максимальная скорость (км/ч)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dinamicheskie_harakteristiki = get_field('dinamicheskie_harakteristiki', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dinamicheskie_harakteristiki['maksimalnaya_skorost_kmch']) : ?>
                                                                        <?= $dinamicheskie_harakteristiki['maksimalnaya_skorost_kmch'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Ускорение (сек) 0->100 (км/ч)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dinamicheskie_harakteristiki = get_field('dinamicheskie_harakteristiki', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dinamicheskie_harakteristiki['uskorenie_sek_0-100_kmch']) : ?>
                                                                        <?= $dinamicheskie_harakteristiki['uskorenie_sek_0-100_kmch'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Внутренние размеры
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Объем багажного отделения (л)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $vnutrennie_razmery = get_field('vnutrennie_razmery', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($vnutrennie_razmery['obem_bagazhnogo_otdeleniya_l']) : ?>
                                                                        <?= $vnutrennie_razmery['obem_bagazhnogo_otdeleniya_l'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Объем багажного отделения (л), при сложенных задних сиденьях
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $vnutrennie_razmery = get_field('vnutrennie_razmery', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($vnutrennie_razmery['obem_bagazhnogo_otdeleniya_l_pri_slozhennyh_zadnih_sidenyah']) : ?>
                                                                        <?= $vnutrennie_razmery['obem_bagazhnogo_otdeleniya_l_pri_slozhennyh_zadnih_sidenyah'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Размеры погрузочного пространства (мм) (За 2ым рядом сидений, длина/ширина/высота)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $vnutrennie_razmery = get_field('vnutrennie_razmery', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($vnutrennie_razmery['razmery_pogruzochnogo_prostranstva_mm_za_2ym_ryadom_sidenij_dlinashirinavysota']) : ?>
                                                                        <?= $vnutrennie_razmery['razmery_pogruzochnogo_prostranstva_mm_za_2ym_ryadom_sidenij_dlinashirinavysota'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Масса (5 мест)
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Максимальная
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $massa_5_mest = get_field('massa_5_mest', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($massa_5_mest['maksimalnaya']) : ?>
                                                                        <?= $massa_5_mest['maksimalnaya'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Минимальная
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $massa_5_mest = get_field('massa_5_mest', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($massa_5_mest['minimalnaya']) : ?>
                                                                        <?= $massa_5_mest['minimalnaya'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Полная масса (кг)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $massa_5_mest = get_field('massa_5_mest', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($massa_5_mest['polnaya_massa_kg']) : ?>
                                                                        <?= $massa_5_mest['polnaya_massa_kg'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Подвеска
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Передняя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $podveska = get_field('podveska', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($podveska['perednyaya']) : ?>
                                                                        <?= $podveska['perednyaya'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Задняя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $podveska = get_field('podveska', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($podveska['zadnyaya']) : ?>
                                                                        <?= $podveska['zadnyaya'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Тормоза
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Размер передних тормозных дисков
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $tormoza = get_field('tormoza', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($tormoza['razmer_perednih_tormoznyh_diskov']) : ?>
                                                                        <?= $tormoza['razmer_perednih_tormoznyh_diskov'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Размер задних тормозных дисков
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $tormoza = get_field('tormoza', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($tormoza['razmer_zadnih_tormoznyh_diskov']) : ?>
                                                                        <?= $tormoza['razmer_zadnih_tormoznyh_diskov'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Рулевое управление
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Тип
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $rulevoe_upravlenie = get_field('rulevoe_upravlenie', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($rulevoe_upravlenie['tip']) : ?>
                                                                        <?= $rulevoe_upravlenie['tip'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Число оборотов руля между крайними положениями
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $rulevoe_upravlenie = get_field('rulevoe_upravlenie', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($rulevoe_upravlenie['chislo_oborotov_rulya_mezhdu_krajnimi_polozheniyami']) : ?>
                                                                        <?= $rulevoe_upravlenie['chislo_oborotov_rulya_mezhdu_krajnimi_polozheniyami'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Минимальный радиус разворота (м)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $rulevoe_upravlenie = get_field('rulevoe_upravlenie', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($rulevoe_upravlenie['minimalnyj_radius_razvorota_m']) : ?>
                                                                        <?= $rulevoe_upravlenie['minimalnyj_radius_razvorota_m'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Передаточное число рулевого управления
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $rulevoe_upravlenie = get_field('rulevoe_upravlenie', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($rulevoe_upravlenie['peredatochnoe_chislo_rulevogo_upravleniya']) : ?>
                                                                        <?= $rulevoe_upravlenie['peredatochnoe_chislo_rulevogo_upravleniya'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Трансмиссия
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Тип привода
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $transmissiya = get_field('transmissiya', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($transmissiya['tip_privoda']) : ?>
                                                                        <?= $transmissiya['tip_privoda'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Тип
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $transmissiya = get_field('transmissiya', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($transmissiya['tip_2']) : ?>
                                                                        <?= $transmissiya['tip_2'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Тип сцепления
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $transmissiya = get_field('transmissiya', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($transmissiya['tip_sczepleniya']) : ?>
                                                                        <?= $transmissiya['tip_sczepleniya'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Объем масла в трансмиссии (л.)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $transmissiya = get_field('transmissiya', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($transmissiya['obem_masla_v_transmissii_l']) : ?>
                                                                        <?= $transmissiya['obem_masla_v_transmissii_l'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config not-bool">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Двигатель
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Рабочий объем (см3)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dvigatel_2 = get_field('dvigatel_2', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dvigatel_2['rabochij_obem_sm3']) : ?>
                                                                        <?= $dvigatel_2['rabochij_obem_sm3'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Диаметр цилиндра х Ход поршня (мм)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dvigatel_2 = get_field('dvigatel_2', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dvigatel_2['diametr_czilindra_h_hod_porshnya_mm']) : ?>
                                                                        <?= $dvigatel_2['diametr_czilindra_h_hod_porshnya_mm'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Степень сжатия
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dvigatel_2 = get_field('dvigatel_2', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dvigatel_2['stepen_szhatiya']) : ?>
                                                                        <?= $dvigatel_2['stepen_szhatiya'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Макс. Мощность (л.с.@ об/мин)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dvigatel_2 = get_field('dvigatel_2', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dvigatel_2['maks_moshhnost_ls_obmin']) : ?>
                                                                        <?= $dvigatel_2['maks_moshhnost_ls_obmin'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Макс. Крутящий момент (Нм @ об/мин)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dvigatel_2 = get_field('dvigatel_2', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dvigatel_2['maks_krutyashhij_moment_nm_obmin']) : ?>
                                                                        <?= $dvigatel_2['maks_krutyashhij_moment_nm_obmin'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Количество цилиндров
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dvigatel_2 = get_field('dvigatel_2', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dvigatel_2['kolichestvo_czilindrov']) : ?>
                                                                        <?= $dvigatel_2['kolichestvo_czilindrov'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Топливная система
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dvigatel_2 = get_field('dvigatel_2', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dvigatel_2['toplivnaya_sistema']) : ?>
                                                                        <?= $dvigatel_2['toplivnaya_sistema'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Объем топливного бака (л.)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">

                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $dvigatel_2 = get_field('dvigatel_2', $post->ID); ?>
                                                            <?php
                                                            // echo '<pre>';
                                                            // print_r($elektrooborudovanie);
                                                            // echo '</pre>';
                                                            ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div>
                                                                    <?php if ($dvigatel_2['obem_toplivnogo_baka_l']) : ?>
                                                                        <?= $dvigatel_2['obem_toplivnogo_baka_l'] ?>
                                                                    <?php else : ?>
                                                                        —
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>