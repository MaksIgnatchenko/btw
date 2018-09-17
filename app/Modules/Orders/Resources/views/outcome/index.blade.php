@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Payouts</h1>
        {{ Breadcrumbs::render('outcome-payments') }}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Outcome payments</h3>
                    </div>
                    <div class="box-body">
                        @include('product_reviews.table')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Statistic</h3>
                    </div>
                    <div class="box-body">
                        <p><strong>Payments count: {{$statistic->getCount()}}</strong></p>
                        <p><strong>Payments amount: {{$statistic->getAmount()}}</strong></p>
                        <div class="text-right">
                            <a href="{{route('outcome.create')}}" class="btn btn-success">Add new payout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
