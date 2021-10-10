<?php 

$configs = new WP_Query([
    'post_type' => 'configs',
    'model' => $args['current_model']->post_name,
    'order' => 'asc'
]);

$useful_configs = [];

foreach ($configs->posts as $config) {
    $useful_configs[] = $config;
}

?>
<div class="content config-result <?php if (!$args['current_step'] == 5) : ?>pt-60 pb-60 pl-80<?php endif; ?>">
    <h2 class="fz-35 mt-60">
        <span class="model-title"><?= $args['current_model']->post_title ?></span> <span class="title-complectation"><!--Complectation name--></span>
    </h2>
    <h3 class="current-price mt-10 fz-25">
        <!-- Price From SessionStorage -->
    </h3>
    <hr>
    <div class="d-flex justify-content-center">
        <img id="result-img" src="" alt="model"> <!-- COLOR IMAGE-->
    </div>
    <div class="config-details mt-60 mb-60 d-flex justify-content-between">
        <div class="left d-flex flex-column">
            <div class="config-title mb-30">
                <h5 class="fz-18">
                    Двигатель и трансмиссия
                </h5>
            </div>
            <div class="config-details-table">
                <div class="config-details-row">
                    <div class="left">
                        Год производства
                    </div>
                    <div class="right fw-700" id="result-id">
                        2021
                    </div>
                </div>
                <div class="config-details-row">
                    <div class="left">
                        Двигатель
                    </div>
                    <div class="right fw-700" id="result-engine">
                        2021
                    </div>
                </div>
                <div class="config-details-row">
                    <div class="left">
                        Коробка передач
                    </div>
                    <div class="right fw-700" id="result-transmission">
                        2021
                    </div>
                </div>
                <div class="config-details-row">
                    <div class="left">
                        Привод
                    </div>
                    <div class="right fw-700" id="result-dw">
                        2021
                    </div>
                </div>
            </div>
        </div>
        <div class="right d-flex flex-column">
            <div class="config-title mb-30">
                <h5 class="fz-18">
                    Цвет
                </h5>
            </div>
            <div class="config-details-table flex-grow-1">
                <div class="config-details-row">
                    <div class="left">
                        Кузов
                    </div>
                    <div class="right fw-700">
                        <div class="model-sections-colors-exterior d-flex align-items-center justify-content-end" id="exterior-result">
                            <!-- COLORS LIST EXTERIOR-->   
                            <span class="color-item-name mr-20"></span>
                            <div class="color-list"><span class="color-list-item"></span>
                            </div>                           
                        </div>
                    </div>
                </div>
                <div class="config-details-row">
                    <div class="left">
                        Интерьер
                    </div>
                    <div class="right fw-700">
                        <div class="model-sections-colors-exterior d-flex align-items-center justify-content-end" id="interior-result">
                            <!-- COLORS LIST EXTERIOR-->   
                            <span class="color-item-name mr-20"></span>
                            <div class="color-list">
                                <span class="color-list-item"></span>
                            </div>                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="configurator-options">
    <div id="<?= $config->post_name ?>" class="complectation-options" style="display: none;">
        <h2 class="fz-35">
            <?= $config->post_title ?>
        </h2>
        <hr>
        <div class="equip-config">
            <!-- ONE SECTION -->
            <?php 
                $option_group = get_field('complectation_options', $config->ID);
            ?>
            <?php foreach ((array)$option_group as $group) : ?>
            <section class="equip-config-section mt-30">
                <!-- MAIN TITLE-->
                <h2 class="equip-config-section-title">
                    <?= $group['complectation_options_heading'] ?? 'Heading' ?>
                </h2>
                <!-- ONE SECTION CAROUSEL ITEMS WRAPPER-->
                <div class="equip-config-section-items mt-30">
                    <!-- ONE SECTION CAROUSEL ITEM-->
                    <ul class="check">
                    <?php if (!empty($group['complectation_option_items'])) : ?>
                        <?php foreach ((array)$group['complectation_option_items'] as $item) : ?>
                            <li>
                                <?= $item['options_item'] ?>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </ul>
                </div>
            </section>
            <?php endforeach; ?>
        </div>
    </div>
    </section>
</div>