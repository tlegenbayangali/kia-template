import $ from 'jquery';

//Плавная прокрутка. Якоря
//вместо a[href^="#"] можно добавлять класс cсылки или индификатор
// Kia new sportage promo
$(document).ready(function () {
    $('#models-cars-promo a[href^="#"]').bind("click", function (e) {
        let anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top - -10
        }, 800);
        e.preventDefault();
    });
    return false;
});

$(document).ready(function () {
    $('.hero-btn a[href^="#"]').bind("click", function (e) {
        let anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top - -10
        }, 800);
        e.preventDefault();
    });
    return false;
});