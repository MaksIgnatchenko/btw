@extends('layouts.merchants.app')

@section('content')
    <!-- Main -->
    <div class="main store-page">
        <div class="container">
            <h1 class="page-title">Create your free store today</h1>

            {!! Form::open([
            'route' => 'merchant.registration.set-account-info',
            'method' => 'post',
            'class' => 'form-min',
            'name' => 'create-store-form',
            ]) !!}

            <div class="form-content position-relative">
                <p>
                    {!! Form::text('store', null, ['placeholder' => 'Store name']) !!}
                </p>
                @if ($errors->has('store'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('store') }}</strong></div>
                @endif
            </div>
            <div class="form-content position-relative">
                <p>
                    {!! Form::email('email', null, ['placeholder' => 'Email']) !!}
                </p>
                @if ($errors->has('email'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('email') }}</strong></div>
                @endif
            </div>
            <div class="form-content position-relative">
                <p>
                    {!! Form::password('password', ['placeholder' => 'Password']) !!}
                </p>
                @if ($errors->has('password'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('password') }}</strong></div>
                @endif
            </div>
            <div class="form-multiple">
                <div class="form-multiple-cont">
                    <p>
                        <input type="text" name="store-code" placeholder="Enter the code in the picture">
                    </p>
                </div>
                <div class="from-multiple-code">
                    <span>46q12R</span>
                </div>
            </div>
            {!! Form::submit('Create Store', ['class' => 'form-content']) !!}

            {!! Form::close() !!}

            <div class="reg-store-bottom">
                <span>Already have an account?</span>
                <a href="{{route('merchant.login')}}">Login Here</a>
            </div>
        </div>
    </div><!-- /. end header -->
@endsection