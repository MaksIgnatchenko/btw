@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

    <div class="clearfix"></div>

    @include('flash::message')
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Merchants map</h3>
        </div>
        <div class="box-body no-padding">
            <div class="row">
                <div class="col-md-9 col-sm-8">
                    <div id="map" style="width: 100%; height: 400px"></div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <div class="pad box-pane-right bg-green"
                         style="min-height: 400px; display: flex;justify-content: center;align-items: center;">
                        <div class="description-block margin-bottom">
                            <h5 class="description-header">Overall merchants registered</h5>
                            <h3 class="description-text">{{$statistic->getMerchantsCount()}}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-flag-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">New reviews to approve</span>
                            <span class="info-box-number">{{$statistic->getReviewsToApproveCount()}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Overall income</span>
                            <span class="info-box-number">${{$statistic->getOverallIncome()}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Merchant registration request</span>
                            <span class="info-box-number">{{$statistic->getPendingMerchantsCount()}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Overall products and services:
                        <strong>{{$statistic->getProductsCount()}}</strong>
                    </h3>
                </div>
                <div class="box-body no-padding">
                    <div class="row">
                        <canvas id="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="clearfix"></div>
    </div>

    <script>
        $(function () {
            var palette = ['#D2D6DF'];
            generateColors = function () {
                var colors = {},
                    key;

                for (key in map.regions) {
                    colors[key] = palette[Math.floor(Math.random() * palette.length)];
                }

                return colors;
            }, map;

            map = new jvm.Map({
                map: 'world_mill',
                container: $('#map'),
                backgroundColor: 'white',
                series: {
                    regions: [{
                        attribute: 'fill'
                    }]
                },
                markerStyle: {
                    initial: {
                        fill: '#0C7744',
                        stroke: '#383f47'
                    }
                },
                markers: {}
            });
            map.series.regions[0].setValues(generateColors());
        })
    </script>

    <script>
        var ctx = document.getElementById("chart").getContext('2d');

        var data = {
            datasets: [{
                data: {},
                backgroundColor: [
                    'red',
                    'green',
                    'blue',
                    'yellow',
                    'purple',
                    '#915C83',
                    '#D0FF14',
                    '#8F9779',
                    '#007FFF',
                    '#9C2542',
                    '#FE6F5E',
                    '#A41313',
                    '#00B9FB',
                    '#CFCFCF',
                    '#B5A642',
                    '#3399FF',
                    '#CD7F32'
                ]
            }],

            labels: {},
        };

        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: data,
            // options: options
        });

    </script>
@endsection
