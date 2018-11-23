$(document).ready(function () {

    var html = '<select class="form-control">' +
        "<option value=' '>All statuses</option>" +
        "<option value='in_process'>In process</option>" +
        "<option value='shipped'>Shipped</option>" +
        "</select>";

    $('#status-filter').html(html);

    $('#status-filter').change(function() {
        var searchValue = $(this).find('option:selected').val();
        $('#dataTableBuilder').DataTable().search(searchValue).draw();
    });

    $('.payment-search').find('.form-control').removeClass('input-sm');
});