// adding attribute
$('#add-attribute').on('click', function () {

    var name = $('#attribute-name').val().trim();
    var typeText = $('#attribute-type').find('option:selected').text().trim();
    var typeValue = $('#attribute-type').val().trim();


    if (name.length < 2 || name.length > 100) {
        $('#add-attribute-name-error').text('Name should be from 2 to 100 length');
        return;
    }

    var attribute = new Attribute(name, typeValue);

    var buttons = '<td>\n' +
        '    <button type="button" class="btn btn-default" id="edit-attribute">\n' +
        '        <i class="fa fa-pencil"></i>\n' +
        '    </button>\n' +
        '    <button type="button" class="btn btn-danger" id="drop-attribute">\n' +
        '        <i class="fa fa-times"></i>\n' +
        '    </button>\n' +
        '</td>';

    var htmlToInsert = '<tr><td>'
        + name
        + '</td><td>'
        + typeText
        + '</td>'
        + buttons
        + getHiddenInput(attribute)
        + '</tr>';

    $('#add-attribute-modal').modal('hide');

    $('#attributes').find('tbody').append(htmlToInsert);
});

$('#add-attribute-modal').on('hide.bs.modal', function () {
    clearAttributesModal();
});
$('#edit-attribute-modal').on('hide.bs.modal', function () {
    clearAttributesModal();
});

$('#attributes').on('click', '#drop-attribute', function () {
    $(this).parent().parent().remove();
});

$('#add-attribute-button').on('click', function () {
    $('#add-attribute-modal').modal('show');
});

$('#attributes').on('click', '#edit-attribute', function () {

    var attributeJson = $(this).parent().parent().find('input').val();
    var attribute = JSON.parse(attributeJson);

    $('#edit-old-name').val(attribute.name);
    $('#edit-attribute-name').val(attribute.name);
    $('#edit-attribute-type').val(attribute.type);

    $('#edit-attribute-modal').modal('show');
});

$('#save-edit-attribute').on('click', function () {

    var oldName = $('#edit-old-name').val().trim();
    var name = $('#edit-attribute-name').val().trim();
    var typeText = $('#edit-attribute-type').find('option:selected').text().trim();
    var typeValue = $('#edit-attribute-type').val().trim();

    var attribute = new Attribute(name, typeValue);

    var rowWithOldName = $('#attributes').find("td:contains('" + oldName + "')");

    if (name.length < 2 || name.length > 100) {
        $('#edit-attribute-name-error').text('Name should be from 2 to 100 length');
        return;
    }

    rowWithOldName.parent().find('input').val(attribute);
    rowWithOldName.parent().find('td:eq(1)').text(typeText);
    rowWithOldName.text(name);

    $('#edit-attribute-modal').modal('hide');
});

function Attribute(name, type) {
    this.name = name;
    this.type = type;
}

Attribute.prototype.toString = function () {
    return '{"name":"' + this.name + '","type":"' + this.type + '"}';
};

function clearAttributesModal() {
    $('#attribute-name').val('');
    $('#attribute-type').val('digits');

    $('#edit-attribute-name-error').text('');
    $('#add-attribute-name-error').text('');
}


function getHiddenInput(attribute) {
    return '<input type="hidden" name="attributes[]" value=\'' + attribute + '\'/>';
}
