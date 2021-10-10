import $ from 'jquery';

window.jQuery = $;

if ($('.credit.step-four').length) {
    const modelPrice = $('#model-price');

    modelPrice.text(`${sessionStorage.getItem('price')} ₸`);
}
