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
    <div class="page-cover d-flex flex-column justify-content-between pb-20" style="background: url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>) no-repeat center/cover">
        <div class="top">
            <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="post-title d-none">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row mt-20">
                    <div class="col-lg-6">
                        <p>
                            <?= get_field('short_description', get_the_ID()) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            $period = get_field('period', get_the_ID());
            $date_start = $period['period_start'];
            $date_end = $period['period_end'];
        ?>
        <?php if ($date_start && $date_end) : ?>
        <div class="bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="offer-info d-flex flex-column flex-md-row">
                            <div class="period">
                                <span class="lg d-block">
                                    <?php if ( $date_start && $date_end ) : ?>
                                        <?php if ( downcounter( $date_end, [ 'days' => true ] ) ) : ?>
                                            <?php if (get_field('period', get_the_ID())) : ?>
                                            <?= date_i18n( "j", strtotime( $date_start ) ); ?>-<?= date_i18n( "j F Y", strtotime( $date_end ) ); ?>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            Время истекло
                                        <?php endif; ?>
                                    <?php else: ?>
                                        Постоянная акция
                                    <?php endif; ?>
                                </span>
                                <span class="d-block mt-10">Длительность</span>
                            </div>
                            <?php if ( downcounter( $date_end, [ 'days' => true ] ) ) : ?>
                            <div class="period">
                                <span class="lg d-block">
                                    <?= downcounter($date_end, [
                                        'days' => true
                                    ]) ?>
                                </span>
                                <span class="d-block mt-10">До завершения</span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <section class="pt-60 pb-60">
        <div class="container">
            <div class="row justify-content-center mb-60">
                <div class="col-lg-12">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-lg-5 offer-conditions">
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
                <div class="col-lg-6 offer-advantages">
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
                                <?= get_the_post_thumbnail( $model->ID, 'full' ) ?>
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
                                                <?php if (get_the_post_thumbnail( $config->ID, 'full' )) : ?>
                                                <div class="image">
                                                    <?= get_the_post_thumbnail( $config->ID, 'full' ) ?>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-12 col-xl-4">
                                                <?php if ($config->post_title) : ?>
                                                <h4>
                                                    <?= $config->post_title ?>
                                                </h4>
                                                <?php endif; ?>

                                                <span class="description mt-20 d-block c-disabled">
                                                    <div>
                                                        <?= get_field('engine', $config->ID) ?> / <?= get_field('power', $config->ID) ?> л.с. / <?= get_field('transmission', $config->ID) ?> / <?= get_field('drive_wheels', $config->ID) ?>
                                                    </div>
                                                </span>

                                                <?php if (get_field('price', $config->ID)) : ?>
                                                <span class="price mt-20 d-block">
                                                    <?= get_field('price', $config->ID) ?> ₸
                                                </span>
                                                <?php endif; ?>

                                                <?php if (get_field('trade_in', $config->ID)) : ?>
                                                <span class="trade-in mt-20 d-block">
                                                    Программа Трейд-ин. Выгода 250 000 ₸
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-12 col-xl-2">
                                                <div class="other-offers">
                                                    <span class="c-disabled mb-20 d-block">Другие спецпредложения</span>
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
                        <p class="fz-12 mt-10 c-disabled">Поля, отмеченные *, обязательны для заполнения</p>
                        <?= do_shortcode('[contact-form-7 id="4077" title="Форма заявки со страницы спецпредложения"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>