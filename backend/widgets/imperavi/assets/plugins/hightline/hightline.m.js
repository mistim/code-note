(function($) {
    $.Redactor.prototype.hightline = function() {
        return {
            langs: {
                en: {
                    "hightline": "Hightline",
                    "delete-hightline": "Delete hightline"
                }
            },
            init: function() {
                var that = this;
                var dropdown = {};
                var langCode = {
                    "php": "PHP",
                    "html": "HTML",
                    "css": "CSS",
                    "javascript": "JavaScript"
                };

                dropdown.deleted = {
                    title: that.lang.get('delete-hightline'),
                    func: that.hightline.removeCodeBlock
                };

                $.each(langCode, function(i, item) {
                    dropdown[i] = {
                        title: item,
                        func: that.hightline.setCodeBlock,
                        args: i
                    };
                });

                var button = this.button.add('hightline', this.lang.get('hightline'));
                this.button.addDropdown(button, dropdown);
                this.button.setIcon(button, '<i class="fa fa-code"></i>');
            },
            removeCodeBlock: function() {
                var text = this.selection.text();
                var current = this.selection.current();

                if (text === '') {
                    alert('Need select text!');
                    return false;
                } else
                if ($(current).get(0).tagName === 'PRE') {
                    this.inline.format('pre', 'remove');
                    //this.inline.format('p');
                }
                //this.inline.removeFormat();
                this.inline.format('p');
            },
            setCodeBlock: function(args) {
                //this.buffer.set();
                //this.hightline.removeCodeBlock();
                this.inline.format('pre', 'class', args);
            }
        };
    }
})(jQuery);