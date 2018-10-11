@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Customers</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box">
            <div class="box-body">
                @include('customers.table')
            </div>
        </div>
    </div>
@endsection
