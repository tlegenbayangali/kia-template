import jQuery from 'jquery';

(($) => {
    const headerModelWrapper = $('.header-model-wrapper');
    const headerModelMenu = $('.header-model-menu');
    const headerModelMenuLi = $('.header-model-menu-main li');
    const modelMenuButton = $('.header-model-menu-main .button-dots ');
    const modelMenuSub = $('.header-model-menu-sub-wrapper');
    const modelMenuSubUl = $('.header-model-menu-sub-wrapper .header-model-menu-sub');
    const headerModelName = $('.header-model-left');
    const headerMain = $('.header');
    const headerTop = $('.header .header-top');
    const $window = $(window);
    // SIZING FUNCTION
    function sizing() {
        // HEADER MODEL WHILE SCROLLING, SETTING POSITION
        $(window).on('scroll', function windowOnScrollHandler() {
            const scrolled = $window.scrollTop();
            if (scrolled > $(headerTop).outerHeight()) {
                $(headerModelWrapper).css({
                    'transform': 'translateY(0)',
                });
            } else {
                $(headerModelWrapper).css({
                    'transform': `translateY(${$(headerMain).outerHeight()}px)`,
                });
            }
        });
        // HEADER MODEL, SETTING POSITION
        $(headerModelWrapper).css({
            'transform': `translateY(${$(headerMain).outerHeight()}px)`,
        });
        // WIDTH > THAN 1200
        if ($(window).width() > 1200) {
            // BINDING HANDLER TO THE MAIN MENU DOTS BUTTON
            $(modelMenuButton).on('click', function modelMenuButtonHandler(e) {
                e.preventDefault();
                $(this).toggleClass('opened');
                $(modelMenuSub).toggleClass('opened');
                e.stopPropagation();
            });
        }
        if ($(window).width() < 1200) {
            // BINDING HANDLER TO THE MODEL NAME ARROW BUTTON
            $(headerModelName).on('click', function headerModelNameHandler(e) {
                e.preventDefault();
                $(this).toggleClass('opened');
                $(modelMenuSub).toggleClass('opened');
                e.stopPropagation();
            });
            // MOVING SUBMENU UP THE DOM TREE
            $(modelMenuSub).appendTo(headerModelMenu);
            // MOVING MAIN MENU ELEMENT TO THE SUB MENU
            for (const liElement of headerModelMenuLi) {
                $(liElement).prependTo(modelMenuSubUl);
            }
            $('.header-model-menu-main').addClass('d-none');
        }
        // SUB MENU LI A
        $('.header-model-menu-sub li a').addClass('underline');
        // SUB MENU
        $(modelMenuSub).on('click', function modelMenuSubHandler(e) {
            e.stopPropagation();
        });
    }
    // sizing();
    $(window).on('resize', function resizeHandler() {
        sizing();
    });
})(jQuery);
