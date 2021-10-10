<?php get_header();
$current_post = get_post();?>
<?php get_template_part( 'template-parts/content', 'header-models', [ 'parent_post' => $current_post, ] ); ?>
<div class="hero-model" style="background: url(<?= get_field('model_hero_bg', get_the_ID()) ?>) no-repeat center center /cover gray;">
    <?php if (get_field('model_hero_video', get_the_ID())) : ?>
    <video class="hero-model-video" autoplay loop style="background: url(<?= get_field('model_hero_bg', get_the_ID()) ?>) no-repeat center center /cover gray;">
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
                        <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs();?>
                        <!--<div class="hero-model-minprice">
                            <span>от <?= $GLOBALS['model_min_price']; ?> ₸</span>
                        </div>-->
                    </div>
                    <div class="hero-model-bottom d-flex">
                        <div class="hero-model-title">
                            <span class=""> <?= get_field('model_logo_top', get_the_ID()); ?> </span>
                            <div class="hero-model-title-name">
                                <img src="<?= get_field('model_logo', get_the_ID()); ?>" alt="<?= get_the_title( get_the_ID() ) ?>">
                            </div>
                            <div class="hero-model-title-sub">
                                <?= get_field('model_hero_short_text', get_the_ID());?>                              
                            </div>
                        </div>
                        <?php
                        if( have_rows('model_option') ): ?>
                            <div class="hero-model-desc">
                                <ul class="d-flex">
                                    <?php
                                    while( have_rows('model_option') ) : the_row();?>
                                        <li>
                                            <div class="hero-model-desc-item">
                                                <div class="hero-model-desc-item-icon">
                                                    <img class="d-block" src="<?php the_sub_field('model_option_icon');?>" alt="description">
                                                </div>
                                                <div class="hero-model-desc-item-sub">
                                                    <?php the_sub_field('model_option_description');?>
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
            <?php if( have_rows('body_colors') ): ?>
            <div class="model-sections">
                <!-- COLORS SECTION-->
                <div class="model-sections-inner-wide">
                    <div class="model-sections-colors"> <!-- MAIN BLOCK FOR COLORS-->
                        <div class="model-sections-colors-header">
                            <?php the_title(); ?>
                        </div>
                        <div class="model-sections-colors-image-wrapper d-flex justify-content-center">
                            <!-- COLORS IMAGE-->
                            <div class="model-sections-colors-image">
                                <img src="" alt="model"> <!-- COLOR IMAGE-->
                            </div> <!-- REQUIRED CLASS MODEL SECTION COLORS IMAGE-->
                        </div>
                        <div class="model-sections-colors-option mt-30">
                            <div class="model-sections-colors-exterior">
                                <div class="description-list">
                                    <div class="model-sections-colors-exterior-desc">
                                        Цвет:
                                        <span><!-- COLOR NAME--></span>
                                    </div>
                                </div>
                                <!-- COLORS LIST EXTERIOR-->   
                                <div class="color-list">
                                    <!-- LIST ITEMS -->
                                    <?php
                                    
                                    $body_colors = get_field('body_colors');
                                    foreach ($body_colors as $body_color) {
                                        if ($body_color['two_colors'] == 0) {
                                            $body_color['body_colors_group']['body_colors_second'] =
                                            $body_color['body_colors_group']['body_colors_first'];
                                        } ?>
                                        <span
                                            data-text="<?php echo $body_color['body_color_name'];?>"
                                            data-src="<?php echo $body_color['body_color_image'];?>"
                                            class="color-list-item"
                                            style="
                                                background: linear-gradient(to bottom,
                                                    <?php echo $body_color['body_colors_group']['body_colors_first']; ?> 50%,
                                                    <?php echo $body_color['body_colors_group']['body_colors_second'];  ?> 50%); 
                                            ">
                                        </span>
                                    <?php } ?>
                                </div>                          
                            </div>
                            <div class="model-sections-colors-interior">
                                <div class="description-list">
                                    <div>
                                        Интерьер:
                                        <span>Черный, Искусственная кожа с серой прострочкой (WK)</span>
                                    </div>                                      
                                </div>
                                <!-- COLORS LIST INTERIOR-->   
                                <div class="color-list">
                                    <span class="color-list-item active" style="background: rgba(0, 0, 0, 0.8);"></span>
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
                'order' => 'asc'
            ]);
            ?>
            <div class="model-sections">
                <!-- VARIATIONS OF EQUIPMENT-->
                <div class="model-sections-inner background-gray">
                    <div class="model-sections-variations">
                        <div class="model-sections-title-centered model-sections-title">
                            <span class="model-sections-title-sub">
                                Комплектации
                            </span>
                            <div class="model-sections-title-header">
                                Варианты <?php the_title();?>
                            </div>
                        </div>
                        <div class="model-sections-variations-bottom">
                            <div class="model-sections-variations-bottom-sub">
                                <?php echo count($configs->posts) . ' ';?> доступных комплектаций
                            </div>
                            <!-- MORE BUTTON TO ANOTHER PAGE-->
                            <a href="/models/<?= $current_model ?>/complectations" class="model-sections-variations-bottom-more model-sections-desc-more underlined underlined-black">
                                Комплектации и цены
                            </a>
                        </div>

                        <div class="model-sections-variations-slider">
                            <!-- SLIDER MAIN CONTAINER -->
                            <div class="swiper-container model-sections-variations-container">
                                <!-- ADDITIONAL REQUIRED WRAPPER -->
                                <div class="swiper-wrapper model-sections-variations-wrapper">
                                    <?php
                                    foreach ($configs->posts as $post) {
                                        $current_post_ID = $post->ID; ?>
                                        <!-- SLIDES -->
                                        <div class="swiper-slide model-sections-variations-slide">
                                            <div class="model-sections-variations-slide-inner">
                                                <div class="title">
                                                    <?php echo esc_html( get_the_title($current_post_ID) );?>
                                                    <span class="price">
                                                        <?php echo esc_attr(the_field('price', $current_post_ID))?> ₸
                                                    </span>
                                                </div>
                                                <div class="content">
                                                    <ul>
                                                        <li>
                                                            <span class="content-header">Двигатель и трансмиссия</span>
                                                            <p>
                                                                <?php echo get_field('engine', $current_post_ID) .' / '.
                                                                get_field('power', $current_post_ID) .' л.с / '.
                                                                get_field('engine_type', $current_post_ID) .' / '.
                                                                get_field('transmission', $current_post_ID) .' / '.
                                                                get_field('drive_wheels', $current_post_ID); ?>
                                                            </p>
                                                        </li>
                                                        <li>
                                                            <span class="content-header">Основные опции</span>
                                                            <?php while( have_rows('main_options', $current_post_ID) ) : the_row(); ?>
                                                                <p><?php the_sub_field('options_item'); ?></p>
                                                            <?php endwhile;?>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- MORE BUTTON TO ANOTHER PAGE-->
                                                <div class="button">
                                                    <a href="/models/<?= $current_model ?>/complectations" class="content-more model-sections-desc-more underlined underlined-green">
                                                        Комплектации и цены
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
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
            <!-- BOTTOM SECTION-->
            <div class="model-sections">
                <div class="model-sections-bottom-block">
                    <div class="model-sections-bottom-block-bg">
                    <?php wp_reset_query();?>
                        <img src="<?php the_field('bottom_section_image', get_the_ID())?>" alt="background">
                    </div>
                    <div class="model-sections-inner-wide">
                        <div class="model-sections-bottom-block-inner">
                            <div class="model-sections-title-centered">
                                <span class="model-sections-title-sub model-sections-bottom-block-sub">
                                    Консультация
                                </span>
                                <div class="model-sections-title-header model-sections-bottom-block-header">
                                    Узнайте больше о <?php the_title(); ?>
                                </div>
                                
                                <div class="model-sections-bottom-block-btn  btn-wrapper btn-wrapper-lg btn-wrapper-white">
                                    <a href="/callback" class="btn">
                                        Заказать звонок дилера
                                    </a>
                                </div>
                            </div>
                            <div class="model-sections-bottom-block-image">
                                <picture>
                                <source
                                    media="(max-width: 524px)"
                                    srcset="<?php the_field('bottom_section_car_image_small', get_the_ID());?>">
                                    <img src="<?php the_field('bottom_section_car_image_medium', get_the_ID());?>" alt="model">
                                </picture>
                            </div>
                        </div>
                        <?php
                        if( have_rows('useful_links', get_the_ID()) || have_rows( 'useful_docs', get_the_ID())):
                            $useful_links = get_field('useful_links', get_the_ID());
                            $useful_docs = get_field('useful_docs', get_the_ID()); ?>
                            <div class="model-sections-bottom-block-links">
                            <?php
                                foreach ($useful_links as $link) {
                                    $link_text =  $link['useful_link']['useful_link_text'];
                                    $link_link = $link['useful_link']['useful_link_link'];
                                ?>
                                <a href="<?php echo esc_url($link_link)?>" class="model-sections-bottom-block-links-item">
                                    <img src="<?php echo esc_url($link['choose_link_icon'])?>" alt="icon">
                                    <span class="underlined underlined-black model-sections-bottom-block-more d-flex align-items-center">
                                        <?php echo esc_html($link_text)?>
                                    </span>
                                </a>
                                <?php }
                            
                                foreach ($useful_docs as $doc) {
                                    $doc_text =  $doc['useful_doc']['useful_doc_text'];
                                    $doc_link = $doc['useful_doc']['useful_doc_link'];
                                ?>
                                <a href="<?php echo esc_url($doc_link)?>" class="model-sections-bottom-block-links-item">
                                    <img src="<?php echo esc_url($doc['choose_doc_icon'])?>" alt="icon">
                                    <span class="underlined underlined-black model-sections-bottom-block-more d-flex align-items-center">
                                        <?php echo esc_html($doc_text)?>
                                    </span>
                                </a>
                                <?php } ?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div> <!--ROW-->
    </div><!--FLUID CONTAINER-->
</div>
<?php get_footer(); ?>