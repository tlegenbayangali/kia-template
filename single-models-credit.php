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
<div class="steps mt-40 mb-30">
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
                    <div class="steps-item <?php if ($current_step == 4) : echo 'current'; elseif ($current_step < 5): echo ''; else: echo 'done'; endif; ?>"">
                        <div class="steps-item-number">
                            04
                        </div>
                        <div class="steps-item-heading">
                            Условия кредита
                        </div>
                    </div>
                    <?php if (false) : ?>
                    <div class="steps-item <?php if ($current_step == 5) : echo 'current'; elseif ($current_step < 5): echo ''; else: echo 'done'; endif; ?>"">
                        <div class="steps-item-number">
                            05
                        </div>
                        <div class="steps-item-heading">
                            Результаты расчета
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section section-divided pos-r">
    <div class="container">
        <div class="row g-0">
            <div class="col-xl-4 col-xxl-3 col-lg-12 pr-80 pb-30 aside bg-lgray">
                <aside class="pt-60 pb-60 h-100-p">
                    <div class="model-info-non-sticked">
                        <div class="model-info-title">
                            <?= $current_model->post_title ?>
                            <span id="model-price" class="d-block">
                                <!--model price-->
                            </span>
                        </div>
                        <div class="model-short-parametres">
                            
                        </div>
                        <div class="model-info-image d-flex justify-content-center">
                            <?= wp_get_attachment_image( get_field('model_side', $current_model->ID), 'full' ) ?>
                        </div>
                        <div class="model-info-price d-flex justify-content-between align-items-center">
                            <span>Стоимость</span>
                            <span class="fw-700"><span id="price-field"><?= $current_model->starting_price ?></span> ₸</span>
                        </div>
                        <div class="model-info-price d-flex justify-content-between align-items-center d-none">
                            <span>Выгода <span id="offer-name"></span></span>
                            <span class="fw-700"> - <span id="benefit-price-field"><!--benefit-price-field--></span> ₸</span>
                        </div>
                        <div id="result-section" class="d-none">
                            <hr class="black sm">
                            <div class="model-info-price d-flex justify-content-between align-items-center">
                                <span>Итоговая стоимость</span>
                                <span class="fw-700 fz-18"><span id="total-price-field"><!--benefit-price-field--></span> ₸</span>
                            </div>
                        </div>
                        <hr>
                        <div class="model-info-price mb-20 d-flex justify-content-between">
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
                        <div class="model-info-price mb-20 d-flex justify-content-between">
                            <span>КПП: <span id="transmission-field">
                                <?php
                                    if (isset($_POST['transmission-input'])) {
                                        echo $_POST['transmission-input'];
                                    }
                                ?>
                            </span></span>
                        </div>
                        <div class="model-info-price mb-20 d-flex justify-content-between">
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
                        <div id="kia-finance" class="d-block mt-60">
                            <div class="model-info-price d-flex justify-content-between">
                                <span>Расчет Kia Finance</span>
                            </div>
                            <hr class="sm">
                            <div class="model-info-price mb-20 d-flex justify-content-between" id="kia-finance-down-payment">
                                <span>Первый взнос:</span><span class="fw-700" id="kia-finance-down-payment-field"><!-- Down Payment --></span>
                            </div>
                            <div class="model-info-price trade-in-param mb-20 d-none justify-content-between" id="kia-finance-trade-in">
                                <span>Трейд-ин: </span><span class="fw-700" id="kia-finance-trade-in-field"><!-- Trade In --></span>
                            </div>
                            <div class="model-info-price trade-in-param mb-20 d-none justify-content-between" id="kia-finance-surcharge">
                                <span>Доплата: </span><span class="fw-700" id="kia-finance-surcharge-field"><!-- Surcharge --></span>
                            </div>
                            <div class="model-info-price mb-20 d-flex justify-content-between" id="kia-finance-credit-summ">
                                <span>Сумма кредита: </span><span class="fw-700" id="kia-finance-credit-summ-field"><!-- Credit Summ --></span>
                            </div>
                            <?php if (false) : ?>
                            <div class="model-info-price mb-20 d-flex justify-content-between" id="kia-finance-residual-payment">
                                <span>Остаточный платеж: </span><span class="fw-700" id="kia-finance-residual-payment-field"><!-- Residual Payment --></span>
                            </div>
                            <?php endif; ?>
                            <div class="model-info-price mb-20 d-flex justify-content-between" id="kia-finance-credit-terms">
                                <span>Срок кредита: </span><span class="fw-700" id="kia-finance-credit-terms-field"><!-- Credit Terms --></span>
                            </div>
                            <div class="model-info-price mb-20 d-flex justify-content-between" id="kia-finance-credit-rate">
                                <span>Кредитная ставка: </span><span class="fw-700" id="kia-finance-credit-rate-field"><!-- Credit Rate --></span>
                            </div>
                            <hr class="black sm">
                            <div class="model-info-price d-flex justify-content-between align-items-center">
                                <span>Ежемесячный расчет</span>
                                <span class="fw-700 fz-18"><span id="every-month-field"><!--Every Month Field--></span> ₸/мес</span>
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
                    <?php get_template_part( 'template-parts/credit-steps/four', '', [
                        'current_model' => $current_model
                    ] ); ?>
                <?php endif; ?>
                <?php if ($current_step == 5) : ?>
                    <?php get_template_part( 'template-parts/credit-steps/five', '', [
                        'current_model' => $current_model,
                        'current_step' => $current_step
                    ] ); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="section section-divided next-section-btn bg-white" data-sticky>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-end">
                <form method="POST">
                    <input type="text" name="current_step" value="<?php echo $current_step - 1; ?>" hidden>
                    <div class="btn-wrapper btn-wrapper-lg btn-wrapper-white">
                        <button type="submit" onclick="history.back();" class="btn">Назад</button>
                    </div>
                </form>
                <?php if ($current_step < 4) : ?>
                <form method="POST" id="configurator">
                    <input type="text" name="current_step" value="<?php echo $current_step + 1; ?>" hidden>
                    <div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
                        <button type="submit" class="btn">Далее</button>
                    </div>
                </form>
                <?php endif; ?>
                <?php if ($current_step == 4) : ?>
                    <div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
                        <a href="/callback" class="btn">Оставить заявку</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>