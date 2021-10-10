import $ from 'jquery';
// import '@fancyapps/fancybox';

window.jQuery = $;

function openModal() {
    const modalWindowParent = $('.model-sections-desc');

    const openButton = modalWindowParent.children('.model-sections-desc-button');
    const modalWindow = $('.model-sections-desc-modal');
    const closeButton = $('.model-sections-desc-modal-title .close');
    closeButton.on('click', function closeButtonHandler(e) {
        e.preventDefault();
        $(this).parents('.model-sections-desc-modal')
            .fadeOut(200);
        $('body').removeClass('no-scroll');
    });
    openButton.on('click', function openButtonHandler(e) {
        e.preventDefault();
        $(this).parents('.model-sections-desc')
            .find(modalWindow)
            .fadeIn(300);
        $('body').addClass('no-scroll');
        console.log('asdasdasdasd');
    });
}
if ($('.model-sections-desc').length) {
    openModal();
}
