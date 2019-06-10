@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

    <div class="clearfix"></div>

    @include('flash::message')


    <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-primary">
                    <span class="mini-stat-icon"><i class="mdi mdi-cart-outline"></i></span>
                    <div class="mini-stat-info text-right text-white">
                        <span class="counter">{{ $statistic->getOrdersCount() }}</span>
                        Total orders
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-primary">
                    <span class="mini-stat-icon"><i class="mdi mdi-cash"></i></span>
                    <div class="mini-stat-info text-right text-white">
                        <span class="counter">0</span>
                        Total payout requests
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-primary">
                    <span class="mini-stat-icon"><i class="mdi mdi-account"></i></span>
                    <div class="mini-stat-info text-right text-white">
                        <span class="counter">{{ $statistic->getMerchantsCount()}}</span>
                        Total merchants
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-3">
                <div class="mini-stat clearfix bg-primary">
                    <span class="mini-stat-icon"><i class="mdi mdi-currency-usd"></i></span>
                    <div class="mini-stat-info text-right text-white">
                        <span class="counter">{{ $statistic->getOverallIncome() }}</span>
                        Total income
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
