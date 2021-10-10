import jQuery from 'jquery';

jQuery(($) => {
    let screenHeight = null;

    function setScreenHeight() {
        screenHeight = $(window).height();
    }

    setScreenHeight();

    $(window).on('resize', setScreenHeight);
});
