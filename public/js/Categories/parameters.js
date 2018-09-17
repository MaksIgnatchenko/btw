$('#add-parameter').on('click', function () {

    var name = $('#parameter-value').find('option:selected').text().trim();
    var value = $('#parameter-value').val();

    if (isParameterAdded(name)) {
        $('#add-parameter-value-error').text('Already added. Please add another');

        return;
    }

    var parameter = new Parameter(value);
    var buttons = '<td>\n' +
        '    <button type="button" class="btn btn-default edit-parameter">\n' +
        '        <i class="fa fa-pencil"></i>\n' +
        '    </button>\n' +
        '    <button type="button" class="btn btn-danger drop-parameter">\n' +
        '        <i class="fa fa-times"></i>\n' +
        '    </button>\n' +
        '</td>';

    var htmlToInsert = '<tr><td>'
        + name
        + buttons
        + getHiddenParameterInput(parameter)
        + '</tr>';

    $('#add-parameter-modal').modal('hide');

    $('#parameters').find('tbody').append(htmlToInsert);
});


$('#add-parameter-modal').on('hide.bs.modal', function () {
    clearParametersModal();
});
$('#edit-parameter-modal').on('hide.bs.modal', function () {
    clearParametersModal();
});

$('#parameters').on('click', '.drop-parameter', function () {
    $(this).parent().parent().remove();
});

$('#parameters').on('click', '.edit-parameter', function () {

    var oldParameter = $(this).parent().parent().find('td:eq(0)').text();

    var parameterJson = $(this).parent().parent().find('input').val();
    var parameter = JSON.parse(parameterJson);

    $('#edit-old-parameter').val(oldParameter);
    $('#edit-parameter-value').val(parameter.name);

    $('#edit-parameter-modal').modal('show');
});

$('#save-edit-parameter').on('click', function () {

    var oldValue = $('#edit-old-parameter').val();

    var parameterText = $('#edit-parameter-value').find('option:selected').text().trim();
    var parameterValue = $('#edit-parameter-value').val();

    var parameter = new Parameter(parameterValue);
    var rowWithOldName = $('#parameters').find("td:contains('" + oldValue + "')");

    if (isParameterAdded(parameterText)) {
        $('#edit-parameter-value-error').text('Already added. Please add another');
        return;
    }

    rowWithOldName.parent().find('input').val(parameter);
    rowWithOldName.parent().find('td:eq(0)').text(parameterText);

    $('#edit-parameter-modal').modal('hide');
});

function Parameter(name) {
    this.name = name;
}

Parameter.prototype.toString = function () {
    return '{"name":"' + this.name + '"}';
};

function clearParametersModal() {
    // TODO вынести дефолтное значение
    $('#parameter-value').val('quantity');

    $('#edit-parameter-value-error').text('');
    $('#add-parameter-value-error').text('');
}

function isParameterAdded(name) {
    var isError = false;
    $('#parameters').find('tbody').find('td').each(function () {

        if ($(this).text() === name) {
            isError = true;
        }
    });

    return isError;
}

function getHiddenParameterInput(parameter) {
    return '<input type="hidden" name="parameters[]" value=\'' + parameter + '\'/>';
}
