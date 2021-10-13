<?php get_header(); ?>
<div class="page">
    <section class="pb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumbs">
                        <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs();?>
                    </div>
                    <div class="post-title">
                        <h1>
                            <?php the_title(); ?>
                        </h1>
                    </div>
                    <div class="post-thumbnail mt-20">
                        <?= get_the_post_thumbnail( get_the_ID(), 'full' ) ?>
                    </div>
                </div>
            </div>
            <div class="row mt-20">
                <div class="col-lg-6">
                    <p>
                        <?= get_field('short_description', get_the_ID()) ?>
                    </p>
                </div>
            </div>
            <div class="row mt-20 justify-content-center">
                <div class="col-lg-7">
                    <article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
                        <?php the_content(); ?>
                    </article>
                </div>
            </div>
        </div>
    </section>
</div>
<?php get_footer(); ?>