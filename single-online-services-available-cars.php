<?php get_header(); ?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<section class="cars">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="group">
                    <div class="group-heading">
                        <h3 class="section-heading"><?php the_title(); ?></h3>
                        <div class="section-desc">
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="group-cards">
                        <?php 
                        
                            $models = new WP_Query([
                                'post_type' => 'models',
                                'post_parent' => 0
                            ]);

                            foreach ($models->posts as $model) :
                        
                        ?>
                        <div class="group-card">
                            <div class="top">
                                <div class="img">
                                    <a href="<?= get_post_permalink($model->ID) ?>">
                                        <?= get_the_post_thumbnail($model->ID, 'full') ?>
                                    </a>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="title">
                                    <div class="d-flex">
                                        <a href="<?= get_post_permalink($model->ID) ?>" class="d-flex align-items-center">
                                            <span class="underlined underlined-black fz-25 fw-700"><?= $model->post_title ?></span>
                                            <svg class="inline-svg-icon">
                                                <use xlink:href="<?= get_template_directory_uri() ?>/dist/images/dist/sprite.svg#arrow-right"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>