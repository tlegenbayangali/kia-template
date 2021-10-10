<?php

get_header();

$current_model = wp_get_post_terms(get_the_ID(), 'model', 'names');

$gallery = get_field('gallery', get_the_ID());

$credit_offers = new WP_Query([
    'post_type' => 'credit-programms',
    'model' => $current_model[0]->name
]);

?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<section class="heading" id="heading">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="fz-50 mt-30 mb-30"><?= $current_model[0]->name ?> <?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</section>
<section class="config-single section-divided" id="config-single">
    <div class="container-fluid">
        <div class="row row-divided">
            <div class="col-lg-4">
                <aside class="py-30 pr-60">
                    <div class="config-single-price">
                        <span class="d-block fz-25 fw-700">
                            <?= get_field('price', get_the_ID()) ?> ₸
                        </span>
                        <span class="d-block fz-15">
                            <?= price_for_month('price', get_the_ID(), 36) ?> ₸/мес
                        </span>
                        <div class="mt-30">
                            <a href="/callback" class="w-100-p tac btn btn-black btn-md">
                                Забронировать автомобиль
                            </a>
                            <a href="/models/<?= $current_model[0]->slug ?>/credit" class="w-100-p mt-10 tac btn btn-white-outline btn-md">
                                Расчитать кредит
                            </a>
                        </div>
                        <div class="config-info mt-30">
                            <div class="config-info-item">
                                <span class="c-dgray">Двигатель:</span>
                                <span id="engine-field">
                                    <?= get_field('engine', get_the_ID()) ?> / <?= get_field('power', get_the_ID()) ?> л.с. / <?= get_field('engine_type', get_the_ID()) ?>
                                </span>
                            </div>
                            <div class="config-info-item">
                                <span class="c-dgray">Коробка передач:</span>
                                <span id="engine-field">
                                    <?= get_field('transmission', get_the_ID()) ?>
                                </span>
                            </div>
                            <div class="config-info-item">
                                <span class="c-dgray">Привод:</span>
                                <span id="engine-field">
                                    <?= get_field('drive_wheels', get_the_ID()) ?>
                                </span>
                            </div>
                            <div class="config-info-item">
                                <span class="c-dgray">Год производства:</span>
                                <span id="engine-field">
                                    <?= get_field('production_year', get_the_ID()) ?>
                                </span>
                            </div>
                            <div class="config-info-item">
                                <span class="c-dgray">Модельный год:</span>
                                <span id="engine-field">
                                    <?= get_field('production_year', get_the_ID()) ?>
                                </span>
                            </div>
                        </div>
                        <hr>
                        <a href="#" class="car-info-documents-item">
                            <svg class="file">
                                <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#file"></use>
                            </svg>
                            <span>
                                Скачать PDF
                            </span>
                            <svg class="arrow-bottom">
                                <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#arrow-bottom"></use>
                            </svg>
                        </a>
                    </div>
                </aside>
            </div>
            <div class="col-lg-8">
                <section class="content py-30 pl-60" id="content">
                    <?php if ($gallery) : ?>
                    <div class="slider-with-thumbs large swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php foreach ($gallery as $image) : ?>
                            <div class="swiper-slide">
                                <div class="slider-item">
                                    <?= wp_get_attachment_image( $image['gallery_item'], 'full' ); ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
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
                    <div class="slider-with-thumbs small mt-30 swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <?php foreach ($gallery as $image) : ?>
                            <div class="swiper-slide">
                                <div class="slider-item">
                                    <?= wp_get_attachment_image( $image['gallery_item'], 'full' ); ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <p class="c-dgray fz-12 mt-20">Изображение может не соответствовать выбранной комплектации. Цвет автомобиля может отличаться от представленного на данном сайте. </p>
                    <div class="offers mt-60">
                        <h3 class="fz-25 mb-30">Спецпредложения <?= $current_model[0]->name ?></h3>
                        <div class="offers-group">
                            <?php foreach ($credit_offers->posts as $offer) : ?>
                                <button class="swiper-slide parameter-item tal">
                                    <div class="top">
                                        <div class="d-flex align-items-center">
                                            <div class="parameter-item-title">
                                                <span class="fw-700 d-block span-title">
                                                    <?= $offer->post_title ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <hr class="sm">
                                        <?php if (get_field('benefit', $offer->ID)) : ?>
                                        <div class="benefit mb-10 fz-16">
                                            <div class="mark-red mb-10">
                                                Выгода
                                            </div>
                                            <div class="benefit-content">
                                                <?= get_field('benefit_summ', $offer->ID) ?> ₸
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <div class="date fz-16">
                                            <?php 
                                                $date_end = get_field('benefit_date', $offer->ID);
                                            ?>
                                            До <?= date_i18n( "j F Y", strtotime( $date_end ) ); ?>
                                        </div>
                                    </div>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>