import $ from 'jquery';

window.jQuery = $;

if ($('.config-result').length) {
    const currentPrice = $('.current-price');
    const complectationName = $('.title-complectation');

    const img = $('#result-img');
    const exteriorResult = $('#exterior-result span.color-list-item');
    const interiorResult = $('#interior-result span.color-list-item');
    const exteriorColorName = $('#exterior-result .color-item-name');
    const interiorColorName = $('#interior-result .color-item-name');

    currentPrice.text(`${sessionStorage.getItem('price')} ₸`);
    complectationName.text(sessionStorage.getItem('complectation'));

    img.attr('src', sessionStorage.getItem('color-img'));
    exteriorResult.css('background', sessionStorage.getItem('color-hex'));
    interiorResult.css('background', sessionStorage.getItem('color-hex-interior'));
    exteriorColorName.text(sessionStorage.getItem('color-name'));
    interiorColorName.text(sessionStorage.getItem('color-name-interior'));

    const engineField = $('#result-engine');
    const engineTransmission = $('#result-transmission');
    const engineDW = $('#result-dw');

    engineField.text(sessionStorage.getItem('engine'));
    engineTransmission.text(sessionStorage.getItem('transmission'));
    engineDW.text(sessionStorage.getItem('dw'));

    const formModel = $('#hidden-input-model');
    const formPrice = $('#hidden-input-price');
    const formComplectation = $('#hidden-input-complectation');
    const formEngine = $('#hidden-input-engine');
    const formTransmission = $('#hidden-input-transmission');
    const formDW = $('#hidden-input-dw');
    const formInterior = $('#hidden-input-interior');
    const formExterior = $('#hidden-input-exterior');
    const resultForm = $('#result-form');

    $('form').on('submit', function formHandler() {
        resultForm.text(`Забронировать автомобиль ${$('.config-result .model-title').text()} ${sessionStorage.getItem('engine')}`);
        formModel.val($('.config-result .model-title').text());
        formPrice.val(`от ${sessionStorage.getItem('price')}₸`);
        formComplectation.val(sessionStorage.getItem('complectation-name'));
        formEngine.val(sessionStorage.getItem('engine'));
        formTransmission.val(sessionStorage.getItem('transmission'));
        formDW.val(sessionStorage.getItem('dw'));
        formInterior.val(sessionStorage.getItem('color-name-interior'));
        formExterior.val(sessionStorage.getItem('color-name'));
    });
}
