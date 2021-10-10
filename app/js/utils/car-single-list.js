import $ from 'jquery';
import Swiper from 'swiper/bundle';
import '@fancyapps/fancybox';

window.jQuery = $;

function changeablelist() {
    const liListItems = $('.list-items ul > li');

    const changeablelistItemsParent = $('.model-sections-list-parent');
    changeablelistItemsParent.children('div:nth-child(1)').addClass('show');
    $('.list-items ul').children('li:nth-child(1)').addClass('active');

    for (let i = 0; i < liListItems.length; i += 1) {
        const elem = liListItems[i];
        $(elem).on('click', function liListItemsHandler(e) {
            e.preventDefault();
            $(this).addClass('active');
            $(this).siblings().removeClass('active');
            const currentIndex = $(this).index();
            const currentImage = $(this).parents('.model-sections-list')
                .find(changeablelistItemsParent)
                .children()
                .eq(currentIndex);
            $(currentImage).addClass('show');
            $(currentImage).siblings().removeClass('show');
            e.stopPropagation();
        });
    }
}
if ($('.model-sections-list').length) {
    changeablelist();
    // SWIPER JS FOR VIDEO SECTION
    const swiperVideo = new Swiper('.model-sections-video-swiper-container', {
        'slidesPerView': 'auto',
        'spaceBetween': 30,
        'navigation': {
            'nextEl': '.video-button-next',
            'prevEl': '.video-button-prev',
        },
    });
}
if ($('.model-sections-variations').length) {
    // SWIPER JS FOR VARIATIONS SECTION
    const swiperVariations = new Swiper('.model-sections-variations-container', {
        'slidesPerView': 'auto',
        'spaceBetween': 30,
        'navigation': {
            'nextEl': '.variations-button-next',
            'prevEl': '.variations-button-prev',
        },
    });
}
