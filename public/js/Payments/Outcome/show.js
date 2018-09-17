// I'm so sorry about this code((((

$(document).ready(function () {

    var $paymentDate = $('#payment_date');

    $paymentDate.datetimepicker({
        format: 'DD MMM YYYY'
    });

    $('#orders-table').on('click', '.delete-product', function () {
        $(this).parent().parent().parent().remove();
        calculateTotalAmount();
    });

    $('#add-product-modal').on('show.bs.modal', function () {

        $(".orders-modal").prop('checked', false);
        var $orderIds = $('.orders').map(function (idx, elem) {
            return $(elem).val();
        }).get();

        $(".orders-modal").each(function () {
            if ($orderIds.indexOf($(this).val()) !== -1) {
                $(this).prop('checked', true);
            }
        });
    });

    $('#add-orders-from-modal').on('click', function () {
        clearOrdersTable();

        var deleteButton = "<button class=\"delete-product btn btn-danger\">\n" +
            "                <i class=\"glyphicon glyphicon-trash\"></i>\n" +
            "                </button>";

        var $ordersModal = $('.orders-modal:checked').parent().parent();
        $ordersModalCloned = $ordersModal.clone();

        $ordersModalCloned.each(function () {
            $(this).removeClass('order-modal').addClass('order');

            $(this).find('.orders-modal').parent().remove();
            $(this).find('.box-tools').append(deleteButton);
            $(this).find('input').addClass('orders');
        });

        $('#orders-table').find('tbody').append($ordersModalCloned);
        calculateTotalAmount();

        $('#add-product-modal').modal('hide');
    });

    $('#merchant_id').on('change', function () {
        clearOrdersTable();
        clearModalOrdersTable();

        $.ajax({
            url: "/admin/payments/outcome/merchant-orders",
            method: 'GET',
            data: {
                merchant_id: $(this).val()
            }
        }).done(function (response) {

            var orders = '';

            response.orders.forEach(function (order, i, arr) {

                var redeemedAt = 'Empty';
                if (order.redeemed_at) {
                    redeemedAt = moment.utc(order.redeemed_at).local().format('d MMM YYYY');
                }

                orders += '<tr class="order-modal">' +
                    '<input type="hidden" value="' + order.id + '" name="order_id[]">' +
                    '<input type="hidden" class="order-amount" name="order-amount" value="' + getAmount(order).toFixed(2) + '">' +
                    '<td>' +
                    '<input type="checkbox" class="orders-modal" name="subscribe" value="' + order.id + '">' +
                    '</td>' +
                    '<th scope="row">' +
                    '<img src="/storage/images/products/thumbs/' + order.product.main_image + '" alt="Product image" width="80">' +
                    '</th>' +
                    '<td>' + order.product.name + '</td>' +
                    '<td>' + moment.utc(order.created_at).local().format('d MMM YYYY') + '</td>' +
                    '<td>' + redeemedAt + '</td>' +
                    '<td>' + order.customer.last_name + ' ' + order.customer.first_name + '</td>' +
                    '<td>' + order.product.return_details + '</td>' +
                    '<td>' + convertStatus(order.status) + '</td>' +
                    '<td>' +
                    '<div class="box-tools">' +
                    '<a href="/admin/payments/income/view/' + order.id + '" class="btn btn-info" target="_blank">' +
                    '<i class="glyphicon glyphicon-eye-open"></i>' +
                    '</a>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
            });

            $('#orders-table-modal').find('tbody').append(orders);
            calculateTotalAmount()
        });
    });

    function getAmount(order) {
        return (order.product.offer_price + order.product.offer_price / 100 * order.product.tax) * order.quantity;
    }

    function calculateTotalAmount() {
        var $modalOrderAmounts = $('#orders-table').find('.order-amount');
        var modalOrderAmount = 0;
        $modalOrderAmounts.map(function (idx, elem) {
            modalOrderAmount += parseFloat($(this).val());
        }).get();

        $('#amount').val(modalOrderAmount.toFixed(2));
        changeNetAmount();
    }

    function clearOrdersTable() {
        $('.order').remove();
    }

    function clearModalOrdersTable() {
        $('.order-modal').remove();
    }

    function convertStatus(status) {
        switch (status) {
            case 'picked_up':
                return 'Picked up';
            case 'pending':
                return 'Pending';
            case '__returned':
                return 'Returned';
            case '_refunded':
                return 'Refunded';
            default:
                return status;
        }
    }

    var changeNetAmount = function () {

        var amount = parseFloat($('#amount').val());
        var fee = parseFloat($('#fee').val());

        var netAmount = amount - amount * fee / 100;

        $('#net_amount').val(netAmount.toFixed(2));
    };

    $('#fee').on('change', changeNetAmount);
    $('#amount').on('change', changeNetAmount);


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
