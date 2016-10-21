$(window).on('load', function () {
    //$('#pl-text').fadeIn();
    //$('body').removeClass('hide');
    $('#pl-page').delay(500).fadeOut();
    $('#pl-page-wrapper').delay(1000).fadeOut('slow');
});

$(document).ready(function() {

    $('.mobile-menu').sideNav();
    $('.mobile-sidebar').sideNav({
            menuWidth: 300, // Default is 240
            edge: 'right', // Choose the horizontal origin
            //closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
        }
    );

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
    }, 100);

    $('.tabs a').on('click', function(e) {
        e.preventDefault();
        var tabs = $(this).parents('.tabs').find('a');
        tabs.each(function() {
            $(this).find('i').removeClass('hide');
            $(this).find('span').addClass('hide');
            $(this).parent('.tab').attr('class', 'tab col s1');
        });

        $(this).find('i').addClass('hide');
        $(this).find('span').removeClass('hide');
        $(this).parent('.tab').attr('class', 'tab col s10');
    });
});