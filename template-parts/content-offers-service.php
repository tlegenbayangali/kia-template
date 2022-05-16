<div class="col-12 col-md-6 col-xl-4">
    <div class="d-flex bg-lgray h-100-p w-100-p flex-column justify-content-between model">
        <div class="offers-card">
            <div class="img">
                <a href="<?= get_the_permalink() ?>">
                    <?= get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                </a>
            </div>
            <div class="title">
                <div class="d-flex flex-column">
                    <?php if (get_field('is_show_card_heading', 'options')) : ?>
                    <a href="<?= get_the_permalink() ?>">
                        <span class="mr-2 underlined-black fz-15 fw-700">
                            <?= get_the_title() ?>
                        </span>
                    </a>
                    <?php endif; ?>
                    <p class="c-disabled mt-10">
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
                            <?php if ($now >= $date_start && $now <= $date_end) : ?>
                                Осталось: 
                                <?php if ($left->d == 0 || $left->d >= 5) : ?>
                                    <?= $left->d ?> дней
                                <?php elseif ($left->d == 1) : ?>
                                    <?= $left->d ?> день
                                <?php elseif ($left->d >= 2 && $left->d <= 4) : ?>
                                    <?= $left->d ?> дня
                                <?php endif; ?>
                            <?php elseif ($now < $date_start) : ?>
                                Начало акции: <?= $date_start->format('d.m.Y') ?>
                            <?php else : ?>
                                Завершено
                            <?php endif; ?>
                        <?php else : ?>
                            Постоянная акция
                        <?php endif; ?>
                    </p>
                    <p class="offers-desc">
                        <?= get_field('short_description', get_the_ID()) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>