<?php
$id = 'text-block-with-youtube-' . $block[ 'id' ];
?>
<div class="model-sections" id="<?php echo $id; ?>">
    <div class="model-sections-inner model-sections-inner-video
        <?php if (get_field('dark-mode') == 1) :
        echo 'dark';
    endif;
    ?>"
         style="background-color:<?php the_field('block-color') ?> ;">
        <!-- TEXT BLOCK-->
        <div class="model-sections-text-block">
            <div class="model-sections-title">
                <?php if (get_field('model-video-sub-title')) : ?>
                    <span class="model-sections-title-sub">
                        <?php the_field('model-video-sub-title') ?>
                    </span>
                <?php endif; ?>
                <div class="model-sections-title-header">
                    <?php the_field('model-video-title') ?>
                </div>
            </div>
            <div class="model-sections-desc">
                <p class="model-sections-desc-text">
                    <?php the_field('model-video-description') ?>
                </p>
            </div>
        </div>
        <div class="model-sections-image-block pos-r">
            <a href="<?= get_field('model-video_link') ?>" class="youtube-overlay" data-fancybox>
                <div class="youtube-overlay-icon">
                    <img src="<?= get_template_directory_uri() ?>/dist/images/dist/youtube-play.svg" alt="Show Video">
                </div>
            </a>
            <div class="model-video">
                <video autoplay loop muted id="video">
                    <source src="<?= get_field('model-video-source') ?>">
                </video>
            </div>
        </div>
    </div>
</div>