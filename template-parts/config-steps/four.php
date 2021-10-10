<?php 
    $current_model = $args['current_model'];
    $current_model_colors = get_field('body_colors', $current_model->ID);
    $current_model_interiors = get_field('interior_colors', $current_model->ID);
?>

<div class="content model-colors pt-60 pb-60 pl-80 d-block">
<div class="model-sections-colors"> <!-- MAIN BLOCK FOR COLORS-->
    <div class="model-sections-colors-image-wrapper d-flex justify-content-center">
        <!-- COLORS IMAGE-->
        <div class="model-sections-colors-image" id="model-sections-colors-image-0">
            <img src="" alt="model"> <!-- COLOR IMAGE-->
        </div> <!-- REQUIRED CLASS MODEL SECTION COLORS IMAGE-->
    </div>
    <div class="row mt-30">
        <div class="col-12 col-md-6">
            <div class="model-sections-colors-exterior colorpicker">
                <div class="description-list">
                    <div id="model-sections-colors-exterior-desc-0" class="model-sections-colors-exterior-desc">
                        Цвет:
                        <span><!-- COLOR NAME--></span>
                    </div>
                </div>
                <!-- COLORS LIST EXTERIOR-->   
                <div class="color-list">
                    <?php foreach ($current_model_colors as $color) : ?>
                    <span data-text="<?= $color['body_color_name'] ?>" data-src="<?= $color['body_color_image'] ?>" class="color-list-item" data-color="<?= $color['body_colors_group']['body_colors_first'] ?>" style="background: <?= $color['body_colors_group']['body_colors_first'] ?>;"></span>
                    <?php endforeach; ?>
                </div>                          
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="model-sections-colors-interior colorpicker">
                <div class="description-list">
                    <div id="model-sections-colors-exterior-desc-0" class="model-sections-colors-interior-desc">
                        Интерьер:
                        <span id="interior-color-name">Черный, Искусственная кожа с серой прострочкой (WK)</span>
                    </div>                                      
                </div>
                <!-- COLORS LIST INTERIOR-->   
                <div class="color-list">
                    <?php foreach ((array)$current_model_interiors as $interior) : ?>
                        <span id="model-sections-colors-interior-0" data-color="<?= $interior['interior_color_rgb'] ?>" data-text="<?= $interior['interior_color_name'] ?>" class="color-list-item" style="background: <?= $interior['interior_color_rgb'] ?>"></span>
                    <?php endforeach; ?>
                </div> 
            </div>
        </div>
    </div>
</div>