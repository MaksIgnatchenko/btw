@extends('layouts.merchants.app')

@section('script')
    <script src="{{asset('js/marchants/registration/store-data.js')}}"></script>
@endsection

@section('content')
    <!-- Main -->
    <div class="main tell-page">
        <div class="container">
            <h1 class="page-title">Tell us about your store</h1>
            {!! Form::open([
        'route' => 'merchant.registration.set-store-info',
        'method' => 'post',
        'class' => 'tell-form',
        'name' => 'tell-form',
        ]) !!}

            <h6 class="tell-form__title">Where is your inventory/warehouse located?</h6>
            <div class="tell-form-wrapper">
                <div class="tell-form-country custom-select position-relative">
                    {!! Form::select('store_country', ['Country'] + $countries->toArray()) !!}
                    @if ($errors->has('store_country'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('store_country') }}</strong></div>
                    @endif
                </div>
                <div class="tell-form-city position-relative">
                    <p>
                        {!! Form::text('store_city', null, ['placeholder' => 'City']) !!}
                    </p>
                    @if ($errors->has('store_city'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('store_city') }}</strong></div>
                    @endif
                </div>
            </div>
            <div class="form-group" hidden>
                {!! Form::select('categories[]', $categories, null, ['class' => 'form-control', 'multiple']) !!}
            </div>
            <h6 class="tell-form__title">Product Categories</h6>
            <div class="tell-form-wr-float">
                <div class="tell-form-category position-relative">
                    <p class="tell-form-category__display" id="category-title">Categories</p>
                    <ul class="tell-form-category__list tell-form-category__list--close" id="tell-categories">

                        @foreach ($categories as $id => $title)
                            <li class="tell-form-category__item" id="{{$id}}">{{$title}}</li>
                        @endforeach

                    </ul>
                    @if ($errors->has('categories'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('categories') }}</strong></div>
                    @endif
                </div>
                <div class="tell-form-labels">
                    <ul class="tell-form-list"></ul>
                </div>
            </div>
            <h6 class="tell-form__title">Company info</h6>
            <div class="tell-form-area position-relative">
                {!! Form::textarea('info', null, ['placeholder' => 'Write your info', 'rows'=> 8]) !!}
                @if ($errors->has('info'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('info') }}</strong></div>
                @endif
            </div>
            <div class="tell-form-btns">
                <button class="tell-form-btn tell-form-btn--uncolor">Back</button>

                {!! Form::submit('Enter my Store', ['class' => 'tell-form-btn tell-form-btn--color']) !!}

            </div>
            <p class="tell-form-attention">By clicking "Enter my store", you agree to <a href="#">Terms of Service</a>
            </p>

            {!! Form::close() !!}

        </div>
    </div><!-- /. end header -->
@endsection