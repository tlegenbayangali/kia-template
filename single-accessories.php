<?php
get_header();

$gallery = get_field('gallery', get_the_ID());

?>
<?php
get_template_part('template-parts/breadcrumbs'); ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="/accessories" class="d-flex align-items-center mt-20 mb-30">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
                        <path data-v-55a0ccce="" d="M12 5l-5 5 5 5" stroke="currentColor" stroke-width="2"></path>
                    </svg>
                    В каталог
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1><?php
                    the_title() ?></h1>
            </div>
        </div>
    </div>
    <section class="config-single section-divided mt-30" id="config-single">
        <div class="container">
            <div class="row row-divided">
                <div class="col-lg-4">
                    <aside class="py-30 pr-60">
                        <div class="config-single-price">
                            <!--                            <div class="mt-30">-->
                            <!--                                <a href="/callback/" class="w-100-p tac btn btn-black btn-md">-->
                            <!--                                    Забронировать автомобиль-->
                            <!--                                </a>-->
                            <!--                            </div>-->
                            <div class="config-info mt-30">
                                <div class="config-info-item">
                                    <span class="c-dgray">Артикул:</span>
                                    <span id="engine-field">
                                        <?= get_field('sku', get_the_ID()) ?>
                                    </span>
                                </div>
                                <div class="config-info-item">
                                    <span class="c-dgray">Материал:</span>
                                    <span id="engine-field">
                                        <?= get_field('material', get_the_ID()) ?>
                                    </span>
                                </div>
                                <div class="config-info-item">
                                    <span class="c-dgray">Цвет:</span>
                                    <span id="engine-field">
                                        <?= get_field('color', get_the_ID()) ?>
                                    </span>
                                </div>
                                <div class="config-info-item">
                                    <span class="c-dgray">Комплект:</span>
                                    <span id="engine-field">
                                        <?= get_field('complect', get_the_ID()) ?>
                                    </span>
                                </div>
                                <div class="config-info-item">
                                    <span class="c-dgray">Размер:</span>
                                    <span id="engine-field">
                                        <?= get_field('size', get_the_ID()) ?>
                                    </span>
                                </div>
                                <div class="config-info-item">
                                    <span class="c-dgray">Группа:</span>
                                    <span id="engine-field">
                                        <?= get_field('group', get_the_ID()) ?>
                                    </span>
                                </div>
                            </div>
                            <?php
                            if (get_field('technical_props', get_the_ID())): ?>
                                <hr>
                                <div>
                                    <span class="c-dgray">Технические особенности:</span>
                                    <ul class="mt-10">
                                        <?php
                                        foreach (get_field('technical_props', get_the_ID()) as $prop) : ?>
                                            <li>- <?= $prop[ 'prop_name' ] ?></li>
                                        <?php
                                        endforeach; ?>
                                    </ul>
                                </div>
                            <?php
                            endif; ?>
                        </div>
                    </aside>
                </div>
                <div class="col-lg-8">
                    <section class="content py-30 pl-60" id="content">
                        <?php
                        if ($gallery) : ?>
                            <div class="slider-with-thumbs large swiper-container">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <?php
                                    foreach ($gallery as $image) : ?>
                                        <div class="swiper-slide">
                                            <div class="slider-item">
                                                <?= wp_get_attachment_image($image[ 'ID' ], 'full'); ?>
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
                            <div class="slider-with-thumbs small mt-30 swiper-container">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Slides -->
                                    <?php
                                    foreach ($gallery as $image) : ?>
                                        <div class="swiper-slide">
                                            <div class="slider-item">
                                                <?= wp_get_attachment_image($image[ 'ID' ], 'full'); ?>
                                            </div>
                                        </div>
                                    <?php
                                    endforeach; ?>
                                </div>
                            </div>
                        <?php
                        endif; ?>
                        <p class="c-dgray fz-12 mt-20">Изображение может не соответствовать выбранной комплектации. Цвет аксессуара может отличаться от представленного на данном сайте. </p>
                        <div class="content mt-40">
                            <h2 class="mb-20">Описание</h2>
                            <?php
                            the_content(); ?>
                            <h2 class="mb-20 mt-20">Подходит для модели</h2>
                            <p>
                                <?= implode(', ', get_field('models', get_the_ID())) ?>
                            </p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
<?php
get_footer();