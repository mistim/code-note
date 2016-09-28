(function($)
{
    $.Redactor.prototype.iconic = function()
    {
        return {
            init: function ()
            {
                var icons = {
                    'html': '<i class="fa fa-code"></i>',
                    'format': '<i class="fa fa-paragraph"></i>',
                    'lists': '<i class="fa fa-list-ol"></i>',
                    'link': '<i class="fa fa-link"></i>',
                    'horizontalrule': '<i class="fa fa-minus"></i>',
                    'image': '<i class="fa fa-picture-o"></i>',
                    'video': '<i class="fa fa-youtube-play"></i>',
                    'file': '<i class="fa fa-paperclip"></i>',
                    'bold': '<i class="fa fa-bold"></i>',
                    'italic': '<i class="fa fa-italic"></i>',
                    'deleted': '<i class="fa fa-strikethrough"></i>',
                    'paperclip': '<i class="fa fa-paperclip"></i>',
                    'table': '<i class="fa fa-table"></i>',
                    'alignment': '<i class="fa fa-align-center"></i>',
                    'fullscreen': '<i class="fa fa-arrows-alt"></i>',
                    'properties': '<i class="fa fa-cog"></i>'
                };

                $.each(this.button.all(), $.proxy(function(i,s)
                {
                    var key = $(s).attr('rel');

                    if (typeof icons[key] !== 'undefined')
                    {
                        var icon = icons[key];
                        var button = this.button.get(key);
                        this.button.setIcon(button, icon);
                    }

                }, this));
            }
        };
    };
})(jQuery);