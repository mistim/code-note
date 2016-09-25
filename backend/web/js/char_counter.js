$(document).ready(function() {
    var textBlock = $('.char_counter');

    textBlock.each(function() {
        calcChar($(this));
    });

    textBlock.on('keyup', function() {
        calcChar($(this));
    });

    function calcChar(attribute) {
        var parentsBlock = attribute.parents('.form-group');
        parentsBlock.find('.cnt-word-total').text(attribute.val().split(' ').length);
        parentsBlock.find('.cnt-char-total').text(attribute.val().length);
        parentsBlock.find('.cnt-char-left').text(attribute.attr('maxlength') - attribute.val().length);
    }
});