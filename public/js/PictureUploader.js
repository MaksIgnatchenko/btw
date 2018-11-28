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
        clearErrorMsg();

        var files = e.target.files;

        var formData = new FormData();

        switch (_self._imputName) {
            case 'avatar':
                _self.oldImageUrl =
                    _self._form.siblings('figure').find('img').attr('src');
                formData.append(_self._imputName, files[0]);
                ajaxPostSendImage('settings/avatar', formData);
                break;
            case 'background_image':
                _self.oldImageUrl =
                    _self._form.parent().css('background-image');
                formData.append(_self._imputName, files[0]);
                ajaxPostSendImage('settings/background', formData);
                break;
        }
    }

    function clearErrorMsg() {
        switch (_self._imputName) {
            case 'avatar':
                var target = _self._form.parent().siblings('div.user-component__title');
                break;
            case 'background_image':
                var target = _self._form.parents('.form-container-decor');
                break;
        }
        target.find('.alert.alert-danger').remove();
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
            success: function (data) {
                onUpdateImage(data);
            },
            error: function (jqXHR) {
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
            url: url,
            success: function (data) {
                onRemoveImage(data);
                if (updateButton) {
                    _self._input.prev().removeClass('user-component__btn-icon--del');
                }
            }
        });
    }

    function onRemoveImage(data) {
        switch (_self._input.attr('name')) {
            case 'avatar':
                _self._form.siblings('figure').find('img').attr('src', data.default_avatar_url);
                break;
            case 'background_image':
                _self._form.parent().css('background-image', '');
                _self._input.removeAttr('disabled').siblings('label').html('Add photo');
        }
        _self._input.removeAttr('disabled');
    }

    function onUpdateImage(data) {
        switch (_self._input.attr('name')) {
            case 'avatar':
                _self._form.siblings('figure').find('img').attr('src', data.avatar_url);
                break;
            case 'background_image':
                _self._form.parent().css('background-image', `url(${data.background_img_url})`);
        }
    }

    function showErrors(errors) {
        var target = null;
        switch (_self._imputName) {
            case 'avatar':
                target = _self._form.parent().siblings('div.user-component__title');
                _self._input.removeAttr('disabled').siblings('label').removeClass('user-component__btn-icon--del');
                if (!_self.oldImageUrl) {
                    _self.oldImageUrl = _W.defaultImages.merchantAvatar;
                }
                _self._form.siblings('figure').find('img').attr('src', _self.oldImageUrl);
                break;
            case 'background_image':
                target = _self._form.parents('.form-container-decor');
                var labelText = 'Add photo';
                if (_self.oldImageUrl !== 'none') {
                    labelText = 'Change photo';
                }
                _self._input.removeAttr('disabled').siblings('label').html(labelText);
                break;
        }
        if (target) {
            target.append($('<div>')
                .addClass('alert')
                .addClass('alert-danger')
                .attr('role', 'alert')
                .append(
                    $('<strong>')
                        .html(errors[_self._imputName][0])
                )
            );
        }
    }
};
