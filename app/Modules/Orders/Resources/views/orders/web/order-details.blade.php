<!-- Order header -->
<div class="order-header">
    <p class="order__num">{{ __('orders.order_details.order') }} #{{ OrderViewHelper::formatOrderId($order->id) }}</p>
    <p class="order__nik">{{ $order->customer->full_name }}</p>
</div><!-- /. end order header -->

<!-- Order body -->
<div class="order-body">
    <div class="order-body__wr">

        <div class="table-custom">
            <!-- header line -->
            <div class="table-custom__line table-custom__line--header">
                <div class="table-custom__prod">{{ __('orders.order_details.product') }}</div>
                <div class="table-custom__purchase">{{ __('orders.order_details.purchase_date') }}</div>
                <div class="table-custom__price">{{ __('orders.order_details.price') }}</div>
                <div class="table-custom__quantity">{{ __('orders.order_details.quantity') }}</div>
                <div class="table-custom__amount">{{ __('orders.order_details.amount') }}</div>
                <div class="table-custom__status">{{ __('orders.order_details.status') }}</div>
            </div>
            <!-- body line -->
            <div class="table-custom__line table-custom__line--body">
                <div class="table-custom__prod"><p class="table-custom__mobile-title">{{ __('orders.order_details.product') }}</p>{{ $order->product->name }}</div>
                <div class="table-custom__purchase"><p class="table-custom__mobile-title">{{ __('orders.order_details.purchase_date') }}</p>{{ OrderViewHelper::formatDate($order->created_at) }}</div>
                <div class="table-custom__price"><p class="table-custom__mobile-title">{{ __('orders.order_details.price') }}</p>${{ $order->product->price }}</div>
                <div class="table-custom__quantity"><p class="table-custom__mobile-title">{{ __('orders.order_details.quantity') }}</p>{{ $order->quantity }}</div>
                <div class="table-custom__amount"><p class="table-custom__mobile-title">{{ __('orders.order_details.amount') }}</p>${{ OrderViewHelper::getAmount($order) }}</div>
                <div class="table-custom__status"><p class="table-custom__mobile-title">{{ __('orders.order_details.status') }}</p>{{ $orderStatusEnum[$order->status] }}</div>
            </div>
        </div><!-- /. end custom table -->

    </div>

    @if(!OrderViewHelper::isShipped($order))

        <div class="t-a-right">
            <a href="{{ route('web.orders.update', $order->id) }}" class="btn" onclick="event.preventDefault(); document.getElementById('update-status-form').submit();">{{ $orderStatusEnum[OrderStatusEnum::SHIPPED] }}</a>
        </div>
        <form id="update-status-form" action="{{ route('web.orders.update', $order->id) }}" method="post"
              style="display: none;">
            <input type="hidden" name="_method" value="put" />
            {!! csrf_field() !!}
        </form>
        <div class="t-a-center">
            <p class="order-hint">{{ __('orders.order_details.change_status_description') }}</p>
        </div>

    @endif

</div><!-- /.end order body -->
