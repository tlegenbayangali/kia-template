import $ from 'jquery';

window.jQuery = $;

if ($('.complectation-item').length) {
    // Filtering Items
    const complecationItems = $('.complectation-item');
    complecationItems.each((idx, item) => {
        const dataEngine = $(item).find('[data-engine]').attr('data-engine');
        const dataTransmission = $(item).find('[data-transmission]').attr('data-transmission');
        const dataDW = $(item).find('[data-dw]').attr('data-dw');

        if (!sessionStorage.getItem('engine').includes(dataEngine)) {
            $(item).remove();
        } else if (!sessionStorage.getItem('transmission').includes(dataTransmission)) {
            $(item).remove();
        } else if (!sessionStorage.getItem('dw').includes(dataDW)) {
            $(item).remove();
        }
    });

    const updatedItems = $('.complectation-item');
    const counter = $('.complections .counter');
    let counterValue;

    if (updatedItems.length === 1) {
        counterValue = `${updatedItems.length} комплектация`;
    } else if (updatedItems.length > 1 && updatedItems.length < 5) {
        counterValue = `${updatedItems.length} комплектации`;
    } else {
        counterValue = `${updatedItems.length} комплектаций`;
    }

    counter.text(counterValue);
    // Filtering Items

    // Handling Clicks
    updatedItems.on('click', function complecationItemsClickHandler() {
        const dataEngine = $(this).find('[data-engine]').attr('data-engine');
        const dataTransmission = $(this).find('[data-transmission]').attr('data-transmission');
        const dataDW = $(this).find('[data-dw]').attr('data-dw');
        const dataPrice = $(this).find('[data-price]').attr('data-price');

        sessionStorage.setItem('engine', dataEngine);
        sessionStorage.setItem('transmission', dataTransmission);
        sessionStorage.setItem('dw', dataDW);
        sessionStorage.setItem('price', dataPrice);
        sessionStorage.setItem('complectation-name', $.trim($(this).find('.title').text()));

        const engineField = $('#engine-field');
        const transmissionField = $('#transmission-field');
        const dwField = $('#dw-field');

        const complectationNameField = $('#complectation-name');
        const complectationPriceField = $('#complectation-price');
        const priceField = $('#price-field');
        complectationNameField.text(sessionStorage.getItem('complectation-name'));
        complectationPriceField.text(`${sessionStorage.getItem('price')} ₸`);
        priceField.text(sessionStorage.getItem('price'));

        const complectationsSection = $('.complectations-section');

        engineField.text(sessionStorage.getItem('engine'));
        transmissionField.text(sessionStorage.getItem('transmission'));
        dwField.text(sessionStorage.getItem('dw'));
        priceField.text(sessionStorage.getItem('price'));
        complectationsSection.removeClass('d-none');

        if (!$(this).hasClass('active')) {
            $(this).addClass('active');
        }
        $(this).siblings().removeClass('active');
    });
    updatedItems.eq(0).trigger('click');

    // Handling Clicks
}
