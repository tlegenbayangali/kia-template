import $ from 'jquery';

window.jQuery = $;
const mainParent = $('.model-sections-colors');
const colorPickerExterior = $('.model-sections-colors-exterior .color-list').children();

mainParent.find('.model-sections-colors-image img').attr('src', `${$(colorPickerExterior).data('src')}`);
mainParent.find('.model-sections-colors-exterior-desc span').text(`${$(colorPickerExterior).data('text')}`);

$('.model-sections-colors-exterior .color-list span:nth-child(1)').addClass('active');

function colorPicker() {
	colorPickerExterior.on('click', function colorPickerExteriorHandler() {
		$(this).parents('.model-sections-colors')
			.find('.cloudimage-360')
			.eq(0)
			.attr('data-folder', $(this).data('src'));

		$(this).parents('.model-sections-colors')
			.find('.model-sections-colors-exterior-desc span')
			.text(`${$(this).data('text')}`);

		$(this).addClass('active');
		$(this).siblings().removeClass('active');

		window.CI360.update('model-t60');
	});
}

if ($('.model-sections-colors').length > 0) {
	colorPicker();
}
