<?php

/*
Template Name: Контакты
*/
get_header()
?>
<?php
get_template_part('template-parts/breadcrumbs'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="fz-35">
                    Контакты
                </h1>
            </div>
        </div>
    </div>
    <hr>
    <div class="pb-60 contact">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6" itemscope itemtype="https://schema.org/Organization">
                    <h2 class="fz-50" itemprop>
                        <?php
                        the_field('site_name', 'options'); ?>
                    </h2>
                    <p class="mt-20" itemprop="description">
                        <?php
                        the_field('site_description', 'options'); ?>
                    </p>
                    <div class="mt-20 btn-wrapper btn-wrapper-lg btn-wrapper-black">
                        <a href="/callback/" class="btn">Обратная связь</a>
                    </div>
                    <hr>
                    <h4 class="mb-2">Отдел продаж</h4>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="contacts-info-group">
                            <span class="small">
                                Адрес
                            </span>
                                <span class="info" itemprop="address">
                                <?php
                                the_field('address', 'options') ?>
                            </span>
                            </div>
                            <div class="contacts-info-group">
                            <span class="small">
                                Юридическое лицо
                            </span>
                                <span class="info" itemprop="legalName">
                                <?= get_field('dealer_info', 'options')[ 'dealer_name' ] ?>
                            </span>
                            </div>
                            <div class="contacts-info-group">
                            <span class="small">
                                Режим работы
                            </span>
                                <span class="info">
                                <?= get_field('dealer_info', 'options')[ 'dealer_schedule' ]; ?>
                            </span>
                            </div>
                        </div>
                        <div class="col-md-6 contacts-phone">
                            <?php
                            if (get_field('dealer_info', 'options')[ 'dealer_phones' ]) : ?>
                                <div class="contacts-info-group">
                                <span class="small">
                                    Телефоны
                                </span>
                                    <span class="info d-flex flex-column">
                                    <?php
                                    foreach (get_field('dealer_info', 'options')[ 'dealer_phones' ] as $phone) : ?>
                                        <?php
                                        if (isset($phone[ 'is_whatsapp' ])): ?>
                                            <a href="https://api.whatsapp.com/send?phone=<?= cleanPhone(
                                                $phone[ 'dealer_phone' ]
                                            ) ?>&text=%F0%9F%91%8B%20%D0%97%D0%B4%D1%80%D0%B0%D0%B2%D1%81%D1%82%D0%B2%D1%83%D0%B9%D1%82%D0%B5!%20%D0%A5%D0%BE%D1%87%D1%83%20%D1%83%D0%B7%D0%BD%D0%B0%D1%82%D1%8C%20%D1%83%D0%B7%D0%BD%D0%B0%D1%82%D1%8C%20%D0%BF%D0%BE%D0%B4%D1%80%D0%BE%D0%B1%D0%BD%D0%B5%D0%B5%20%D0%BE%20%D0%BC%D0%BE%D0%B4%D0%B5%D0%BB%D0%B8%20..." class="right-number pos-r d-block">
                                                <span itemprop="telephone"><?= $phone[ 'dealer_phone' ] ?></span>
                                            </a>
                                        <?php
                                        else: ?>
                                            <a href="tel:<?= cleanPhone($phone[ 'dealer_phone' ]) ?>" class="right-number pos-r d-block">
                                                <span itemprop="telephone"><?= $phone[ 'dealer_phone' ] ?></span>
                                            </a>
                                        <?php
                                        endif; ?>
                                    <?php
                                    endforeach; ?>
                                </span>
                                </div>
                            <?php
                            endif; ?>
                            <?php
                            if (get_field('dealer_info', 'options')[ 'email' ]) : ?>
                                <div class="contacts-info-group">
                                <span class="small">
                                    Email
                                </span>
                                    <span class="info d-flex flex-column">
                                    <?php
                                    foreach (get_field('dealer_info', 'options')[ 'email' ] as $email) : ?>
                                        <a href="mailto:<?= $email[ 'email_item' ] ?>" class="right-number pos-r d-block">
                                            <span itemprop="email"><?= $email[ 'email_item' ] ?></span>
                                        </a>
                                    <?php
                                    endforeach; ?>
                                </span>
                                </div>
                            <?php
                            endif; ?>
                        </div>
                    </div>
                    <?php
                    if (get_field('dealer_info', 'options')[ 'service_department_is_active' ] != false) : ?>
                        <h4 class="mb-2">Отдел сервиса</h4>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <?php
                                if (get_field('dealer_info', 'options')[ 'service_department' ][ 'address' ]) : ?>
                                    <div class="contacts-info-group">
                                    <span class="small">
                                        Адрес
                                    </span>
                                        <span class="info" itemprop="address">
                                        <?= get_field('dealer_info', 'options')[ 'service_department' ][ 'address' ] ?>
                                    </span>
                                    </div>
                                <?php
                                endif; ?>
                                <?php
                                if (get_field('dealer_info', 'options')[ 'service_department' ][ 'schedule' ]) : ?>
                                    <div class="contacts-info-group">
                                        <span class="small">
                                            Режим работы
                                        </span>
                                        <span class="info">
                                        <?= get_field('dealer_info', 'options')[ 'service_department' ][ 'schedule' ] ?>
                                    </span>
                                    </div>
                                <?php
                                endif; ?>
                            </div>
                            <div class="col-md-6 contacts-phone">
                                <?php
                                if (get_field('dealer_info', 'options')[ 'service_department' ][ 'phones' ]) : ?>
                                    <div class="contacts-info-group">
                                        <span class="small">
                                            Телефоны
                                        </span>
                                        <span class="info d-flex flex-column">
                                            <?php
                                            foreach (get_field('dealer_info', 'options')[ 'service_department' ][ 'phones' ] as $phone) : ?>
                                                <?php
                                                if ($phone[ 'is_whatsapp' ]): ?>
                                                    <a href="https://api.whatsapp.com/send?phone=<?= cleanPhone(
                                                        $phone[ 'phone' ]
                                                    ) ?>&text=%F0%9F%91%8B%20%D0%97%D0%B4%D1%80%D0%B0%D0%B2%D1%81%D1%82%D0%B2%D1%83%D0%B9%D1%82%D0%B5!%20%D0%A5%D0%BE%D1%87%D1%83%20%D1%83%D0%B7%D0%BD%D0%B0%D1%82%D1%8C%20%D0%BE%D0%B1%D1%80%D0%B0%D1%82%D0%B8%D1%82%D1%8C%D1%81%D1%8F%20%D0%BF%D0%BE%20%D0%BF%D0%BE%D0%B2%D0%BE%D0%B4%D1%83%20%D1%81%D0%B5%D1%80%D0%B2%D0%B8%D1%81%D0%B0..." class="right-number pos-r d-block">
                                                            <span itemprop="telephone"><?= $phone[ 'phone' ] ?></span>
                                                        </a>
                                                <?php
                                                else: ?>
                                                    <a href="tel:<?= cleanPhone($phone[ 'phone' ]) ?>" class="right-number pos-r d-block">
                                                        <span itemprop="telephone"><?= $phone[ 'phone' ] ?></span>
                                                    </a>
                                                <?php
                                                endif; ?>
                                            <?php
                                            endforeach; ?>
                                        </span>
                                    </div>
                                <?php
                                endif; ?>
                                <?php
                                if (get_field('dealer_info', 'options')[ 'service_department' ][ 'emails' ]) : ?>
                                    <div class="contacts-info-group">
                                        <span class="small">
                                            Email
                                        </span>
                                        <span class="info d-flex flex-column">
                                            <?php
                                            foreach (get_field('dealer_info', 'options')[ 'service_department' ][ 'emails' ] as $email) : ?>
                                                <a href="mailto:<?= $email[ 'email' ] ?>" class="right-number pos-r d-block">
                                                    <span itemprop="email"><?= $email[ 'email' ] ?></span>
                                                </a>
                                            <?php
                                            endforeach; ?>
                                        </span>
                                    </div>
                                <?php
                                endif; ?>
                            </div>
                        </div>
                    <?php
                    endif; ?>
                </div>
                <?php
                if (get_field('dealer_info', 'options')[ 'dealer_map' ]) : ?>
                    <div class="col-12 col-md-6 asd">
                        <?= get_field('dealer_info', 'options')[ 'dealer_map' ] ?>
                    </div>
                <?php
                endif; ?>
            </div>
        </div>
    </div>
<?php
get_footer();
