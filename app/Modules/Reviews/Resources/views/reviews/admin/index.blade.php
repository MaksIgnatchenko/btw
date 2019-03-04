@extends('layouts.app')
@section('title', 'Reviews')

@section('content')

    <div class="breadcrumb-container pull-right">
        {{ Breadcrumbs::render('reviews', $type) }}
    </div>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box">
            <div class="box-body">
                @include('reviews.admin.table')
            </div>
        </div>
    </div>
@endsection
