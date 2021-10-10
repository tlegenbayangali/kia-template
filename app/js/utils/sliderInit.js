import jQuery from 'jquery';
import Swiper from 'swiper/bundle';
import getRandomInt from './getRandomInt';

// eslint-disable-next-line no-unused-vars
jQuery(($) => {
    let screenHeight = null;

    function setScreenHeight() {
        screenHeight = $(window).height();
    }

    setScreenHeight();

    $(window).on('resize', setScreenHeight);

    // HERO SLIDER
    // eslint-disable-next-line no-unused-vars
    const swiperHero = new Swiper('.hero-slider-container', {
        'autoplay': {
            'delay': 5000,
        },
        'navigation': {
            'nextEl': '.arrow-next',
            'prevEl': '.arrow-prev',
        },
        'pagination': {
            'el': '.swiper-pagination',
            'type': 'bullets',
        },
    });

    function initModelsSlider(arr = []) {
        const sections = $('.dalacode-slider');

        for (const section of sections) {
            const sectionId = `dalacode_section_${getRandomInt()}`;
            const instanceObject = {};

            $(section).attr('id', sectionId);

            instanceObject.id = sectionId;
            instanceObject.swiperInstance = new Swiper(`#${sectionId}`, {
                'slidesPerView': 'auto',
                'spaceBetween': 40,
                'navigation': {
                    'nextEl': '.arrow-next',
                    'prevEl': '.arrow-prev',
                },
            });

            arr.push(instanceObject);
        }

        return arr;
    }

    const sectionInits = initModelsSlider();

    // DALACODE SELECTOR
    const dalacodeSelector = $('.dalacode-selector');

    for (const selector of dalacodeSelector) {
        const currentOption = $(selector).find('.current span');
        // const selectorInput = $(selector).find('input');
        const firstOption = $.trim($(selector).find('ul li:first-child').text());
        // const dataContainer = $(selector).attr('data-container');
        // const models = $(selector).parents('.section').find(`.${dataContainer} .model`);

        // const titles = $(selector).parents('.section').find(`.${dataContainer} .model .title a span`);
        // const titlesList = [];

        // if (titles.length) {
        //     for (const title of titles) {
        //         if (!titlesList.includes($(title).text())) {
        //             titlesList.push($(title).text());
        //         }
        //     }
        // }

        // for (const [i, modelTitle] of titlesList.entries()) {
        //     $(models[i]).attr('data-option', convertToSlug(modelTitle));
        // }

        // for (const option of titlesList) {
        //     const optionItem = document.createElement('li');
        //     optionItem.innerText = option;
        //     optionItem.setAttribute('data-option', convertToSlug(option));

        //     $(selector).find('.options ul')[0].appendChild(optionItem);
        // }

        // $(selectorInput).val(firstOption);
        $(currentOption).text(firstOption);
    }

    $(dalacodeSelector).on('click', function dalacodeSelectorTooltip(e) {
        const $this = this;
        const optionsContainer = $(this).find('.options');
        const optionsContainerHeight = $(this).find('.options').height();

        if (($this.getBoundingClientRect().bottom + optionsContainerHeight + 10) >= screenHeight) {
            $(optionsContainer).css({
                'top': 'unset',
                'bottom': 'calc(100% + 10px)',
            });
        } else {
            $(optionsContainer).css({
                'top': 'calc(100% + 10px)',
                'bottom': 'unset',
            });
        }

        if ($(this).hasClass('opened')) {
            $(this).removeClass('opened');
        } else {
            $(this).addClass('opened');
        }

        e.stopPropagation();
    });

    const selectorOptions = $('.dalacode-selector ul li');

    $(selectorOptions).on('click', function filterCars() {
        $(this).parents('.dalacode-selector').find('.current span').text($.trim($(this).text()));
        // $(selectorInput).val(translit($.trim($(option).text())));

        const models = $(this).parents('.section').find('.model');
        const currentSlug = $(this).attr('data-option');
        const sectionId = $(this).parents('.models').find('.dalacode-slider').attr('id');

        if ($(this).attr('data-option') === 'all') {
            for (const model of models) {
                $(model).addClass('d-flex');
                $(model).removeClass('d-none');
            }
        } else {
            for (const model of models) {
                if ($(model).attr('data-option') === currentSlug) {
                    $(model).addClass('d-flex');
                    $(model).removeClass('d-none');
                } else {
                    $(model).addClass('d-none');
                    $(model).removeClass('d-flex');
                }
            }
        }

        for (const section of sectionInits) {
            if (section.id === sectionId) {
                section.swiperInstance.update();
            }
        }
    });
});
