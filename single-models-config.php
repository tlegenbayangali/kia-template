<?php
get_header();

if (isset($_POST['current_step'])) {
    $current_step = (int)$_POST['current_step'];
} else {
    $current_step = 2;
}

$parent_id = wp_get_post_parent_id( get_the_ID() );

$current_model = get_post( $parent_id );

if (isset($_POST['config-step'])) {
    $config_step = $_POST['config-step'];
} else {
    $config_step = 'one';
}

?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<div class="mt-40 steps mb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="steps-wrapper">
                    <div class="steps-item <?php if ($current_step == 1) : echo 'current'; else: echo 'done'; endif; ?>">
                        <div class="steps-item-number">
                            01
                        </div>
                        <div class="steps-item-heading">
                            Выбор модели
                        </div>
                    </div>
                    <div class="steps-item <?php if ($current_step == 2) : echo 'current'; elseif ($current_step < 2): echo ''; else: echo 'done'; endif; ?>">
                        <div class="steps-item-number">
                            02
                        </div>
                        <div class="steps-item-heading">
                            Двигатель и трансмиссия
                        </div>
                    </div>
                    <div class="steps-item <?php if ($current_step == 3) : echo 'current'; elseif ($current_step < 3): echo ''; else: echo 'done'; endif; ?>"">
                        <div class="steps-item-number">
                            03
                        </div>
                        <div class="steps-item-heading">
                            Комплектация
                        </div>
                    </div>
                    <div class="steps-item <?php if ($current_step == 4) : echo 'current'; elseif ($current_step < 4): echo ''; else: echo 'done'; endif; ?>"">
                        <div class="steps-item-number">
                            04
                        </div>
                        <div class="steps-item-heading">
                            Цвета и отделка
                        </div>
                    </div>
                    <div class="steps-item <?php if ($current_step == 5) : echo 'current'; elseif ($current_step < 5): echo ''; else: echo 'done'; endif; ?>"">
                        <div class="steps-item-number">
                            05
                        </div>
                        <div class="steps-item-heading">
                            Результаты
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section section-divided pos-r" data-sticky-container>
    <div class="container">
        <div class="row g-0">
            <div class="col-xl-4 col-xxl-3 col-lg-12 pr-40 pb-30 aside bg-lgray <?php if ($current_step == 5) : echo 'd-none'; endif; ?>">
                <aside class="pt-60 pb-60 h-100-p" data-sticky-container>
                    <div class="model-info" data-sticky-for="1200" data-margin-top="30" data-sticky-wrap="true">
                        <h1 class="model-info-title">
                            <?= $current_model->post_title ?>
                        </h1>
                        <div class="model-info-image d-flex justify-content-center">
                            <?= wp_get_attachment_image( get_field('model_side', $current_model->ID), 'full' ) ?>
                        </div>
                        <div class="model-info-price d-flex justify-content-between align-items-center">
                            <span>Стоимость</span>
                            <span class="fw-700 fz-18">от <span id="price-field"><?= $current_model->starting_price ?></span> ₸</span>
                        </div>
                        <hr>
                        <div class="mb-20 model-info-price d-flex justify-content-between">
                            <span>Двигатель: 
                                <span id="engine-field">
                                    <?php
                                        if (isset($_POST['engine-input'])) {
                                            echo $_POST['engine-input'];
                                        }
                                    ?>
                                </span>
                            </span>
                        </div>
                        <div class="mb-20 model-info-price d-flex justify-content-between">
                            <span>КПП: <span id="transmission-field">
                                <?php
                                    if (isset($_POST['transmission-input'])) {
                                        echo $_POST['transmission-input'];
                                    }
                                ?>
                            </span></span>
                        </div>
                        <div class="mb-20 model-info-price d-flex justify-content-between">
                            <span>Привод: <span id="dw-field">
                                <?php
                                    if (isset($_POST['dw-input'])) {
                                        echo $_POST['dw-input'];
                                    }
                                ?>
                            </span></span>
                        </div>
                        <div class="model-info-price d-none justify-content-between">
                            <span>Цвет: <span id="color-field">
                                
                            </span></span>
                        </div>
                        <div class="d-none complectations-section">
                            <hr>
                            <div class="model-info-active fw-700 d-flex justify-content-between">
                                <span id="complectation-name">
                                    <!--complectation name-->
                                </span>
                                <span id="complectation-price">
                                    <!--complectation price-->
                                </span>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="<?php if ($current_step == 5) : echo 'col-12'; else : echo 'col-xl-8 col-xxl-9 col-lg-12'; endif ?>">
                <?php if ($current_step == 2) : ?>
                    <?php get_template_part( 'template-parts/config-steps/two', '', [
                        'current_model' => $current_model
                    ] ); ?>
                <?php endif; ?>
                <?php if ($current_step == 3) : ?>
                    <?php get_template_part( 'template-parts/config-steps/three', '', [
                        'current_model' => $current_model
                    ] ); ?>
                <?php endif; ?>
                <?php if ($current_step == 4) : ?>
                    <?php get_template_part( 'template-parts/config-steps/four', '', [
                        'current_model' => $current_model
                    ] ); ?>
                <?php endif; ?>
                <?php if ($current_step == 5) : ?>
                    <?php get_template_part( 'template-parts/config-steps/five', '', [
                        'current_model' => $current_model,
                        'current_step' => $current_step
                    ] ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php if ($current_step == 5) : ?>
<section class="pb-60 pt-60 bg-lgray">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7 callback-col">
                <div class="callback-form">
                    <h5 class="mb-2" id="result-form">Ваши контакты</h5>
                    <p>Поля, отмеченные *, обязательны для заполнения</p>
                    <?php echo do_shortcode('[contact-form-7 id="2552" title="Форма конфигуратора"]'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<div class="bg-white section section-divided next-section-btn">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-end">
                <form method="POST">
                    <input type="text" name="current_step" value="<?php echo $current_step - 1; ?>" hidden>
                    <div class="btn-wrapper btn-wrapper-lg btn-wrapper-white">
                        <button id="go-to-step-2" type="submit" onclick="history.back();" class="btn">Назад</button>
                    </div>
                </form>
                <?php if ($current_step != 5) : ?>
                <form method="POST" id="configurator">
                    <input type="text" name="current_step" value="<?php echo $current_step + 1; ?>" hidden>
                    <div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
                        <button id="go-to-step-2" type="submit" class="btn">Далее</button>
                    </div>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>