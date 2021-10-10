<div class="credit step-four">
<?php 
    $current_model = $args['current_model'];

    $credit_offers = new WP_Query([
        'post_type' => 'credit-programms',
        'model' => $current_model->post_name
    ]);
?>

    <div class="content complections pt-60 pb-60 pl-80">
        <h3 class="fz-18">Выберите кредитную программу</h3>
        <div class="credit-offers-slider mt-30 mb-60">
            <!-- Slider main container -->
            <div class="swiper-container">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php foreach ($credit_offers->posts as $offer) : ?>
                    <div class="swiper-slide credit-offers-slide">
                        <button class="swiper-slide parameter-item tal">
                            <div class="top">
                                <div class="d-flex align-items-center">
                                    <div class="parameter-item-icon">
                                        <svg class="plus">
                                            <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#plus"></use>
                                        </svg>
                                        <svg class="check">
                                            <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                                        </svg>
                                    </div>
                                    <div class="parameter-item-title ml-20">
                                        <span class="fw-700 d-block span-title">
                                            <?= $offer->post_title ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="parameter-item-content mt-20 article tal">
                                    <?= get_the_content('', '', $offer->ID); ?>
                                </div>
                                <hr class="sm">
                                <div class="info-block">
                                    <?php if (strlen(get_field('every_month_payment', $offer->ID))) : ?>
                                    <div class="info-group">
                                        <div class="info-group-gray c-dgray">
                                            Ежемесячный платеж
                                        </div>
                                        <div class="info-group-accent c-black fz-18">
                                            <?= get_field('every_month_payment', $offer->ID) ?> ₸/мес.
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <div class="info-group">
                                        <?php 
                                        
                                            $conditions = get_field('conditions_and_terms', $offer->ID);
                                            $percents = [];
                                            $terms = [];
                                            
                                            foreach ((array)$conditions as $condition) {
                                                $percents[] = $condition['condition']['percentage'];
                                                $terms[] = $condition['condition']['term'];
                                            }

                                        ?>
                                        <?php if (count ($percents)) : ?>
                                        <div class="info-group-gray c-dgray">
                                            Процентная ставка
                                        </div>
                                        <div class="info-group-accent c-black fz-18">
                                            от <?= min($percents) ?>%
                                        </div>
                                        <?php endif; ?>
                                    </div>

                                    <?php if (strlen(get_field('down_payment', $offer->ID))) : ?>
                                    <div class="info-group">
                                        <div class="info-group-gray c-dgray">
                                            Первый взнос
                                        </div>
                                        <div class="info-group-accent c-black fz-18">
                                            от <?= get_field('down_payment', $offer->ID) ?> ₸
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php if (strlen(get_field('last_payment', $offer->ID))) : ?>
                                    <div class="info-group">
                                        <div class="info-group-gray c-dgray">
                                            Остаточный платеж
                                        </div>
                                        <div class="info-group-accent c-black fz-18">
                                            <?= get_field('last_payment', $offer->ID) ?> ₸
                                        </div>
                                    </div>
                                    <?php endif; ?>
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
                        <?php if (get_field('benefit_summ', $offer->ID)) : ?>
                        <span data-benefit="<?= get_field('benefit_summ', $offer->ID) ?>"></span>
                        <?php endif; ?>
                        <?php if ($offer->post_title) : ?>
                        <span data-offer-name="<?= $offer->post_title ?>"></span>
                        <?php endif; ?>
                        <?php if (count($percents)) : ?>
                        <span data-percents="[<?= implode(',', $percents) ?>]"></span>
                        <?php endif; ?>
                        <?php if (count($terms)) : ?>
                        <span data-terms="[<?= implode(',', $terms) ?>]"></span>
                        <?php endif; ?>
                        <?php if (strlen(get_field('down_payment', $offer->ID))) : ?>
                        <span data-down-payment="<?= get_field('down_payment', $offer->ID) ?>"></span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
        <h3 class="fz-18 mb-30">Выберите первый взнос</h3>
        <div class="border border-black trade-in py-25 px-20">
            <div class="wrapper">
                <span class="fw-700">Трейд-ин</span>
                <span class="ml-20 color-dgray">Стоимость Вашего автомобиля</span>
                <input type="text" id="trade-in-calc" value="0" class="input-calc" placeholder="0">
            </div>
            <div class="success-message d-none c-green mt-10">
                Сумма Trade-in покрывает первый взнос 
            </div>
        </div>
        <div class="credit-params mt-60">
            <div class="credit-params-item d-flex justify-content-between align-items-center" id="down-payment-param">
                <span>Первый взнос (от <span id="down-payment-percentage"><!--Down Payment Percentage--></span>)</span>
                <input type="text" id="down-payment-percentage-calc" value="0" class="input-calc lg" placeholder="0">
            </div>
            <div class="credit-params-item d-none justify-content-between trade-in-param align-items-center" id="trade-in-param">
                <span>Трейд ин</span>
                <input type="text" id="trade-in-2-calc" value="0" class="input-calc disabled lg" disabled placeholder="0">
            </div>
            <div class="credit-params-item d-none justify-content-between trade-in-param align-items-center" id="surcharge-param">
                <span>Доплата</span>
                <input type="text" id="surcharge-calc" value="0" class="input-calc disabled lg" disabled placeholder="0">
            </div>
            <div class="credit-params-item d-flex justify-content-between align-items-center" id="credit-summ-param">
                <span>Сумма кредита</span>
                <input type="text" id="credit-summ-calc" value="0" class="input-calc disabled lg" disabled placeholder="0">
            </div>
            <?php if (false) : ?>
            <div class="credit-params-item d-flex justify-content-between align-items-center" id="residual-payment-param">
                <span>Остаточный платеж</span>
                <input type="text" id="residual-payment-calc" value="0" class="input-calc disabled lg" disabled placeholder="0">
            </div>
            <?php endif; ?>
        </div>
        <div class="config-details mt-60 mb-60 d-flex justify-content-between">
            <div class="left d-flex flex-column">
                <div class="config-details-table">
                    <div class="config-title mb-30">
                        <h5 class="fz-18">
                            Срок кредита
                        </h5>
                    </div>
                    <div class="config-details-row">
                        <div class="plusminus">
                            <button type="button" class="btn btn-round minus">-</button>
                            <span class="my-20">
                                <span class="plusminus-value"><!--Months Counter--></span> <span class="fw-700 fz-18">мес</span>
                            </span>
                            <button type="button" class="btn btn-round plus">+</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right d-flex flex-column">
                <div class="config-details-table flex-grow-1">
                    <div class="config-title mb-30">
                        <h5 class="fz-18">
                            Ежемесячный платеж
                        </h5>
                    </div>
                    <div class="config-details-row">
                        <span class="fw-700 fz-18">
                            <span id="every-month-2-field">

                            </span>
                            ₸/мес
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>