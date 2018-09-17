@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Income</h1>
        {{ Breadcrumbs::render('income-payments') }}
    </section>
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
                        <p class="text-yellow"><strong>Pending: </strong>{{$statistic->getPending()}}</p>
                        <p class="text-green"><strong>Picked up: </strong>{{$statistic->getPickedUp()}}</p>
                        <p class="text-danger"><strong>Returned: </strong>{{$statistic->getReturned()}}</p>
                        <p class="text-red"><strong>Refunded: </strong>{{$statistic->getRefunded()}}</p>
                        <p class="text-muted"><strong>Closed: </strong>{{$statistic->getClosed()}}</p>
                    </div>
                </div>
                <div class="text-center">
                </div>
            </div>
        </div>
    </div>
@endsection

