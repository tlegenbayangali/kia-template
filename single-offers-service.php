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
                        <div class="post-title d-none">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                        </div>
                        <div class="post-thumbnail">
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
                        <div class="offer-info d-flex">
                            <div class="period">
                                <span class="d-block mb-10">Длительность</span>
                                <span class="lg d-block">
                                    <?php
                                        $now = new DateTime('Asia/Oral');

                                        $period = get_field('period', get_the_ID());
                                        $date_start = DateTime::createFromFormat('Y-m-d', $period[ 'period_start' ]);
                                        $date_end = DateTime::createFromFormat('Y-m-d', $period[ 'period_end' ]);
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
                                    <?php else: ?>
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
            <hr>
            <div id="callback-form" class="container pb-60 pt-30">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex callback-col justify-content-center">
                            <div class="callback-form" id="offer-form">
                                <h5 class="mb-2">Отправить заявку дилеру</h5>
                                <p>После отправки заявки, дилер свяжется с Вами для уточнения деталей.</p>
                                <p class="fz-12 mt-10 c-disabled">Поля, отмеченные *, обязательны для заполнения</p>
                                <?php if (get_field('foreign_form', 'options')) : ?>
                                    <?= get_field('foreign_form', 'options') ?>
                                <?php else : ?>
                                    <?= do_shortcode('[contact-form-7 id="4335" title="Форма заявки со страницы спецпредложения сервиса"]') ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
get_footer(); ?>