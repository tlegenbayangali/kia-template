<?php
get_header();
?>
<?php
get_template_part('template-parts/breadcrumbs'); ?>

<?php
if (get_field('forma_test-drajva', 'options')) : ?>
    <?php
    if (!isset($_POST[ 'selected_model' ])) : ?>
        <?php
        get_template_part('template-parts/test-drive', 'selector'); ?>
    <?php
    else : ?>
        <?php
        get_template_part('template-parts/test-drive', 'form'); ?>
    <?php
    endif; ?>
<?php
else : ?>
    <div class="section section-divided pos-r test-drive-section">
        <div class="container">
            <div class="pt-40 pb-40">
                <h1 class="section-heading mb-4">Тест-драйв</h1>
                <h4>Где и когда Вам будет удобно пройти Тест–Драйв?</h4>
            </div>
            <?php
            if (get_field('form-maps', 'options')) : ?>
                <?= get_field('form-maps', 'options') ?>
            <?php
            endif; ?>
            <div class="col-xl-8 col-lg-12">
                <div class="content callback-col">
                    <div class="callback-form" style="margin: 0;">
                        <!-- <h5 class="mb-2">Записаться</h5>
                        <p>Поля, отмеченные *, обязательны для заполнения</p> -->
                        <?= do_shortcode('[contact-form-7 id="96" title="Тест-драйв"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
endif; ?>


<?php
get_footer(); ?>