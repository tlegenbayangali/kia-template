<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package kia
 */

?>

<!--Footer Section-->
<footer class="footer section pt-80 pb-80" id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-logo d-flex align-items-center">
                    <svg class="left-icon d-block f-light">
                        <use xlink:href="<?php
                        echo get_template_directory_uri(); ?>/dist/images/dist/sprite.svg#kia-logo-new"></use>
                    </svg>
                    <span class="divider divider-md"></span>
                    <span class="footer-title"><?php
                        the_field('site_name', 'options'); ?></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-menu">
                    <div class="footer-block lg">
                        <?php
                        wp_nav_menu(
                            [
                                'theme_location' => 'footer-menu-1',
                                'container'      => false,
                                'menu_class'     => 'footer-menu-item'
                            ]
                        );
                        ?>
                    </div>
                    <div class="footer-block">
                        <div class="footer-block-heading">
                            Авто
                        </div>
                        <?php
                        wp_nav_menu(
                            [
                                'theme_location' => 'footer-menu-2',
                                'container'      => false,
                                'menu_class'     => 'footer-menu-item'
                            ]
                        );
                        ?>
                    </div>
                    <div class="footer-block">
                        <div class="footer-block-heading">
                            Покупателям
                        </div>
                        <?php
                        wp_nav_menu(
                            [
                                'theme_location' => 'footer-menu-3',
                                'container'      => false,
                                'menu_class'     => 'footer-menu-item'
                            ]
                        );
                        ?>
                    </div>
                    <div class="footer-block">
                        <div class="footer-block-heading">
                            Владельцам
                        </div>
                        <?php
                        wp_nav_menu(
                            [
                                'theme_location' => 'footer-menu-4',
                                'container'      => false,
                                'menu_class'     => 'footer-menu-item'
                            ]
                        );
                        ?>
                    </div>
                    <div class="footer-block right-block">
                        <ul>
                            <li>
                                <?php
                                the_field('address', 'options') ?>
                            </li>
                            <?php
                            $phone = get_field('dealer_info', 'options')[ 'dealer_phones' ][ 0 ];
                            ?>
                            <li>
                                <a href="tel:<?= cleanPhone($phone) ?>" class="active">
                                    <?= $phone ?>>
                                </a>
                            </li>
                            <?php
                            if (have_rows('socials', 'options')) : ?>
                                <li>
                                    <span>
                                        Мы в социальных сетях
                                    </span>
                                    <div class="footer-social">
                                        <?php
                                        while (have_rows('socials', 'options')) : the_row();
                                            $sub_value = get_sub_field('social_item'); ?>
                                            <a href="<?php
                                            echo esc_attr($sub_value[ 'link' ]) ?>" class="mr-2">
                                                <svg class="inline-svg-icon">
                                                    <use xlink:href="<?php
                                                    echo get_template_directory_uri(); ?>/dist/images/dist/sprite.svg#<?php
                                                    echo esc_attr($sub_value[ 'icon' ]) ?>"></use>
                                                </svg>
                                            </a>
                                        <?php
                                        endwhile; ?>
                                    </div>
                                </li>
                            <?php
                            endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-info d-flex align-items-center">
                    <div class="footer-text col-lg-9">
                        <p>
                            © <?= date('Y') ?> <?= get_field('footer_copyrights', 'options') ?>
                        </p>
                    </div>
                    <div class="footer-btn d-flex justify-content-center align-items-center col-lg-3">
                        <div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
                            <a href="<?= get_site_url() ?>/callback/" class="btn btn-black btn-lg">
                                Обратная связь
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div><!-- #page -->
<div class="cookies-wrapper">
    <div class="cookies d-flex flex-column align-items-start">
        <div class="cookies-agreement mb-30">
            Этот сайт использует файлы cookies и сервисы сбора технических данных посетителей (данные об IP-адресе, местоположении и др.) для обеспечения работоспособности и улучшения качества обслуживания. Продолжая использовать наш сайт, вы автоматически соглашаетесь с использованием данных технологий.
        </div>
        <div class="btn-wrapper btn-wrapper-lg btn-wrapper-black">
            <a href="#" class="btn">
                Согласиться
            </a>
        </div>
    </div>
</div>
<?php
$scripts = get_field('footer_scripts_connection', 'options');
if ($scripts) :
    foreach ($scripts as $script) :
        ?>
        <?= $script[ 'script' ] ?>
    <?php
    endforeach; ?>
<?php
endif; ?>
<?php
wp_footer(); ?>

<!-- Widgets by dalacode.kz -->
<?php
$whatsapp = get_field('widget_whatsapp', 'options');
$widget_phone = get_field('widget_phone', 'options');
?>

<?php
if ($whatsapp || $widget_phone) : ?>
    <div class="widget-group">
        <?php
        if ($widget_phone) : ?>
            <a href="tel:<?= $widget_phone ?>" class="widget widget-phone">
                <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 0 24 24" width="36px">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M6.54 5c.06.89.21 1.76.45 2.59l-1.2 1.2c-.41-1.2-.67-2.47-.76-3.79h1.51m9.86 12.02c.85.24 1.72.39 2.6.45v1.49c-1.32-.09-2.59-.35-3.8-.75l1.2-1.19M7.5 3H4c-.55 0-1 .45-1 1 0 9.39 7.61 17 17 17 .55 0 1-.45 1-1v-3.49c0-.55-.45-1-1-1-1.24 0-2.45-.2-3.57-.57-.1-.04-.21-.05-.31-.05-.26 0-.51.1-.71.29l-2.2 2.2c-2.83-1.45-5.15-3.76-6.59-6.59l2.2-2.2c.28-.28.36-.67.25-1.02C8.7 6.45 8.5 5.25 8.5 4c0-.55-.45-1-1-1z"/>
                </svg>
            </a>
        <?php
        endif; ?>

        <?php
        if ($whatsapp && $whatsapp[ 'is_active' ]) : ?>
            <a href="https://wa.me/<?= $whatsapp[ 'phone_number' ] ?>" class="widget widget-whatsapp">
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="36px" viewBox="0 0 24 24" width="36px">
                    <path d="M19.05,4.91C17.18,3.03,14.69,2,12.04,2c-5.46,0-9.91,4.45-9.91,9.91c0,1.75,0.46,3.45,1.32,4.95L2.05,22l5.25-1.38 c1.45,0.79,3.08,1.21,4.74,1.21h0c0,0,0,0,0,0c5.46,0,9.91-4.45,9.91-9.91C21.95,9.27,20.92,6.78,19.05,4.91z M12.04,20.15 L12.04,20.15c-1.48,0-2.93-0.4-4.2-1.15l-0.3-0.18l-3.12,0.82l0.83-3.04l-0.2-0.31c-0.82-1.31-1.26-2.83-1.26-4.38 c0-4.54,3.7-8.24,8.24-8.24c2.2,0,4.27,0.86,5.82,2.42c1.56,1.56,2.41,3.63,2.41,5.83C20.28,16.46,16.58,20.15,12.04,20.15z M16.56,13.99c-0.25-0.12-1.47-0.72-1.69-0.81c-0.23-0.08-0.39-0.12-0.56,0.12c-0.17,0.25-0.64,0.81-0.78,0.97 c-0.14,0.17-0.29,0.19-0.54,0.06c-0.25-0.12-1.05-0.39-1.99-1.23c-0.74-0.66-1.23-1.47-1.38-1.72c-0.14-0.25-0.02-0.38,0.11-0.51 c0.11-0.11,0.25-0.29,0.37-0.43c0.12-0.14,0.17-0.25,0.25-0.41c0.08-0.17,0.04-0.31-0.02-0.43c-0.06-0.12-0.56-1.34-0.76-1.84 c-0.2-0.48-0.41-0.42-0.56-0.43C8.86,7.33,8.7,7.33,8.53,7.33c-0.17,0-0.43,0.06-0.66,0.31C7.65,7.89,7.01,8.49,7.01,9.71 c0,1.22,0.89,2.4,1.01,2.56c0.12,0.17,1.75,2.67,4.23,3.74c0.59,0.26,1.05,0.41,1.41,0.52c0.59,0.19,1.13,0.16,1.56,0.1 c0.48-0.07,1.47-0.6,1.67-1.18c0.21-0.58,0.21-1.07,0.14-1.18S16.81,14.11,16.56,13.99z"/>
                </svg>
            </a>
        <?php
        endif; ?>
    </div>
<?php
endif; ?>
<!-- Widgets by dalacode.kz -->
</body>

</html>