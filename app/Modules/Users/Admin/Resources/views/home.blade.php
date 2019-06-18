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

        <div class="row" style="display:flex;">
            <div class="col-md-6 def-oi">
                <h4 class="mt-0 header-title"><i class="fa fa-globe-stand"></i>Orders map</h4>
                <div id="map"  style="height: 400px"></div>
            </div>
            <div class="col-md-6 def-oi">
                <div class="top-chart-flex-container">
                    <h4 class="mt-0 header-title">Sales analytics</h4>
                    <h4 id="#datetimepicker9"><i class="glyphicon glyphicon-calendar"></i></h4>
                </div>
                <div id="chart"></div>

            </div>
        </div>

    <script>
        $(function () {
            ('#sales-year-picker').datepicker();
            var regionsStatistic = {!! $statistic->getOrdersCountByRegions() !!};

            map = new jvm.Map({
                map: 'us_aea',
                container: $('#map'),
                backgroundColor: 'white',
                series: {
                    regions: [{
                        attribute: 'fill',
                        values: regionsStatistic,
                        scale: ['#C8EEFF', '#0071A4'],
                        normalizeFunction: 'linear'
                    }]
                },
                regionStyle: {
                    initial: { fill: '#d2d6de' },
                    hover: { fill: '#A0D1DC' }
                },
                onRegionTipShow: function(e, el, code){
                    let value = code in regionsStatistic ? regionsStatistic[code] : 0;
                    el.html(el.html()+' (Orders - ' + value + ')');
                }
            });

            var months = {
                1 : 'Jan',
                2 : 'Feb',
                3 : 'Mar',
                4 : 'Apr',
                5 : 'May',
                6 : 'Jun',
                7 : 'Jul',
                8 : 'Aug',
                9 : 'Sep',
                10 : 'Oct',
                11 : 'Nov',
                12 : 'Dec'
            };

            function monthNumberToName(number) {
                var num = +number;
                return months[num];
            }

            $.ajax({
                type: "GET",
                url: "/admin/sales-analytics",
                data: "{}",
                contentType: "application/json",
                dataType: "json",
                async: "true",
                cache: "false",
                success: function (result) {
                    OnSuccess(result);
                },
                error: function (xhr, status, error) {
                    alert(error);
                }
            });

            function OnSuccess(data) {
                c3.generate({
                    bindto: '#chart',
                    data: {
                        type: 'bar',
                        x: 'month',
                        columns: [
                            data.months,
                            data.orders,
                            data.customers
                        ],
                        colors: {
                            orders: '#2683d8',
                            customers: '#a8cdf0'
                        },
                    },
                    axis : {
                        x : {
                            tick: {
                                format: function (x) {return monthNumberToName(x); }
                            }
                        }
                    }
                });
            }
        });

    </script>
@endsection
