<?php
/*
Template Name: Заказать звонок
*/
get_header();
if (isset($_GET['current_model'])) {
    $model = new WP_Query([
        'post_type' => 'models',
        'post_parent' => 0,
        'name' => $_GET['current_model']
    ]);
    $current_model = $model->posts[0];
}
?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<div class="container mt-4 mt-lg-0 mb-30">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="fz-35">
                Обратный звонок
            </h1>
        </div>
    </div>
</div>
<?php if (isset($_GET['current_model'])) : ?>
    <?php get_template_part( 'template-parts/callback', 'model', [
        'current_model' => $current_model
    ] ); ?>
<?php else : ?>
<hr>
<div class="pb-60 pt-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7 callback-col">
                <div class="callback-form">
                    <h5 class="mb-2" id="result-form">Ваши контакты</h5>
                    <p>Поля, отмеченные *, обязательны для заполнения</p>
                    <?= do_shortcode( '[contact-form-7 id="3786" title="Форма заявки от определенной модели"]' ) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php 
get_footer();