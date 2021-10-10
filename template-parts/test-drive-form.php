<?php 
    $current_model_slug = $_POST['selected_model'];

    $model = new WP_Query([
        'name' => $current_model_slug,
        'post_type' => 'models'
    ]);

    $current_model = $model->posts[0];
?>
<div class="steps mt-40 mb-30 test-drive-form">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="steps-wrapper">
                    <div class="steps-item done">
                        <div class="steps-item-number">
                            01
                        </div>
                        <div class="steps-item-heading">
                            Выбор модели
                        </div>
                    </div>
                    <div class="steps-item current">
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

<div class="section section-divided pos-r">
    <div class="container-fluid">
        <div class="row g-0">
            <div class="col-xl-4 col-lg-12 pb-30 pr-80 aside bg-lgray">
                <aside class="pt-60 pb-60 h-100-p" data-sticky-container>
                    <div class="model-info" data-sticky-for="1200" data-margin-top="30" data-sticky-wrap="true">
                        <div class="model-info-title">
                            <?= $current_model->post_title ?>
                        </div>
                        <div class="model-info-image d-flex justify-content-center">
                            <?= get_the_post_thumbnail( $current_model->ID, 'full' ) ?>
                        </div>
                        <div class="model-info-price d-flex justify-content-between">
                            <span>Стоимость</span>
                            <span class="fw-700 fz-18">от <?= get_field('starting_price', $current_model->ID) ?> ₸</span>
                        </div>
                        <?php if (get_field('dealer_info', 'options')) : ?>
                        <div class="model-info-dealer mt-20">
                            <span class="model-info-dealer-title mb-10 fw-700 d-block">
                                <?= get_field('dealer_info', 'options')['dealer_name'] ?>
                            </span>
                            <span class="model-info-dealer-address mb-10 d-block">
                                <?= get_field('dealer_info', 'options')['dealer_address'] ?>
                            </span>
                            <span class="model-info-dealer-address mb-10 d-block">
                                <?= get_field('dealer_info', 'options')['dealer_schedule'] ?>
                            </span>
                            <?php if (get_field('dealer_info', 'options')['dealer_phones']) : ?>
                                <div class="model-info-dealer-phones d-flex align-items-start flex-column">
                                    <?php foreach (get_field('dealer_info', 'options')['dealer_phones'] as $phone) : ?>
                                    <a href="tel:<?php echo cleanPhone($phone['dealer_phone']) ?>" class="mb-10 underlined underlined-black d-inline-block model-info-dealer-phone fw-700">
                                        <?= $phone['dealer_phone'] ?>
                                    </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </aside>
            </div>
            <div class="col-xl-8 col-lg-12">
                <div class="content callback-col pt-60 pb-60 pl-80">
                    <div class="callback-form">
                        <h5 class="mb-2">Ваши контакты</h5>
                        <p>Поля, отмеченные *, обязательны для заполнения</p>
                        <?= do_shortcode('[contact-form-7 id="96" title="Тест-драйв"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>