<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package kia
 */

get_header(); ?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<section class="offers pb-60" id="offers">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1><?php the_archive_title(); ?></h1>
			</div>
		</div>
		<div class="row mt-60 grid-30">
		<?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				* Include the Post-Type-specific template for the content.
				* If you want to override this in a child theme, then include a file
				* called content-___.php (where ___ is the Post Type name) and that will be used instead.
				*/
				get_template_part( 'template-parts/content' );

			endwhile;

			else :

			get_template_part( 'template-parts/content', 'none' );

			endif;
			?>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<?php the_posts_pagination([
					'end_size' => 1,
					'mid_size' => 1,
				]); ?>
			</div>
		</div>
		<?php wp_reset_query(); ?>
	</div>
</section>
	
<?php get_footer();
