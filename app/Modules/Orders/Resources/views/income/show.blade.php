@extends('layouts.app')

@section('title', 'Income details')

@section('content')
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customer info</h3>
                    </div>
                    <div class="box-body">
                        @include('customers.admin.show_fields', ['customer' => $order->customer])
                    </div>
                </div>

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Merchant info</h3>
                    </div>
                    <div class="box-body">
                        @include('merchants.admin.show_fields', ['merchant' => $order->merchant])
                    </div>
                </div>

            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order details</h3>
                    </div>
                    <div class="box-body">
                        @include('income.show_fields', ['order' => $order, 'product' => $product])
                    </div>
                </div>

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Product details</h3>
                    </div>
                    <div class="box-body">
                    {!! Form::model($order, ['route' => ['payments.income.update', $order->id], 'method' => 'put']) !!}

                    <!-- Status Field -->
                        <div class="form-group col-md-6">

                            {{ Form::label(null, 'Status: ') }}
                            {!! Form::select('status', OrderStatusEnum::toArray(), $order->status, [
                                'class' => 'form-control' ,
                            ]) !!}
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                        <!-- Submit Field -->
                        <div class="form-group col-md-12">
                            <div class="pull-right">
                                {!! Form::submit('Save', [
                                    'class' => 'btn btn-success',
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'left',
                                ]) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! Html::script('js/Payments/Income/show.js') !!}
@endsection
