<?php
get_header();
?>
<?php get_template_part('template-parts/breadcrumbs'); ?>

<?php if (get_field('forma_test-drajva', 'options')) : ?>
    <?php if (!isset($_POST['selected_model'])) : ?>
        <?php get_template_part('template-parts/test-drive', 'selector'); ?>
    <?php else : ?>
        <?php get_template_part('template-parts/test-drive', 'form'); ?>
    <?php endif; ?>
<?php else : ?>
    <?php get_template_part('template-parts/test-drive-new-form', 'form'); ?>
<?php endif; ?>


<?php get_footer(); ?>