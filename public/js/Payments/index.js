$(document).ready(function () {

    var html = '<select class="form-control">' +
        "<option value=' '>All statuses</option>" +
        "<option value='returned'>Returned</option>" +
        "<option value='refunded'>Refunded</option>" +
        "<option value='pending'>Pending pickup</option>" +
        "<option value='picked_up'>Picked up</option>" +

        "</select>";

    $('#status-filter').html(html);

    $('#status-filter').change(function() {
        var searchValue = $(this).find('option:selected').val();
        $('#dataTableBuilder').DataTable().search(searchValue).draw();
    });

    $('input[name=status]').attr('id', '_status');

    console.log('here');


    $('.payment-search').find('.form-control').removeClass('input-sm');
});