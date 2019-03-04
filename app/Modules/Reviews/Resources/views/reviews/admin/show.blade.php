@extends('layouts.app')
@section('title', 'Management')
@section('content')

    <div class="breadcrumb-container pull-right">
        {{ Breadcrumbs::render('reviews-edit', $type, $review) }}
    </div>

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
                        @include('reviews.show_fields', ['review' => $review])
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection