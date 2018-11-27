/**
 * Product forms validator class
 *
 * @param form
 * @constructor
 */
var Validator = function (form, fields) {
    this.form = form;
    this.fields = fields;

    var _self = this;

    this.validate = function () {
        $('.alert.alert-danger').remove();
        for (var i = 0; i < this.fields.length; i++) {
            var field = this.fields[i];
            if (!validateRules(field)) {
                return false;
            }
        }
        return true;
    };

    var validateRules = function (field) {
        var fieldElement = $(`${field.type}[name='${field.name}']`);
        for (var rule in field.rules) {
            if (!field.rules[rule]) {
                continue;
            }
            switch (rule) {
                case 'notNull':
                    if (!fieldElement.val()) {
                        showErrorMessage(fieldElement, field.friendly_name);
                        return false
                    }
                    break;
            }
        }
        return true;
    };

    function showErrorMessage(element, fieldName) {
        if (fieldName === undefined) {
            fieldName = element.attr('name');
        }
        if (element.prop('tagName') === 'SELECT') {
            element = element.parent().find('.select-items');
        } else if (element.prop('tagName') === 'INPUT' && element.attr('type') === 'file') {
            element = element.parent().parent().parent();
        }
        var newElem = $('<div>')
            .addClass('alert')
            .addClass('alert-danger')
            .attr('role', 'alert');

        if (fieldName == 'category') {
            newElem.append(
                $('<strong>')
                    .html(`Please select a category.`)
            );
        } else {
            newElem.append(
                $('<strong>')
                    .html(`The ${fieldName} field is required`)
            );
        }

        element.after(newElem);
        $('html, body').animate({
            scrollTop: newElem.offset().top - 50
        }, 500);
    }
};
