<div class="col-12 col-md-6 col-xl-3">
    <div class="d-flex bg-lgray h-100-p w-100-p flex-column justify-content-between model">
        <div class="offers-card">
            <div class="img">
                <a href="<?= get_the_permalink() ?>">
                    <?= get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                </a>
            </div>
            <div class="title">
                <div class="d-flex flex-column">
                    <a href="<?= get_the_permalink() ?>">
                        <span class="mr-2 underlined-black fz-15 fw-700">
                            <?= get_the_title() ?>
                        </span>
                    </a>
                    <p class="c-disabled mt-10">
                        <?php 
                            $period = get_field('period', get_the_ID());
                            $date_start = $period['period_start'];
                            $date_end = $period['period_end'];
                        ?>
                        <?php if ( $date_start && $date_end ) : ?>
                            <?php if ( downcounter( $date_end, [ 'days' => true ] ) ) : ?>
                                <?php if (get_field('period', get_the_ID())) : ?>
                                <?= date_i18n( "j", strtotime( $date_start ) ); ?>-<?= date_i18n( "j F Y", strtotime( $date_end ) ); ?>
                                <?php endif; ?>
                            <?php else : ?>
                                Время истекло
                            <?php endif; ?>
                        <?php else: ?>
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