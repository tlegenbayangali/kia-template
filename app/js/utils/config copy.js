/* eslint-disable no-use-before-define */
import $ from 'jquery';

window.jQuery = $;

const priceField = $('#price-field');
const engineField = $('#engine-field');
const transmissionField = $('#transmission-field');
const dwField = $('#dw-field');

if ($('button.parameter-item').length) {
    sessionStorage.clear();

    if (sessionStorage.getItem('price')) {
        priceField.text(sessionStorage.getItem('price'));
    }

    if (sessionStorage.getItem('engine')) {
        engineField.text(sessionStorage.getItem('engine'));
    }

    if (sessionStorage.getItem('transmission')) {
        transmissionField.text(sessionStorage.getItem('transmission'));
    }

    if (sessionStorage.getItem('dw')) {
        dwField.text(sessionStorage.getItem('dw'));
    }
    const parameterBtn = $('button.parameter-item');
    parameterBtn.each((idx, item) => {
        $(item).addClass('disabled');
    });

    const enginesBtn = $('#engine button.parameter-item');
    const transmissionBtn = $('#transmission button.parameter-item');
    const driveWheelsBtn = $('#drive-wheels button.parameter-item');

    enginesBtn.each((idx, item) => {
        if (idx === 0) {
            $(item).addClass('active');
            setTimeout(function clickImitHandler() {
                $(item).trigger('click');
            }, 0);
        }
        $(item).removeClass('disabled');
    });

    transmissionBtn.each((idx, item) => {
        if (idx === 0) {
            $(item).addClass('active');
            setTimeout(function clickImitHandler() {
                $(item).trigger('click');
            }, 0);
        }
        $(item).removeClass('disabled');
    });

    const activeEngine = $('#engine button.parameter-item.active');
    const activeTransmission = $('#transmission button.parameter-item.active');
    const activeDW = $('#drive-wheels button.parameter-item.active');

    const engineFieldContent = $.trim(activeEngine.text().replace(/\s+/g, ' '));
    const transmissionFieldContent = $.trim(activeTransmission.text().replace(/\s+/g, ' '));
    const driveWheelFieldContent = $.trim(activeDW.text().replace(/\s+/g, ' '));

    parameterBtn.each((idx, item) => {
        const activeBtn = JSON.parse($('#engine button.parameter-item.active').attr('data-id'));
        const currentItemAttr = JSON.parse($(item).attr('data-id'));
        const intersections = currentItemAttr.filter((x) => activeBtn.includes(x));
        if (intersections.length) {
            $(item).removeClass('disabled');
            $(item).parent().find('button.parameter-item:not(".disabled"):first-child').addClass('active');
        }
    });

    engineField.text(engineFieldContent);
    transmissionField.text(transmissionFieldContent);
    dwField.text(driveWheelFieldContent);

    enginesBtn.on('click', function enginesBtnHandler() {
        sessionStorage.setItem('engine', $.trim($(this).text().replace(/\s+/g, ' ')));
        transmissionBtn.each((idx, item) => {
            const activeBtn = JSON.parse($(this).attr('data-id'));
            const currentAttr = JSON.parse($(item).attr('data-id'));
            const intersections = currentAttr.filter((x) => activeBtn.includes(x));
            if (intersections.length) {
                $(item).addClass('active');
                $(item).removeClass('disabled');
                $(item).siblings().removeClass('active');
            } else {
                $(item).removeClass('active');
                $(item).addClass('disabled');
            }
        });
        driveWheelsBtn.each((idx, item) => {
            const activeBtn = JSON.parse($(this).attr('data-id'));
            const currentAttr = JSON.parse($(item).attr('data-id'));
            const intersections = currentAttr.filter((x) => activeBtn.includes(x));
            if (intersections.length) {
                $(item).addClass('active');
                $(item).removeClass('disabled');
                $(item).siblings().removeClass('active');
            } else {
                $(item).removeClass('active');
                $(item).addClass('disabled');
            }
        });

        engineField.text(sessionStorage.getItem('engine'));

        transmissionField.text(engineField.text(sessionStorage.getItem('transmission')));
        dwField.text(sessionStorage.getItem('dw'));

        priceField.text(findMinPrice($(this)));
        sessionStorage.setItem('price', findMinPrice($(this)));
    });

    transmissionBtn.on('click', function transmissionsBtnHandler() {
        sessionStorage.setItem('transmission', $.trim($(this).text().replace(/\s+/g, ' ')));

        transmissionField.text(sessionStorage.getItem('transmission'));
        priceField.text(findMinPrice($(this)));
        sessionStorage.setItem('price', findMinPrice($(this)));
    });

    driveWheelsBtn.on('click', function dwBtnHandler() {
        sessionStorage.setItem('dw', $.trim($(this).text().replace(/\s+/g, ' ')));

        dwField.text(sessionStorage.getItem('dw'));
    });

    parameterBtn.on('click', function parameterBtnHandler() {
        const $this = $(this);
        $this.addClass('active');
        $this.removeClass('disabled');
        $this.siblings().removeClass('active');
    });

    setTimeout(function clickImitHandler() {
        enginesBtn.eq(0).trigger('click');
        transmissionBtn.eq(0).trigger('click');
        driveWheelsBtn.eq(0).trigger('click');

        parameterBtn.each((idx, item) => {
            if (!$(item).siblings().length) {
                $(item).css({
                    'pointer-events': 'none',
                });
            }
        });
    }, 0);
}

function findMinPrice(ctx) {
    let minPrice;
    if (ctx.find('[data-price]').length > 1) {
        const dataPrices = ctx.find('[data-price]');
        const pricesToCompare = [];
        dataPrices.each((idx, item) => {
            const price = $(item).attr('data-price');
            const priceInNumber = price.split(' ').join('');
            pricesToCompare.push(+priceInNumber);
        });
        minPrice = Math.min(...pricesToCompare);
    } else {
        let price = ctx.find('[data-price]');
        price = price.attr('data-price');
        const priceInNumber = price.split(' ').join('');
        minPrice = +priceInNumber;
    }

    minPrice = minPrice.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1 ');
    return minPrice;
}
