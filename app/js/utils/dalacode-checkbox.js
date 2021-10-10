import jQuery from 'jquery';

(function dalacodeCheckboxFunction($) {
    $.fn.dalacodeCheckbox = function dalacodeCheckboxHandler(options) {
        const pluginOptions = $.extend(true, {
            'required': false,
            'content': {
                'active': false,
                'text': 'dalacode Checkbox Text Content',
            },
        }, options);

        const init = function dalacodeCheckboxInit() {
            // bindig this
            const $this = $(this);

            // reset checkbox
            $this.prop('checked', false);

            // check if require
            const isRequired = pluginOptions.required === true;

            if (isRequired) {
                $(this).addClass('is-required');
            }

            // create label wrapper for checkbox
            const $label = $('<label class="input-checkbox"></label>');

            // get id from this
            if ($this.attr('id')) {
                const $thisId = $this.attr('id');
                $label.attr('for', $thisId);
            }

            // hide input
            $this.css('display', 'none');

            // wrap input with label
            $this.wrap($label);

            if (pluginOptions.content.active) {
                const textContent = $('<span class="input-checkbox-text-content"></span>');
                $(textContent).text(pluginOptions.content.text);
                $this.after(textContent);
            }

            $this.on('change', function checkboxChangeHandler() {
                $this.parents('label').toggleClass('checked');

                if (isRequired) {
                    if (!$this.is(':checked')) {
                        $this.parents('label').addClass('on-error');
                        $this.parents('label').removeClass('on-success');
                    } else {
                        $this.parents('label').removeClass('on-error');
                        $this.parents('label').addClass('on-success');
                    }
                }
            });
        };

        return this.each(init);
    };
}(jQuery));
