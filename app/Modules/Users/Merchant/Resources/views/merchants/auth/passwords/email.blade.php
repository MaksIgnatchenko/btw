@extends('layouts.merchants.app')

@section('title', __('merchants.page_titles.password_reset_request'))

@section('footer-class', 'footer')

@section('header')
    @include('merchants.web.header')
@stop

@section('content')
    <!-- Main -->
    <div class="main forgot-pass">
        <div class="forgot-wrapper">
            <h1 class="page-title">{{__('merchants.forgot_password')}}</h1>

            {!! Form::open([
        'route' => 'merchant.password.email',
        'method' => 'post',
        'class' => 'form-forgot',
        'name' => 'forgot-password-form',
        ]) !!}

            @if($errors->count())
                <div class="login-error-message">{{$errors->first()}}</div>
            @endif

            @if(Session::has('status'))
                <div class="login-error-message">{{Session::get('status')}}</div>
            @endif

            <div class="form-content form-content--min-margin">
                <p>
                    {!! Form::text('email', null, ['placeholder' => __('merchants.password_restore.email')]) !!}
                </p>
            </div>
            <p class="forgot-pass__info">{{__('merchants.password_restore.email_info')}}</p>
            <div class="form-content">
                <p>
                    {!! Form::submit(__('merchants.password_restore.reset_password')) !!}
                </p>
            </div>

            {!! Form::close() !!}

        </div>
    </div><!-- /. end header -->
@endsection