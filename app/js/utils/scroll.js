import $ from 'jquery';

//Плавная прокрутка. Якоря
  //вместо a[href^="#"] можно добавлять класс cсылки или индификатор
  $(document).ready(function(){
    $('#models-cars-promo a[href^="#"]').bind("click", function(e){
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top - -10
        }, 800);
        e.preventDefault();
    });
    return false;
});