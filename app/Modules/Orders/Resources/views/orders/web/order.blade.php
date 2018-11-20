<tr>
    <td class="col-order">{{ OrderViewHelper::formatOrderId($order->id) }}</td>
    <td class="col-date">{{ OrderViewHelper::formatDate($order->created_at) }}</td>
    <td class="col-customer">{{ $order->customer->full_name }}</td>
    <td class="col-amount">${{ OrderViewHelper::getAmount($order) }}</td>
    <td class="col-status">{{ $orderStatusEnum[$order->status] }}</td>
    <td class="col-view"><a href="{{ route('web.orders.show', $order->id) }}">{{ __('orders.view_order') }}</a></td>
</tr>