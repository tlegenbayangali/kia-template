<?php
    $id = 'text-block-with-popup-' . $block['id'];
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
                <h3 class="model-sections-title-header">
                    <?php the_field('popup-title')?>
                </h3>
            </div>
            <div class="model-sections-desc">
                <p class="model-sections-desc-text">
                    <?php the_field('popup-description')?>
                </p>
                    <?php if ( get_field('popup-select') === 'да') { ?>
                        <a href="#" class="model-sections-desc-button d-inline-flex align-items-center">
                        <span class="model-sections-desc-button-image">
                            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="20" cy="20" r="19" stroke="#05141F" stroke-width="2"/>
                                <path d="M20 15L20 25" stroke="#05141F" stroke-width="2"/>
                                <path d="M15 20H25" stroke="#05141F" stroke-width="2"/>
                            </svg>
                        </span>
                            <!-- <img src="<?= get_template_directory_uri() ?>/dist/images/dist/cars-single/sections-desc.svg" alt="desc-more-icon"> -->
                            <span class="model-sections-desc-button-text">
                                Подробнее
                            </span>
                        </a>
                        <?php if( have_rows('popup-window') ): ?>
                            <!-- MODAL--> <!-- POPUP BLOCK-->
                            <div class="model-sections-desc-modal">
                                <div class="model-sections-desc-modal-title">
                                    <span class="model-sections-desc-modal-title-text">
                                        <?php the_field('popup-sub-title')?>
                                    </span>
                                    <a href="#" class="close">
                                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5 5L25 25" stroke="black" stroke-width="1.5"/>
                                            <path d="M25 5L5 25" stroke="black" stroke-width="1.5"/>
                                        </svg>
                                    </a>
                                </div>
                                <div class="<?php
                                    if( get_field('popup_blocks_location') == 1) :
                                    echo 'list-left';
                                    else : echo '';
                                    endif;
                                    ?> model-sections-desc-modal-list model-sections-list"> <!-- REQUIRED CLASS LIST -->
                                    <div class="model-sections-list-smallimage model-sections-list-parent"> <!-- REQUIRED CLASS LIST PARENT -->
                                        <?php while( have_rows('popup-window') ) : the_row();?>
                                            <div class="model-sections-list-smallimage-item">
                                                <img src="<?php the_sub_field('popup-window-list-image');?>" alt="small-image">
                                                <?php if(get_field('popup-window-list-image-desc')) { ?>
                                                <span class="model-sections-list-smallimage-excerpt">
                                                    <?php the_sub_field('popup-window-list-image-desc');?>
                                                </span>
                                                <?php } ?>
                                            </div> <!-- 1-->
                                        <?php
                                        endwhile;
                                        ?>
                                    </div>
                                    <div class="model-sections-list-right">
                                        <?php if( get_field('popup-inner-title')) :?>
                                            <div class="model-sections-list-title">
                                                <?= get_field('popup-inner-title');?>
                                            </div>
                                         <?php endif;?>
                                        <?php if(get_field('popup-inner-desc')) { ?>
                                        <div class="model-sections-desc">
                                            <p class="model-sections-desc-text">
                                                <?php the_field('popup-inner-desc');?>
                                            </p>
                                        </div>
                                        <?php } ?>
                                        <div class="model-sections-list-items list-items"> <!-- REQUIRED CLASS LIST ITEMS -->
                                            <ul class="model-sections-list-items-inner">
                                                <!-- LIST ITEMS -->
                                                <?php
                                                while( have_rows('popup-window') ) : the_row();?>
                                                    <li class="">
                                                        <a href="#">
                                                            <?php the_sub_field('popup-window-list-description');?>
                                                        </a>
                                                    </li>
                                                <?php
                                                endwhile;
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endif; 
                    } ?>
            </div>
        </div>
        <div class="model-sections-image-block">
            <img class="image-full" src="<?php the_field('block-image')?>" alt="full-image">
        </div>
    </div>
</div>