<?php 

$models = new WP_Query([
    'post_type' => 'models',
    'post_parent' => 0
]);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</div>
<div class="steps mt-40">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="steps-wrapper">
                    <div class="steps-item current">
                        <div class="steps-item-number">
                            01
                        </div>
                        <div class="steps-item-heading">
                            Выбор модели
                        </div>
                    </div>
                    <div class="steps-item">
                        <div class="steps-item-number">
                            02
                        </div>
                        <div class="steps-item-heading">
                            Ваши контакты
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr />

<div id="test-drive-app">
    <div class="section pos-r">
        <!-- Slider main container -->
        <div class="container-fluid">
            <div class="pos-r models-sm-container dalacode-slider">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php foreach ($models->posts as $model) : ?>
                    <div class="swiper-slide model">
                        <div class="d-flex p-10 flex-column justify-content-between">
                            <div class="top">
                                <div class="img">
                                    <?= get_the_post_thumbnail( $model->ID, 'full' ) ?>
                                </div>
                                <div class="title">
                                    <div class="d-flex">
                                        <span class="underlined-black fz-18 fw-700"><?= $model->post_title ?></span>
                                    </div>
                                </div>
                                <div class="model-row">
                                    <div class="d-flex">
                                        <span class="price">от <?= get_field('starting_price', $model->ID) ?> ₸</span>
                                    </div>
                                </div>
                            </div>
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
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pos-r models-lg-container">
                        <div class="swiper-wrapper">
                            <?php foreach ($models->posts as $model) : ?>
                            <div data-hash="<?= $model->post_name ?>" class="swiper-slide model">
                                <div class="top">
                                    <div class="title">
                                        <span><?= $model->post_title ?></span>
                                    </div>
                                    <div class="img">
                                        <?= get_the_post_thumbnail( $model->ID, 'full' ) ?>
                                    </div>
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
                </div>
            </div>
        </div>

        <div class="section section-divided next-section-btn bg-white">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 d-flex justify-content-end">
                        <form method="POST" id="test-drive">
                            <input type="text" name="selected_model" value="" hidden>
                            <div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
                                <button id="go-to-step-2" type="submit" class="btn">Далее</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>