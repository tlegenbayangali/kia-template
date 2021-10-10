import $ from 'jquery';
import { toInt, getEveryMonthPayment, toCurrency } from './index';

window.jQuery = $;

$.fn.dalacodePlusMinus = function dalacodePlusMinusHandler(sessionName, data) {
    const kiaFinanceCreditTermsField = $('#kia-finance-credit-terms-field');
    const kiaFinanceCreditRateField = $('#kia-finance-credit-rate-field');
    const everyMonthField = $('#every-month-field');
    const everyMonth2Field = $('#every-month-2-field');
    const init = function initHandler() {
        const $this = $(this);
        const months = Object.values(JSON.parse(data.months));
        const percents = Object.values(JSON.parse(data.percents));
        const itemsLength = months.length;
        const common = $(this).find('.btn');
        const minus = $this.find('.minus');
        const plus = $this.find('.plus');
        let i = 0;
        $this.find('.plusminus-value').text(months[i]);
        sessionStorage.setItem(sessionName, months[i]);
        sessionStorage.setItem('percents', percents[i]);
        minus.addClass('disabled');
        minus.on('click', function minusHandler() {
            i -= 1;
            $this.find('.plusminus-value').text(months[i]);
            sessionStorage.setItem(sessionName, months[i]);
            sessionStorage.setItem('percents', percents[i]);
            kiaFinanceCreditTermsField.text(`${toInt(sessionStorage.getItem(sessionName))} мес`);
            kiaFinanceCreditRateField.text(`${toInt(sessionStorage.getItem('percents'))}%`);
            everyMonthField.text(toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
            everyMonth2Field.text(toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
            sessionStorage.setItem('every-month', toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
            if (i === 0) {
                return false;
            }
            return months[i];
        });
        plus.on('click', function plusHandler() {
            $(this).removeClass('disabled');
            i += 1;
            $this.find('.plusminus-value').text(months[i]);
            sessionStorage.setItem(sessionName, months[i]);
            sessionStorage.setItem('percents', percents[i]);
            kiaFinanceCreditTermsField.text(`${toInt(sessionStorage.getItem('months'))} мес`);
            kiaFinanceCreditRateField.text(`${toInt(sessionStorage.getItem('percents'))}%`);
            everyMonthField.text(toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
            everyMonth2Field.text(toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
            sessionStorage.setItem('every-month', toCurrency(getEveryMonthPayment(sessionStorage.getItem('months'), 12)));
            if (i === itemsLength - 1) {
                return false;
            }
            return months[i];
        });
        common.on('click', function commonHandler() {
            if (i === 0) {
                minus.addClass('disabled');
                plus.removeClass('disabled');
            } else if (i === itemsLength - 1) {
                minus.removeClass('disabled');
                plus.addClass('disabled');
            }
        });
    };
    return this.each(init);
};
