$(function () {
    $('select[name=country]').on('change', OnCountryChange);
    $('select[name=state]').on('change', OnStateChange);

    function OnCountryChange() {
        console.log($('select[name=country]'));
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

    new PictureUploader($('input[name=avatar]'));
    new PictureUploader($('input[name=background_image]'));

    /* Sync last chosen tab to session storage */
    $('a:not(.tabs-link)').on('click', function () {
        sessionStorage.removeItem('page');
    });

    $('a.tabs-link').on('click', function () {
        sessionStorage.setItem('page', $(this).data('page'));
    });

    /* Jump to last chosen tab */
    var sessionPage = sessionStorage.getItem('page');

    if(sessionPage) {
        $(`a.tabs-link[data-page=${sessionPage}]`)[0].click();
    }
});


