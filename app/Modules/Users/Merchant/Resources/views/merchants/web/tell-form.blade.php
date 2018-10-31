@extends('layouts.merchants.app')

@section('script')
    <script src="{{asset('js/marchants/registration/store-data.js')}}"></script>
@endsection

@section('title', __('merchants.page_titles.store_info'))

@section('footer-class', 'footer')

@section('header')
    @include('merchants.web.header')
@stop

@section('content')
    <!-- Main -->
    <div class="main tell-page">
        <div class="container">
            <h1 class="page-title">{{__('registration.store.title')}}</h1>
            {!! Form::open([
        'route' => 'merchant.registration.set-store-info',
        'method' => 'post',
        'class' => 'tell-form',
        'name' => 'tell-form',
        ]) !!}

            <h6 class="tell-form__title">{{__('registration.store.location_title')}}</h6>
            <div class="tell-form-wrapper">
                <div class="tell-form-country custom-select position-relative">
                    {!! Form::select('store_country', [__('registration.country')] + $countries->toArray(), Session::get('store_country')) !!}
                    @if ($errors->has('store_country'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('store_country') }}</strong></div>
                    @endif
                </div>
                <div class="tell-form-city position-relative">
                    <p>
                        {!! Form::text('store_city', Session::get('store_city'), ['placeholder' => __('registration.city')]) !!}
                    </p>
                    @if ($errors->has('store_city'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('store_city') }}</strong></div>
                    @endif
                </div>
            </div>
            <div class="form-group" hidden>
                {!! Form::select('categories[]', $categories, Session::get('categories'), ['class' => 'form-control', 'multiple']) !!}
            </div>
            <h6 class="tell-form__title">{{__('registration.store.product_categories')}}</h6>
            <div class="tell-form-wr-float">
                <div class="tell-form-category position-relative">
                    <p class="tell-form-category__display" id="category-title">{{__('registration.store.categories')}}</p>
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
            <h6 class="tell-form__title">{{__('registration.store.info')}}</h6>
            <div class="tell-form-area position-relative">
                {!! Form::textarea('info', Session::get('info'), ['placeholder' => __('registration.store.write_info'), 'rows'=> 8]) !!}
                @if ($errors->has('info'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('info') }}</strong></div>
                @endif
            </div>
            <div class="tell-form-btns">
                <button formaction="{{route('merchant.registration.restore-contact-info')}}" class="tell-form-btn tell-form-btn--uncolor">{{__('merchants.back')}}</button>

                {!! Form::submit('Enter my Store', ['class' => 'tell-form-btn tell-form-btn--color']) !!}

            </div>
            <p class="tell-form-attention">{!! __('registration.store.agreement', ['link' => '#']) !!}
            </p>

            {!! Form::close() !!}

        </div>
    </div><!-- /. end header -->
@endsection