<?php
    $id = 'text-block-with-youtube-' . $block['id'];
?>
<div class="model-sections" id="<?php echo $id;?>">
    <div class="model-sections-inner  
        <?php if( get_field('dark-mode') == 1 ) :
                echo 'dark';
            endif;
        ?>"
        style="background-color:<?php the_field('block-color')?> ;">
        <!-- TEXT BLOCK-->
        <div class="model-sections-text-block">
            <div class="model-sections-title">
                <span class="model-sections-title-sub">
                    <?php the_field('popup-sub-title')?>
                </span>
                <div class="model-sections-title-header">
                    <?php the_field('popup-title')?>
                </div>
            </div>
            <div class="model-sections-desc">
                <p class="model-sections-desc-text">
                    <?php the_field('popup-description')?>
                </p>
            </div>
        </div>
        <div class="model-sections-image-block pos-r">
            <a href="https://www.youtube.com/watch?v=5XlTBGhoWvo" class="youtube-overlay" data-fancybox>
                <div class="youtube-overlay-icon">
                    <img src="<?= get_template_directory_uri() ?>/dist/images/dist/youtube-play.svg" alt="Show Video">
                </div>
            </a>
            <img class="image-full" src="<?php the_field('block-image')?>" alt="full-image">
        </div>
    </div>
</div>