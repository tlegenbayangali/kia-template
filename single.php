<?php get_header(); ?>
<div class="page">
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7">
				<div class="row mt-20">
					<div class="col-lg-12">
						<div class="post-title">
							<h1>
								<?php the_title(); ?> 
							</h1>
						</div>
						<div class="post-image mt-20">
							<?php the_post_thumbnail( 'full' ); ?>
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
        <div class="container">
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