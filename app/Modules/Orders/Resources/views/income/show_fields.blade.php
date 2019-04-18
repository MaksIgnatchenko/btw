<!-- First Name Field -->

<div class="row">
    <div class="col-md-4">
        <img src="{{ $product->main_image }}" class="img-thumbnail"
             alt="Product image">

    </div>
    <div class="col-md-8">
        <div class="form-group">
            <p>
                {!! Form::label('name', 'Name:') !!}
                {!! $product->name !!}
            </p>
            <p>
                {!! Form::label('quantity', 'Quantity:') !!}
                {!! $order->quantity !!}
            </p>
            <p>
                {!! Form::label('price', 'Price:') !!}
                {!! $product->price !!} USD
            </p>
            <p>
                {!! Form::label('delivery_price', 'Shipping price:') !!}
                {!! $product->delivery_price !!} USD
            </p>
            <p>
                {!! Form::label('amount', 'Amount:') !!}
                {!! $order->amount !!} USD
            </p>
            <p>
                {!! Form::label('status', 'Status:') !!}
                {!! OrderStatusEnum::toArray()[$order->status] !!}
            </p>
            <p>
                {!! Form::label('tracking_number', 'Tracking number:') !!}
                {!! $order->tracking_number !!}
            </p>
            <p>
                {!! Form::label('created_at', 'Purchase date:') !!}
                {!! DateConverter::date($order->created_at) !!}
            </p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
            <div class="product-description">
                {!! $product->description !!}
            </div>
        </div>
    </div>
</div>
