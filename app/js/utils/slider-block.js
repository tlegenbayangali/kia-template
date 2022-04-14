import $ from 'jquery';
import Swiper from 'swiper/bundle';

window.jQuery = $;

if ($('.swiper-slider-block').length) {
    const swiperSportage = new Swiper('.swiper-slider-block', {
        slidesPerView: 1,
        autoHeight: true,
        autoplay: {
            delay: 5000,
        },
        navigation: {
            prevEl: ".swiper-button-slider-block-prev",
            nextEl: ".swiper-button-slider-block-next",
        },
        pagination: {
            el: '.swiper-pagination-slider-block',
            type: 'bullets',
            clickable: true,
        },

    });
}