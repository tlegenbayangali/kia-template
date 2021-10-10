import $ from 'jquery';

window.jQuery = $;

const colorpicker = $('.colorpicker');

if (colorpicker.length) {
    const colorpickerItem = $('.color-list-item');
    const colorpickerFirstItem = $('.color-list-item:first-child');
    const interiorColorName = $('#interior-color-name');
    colorpickerItem.on('click', function colorpickerItemHandler() {
        $(this).addClass('active').siblings().removeClass('active');
        if ($(this).attr('data-src')) {
            sessionStorage.setItem('color-name', $(this).attr('data-text'));
            sessionStorage.setItem('color-hex', $(this).attr('data-color'));
            sessionStorage.setItem('color-img', $(this).attr('data-src'));
        } else {
            sessionStorage.setItem('color-name-interior', $(this).attr('data-text'));
            sessionStorage.setItem('color-hex-interior', $(this).attr('data-color'));
            interiorColorName.text(sessionStorage.getItem('color-name-interior'));
        }
    });
    colorpickerFirstItem.trigger('click');

    const engineField = $('#engine-field');
    const transmissionField = $('#transmission-field');
    const dwField = $('#dw-field');
    const complectationNameField = $('#complectation-name');
    const complectationPriceField = $('#complectation-price');
    const priceField = $('#price-field');

    const complectationsSection = $('.complectations-section');

    engineField.text(sessionStorage.getItem('engine'));
    transmissionField.text(sessionStorage.getItem('transmission'));
    dwField.text(sessionStorage.getItem('dw'));
    priceField.text(sessionStorage.getItem('price'));
    complectationNameField.text(sessionStorage.getItem('complectation-name'));
    complectationPriceField.text(`${sessionStorage.getItem('price')} ₸`);
    priceField.text(sessionStorage.getItem('price'));
    complectationsSection.removeClass('d-none');
}
