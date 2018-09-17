<tr class="order">
    <input type="hidden" class="orders" value="{{$order->id}}" name="order_id[]">
    <input type="hidden" class="order-amount" name="order-amount" value="{{CalculatorHelper::orderAmount($order)}}">
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
            <button class='delete-product btn btn-danger'>
                <i class="glyphicon glyphicon-trash"></i>
            </button>
        </div>
    </td>
</tr>