/**
 * Picture AJAX uploader class
 *
 * @param input
 * @constructor
 */
var PictureUploader = function (input) {
    this._input = input;
    this._container = input.parent();
    this._form = input.parents('form');

    this._imputName = input.attr('name');

    var _self = this;

    this._input.on('change', imageAdd);

    this._container.on('click', function () {
        if (_self._input.attr('disabled')) {
            imageRemove();
        }
    });

    function imageAdd(e) {
        var files = e.target.files;

        var formData = new FormData();

        switch (_self._imputName) {
            case 'avatar':
                formData.append(_self._imputName, files[0]);
                ajaxPostSendImage('settings/avatar', formData);
                break;
            case 'background_image':
                formData.append(_self._imputName, files[0]);
                ajaxPostSendImage('settings/background', formData);
                break;
        }
    }

    function ajaxPostSendImage(url, formData) {
        $.post({
            headers: {
                'X-CSRF-TOKEN': _self._form.find('input[name=_token]').val()
            },
            dataType: 'json',
            url: url,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            error: function(jqXHR) {
                showErrors(jqXHR.responseJSON.errors);
            }

        });
    }

    function imageRemove() {
        switch (_self._imputName) {
            case 'avatar':
                ajaxPostRemoveImage('settings/avatar', true);
                break;
            case 'background_image':
                ajaxPostRemoveImage('settings/background', false);
                break;
        }
    }

    function ajaxPostRemoveImage(url, updateButton) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': _self._form.find('input[name=_token]').val()
            },
            method: 'DELETE',
            url: 'settings/avatar',
            success: function (data, res) {
                updatePictureContainer(data);
                if (updateButton) {
                    _self._input.prev().removeClass('user-component__btn-icon--del');
                }
            }
        });
    }

    function updatePictureContainer(data) {
        switch (_self._input.attr('name')) {
            case 'avatar':
                _self._form.siblings('figure').find('img').attr('src', data.default_avatar_url);
                break;
            case 'edit-photo':
                _self._form.siblings('div.form-container-decor-abs').css('img').attr('background-image',);
        }
    }

    // TODO implement it
    function showErrors(errors) {
    }
};
