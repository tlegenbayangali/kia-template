<?php get_header(); ?>
<div class="page">
    <div class="page-cover d-flex flex-column justify-content-between pb-20" style="background: url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>) no-repeat center/cover">
        <div class="top">
            <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
            <div class="container-fluid">
                <div class="row mt-20">
                    <div class="col-lg-8">
                        <div class="post-title">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="row mt-20">
                    <div class="col-lg-6">
                        <p>
                            <?= get_field('short_description', get_the_ID()) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="offer-info d-flex flex-column flex-md-row">
                            <div class="period">
                                <span class="lg d-block">
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
                                </span>
                                <span class="d-block mt-10">Длительность</span>
                            </div>
                            <?php if ( downcounter( $date_end, [ 'days' => true ] ) ) : ?>
                            <div class="period">
                                <span class="lg d-block">
                                    <?= downcounter($date_end, [
                                        'days' => true
                                    ]) ?>
                                </span>
                                <span class="d-block mt-10">До завершения</span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="pt-60 pb-60">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
                        <?php the_content(); ?>
                    </article>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>