@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Product details</h1>
        {{ Breadcrumbs::render('merchant-reviews') }}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box">
            <div class="box-body">
                @include('merchant_reviews.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

