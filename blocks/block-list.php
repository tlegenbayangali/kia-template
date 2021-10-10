<?php
    $id = 'vertical-list-' . $block['id'];
?>
<div class="model-sections" id="<?php echo $id;?>">
    <div class="model-sections-inner 
        <?php if( get_field('dark-mode') == 1 ) :
                echo 'dark';
            endif;
        ?>"
        style="background-color:<?php the_field('block-color')?>;">
        <div class="
            <?php
                if( get_field('list-blocks_location') == 1) :
                echo 'list-left';
                else : echo '';
                endif;
            ?>
            model-sections-list "> <!-- REQUIRED CLASS LIST -->
            <div class="model-sections-list-smallimage model-sections-list-parent"> <!-- REQUIRED CLASS LIST PARENT -->
                <?php while( have_rows('list-items') ) : the_row();?>
                    <div class="model-sections-list-smallimage-item">
                        <img src="<?php the_sub_field('list-items-image');?>" alt="small-image">
                        <span class="model-sections-list-smallimage-excerpt">
                            <?php the_sub_field('list-items-image-desc');?>
                        </span>
                    </div> <!-- 1-->
                <?php endwhile;?>              
            </div>
            <div class="model-sections-list-right">
                <div class="model-sections-title">
                    <span class="model-sections-title-sub">
                        <?php the_field('list-sub-title')?>
                    </span>
                    <div class="model-sections-title-header">
                        <?php the_field('list-title')?>
                    </div>
                </div>
                <?php if(get_field('list-description')) { ?>
                <div class="model-sections-desc">
                    <p class="model-sections-desc-text">
                        <?php the_field('list-description');?>
                    </p>
                </div>
                <?php } ?>
                <div class="model-sections-list-items list-items"> <!-- REQUIRED CLASS LIST ITEMS -->
                    <ul class="model-sections-list-items-inner">
                        <!-- LIST ITEMS -->
                        <?php
                        while( have_rows('list-items') ) : the_row();?>
                            <li class="">
                                <a href="#">
                                    <?php the_sub_field('list-items-description');?>
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
</div>