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
            {{--<p>--}}
                {{--{!! Form::label('category_name', 'Category name:') !!}--}}
                {{--{!! $product->category->name !!}--}}
            {{--</p>--}}
            <p>
                {!! Form::label('quantity', 'Quantity:') !!}
                {!! $order->quantity !!}
            </p>
            <p>
                {!! Form::label('amount', 'Price:') !!}
                {!! $product->price !!} USD
            </p>
            <p>
                {!! Form::label('amount', 'Amount:') !!}
                {!! $product->price * $order->quantity !!} USD
            </p>
            <p>
                {!! Form::label('status', 'Status:') !!}
                {!! OrderStatusEnum::toArray()[$order->status] !!}
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
