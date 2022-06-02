<?php get_header(); ?>
<?php

$current_models = wp_get_post_terms(get_the_ID(), 'model', 'names');
$current_models_slugs = [];
foreach ($current_models as $model) {
    array_push($current_models_slugs, $model->slug);
}
if ($current_models_slugs) {
    $models = new WP_Query([
        'post_type' => 'models',
        'post_name__in' => $current_models_slugs
    ]);
}

$configs = new WP_Query([
    'post_type' => 'configs',
    'model' => $current_models_slugs
]);

?>
<div class="page">
    <section class="pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumbs">
                        <?php if (function_exists('kama_breadcrumbs')) kama_breadcrumbs(); ?>
                    </div>
                    <div class="post-title d-none">
                        <h1>
                            <?php the_title();?>
                        </h1>
                    </div>
                    <div class="post-thumbnail">
                        <?= get_the_post_thumbnail(get_the_ID(), 'full') ?>
                    </div>
                </div>
            </div>
            <div class="row mt-20 justify-content-center mb-60">
                <div class="col-lg-7">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
                        <?php the_content(); ?>
                    </article>
                </div>
            </div>

            <div class="row mt-20 justify-content-center mb-60">
                <div class="col-lg-7 offer-conditions">
                    <h2 class="fz-35 mb-30">Условия участия</h2>
                    <ul class="check">
                        <?php
                        $conditions = get_field('conditions', get_the_ID());
                        if ($conditions) :
                            foreach ($conditions as $condition) :
                        ?>
                                <li><?= $condition['condition_item'] ?></li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li>Нет данных...</li>
                        <?php endif; ?>
                    </ul>
                </div>
                <?php if (get_field('is_advantages', get_the_ID())) : ?>
                    <div class="col-lg-7 offer-advantages">
                        <h2 class="fz-35 mb-30">Преимущества программы</h2>
                        <?php if (get_field('advantages', get_the_ID())) : ?>
                            <p>
                                <?= get_field('advantages', get_the_ID()) ?>
                            </p>
                        <?php else : ?>
                            <p>
                                Нет данных...
                            </p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <section>
        <hr>
        <!--Data time start -->
        <div class="container">
            <div class="row mt-20 justify-content-center">
                <div class="col-lg-7">
                    <div class="offer-info d-flex">
                        <div class="period">
                            <span class="d-block mb-10">Длительность</span>
                            <span class="lg d-block">
                                <?php
                                $now = new DateTime('Asia/Oral');
                                $period = get_field('period', get_the_ID());
                                $date_start = DateTime::createFromFormat('Y-m-d', $period['period_start']);
                                $date_end = DateTime::createFromFormat('Y-m-d', $period['period_end']);
                                if ($date_start && $date_end) {
                                    $duration = $date_end->diff($date_start);
                                    $left = $date_end->diff($now);
                                }
                                ?>
                                <?php if ($date_start && $date_end) : ?>
                                    <?php if ($date_start < $date_end) : ?>
                                        <?php if ($duration->d == 0 || $duration->d >= 5) : ?>
                                            <?= $duration->d ?> дней
                                        <?php elseif ($duration->d == 1) : ?>
                                            <?= $duration->d ?> день
                                        <?php elseif ($duration->d >= 2 && $duration->d <= 4) : ?>
                                            <?= $duration->d ?> дня
                                        <?php endif; ?>
                                    <?php else : ?>
                                        Дата начала позднее даты окончания
                                    <?php endif; ?>
                                <?php else : ?>
                                    Постоянная акция
                                <?php endif; ?>
                            </span>
                        </div>
                        <?php if ($date_start && $date_end) : ?>
                            <div class="period">
                                <span class="d-block mb-10">До завершения</span>
                                <span class="lg d-block">
                                    <?php if ($now <= $date_end) : ?>
                                        <?php if ($left->d == 0 || $left->d >= 5) : ?>
                                            <?= $left->d ?> дней
                                        <?php elseif ($left->d == 1) : ?>
                                            <?= $left->d ?> день
                                        <?php elseif ($left->d >= 2 && $left->d <= 4) : ?>
                                            <?= $left->d ?> дня
                                        <?php endif; ?>
                                    <?php else : ?>
                                        Завершено
                                    <?php endif; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!--Data time end -->
    </section>
    <?php if (isset($models)) : ?>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="section-heading">Модельный ряд</h3>
                </div>
            </div>
            <div class="pos-r models-sm-container offers-slider">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php
                    if (isset($models)) :
                        foreach ($models->posts as $model) :
                    ?>
                            <div class="swiper-slide w-174 model">
                                <div class="d-flex flex-column justify-content-between">
                                    <div class="top">
                                        <div class="img">
                                            <?= get_the_post_thumbnail($model->ID, 'full') ?>
                                        </div>
                                        <div class="title">
                                            <div class="d-flex">
                                                <span class="underlined-black fz-18 fw-700"><?= $model->post_title ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- If we need navigation buttons -->
                <button class="arrow arrow-prev swiper-button-prev">
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                        <path d="M8 4l-6 6 6 6M2.5 10H21" stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                </button>
                <button class="arrow arrow-next swiper-button-next">
                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                        <path d="M13 16l6-6-6-6M18.5 10H0" stroke="currentColor" stroke-width="1.5"></path>
                    </svg>
                </button>
            </div>
        </div>
        <hr>
        <div class="swiper-container mt-30 models-lg-container offers-slider">
            <div class="swiper-wrapper">
                <?php if (isset($models)) : ?>
                    <?php foreach ($models->posts as $model) : ?>
                        <div class="swiper-slide model-configs">
                            <?php foreach ($configs->posts as $config) : ?>
                                <?php
                                $model_name = wp_get_post_terms($config->ID, 'model', [
                                    'fields' => 'slugs'
                                ]);
                                ?>
                                <?php if ($model->post_name === $model_name[0]) : ?>
                                    <div class="model-configs-item pb-60">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-12 col-xl-3">
                                                            <?php if (get_the_post_thumbnail($config->ID, 'full')) : ?>
                                                                <div class="image">
                                                                    <?= get_the_post_thumbnail($config->ID, 'full') ?>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-12 col-xl-4">
                                                            <?php if ($config->post_title) : ?>
                                                                <h4>
                                                                    <?= $config->post_title ?>
                                                                </h4>
                                                            <?php endif; ?>

                                                            <span class="mt-20 description d-block c-disabled">
                                                                <div>
                                                                    <?= get_field('engine', $config->ID) ?> / <?= get_field('power', $config->ID) ?> л.с. / <?= get_field('transmission', $config->ID) ?> / <?= get_field('drive_wheels', $config->ID) ?>
                                                                </div>
                                                            </span>

                                                            <?php if (get_field('price', $config->ID)) : ?>
                                                                <span class="mt-20 price d-block">
                                                                    <?= get_field('price', $config->ID) ?> ₸
                                                                </span>
                                                            <?php endif; ?>

                                                            <?php if (get_field('trade_in', $config->ID)) : ?>
                                                                <span class="mt-20 trade-in d-block">
                                                                    Программа Трейд-ин. Выгода 250 000 ₸
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div class="col-12 col-xl-2">
                                                            <div class="other-offers">
                                                                <span class="mb-20 c-disabled d-block">Другие спецпредложения</span>
                                                                <?php

                                                                $offers = get_field('other_offers', $config->ID);

                                                                ?>
                                                                <?php if ($offers) : ?>
                                                                    <ul>
                                                                        <?php
                                                                        $offers = get_field('other_offers', $config->ID);
                                                                        if (is_array($offers) || is_object($offers)) {
                                                                            foreach ($offers as $offer) {
                                                                                foreach ($offer['offer'] as $offer) : ?>
                                                                                    <li class="mb-10"><?= $offer->post_title ?></li>
                                                                                <?php endforeach; ?>
                                                                        <?php }
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                <?php else : ?>
                                                                    Других спецпредложений нет...
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-xl-3">
                                                            <div class="d-lg-flex justify-content-xl-end callback-wrapper">
                                                                <a href="#callback-form" class="tac btn btn-md btn-black">
                                                                    Заявка дилеру
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <hr>
    <div id="callback-form" class="container pb-60 pt-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex callback-col justify-content-center">
                    <div class="callback-form" id="offer-form">
                        <h5 class="mb-2">Отправить заявку дилеру</h5>
                        <p>После отправки заявки, дилер свяжется с Вами для уточнения деталей бронирования.</p>
                        <p class="mt-10 fz-12 c-disabled">Поля, отмеченные *, обязательны для заполнения</p>
                        <?= do_shortcode('[contact-form-7 id="4077" title="Форма заявки со страницы спецпредложения"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>