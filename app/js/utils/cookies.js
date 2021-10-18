import $ from 'jquery';

window.jQuery = $;

const cookiesWrapper = $('.cookies-wrapper');
const cookiesBtn = $('.cookies-wrapper .btn');

if (!localStorage.getItem('cookie-accepted') === true) {
    cookiesWrapper.addClass('opened');
}

cookiesBtn.on('click', function cookiesBtnHandler(e) {
    e.preventDefault();
    localStorage.setItem('cookie-accepted', true);
    cookiesWrapper.removeClass('opened');
});
