/**
 * Select smart decorator class
 *
 * @param element
 * @constructor
 */
var SelectDecorator = function (element) {

    this.element = element;
    this._oldValue = element.val();
    this._bufferedValues = {};

    var _self = this;

    element.on('change', function () {
        if (_self._oldValue !== $(this).val()) {
            $('.attributes-container').find('input').each(function () {
                if (_self._bufferedValues[_self._oldValue] === undefined) {
                    _self._bufferedValues[_self._oldValue] = {};
                }
                var name = $(this).attr('name');
                var regex = /\[([a-zA-Z0-9\s]+)\]$/i; // find name of category attribute
                _self._bufferedValues[_self._oldValue][$(this).attr('name').match(regex)[1]] = $(this).val();
            });
            _self._oldValue = $(this).val();
            (new Promise(getCategoryAttributes)).then(function() {
                fillPreviousValues(_self._oldValue);
            });
        }
    });

    function fillPreviousValues(id) {
        var previous_values;
        if (previous_values = _self._bufferedValues[id]) {
            for (var value in previous_values) {
                $('.attributes-container').find(`input[name*='${value}']`).val(previous_values[value]);
            }
        }
    }

    function getCategoryAttributes(resolve, reject) {
        $.ajax({
            type: 'GET',
            url: '/categories/' + _self._oldValue + '/attributes',
            success: function (data) {

                var attributeContaier = $('.attributes-container');
                attributeContaier.empty();

                var attribute;
                var wrapper;
                var textWrapper;
                var label;
                var inputWrapper;
                var input;

                if ($.isArray(data)) {
                    $.each(data, function (index, value) {

                        attribute = JSON.parse(value);

                        wrapper = document.createElement('div');
                        textWrapper = document.createElement('div');
                        label = document.createElement('p');
                        inputWrapper = document.createElement('div');
                        input = document.createElement('input');

                        $(wrapper).addClass('form-line__wrapper form-line__wrapper--min-margin');
                        $(textWrapper).addClass('form-item__wrapper form-item__wrapper--text');
                        $(label).addClass('form-item__title');
                        $(inputWrapper).addClass('form-item__wrapper form-item__wrapper--field');

                        $(input).addClass('form-item__inp');
                        if (attribute.type === 'digits') {
                            input.setAttribute('type', 'number');
                        } else {
                            input.setAttribute('type', 'text');
                        }
                        input.setAttribute('required', 'required');
                        input.setAttribute('name', 'attributes[' + attribute.type + ']' + '[' + attribute.name + ']');
                        input.setAttribute('maxlength', 100);
                        input.setAttribute('placeholder', 'Enter the value');

                        label.innerHTML = attribute.name;
                        wrapper.appendChild(textWrapper);
                        wrapper.appendChild(inputWrapper);
                        textWrapper.appendChild(label);
                        inputWrapper.appendChild(input);

                        $('.attributes-container').append(wrapper);
                    })
                }

                return resolve();
            }
        });
    }
};