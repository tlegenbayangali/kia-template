<?php 

    $current_model = $args['current_model'];
                
    $configs = new WP_Query([
        'post_type' => 'configs',
        'posts_per_page' => 100
    ]);

    $current_model_configs = [];

    foreach ($configs->posts as $config) {
        $config_model = wp_get_post_terms($config->ID, 'model');
        if ($config_model[0]->slug == $current_model->post_name) {
            $current_model_configs[] = $config;
        }
    }
    
    $engines_set = [];
    $transmissions_set = [];
    $drive_wheels_set = [];

    foreach ($current_model_configs as $id => $config) {
        $engine_set = [
            'id' => $id,
            'engine' => get_field('common_chars', $config->ID)['engine'],
            'power' => get_field('power', $config->ID),
            'engine_type' => get_field('engine_type', $config->ID),
            'starting_price' => get_field('price', $config->ID)
        ];
        $engines_set[] = $engine_set;

        $transmission_set = [
            'transmission' => get_field('common_chars', $config->ID)['transmission'],
            'price' => get_field('price', $config->ID),
        ];
        $transmissions_set[] = $transmission_set;

        $drive_wheel_set = [
            'drive_wheels' => get_field('common_chars', $config->ID)['drive_wheels'],
            'price' => get_field('price', $config->ID)
        ];
        $drive_wheels_set[] = $drive_wheel_set;
    }

    $engines_set = by_engine($engines_set);
    $transmissions_set = by_transmission($transmissions_set);
    $drive_wheels_set = by_drive_wheel($drive_wheels_set);

    function by_engine($arr) {
        $result = [];
        foreach ($arr as $id => $l) {
            $result[$l['engine']]['ids'][] = $id;
            $result[$l['engine']]['power'] = $l['power'];
            $result[$l['engine']]['engine_type'] = $l['engine_type'];
            $result[$l['engine']]['starting_price'][] = $l['starting_price'];
        }
        return $result;
    }

    function by_transmission($arr) {
        $result = [];
        foreach ($arr as $id => $l) {
            $result[$l['transmission']]['ids'][] = $id;
            $result[$l['transmission']]['prices'][] = $l['price'];
        }
        return $result;
    }

    function by_drive_wheel($arr) {
        $result = [];
        foreach ($arr as $id => $l) {
            $result[$l['drive_wheels']]['ids'][] = $id;
            $result[$l['drive_wheels']]['prices'][] = $l['price'];
        }
        return $result;
    }
?>

<div class="content confgurator step-2 pt-60 pb-60 pl-80">
    <div class="parameter mb-30" id="engine">
        <h5 class="mb-30 parameter-heading">Двигатель</h5>
        <div class="parameter-group">
            <?php foreach ($engines_set as $id => $engine) : ?>
            <button class="parameter-item d-flex align-items-center" data-id="<?= json_encode($engine['ids']) ?>">
                <div class="parameter-item-icon">
                    <svg class="plus">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#plus"></use>
                    </svg>
                    <svg class="check">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                    </svg>
                </div>
                <div class="parameter-item-title ml-20">
                    <span class="fw-700 d-block tal span-title">
                        <?= $id ?>
                    </span>
                    <span class="tal">
                        <?= $engine['power'] ?> л.с. <?= $engine['engine_type'] ?>
                    </span>
                    <?php foreach ($engine['starting_price'] as $price) : ?>
                        <span class="starting_price" data-price="<?= $price ?>"></span>
                    <?php endforeach; ?>
                </div>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="parameter mb-30" id="transmission">
        <h5 class="mb-30 parameter-heading">Коробка передач</h5>
        <div class="parameter-group">
            <?php foreach ($transmissions_set as $id => $transmission) : ?>
            <button class="parameter-item d-flex align-items-center disabled" data-id="<?= json_encode($transmission['ids']) ?>">
                <div class="parameter-item-icon">
                    <svg class="plus">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#plus"></use>
                    </svg>
                    <svg class="check">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                    </svg>
                </div>
                <div class="parameter-item-title ml-20">
                    <span class="fw-700 d-block span-title">
                        <?= $id ?>
                    </span>
                    <?php foreach ($transmission['prices'] as $price) : ?>
                        <span class="starting_price" data-price="<?= $price ?>"></span>
                    <?php endforeach; ?>
                </div>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="parameter" id="dw">
        <h5 class="mb-30 parameter-heading">Привод</h5>
        <div class="parameter-group">
            <?php foreach ($drive_wheels_set as $id => $dw) : ?>
            <button class="parameter-item d-flex align-items-center disabled" data-id="<?= json_encode($dw['ids']) ?>">
                <div class="parameter-item-icon">
                    <svg class="plus">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#plus"></use>
                    </svg>
                    <svg class="check">
                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#check"></use>
                    </svg>
                </div>
                <div class="parameter-item-title ml-20">
                    <span class="fw-700 d-block span-title">
                        <?= $id ?>
                    </span>
                    <?php foreach ($dw['prices'] as $price) : ?>
                        <span class="starting_price" data-price="<?= $price ?>"></span>
                    <?php endforeach; ?>
                </div>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
</div>