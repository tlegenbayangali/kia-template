<?php
$id = 'text-block-with-carousel-' . $block['id'];
?>
<div class="model-sections model-sections-margin" id="<?php echo $id; ?>" style="margin-top: -80px;">
    <div class="model-sections-inner  
        <?php if (get_field('dark-mode') == 1) :
            echo 'dark';
        endif;
        ?>" style="background-color:<?php the_field('block-color') ?> ;">
        <!-- TEXT BLOCK-->
        <div class="model-sections-text-block">
            <div class="model-sections-title">
                <span class="model-sections-title-sub">
                    <?php the_field('carousel-sub-title') ?>
                </span>
                <h3 class="model-sections-title-header">
                    <?php the_field('carousel-title') ?>
                </h3>
            </div>
            <div class="model-sections-desc">
                <p class="model-sections-desc-text">
                    <?php the_field('carousel-description') ?>
                </p>
            </div>
        </div>
        <div class="">
            <?php if (have_rows('carousel-list')) : ?>
                <div class="">
                    <div class="swiper-slider-block swiper-container">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper swiper-slider-block-wrapper">
                            <!-- Slides -->
                            <?php while (have_rows('carousel-list')) : the_row();
                                $image = get_sub_field('image');
                            ?>
                                <div class="swiper-slide swiper-slider-block-slide">
                                    <img class="image-full" src="<?php echo $image; ?>" alt="full-image">
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <button class="arrow arrow-prev swiper-button-prev swiper-button-slider-block swiper-button-slider-block-prev" tabindex="0" aria-label="Previous slide" aria-controls="swiper-wrapper-ac5ec47cd2f54bbc" aria-disabled="false">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                <path d="M8 4l-6 6 6 6M2.5 10H21" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                        <button class="arrow arrow-next swiper-button-next swiper-button-slider-block swiper-button-slider-block-next">
                            <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="">
                                <path d="M13 16l6-6-6-6M18.5 10H0" stroke="currentColor" stroke-width="1.5"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="swiper-pagination-slider-block"></div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>