@extends('layouts.app')

@section('content')


    <section class="content-header">
        <h1>Management</h1>
        {{ Breadcrumbs::render('customer', $customer) }}
    </section>
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
                        @include('customers.show_fields')
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customer details</h3>
                    </div>
                    <div class="box-body">
                    {!! Form::model($customer, ['route' => ['customers.change-status', $customer->id], 'method' => 'put', 'class'=> 'form-inline']) !!}

                    <!-- Status Field -->
                        <div class="form-group col-md-6">
                            {{ Form::label('status', 'Status: ') }}
                            {!! Form::select('status',
                            CustomerStatusEnum::toArray(),
                            $customer->status,
                            ['class' => 'form-control'])
                            !!}
                        </div>
                        <!-- Submit Field -->
                        <div class="form-group col-md-12">
                            <div class="pull-right">
                                {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
