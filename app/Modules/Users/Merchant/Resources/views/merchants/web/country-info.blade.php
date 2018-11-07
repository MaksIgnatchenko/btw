@extends('layouts.merchants.app')

@section('script')
    <script src="{{asset('js/marchants/registration/contact-data.js')}}"></script>
    <script src="https://unpkg.com/imask"></script>
@endsection

@section('title', __('merchants.page_titles.contact_info'))

@section('footer-class', 'footer')

@section('header')
    @include('merchants.web.header')
@stop

@section('content')
    <!-- Main -->
    <div class="main contact-page">
        <div class="container">
            {!! Form::open([
            'route' => 'merchant.registration.set-contact-info',
            'method' => 'post',
            'class' => 'contact-form',
            'name' => 'contact-form',
            ]) !!}

            <h6 class="contact-info__title">{{__('registration.contacts.title')}}</h6>
            <div class="form-wrapper-half">
                <div class="form-content-half position-relative">
                    <p>
                        {!! Form::text('first_name', Session::get('first_name'), ['placeholder' => __('registration.contacts.first_name')]) !!}
                    </p>
                    @if ($errors->has('first_name'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong></div>
                    @endif
                </div>
                <div class="form-content-half position-relative">
                    <p>
                        {!! Form::text('last_name', Session::get('last_name'), ['placeholder' => __('registration.contacts.last_name')]) !!}
                    </p>
                    @if ($errors->has('last_name'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong></div>
                    @endif
                </div>
            </div>

            <div class="form-content custom-select position-relative">
                {!! Form::select('country', [__('registration.contacts.country_region')] + $countries->toArray(), Session::get('country')) !!}
                @if ($errors->has('country'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('country') }}</strong></div>
                @endif
            </div>

            <div class="form-wrapper-half position-relative">
                <div class="form-content-half custom-select">
                    @if (Session::get('country'))
                        @php
                            $stateSelectValues = Geography::getStatesByCountryAsSelectArray(Session::get('country'));
                        @endphp
                    @endif
                    @if (old('state'))
                        @php
                            $stateSelectValues = Geography::getStatesByCountryAsSelectArray(old('country'));
                        @endphp
                    @endif

                    {!! Form::select('state', $stateSelectValues ?? [__('registration.contacts.state')], Session::get('state')) !!}
                    @if ($errors->has('state'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('state') }}</strong></div>
                    @endif
                </div>
                <div class="form-content-half position-relative">
                    <p>
                        {!! Form::text('street', Session::get('street'), ['placeholder' => __('registration.contacts.street')]) !!}
                    </p>
                    @if ($errors->has('street'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('street') }}</strong></div>
                    @endif
                </div>
            </div>
            <div class="form-wrapper-half">
                <div class="form-content-half custom-select position-relative">
                    @if (Session::get('country'))
                        @php
                            $citySelectValues = Geography::getCitiesByStateAsSelectArray(Session::get('state'));
                        @endphp
                    @endif
                    @if (old('state'))
                        @php
                            $citySelectValues = Geography::getCitiesByStateAsSelectArray(old('state'));
                        @endphp
                    @endif

                    {!! Form::select('city', $citySelectValues ?? [__('registration.city')], Session::get('city')) !!}
                    @if ($errors->has('city'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('city') }}</strong></div>
                    @endif
                </div>
                <div class="form-content-half position-relative">
                    <p>
                        {!! Form::text('zipcode', Session::get('zipcode'), ['placeholder' => __('registration.contacts.zipcode')]) !!}
                    </p>
                    @if ($errors->has('zipcode'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('zipcode') }}</strong></div>
                    @endif
                </div>
            </div>


            <h6 class="contact-info__title">{{__('registration.contacts.phone_title')}}</h6>
            <div class="contact-form-content-wr position-relative">
                <div class="contact-small-wrapper">
                    <p>
                        {!! Form::text('phone_code', Session::get('phone_code'), ['placeholder' => __('registration.country'), 'readonly']) !!}
                    </p>
                </div>
                <div class="contact-mid-wrapper">
                    <p>
                        {!! Form::text('phone_number', Session::get('phone_number'), ['placeholder' => __('registration.contacts.number')]) !!}
                    </p>
                </div>
                @if ($errors->has('phone_number'))
                    <div class="alert alert-danger alert-absolute" role="alert">
                        <strong>{{ $errors->first('phone_number') }}</strong></div>
                @endif
            </div>

            <div class="contact-form-example">
                <p>
                    <span class="contact-form-example__cont">{{__('registration.contacts.example')}} + 1 - 234 - 5678910</span>
                    <span class="contact-form-example__cont">{{__('registration.contacts.example')}} + 86 -- 13912345678</span>
                    <span class="contact-form-example__cont">{{__('registration.contacts.example')}} + 86 - 21 - 65142545</span>
                </p>
            </div>
            {!! Form::submit(__('registration.next'), ['class' => 'contact-form-submit']) !!}

            {!! Form::close() !!}
        </div>
    </div><!-- /. end header -->
@endsection