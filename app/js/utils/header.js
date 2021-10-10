import jQuery from 'jquery';

(($) => {
    const headerMain = $('.header');
    let headerMainHeight;
    const headerTop = $('.header .header-top');
    let headerTopHeight;
    const headerTopInner = $('.header .header-top-inner');

    const menuHamburgerBtn = $('.header .hamburger');
    const menuMain = $('.menu');
    const menuMainWrapper = $('.menu .menu-wrapper');
    const menuMainRightBlock = $('.header .header-top .right');
    const subMenuWrapper = $('.menu .menu-wrapper > ul > li .m_menu-item-container-wr');
    const heightWithoutAllHeader = $(window).height() - $(headerMain).outerHeight();
    const hasChildrenLi = $('.menu .menu-wrapper > ul > li');
    const menuBannersItem = $('.menu .m_menu-item-banners-item');
    const mainWrapper = $('.main-section');
    const $window = $(window);

    let scrollPrev = 0;
    $(window).on('scroll', function windowOnScrollHandler() {
        const scrolled = $window.scrollTop();
        if (scrolled > $(headerTop).outerHeight() && scrolled > scrollPrev) {
            $(headerMain).addClass('header-fixed-hide');
            $(headerMain).removeClass('header-fixed-show');
        } else {
            $(headerMain).addClass('header-fixed-show');
            $(headerMain).removeClass('header-fixed-hide');
        }
        scrollPrev = scrolled;
    });

    // MAIN MENU FOR DESKTOP
    // MENU LI ITEMS, OPENING AND CLOSING
    for (const hasChildrenLiElem of hasChildrenLi) {
        if ($(hasChildrenLiElem).children('.m_menu-item-container-wr').length > 0) {
            $(hasChildrenLiElem).addClass('has-children');
            $(hasChildrenLiElem).on('click', function itemClickHandler(e) {
                e.preventDefault();
                $(this).siblings('.has-children').removeClass('m-opened');
                $(this).siblings('.has-children').children('.m_menu-item-container-wr').removeClass('m-opened');
                if ($(this).hasClass('m-opened')) {
                    $(this).removeClass('m-opened');
                    $(this).children('.m_menu-item-container-wr').removeClass('m-opened');
                } else {
                    $(this).addClass('m-opened');
                    $(this).children('.m_menu-item-container-wr').addClass('m-opened');
                }
                e.stopPropagation();
            });
            $(hasChildrenLiElem).children('.m_menu-item-container-wr').on('click', function menuChildrenClickHandler(e) {
                e.stopPropagation();
            });
        }
    }
    // SIZING FUNCTION
    function sizing() {
        // CREATING SHADOW BOX
        const shadowBox = document.createElement('div');
        $(shadowBox).addClass('sh');
        if ($('.header-top .sh').length === 0) {
            // IF SHADOW BOX IS NOT PREPENDED PREPEND IT TO HEADER TOP
            $(headerTop).prepend($(shadowBox));
        }
        // WIDTH > THAN 1200
        if ($(window).width() >= 992) {
            // CLICKING MENU LI ITEMS, MAKING SHADOW BOX VISIBLE AND BLOCKING SCROLL FOR BODY
            $(hasChildrenLi).on('click', function clickHandler() {
                if ($(this).parents(menuMain).find('li.m-opened').length > 0) {
                    $(this).parents(headerTop).find('.sh').css({ 'pointer-events': 'initial', 'opacity': '1' });
                    $('body').css('overflow', 'hidden');
                } else {
                    $('body').css('overflow', '');
                    $(this).parents(headerTop).find('.sh').css({ 'pointer-events': 'none', 'opacity': '0' });
                }
            });
            // SETTING FLEXIBLE HEIGHT AND VERTICAL SCROLL FOR SUBMENU
            $(subMenuWrapper).css({ 'overflow-y': 'auto', 'max-height': `${heightWithoutAllHeader}px` });

            $(menuMain).css('height', 'auto');
            $(headerTopInner).append(menuMainRightBlock);
            $(mainWrapper).css({ 'padding-top': headerMainHeight });
            $(subMenuWrapper).css({ 'height': 'auto' });
        }
        // WIDTH < THAN 991
        if ($(window).width() < 992) {
            headerTopHeight = $('.header-top').outerHeight();
            $(subMenuWrapper).css({
                'height': `calc(100vh - ${headerTopHeight})`,
                'overflow-y': 'auto',
                'max-height': '100%',
            });
            // MENU BANNERS, REMOVING BACKGROUND IMAGE FOR
            $(menuBannersItem).css({
                'background-image': '',
                'background-color': '#f2f2f2',
            });
            // ADRESS AND NUMBER, MOVING IT TO BOTTOM OF BOTTOM MENU
            $(menuMainWrapper).append(menuMainRightBlock);
            // MENU LI ITEMS
            for (const hasChildrenLiElem of hasChildrenLi) {
                if ($(hasChildrenLiElem).children('.m_menu-item-container-wr').length > 0) {
                    $(hasChildrenLiElem).on('click', function itemClickHandler(e) {
                        $(menuMain).animate({ 'scrollTop': 0 }, 'fast');
                        if ($(this).find('.m_menu-item-title').length === 0) {
                            // CREATING TITLE ELEMENT FOR SUB MENU,
                            // TEXT RESPONDS TO MENU LI ITEM'S TEXT
                            const titleDiv = document.createElement('div');
                            $(titleDiv).addClass('m_menu-item-title');
                            $(titleDiv).text($(this).children('a').text());
                            // TITLE ELEMENT, CLOSING SUBMENU AND MOVING
                            // TO MAIN MENU BY CLICKING LEFT ARROW
                            $(titleDiv).on('click', function titleDivClickHandler(q) {
                                const x = q.pageX - $(this).offset().left;
                                const y = q.pageY - $(this).offset().top;
                                if ($(window).width() >= 524 && $(window).width() < 1200) {
                                    if ((x > 0 && x < 130) && (y > 10 && y < 60)) {
                                        $(this).parents('div.m_menu-item-container-wr, li.m_menu-item').removeClass('m-opened');
                                        $(menuMain).css('overflow', '');
                                    }
                                } else if ($(window).width() < 524) {
                                    if ((x > 0 && x < 80) && (y > 10 && y < 60)) {
                                        $(this).parents('div.m_menu-item-container-wr, li.m_menu-item').removeClass('m-opened');
                                        $(menuMain).css('overflow', '');
                                    }
                                }
                                q.stopPropagation();
                            });
                            $(this).find('.m_menu-item-container').prepend(titleDiv);
                        }
                        // BLOCKING SCROLL FOR MAIN MENU WHILE OPENING SUB MENU
                        $(menuMain).css('overflow', 'hidden');
                        // MAIN MENU ANIMATION TO TOP, AFTER OPEN IT TO DISPLAY IT CORRECTLY
                        $(menuMain).animate({ 'scroll-top': 0 }, 'fast');
                        e.stopPropagation();
                    });
                }
            }
            const heightWithoutHeader = $(window).height() - $(headerTop).outerHeight();
            // CALCULATING HAMBURGER MENU HEIGHT
            // CALCULATING HAMBURGER SUB MENU HEIGHT
            if (typeof headerTop !== 'undefined') {
                $(menuMain).css('height', heightWithoutHeader);
                $(subMenuWrapper).css('height', heightWithoutHeader);
            } else {
                $(menuMain).css('height', '100vh');
                $(subMenuWrapper).css('height', '100vh');
            }
            // HAMBURGER BUTTON
            $(menuHamburgerBtn).on('click', function menuHamburgerBtnHandler(e) {
                e.preventDefault();
                $(this).toggleClass('m-opened');
                // MAIN MENU, ANIMATION TO TOP, AFTER OPEN IT TO DISPLAY IT CORRECTLY
                if (!$(this).hasClass('m-opened')) {
                    $(menuMain).animate({ 'scroll-top': 0 }, 'fast');
                }
                $(menuMain).toggleClass('m-opened');
                $(menuMain).css('overflow', '');
                // MAKING SHADOW BOX VISIBLE AND BLOCKING SCROLL FOR BODY
                if ($(this).hasClass('m-opened')) {
                    $(this).parents(headerTop).find('.sh').css({ 'pointer-events': 'initial', 'opacity': '1' });
                    $('body').css('overflow', 'hidden');
                } else {
                    $('body').css('overflow', '');
                    $(this).parents(headerTop).find('.sh').css({ 'pointer-events': 'none', 'opacity': '0' });
                }
                e.stopImmediatePropagation();
                // DELETING M-OPENED CLASSES FOR ALL MENU ELEMENTS WHILE CLOSING
                for (const hasChildrenLiElemlet of hasChildrenLi) {
                    if ($(hasChildrenLiElemlet).children('.m_menu-item-container-wr').length > 0) {
                        if ($(hasChildrenLiElemlet).children().hasClass('m-opened')) {
                            $(hasChildrenLiElemlet).children('.m-opened').css('transition', 'none');
                        } else {
                            $(hasChildrenLiElemlet).children('.m_menu-item-container-wr').css('transition', 'all ease 1s');
                        }
                        $(hasChildrenLiElemlet).removeClass('m-opened');
                        $(hasChildrenLiElemlet).children('.m_menu-item-container-wr').removeClass('m-opened');
                    }
                }
            });
        }
        // ADD PADDING TO MAIN WRAPPER
        if ($('#header-model').length) {
            $(mainWrapper).css({
                'padding-top': `${$(headerMain).outerHeight() + $('#header-model').outerHeight()}px`,
            });
        } else {
            $(mainWrapper).css({
                'padding-top': `${$(headerMain).outerHeight()}px`,
            });
        }
    }
    // sizing();
    $(window).on('resize', function resizeHandler() {
        headerMainHeight = $(headerMain).height();
        sizing();
    });
})(jQuery);
