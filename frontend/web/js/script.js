$(document).ready(function() {

    $(".button-collapse").sideNav();

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.go-up').animate({
                right: '25px'
            }, 100);
        } else {
            $('.go-up').animate({
                right: '-60px'
            }, 100);
        }
    });
    $('.go-up').click(function () {
        $('html,body').animate({scrollTop: 0}, 300);
        return false;
    });

    var refreshId = setInterval(function() {
        $('.logo-ln').toggleClass('hide-op');
    }, 500);

    setTimeout(function() {
        var barTop = $('.bar-top');
        barTop.pushpin({
            offset: 81
        });
        barTop.outerWidth($('.sidebar').width());
        console.log(barTop.width());
    }, 100);
});