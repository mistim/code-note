$(window).on('load', function () {
    //$('#pl-text').fadeIn();
    //$('body').removeClass('hide');
    $('#pl-page').delay(500).fadeOut();
    $('#pl-page-wrapper').delay(1000).fadeOut('slow');
});

$(window).scroll(function () {
    var sidebar = $('.bar-top');
    var diff =  Math.round($(window).scrollTop()) - (Math.round($(document).height()) - Math.round($(window).height()));
    diff = Math.abs(diff);

    if (
        //Math.round($(window).scrollTop()) === Math.round($(document).height()) - Math.round($(window).height()) ||
        diff < 100
    ) {
        //Пользователь долистал до низа страницы
        sidebar.css({'margin-top': '-99px'});
    } else {
        sidebar.css({'margin-top': '0'})
    }

    /*console.log(
        Math.round($(window).scrollTop()),
        Math.round($(document).height()) - Math.round($(window).height()),
        diff
    );*/
});

$(document).ready(function() {

    $('.mobile-menu').sideNav();
    $('.mobile-sidebar').sideNav({
            menuWidth: 300, // Default is 240
            edge: 'right' // Choose the horizontal origin
            //closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
        }
    );

    $(window).scroll(function () {
        var goUp = $('.go-up');
        if ($(this).scrollTop() > 700) {
            if (goUp.css('right') !== '25px') {
                goUp.animate({
                    right: '25px'
                }, 100);
            }
        } else {
            if (goUp.css('right') !== '-60px') {
                goUp.animate({
                    right: '-60px'
                }, 100);
            }
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
        var titleEntity = $(this).parents('.card').find('.title-entity span');
        var id = $(this).attr('href');

        titleEntity.each(function() {
            if ($(this).data('id') === id) {
                $(this).removeClass('hide');
            } else {
                $(this).addClass('hide');
            }
        });
    });
});