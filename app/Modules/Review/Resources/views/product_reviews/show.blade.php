@extends('layouts.app')

@section('scripts')
    <script>
        function deleteReview(el) {
            if (confirm('Are you sure?')) {
                $(el).parent('form').submit();
            }
        }
    </script>
@endsection

@section('content')
    <section class="content-header">
        <h1>Product Review</h1>
        {{ Breadcrumbs::render('product-review', $productReview) }}

    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product info</h3>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-3">
                            <div
                                    style="background-image: url('{{ImagesPathHelper::getProductImagePath($productReview->product->main_image)}}');
                                            width: 150px;
                                            height: 150px;
                                            border-radius: 50%;
                                            background-size: cover;">
                            </div>
                        </div>

                        <div class="col-sm-9">
                            <div>
                                <!-- Product name Field -->
                                <div class="form-group">
                                    <p>
                                        {!! Form::label('name', 'Product name:') !!}
                                        {!! $productReview->product->name !!}
                                    </p>
                                </div>

                                <!-- Regular price Field -->
                                <div class="form-group">
                                    <p>
                                        {!! Form::label('regular-price', 'Regular price:') !!}
                                        {!! $productReview->product->regular_price !!}
                                    </p>
                                </div>

                                <!-- Offer price Field -->
                                <div class="form-group">
                                    <p>
                                        {!! Form::label('offer_price-price', 'Offer price:') !!}
                                        {!! $productReview->product->offer_price !!}
                                    </p>
                                </div>

                                <!-- Regular price Field -->
                                <div class="form-group">
                                    <p>
                                        {!! Form::label('business_name', 'Business name:') !!}

                                        <a href="{{route('merchants.show', $productReview->product->user->merchant->id)}}">
                                            {{$productReview->product->user->merchant->business_name}}
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Review details</h3>
                    </div>

                    <div class="box-body">

                        {!! Form::model($productReview, ['route' => ['review.products.update', $productReview->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            {!! Form::label('customer', 'Customer:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                <p class="form-control-static">
                                    <a href="{{route('customers.show', $productReview->customer->id)}}">
                                        {{$productReview->customer->first_name . ' ' .  $productReview->customer->last_name}}
                                    </a>
                                </p>
                            </div>
                        </div>

                        <!-- Status Field -->
                        <div class="form-group">
                            {!! Form::label('status', 'Status:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('status', ReviewStatusEnum::toArray(), $productReview->status, ['class' => 'form-control'])!!}
                                @if ($errors->has('status'))
                                    <div class="text-red">{{ $errors->first('status') }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- Review Field -->
                        <div class="form-group">
                            {!! Form::label('review', 'Review:',  ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::textarea('review', null, ['class' => 'form-control',  'size' => '30x5','style' => 'resize:none']) !!}
                                @if ($errors->has('review'))
                                    <div class="text-red">{{ $errors->first('review') }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- Submit Field -->
                        <div class="text-right">

                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}

                            {!! Form::open(['route' => ['review.products.delete', $productReview->id], 'method' => 'delete','class' => 'inline']) !!}
                            <a href="#" class="btn btn-danger" onclick="deleteReview(this)" data-toggle="tooltip"
                               title="Delete review">
                                Delete review
                            </a>
                            {!! Form::close() !!}

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
