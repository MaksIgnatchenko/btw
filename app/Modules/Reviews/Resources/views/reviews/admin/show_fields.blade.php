@include('flash::message')
{!! Form::open(['route' => ['reviews.update', 'type' => $type, 'id' => $review->id], 'method' => 'put', 'files' => true]) !!}
@if(\App\Modules\Reviews\Enums\ReviewTypesEnum::MERCHANT === $type)
    <div class="form-group">
        <p>
            {!! Form::label('merchant_name', 'Merchant Name:', []) !!}
            {!! $review->merchant->full_name!!}
        </p>
    </div>
    @elseif(\App\Modules\Reviews\Enums\ReviewTypesEnum::PRODUCT === $type)
    <div class="form-group">
        <p>
            {!! Form::label('product_name', 'Product Name:', []) !!}
            {!! $review->product->name!!}
        </p>
    </div>
    @endif
<div class="form-group">
    <p>
        {!! Form::label('customer_name', 'Customer Name:', []) !!}
        {!! $review->order->customer->full_name!!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('rating', 'Rating') !!}
        {!! Form::select('rating', array_combine(range(1,5), range(1,5)), $review->rating, ['class' => 'form-control']) !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('comment', 'Comment:') !!}
        {!! Form::textarea('comment', $review->comment, ['class' => 'form-control']) !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('created_at', 'Created At:') !!}
        {!! $review->created_at !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('status', 'Status:') !!}
        {!! Form::select('status', \App\Modules\Reviews\Enums\ReviewStatusEnum::toArray(), $review->status, ['id'=> 'status_select', 'class' => 'form-control']) !!}
    </p>
</div>
<div class="form-group text-right">
    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
</div>
{!! Form::close() !!}