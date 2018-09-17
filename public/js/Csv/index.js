$(document).ready(function () {

    var $dateFrom = $('#date_from');
    var $dateTo = $('#date_to');

    $dateFrom.datetimepicker({
        format: 'DD MMM YYYY'
    });
    $dateTo.datetimepicker({
        format: 'DD MMM YYYY'
    });
});