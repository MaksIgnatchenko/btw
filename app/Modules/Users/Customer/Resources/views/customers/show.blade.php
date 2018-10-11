@extends('layouts.app')

@section('content')


    <section class="content-header">
        <h1>Management</h1>
    </section>
    <div class="content">

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Customer info</h3>
                    </div>
                    <div class="box-body">
                        @include('customers.show_fields')
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
