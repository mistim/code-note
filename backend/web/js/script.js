$(document).ready(function() {
    var tabs = $('.nav-tabs li');

    if (typeof tabs !== 'undefined') {
        $('form').on('afterValidate', function() {
            tabs.removeClass('active');
            tabs.each(function() {
                var item = $(this);
                var tabPanel = $(item.find('a').attr('href'));
                if (tabPanel.find('.form-group.has-error').length > 0) {
                    item.find('a').tab('show');
                    tabPanel.find('.form-group.has-error').focus();
                    return false;
                }
            });
        });
    }
});