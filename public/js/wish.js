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

