<?php 
get_header();
?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<?php if (!isset($_POST['selected_model'])) : ?>
<?php get_template_part( 'template-parts/test-drive', 'selector' ); ?>
<?php else: ?>
<?php get_template_part( 'template-parts/test-drive', 'form' ); ?>
<?php endif; ?>

<?php get_footer(); ?>