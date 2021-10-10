import $ from 'jquery';
import Cleave from 'cleave.js';
import './dalacode-input';
import './dalacode-textarea';
import './dalacode-checkbox';
import './dalacode-input-calc';
import './dalacode-form-validator';

$(() => {
    $('input#form-name').dalacodeInput({
        'required': true,
    });

    $('#form-vin').dalacodeInput({
        'required': false,
    });

    $('#form-model').dalacodeInput({
        'required': true,
    });

    $('#form-year').dalacodeInput({
        'required': true,
    });

    if ($('input.input-phone').length) {
        // eslint-disable-next-line no-unused-vars
        const cleave = new Cleave('input.input-phone', {
            'prefix': '+',
            'blocks': [1, 1, 3, 3, 2, 2],
            'delimiters': ['', ' (', ') ', '-', '-'],
            'uppercase': true,
            'numericOnly': true,
        });
    }
    $('input.input-phone').dalacodeInput({
        'required': true,
        'limits': {
            'minimum': 18,
        },
    });

    $('textarea.input-message').dalacodeTextarea({
        'required': false,
        'limits': {
            'minimum': 25,
        },
    });

    $('input.input-checkbox').dalacodeCheckbox({
        'required': true,
        'content': {
            'active': true,
            'text': 'Проставляя отметку, Вы даете согласие на обработку Ваших персональных данных.',
        },
    });

    $('.input-calc').dalacodeInputCalc();

    $('form').dalacodeForm();
});
