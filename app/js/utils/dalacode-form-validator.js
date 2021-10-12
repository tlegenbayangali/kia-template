import jQuery from 'jquery';

(function formValidator($) {
    $.fn.dalacodeForm = function formValidatorHandler() {
        const init = function formValidatorInit() {
            const $this = $(this);
            const quantityOfRequiredFields = $this.find('.is-required').length;
            const $submitEl = $this.find('input[type=submit]').parent('.btn-wrapper');

            $submitEl.addClass('disallowed');

            $(this).on('change', function formChangeHandler() {
                const quantityOfSuccess = $this.find('.on-success').length;
                if (quantityOfRequiredFields === quantityOfSuccess) {
                    $submitEl.removeClass('disallowed');
                } else {
                    $submitEl.addClass('disallowed');
                }
            });
        };

        return this.each(init);
    };
}(jQuery));
