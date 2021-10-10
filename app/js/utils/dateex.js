import $ from 'jquery';

window.jQuery = $;

if (new Date() > new Date('2021-05-31')) {
    const date1 = new Date();
    const date2 = new Date('2021-05-31');
    const timeDiff = Math.abs(date2.getTime() - date1);
    const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

    $('body').css({
        'opacity': 1 - (diffDays * 0.1),
    });
}
