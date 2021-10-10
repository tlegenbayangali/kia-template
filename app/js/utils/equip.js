import $ from 'jquery';
// IMPORT SWIPER JS
import Swiper from 'swiper/bundle';

window.jQuery = $;

let windowScroll;
let scrollPrev;
const headerHeight = $('.equip-header').outerHeight();
function middleHeaderFixed() {
    const closePoint = $('.equip-content-inner').outerHeight() + $('.equip-content-inner').offset().top
    - $('.equip-header').outerHeight();
    windowScroll = $(window).scrollTop();
    const headerOffset = $('.equip-header').offset().top;
    const headerParentOffset = $('.equip-wrapper').offset().top;
    if (windowScroll > scrollPrev) {
        if (windowScroll >= headerOffset - $('.header-model-wrapper').outerHeight()) {
            $('.equip-header').addClass('fixed');
            $('.equip-header').css('transform', `translateY(${$('.header-model-wrapper').outerHeight()}px)`);
            $('.equip-header-top-padding').css('height', `${headerHeight}px`);
        }
        if (windowScroll >= closePoint) {
            $('.equip-header').css('transform', `translateY(${$('.header-model-wrapper').outerHeight() - $('.equip-header').outerHeight()}px)`);
        }
    } else if (windowScroll < scrollPrev) {
        if (windowScroll < headerParentOffset - $('.header-model-wrapper').outerHeight()) {
            $('.equip-header').removeClass('fixed');
            $('.equip-header').css('transform', 'translateY(0)');
            $('.equip-header-top-padding').css('height', 'auto');
        }
    }
    scrollPrev = windowScroll;
}

// MAKE HEADER FIXED
if ($('.equip-header').length) {
    $(window).on('scroll', function windowScrollHandler() {
        middleHeaderFixed();
    });
    // eslint-disable-next-line no-unused-vars
    const swiperConfigItem = new Swiper('.equip-config-section-item-carousel-container', {
        'spaceBetween': 30,
        'slidesPerView': 'auto',
        'allowTouchMove': false,
        // 'navigation': {
        //     'nextEl': '.equip-variants-carousel-right-arrow',
        //     'prevEl': '.equip-variants-carousel-left-arrow',
        // },
        'speed': 300,
    });

    // SWIPER SLIDER -->>
    // EQUIP VARIANTS SLIDER
    // eslint-disable-next-line no-unused-vars
    const swiperEquipHeader = new Swiper('.equip-variants-container', {
        'slidesPerView': 'auto',
        'spaceBetween': 30,
        'allowTouchMove': false,
        'speed': 300,
        'controller': {
            'control': swiperConfigItem,
        },
        'navigation': {
            'nextEl': '.equip-variants-carousel-right-arrow',
            'prevEl': '.equip-variants-carousel-left-arrow',
        },
    });
    // EQUIP CONFIGURATION SECTION
    $('.equip-config-section-title').on('click', function configSectionTitleHandler() {
        $(this).parent().toggleClass('opened-item');
    });
}
