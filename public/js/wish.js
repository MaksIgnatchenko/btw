(function () {
    Geography = function () {
        this.objectTypes = {
            COUNTRY: 'country',
            STATE: 'state',
            CITY: 'city'
        };

        this.ajaxGetData = (function (params, callback) {
            $.get(
                '/service/geography/get',
                params,
                callback
                );
        }).bind(this);

        this.ajaxGetCountryPhoneCode = (function (params, callback) {
            $.get(
                '/service/geography/country-phone-code',
                params,
                callback
            );
        }).bind(this);
    };

    var SelectHelper = function () {
    };
    SelectHelper.fillSelectData = function (selectField, data, defaultValue) {
        selectField.empty();
        selectField.siblings('.select-items.select-hide').empty();
        var first = true;
        if (!$.isEmptyObject(data)) {
            for (var i in data) {
                var option = $('<option>').val(i).html(data[i]);
                if (first) {
                    first = false;
                    option.attr('selected', 'selected');
                    selectField.siblings('.select-selected').html(data[i]);
                }
                var selectItemDiv = $('<div>').html(data[i]);
                selectField.siblings('.select-items.select-hide').append(
                    selectItemDiv
                );
                selectItemDiv[0].addEventListener("click", function (e) {
                    divSelectClickEvent.call(this, e);
                });
                selectField.append(option);

            }
        } else {
            selectField.append($('<option>').html(defaultValue));
            selectField.siblings('.select-selected').html(defaultValue);
        }
    };

    this.geography = new Geography();
    this.selectHelper = SelectHelper;

    window._W = this;
})();

function getCategoryAttributes(id) {
    $.ajax({
        type:'GET',
        url:'/categories/' + id + '/attributes',
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
                    input.setAttribute('type', 'text');
                    input.setAttribute('name', 'attributes[' + attribute.type + ']' + '[' + attribute.name + ']' );
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
        }
    });
}
