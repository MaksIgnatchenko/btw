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
                <div class="table-custom__delivery-price">{{ __('orders.order_details.delivery_price') }}</div>
                <div class="table-custom__quantity">{{ __('orders.order_details.quantity') }}</div>
                <div class="table-custom__amount">{{ __('orders.order_details.amount') }}</div>
                <div class="table-custom__status">{{ __('orders.order_details.status') }}</div>
            </div>
            <!-- body line -->
            <div class="table-custom__line table-custom__line--body">
                <div class="table-custom__prod">
                    <p class="table-custom__mobile-title">{{ __('orders.order_details.product') }}</p>
                    <a href="{{route('products.show', $order->product->id)}}" class="order product_link">
                        {{ $order->product->name }}
                    </a>
                </div>
                <div class="table-custom__purchase">
                    <p class="table-custom__mobile-title">{{ __('orders.order_details.purchase_date') }}</p>
                    {{ OrderViewHelper::formatDate($order->created_at) }}
                </div>
                <div class="table-custom__price">
                    <p class="table-custom__mobile-title">{{ __('orders.order_details.price') }}</p>
                    ${{ $order->product->price }}
                </div>
                <div class="table-custom__delivery-price">
                    <p class="table-custom__mobile-title">{{ __('orders.order_details.delivery_price') }}</p>
                    ${{ $order->product->delivery_price }}
                </div>
                <div class="table-custom__quantity">
                    <p class="table-custom__mobile-title">{{ __('orders.order_details.quantity') }}</p>
                    {{ $order->quantity }}
                </div>
                <div class="table-custom__amount">
                    <p class="table-custom__mobile-title">{{ __('orders.order_details.amount') }}</p>
                    ${{ $order->amount }}
                </div>
                <div class="table-custom__status">
                    <p class="table-custom__mobile-title">{{ __('orders.order_details.status') }}</p>
                    {{ $orderStatuses[$order->status] }}
                </div>
            </div>
        </div><!-- /. end custom table -->

    </div>

    @if($order->canBeShipped())

        <div class="t-a-right">
            <a class="btn update-order">{{__('orders.order_details.shipped')}}</a>
        </div>
        <div class="t-a-center">
            <p class="order-hint">{{ __('orders.order_details.change_status_description') }}</p>
        </div>

        <div class="o-popup-wrapper">
            <div class="o-popup-cont">
                <button class="o-popup-close" id="o-btn-close">Close</button>

                {!! Form::model(null, ['route' => ['web.orders.update', $order->id], 'class' => 'o-popup-form', 'method' => 'POST','id'=>'shipp-order']) !!}

                <div class="o-form-line">
                    <p class="o-form-title">{{__('orders.order_details.enter_tracking_number')}}</p>
                </div>

                <div class="o-form-line">
                    <p>{!! Form::text('tracking_number', null,  ['class' => 'o-form-title']) !!}</p>
                    @if ($errors->has('tracking_number'))
                        <p class="o-form-error">{{ $errors->first('tracking_number') }}</p>
                    @endif
                </div>

                <input type="hidden" name="_method" value="put"/>
                {!! csrf_field() !!}

                <div class="o-form-line">
                    <button class="o-form-btn">{{__('orders.order_details.done')}}</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>

    @endif

</div><!-- /.end order body -->
