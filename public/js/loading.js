function disableAndAnimate(submitButton) {
    var buttonHeight = (submitButton.innerHeight());
    var buttonRightMargin = (submitButton.innerWidth() - buttonHeight) / 2;

    submitButton.prop('disabled', true);
    submitButton.addClass('loading');
    submitButton.css('margin-right', buttonRightMargin);
    submitButton.css('width', buttonHeight);
    submitButton.css('min-width', buttonHeight);
    submitButton.css('height', buttonHeight);
}

$(function () {
    function onFormSubmit(event, submitButton) {
        event.preventDefault();
        disableAndAnimate(submitButton);

        event.target.submit();
    }

    var form;

    if (form = document.querySelector('form[name="tell-form"]')) {
        form.addEventListener('submit', function (event) {
            onFormSubmit(event, $('.tell-form-btn.submit'));
        });
    }

    if (form = document.querySelector('form[name="changes-password"]')) {
        form.addEventListener('submit', function (event) {
            onFormSubmit(event, $('.settings-password.submit'));
        });
    }

    if (form = document.querySelector('form[name="account-settings"]')) {
        form.addEventListener('submit', function (event) {
            onFormSubmit(event, $('.account-settings.submit'));
        });
    }
});