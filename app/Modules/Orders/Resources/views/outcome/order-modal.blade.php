<tr class="order-modal">
    <input type="hidden" value="{{$order->id}}" name="order_id[]">
    <input type="hidden" class="order-amount" name="order-amount" value="{{CalculatorHelper::orderAmount($order)}}">
    <td>
        <input type="checkbox" class="orders-modal" name="subscribe" value="{{$order->id}}">
    </td>
    <th scope="row">
        <img src="{{ImagesPathHelper::getProductThumbPath($order->product->main_image)}}" alt="Product image" width="80">
    </th>
    <td>{{$order->product->name}}</td>
    <td>{{DateConverter::date($order->created_at)}}</td>
    <td>{{DateConverter::date($order->redeemed_at) ?? 'Empty'}}</td>
    <td>{{$order->customer->fisrt_name}} {{$order->customer->last_name}}</td>
    <td>{{$order->product->return_details}}</td>
    <td>{{OrderStatusEnum::toArray()[$order->status]}}</td>
    <td>
        <div class='box-tools'>
            <a href="{{ route('payments.income.view', $order->id) }}" class='btn btn-info' target="_blank">
                <i class="glyphicon glyphicon-eye-open"></i>
            </a>
        </div>
    </td>

</tr>