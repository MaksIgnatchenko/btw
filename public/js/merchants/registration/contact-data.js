$(function () {
    $('.select-selected').each(function () {
        $(this).html($(this).siblings('select').find('option[selected]').html());
    });
    $('select[name=country]').on('change', OnCountryChange);
    $('select[name=state]').on('change', OnStateChange);

    function OnCountryChange() {
        _W.geography.ajaxGetData(
            {
                parent_id: $(this).find('[selected]').val(),
                data_type: _W.geography.objectTypes.STATE
            },
            function (data) {
                _W.selectHelper.fillSelectData($('select[name=state]'), data, 'State');
                $('select[name=state]').trigger('change')
            });
        _W.geography.ajaxGetCountryPhoneCode(
            {
                country_id: $(this).find('[selected]').val(),
            },
            function (data) {
                $('input[name=phone_code]').val(data);
            });
    }

    function OnStateChange() {
        _W.geography.ajaxGetData(
            {
                parent_id: $(this).find('[selected]').val(),
                data_type: _W.geography.objectTypes.CITY
            },
            function (data) {
                _W.selectHelper.fillSelectData($('select[name=city]'), data, 'City');
            }
        );
    }

    IMask(
        document.querySelector('input[name=phone_number]'), {
            mask: '000000000000'
        }
    );
});


