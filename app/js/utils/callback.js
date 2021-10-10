import $ from 'jquery';

window.jQuery = $;

function getQueryStringValue(key) {
    return decodeURIComponent(window.location.search.replace(new RegExp(`^(?:.*[&\\?]${encodeURIComponent(key).replace(/[.+*]/g, '\\$&')}(?:\\=([^&]*))?)?.*$`, 'i'), '$1'));
}

if (getQueryStringValue('current_model').length) {
    const currentModelName = $.trim($('.model-info-title').text());
    const hiddenModelNameInput = $('#hidden-input-model');

    hiddenModelNameInput.val(currentModelName);
}
