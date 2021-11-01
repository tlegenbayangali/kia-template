<?php get_header();
    $parent_post = get_post($post->post_parent);
    $parent_post_id = get_post()->post_parent;
?>
<?php get_template_part( 'template-parts/content', 'header-models', [ 'parent_post' => $parent_post, ] ); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumbs equip-breadcrumbs d-flex justify-content-between">
                <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs();?>
                <div class="equip-breadcrumbs-right d-flex align-items-md-center">
                    <?php if (get_field('price_list_url', $parent_post_id)) : ?>
                    <div class="equip-breadcrumbs-right-price">
                        <a class="d-flex align-items-center underlined underlined-black" href="<?= get_field('price_list_url', $parent_post_id) ?>">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="mr-1"
                                data-v-bee0cc60="">
                                <path d="M2.75.75h9.94l4.56 4.56v13.94H2.75V.75z" stroke="currentColor"
                                    stroke-width="1.5" data-v-bee0cc60=""></path>
                                <path d="M12.5 1v5h4" stroke="currentColor" stroke-width="1.5" data-v-bee0cc60="">
                                </path>
                            </svg>
                            Скачать прайс-лист
                        </a>
                    </div>
                    <?php endif; ?>
                    <?php if (get_field('brochure', $parent_post_id)) : ?>
                    <div class="equip-breadcrumbs-right-price">
                        <a class="d-flex align-items-center underlined underlined-black" href="<?= get_field('brochure', $parent_post_id)['url'] ?>">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="mr-1"
                                data-v-bee0cc60="">
                                <path d="M2.75.75h9.94l4.56 4.56v13.94H2.75V.75z" stroke="currentColor"
                                    stroke-width="1.5" data-v-bee0cc60=""></path>
                                <path d="M12.5 1v5h4" stroke="currentColor" stroke-width="1.5" data-v-bee0cc60="">
                                </path>
                            </svg>
                            Скачать брошюру
                        </a>
                    </div>
                    <?php endif; ?>
                    <div class="equip-breadcrumbs-right-call">
                        <a class="d-flex align-items-center underlined underlined-black" href="/callback?current_model=<?= $parent_post->post_name ?>">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="mr-1"
                                data-v-3802aeb3="">
                                <path
                                    d="M2.494 3.506l1.299-1.299a1 1 0 011.414 0l2.66 2.66A1 1 0 017.941 6.2l-.681.851c-.467.584-.583 1.388-.203 2.032 1.318 2.23 3.191 3.5 4.511 4.086.57.254 1.218.103 1.706-.287l1.027-.822a1 1 0 011.332.074l2.603 2.603a1 1 0 01-.056 1.467l-1.691 1.45c-.63.54-1.46.82-2.286.734-1.801-.19-4.602-.786-7.703-3.887-3.716-3.716-4.577-6.634-4.855-8.603-.125-.882.219-1.761.849-2.39zM11 5c1.333 0 4 .8 4 4M10 2c2.667 0 8 1.6 8 8"
                                    stroke="currentColor" stroke-width="1.5" data-v-3802aeb3="">
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
<?php
    $post_data = get_post($post->post_parent);
    $parent_slug = $post_data->post_name;

    $configs = new WP_Query([
        'post_type' => 'configs',
        'model' => $parent_slug,
        'posts_per_page' => 99
    ]);
    $prices_array = [];

    foreach ($configs->posts as $post) :
        $prices_array[] = get_field('price', $post->ID);
    endforeach;
    if(count($prices_array) > 1):
        $model_min_price = min(...$prices_array);
    else :
        $model_min_price = $prices_array[0];
    endif;
    $GLOBALS['model_min_price'] = $model_min_price;
    // wp_reset_query();
?>
<div class="equip-hero">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="equip-hero-inner">
                    <div class="equip-hero-title">
                        <span class="d-block">
                            Комплектации и цены <?php echo esc_html( get_the_title($parent_post_id) );?>
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
                        <img src="<?php the_field('bottom_section_car_image_medium', $parent_post_id);?>" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                                    <a class="equip-variants-slide-title d-flex align-items-center"
                                                        href="#">
                                                        <span><?php echo esc_html( get_the_title($current_post_ID) );?></span>
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            preserveAspectRatio="xMidYMid" class="">
                                                            <path d="M8.5 14l4-4-4-4" stroke="currentColor"
                                                                stroke-width="2"></path>
                                                        </svg>
                                                    </a>
                                                    <div class="equip-variants-slide-desc">
                                                        <span class="d-block equip-variants-slide-param">
                                                            <?php $common_chars = get_field('common_chars', $current_post_ID);?>
                                                            <?php echo $common_chars['engine'] .' / '.
                                                                $common_chars['power'] .' л.с / '.
                                                                $common_chars['engine_type'] .' / '.
                                                                $common_chars['transmission'] .' / '.
                                                                $common_chars['drive_wheels'];
                                                            ?>
                                                        </span>
                                                        <span class="d-block equip-variants-slide-price">
                                                            <?php echo esc_html( get_field('price', $current_post_ID) ); ?> ₸
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
                                        <svg width="15" height="14" viewBox="0 0 21 20" xmlns="http://www.w3.org/2000/svg"
                                            preserveAspectRatio="xMidYMid" class="">
                                            <path d="M13 16l6-6-6-6M18.5 10H0" stroke-width="1.5">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="equip-variants-carousel-left-arrow
                                    equip-variants-carousel-arrow">
                                        <svg width="15" height="14" viewBox="0 0 21 20" xmlns="http://www.w3.org/2000/svg"
                                            preserveAspectRatio="xMidYMid" class="">
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
                                        Стандартное оборудование
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <?php 
                                            $standart_equipment = get_field('standart_equipment', $parent_post_id);

                                            foreach((array)$standart_equipment as $equipment) :
                                        ?>
                                        <div class="equip-config-section-item plain">
                                            <div class="equip-config-section-item-header">
                                                <?= $equipment['heading'] ?>
                                            </div>
                                            <div class="mt-10 items">
                                                <ul class="check">
                                                    <?php foreach ((array)$equipment['options_list'] as $option) : ?>
                                                    <li><?= $option['options_list_item'] ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </section>
                            </div>
                            <div class="equip-config">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Пакет "Теплые опции"
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Подогрев передних сидений
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['heated_front_seats']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Подогрев передних сидений (кроме версии 1.6 Classic с механической трансмиссией)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['podogrev_perednih_sidenij_krome_versii_16_classic_s_mehanicheskoj_transmissiej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Подогрев форсунок омывателя лобового стекла
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['podogrev_forsunok_omyvatelya_lobovogo_stekla']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Подогрев рулевого колеса
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['heated_steering_wheel']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Дополнительный электрический отопитель салона
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['dopolnitelnyj_elektricheskij_otopitel_salona']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Воздуховоды для второго ряда сидений
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['vozduhovody_dlya_vtorogo_ryada_sidenij']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Индикатор низкого уровня омывающей жидкости
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['indikator_nizkogo_urovnya_omyvayushhej_zhidkosti']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Подогрев лобового стекла в зоне стоянки стеклоочистителей
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['podogrev_lobovogo_stekla_v_zone_stoyanki_stekloochistitelej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Подогрев форсунок стеклоомывателя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['heated_washer_nozzles']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Зеркала заднего вида с электроприводом и подогревом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['power_and_heated_rearview_mirrors']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Подогрев задних сидений
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['podogrev_zadnih_sidenij']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрообогрев лобового стекла
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['elektroobogrev_lobovogo_stekla']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Боковые зеркала заднего вида с электроприводом и подогревом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $warm = get_field('warm_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($warm['bokovye_zerkala_zadnego_vida_s_elektroprivodom_i_podogrevom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                            <div class="equip-config">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Экстерьер
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Легкосплавные диски 14'' с шинами 175/65R14
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_14_s_shinami_175_65_r14']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Задние светодиодные фонари
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['zadnie_svetodiodnye_fonari']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передний бампер с вставками из чёрного пластика
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['perednij_bamper_s_vstavkami_iz_chyornogo_plastika']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передний бампер с вставками из чёрного глянца c хромированной окантовкой
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['perednij_bamper_s_vstavkami_iz_chyornogo_glyancza_c_hromirovannoj_okantovkoj']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Декоративная серебристая защита заднего бампера
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['dekorativnaya_serebristaya_zashhita_zadnego_bampera']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Галогеновые фары проекционного типа (линзованные)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['galogenovye_fary_proekczionnogo_tipa_linzovannye']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Тонировка стекол задних дверей и стекла пятой двери
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['tonirovka_stekol_zadnih_dverej_i_stekla_pyatoj_dveri']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Люк с электроприводом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['lyuk_s_elektroprivodom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Повторители указателя поворота (LED)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['povtoriteli_ukazatelya_povorota_led']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 16", с шинами 205 / 55 R16
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_16_s_shinami_205_55_r16']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 15'' с шинами 185/65R15
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_15_s_shinami_18565r15']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 15'' с шинами 185/55R15
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_15_s_shinami_185_55_r15']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 16'' с шинами 195/60R16
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_16_s_shinami_19560r16']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 16'' с шинами 195/55R16
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_16_s_shinami_19555r16']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 16" с шинами 215/60R16
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_16_s_shinami_21560r16']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Стальные диски 15" с декоративными колпаками и шинами 185/65R15
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['stalnye_diski_15_s_dekorativnymi_kolpakami_i_shinami_18565r15']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Стальные диски 15", с полноразмерными колпаками и шинами 195 / 65 
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['stalnye_diski_15_s_polnorazmernymi_kolpakami_i_shinami_195_65']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 18" с шинами 235/45R18
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['legkosplavnye_diski_18_s_shinami_23545r18']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передние фары проекционного типа (линзованные)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['perednie_fary_proekczionnogo_tipa_linzovannye']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Галогенные фары проекционного типа
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['galogennye_fary_proekczionnogo_tipa']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодные (LED) противотуманные фары
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnye_led_protivotumannye_fary']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодные (LED) фары со статической подсветкой поворотов 
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnye_led_fary_so_staticheskoj_podsvetkoj_povorotov']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодные дневные ходовые огни (LED DRL)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnye_dnevnye_hodovye_ogni_led_drl']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Дневные ходовые огни (DRL)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['dnevnye_hodovye_ogni_drl']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодные (LED) задние фонари
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnye_led_zadnie_fonari']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодные (LED) габаритные огни
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnye_led_gabaritnye_ogni']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодные (LED) фары ближнего и дальнего света проекционного типа
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnye_led_fary_blizhnego_i_dalnego_sveta_proekczionnogo_tipa']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодные (LED) фары
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnye_led_fary']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодные повторители указателя поворота
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnye_povtoriteli_ukazatelya_povorota']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передние противотуманные фары
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['perednie_protivotumannye_fary']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Решётка радиатора с отделкой чёрным глянцем
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['reshyotka_radiatora_s_otdelkoj_chyornym_glyanczem']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Ручки дверей, окрашенные в цвет кузова
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['ruchki_dverej_okrashennye_v_czvet_kuzova']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Внешние дверные ручки с отделкой хромом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['vneshnie_dvernye_ruchki_s_otdelkoj_hromom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Ручки дверей с отделкой хромом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['ruchki_dverej_s_otdelkoj_hromom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Повторители указателей поворота на зеркалах заднего вида
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['povtoriteli_ukazatelej_povorota_na_zerkalah_zadnego_vida']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Подсветка поворотов
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['podsvetka_povorotov']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система бесключевого доступа Smart Key и пуск двигателя кнопкой
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sistema_besklyuchevogo_dostupa_smart_key_i_pusk_dvigatelya_knopkoj']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Двухцветная окраска кузова (опционально)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['dvuhczvetnaya_okraska_kuzova_opczionalno']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Панорамная крыша и люк с электроприводом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['panoramnaya_krysha_i_lyuk_s_elektroprivodom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Рейлинги на крыше
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['rejlingi_na_kryshe']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Хромированные ручки дверей (внешние)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['hromirovannye_ruchki_dverej_vneshnie']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электропривод складывания зеркал заднего вида
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['elektroprivod_skladyvaniya_zerkal_zadnego_vida']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Серебристая декоративная накладка на передний и задний бампер
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['serebristaya_dekorativnaya_nakladka_na_perednij_i_zadnij_bamper']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 17" с шинами 235/65R
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_17_s_shinami_23565r']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 18" с шинами 235/60R
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_18_s_shinami_23560r']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 19" с шинами 235/55R
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_19_s_shinami_23555r']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Рефлекторные светодиодные (LED) фары
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['reflektornye_svetodiodnye_led_fary']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Проекционные светодиодные (LED) фары
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['proekczionnye_svetodiodnye_led_fary']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Глубокая тонировка стекол задних дверей и стекла пятой двери
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['glubokaya_tonirovka_stekol_zadnih_dverej_i_stekla_pyatoj_dveri']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 17" с шинами 225/60R17
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['legkosplavnye_diski_17_s_shinami_22560r17']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электропривод складывания зеркал заднего вида и повторители указателя поворота
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['elektroprivod_skladyvaniya_zerkal_zadnego_vida_i_povtoriteli_ukazatelya_povorota']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Полностью светодиодные фары
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['polnostyu_svetodiodnye_fary']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Две насадки выхлопной трубы (только для версии с двигателем 2.4)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['dve_nasadki_vyhlopnoj_truby_tolko_dlya_versii_s_dvigatelem_24']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Боковой хромированный молдинг (только для версии с двигателем 2.4)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['bokovoj_hromirovannyj_molding_tolko_dlya_versii_s_dvigatelem_24']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Серебристые вставки в переднем и заднем бамперах (только для версии с двигателем 2.4)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('exterior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['serebristye_vstavki_v_perednem_i_zadnem_bamperah_tolko_dlya_versii_s_dvigatelem_24']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                            <div class="equip-config">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Интерьер
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Рулевое колесо и ручка селектора трансмисии с отделкой кожей
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['rulevoe_koleso_i_ruchka_selektora_transmisii_s_otdelkoj_kozhej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передняя панель с отделкой чёрным глянцем
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['perednyaya_panel_s_otdelkoj_chyornym_glyanczem']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Рулевое колесо с отделкой искусственной кожей
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['rulevoe_koleso_s_otdelkoj_iskusstvennoj_kozhej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Задний подлокотник с подстаканниками
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['zadnij_podlokotnik_s_podstakannikami']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Приборная панель с дисплеем 3.5"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['pribornaya_panel_s_displeem_35']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрорегулировка поясничного подпора сиденья водителя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['elektroregulirovka_poyasnichnogo_podpora_sidenya_voditelya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с отделкой из искусственной кожи с серой прострочкой
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sidenya_s_otdelkoj_iz_iskusstvennoj_kozhi_s_seroj_prostrochkoj']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Козырёк панели приборов с отделкой искусственной кожей и чёрные глянцевые элементы
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['kozyryok_paneli_priborov_s_otdelkoj_iskusstvennoj_kozhej_i_chyornye_glyanczevye_elementy']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Элементы интерьера с отделкой матовым хромом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['elementy_interera_s_otdelkoj_matovym_hromom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Дверные вставки из искусственной кожи
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['dvernye_vstavki_iz_iskusstvennoj_kozhi']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Центральный подлокотник спереди с боксом для хранения
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['czentralnyj_podlokotnik_speredi_s_boksom_dlya_hraneniya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрорегулировка водительского сиденья
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['elektroregulirovka_voditelskogo_sidenya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Полноразмерное запасное легкосплавное колесо
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['polnorazmernoe_zapasnoe_legkosplavnoe_koleso']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Задние сиденья со спинками, складывающимися в соотношении 60/40
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['zadnie_sidenya_so_spinkami_skladyvayushhimisya_v_sootnoshenii_6040']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с отделкой тканью Prestige
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sidenya_s_otdelkoj_tkanyu_prestige']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Вставки серого цвета
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['vstavki_serogo_czveta']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Вставки из черного глянца с принтом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['vstavki_iz_chernogo_glyancza_s_printom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Вставки с имитацией прострочки
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['vstavki_s_imitacziej_prostrochki']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Отделка передней панели и дверей вставками под текстуру дерева (Hydro Wood)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['otdelka_perednej_paneli_i_dverej_vstavkami_pod_teksturu_dereva_hydro_wood']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сдвигающийся передний подлокотник c боксом и отделкой искусственной кожей
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sdvigayushhijsya_perednij_podlokotnik_c_boksom_i_otdelkoj_iskusstvennoj_kozhej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Элементы интерьера с отделкой чёрным глянцем
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['elementy_interera_s_otdelkoj_chyornym_glyanczem']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Отделение для очков
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['otdelenie_dlya_ochkov']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрорегулировка поясничной поддержки сидения водителя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['elektroregulirovka_poyasnichnoj_podderzhki_sideniya_voditelya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с отделкой экокожей
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sidenya_s_otdelkoj_ekokozhej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с комбинированной отделкой ткань + эко кожа
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sidenya_s_kombinirovannoj_otdelkoj_tkan_eko_kozha']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с отделкой эко кожей
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sidenya_s_otdelkoj_eko_kozhej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с отделкой тканью
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sidenya_s_otdelkoj_tkanyu']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Внутренние дверные ручки с отделкой хромом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['vnutrennie_dvernye_ruchki_s_otdelkoj_hromom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Центральный подлокотник спереди
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['czentralnyj_podlokotnik_speredi']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Полка багажного отделения
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['polka_bagazhnogo_otdeleniya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Интерьер с комбинированной отделкой "Orange"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['interer_s_kombinirovannoj_otdelkoj_orange']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с отделкой искусственной кожей "Lime"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sidenya_s_otdelkoj_iskusstvennoj_kozhej_lime']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодная подсветка макияжного зеркала водителя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnaya_podsvetka_makiyazhnogo_zerkala_voditelya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодная подсветка макияжного зеркала водителя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnaya_podsvetka_makiyazhnogo_zerkala_voditelya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Светодиодная (LED) подсветка салона
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['svetodiodnaya_led_podsvetka_salona']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Отделка передней панели и дверей вставками под металл (Metal Paint)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['otdelka_perednej_paneli_i_dverej_vstavkami_pod_metall_metal_paint']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Отделка элементов интерьера сатиновым хромом и вставки из чёрного глянца
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['otdelka_elementov_interera_satinovym_hromom_i_vstavki_iz_chyornogo_glyancza']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Дверные панели и центральная консоль с отделкой искусственной кожей
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['dvernye_paneli_i_czentralnaya_konsol_s_otdelkoj_iskusstvennoj_kozhej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с отделкой кожей
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sidenya_s_otdelkoj_kozhej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Отделка передней панели и дверей вставками с изящным узором из тонких линий (Hairline Pad)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['otdelka_perednej_paneli_i_dverej_vstavkami_s_izyashhnym_uzorom_iz_tonkih_linij_hairline_pad']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Динамическая подсветка интерьера Mood lamp с возможностью персонализации настроек (64 цвета)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['dinamicheskaya_podsvetka_interera_mood_lamp_s_vozmozhnostyu_personalizaczii_nastroek_64_czveta']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Декоративная подсветка интерьера Mood Lamp
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['dekorativnaya_podsvetka_interera_mood_lamp']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с отделкой кожей Nappa
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['sidenya_s_otdelkoj_kozhej_nappa']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Элементы передней панели со вставками «под металлик»
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['elementy_perednej_paneli_so_vstavkami_pod_metallik']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Элементы передней панели со вставками «под дерево»
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['elementy_perednej_paneli_so_vstavkami_pod_derevo']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Элементы передней панели с объёмным тиснением и узором
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['elementy_perednej_paneli_s_obyomnym_tisneniem_i_uzorom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Отделка передних и центральных стоек кузова тканью
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['otdelka_perednih_i_czentralnyh_stoek_kuzova_tkanyu']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Пакет светодиодного внутреннего освещения
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['paket_svetodiodnogo_vnutrennego_osveshheniya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сетка для крепления багажа
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['setka_dlya_krepleniya_bagazha']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Акустическая плёнка для окон передних дверей
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['akusticheskaya_plyonka_dlya_okon_perednih_dverej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Разъём USB зарядки для второго ряда
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['razyom_usb_zaryadki_dlya_vtorogo_ryada']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Pазъем USB зарядки в багажнике
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['pazem_usb_zaryadki_v_bagazhnike']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Отделка дверных ручек матовым хромом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['otdelka_dvernyh_ruchek_matovym_hromom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Чёрная глянцевая отделка центральной консоли
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['chyornaya_glyanczevaya_otdelka_czentralnoj_konsoli']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Алюминиевые накладки на пороги
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['alyuminievye_nakladki_na_porogi']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Рулевое колесо и селектор КПП с отделкой кожей
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['rulevoe_koleso_i_selektor_kpp_s_otdelkoj_kozhej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Приборная панель Supervision с цветным дисплеем 4,2"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior = get_field('interior_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($exterior['pribornaya_panel_supervision_s_czvetnym_displeem_42']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                            <div class="equip-config">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Безопасность
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Боковые подушки и шторки безопасности
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['bokovye_podushki_i_shtorki_bezopasnosti']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Фронтальные подушки безопасности
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['frontalnye_podushki_bezopasnosti']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Автоматическая (электронная) система блокировки замков задних дверей от случайного открывания детьми
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['avtomaticheskaya_elektronnaya_sistema_blokirovki_zamkov_zadnih_dverej_ot_sluchajnogo_otkryvaniya_detmi']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Запасное колесо на стальном диске 15"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['zapasnoe_koleso_na_stalnom_diske_15']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Запасное колесо временного использования
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['zapasnoe_koleso_vremennogo_ispolzovaniya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Полноразмерное запасное колесо
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['polnorazmernoe_zapasnoe_koleso']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Ключ с дистанционным управлением центральным замком и багажником 
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['klyuch_s_distanczionnym_upravleniem_czentralnym_zamkom_i_bagazhnikom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Задние дисковые тормоза
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['zadnie_diskovye_tormoza']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система контроля слепых зон BCW
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['sistema_kontrolya_slepyh_zon_bcw']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система предупреждения бокового столкновения при выезде с парковки задним ходом (RCCW)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['sistema_preduprezhdeniya_bokovogo_stolknoveniya_pri_vyezde_s_parkovki_zadnim_hodom_rccw']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Коленная подушка безопасности водителя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['kolennaya_podushka_bezopasnosti_voditelya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                3-ий задний подголовник
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['3-ij_zadnij_podgolovnik']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Приборная панель с дисплеем TFT 4,2"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['pribornaya_panel_s_displeem_tft_42']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Приборная панель Supervision c цветным дисплеем TFT 12,3''
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['pribornaya_panel_supervision_c_czvetnym_displeem_tft_123']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Приборная панель с дисплеем TFT 4,2"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['pribornaya_panel_s_displeem_tft_42']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                3-ий задний подголовник
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['3-ij_zadnij_podgolovnik']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передние датчики парковки
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['perednie_datchiki_parkovki']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Полноразмерное легкосплавное запасное колесо
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['polnorazmernoe_legkosplavnoe_zapasnoe_koleso']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрический Child Lock
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['elektricheskij_child_lock']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Напоминание о пассажирах на заднем ряду (ROA)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['napominanie_o_passazhirah_na_zadnem_ryadu_roa']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система автоматического выравнивания высоты кузова
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['sistema_avtomaticheskogo_vyravnivaniya_vysoty_kuzova']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Ножной стояночный тормоз
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['nozhnoj_stoyanochnyj_tormoz']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрический стояночный тормоз (EPB)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['elektricheskij_stoyanochnyj_tormoz_epb']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Улучшенная система рулевого управления: электроусилитель, установленный на рулевой рейке (R-MDPS)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['uluchshennaya_sistema_rulevogo_upravleniya_elektrousilitel_ustanovlennyj_na_rulevoj_rejke_r-mdps']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Увеличенные передние тормозные диски 17"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['uvelichennye_perednie_tormoznye_diski_17']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система управления тягой в поворотах ATCC (только для версии с полным приводом)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['sistema_upravleniya_tyagoj_v_povorotah_atcc_tolko_dlya_versii_s_polnym_privodom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Стальное запасное колесо временного использования
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $security = get_field('security_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($security['stalnoe_zapasnoe_koleso_vremennogo_ispolzovaniya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                            <div class="equip-config">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Комплекс систем безопасности и помощи водителю Drive Wise
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Система предотвращения фронтального столконовения (FCA) (уровень распознавания: автомобиль/пешеход)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['sistema_predotvrashheniya_frontalnogo_stolkonoveniya_fca_uroven_raspoznavaniya_avtomobilpeshehod']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Современные системы помощи водителю DRIVE WISE
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['sovremennye_sistemy_pomoshhi_voditelyu_drive_wise']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система контроля слепых зон (BCW)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['sistema_kontrolya_slepyh_zon_bcw']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Камеры для контроля слепых зон с отображением на панель приборов (BVM)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['kamery_dlya_kontrolya_slepyh_zon_s_otobrazheniem_na_panel_priborov_bvm']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система предотвращения столкновения при выезде с парковки задним ходом (PCA)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['sistema_predotvrashheniya_stolknoveniya_pri_vyezde_s_parkovki_zadnim_hodom_pca']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Интеллектуальный круиз-контроль (SCC) с функцией Stop&Go
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['intellektualnyj_kruiz-kontrol_scc_s_funkcziej_stopgo']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система предотвращения выезда из полосы движения (LKA)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['sistema_predotvrashheniya_vyezda_iz_polosy_dvizheniya_lka']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система предупреждения при выезде с парковки задним ходом (RCCW)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['sistema_preduprezhdeniya_pri_vyezde_s_parkovki_zadnim_hodom_rccw']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Ассистент движения в полосе (LFA)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['assistent_dvizheniya_v_polose_lfa']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система предотвращения столкновения с автомобилем в слепой зоне (BCA)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['sistema_predotvrashheniya_stolknoveniya_s_avtomobilem_v_slepoj_zone_bca']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Камеры отображения изображения в слепых зонах на панель приборов (BVM)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['kamery_otobrazheniya_izobrazheniya_v_slepyh_zonah_na_panel_priborov_bvm']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система предупреждения бокового столкновения при выезде с парковки задним ходом (RCCA)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['sistema_preduprezhdeniya_bokovogo_stolknoveniya_pri_vyezde_s_parkovki_zadnim_hodom_rcca']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система безопасного выхода из автомобиля (SEA)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['sistema_bezopasnogo_vyhoda_iz_avtomobilya_sea']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система контроля внимания водителя (DAW)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['sistema_kontrolya_vnimaniya_voditelya_daw']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Ассистент управления дальним светом (HBA)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $drive_options = get_field('drive_wise_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($drive_options['assistent_upravleniya_dalnim_svetom_hba']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                            <div class="equip-config">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Комфорт
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Кондиционер
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['kondiczioner']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система интеллектуального открывания багажника
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sistema_intellektualnogo_otkryvaniya_bagazhnika']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Регулировка рулевой колонки по вылету
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['regulirovka_rulevoj_kolonki_po_vyletu']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрорегулировка передних сидений
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['elektroregulirovka_perednih_sidenij']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Мультимедиасистема 7'', с поддержкой Apple Carplay и Android Auto
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['multimediasistema_7_s_podderzhkoj_apple_carplay_i_android_auto']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Камера заднего вида
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['kamera_zadnego_vida']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Дополнительная USB-розетка для быстрой подзарядки
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['dopolnitelnaya_usb-rozetka_dlya_bystroj_podzaryadki']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Беспроводная зарядка мобильного телефона в центральной консоли
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['besprovodnaya_zaryadka_mobilnogo_telefona_v_czentralnoj_konsoli']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Дополнительная розетка питания в багажном отделении
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['dopolnitelnaya_rozetka_pitaniya_v_bagazhnom_otdelenii']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Раздельный климат-контроль
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['razdelnyj_klimat-kontrol']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Приборная панель Supervision c монохромным дисплеем TFT 3.5''
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['pribornaya_panel_supervision_c_monohromnym_displeem_tft_35']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Интеллектуальная система открывания багажника (Smart Tailgate)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['intellektualnaya_sistema_otkryvaniya_bagazhnika_smart_tailgate']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Дистанционный запуск двигателя (для Smart Key)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['distanczionnyj_zapusk_dvigatelya_dlya_smart_key']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Мультимедийная система 10.25" с поддержкой Apple Carplay/Android Auto
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['multimedijnaya_sistema_1025_s_podderzhkoj_apple_carplayandroid_auto']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Кондиционер для третьего ряда сидений
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['kondiczioner_dlya_tretego_ryada_sidenij']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Солнцезащитные шторки для 2-го ряда
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['solnczezashhitnye_shtorki_dlya_2-go_ryada']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Беспроводная зарядка для мобильных устройств
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['besprovodnaya_zaryadka_dlya_mobilnyh_ustrojstv']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Раздельный климат-контроль с системой антизапотевания
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['razdelnyj_klimat-kontrol_s_sistemoj_antizapotevaniya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрорегулировка поясничного подпора сиденья водителя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['elektroregulirovka_poyasnichnogo_podpora_sidenya_voditelya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрорегулировки передних сидений: 10 для водителя, 8 для пассажира
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['elektroregulirovki_perednih_sidenij_10_dlya_voditelya_8_dlya_passazhira']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Разъём USB 2-го ряда сидений для подзарядки мобильных устройств
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['razyom_usb_2-go_ryada_sidenij_dlya_podzaryadki_mobilnyh_ustrojstv']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Камера заднего вида с динамическими линиями парковки
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['kamera_zadnego_vida_s_dinamicheskimi_liniyami_parkovki']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Климат-контроль
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['klimat-kontrol']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Двухзонный автоматический климат-контроль
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['dvuhzonnyj_avtomaticheskij_klimat-kontrol']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Регулировка сиденья водителя по высоте
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['regulirovka_sidenya_voditelya_po_vysote']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрорегулировка сиденья пассажира по 10-и направлениям (включая 2 направления поясницы)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['elektroregulirovka_sidenya_passazhira_po_10-i_napravleniyam_vklyuchaya_2_napravleniya_poyasniczy']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передние и задние стеклоподъёмники с электроприводом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['perednie_i_zadnie_steklopodyomniki_s_elektroprivodom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передние и задние стеклоподъёмники с функцией Auto
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['perednie_i_zadnie_steklopodyomniki_s_funkcziej_auto']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Задние стеклоподъёмники с электроприводом и стеклоподъёмник водителя с функцией Auto
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['zadnie_steklopodyomniki_s_elektroprivodom_i_steklopodyomnik_voditelya_s_funkcziej_auto']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Стеклоподъемник водителя с функцией Auto
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['steklopodemnik_voditelya_s_funkcziej_auto']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Стеклоподъёмник переднего пассажира c функцией Auto
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['steklopodyomnik_perednego_passazhira_c_funkcziej_auto']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система выбора режима движения Drive Mode Select (кроме версий с механической трансмиссией)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sistema_vybora_rezhima_dvizheniya_drive_mode_select_krome_versij_s_mehanicheskoj_transmissiej']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Стеклоподъемники водителя и переднего пассажира с функцией Auto
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['steklopodemniki_voditelya_i_perednego_passazhira_s_funkcziej_auto']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Регулируемый центральный подлокотник
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['reguliruemyj_czentralnyj_podlokotnik']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Задний подлокотник с подстаканниками
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['zadnij_podlokotnik_s_podstakannikami']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Бескаркасные стеклоочистители "Aero Blade"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['beskarkasnye_stekloochistiteli_aero_blade']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Атермальные лобовое и боковые передние стёкла
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['atermalnye_lobovoe_i_bokovye_perednie_styokla']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электропривод складывания боковых зеркал заднего вида
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['elektroprivod_skladyvaniya_bokovyh_zerkal_zadnego_vida']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Ключ с дистанционным управлением центральным замком
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['klyuch_s_distanczionnym_upravleniem_czentralnym_zamkom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Ключ с дистанционным управлением центральным замком и багажником
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['klyuch_s_distanczionnym_upravleniem_czentralnym_zamkom_i_bagazhnikom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система бесключевого доступа Smart Key и запуск двигателя кнопкой
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sistema_besklyuchevogo_dostupa_smart_key_i_zapusk_dvigatelya_knopkoj']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Датчик света
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['datchik_sveta']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Датчик дождя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['datchik_dozhdya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Автоматическое запирание дверей при движении 
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['avtomaticheskoe_zapiranie_dverej_pri_dvizhenii']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Приборная панель Supervision c цветным дисплеем TFT 4.2''
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['pribornaya_panel_supervision_c_czvetnym_displeem_tft_42']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Полностью цифровая приборная панель Supervision с цветным TFT дисплеем 12.3''
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['polnostyu_czifrovaya_pribornaya_panel_supervision_s_czvetnym_tft_displeem_123']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Приборная панель с дисплеем 3.5"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['pribornaya_panel_s_displeem_35']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Проекционный дисплей 8"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['proekczionnyj_displej_8']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Проекционный экран (HUD)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['proekczionnyj_ekran_hud']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Мультифункциональное рулевое колесо
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['multifunkczionalnoe_rulevoe_koleso']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Круиз-контроль с ограничителем скорости
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['kruiz-kontrol_s_ogranichitelem_skorosti']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Круиз-контроль
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['kruiz-kontrol']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Аудиоподготовка (2 динамика)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['audiopodgotovka_2_dinamika']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Аудиосистема с 6 динамиками
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['audiosistema_s_6_dinamikami']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Аудиосистема с радио, USB (4 динамика)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['audiosistema_s_radio_usb_4_dinamika']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Аудиосистема BOSE c 12 динамиками
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['audiosistema_bose_c_12_dinamikami']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Аудиосистема с дисплеем 8", с радио, USB вход, Android Auto и Apple Car Play
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['audiosistema_s_displeem_8_s_radio_usb_vhod_android_auto_i_apple_car_play_6_dinamikov']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Навигационная система 10,25" с радио, MP3, RDS
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['navigaczionnaya_sistema_1025_s_radio_mp3_rds']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Bluetooth для подключения мобильного телефона
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['bluetooth_dlya_podklyucheniya_mobilnogo_telefona']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Камера заднего вида c динамической разметкой
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['kamera_zadnego_vida_c_dinamicheskoj_razmetkoj']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передние датчики парковки
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['perednie_datchiki_parkovki']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Задние датчики парковки
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['zadnie_datchiki_parkovki']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передние и задние датчики парковки
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['perednie_i_zadnie_datchiki_parkovki']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Подголовники передних сидений, регулируемые вперед/назад
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['podgolovniki_perednih_sidenij_reguliruemye_vperednazad']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрический стояночный тормоз (EPB) c функцией Autohold
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['elektricheskij_stoyanochnyj_tormoz_epb_c_funkcziej_autohold']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Интеллектуальный круиз-контроль, помощник движения в пробке SCC
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['intellektualnyj_kruiz-kontrol_pomoshhnik_dvizheniya_v_probke_scc']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электромеханический стояночный тормоз (EPB)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['elektricheskij_stoyanochnyj_tormoz_epb_c_funkcziej_autohold']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Приборная панель Supervision с дисплеем 4.2"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['pribornaya_panel_supervision_s_displeem_42']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Приборная панель с дисплеем 7" Supervision
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['pribornaya_panel_s_displeem_7_supervision']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Салонное зеркало с автоматическим затемнением (ECM)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['salonnoe_zerkalo_s_avtomaticheskim_zatemneniem_ecm']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Камера заднего вида с динамическими линиями разметки
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['kamera_zadnego_vida_s_dinamicheskimi_liniyami_razmetki']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Дистанционный запуск двигателя с ключа
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['distanczionnyj_zapusk_dvigatelya_s_klyucha']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Дефлекторы обдува для пассажиров второго ряда
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['deflektory_obduva_dlya_passazhirov_vtorogo_ryada']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Автоматическая система предотвращения запотевания лобового стекла
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['avtomaticheskaya_sistema_predotvrashheniya_zapotevaniya_lobovogo_stekla']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Интеллектуальная система открывания багажника
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['intellektualnaya_sistema_otkryvaniya_bagazhnika']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сидение водителя с электроприводом регулировок и поясничного подпора
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sidenie_voditelya_s_elektroprivodom_regulirovok_i_poyasnichnogo_podpora']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сидение пассажира с электроприводом регулировок и поясничного подпора
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sidenie_passazhira_s_elektroprivodom_regulirovok_i_poyasnichnogo_podpora']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Память настроек положения сиденья водителя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['pamyat_nastroek_polozheniya_sidenya_voditelya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Комфортное пассажирское сиденье с дополнительной настройкой положения релаксации “Relaxation seat”
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['komfortnoe_passazhirskoe_sidene_s_dopolnitelnoj_nastrojkoj_polozheniya_relaksaczii_relaxation_seat']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Вентиляция передних сидений
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['ventilyacziya_perednih_sidenij']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Система кругового обзора с 4 камерами
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sistema_krugovogo_obzora_s_4_kamerami']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Атмосферная подсветка интерьера Mood lamp
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['atmosfernaya_podsvetka_interera_mood_lamp']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрохромное зеркало заднего вида (ECM)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['elektrohromnoe_zerkalo_zadnego_vida_ecm']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Электрохромное зеркало заднего вида
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['elektrohromnoe_zerkalo_zadnego_vida']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                10 электрорегулировок сиденья водителя (включая 2 направления поясницы)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['10_elektroregulirovok_sidenya_voditelya_vklyuchaya_2_napravleniya_poyasniczy']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                14 электрорегулировок сиденья водителя (включая 4 направления поясницы) с функцией памяти
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['14_elektroregulirovok_sidenya_voditelya_vklyuchaya_4_napravleniya_poyasniczy_s_funkcziej_pamyati']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Складывание 50/50 сидений 3-го ряда
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['skladyvanie_5050_sidenij_3-go_ryada']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Дистанционное складывание сидений 2-го ряда со стороны багажника
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('comfort_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['distanczionnoe_skladyvanie_sidenij_2-go_ryada_so_storony_bagazhnika']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                            <div class="equip-config">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Пакет GT Line
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Спортивный дизайн переднего и заднего бамперов
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sportivnyj_dizajn_perednego_i_zadnego_bamperov']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Боковой молдинг и решетка радиатора со спортивным акцентом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['bokovoj_molding_i_reshetka_radiatora_so_sportivnym_akczentom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Решетка радиатора с черными глянцевыми вставками
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['reshetka_radiatora_s_chernymi_glyanczevymi_vstavkami']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Двойная хромированная насадка глушителя
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['dvojnaya_hromirovannaya_nasadka_glushitelya']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Спортивное рулевое колесо "GT Line"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sportivnoe_rulevoe_koleso_gt_line']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Алюминиевые накладки на педали
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['alyuminievye_nakladki_na_pedali']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с отделкой искусственной кожей "GT Line"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sidenya_s_otdelkoj_iskusstvennoj_kozhej_gt_line']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 16'' с шинами 195/45R16
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['legkosplavnye_diski_16_s_shinami_195_45_r16']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 19" с шинами 245/45R дизайна "GT Line"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['legkosplavnye_diski_19_s_shinami_24545r_dizajna_gt_line']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 18" с шинами 235/45R18
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['legkosplavnye_diski_18_s_shinami_23545r18']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Легкосплавные диски 17" с шинами 215/55R17
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['legkosplavnye_diski_16_s_shinami_195_45_r16']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Решётка радиатора спортивного дизайна
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['reshyotka_radiatora_sportivnogo_dizajna']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Спортивный передний бампер
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sportivnyj_perednij_bamper']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Отделка потолка и стоек кузова чёрного цвета
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['otdelka_potolka_i_stoek_kuzova_chyornogo_czveta']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Спортивное рулевое колесо с эмблемой "GT Line"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sportivnoe_rulevoe_koleso_s_emblemoj_gt_line']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Спойлер на крышке багажника (чёрного цвета)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['spojler_na_kryshke_bagazhnika_chyornogo_czveta']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Алюминиевые накладки на педали и пороги
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['alyuminievye_nakladki_na_pedali_i_porogi']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Подрулевые "лепестки" переключения передач
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['podrulevye_lepestki_pereklyucheniya_peredach']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Эмблема GT Line
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['emblema_gt_line']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Внешние элементы из матового хрома
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['vneshnie_elementy_iz_matovogo_hroma']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Отделка салона красной прострочкой "GT Line"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['otdelka_salona_krasnoj_prostrochkoj_gt_line']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Спортивное, усечённое внизу рулевое колесо
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sportivnoe_usechyonnoe_vnizu_rulevoe_koleso']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Глянцевая чёрная решётка "GT Line"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['glyanczevaya_chyornaya_reshyotka_gt_line']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Лепестки переключения передач на руле
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['lepestki_pereklyucheniya_peredach_na_rule']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Спортивные металлические педали
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['sportivnye_metallicheskie_pedali']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Отделка порога багажника нержавеющей сталью
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['otdelka_poroga_bagazhnika_nerzhaveyushhej_stalyu']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Передний и задний бамперы дизайна GT Line
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['perednij_i_zadnij_bampery_dizajna_gt_line']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Боковые обвесы с красными вставками
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['bokovye_obvesy_s_krasnymi_vstavkami']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Глянцевая решётка радиатора с хромированной окантовкой
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['glyanczevaya_reshyotka_radiatora_s_hromirovannoj_okantovkoj']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Красная прострочка элементов салона (подлокотник, руль, дверные вставки, козырек панели приборов и рукоятке КПП)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $comfort = get_field('gt_line_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($comfort['krasnaya_prostrochka_elementov_salona_podlokotnik_rul_dvernye_vstavki_kozyrek_paneli_priborov_i_rukoyatke_kpp']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                            <div class="equip-config">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Пакет Style
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Решётка радиатора отделкой чёрным глянцем и спортивным красным акцентом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $style = get_field('paket_style_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($style['reshyotka_radiatora_otdelkoj_chyornym_glyanczem_i_sportivnym_krasnym_akczentom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Ниши противотуманных фар со спортивным красным акцентом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $style = get_field('paket_style_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($style['nishi_protivotumannyh_far_so_sportivnym_krasnym_akczentom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Тёмные легкосплавные диски Style 15'' с шинами 185/65R15
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $style = get_field('paket_style_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($style['tyomnye_legkosplavnye_diski_style_15_s_shinami_18565r15']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Спортивный красный молдинг на центральной панели
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $style = get_field('paket_style_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($style['sportivnyj_krasnyj_molding_na_czentralnoj_paneli']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Рулевое колесо и селектор трансмиссии с красной прострочкой
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $style = get_field('paket_style_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($style['rulevoe_koleso_i_selektor_transmissii_s_krasnoj_prostrochkoj']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Сиденья с отделкой тканью Style и красной прострочкой
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $style = get_field('paket_style_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($style['sidenya_s_otdelkoj_tkanyu_style_i_krasnoj_prostrochkoj']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                            <div class="equip-config">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Пакет Black Edition
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                Чёрные элементы внешней отделки (боковые молдинги и накладки на бамперы)
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $black_edition = get_field('paket_black_edition_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($black_edition['chyornye_elementy_vneshnej_otdelki_bokovye_moldingi_i_nakladki_na_bampery']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Чёрная решётка радиатора нового дизайна "Black Edition"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $black_edition = get_field('paket_black_edition_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($black_edition['chyornaya_reshyotka_radiatora_novogo_dizajna_black_edition']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Затемненные эмблемы "Kia" спереди и сзади, "AWD"
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $black_edition = get_field('paket_black_edition_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($black_edition['zatemnennye_emblemy_kia_speredi_i_szadi_awd']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Чёрные рейлинги
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $black_edition = get_field('paket_black_edition_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($black_edition['chyornye_rejlingi']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Чёрные легкосплавные диски 17" с шинами 225/60 R17
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $black_edition = get_field('paket_black_edition_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($black_edition['chyornye_legkosplavnye_diski_17_s_shinami_22560_r17']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Чёрная эмблема "SPORTAGE", расположенная по центру дверцы багажного отсека
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $black_edition = get_field('paket_black_edition_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($black_edition['chyornaya_emblema_sportage_raspolozhennaya_po_czentru_dverczy_bagazhnogo_otseka']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                            <div class="equip-config">
                                <!-- ONE SECTION -->
                                <section class="equip-config-section">
                                    <!-- MAIN TITLE-->
                                    <h2 class="equip-config-section-title">
                                        Мультимедиа
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-header">
                                                4 динамика
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['4_dinamika']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Управление аудиосистемой на руле
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['upravlenie_audiosistemoj_na_rule']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                6 динамиков
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['6_dinamikov']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Аудиосистема с радио и USB входом
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['audiosistema_s_radio_i_usb_vhodom']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Мультимедийная система с 8'' дисплеем с поддержкой Android Auto и Apple Carplay
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['multimedijnaya_sistema_s_8_displeem_s_podderzhkoj_android_auto_i_apple_carplay']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Навигационная система с 10.25" цветным дисплеем, с поддержкой пробок, Android Auto и Apple Carplay
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['navigaczionnaya_sistema_s_1025_czvetnym_displeem_s_podderzhkoj_probok_android_auto_i_apple_carplay']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                USB-зарядка для пассажиров второго ряда
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['usb-zaryadka_dlya_passazhirov_vtorogo_ryada']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Bluetooth для подключения мобильного телефона
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['bluetooth_dlya_podklyucheniya_mobilnogo_telefona']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Аудиосистема BOSE с 12 динамиками, включая сабвуфер
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['audiosistema_bose_s_12_dinamikami_vklyuchaya_sabvufer']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                2 USB разьема для зарядки мобильных устройств для пассажиров второго ряда
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['2_usb_razema_dlya_zaryadki_mobilnyh_ustrojstv_dlya_passazhirov_vtorogo_ryada']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                                Беспроводная зарядка мобильного телефона
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $multimedia = get_field('multimedia_options', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($multimedia['besprovodnaya_zaryadka_mobilnogo_telefona']) : ?>
                                                                    <svg>
                                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                                                    </svg>
                                                                    <?php else : ?>
                                                                    <span class="d-block"> — </span>
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
                                        Цвета кузова
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $exterior_colors = get_field('exterior_colors', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div class="model-colors">
                                                                    <?php foreach ((array)$exterior_colors as $color) : ?>
                                                                    <span class="model-colors-item" style="<?php if ($color['is_second_color']) : ?>background: linear-gradient(to bottom, <?= $color['color_hex'] ?> 50%, <?= $color['second_color'] ?> 50%)<?php else : ?>background: <?= $color['color_hex'] ?><?php endif;?>">
                                                                        <span class="model-colors-item-name">
                                                                            <span class="model-colors-item-name-inner">
                                                                                <?= $color['color_name'] ?>
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                    <?php endforeach; ?>
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
                                        Варианты интерьера
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                            <path d="M5 8l5 5 5-5" stroke="currentColor" stroke-width="2"></path>
                                        </svg>
                                    </h2>
                                    <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                                    <div class="equip-config-section-items">
                                        <!-- ONE SECTION CAROUSEL ITEM-->
                                        <div class="equip-config-section-item">
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $interior_variants = get_field('interior_variants', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div class="model-colors">
                                                                    <?php foreach ((array)$interior_variants as $color) : ?>
                                                                    <?php if ($color) : ?>
                                                                    <span class="model-colors-item" style="<?php if ($color['is_second_color']) : ?>background: linear-gradient(to bottom, <?= $color['color_hex'] ?> 50%, <?= $color['second_color'] ?> 50%)<?php else : ?>background: <?= $color['color_hex'] ?><?php endif;?>">
                                                                        <span class="model-colors-item-name">
                                                                            <span class="model-colors-item-name-inner">
                                                                                <?= $color['color_name'] ?>
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                                    <?php else: ?>
                                                                    —
                                                                    <?php endif; ?>
                                                                    <?php endforeach; ?>
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
                                        Технические характеристики
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
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
                                        Спецификация
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
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
                                                Год производства
                                            </div>
                                            <div class="equip-config-section-item-carousel">
                                                <!-- SWIPER STARTS-->
                                                <div class="swiper-container equip-config-section-item-carousel-container">
                                                    <div class="swiper-wrapper equip-config-section-item-carousel-wrapper">
                                                        
                                                        <?php foreach ($configs->posts as $post) : ?>
                                                            <?php $production_year = get_field('production_year', $post->ID); ?>
                                                            <!-- SWIPER ITEMS START-->
                                                            <div class="swiper-slide equip-config-section-item-carousel-slide">
                                                                <div> 
                                                                    <?php if ($production_year) : ?>
                                                                    <?= $production_year ?>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>