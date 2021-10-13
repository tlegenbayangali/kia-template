<?php
/*
Template Name: Запись на сервис
*/
get_header()
?>
<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="fz-35">
                Запись на сервис
            </h1>
        </div>
    </div>
</div>
<hr>
<div class="pb-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 callback-col">
                <div class="callback-form service-book">
                    <?= do_shortcode( '[contact-form-7 id="3477" title="Запись на сервис"]' ) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
get_footer();