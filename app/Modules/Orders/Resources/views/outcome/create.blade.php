@extends('layouts.app')

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/Payments/Outcome/show.js"></script>
@endsection

@section('content')
    <section class="content-header">
        <h1>Product Review</h1>
                {{ Breadcrumbs::render('outcome-payment-create') }}

    </section>

    <div class="content">
        {!! Form::open(['route' => ['outcome.store'], 'method' => 'post' , 'class' => 'form-horizontal']) !!}

        <div class="row">
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Payment details</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group">
                            {!! Form::label('payment_type', 'Payment type:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('payment_type', PaymentOptionsEnum::toArray(), null, ['class' => 'form-control'])!!}
                                @if ($errors->has('payment_type'))
                                    <div class="text-red">{{ $errors->first('payment_type') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('merchant_id', 'Merchant:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::select('merchant_id', $merchantsFormatted->toArray(), null, [
                                'class' => 'form-control',
                                ])!!}
                                @if ($errors->has('merchant_id'))
                                    <div class="text-red">{{ $errors->first('merchant_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('amount', 'Amount:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('amount', null, ['class' => 'form-control'])!!}
                                @if ($errors->has('amount'))
                                    <div class="text-red">{{ $errors->first('amount') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('fee', 'Fee:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::number('fee', Outcome::DEFAULT_FEE, ['class' => 'form-control', 'step' => '0.01', 'min' => 0, 'max' => 100])!!}
                                @if ($errors->has('fee'))
                                    <div class="text-red">{{ $errors->first('fee') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('net_amount', 'Net amount:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::number('net_amount', 0.00, ['class' => 'form-control', 'readonly' => 'readonly'])!!}
                                @if ($errors->has('net_amount'))
                                    <div class="text-red">{{ $errors->first('net_amount') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('payment_date', 'Date:', ['class'=> 'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('payment_date', null, ['class' => 'form-control'])!!}
                                @if ($errors->has('payment_date'))
                                    <div class="text-red">{{ $errors->first('payment_date') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="pull-right">
                            {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Shopping cart</h3>
                    </div>

                    <div class="box-body">
                        @include('outcome.orders', ['merchantOrders' => $ordersFromOutcome])
                        <div class="text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#add-product-modal">
                                Add product
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

    <!-- Modal -->
        <div class="modal fade bs-example-modal-lg" id="add-product-modal" tabindex="-1" role="dialog"
             aria-labelledby="add-product-modal-label"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add-product-modal-label">Add to shopping cart</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('outcome.orders-modal', ['merchantOrders' => $merchantOrders])
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="add-orders-from-modal">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
