<?php
/*
Template Name: Контакты
*/
get_header()
?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
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
<div class="pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6" itemscope itemtype="https://schema.org/Organization">
                <h2 class="fz-50" itemprop>
                    <?php the_field('site_name', 'options'); ?>
                </h2>
                <p class="mt-20" itemprop="description">
                    <?php the_field('site_description', 'options'); ?>
                </p>
                    <div class="mt-20 btn-wrapper btn-wrapper-lg btn-wrapper-black">
                        <a href="/callback" class="btn">Заказать звонок</a>
                    </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="contacts-info-group">
                            <span class="small">
                                Адрес
                            </span>
                            <span class="info" itemprop="address">
                                <?php the_field('address', 'options') ?>
                            </span>
                        </div>
                        <div class="contacts-info-group">
                            <span class="small">
                                Юридическое лицо
                            </span>
                            <span class="info" itemprop="legalName">
                                <?= get_field('dealer_info', 'options')['dealer_name'] ?>
                            </span>
                        </div>
                        <div class="contacts-info-group">
                            <span class="small">
                                Режим работы
                            </span>
                            <span class="info">
                                <?= get_field('dealer_info', 'options')['dealer_schedule']; ?>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 contacts-phone">
                        <?php if (get_field('dealer_info', 'options')['dealer_phones']) : ?>
                        <div class="contacts-info-group">
                            <span class="small">
                                Телефоны
                            </span>
                            <span class="info d-flex flex-column">
                                <?php foreach (get_field('dealer_info', 'options')['dealer_phones'] as $phone) : ?>
                                <a href="tel:<?= cleanPhone($phone['dealer_phone']) ?>" class="right-number pos-r d-block">
                                    <span itemprop="telephone"><?= $phone['dealer_phone'] ?></span>
                                </a>
                                <?php endforeach; ?>
                            </span>
                        </div>
                        <?php endif; ?>
                        <?php if (get_field('dealer_info', 'options')['email']) : ?>
                        <div class="contacts-info-group">
                            <span class="small">
                                Email
                            </span>
                            <span class="info d-flex flex-column">
                                <?php foreach (get_field('dealer_info', 'options')['email'] as $email) : ?>
                                <a href="mailto:<?= $email['email_item'] ?>" class="right-number pos-r d-block">
                                    <span itemprop="email"><?= $email['email_item'] ?></span>
                                </a>
                                <?php endforeach; ?>
                            </span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if (get_field('dealer_info', 'options')['dealer_map']) : ?>
            <div class="col-12 col-md-6 asd">
                <?= get_field('dealer_info', 'options')['dealer_map'] ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php 
get_footer();