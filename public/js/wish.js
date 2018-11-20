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

    this.maxFileSize = $('#configs').find('input[name=image_max_size]').data('value');

    window._W = this;
})();

var searchSubmitCallback = function(event) {
    event.preventDefault();

    var searchText = $(this).find('input[name="search"]').val();

    if (searchText.length !== 0) {
        $(this).off('submit', searchSubmitCallback);
        $(this).submit();
    }
};

$('.shop-top-settings__form').on('submit', searchSubmitCallback);

var searchForm = $('.shop-top-settings__form');
var searchParams = new URLSearchParams(window.location.search);
var searchInput = $(searchForm).find('input[name="search"]');

if (searchParams.has('search')) {
    var resetButton = document.createElement('span');
    $(searchInput).addClass('reset');
    $(resetButton).addClass('reset-search');
    searchForm.append(resetButton);
}

$(resetButton).on('click', function() {
    document.location.href = '/orders';
});