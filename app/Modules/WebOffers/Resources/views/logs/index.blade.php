@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Logs</h1>
        {{ Breadcrumbs::render('logs') }}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Logs table</h3>
            </div>

            <div class="box-body">
                @include('logs.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

