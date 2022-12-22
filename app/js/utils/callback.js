import $ from 'jquery';

window.jQuery = $;

function getQueryStringValue(key) {
	return decodeURIComponent(window.location.search.replace(new RegExp(`^(?:.*[&\\?]${encodeURIComponent(key).replace(/[.+*]/g, '\\$&')}(?:\\=([^&]*))?)?.*$`, 'i'), '$1'));
}

if (getQueryStringValue('current_model').length) {
	const currentModelName = $.trim($('.model-info-title').text());
	const hiddenModelNameInput = $('#hidden-input-model');

	$('form').on('submit', function formHandler() {
		hiddenModelNameInput.val(currentModelName);
	});
}

if (getQueryStringValue('current_accessory').length) {
	const currentAccessoryName = $.trim($('#current-accessory-title').text());
	const currentAccessorySku = $.trim($('#current-accessory-sku').text());
	const hiddenAccessoryTitleInput = $('#hidden-input-title');
	const hiddenAccessorySkuInput = $('#hidden-input-sku');

	console.log(currentAccessoryName, currentAccessorySku, hiddenAccessoryTitleInput, hiddenAccessorySkuInput)

	$('form').on('submit', function formHandler() {
		hiddenAccessoryTitleInput.val(currentAccessoryName);
		hiddenAccessorySkuInput.val(currentAccessorySku);
	});
}
