<?php get_header();
    $parent_post = get_post($post->post_parent);
    get_template_part( 'template-parts/content', 'header-models', [ 'parent_post' => $parent_post, ] );
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumbs equip-breadcrumbs d-flex justify-content-between">
                <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs();?>
                <div class="equip-breadcrumbs-right d-flex align-items-md-center">
                    <div class="equip-breadcrumbs-right-call">
                        <a class="d-flex align-items-center underlined underlined-black" href="/callback">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" class="mr-1"
                                data-v-3802aeb3="">
                                <path
                                    d="M2.494 3.506l1.299-1.299a1 1 0 011.414 0l2.66 2.66A1 1 0 017.941 6.2l-.681.851c-.467.584-.583 1.388-.203 2.032 1.318 2.23 3.191 3.5 4.511 4.086.57.254 1.218.103 1.706-.287l1.027-.822a1 1 0 011.332.074l2.603 2.603a1 1 0 01-.056 1.467l-1.691 1.45c-.63.54-1.46.82-2.286.734-1.801-.19-4.602-.786-7.703-3.887-3.716-3.716-4.577-6.634-4.855-8.603-.125-.882.219-1.761.849-2.39zM11 5c1.333 0 4 .8 4 4M10 2c2.667 0 8 1.6 8 8"
                                    stroke="currentColor" stroke-width="1.5" data-v-3802aeb3="">
                                </path>
                            </svg>
                            Обратный звонок
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="offers pb-60" id="offers">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1>
                    <?php echo 'Акции и спецпредложения на автомобиль Kia '. esc_attr($parent_post->post_title);?>
				</h1>
			</div>
		</div>
        <?php
        $args = array(
            'posts_per_page' => '-1',
            'post_type' => 'offers-cars',
            'model' => $parent_post->post_name,
        );
        $query = new WP_Query($args);

        if ( $query->have_posts() ) : ?>

            <div class="row mt-60 grid-30">
            
                <?php
                while ( $query->have_posts() ) :

                $query->the_post(); ?>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="d-flex bg-lgray h-100-p w-100-p flex-column justify-content-between model">
                            <div class="offers-card">
                                <div class="img">
                                    <a href="<?= get_the_permalink() ?>">
                                        <?= get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                                    </a>
                                </div>
                                <div class="title">
                                    <div class="d-flex flex-column">
                                        <a href="<?= get_the_permalink() ?>">
                                            <span class="mr-2 underlined-black fz-15 fw-700">
                                                <?= get_the_title() ?>
                                            </span>
                                        </a>
                                        <p class="c-disabled mt-10">
                                            <?php 
                                                $period = get_field('period', get_the_ID());
                                                $date_start = $period['period_start'];
                                                $date_end = $period['period_end'];
                                            ?>
                                            <?php if ( $date_start && $date_end ) : ?>
                                                <?php if ( downcounter( $date_end, [ 'days' => true ] ) ) : ?>
                                                    <?php if (get_field('period', get_the_ID())) : ?>
                                                    <?= date_i18n( "j", strtotime( $date_start ) ); ?>-<?= date_i18n( "j F Y", strtotime( $date_end ) ); ?>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    Время истекло
                                                <?php endif; ?>
                                            <?php else: ?>
                                                Постоянная акция
                                            <?php endif; ?>
                                        </p>
                                        <p class="offers-desc">
                                            <?= get_field('short_description', get_the_ID()) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
        <?php else :
            get_template_part( 'template-parts/content', 'none' );
        endif; ?>
    </div>
</section>
<?php get_footer(); ?>