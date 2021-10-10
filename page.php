<?php get_header(); ?>
<div class="page">
    <div class="page-cover d-flex flex-column justify-content-between pb-20" style="background: url(<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>) no-repeat center/cover">
        <div class="top">
            <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
            <div class="container-fluid">
                <div class="row mt-20">
                    <div class="col-lg-8">
                        <div class="post-title">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
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
            </div>
        </div>
    </div>
    <section class="pt-60 pb-60">
        <div class="container-fluid">
            <div class="row justify-content-center">
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