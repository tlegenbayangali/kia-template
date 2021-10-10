import $ from 'jquery';
import { toCurrency, toInt } from './index';

window.jQuery = $;

$.fn.dalacodeInputCalc = function dalacodeInputCalcHandler() {
    const init = function dalacodeInputCalcInit() {
        $(this).wrap('<label></label>');
        $(this).parent().addClass('dalacode-calc ml-20');
        $(this).attr('inputmode', 'numeric');
        if ($(this).hasClass('disabled')) {
            $(this).parent().addClass('disabled');
        }
        $(this).on('change', function dalacodeCalcInputChange() {
            const $val = $(this).val();
            $(this).val(toCurrency($val));
        });
    };

    return this.each(init);
};
