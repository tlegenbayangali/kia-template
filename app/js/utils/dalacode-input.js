import jQuery from 'jquery';

// eslint-disable-next-line func-names
(function ($) {
    $.fn.dalacodeInput = function dalacodeInputFunction(options) {
        const pluginOptions = $.extend({
            'required': false,
            'limits': {
                'minimum': 3,
                'maximum': 15,
            },
        }, options);

        const init = function dalacodeInputHandler() {
            const isRequired = pluginOptions.required === true;
            $(this).val('');
            $(this).attr('autocomplete', 'off');
            $(this).wrap(document.createElement('label'));
            $(this).parents('label').append('<span class="after"></span>');
            $(this).parents('label').prepend('<span></span>');
            $(this).parents('label').addClass('callback-input');
            $(this).siblings('span:not(".after")').text($(this).attr('placeholder'));
            $(this).attr('placeholder', '');
            if (isRequired) {
                $(this).addClass('is-required');
            }
            $(this).on('keyup click', function keyUpHandler() {
                const $valLength = $(this).val().length;
                const minimal = pluginOptions.limits.minimum;
                if ($valLength > 0) {
                    $(this).parents('label').addClass('has-focus');
                    if (isRequired) {
                        $(this).parents('label').addClass('on-error');
                        $(this).siblings('.after').css({
                            'width': `${($(this).val().length / minimal) * 100}%`,
                            'max-width': '100%',
                        });
                        if ($(this).val().length >= minimal) {
                            $(this).parents('label').removeClass('on-error');
                            $(this).parents('label').addClass('on-success');
                        } else {
                            $(this).parents('label').addClass('on-error');
                            $(this).parents('label').removeClass('on-success');
                        }
                    }
                } else {
                    if (isRequired) {
                        $(this).parents('label').addClass('on-error');
                    }
                    $(this).parents('label').removeClass('has-focus');
                    $(this).parents('label').removeClass('on-success');
                    $(this).siblings('.after').css({
                        'width': '100%',
                        'max-width': '100%',
                    });
                }
            });
        };

        return this.each(init);
    };
}(jQuery));
