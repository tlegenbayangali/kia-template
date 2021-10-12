<?php
    $id = 'without-list-' . $block['id'];
?>
<div class="model-sections" id="<?php echo $id;?>">
    <div class="model-sections-inner  
        <?php if( get_field('dark-mode') == 1 ) :
                echo 'dark';
            endif;
        ?>"
        style="background-color:<?php the_field('block-color')?>;">
        <div class="model-sections-list">
            <div class="model-sections-list-smallimage">
                    <div class="model-sections-list-smallimage-item d-block">
                        <img src="<?php the_field('items-image');?>" alt="small-image">
                        <span class="model-sections-list-smallimage-excerpt">
                            <?php the_field('items-image-desc');?>
                        </span>
                    </div> <!-- 1-->             
            </div>
            <div class="model-sections-list-right">
                <div class="model-sections-title">
                    <span class="model-sections-title-sub">
                        <?php the_field('items-sub-title')?>
                    </span>
                    <h3 class="model-sections-title-header">
                        <?php the_field('items-title')?>
                    </h3>
                </div>
                <?php if(get_field('items-description')) { ?>
                <div class="model-sections-desc">
                    <p class="model-sections-desc-text">
                        <?php the_field('items-description');?>
                    </p>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>