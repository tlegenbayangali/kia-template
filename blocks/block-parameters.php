<?php
    $id = 'parameters-list-' . $block['id'];
?>
<div class="model-sections" id="<?php echo $id;?>">
    <div class="model-sections-inner  
        <?php if( get_field('dark-mode') == 1 ) :
                echo 'dark';
            endif;
        ?>"
        style="background-color:<?php the_field('block-color')?>;">
        <div class="model-sections-list"> <!-- REQUIRED CLASS LIST -->
            <!-- PARAMETERS LIST BLOCK-->
            <div class="model-sections-list-parameters model-sections-list-parent"><!-- REQUIRED CLASS LIST PARENT -->

                <?php while( have_rows('parameters-list-items') ) : the_row(); ?>
            
                    <div class="model-sections-list-parameters-item">
                        <!-- INNER VALUE BLOCK-->
                        <?php while( have_rows('parameters-list-items-val') ) : the_row();?>
                        <div class="model-sections-list-parameters-val-block">
                            <span class="model-sections-list-parameters-val">
                                <strong>
                                    <?php the_sub_field('parameters-list-items-val-val');?>
                                </strong>
                                <?php the_sub_field('unit');?>
                            </span>
                            <div class="model-sections-list-parameters-text">
                                <?php the_sub_field('parameters-list-items-val-desc');?>
                            </div>
                        </div>
                        <?php endwhile;?>

                    </div> <!-- 1-->

            <?php endwhile;?> 
            </div>
            <div class="model-sections-list-right">
                <div class="model-sections-title">
                    <span class="model-sections-title-sub">
                        <?php the_field('parameters-list-sub-title')?>
                    </span>
                    <div class="model-sections-title-header">
                        <?php the_field('parameters-list-title')?>
                    </div>
                </div>
                <?php if(get_field('parameters-list-description')) { ?>
                <div class="model-sections-desc">
                    <p class="model-sections-desc-text">
                        <?php the_field('parameters-list-description');?>
                    </p>
                    <!-- MORE BUTTON TO ANOTHER PAGE-->
                    <?php $link = get_field('parameters-list-link');
                    if ($link['parameters-list-link-select'] == 'yes') : ?>
                    <a href="<?php echo esc_url( $link['link']['link-link'] );?>" class="model-sections-desc-more underlined underlined-green">
                        <?php echo esc_html( $link['link']['link-text'] );?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php } ?>
                <div class="model-sections-list-items list-items"> <!-- REQUIRED CLASS LIST ITEMS -->
                    <ul class="model-sections-list-items-inner">
                        <!-- LIST ITEMS -->
                        <?php
                        while( have_rows('parameters-list-items') ) : the_row();?>
                            <li class="">
                                <a href="#">
                                    <?php the_sub_field('parameters-list-items-title');?>
                                </a>
                            </li>
                        <?php
                        endwhile;
                        ?>
                    </ul>
                </div>
                <!-- RIGHT LIST ENDS-->
            </div>
        </div>
    </div>
</div>