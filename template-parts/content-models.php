<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sample
 */

?>

<div class="hero-model" style="background: url(images/dist/cars-single/pecanto-hero.jpg) no-repeat center center /cover gray;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="hero-model-inner d-flex">
                    <div class="breadcrumbs">
                        <ul class="d-flex align-items-center">
                            <li>
                                <a class="underlined underlined-black" href="/">Главная</a>
                            </li>
                            <li>
                                <a class="underlined underlined-black" href="/">Модели</a>
                            </li>
                            <li>
                                <span>Picanto</span>
                            </li>
                        </ul>
                        <div class="hero-model-minprice">
                            <span>от 5 990 000 ₸</span>
                        </div>
                    </div>
                    <div class="hero-model-bottom d-flex">
                        <div class="hero-model-title">
                            <span class=""> Kia </span>
                            <div class="hero-model-title-name">
                                <img src="images/src/cars-single/logo/picanto-logo.svg" alt="model-name">
                            </div>
                            <div class="hero-model-title-sub">
                                Заряжен. Умен. Неотразим.                                
                            </div>
                        </div>
                        <div class="hero-model-desc">
                            <ul class="d-flex">
                                <li>
                                    <div class="hero-model-desc-item">
                                        <div class="hero-model-desc-item-icon">
                                            <img class="d-block" src="images/src/cars-single/hero-desc.svg" alt="description">
                                        </div>
                                        <div class="hero-model-desc-item-sub">
                                            Система бесключевого доступа Smart Key и запуск двигателя кнопкой
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="hero-model-desc-item">
                                        <div class="hero-model-desc-item-icon">
                                            <img class="d-block" src="images/src/cars-single/hero-desc-2.svg" alt="description">
                                        </div>
                                        <div class="hero-model-desc-item-sub">
                                            Система бесключевого доступа Smart Key и запуск двигателя кнопкой
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="hero-model-desc-item">
                                        <div class="hero-model-desc-item-icon">
                                            <img class="d-block" src="images/src/cars-single/hero-desc-3.svg" alt="description">
                                        </div>
                                        <div class="hero-model-desc-item-sub">
                                            Система бесключевого доступа Smart Key и запуск двигателя кнопкой
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="hero-model-padding"></div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <!-- <div class="model-sections"> -->
                <?php the_content(); ?>
            <!-- </div>  -->
            <!--MODEL SECTIONS CONTAINER-->
        </div> <!--ROW-->
    </div><!--FLUID CONTAINER-->
</div>
