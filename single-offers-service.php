<?php
get_header(); ?>
    <div class="page">
        <section class="pb-60">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="breadcrumbs">
                            <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs();?>
                        </div>
                        <div class="post-title">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                        </div>
                        <div class="post-thumbnail mt-20">
                            <?= get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                        </div>
                    </div>
                </div>
                <div class="row mt-20 justify-content-center">
                    <div class="col-lg-7">
                        <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
                            <?php the_content(); ?>
                        </article>
                    </div>
                </div>
            </div>
            <hr>
            <div class="container">
                <div class="row mt-20 justify-content-center">
                    <div class="col-lg-7">
                        <div class="offer-info flex-column flex-md-row justify-content-md-end">
                            <div class="period">
                                <span class="d-block mb-10">Длительность</span>
                                <span class="lg d-block">
                                    <?php
                                    $period = get_field('period', get_the_ID());
                                    $date_start = $period[ 'period_start' ];
                                    $date_end = $period[ 'period_end' ];
                                    ?>
                                    <?php
                                    if ($date_start && $date_end) : ?>
                                        <?php
                                        if (downcounter($date_end, ['days' => true])) : ?>
                                            <?php
                                            if (get_field('period', get_the_ID())) : ?>
                                                <?= date_i18n("j", strtotime($date_start)); ?>-<?= date_i18n("j F Y",
                                                    strtotime($date_end)); ?>
                                            <?php
                                            endif; ?>
                                        <?php
                                        else : ?>
                                            Время истекло
                                        <?php
                                        endif; ?>
                                    <?php
                                    else: ?>
                                        Постоянная акция
                                    <?php
                                    endif; ?>
                                </span>
                            </div>
                            <?php
                            if (downcounter($date_end, ['days' => true])) : ?>
                                <div class="period">
                                    <span class="d-block mb-10">До завершения</span>
                                    <span class="lg d-block">
                                        <?= downcounter($date_end, [
                                            'days' => true
                                        ]) ?>
                                    </span>
                                </div>
                            <?php
                            endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div id="callback-form" class="container-fluid pb-60 pt-30">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex callback-col justify-content-center">
                            <div class="callback-form" id="offer-form">
                                <h5 class="mb-2">Отправить заявку дилеру</h5>
                                <p>После отправки заявки, дилер свяжется с Вами для уточнения деталей.</p>
                                <p class="fz-12 mt-10 c-disabled">Поля, отмеченные *, обязательны для заполнения</p>
                                <?= do_shortcode('[contact-form-7 id="4335" title="Форма заявки со страницы спецпредложения сервиса"]') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
get_footer(); ?>