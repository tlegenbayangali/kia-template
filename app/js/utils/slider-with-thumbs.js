import $ from 'jquery';
import Swiper from 'swiper';

window.jQuery = $;

if ($('.slider-with-thumbs').length) {
    const sliderWithThumbsSmall = new Swiper('.slider-with-thumbs.small', {
        'slidesPerView': 5,
    });
    // eslint-disable-next-line no-unused-vars
    const sliderWithThumbsLarge = new Swiper('.slider-with-thumbs.large', {
        'slidesPerView': 1,
        'thumbs': {
            'swiper': sliderWithThumbsSmall,
        },
        'navigation': {
            'nextEl': '.slider-with-thumbs .swiper-button-next',
            'prevEl': '.slider-with-thumbs .swiper-button-prev',
        },
    });
}
