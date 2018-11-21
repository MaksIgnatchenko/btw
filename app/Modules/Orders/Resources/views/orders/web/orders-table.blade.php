<!-- Orders table -->
<div class="table-wrapper">
    <table class="table table-orders">
        <tr>
            <th class="col-order">{{ __('orders.table_head.order') }}</th>
            <th class="col-date">{{ __('orders.table_head.purchase_date') }}</th>
            <th class="col-customer">{{ __('orders.table_head.customer') }}</th>
            <th class="col-amount">{{ __('orders.table_head.amount') }}</th>
            <th class="col-status">{{ __('orders.table_head.status') }}</th>
            <th class="col-view"></th>
        </tr>
        @foreach($orders as $order)

            @include('orders.web.order', ['order' => $order])

        @endforeach
    </table>
</div><!-- /. end orders table -->