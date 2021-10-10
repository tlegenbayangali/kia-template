<?php
    $id = 'colors-block-' . $block['id'];
?>
<div class="model-sections" id="<?php echo $id;?>">
    <!-- COLORS SECTION-->
    <div class="model-sections-inner-wide">
        <div class="model-sections-colors"> <!-- MAIN BLOCK FOR COLORS-->
            <div class="model-sections-colors-header">
                <?php the_field('colors-block-title')?>
            </div>
            <div class="model-sections-colors-image-wrapper d-flex justify-content-center">
                <!-- COLORS IMAGE-->
                <div class="model-sections-colors-image">
                    <img src="" alt="model"> <!-- COLOR IMAGE-->
                </div> <!-- REQUIRED CLASS MODEL SECTION COLORS IMAGE-->
            </div>
            <div class="model-sections-colors-option">
                <div class="model-sections-colors-exterior">
                        <div class="description-list">
                            <div class="model-sections-colors-exterior-desc">
                                Цвет:
                                <span><!-- COLOR NAME--></span>
                            </div>
                        </div>
                        <!-- COLORS LIST EXTERIOR-->   
                        <div class="color-list">
                            <!-- LIST ITEMS -->
                            <?php
                            while( have_rows('colors-block-list-items') ) : the_row();?>
                                <span
                                    data-text="<?php the_sub_field('colors-block-list-items-colorname');?>"
                                    data-src="<?php the_sub_field('colors-block-list-items-imagesrc');?>"
                                    class="color-list-item"
                                    style="background-color:<?php the_sub_field('colors-block-list-items-color');?>">
                                </span>
                            <?php
                            endwhile;
                            ?>
                        </div>                          
                </div>
                <div class="model-sections-colors-interior">
                        <div class="description-list">
                            <div>
                                Интерьер:
                                <span>Черный, Искусственная кожа с серой прострочкой (WK)</span>
                            </div>                                      
                        </div>
                        <!-- COLORS LIST INTERIOR-->   
                        <div class="color-list">
                            <span class="color-list-item active" style="background: rgba(0, 0, 0, 0.8);"></span>
                        </div> 
                </div>
            </div>
        </div>                    
    </div>
</div>