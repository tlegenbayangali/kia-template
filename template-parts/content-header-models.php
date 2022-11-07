<div class="header-model-wrapper">
    <div class="header-model" id="header-model">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-model-inner d-flex justify-content-between">
                        <?php
                        $current_m = $args['parent_post']->post_name;

                        $parent_post = get_post($post->post_parent);
                        $parent_post_id = get_post()->post_parent;
                        $config_s = new WP_Query([
                            'post_type' => 'configs',
                            'model' => $current_m,
                        ]);

                        $prices_array = [];

                        foreach ($config_s->posts as $post) :
                            $prices_array[] = get_field('price', $post->ID);
                        endforeach;
                        if (count($prices_array) > 1) :
                            $model_min_price = min(...$prices_array);
                        else :
                            $model_min_price = $prices_array[0];
                        endif;
                        $GLOBALS['model_min_price'] = $model_min_price;
                        wp_reset_query();
                        ?>
                        <div class="header-model-left model d-flex align-items-center">
                            <h1 class="header-model-name d-flex align-items-center"><?php echo esc_html(get_the_title($args['parent_post']->ID)); ?></h1>



                            <!--<a href="#" class="header-model-name d-flex align-items-center">
                                <?php // echo esc_html( get_the_title($args['parent_post']->ID) );
                                ?>
                                <button type="button"
                                    class="button-arrow d-xl-none d-flex align-items-center justify-content-center">
                                    <svg class="arrow-bottom">
                                        <use xlink:href="<?php // echo get_template_directory_uri() 
                                                            ?>/dist/images/dist/sprite.svg#arrow-bottom"></use>
                                    </svg>
                                </button>
                            </a>-->



                            <div class="header-model-price align-items-center d-xl-flex d-none">
                                <!-- Edit Sagyndyk -->
                                <?php if (get_field('show_or_hide_price_models', $post->ID)) : ?>
                                    <?php if (get_field('starting_price', $args['parent_post']->ID)) : ?>
                                        <span class="d-block"> от <?= get_field('starting_price', $args['parent_post']->ID) ?> ₸ </span>
                                    <?php endif ?>
                                <?php endif ?>
                                <?php if (get_field('car_price_conditions', $args['parent_post']->ID)) : ?>
                                    <svg class="ml-10 info-additional conditions">
                                        <use xlink:href="<?php echo get_template_directory_uri() ?>/dist/images/dist/sprite.svg#info-circle"></use>
                                    </svg>
                                <?php endif; ?>
                            </div>
                            <div class="model-conditions">
                                <?= get_field('car_price_conditions', $args['parent_post']->ID) ?>
                            </div>
                        </div>
                        <?php
                        $arguments = array(
                            'posts_per_page' => '-1',
                            'post_type' => 'offers-cars',
                            'model' => $args['parent_post']->post_name,
                        );
                        $offers_cars = new WP_Query($arguments);
                        ?>
                        <div class="header-model-menu d-flex align-items-center">
                            <ul class="header-model-menu-main d-none d-xl-flex">
                                <li>
                                    <a class="underlined underlined-white" href="<?php echo get_home_url(null, '/models') . '/' . $args['parent_post']->post_name; ?>/">
                                        Обзор
                                    </a>
                                </li>
                                <?php if (get_field('show_complectations')) : ?>
                                    <li>
                                        <a class="underlined underlined-white" href="<?php echo get_home_url(null, '/models') . '/' . $args['parent_post']->post_name . '/complectations/'; ?>">
                                            Комплектации и цены
                                        </a>
                                    </li>
                                    <li>
                                        <a class="underlined underlined-white" href="<?php echo get_home_url(null, '/models') . '/' . $args['parent_post']->post_name . '/characteristics/'; ?>">
                                            Характеристики
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a class="underlined underlined-white" href="/callback?current_model=<?= $args['parent_post']->post_name ?>">
                                        Заявка дилеру
                                    </a>
                                </li>
                                <?php if (get_field('brochure', $parent_post_id)) : ?>
                                    <li>
                                        <a class="underlined underlined-white" href="<?= get_field('brochure', $parent_post_id)['url'] ?>"">
                                            Брошюра
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <!-- <li>
                                    <a class=" underlined underlined-white" href="<?php echo get_home_url(null, '/models') . '/' . $args['parent_post']->post_name . '/credit/'; ?>">
                                            Рассчитать кредит
                                        </a>
                                    </li> -->
                                    <!-- <li class="has-sub d-xl-flex d-none header-model-menu-main-button">
                                    <button type="button"
                                        class="button-dots d-flex align-items-center justify-content-center">
                                        <svg class="dots">
                                            <use xlink:href="<?= get_template_directory_uri() ?>/dist/images/dist/sprite.svg#dots"></use>
                                        </svg>
                                    </button>
                                    <div class="header-model-menu-sub-wrapper box-sh">
                                        <ul class="header-model-menu-sub">
                                            <li>
                                                <a class="underlined underlined-white" href="<?php echo get_home_url(null, '/online-services/test-drive/#') . $args['parent_post']->post_name; ?>">
                                                    Тест-драйв
                                                </a>
                                            </li>
                                            <li>
                                                <a class="underlined underlined-white" href="/callback?current_model=<?= $args['parent_post']->post_name ?>">
                                                    Заявка дилеру
                                                </a>
                                            </li>
                                            <?php if ($offers_cars->post_count > 0) { ?>
                                            <li>
                                                <a class="underlined underlined-white" href="<?php echo get_home_url(null, '/models') . '/' . $args['parent_post']->post_name . '/specials'; ?>">
                                                    Спецпредложения
                                                </a>
                                            </li>
                                            <?php } ?>
                                            <li>
                                                <a class="underlined underlined-white" href="<?php echo get_home_url(null, 'online-services/available-cars') ?>">
                                                    Авто в наличии
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li> -->
                            </ul>
                            <button id="single-model-car-button" type="button" class="d-flex d-xl-none align-items-center justify-content-center">
                                <svg class="d-block">
                                    <use xlink:href="<?= get_template_directory_uri() ?>/dist/images/dist/sprite.svg#dots"></use>
                                </svg>
                            </button>
                            <nav class="header-single-model-mobile">
                                <ul class="header-model-menu-main-mobile">
                                    <li>
                                        <a class="underlined " href="<?php echo get_home_url(null, '/models') . '/' . $args['parent_post']->post_name; ?>/">
                                            Обзор
                                        </a>
                                    </li>
                                    <?php if (get_field('show_complectations')) : ?>
                                        <li>
                                            <a class=" " href="<?php echo get_home_url(null, '/models') . '/' . $args['parent_post']->post_name . '/complectations/'; ?>">
                                                Комплектации и цены
                                            </a>
                                        </li>
                                        <li>
                                            <a class=" " href="<?php echo get_home_url(null, '/models') . '/' . $args['parent_post']->post_name . '/characteristics/'; ?>">
                                                Характеристики
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <li>
                                        <a class=" " href="/callback?current_model=<?= $args['parent_post']->post_name ?>">
                                            Заявка дилеру
                                        </a>
                                    </li>
                                    <?php if (get_field('brochure', $parent_post_id)) : ?>
                                        <li>
                                            <a class=" " href="<?= get_field('brochure', $parent_post_id)['url'] ?>"">
                                            Брошюра
                                        </a>
                                    </li>
                                <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>