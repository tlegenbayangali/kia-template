import $ from 'jquery';
import Swiper from 'swiper/bundle';

window.jQuery = $;
/**
* TEST DRIVE APPLICATION HANDLER
*/
if ($('#test-drive-app').length) {
    console.log('test-drive');
    const testDriveForm = $('#test-drive');

    testDriveForm.on('submit', function testDriveFormHandler() {
        const selectedModel = $('.models-lg-container .swiper-slide-active').attr('data-hash');
        $(this).find('input[name="selected_model"]').val(selectedModel);
    });

    const swiperLargeThumbs = new Swiper('.models-sm-container', {
        'slidesPerView': 'auto',
        'spaceBetween': 40,
        'navigation': {
            'nextEl': '.arrow-next',
            'prevEl': '.arrow-prev',
        },
    });

    // eslint-disable-next-line no-unused-vars
    const swiperLarge = new Swiper('.models-lg-container', {
        'navigation': {
            'nextEl': '.arrow-next',
            'prevEl': '.arrow-prev',
        },
        'slidesPerView': 1,
        'spaceBetween': 100,
        'thumbs': {
            'swiper': swiperLargeThumbs,
        },
        'hashNavigation': {
            'replaceState': true,
        },
    });
}

if ($('.test-drive-form').length) {
    const modelName = $.trim($('.model-info-title').text());
    const modelInput = $('#hidden-input-model');

    $('form').on('submit', function formHandler() {
        modelInput.val(modelName);
    });
}


// Sagyndyk select

let selectFormFirstOptions = document.querySelectorAll('select.first-disabled')

if (selectFormFirstOptions) {
    selectFormFirstOptions.forEach(item => {
        item.options[0].setAttribute('disabled', 'disabled')
        item.options[0].setAttribute('selected', 'selected')
    })
}


// Test drive new form validation
let inputs = document.querySelectorAll('.test-drive-field input')
let btn = document.querySelector('#btn-test-drive')

if (inputs && btn) {
    btn.addEventListener('click', (e)  => {
        e.preventDefault()
    
        inputs.forEach(item => {
            if (item.value.length <= 3 || item.value == '') {
                item.style.border = '1px solid #BF0C0D'
            } else {
                item.style.border = '1px solid #5D7D2B'
            }
        })
        selectFormFirstOptions.forEach(item => {
            if (item.options[0].value == 'Выбрать') {
                item.style.border = '1px solid #BF0C0D'
            } else {
                item.style.border = '1px solid #5D7D2B'
            }
        })
    })
}
