@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>Management</h1>
        {{ Breadcrumbs::render('merchant', $merchant) }}
    </section>
    <div class="content">

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="row">

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Merchant info</h3>
                    </div>
                    <div class="box-body">
                        @include('merchants.show_fields')
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Merchant details</h3>
                    </div>
                    <div class="box-body">
                    {!! Form::model($merchant, ['route' => ['merchants.change-status', $merchant->id], 'method' => 'put', 'class'=> 'form-inline']) !!}

                    <!-- Status Field -->
                        <div class="form-group col-md-6">
                            @if (\App\Modules\Users\Enums\MerchantStatusEnum::PENDING === $merchant->status)
                                <p class="text-warning">Merchant has pending status. Please verify account</p>
                            @endif

                            {{ Form::label('status', 'Status: ') }}
                            {!! Form::select('status', [
                            \App\Modules\Users\Enums\MerchantStatusEnum::NOT_ACTIVE => 'Not active',
                            \App\Modules\Users\Enums\MerchantStatusEnum::ACTIVE => 'Active',

                            ],$merchant->user->deleted_at ,['class' => 'form-control']) !!}
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
