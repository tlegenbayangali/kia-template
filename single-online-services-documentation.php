<?php get_header(); ?>
<?php 

    $models = new WP_Query([
        'post_type' => 'models',
        'post_parent' => 0
    ]);

?>
<div class="page">
    <div class="page-cover d-flex flex-column justify-content-between pb-20" style="background: url(<?= get_field('heading_bg', get_the_ID()) ?>) no-repeat center/cover">
        <div class="top">
            <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
            <div class="container">
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
    </div>
    <section class="car-info pt-60 pb-60 section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="fz-25">Данные об автомобиле</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="dalacode-selector mt-20 mb-8" data-container="models-container">
                        <input value="Все модели" type="text" hidden="true">
                        <div class="current d-flex justify-content-between align-items-center">
                            <span></span>
                            <svg>
                                <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#arrow-right"></use>
                            </svg>
                        </div>
                        <div class="options">
                            <ul>
                                <?php foreach ($models->posts as $model) : ?>
                                <li data-option="<?= $model->post_name ?>">
                                    <?= $model->post_title ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php foreach ($models->posts as $idx => $model) : ?>
                    <div class="car-info-content model <?php if ($idx != 0) : echo 'd-none'; endif; ?>" data-option="<?= $model->post_name ?>">
                        <div class="row">
                            <div class="col-lg-4">
                                <h4 class="fz-35">
                                    <?= $model->post_title ?>
                                </h4>
                                <div class="car-info-img mt-20">
                                    <?= get_the_post_thumbnail( $model->ID, 'full' ) ?>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="car-info-documents">
                                    <?php
                                        $docs = get_field('documentation', $model->ID);
                                        $brochure = get_field('brochure', $model->ID);
                                        $price_list = get_field('model_price_list', $model->ID);

                                        $docs[]['document'] = $brochure;
                                        $docs[]['document'] = $price_list;
                                    ?>
                                    <?php foreach((array)$docs as $doc) : ?>
                                    <a href="<?= $doc['document']['url'] ?>" class="car-info-documents-item">
                                        <svg class="file">
                                            <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#file"></use>
                                        </svg>
                                        <span>
                                            <?= $doc['document']['title'] ?>
                                        </span>
                                        <svg class="arrow-bottom">
                                            <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#arrow-bottom"></use>
                                        </svg>
                                    </a>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>