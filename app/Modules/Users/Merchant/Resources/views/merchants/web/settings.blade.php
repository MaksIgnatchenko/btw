@extends('layouts.merchants.app')

@section('title', __('store.store'))

@section('body-class', 'body-shop')

@section('footer-class', 'footer-shop')

@section('header')
    @include('layouts.merchants.header', ['header_class' => 'header-black'])
@stop

@section('script')
    <script src="{{asset('js/merchants/settings/scripts.js')}}"></script>
    <script src="{{asset('js/PictureUploader.js')}}"></script>
@endsection

@section('content')
    <!-- Main -->
    <div class="main-shop">

    @include('layouts.merchants.navigation', ['active' => 'settings'])

    <!-- Main shop wrapper -->
        <div class="main-shop-wrapper">
            <div class="container">

                <!-- Header part -->
                <div class="settings-header">
                    <div class="settings-user user-component">
                        <div class="user-component__icon-bl">
                            <figure class="user-component__fig">
                                <img class="user-component__img"
                                     src="{{ $merchant->avatar ?? config('wish.storage.merchants.default_avatar_url') }}"
                                     alt="user icon">
                            </figure>
                            {!! Form::open([
                                'id' => 'form-user-avatar',
                                'files' => true,
                            ]) !!}
                            <div class="user-component__btn">
                                <label for="user-avatar" class="user-component__btn-icon
                                       @if ($merchant->avatar) user-component__btn-icon--del @endif">change image</label>
                                <input id="user-avatar" name="avatar" class="user-component__file" type="file"
                                @if ($merchant->avatar) disabled="disabled" @endif>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="user-component__title">
                            <p class="user-component__name">{{ $merchant->fullName }}</p>
                        </div>
                    </div>

                    <div class="settings-general">
                        <p class="settings-general__title">General settings</p>
                    </div>
                </div><!-- /. end header part -->

                <!-- Settings main -->
                <div class="settings-main">
                    <div class="tabs-wrapper clearfix">
                        <!-- Tabs header -->
                        <ul class="tabs-header">
                            <li class="tabs-item" data-page="account">
                                <a href="#" class="tabs-link">
                                <span class="tabs-link__icon">
                                    <img src="{{ asset('img/user-icon.svg') }}" alt="user icon">
                                </span>
                                    My account settings
                                </a>
                            </li>
                            <li class="tabs-item" data-page="store">
                                <a href="#" class="tabs-link">
                                <span class="tabs-link__icon">
                                    <img src="{{ asset('img/store-icon.svg') }}" alt="store icon">
                                </span>
                                    My store settings
                                </a>
                            </li>
                            <li class="tabs-item" data-page="password">
                                <a href="#" class="tabs-link">
                                <span class="tabs-link__icon">
                                    <img src="{{ asset('img/shield-icon.svg') }}" alt="shield icon">
                                </span>
                                    Changes password
                                </a>
                            </li>
                        </ul><!-- /. end tabs header -->

                        <!-- Tabs body -->
                        <ul class="tabs-body">

                            <!-- Single tab -->
                            <li class="tabs-item">
                                <div class="tabs-content tabs-content--colored">
                                    <p class="tabs-content__title"><span>Account Settings</span></p>

                                    {!! Form::model($merchant, [
                                    'route' => ['merchant.settings.account', 'page' => 'settings'],
                                    'method' => 'put',
                                    'name' => 'account-settings',
                                    ]) !!}

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">First name</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::text('first_name', null, ['class' => 'form-item__inp']) !!}
                                            @if ($errors->has('first_name'))
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>{{ $errors->first('first_name') }}</strong></div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Last name</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::text('last_name', null, ['class' => 'form-item__inp']) !!}
                                            @if ($errors->has('last_name'))
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>{{ $errors->first('last_name') }}</strong></div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">E-mail address</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::text('email', null, ['class' => 'form-item__inp']) !!}
                                            @if ($errors->has('email'))
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong></div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Country/Region</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            <div class="custom-select">
                                                {!! Form::select('country', $merchantSettingsDto->getCountries(), $merchantSettingsDto->getmerchantCountry()->id) !!}
                                                @if ($errors->has('country'))
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong>{{ $errors->first('country') }}</strong></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">State</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            <div class="custom-select">
                                                {!! Form::select('state', $merchantSettingsDto->getStates(), $merchantSettingsDto->getMerchantStateId()) !!}
                                                @if ($errors->has('state'))
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong>{{ $errors->first('state') }}</strong></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">City</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            <div class="custom-select">
                                                {!! Form::select('city', $merchantSettingsDto->getCities() ?? [], $merchantSettingsDto->getMerchantCityId(),
                                                ['placeholder' => __('registration.city')]) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Street address</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::text('street', $merchant->address->street, ['class' => 'form-item__inp']) !!}
                                            @if ($errors->has('street'))
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>{{ $errors->first('street') }}</strong></div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Zip/postal code</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::text('zipcode', $merchant->address->zipcode, ['class' => 'form-item__inp']) !!}
                                            @if ($errors->has('zipcode'))
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>{{ $errors->first('zipcode') }}</strong></div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Phone number</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings form-item__inner-wrapper">
                                            <div class="form-item__inner form-item__inner--mini">
                                                {!! Form::text('phone_code', $merchantSettingsDto->getMerchantCountry()->phoneCode, ['class' => 'form-item__inp', 'readonly']) !!}
                                                @if ($errors->has('phone_code'))
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong>{{ $errors->first('phone_code') }}</strong></div>
                                                @endif
                                            </div>
                                            <div class="form-item__inner form-item__inner--large">
                                                {!! Form::text('phone_number', $merchant->shortPhone, ['class' => 'form-item__inp']) !!}
                                                @if ($errors->has('phone_number'))
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong>{{ $errors->first('phone_number') }}</strong></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="t-a-right tabs-form-btn">
                                        <button class="account-settings submit btn btn--heavy">Save</button>
                                    </div>

                                    {!! Form::close() !!}

                                </div>
                            </li><!-- /. end single tab -->

                            <!-- Single tab -->
                            <li class="tabs-item">
                                <div class="tabs-content">
                                    <div class="form-container-decor form-container-decor--file">
                                        <div class="form-container-decor-inner">
                                            <div class="form-container-decor-abs"
                                                 style="background-image: url({{ $merchant->background_img }})">
                                                {!! Form::open([
                                                    'id' => 'form-background-img',
                                                    'files' => true,
                                                ]) !!}
                                                <p class="tabs-content__title"><span>Profile picture</span></p>
                                                <div class="edit-photo-wrapper">
                                                    <label for="edit-photo" class="btn btn--heavy edit-photo-btn">
                                                        @if ($merchant->background_img) Remove photo @else Add photo @endif
                                                        </label>
                                                    <input type="file" id="edit-photo" name="background_image"
                                                           @if ($merchant->background_img) disabled="disabled" @endif
                                                           accept=".jpg, .jpeg, .png">
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Description -->
                                    <p class="edit-photo-descr">*For a correct display of the background image, please
                                        download a rectangular image.</p>
                                    {!! Form::open([
                                    'route' => 'merchant.settings.store',
                                    'method' => 'put',
                                    'name' => 'change-store',
                                    ]) !!}

                                    <div class="form-container-decor form-container-decor--colored">
                                        <p class="tabs-content__title"><span>Store settings</span></p>

                                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                                            <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                                <p class="form-item__title">Store name</p>
                                            </div>
                                            <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                                {!! Form::text('name', $merchant->store->name, [
                                                'class' => 'form-item__inp',
                                                'minlength' => '3',
                                                'maxlength' => '50',
                                                'placeholder' => 'Store Name',
                                                'required'
                                                ]) !!}
                                                @if ($errors->has('name'))
                                                    <div class="alert alert-danger" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong></div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                                            <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings"></div>
                                            <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                                <p class="edit-line-desc">Where is your inventory/warehouse located?</p>
                                            </div>
                                        </div>

                                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                                            <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                                <p class="form-item__title">Country</p>
                                            </div>
                                            <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings form-item__inner-wrapper">
                                                <div class="form-item-inner form-item__inner--half">
                                                    <div class="custom-select">
                                                        {!! Form::select('store_country', $merchantSettingsDto->getCountries(), $merchantSettingsDto->getMerchantStoreCountry()->id) !!}
                                                    </div>
                                                    @if ($errors->has('store_country'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <strong>{{ $errors->first('store_country') }}</strong></div>
                                                    @endif
                                                </div>
                                                <div class="form-item-inner form-item__inner--txt">City</div>
                                                <div class="form-item-inner form-item__inner--half">
                                                    {!! Form::text('store_city', $merchant->store->city, [
                                                        'class' => 'form-item__inp',
                                                        'minlength' => '3',
                                                        'maxlength' => '50',
                                                        'placeholder' => 'Store City',
                                                        'required',
                                                    ]) !!}
                                                    @if ($errors->has('store_city'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <strong>{{ $errors->first('store_city') }}</strong></div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                                            <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings"></div>
                                            <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                                <p class="edit-line-desc">Product categories</p>
                                            </div>
                                        </div>

                                        <div class="form-line__wrapper form-line__wrapper--unic clearfix">
                                            <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings settings-item-float">
                                                <p class="form-item__title">Categories</p>
                                            </div>
                                            <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings settings-item-float-cont clearfix">
                                                <div class="edit-item__category-wr">
                                                    {!! Form::select('categories[]', $merchantSettingsDto->getCategories(), $merchantSettingsDto->getStoreCategories(), [
                                                    'class' => 'form-control',
                                                    'multiple',
                                                    'hidden',
                                                    'id' => 'edit-categories']) !!}

                                                    <p class="tell-form-category__display" id="category-title">
                                                        Categories</p>
                                                    <ul class="tell-form-category__list tell-form-category__list--close"
                                                        id="tell-categories">
                                                        @foreach ($merchantSettingsDto->getCategories() as $id => $name)
                                                            <li class="tell-form-category__item
                                                                @if(in_array($name, $merchantSettingsDto->getStoreDisabledCategories(), true)) tell-form-category__disabled @endif"
                                                                id="{{$id}}">{{$name}}</li>
                                                        @endforeach
                                                    </ul>
                                                    @if ($errors->has('categories'))
                                                        <div class="alert alert-danger" role="alert">
                                                            <strong>{{ $errors->first('categories') }}</strong></div>
                                                    @endif
                                                </div>
                                                <div class="edit-labels">
                                                    <ul class="tell-form-list"></ul>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-container-decor form-container-decor--colored">
                                        <p class="tabs-content__title"><span>Company info</span></p>
                                        {!! Form::textarea('info', $merchant->store->info, [
                                        'class' => 'edit-area',
                                        'rows' => '10',
                                        'required',
                                        ]) !!}
                                    </div>

                                    <div class="t-a-right tabs-form-btn">
                                        <button class="store-settings submit btn btn--heavy">Save</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </li><!-- /. end single tab -->

                            <!-- Single tab -->
                            <li class="tabs-item">
                                <div class="tabs-content tabs-content--colored">
                                    <p class="tabs-content__title"><span>Changes password</span></p>
                                    {!! Form::open([
                                    'route' => 'merchant.settings.password',
                                    'method' => 'put',
                                    'name' => 'changes-password',
                                    ]) !!}
                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Old password</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::password('old_password', [
                                            'class' => 'form-item__inp',
                                            'maxlength' => 25,
                                            'required',
                                            ]) !!}
                                            @if ($errors->has('old_password'))
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>{{ $errors->first('old_password') }}</strong></div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">New password</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::password('new_password', [
                                            'id' => 'new-pass',
                                            'class' => 'form-item__inp',
                                            'maxlength' => 25,
                                            'required',
                                            ]) !!}
                                            @if ($errors->has('new_password'))
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>{{ $errors->first('new_password') }}</strong></div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Confirm password</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::password('new_password_confirmation', [
                                            'id' => 'new-pass-confirm',
                                            'class' => 'form-item__inp',
                                            'maxlength' => 25,
                                            'required',
                                            ]) !!}
                                            @if ($errors->has('new_password_confirmation'))
                                                <div class="alert alert-danger" role="alert">
                                                    <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="t-a-right tabs-form-btn">
                                        <button class="settings-password submit btn btn--heavy">Save</button>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </li><!-- /. end single tab -->

                        </ul><!-- /. end tabs body -->
                    </div><!-- /. end tabs wrapper -->
                </div>

            </div>
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection