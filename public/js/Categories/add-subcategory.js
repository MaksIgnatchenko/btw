var $finalCheckbox = $('input[name=is_final]');

if ($finalCheckbox.is(':checked')) {
    $("#categories-additional-fields").css('display', 'block');
}

$finalCheckbox.on('click', function () {
    if ($finalCheckbox.is(':checked')) {
        $("#categories-additional-fields").css('display', 'block');
        return;
    }

    $("#categories-additional-fields").css('display', 'none');
});
