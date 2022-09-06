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
    <div class="section section-divided pos-r">
        <div class="container">
            <?php if (get_field('form-maps', 'options')) : ?>
                <?= get_field('form-maps', 'options') ?>
            <?php endif; ?>
            <div class="col-xl-8 col-lg-12">
                <div class="content callback-col pt-60 pb-60">
                    <div class="callback-form" style="margin: 0;">
                        <h5 class="mb-2">Записаться</h5>
                        <p>Поля, отмеченные *, обязательны для заполнения</p>
                        <?= do_shortcode('[contact-form-7 id="96" title="Тест-драйв"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php get_footer(); ?>