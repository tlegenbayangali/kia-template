<?php
    $id = 'horizontal-list-' . $block['id'];
?>
<div class="model-sections" id="<?php echo $id;?>">
    <div class="model-sections-inner  
        <?php if( get_field('dark-mode') == 1 ) :
                echo 'dark';
            endif;
        ?>"
        style="background-color:<?php the_field('block-color')?>;">
        <!-- IMAGE LIST HORIZONTAL-->
        <div class="model-sections-list">
            <div class="model-sections-list-top">
                <div class="model-sections-title model-sections-list-top-title">
                    <span class="model-sections-title-sub">
                        <?php the_field('horizontal-list-sub-title')?>
                    </span>
                    <div class="model-sections-title-header">
                        <?php the_field('horizontal-list-title')?>
                    </div>
                </div>
                <?php if(get_field('horizontal-list-description')) { ?>
                <div class="model-sections-desc model-sections-list-top-desc">
                    <p class="model-sections-desc-text">
                        <?php the_field('horizontal-list-description');?>
                    </p>
                </div>
                <?php } ?>
                <!-- LIST BLOCK-->
                <div class="model-sections-list-top-items list-items"> <!-- REQUIRED CLASS LIST-ITEMS-->
                    <ul class="model-sections-list-top-items-inner">
                        <!-- LIST ITEMS -->
                        <?php
                        while( have_rows('horizontal-list-items') ) : the_row();?>
                            <li class="">
                                <a href="#">
                                    <?php the_sub_field('horizontal-list-items-description');?>
                                </a>
                            </li>
                        <?php
                        endwhile;
                        ?>
                    </ul>
                </div>
                <div class="model-sections-list-fullimage model-sections-list-parent"> <!-- REQUIRED CLASS MODEL-SECTIONS-LIST-PARENT-->
                    <?php while( have_rows('horizontal-list-items') ) : the_row();?>
                        <div class="model-sections-list-fullimage-item">
                            <img class="image-full" src="<?php the_sub_field('horizontal-list-items-image');?>" alt="full-image">
                            <span class="model-sections-list-fullimage-excerpt">
                            <?php the_sub_field('horizontal-list-items-image-desc');?>
                            </span>
                        </div>
                    <?php endwhile;?>                
                </div>
            </div>                             
        </div>
    </div>
</div>