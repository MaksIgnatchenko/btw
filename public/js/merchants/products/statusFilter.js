$(function () {
    $('select[name="filter[product-status]"]').on('change', function () {
        $(this).closest('form').submit();
    });
});