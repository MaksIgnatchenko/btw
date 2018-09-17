<!-- First Name Field -->

<div class="row">
    <div class="col-md-4">
        <img src="{{ ImagesPathHelper::getProductImagePath($product->main_image) }}" class="img-thumbnail"
             alt="Product image">

    </div>
    <div class="col-md-8">
        <div class="form-group">
            <p>
                {!! Form::label('name', 'Name:') !!}
                {!! $product->name !!}
            </p>
            <p>
                {!! Form::label('category_name', 'Category name:') !!}
                {!! $product->category->name !!}
            </p>
            <p>
                {!! Form::label('quantity', 'Quantity:') !!}
                {!! $order->quantity !!}
            </p>
            <p>
                {!! Form::label('price', 'Price:') !!}
                {!! $product->offer_price !!} USD
            </p>
            <p>
                {!! Form::label('tax', 'Tax:') !!}
                {!! $product->tax !!} %
            </p>
            <p>
                {!! Form::label('amount', 'Amount:') !!}
                {!! $product->amount !!} USD
            </p>
            <p>
                {!! Form::label('status', 'Status:') !!}
                {!! OrderStatusEnum::toArray()[$order->status] !!}
            </p>
            <p>
                {!! Form::label('created_at', 'Purchase date:') !!}
                {!! DateConverter::date($order->created_at) !!}
            </p>
            <p>
                {!! Form::label('redeemed_ar', 'Redemption date:') !!}
                {!! DateConverter::date($order->redeemed_at) ?? '<span class="text-red">Empty</span>' !!}
            </p>
            <p>
                {!! Form::label('return_details', 'Return policy date:') !!}
                {!! $product->return_details !!}
            </p>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('description', 'Description:') !!}
            <p>
                {!! $product->description !!}
            </p>
        </div>
    </div>
</div>
