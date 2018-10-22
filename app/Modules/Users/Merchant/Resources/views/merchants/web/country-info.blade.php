@extends('layouts.merchants.app')

@section('script')
    <script src="{{asset('js/marchants/registration/contact-data.js')}}"></script>
@endsection

@section('title', 'Contact info')

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

            <h6 class="contact-info__title">Add your contact information</h6>
            <div class="form-wrapper-half">
                <div class="form-content-half position-relative">
                    <p>
                        {!! Form::text('first_name', null, ['placeholder' => 'First name']) !!}
                    </p>
                    @if ($errors->has('first_name'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('first_name') }}</strong></div>
                    @endif
                </div>
                <div class="form-content-half position-relative">
                    <p>
                        {!! Form::text('last_name', null, ['placeholder' => 'Last name']) !!}
                    </p>
                    @if ($errors->has('last_name'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('last_name') }}</strong></div>
                    @endif
                </div>
            </div>

            <div class="form-content custom-select position-relative">
                {!! Form::select('country', ['Country/Region'] + $countries->toArray()) !!}
                @if ($errors->has('country'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ $errors->first('country') }}</strong></div>
                @endif
            </div>

            <div class="form-wrapper-half position-relative">
                <div class="form-content-half custom-select">
                    {!! Form::select('state', (!old('country')? ['State']:Geography::statesSelectValues(old('country'))), null) !!}
                    @if ($errors->has('country'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('country') }}</strong></div>
                    @endif
                </div>
                <div class="form-content-half position-relative">
                    <p>
                        {!! Form::text('street', null, ['placeholder' => 'Street address']) !!}
                    </p>
                    @if ($errors->has('street'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('street') }}</strong></div>
                    @endif
                </div>
            </div>
            <div class="form-wrapper-half">
                <div class="form-content-half custom-select position-relative">
                    {!! Form::select('city', (!old('state')? ['City']:Geography::citiesSelectValues(old('state')))) !!}
                    @if ($errors->has('city'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('city') }}</strong></div>
                    @endif
                </div>
                <div class="form-content-half position-relative">
                    <p>
                        {!! Form::text('zipcode', null, ['placeholder' => 'Zipcode/Postal code']) !!}
                    </p>
                    @if ($errors->has('zipcode'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $errors->first('zipcode') }}</strong></div>
                    @endif
                </div>
            </div>


            <h6 class="contact-info__title">Phone number</h6>
            <div class="contact-form-content-wr position-relative">
                <div class="contact-small-wrapper">
                    <p>
                        {!! Form::text('phone_code', null, ['placeholder' => 'Country', 'readonly']) !!}
                    </p>
                </div>
                <div class="contact-mid-wrapper">
                    <p>
                        {!! Form::text('phone_number', null, ['placeholder' => 'Number']) !!}
                    </p>
                </div>
                @if ($errors->has('phone_number'))
                    <div class="alert alert-danger alert-absolute" role="alert">
                        <strong>{{ $errors->first('phone_number') }}</strong></div>
                @endif
            </div>

            <div class="contact-form-content-wr"  style="margin-top: -40px;">
                <div class="contact-mid-wrapper">

                </div>
            </div>

            <div class="contact-form-example">
                <p>
                    <span class="contact-form-example__cont">Ex. + 1 - 234 - 5678910</span>
                    <span class="contact-form-example__cont">Ex. + 86 -- 13912345678</span>
                    <span class="contact-form-example__cont">Ex. + 86 - 21 - 65142545</span>
                </p>
            </div>
            {!! Form::submit('Next', ['class' => 'contact-form-submit']) !!}

            {!! Form::close() !!}
        </div>
    </div><!-- /. end header -->
@endsection