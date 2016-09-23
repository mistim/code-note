$(document).ready(function() {
    var refreshId = setInterval(function() {
        $('.logo-ln').toggleClass('hide');
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