<?php 
    $current_model = $args['current_model'];

    $configs = new WP_Query([
        'post_type' => 'configs',
        'model' => $current_model->post_name,
        'order' => 'asc'
    ]);

    $useful_configs = [];

    foreach ($configs->posts as $config) {
        $useful_configs[] = $config;
    }
?>

<div class="content complections pt-60 pb-60 pl-80">
    <h5 class="counter"></h5>
    <div class="complectation mt-30 grid-1">
        <?php foreach ($useful_configs as $idx => $config) : ?>
        <div class="complectation-item" data-id="<?= $config->post_name ?>">
            <span data-engine="<?= get_field('common_chars', $config->ID)['engine'] ?>" hidden></span>
            <span data-transmission="<?= get_field('common_chars', $config->ID)['transmission'] ?>" hidden></span>
            <span data-dw="<?= get_field('common_chars', $config->ID)['drive_wheels'] ?>" hidden></span>
            <span data-price="<?= get_field('price', $config->ID) ?>" hidden></span>
            <div class="top d-flex justify-content-between align-items-center">
                <div class="left d-flex align-items-center">
                    <div class="complectation-item-icon">
                        <svg class="plus">
                            <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#plus"></use>
                        </svg>
                        <svg class="check">
                            <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                        </svg>
                    </div>
                    <div class="complectation-item-title">
                        <span class="title">
                            <?= $config->post_title ?>
                        </span>
                        <span class="price">
                            <?= get_field('price', $config->ID) ?> ₸
                        </span>
                    </div>
                </div>
                <div class="right">
                    <div class="includes fw-700 d-flex align-items-center">
                        Что включено
                        <svg class="info-additional conditions">
                            <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#arrow-bottom"></use>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bottom mt-30">
                <ul class="check">
                    <?php 
                    
                        $current_config_main_options = get_field('main_options', $config->ID);
                    
                    ?>
                    <?php if ($current_config_main_options) : ?>
                    <?php foreach((array)$current_config_main_options as $option) : ?>
                    <li><?= $option['options_item'] ?></li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
                <button type="button" class="d-none underlined underlined-black mt-30 show-all fw-700" data-fancybox data-src="#<?= $config->post_name ?>">
                    Показать все
                    <svg class="arrow-right">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#arrow-right"></use>
                    </svg>
                </button>
                <div id="<?= $config->post_name ?>" class="complectation-options" style="display: none;">
                    <h2 class="fz-35">
                        <?= $config->post_title ?>
                    </h2>
                    <hr>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>