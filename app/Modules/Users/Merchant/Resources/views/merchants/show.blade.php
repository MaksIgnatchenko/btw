@extends('layouts.app')
@section('title', 'Management')
@section('content')

    <div class="content">

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Merchant details</h3>
                    </div>
                    <div class="box-body">
                        @include('merchants.show_fields')
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Merchant company details</h3>
                    </div>
                    <div class="box-body">
                        @include('merchants.company_info')
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection