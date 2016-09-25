$(document).ready(function() {
    // Anti double click
    $('.anti-dc').on('click', function(e) {
        e.preventDefault();

        var elementClick = $(this);

        // если уже задизеблено
        if (elementClick.hasClass('disabled')) {
            return false;
        }

        elementClick.prop('disabled', true).addClass('disabled');

        // если это кнопка формы
        if (elementClick.prop("tagName").toLowerCase() === 'button') {
            var elementForm = elementClick.parents('form').attr('id');

            if (typeof elementForm === 'undefined') {
                elementForm = elementClick.attr('form');
            }

            elementForm = $('#' + elementForm);

            // запускаем валидацию формы
            elementForm.data('yiiActiveForm').submitting = true;
            elementForm.yiiActiveForm('validate');

            // проверяем на наличие ошибок валидации
            elementForm.on('afterValidate', function (e) {
                e.preventDefault();

                // если есть ошибки, снимаеб блок с кнопки
                if (elementForm.find('.has-error').length > 0) {
                    elementClick.prop('disabled', false).removeClass('disabled');

                    return false;
                }

                return true;
            });
        } else {
            // если ссылка должна уйти через POST
            if (elementClick.data('method') && elementClick.data('method').toLowerCase() === 'post') {
                // создаем форму
                var form = $("<form/>", {
                    action: elementClick.attr('href'),
                    method: 'post'
                }).append(
                    $("<input>", {
                        type: 'hidden',
                        name: $('meta[name="csrf-param"]').attr('content'),
                        value: $('meta[name="csrf-token"]').attr('content')
                    })
                ).append(
                    $("<button>", {
                        type: 'submit',
                        value: 'submit'
                    })
                ).css({display: 'none'});

                $("body").append(form);
                form.submit();
            } else {
                // переход по ссылке
                document.location.href = elementClick.attr('href');
            }
        }
    });
});