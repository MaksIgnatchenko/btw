@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Merchants</h1>
        {{ Breadcrumbs::render('merchants') }}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box">
            <div class="box-body">
                @include('merchants.table')
            </div>
        </div>
    </div>
@endsection

