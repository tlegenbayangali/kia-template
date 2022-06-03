<?php
$id = 'without-repeater-' . $block['id'];
?>
<div class="model-sections" id="<?php echo $id; ?>">
    <div class="model-sections-inner  
        <?php if (get_field('dark-mode') == 1) :
            echo 'dark';
        endif;
        ?>" style="background-color:<?php the_field('block-color') ?>;">
        <div class="model-sections-lists">
            <div class="model-sections-lists">
                <div class="model-sections-titles">
                    <span class="model-sections-title-sub">
                        <?php the_field('items-sub-title') ?>
                    </span>
                    <h3 class="model-sections-title-headers">
                        <?php the_field('items-title') ?>
                    </h3>
                    <?php if (have_rows('block_border_green')) : ?>
                        <ul class="model-sections-ul-list">
                            <?php while (have_rows('block_border_green')) : the_row();
                                $blockNumber = get_sub_field('block_border_green_number');
                                $blockTitle = get_sub_field('block_border_green_title');
                                $blockDescription = get_sub_field('block_border_green_description');
                            ?>
                                <li>
                                    <div class="model-sections-ul-list-left">
                                        <div class="model-sections-ul-list-left-number">
                                            <?php echo $blockNumber  ?>
                                        </div>
                                        <div class="model-sections-ul-list-left-title">
                                            <?php echo $blockTitle  ?>
                                        </div>
                                    </div>
                                    <p class="model-sections-ul-list-left">
                                        <?php echo $blockDescription  ?>
                                    </p>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>