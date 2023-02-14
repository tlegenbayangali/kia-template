<?php
$id = 'without-list-img-' . $block[ 'id' ];
?>
<div class="model-sections" id="<?php echo $id; ?>">
    <div class="model-sections-inner-new  
        <?php if (get_field('dark-mode') == 1) :
        echo 'dark';
    endif;
    ?>" style="background-color:<?php the_field('block-color') ?>;">
        <div class="model-sections-list-block align-items-center">
            <div class="model-sections-list-left">
                <div class="model-sections-title">
                    <span class="model-sections-title-sub">
                        Обслуживание
                    </span>
                    <h3 class="model-sections-title-headers">
                        <?php the_field('items-title') ?>
                    </h3>
                </div>
                <?php if (get_field('items-description')) { ?>
                    <div class="model-sections-desc">
                        <p class="model-sections-desc-text">
                            <?php the_field('items-description'); ?>
                        </p>
                    </div>
                <?php } ?>
            </div>
            <div class="model-sections-list-image d-flex">
                <div class="model-sections-list-image-item d-block">
                    <img src="<?php the_field('items-image'); ?>" alt="small-image">
                </div>
            </div>
        </div>
    </div>
</div>