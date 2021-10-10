import jQuery from 'jquery';

(function dalacodeFixedWrapper($) {
    $.fn.dalacodeFixed = function dalacodeFixedHandler(options) {
        const pluginOptions = $.extend({
            'direction': 'toBottom',
            'parentElement': $('.dalacode-fixed-parent'),
        }, options);

        const init = function dalacodeFixedInit() {
            const $this = $(this);
            $this.css({
                'position': 'fixed',
                'width': '100%',
                'z-index': 11,
                'top': 'auto',
                'bottom': 'auto',
            });

            let windowHeight;
            let parentElementTopEdge;
            let parentElementBottomEdge;
            const parentElement = $(pluginOptions.parentElement);

            parentElement.css({
                'padding-bottom': $this.outerHeight(),
            });

            $(window).on('resize', function windowHandler() {
                windowHeight = $(window).height();
                parentElementTopEdge = pluginOptions.parentElement.offset().top;
                parentElementBottomEdge = parentElementTopEdge + $(pluginOptions.parentElement).outerHeight();
            }).trigger('resize');

            if (pluginOptions.direction === 'toBottom') {
                $this.css({
                    'bottom': 0,
                });
                const windowScroll = function windowScrollHandler() {
                    const scrollTop = $(window).scrollTop();
                    if (scrollTop + windowHeight >= parentElementBottomEdge) {
                        $this.css({
                            'position': 'absolute',
                        });
                    } else {
                        $this.css({
                            'position': 'fixed',
                        });
                    }
                };
                $(window).on('scroll touchmove', windowScroll);
            }
        };

        return this.each(init);
    };
}(jQuery));
