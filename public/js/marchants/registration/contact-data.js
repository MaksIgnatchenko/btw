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

    if ($('select[name=country]').val() && $('select[name=country]').val() !== '0') {
        console.log('!!!')
        // OnCountryChange.call($('select[name=country]'));
    }

});


