@extends('layouts.merchants.app')

@section('title', __('store.store'))

@section('body-class', 'body-shop')

@section('footer-class', 'footer-shop')

@section('header')
    @include('products.web.header')
@endsection

@section('script')
    <script src="{{asset('js/marchants/settings/scripts.js')}}"></script>
@endsection

scripts.js

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
                                <img src="{{ $merchant->avatar }}" alt="user icon">
                            </figure>
                            <div class="user-component__btn">
                                <span class="user-component__btn-icon">change image</span>
                            </div>
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
                    <div class="tabs-wrapper">
                        <!-- Tabs header -->
                        <ul class="tabs-header">
                            <li class="tabs-item tabs-item--active">
                                <a href="#" class="tabs-link">
                                <span class="tabs-link__icon">
                                    <img src="img/user-icon.svg" alt="user icon">
                                </span>
                                    My account setting
                                </a>
                            </li>
                            <li class="tabs-item">
                                <a href="#" class="tabs-link">
                                <span class="tabs-link__icon">
                                    <img src="img/store-icon.svg" alt="store icon">
                                </span>
                                    My store setting
                                </a>
                            </li>
                            <li class="tabs-item">
                                <a href="#" class="tabs-link">
                                <span class="tabs-link__icon">
                                    <img src="img/shield-icon.svg" alt="shield icon">
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
            'route' => 'merchant.registration.set-account-info',
            'method' => 'post',
            'name' => 'account-settings',
            ]) !!}

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Product name</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::text('first_name', null, ['class' => 'form-item__inp']) !!}
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Last name</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::text('last_name', null, ['class' => 'form-item__inp']) !!}
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">E-mail address</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::text('email', null, ['class' => 'form-item__inp']) !!}
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Country/Region</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            <div class="custom-select">
                                                {!! Form::select('country', $countries, $merchantCountry->id) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">State</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            <div class="custom-select">
                                                {!! Form::select('state', $states, $merchantStateId) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">City</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            <div class="custom-select">
                                                {!! Form::select('city', $cities ?? [__('registration.city')], $merchantCityId) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Street address</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::text('street', $merchant->address->street, ['class' => 'form-item__inp']) !!}
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Zip/postal code</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                            {!! Form::text('change-zip', $merchant->address->zipcode, ['class' => 'form-item__inp']) !!}
                                        </div>
                                    </div>

                                    <div class="form-line__wrapper form-line__wrapper--min-margin">
                                        <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                            <p class="form-item__title">Phone number</p>
                                        </div>
                                        <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings form-item__inner-wrapper">
                                            <div class="form-item__inner form-item__inner--mini">
                                                {!! Form::text('phone_code', $merchantCountry->phoneCode, ['class' => 'form-item__inp', 'readonly']) !!}
                                            </div>
                                            <div class="form-item__inner form-item__inner--large">
                                                {!! Form::text('phone', null, ['class' => 'form-item__inp']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="t-a-right tabs-form-btn">
                                    {!! Form::submit('Save', ['class' => 'btn btn--heavy']) !!}
                                    </div>

                                    {!! Form::close() !!}

                                </div>
                            </li><!-- /. end single tab -->

                            <!-- Single tab -->
                            <li class="tabs-item">
                                <div class="tabs-content">
                                    <form action="/" method="post" name="change-store">
                                        <div class="form-container-decor form-container-decor--file">
                                            <div class="form-container-decor-inner">
                                                <div class="form-container-decor-abs">
                                                    <p class="tabs-content__title"><span>Profile picture</span></p>
                                                    <div class="edit-photo-wrapper">
                                                        <label for="edit-photo" class="btn btn--heavy edit-photo-btn">Change
                                                            photo</label>
                                                        <input type="file" id="edit-photo" name="edit-photo"
                                                               accept=".jpg, .jpeg, .png">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-container-decor form-container-decor--colored">
                                            <p class="tabs-content__title"><span>Store setting</span></p>

                                            <div class="form-line__wrapper form-line__wrapper--min-margin">
                                                <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                                    <p class="form-item__title">Store name</p>
                                                </div>
                                                <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                                    <input class="form-item__inp" type="text" name="change-store-name"
                                                           minlength="3" maxlength="50" value="Appus" required>
                                                </div>
                                            </div>

                                            <div class="form-line__wrapper form-line__wrapper--min-margin">
                                                <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings"></div>
                                                <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                                    <p class="edit-line-desc">Where is your inventory/warehouse
                                                        located?</p>
                                                </div>
                                            </div>

                                            <div class="form-line__wrapper form-line__wrapper--min-margin">
                                                <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                                    <p class="form-item__title">Country</p>
                                                </div>
                                                <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings form-item__inner-wrapper">
                                                    <div class="form-item-inner form-item__inner--half">
                                                        <input class="form-item__inp" type="text" name="change-country"
                                                               minlength="3" maxlength="50" value="Ukraine" required>
                                                    </div>
                                                    <div class="form-item-inner form-item__inner--txt">City</div>
                                                    <div class="form-item-inner form-item__inner--half">
                                                        <input class="form-item__inp" type="text" name="change-city"
                                                               minlength="3" maxlength="50" value="Kharkiv" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-line__wrapper form-line__wrapper--min-margin">
                                                <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings"></div>
                                                <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                                    <p class="edit-line-desc">Product categories</p>
                                                </div>
                                            </div>

                                            <div class="form-line__wrapper form-line__wrapper--min-margin">
                                                <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                                    <p class="form-item__title">Categories</p>
                                                </div>
                                                <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                                    <div class="">
                                                        <input class="form-item__inp" type="text"
                                                               name="change-categories" minlength="3" maxlength="50"
                                                               value="Appus" required>
                                                    </div>
                                                    <div class="edit-labels">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-container-decor form-container-decor--colored">
                                            <p class="tabs-content__title"><span>Company info</span></p>
                                            <textarea class="edit-area" name="edit-msg" rows="10" required>Some text about company...</textarea>
                                        </div>

                                        <div class="t-a-right tabs-form-btn">
                                            <button class="btn btn--heavy">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </li><!-- /. end single tab -->

                            <!-- Single tab -->
                            <li class="tabs-item">
                                <div class="tabs-content tabs-content--colored">
                                    <p class="tabs-content__title"><span>Changes password</span></p>
                                    <form action="/" method="post" name="changes-password">
                                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                                            <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                                <p class="form-item__title">Old password</p>
                                            </div>
                                            <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                                <input class="form-item__inp" type="password" name="old-pass"
                                                       maxlength="25" required>
                                            </div>
                                        </div>

                                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                                            <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                                <p class="form-item__title">New password</p>
                                            </div>
                                            <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                                <input class="form-item__inp" type="password" name="new-pass"
                                                       maxlength="25" required>
                                            </div>
                                        </div>

                                        <div class="form-line__wrapper form-line__wrapper--min-margin">
                                            <div class="form-item__wrapper form-item__wrapper--text form-item__wrapper--text-settings">
                                                <p class="form-item__title">Confirm password</p>
                                            </div>
                                            <div class="form-item__wrapper form-item__wrapper--field form-item__wrapper--field-settings">
                                                <input class="form-item__inp" type="password" name="confirm-new-pass"
                                                       maxlength="25" required>
                                            </div>
                                        </div>

                                        <div class="t-a-right tabs-form-btn">
                                            <button class="btn btn--heavy">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </li><!-- /. end single tab -->

                        </ul><!-- /. end tabs body -->
                    </div><!-- /. end tabs wrapper -->
                </div>

            </div>
        </div><!-- /. main shop wrapper -->
    </div><!-- /. end main -->
@endsection