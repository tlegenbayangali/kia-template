import $ from 'jquery';
import Swiper from 'swiper/bundle';

window.jQuery = $;

if ($('.offers-slider').length) {
    // eslint-disable-next-line no-unused-vars
    const offerSliderThumbs = new Swiper('.models-sm-container.offers-slider', {
        'slidesPerView': 'auto',
        'spaceBetween': 40,
        'navigation': {
            'nextEl': '.models-sm-container .arrow-next',
            'prevEl': '.models-sm-container .arrow-prev',
        },
    });

    // eslint-disable-next-line no-unused-vars
    const offerSlider = new Swiper('.models-lg-container.offers-slider', {
        'slidesPerView': 1,
        'spaceBetween': 100,
        'thumbs': {
            'swiper': offerSliderThumbs,
        },
        'allowTouchMove': false,
        'autoHeight': true,
        'effect': 'fade',
        'fadeEffect': {
            'crossFade': true,
        },
    });
}
