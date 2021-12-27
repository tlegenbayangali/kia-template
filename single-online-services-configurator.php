<?php 

get_header();

$models = new WP_Query([
	'post_type' => 'models',
	'post_parent' => 0
]);

$categories = [];

foreach ($models->posts as $model) {
	$category = get_field('category', $model->ID);
	if (!in_array($category, $categories)) {
		$categories[] = $category;
	}
}

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="mt-30"><?php the_title(); ?></h1>
        </div>
    </div>
</div>
<div class="steps mt-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="steps-wrapper">
                    <div class="steps-item current">
                        <div class="steps-item-number">
                            01
                        </div>
                        <div class="steps-item-heading">
                            Выбор модели
                        </div>
                    </div>
                    <div class="steps-item">
                        <div class="steps-item-number">
                            02
                        </div>
                        <div class="steps-item-heading">
                            Двигатель и трансмиссия
                        </div>
                    </div>
                    <div class="steps-item">
                        <div class="steps-item-number">
                            03
                        </div>
                        <div class="steps-item-heading">
                            Комплектация
                        </div>
                    </div>
                    <div class="steps-item">
                        <div class="steps-item-number">
                            04
                        </div>
                        <div class="steps-item-heading">
                            Цвета и отделка
                        </div>
                    </div>
                    <div class="steps-item">
                        <div class="steps-item-number">
                            05
                        </div>
                        <div class="steps-item-heading">
                            Результаты
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr />


<div class="step-one-page">
    <section class="models models-grouped">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php foreach($categories as $category) : ?>
                    <div class="group">
                        <div class="group-heading">
                            <h3 class="section-heading"><?= $category ?></h3>
                        </div>
                        <div class="group-models pb-60 d-flex flex-wrap">
                            <?php foreach ($models->posts as $model) : ?>
                                <?php if (get_field('category', $model->ID) == $category) : ?>
                                    <div class="swiper-slide d-flex flex-column justify-content-between model" data-option="<?= $model->post_name ?>">
                                        <div class="top">
                                            <div class="img">
                                                <a href="/models/<?= $model->post_name ?>/config/">
                                                    <?= get_the_post_thumbnail($model->ID, 'full') ?>
                                                </a>
                                            </div>
                                            <div class="title">
                                                <div class="d-flex">
                                                    <a href="/models/<?= $model->post_name ?>/config/">
                                                        <span class="title-content underlined mr-2 underlined-black fz-18 fw-700"><?= $model->post_title ?></span>
                                                    </a>
                                                    
                                                    <?php if (get_field('is_new_model', $model->ID)) : ?>
                                                    <span class="mark-green">Новинка</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="model-row">
                                                <div class="d-flex">
                                                    <span class="price-sm mr-2">от <?= get_field('starting_price', $model->ID) ?> ₸</span>
                                                    <?php if (get_field('car_price_conditions', $model->ID)) : ?>
                                                    <svg class="info-additional conditions">
                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#info-circle"></use>
                                                    </svg>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if (get_field('every_month_price', $model->ID)) : ?>
                                            <div class="model-row">
                                                <div class="d-flex">
                                                    <span class="price-sm mr-2"><?= get_field('every_month_price', $model->ID) ?> ₸/мес</span>
                                                    <?php if (get_field('car_credit_calc', $model->ID)) : ?>
                                                    <svg class="info-additional credit">
                                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#info-circle"></use>
                                                    </svg>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (get_field('profit', $model->ID)) : ?>
                                            <div class="model-row">
                                                <div class="d-flex">
                                                    <span class="mark-yellow">
                                                        Выгода до <?= get_field('profit', $model->ID) ?> ₸
                                                    </span>
                                                </div>
                                            </div>
                                            <?php endif; ?>

                                            <?php if (get_field('car_price_conditions', $model->ID)) : ?>
                                            <div class="model-conditions">
                                                <?= get_field('car_price_conditions', $model->ID) ?>
                                            </div>
                                            <?php endif; ?>

                                            <?php if (get_field('car_credit_calc', $model->ID)) : ?>
                                            <div class="model-credit">
                                                <?= get_field('car_credit_calc', $model->ID) ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="bottom">
                                            <div class="model-row justify-content-end">
                                                <div class="d-flex links">
                                                    <a href="/models/<?= $model->post_name ?>/config/" class="underlined underlined-black readmore">
                                                        Подобрать конфигурацию
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>