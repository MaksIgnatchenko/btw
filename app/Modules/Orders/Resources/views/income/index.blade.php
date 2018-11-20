@extends('layouts.app')

@section('title', 'Income')

@section('content')

    <div class="breadcrumb-container pull-right">
        {{ Breadcrumbs::render('income-payments') }}
    </div>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Income payments</h3>
                    </div>

                    <div class="box-body">
                        @include('income.table')
                    </div>
                </div>
                <div class="text-center">
                </div>
            </div>

            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Statistic</h3>
                    </div>

                    <div class="box-body">
                        <p><strong>Payments count: </strong>{{$statistic->getCount()}}</p>
                        <p><strong>Payments amount: </strong>{{$statistic->getAmount()}}</p>
                        <p class="text-yellow"><strong>In Process: </strong>{{$statistic->getInProcess()}}</p>
                        <p class="text-green"><strong>Shipped: </strong>{{$statistic->getShipped()}}</p>
                    </div>
                </div>
                <div class="text-center">
                </div>
            </div>
        </div>
    </div>
@endsection

