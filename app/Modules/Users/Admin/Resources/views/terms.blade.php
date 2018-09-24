@extends('layouts.app')
@section('title', 'Terms & Condiotions')

@section('content')

    <div class="content">

        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">

                        {!! Form::model($privacyPolicy, [
                        'route' => ['terms.update', $privacyPolicy->id],
                        'method' => 'PUT'
                        ]) !!}

                        @include('privacy-policy.show_fields')

                        {!! Form::submit('Apply', ['class' => 'btn btn-danger btn-block']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box">
                    <div class="box-body">

                        {!! Form::model($privacyPolicy, [
                        'route' => ['privacy_policies.update', $privacyPolicy->id],
                        'method' => 'PUT'
                        ]) !!}

                        @include('privacy-policy.show_fields')

                        {!! Form::submit('Apply', ['class' => 'btn btn-danger btn-block']) !!}

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection