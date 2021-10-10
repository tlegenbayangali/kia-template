export default function clickOutside($, window, document) {
    const pluginName = 'oneClickOutside';

    const defaults = {

        'callback': null,

        'calledFromClickInsideHandler': false,

        'exceptions': null,

    };

    function Plugin(element, options) {
        this.element = element;

        this.$name = pluginName;

        this.options = $.extend({}, defaults, options);

        this.init(options.calledFromClickInsideHandler);
    }

    $.extend(Plugin.prototype, {
        'init': function clickOutsideInit(calledFromClickInsideHandler) {
            const that = this;
            let outside = !(calledFromClickInsideHandler);
            this.$el = $(this.element);
            this.clickInsideHandler = () => {
                outside = false;
            };

            this.clickOutsideHandler = () => {
                if (outside) {
                    that.options.callback.apply(that.options.thisArg || this);
                    that.destroy();
                }
                outside = true;
            };
            this.$el.on('click', this.clickInsideHandler);
            if (this.options.exceptions) {
                $(this.options.exceptions).on('click', this.clickInsideHandler);
            }
            $(document).on('click', this.clickOutsideHandler);
        },
        'destroy': function clickOutsideDestroy() {
            this.removeListeners();
            $.data(this.element, `plugin_${pluginName}`, null);
        },

        'removeListeners': function () {
            this.$el.off('click', this.clickInsideHandler);
            if (this.options.exceptions) {
                $(this.options.exceptions).off('click', this.clickInsideHandler);
            }

            $(document).off('click', this.clickOutsideHandler);
        },
    });
    $.fn[pluginName] = function (options) {
        this.each(function () {
            const plugin = $.data(this, `plugin_${pluginName}`);
            if (options !== null && typeof options === 'object' && !plugin) {
                $.data(this, `plugin_${pluginName}`, new Plugin(this, options));
            } else if (options === 'off' && plugin) {
                plugin.destroy();
            }
        });
        return this;
    };
}
