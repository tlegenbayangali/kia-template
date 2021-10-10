import $ from 'jquery';
import Swiper from 'swiper/bundle';
import {
    toCurrency,
    toInt,
    tengenator,
    getEveryMonthPayment,
} from './index';
import './dalacode-plusminus';

window.jQuery = $;

if ($('.credit.step-four').length) {
    const modelPrice = $('#model-price');
    const priceField = $('#price-field');
    const engineField = $('#engine-field');
    const transmissionField = $('#transmission-field');
    const dwField = $('#dw-field');
    const complectationsSection = $('.complectations-section');
    const complectationsName = $('#complectation-name');
    const complectationsPrice = $('#complectation-price');
    const parameterItems = $('.credit-offers-slide');

    const offerNameField = $('#offer-name');
    const benefitPriceField = $('#benefit-price-field');
    const totalPriceField = $('#total-price-field');
    const everyMonthField = $('#every-month-field');
    const everyMonth2Field = $('#every-month-2-field');
    const resultSection = $('#result-section');

    let offerMonths;
    let offerPercents;

    /* -------------------------------------------------------------------------- */
    /*                             Credit Params Aside                            */
    /* -------------------------------------------------------------------------- */
    const kiaFinanceWrapper = $('#kia-finance');
    const kiaFinanceDownPaymmentField = $('#kia-finance-down-payment-field');

    // If Trade In
    const tradeInCalc = $('#trade-in-calc');
    const tradeIn2Calc = $('#trade-in-2-calc');
    const kiaFinanceTradeInField = $('#kia-finance-trade-in-field');
    const kiaFinanceSurchargeField = $('#kia-finance-surcharge-field');
    const tradeInParam = $('.trade-in-param');
    const tradeIn = $('.trade-in');
    // Endif Trade In

    const kiaFinanceCreditSummField = $('#kia-finance-credit-summ-field');
    const kiaFinanceCreditTermsField = $('#kia-finance-credit-terms-field');
    const kiaFinanceCreditRateField = $('#kia-finance-credit-rate-field');
    /* -------------------------------------------------------------------------- */
    /*                             Credit Params Aside                            */
    /* -------------------------------------------------------------------------- */

    const downPaymentPercentage = $('#down-payment-percentage');
    const downPaymentPercentageCalc = $('#down-payment-percentage-calc');
    const surchargeCalc = $('#surcharge-calc');
    const creditSummCalc = $('#credit-summ-calc');

    modelPrice.text(`${sessionStorage.getItem('price')} ₸`);
    priceField.text(sessionStorage.getItem('price'));
    engineField.text(sessionStorage.getItem('engine'));
    transmissionField.text(sessionStorage.getItem('transmission'));
    dwField.text(sessionStorage.getItem('dw'));
    complectationsSection.removeClass('d-none');
    complectationsName.text(sessionStorage.getItem('complectation-name'));
    complectationsPrice.text(`${sessionStorage.getItem('price')} ₸`);
    resultSection.addClass('d-block').removeClass('d-none');

    kiaFinanceWrapper.addClass('d-block').removeClass('d-none');

    // eslint-disable-next-line no-unused-vars
    const creditOffersSlider = new Swiper('.credit-offers-slider .swiper-container', {
        'slidesPerView': 'auto',
        'spaceBetween': 5,
    });

    parameterItems.on('click', function parameterItemHandler() {
        const thisParameterItem = $(this);
        $(this)
            .find('.parameter-item')
            .addClass('active');
        $(this).siblings().each((idx, item) => {
            $(item)
                .find('.parameter-item')
                .removeClass('active');
        });

        const benefitPriceAttr = $(this).find('[data-benefit]');
        const offerNameAttr = $(this).find('[data-offer-name]');

        const plusminus = $('.plusminus');
        if ($(this).find('[data-terms]').length) {
            offerMonths = $(this).find('[data-terms]').attr('data-terms');
            offerPercents = $(this).find('[data-percents]').attr('data-percents');
            plusminus.dalacodePlusMinus('months', {
                'months': offerMonths,
                'percents': offerPercents,
            });
        } else {
            plusminus.dalacodePlusMinus('months', [12]);
        }

        downPaymentPercentage.text(tengenator(toCurrency($(this).find('[data-down-payment]').attr('data-down-payment'))));
        downPaymentPercentageCalc.on('change', function downPaymentPercentageCalcHandler() {
            const val = toInt($(this).val());
            const minVal = toInt(thisParameterItem.find(('[data-down-payment]')).attr('data-down-payment'));
            if (val < minVal) {
                $(this).val(toCurrency(minVal));
                sessionStorage.setItem('down-payment', toCurrency(minVal));
                if (minVal > toInt(tradeInCalc.val())) {
                    tradeIn.removeClass('border-green').addClass('border-black');
                    tradeIn.find('.success-message').addClass('d-none');
                    surchargeCalc.val(toCurrency(toInt(downPaymentPercentageCalc.val()) - toInt(tradeIn2Calc.val())));
                } else {
                    tradeIn.addClass('border-green').removeClass('border-black');
                    tradeIn.find('.success-message').removeClass('d-none');
                    surchargeCalc.val(0);
                }
            } else {
                $(this).val(toCurrency(val));
                sessionStorage.setItem('down-payment', toCurrency(val));
                if (val > toInt(tradeInCalc.val())) {
                    tradeIn.removeClass('border-green').addClass('border-black');
                    tradeIn.find('.success-message').addClass('d-none');
                    kiaFinanceSurchargeField.text(tengenator(toCurrency(toInt(downPaymentPercentageCalc.val()) - toInt(tradeIn2Calc.val()))));
                    kiaFinanceDownPaymmentField.text(toCurrency(val));
                    surchargeCalc.val(toCurrency(toInt(downPaymentPercentageCalc.val()) - toInt(tradeIn2Calc.val())));
                } else {
                    tradeIn.addClass('border-green').removeClass('border-black');
                    tradeIn.find('.success-message').removeClass('d-none');
                    surchargeCalc.val(0);
                }
            }
            everyMonthField.text(toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
            everyMonth2Field.text(toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
            sessionStorage.setItem('every-month', toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
        });

        if (benefitPriceAttr.length) {
            sessionStorage.setItem('benefit-price', benefitPriceAttr.attr('data-benefit'));
            sessionStorage.setItem('offer-name', offerNameAttr.attr('data-offer-name'));
            sessionStorage.setItem('total-price', toInt(sessionStorage.getItem('price')) - toInt(sessionStorage.getItem('benefit-price')));

            benefitPriceField.text(sessionStorage.getItem('benefit-price'));
            offerNameField.text(sessionStorage.getItem('offer-name'));
            totalPriceField.text(toCurrency(toInt(sessionStorage.getItem('price')) - toInt(sessionStorage.getItem('benefit-price'))));
            benefitPriceField.parents('.model-info-price').removeClass('d-none').addClass('d-flex');
            downPaymentPercentageCalc.val(toCurrency(toInt(sessionStorage.getItem('total-price')) / 2));
            sessionStorage.setItem('down-payment', toCurrency(toInt(sessionStorage.getItem('total-price')) / 2));
            kiaFinanceDownPaymmentField.text(tengenator(toCurrency(toInt(sessionStorage.getItem('total-price')) / 2)));
        } else {
            sessionStorage.removeItem('benefit-price');
            sessionStorage.setItem('total-price', toInt(sessionStorage.getItem('price')));

            totalPriceField.text(sessionStorage.getItem('price'));
            benefitPriceField.text('');
            benefitPriceField.parents('.model-info-price').addClass('d-none').removeClass('d-flex');
            downPaymentPercentageCalc.val(toCurrency(toInt(sessionStorage.getItem('price')) / 2));
            sessionStorage.setItem('down-payment', toCurrency(toInt(sessionStorage.getItem('price')) / 2));
            kiaFinanceDownPaymmentField.text(tengenator(toCurrency(toInt(sessionStorage.getItem('price')) / 2)));
        }

        creditSummCalc.val(toCurrency(((toInt(sessionStorage.getItem('total-price')) * ((12 / 100) + 1))).toFixed()));

        kiaFinanceCreditSummField.text(tengenator(toCurrency(((toInt(sessionStorage.getItem('total-price')) * ((12 / 100) + 1))).toFixed())));
        everyMonthField.text(toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
        everyMonth2Field.text(toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
        sessionStorage.setItem('every-month', toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));

        kiaFinanceCreditTermsField.text(`${toInt(sessionStorage.getItem('months'))} мес`);
        kiaFinanceCreditRateField.text(`${toInt(sessionStorage.getItem('percents'))}%`);
    });

    tradeInCalc.on('change', function tradeInCalcHandler() {
        sessionStorage.setItem('trade-in-price', $(this).val());

        if (toInt($(this).val()) <= 1) {
            tradeInParam.each((idx, item) => $(item).removeClass('d-flex').addClass('d-none'));
            kiaFinanceTradeInField.text('');
        } else {
            tradeInParam.each((idx, item) => $(item).removeClass('d-none').addClass('d-flex'));
            kiaFinanceTradeInField.text(tengenator(toCurrency(sessionStorage.getItem('trade-in-price'))));
            tradeIn2Calc.val(toCurrency(sessionStorage.getItem('trade-in-price')));
            tradeIn.removeClass('border-green').addClass('border-black');
            tradeIn.find('.success-message').addClass('d-none');
            surchargeCalc.val(toCurrency(toInt(downPaymentPercentageCalc.val()) - toInt(tradeIn2Calc.val())));
            kiaFinanceSurchargeField.text(tengenator(toCurrency(toInt(downPaymentPercentageCalc.val()) - toInt(tradeIn2Calc.val()))));
            if (toInt($(this).val()) >= toInt(downPaymentPercentageCalc.val())) {
                tradeIn.removeClass('border-black').addClass('border-green');
                tradeIn.find('.success-message').removeClass('d-none');
                surchargeCalc.val(0);
                kiaFinanceSurchargeField.text(tengenator(0));
            }
        }
        everyMonthField.text(toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
        everyMonth2Field.text(toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
        sessionStorage.setItem('every-month', toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
    });

    parameterItems.eq(0).trigger('click');
}
