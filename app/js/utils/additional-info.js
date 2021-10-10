import $ from 'jquery';

window.jQuery = $;

require('@fancyapps/fancybox');

const infoBtns = $('.info-additional.credit, .info-additional.conditions');

infoBtns.on('click', function infoBtnsHandler() {
    let content;
    let heading;
    if ($(this).hasClass('conditions')) {
        content = $.trim($(this).parents('.model').find('.model-conditions').text());
        heading = 'Условия формирования цены на авто';
    } else if ($(this).hasClass('credit')) {
        content = $.trim($(this).parents('.model').find('.model-credit').text());
        heading = 'Расчет кредита';
    }
    $.fancybox.open(`
    <div class="message">
        <h2 class="mb-20">${heading}</h2>
        <hr />
        <p>${content}</p>
    </div>
    `);
});
