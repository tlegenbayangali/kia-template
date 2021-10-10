import $ from 'jquery';
import {
    hasIntersections,
    toCurrency,
    toInt,
    findMinPrice,
    findCommonMaxPrice,
} from './index';

window.jQuery = $;

function activeBtnHandler(activeBtn) {
    // eslint-disable-next-line no-use-before-define
    parameterItem.each(function isSingleItem(idx, item) {
        const currentItem = $(item);
        if (hasIntersections(currentItem, activeBtn)) {
            $(item).removeClass('disabled');
        } else {
            $(item).removeClass('active');
            $(item).addClass('disabled');
        }
    });
    // eslint-disable-next-line no-use-before-define
    transmissionBtns.not('.disabled').eq(0).addClass('active');
    // eslint-disable-next-line no-use-before-define
    dwBtns.not('.disabled').eq(0).addClass('active');
}

/* ------------------------------ Consts Block ------------------------------ */
const engineBtns = $('#engine .parameter-item');
const transmissionBtns = $('#transmission .parameter-item');
const dwBtns = $('#dw .parameter-item');
let parameterItem = $('#transmission .parameter-item, #dw .parameter-item');
/* ----------------- Set 'active' class to first engine btn ----------------- */
engineBtns.eq(0).addClass('active');
let activeEngineBtn = $('#engine .parameter-item.active');
let activeTransmissionBtn;
let activeDwBtn;
/* ----------------- Fields ----------------- */
const priceField = $('#price-field');
const engineField = $('#engine-field');
const transmissionField = $('#transmission-field');
const dwField = $('#dw-field');

function activeBtnToSession() {
    activeEngineBtn = $('#engine .parameter-item.active');
    activeTransmissionBtn = $('#transmission .parameter-item.active');
    activeDwBtn = $('#dw .parameter-item.active');

    const activeEngineValue = $.trim(activeEngineBtn.find('.span-title').text());
    const activeTransmissionValue = $.trim(activeTransmissionBtn.find('.span-title').text());
    const activeDwValue = $.trim(activeDwBtn.find('.span-title').text());

    const activeEnginePrices = findMinPrice(activeEngineBtn);
    const activeTransmissionPrices = findMinPrice(activeTransmissionBtn);
    const activeDwPrices = findMinPrice(activeDwBtn);
    const commonMaxPrice = toCurrency(findCommonMaxPrice([
        toInt(activeEnginePrices),
        toInt(activeTransmissionPrices),
        toInt(activeDwPrices),
    ]));

    sessionStorage.clear();
    sessionStorage.setItem('price', commonMaxPrice);
    sessionStorage.setItem('engine', activeEngineValue);
    sessionStorage.setItem('transmission', activeTransmissionValue);
    sessionStorage.setItem('dw', activeDwValue);

    priceField.text(sessionStorage.getItem('price'));
    engineField.text(sessionStorage.getItem('engine'));
    transmissionField.text(sessionStorage.getItem('transmission'));
    dwField.text(sessionStorage.getItem('dw'));
}

/* --------------------------- Checking if step-2 --------------------------- */
if ($('.step-2').length) {
    activeBtnHandler(activeEngineBtn);
    /* -------------------------------- Page Init ------------------------------- */
    transmissionBtns.not('.disabled').eq(0).addClass('active');
    dwBtns.not('.disabled').eq(0).addClass('active');
    /* -------------------------------- Page Init ------------------------------- */

    /* -------- Add class 'active' to parameter buttons on init document -------- */
    engineBtns.on('click', function engineBtnsHandler() {
        $(this).addClass('active').siblings().removeClass('active');
        activeBtnHandler($(this));
        activeBtnToSession();
        transmissionBtns.not('.disabled').eq(0).siblings().removeClass('active');
        transmissionBtns.not('.disabled').eq(0).addClass('active');
    });

    parameterItem.on('click', function parameterItemHandler() {
        $(this).addClass('active').siblings().removeClass('active');
        activeBtnToSession();
    });
    /* -------- Add class 'active' to parameter buttons on init document -------- */

    /* -------- Init click trigger -------- */
    engineBtns.eq(0).trigger('click');
    /* -------- Init click trigger -------- */
}
/* --------------------------- Checking if step-2 --------------------------- */
