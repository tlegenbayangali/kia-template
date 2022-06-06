<?php
$id = 'qr-block-' . $block['id'];
?>

<div class="model-sections <?= $id ?>" id="<?= get_field('id_block') ?>">
    <div class="model-sections-inner  
        <?php if (get_field('dark-mode') == 1) :
            echo 'dark';
        endif;
        ?>" style="background-color:<?php the_field('block-color') ?> ;">
        <!-- TEXT BLOCK-->
        <div class="model-sections-texts-block">
            <div class="model-sections-title">
                <span class="model-sections-title-sub">
                    <?php the_field('items-sub-title') ?>
                </span>
                <h3 class="model-sections-title-headers">
                    <?php the_field('items-title') ?>
                </h3>
            </div>
            <div class="model-sections-two d-flex">
                <div>
                    <img class="model-sections-two-first-img" src="<?= get_field('first_left_image') ?>" alt="img">
                </div>
                <div class="model-sections-two-second-block">
                    <a href="<?= get_field('first_right_img_link') ?>">
                        <img src="<?= get_field('first_right_image') ?>" alt="img">
                    </a>
                    <a href="<?= get_field('second_right_img_link') ?>">
                        <img src="<?= get_field('second_right_image') ?>" alt="img">
                    </a>
                </div>
            </div>
        </div>
        <div class="model-sections-image-block">
            <img class="image-full" src="<?= get_field('big_head_image') ?>" alt="full-image">
        </div>
    </div>
</div>