@extends('layouts.app')
@section('title', 'Merchants')

@section('content')

    <div class="breadcrumb-container pull-right">
        {{ Breadcrumbs::render('merchants') }}
    </div>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box">
            <div class="box-body">
                @include('merchants.admin.table')
            </div>
        </div>
    </div>
@endsection
