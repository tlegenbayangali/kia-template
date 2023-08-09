/* eslint-disable new-cap */
import $ from 'jquery';
// eslint-disable-next-line import/no-extraneous-dependencies
// import 'babel-polyfill';
import Sticky from 'sticky-js';
import './utils/header';
import './utils/webp';
import './utils/sliderInit';
import './utils/inputs';
import './utils/car-single';
import './utils/car-single-modal';
import './utils/car-single-list';
import './utils/car-single-colors';
import './utils/additional-info';
import './utils/test-drive';
import './utils/offers-slider';
import './utils/config';
import './utils/config-complectations';
import './utils/config-colors';
import './utils/config-results';
import './utils/credit-offers';
import './utils/credit-conditionals';
import './utils/credit-results';
import './utils/equip';
import './utils/slider-with-thumbs';
import './utils/callback';
import './utils/cookies';
import './utils/range-custom';
// import './utils/dateex';
// import Sagyndyk do
import './utils/slider-block';
import './utils/scroll';

window.jQuery = $;

$('body').addClass('is-loading');
let openedItems = null;
$(document).on('click', () => {
	openedItems = $('.opened');
	$(openedItems).removeClass('opened');
});

$(window).on('resize', function resizeHandler() {
	if ($(window).width() >= 992) {
		$(document).on('click', () => {
			openedItems = $('.opened');
			$(openedItems).removeClass('opened');
			$('body').css('overflow', 'auto');
			const sh = $('.sh');
			openedItems = $('.opened, .m-opened');
			$(openedItems).removeClass('opened, m-opened');
			$(sh).css({
				opacity: 0,
				'pointer-events': 'none',
			});
		});
	}
});
$(window).trigger('resize');

setTimeout(() => {
	$('body').removeClass('is-loading');
	$('.loader').addClass('loader-loaded');
}, 1000);

$('.wpcf7-form-control.wpcf7-checkbox').remove();

const cfForm = $('.wpcf7-form');
const cfSubmit = $('.wpcf7-submit');

if (cfForm.length) {
	cfForm.on('wpcf7submit', function () {
		console.log(cfSubmit);
		cfSubmit.prop('disabled', true);
	});
	cfForm.on('wpcf7mailsent', function cfFormHandler() {
		$(this).parents('.callback-col').append(`
        <div class="mt-40 mb-40">
            <span class="fz-25 fw-700 thankyou">Ваша заявка успешно отправлена!</span>
            <p class="mt-20">Сотрудник дилерского центра Kia свяжется с Вами в ближайшее время.</p>
            <a href="/" class="mt-30 d-block">На главную</a>
        </div>
        `);
		$(this).parents('.callback-form').remove();
	});
}

/**
 * Form Submitter Button
 */
const formSubmitter = $('.wpcf7-form .btn-wrapper.btn-wrapper-lg');
const submitInput = $('.wpcf7-form input[type=submit]');

formSubmitter.on('click', function formSubmitterHandler() {
	$(submitInput).trigger('click');
});

// $('a[href^="#"]').on('click', function transitionHadler(event) {
//     // отменяем стандартное действие
//     event.preventDefault();
//     const sc = $(this).attr('href');
//     const dn = $(sc).offset().top;
//     /*
//     * sc - в переменную заносим информацию о том, к какому блоку надо перейти
//     * dn - определяем положение блока на странице
//     */
//     $('html, body').animate({ 'scrollTop': dn }, 1000);
//     /*
//     * 1000 скорость перехода в миллисекундах
//     */
// });

// eslint-disable-next-line no-unused-vars
const sticky = new Sticky('.model-info');

if ($('.equip-config')) {
	const itemWrapper = $('.equip-config');
	const item = $('.equip-config-section-item');
	item.each((idx, equipItem) => {
		let counter = 0;
		$(equipItem)
			.find('.equip-config-section-item-carousel-wrapper .swiper-slide div')
			.each((innerIdx, innerItem) => {
				if ($.trim($(innerItem).text()) !== '—') {
					counter += 1;
				}
			});
		if (!counter && !$(equipItem).hasClass('plain')) {
			$(equipItem).remove();
		}
	});
	itemWrapper.each((idx, parentItem) => {
		if (!$(parentItem).find('.equip-config-section-item').length) {
			$(parentItem).remove();
		}
	});
}

if ($('#offer-form').length) {
	const offerName = $.trim($('.breadcrumbs .kb_title').text());
	const formOfferName = $('#form-offer-name');

	setTimeout(() => {
		formOfferName.val(offerName);
	}, 5000);
}

$('#single-model-car-button').on('click', () => {
	$('.header-single-model-mobile').toggleClass('open');
});
