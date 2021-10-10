import $ from 'jquery';

window.jQuery = $;

if ($('.model-colors').length) {
    const mainParent = $('.model-sections-colors');
    const colorPickerExterior = $('.model-sections-colors-exterior .color-list').children();
    const colorPickerInterior = $('.model-sections-colors-interior .color-list').children();

    mainParent.find('.model-sections-colors-image img').attr('src', `${$(colorPickerExterior).data('src')}`);
    mainParent.find('.model-sections-colors-exterior-desc span').text(`${$(colorPickerExterior).data('text')}`);

    if (!sessionStorage.getItem('color')) {
        $('.model-sections-colors-exterior .color-list span:nth-child(1)').addClass('active');
        sessionStorage.setItem('color', $('.model-sections-colors-exterior .color-list span:nth-child(1)').attr('data-text'));
        sessionStorage.setItem('color-rgb', $('.model-sections-colors-exterior .color-list span:nth-child(1)').attr('data-color'));
    } else {
        colorPickerExterior.each((idx, item) => {
            if ($(item).attr('data-text') === sessionStorage.getItem('color')) {
                $(item).addClass('active');
            }
        });
    }

    if (!sessionStorage.getItem('interior-color')) {
        colorPickerInterior.eq(0).addClass('active');
        $('.model-sections-colors-interior-desc span').text(colorPickerInterior.eq(0).attr('data-color-name'));
        sessionStorage.setItem('interior-color-rgb', colorPickerInterior.eq(0).attr('data-color-rgb'));
        sessionStorage.setItem('interior-color-name', colorPickerInterior.eq(0).attr('data-color-name'));
    } else {
        colorPickerInterior.each((idx, item) => {
            if ($(item).attr('data-color-name') === sessionStorage.getItem('interior-color-name')) {
                $(item).addClass('active');
                $(item).siblings().removeClass('active');
            }
        });
    }
    if ($('.model-sections-colors').length > 0) {
        // eslint-disable-next-line no-use-before-define
        colorPicker();
    }
}
function colorPicker() {
    const colorPickerInterior = $('.model-sections-colors-interior .color-list').children();
    const colorPickerExterior = $('.model-sections-colors-exterior .color-list').children();
    colorPickerInterior.on('click', function interiorBtnsHandler() {
        const thisRGBAttr = $(this).attr('data-color-rgb');
        const thisNameAttr = $(this).attr('data-color-name');
        const interiorColorField = $(this).parents('.colorpicker').find('.description-list span');

        sessionStorage.setItem('interior-color-rgb', thisRGBAttr);
        sessionStorage.setItem('interior-color-name', thisNameAttr);
        interiorColorField.text(sessionStorage.getItem('interior-color-name'));

        $(this).addClass('active').siblings().removeClass('active');
    });

    colorPickerExterior.on('click', function colorPickerExteriorHandler() {
        console.log($(this));
        $(this).parents('.model-sections-colors')
            .find('.model-sections-colors-image img')
            .attr('src', `${$(this).data('src')}`);
        $(this).parents('.model-sections-colors')
            .find('.model-sections-colors-exterior-desc span')
            .text(`${$(this).data('text')}`);
        $(this).addClass('active');
        $(this).siblings().removeClass('active');

        if ($('.complections').length) {
            const colorName = $(this).attr('data-text');
            const img = $(this).attr('data-src');
            const colorRGB = $(this).attr('data-color');

            sessionStorage.setItem('color', colorName);
            sessionStorage.setItem('img', img);
            sessionStorage.setItem('color-rgb', colorRGB);
        }
    });
}
