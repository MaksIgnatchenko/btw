<!-- Business Name Field -->
<div class="form-group">
    <p>
        {!! Form::label('business_name', 'Business Name:') !!}
        {!! $merchant->business_name !!}
    </p>
</div>

<!-- Username Field -->
<div class="form-group">
    <p>
        {!! Form::label('username', 'Username:') !!}
        {!! $merchant->user->username !!}
    </p>
</div>

<!-- Email Field -->
<div class="form-group">
    <p>
        {!! Form::label('email', 'Email:') !!}
        {!! $merchant->user->email !!}
    </p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <p>
        {!! Form::label('created_at', 'Registered:') !!}
        {!! DateConverter::date($merchant->created_at) !!}
    </p>
</div>

<!-- Address Field -->
<div class="form-group">
    <p>
        {!! Form::label('address', 'Address:') !!}
        {!! $merchant->address !!}
    </p>
</div>

<!-- Telephone Field -->
<div class="form-group">
    <p>
        {!! Form::label('telephone', 'Telephone:') !!}
        {!! $merchant->telephone !!}
    </p>
</div>

<!-- Telephone Field -->
<div class="form-group">
    <p>
        {!! Form::label('contact', 'Main contact:') !!}
        {!! $merchant->contact !!}
    </p>
</div>

<!-- Ein Field -->
<div class="form-group">
    <p>
        {!! Form::label('ein', 'Ein:') !!}
        {!! $merchant->ein !!}
    </p>
</div>

<!-- Check Field -->
<div class="form-group">
    <p>
        {!! Form::label('check', 'Verified:') !!}
        {!! $merchant->check !!}
    </p>
</div>

<!-- Payment Option Field -->
<div class="form-group">
    <p>
        {!! Form::label('payment_option', 'Payment Option:') !!}
        {!! $merchant->payment_option !!}
    </p>
</div>

<hr>

<h3>Payment details</h3>
{{-- Payment details --}}
@if (\App\Modules\Users\Enums\PaymentOptionsEnum::WIRE === $merchant->payment_option)
    <!-- Wire bank name Field -->
    <div class="form-group">
        <p>
            {!! Form::label('bank_name', 'Bank name:') !!}
            {!! $merchant->wire->bank_name !!}
        </p>
    </div>

    <!-- Wire aba number Field -->
    <div class="form-group">
        <p>
            {!! Form::label('bank_name', 'ABA number:') !!}
            {!! $merchant->wire->aba_number !!}
        </p>
    </div>

    <!-- Wire account name Field -->
    <div class="form-group">
        <p>
            {!! Form::label('account_name', 'Account name:') !!}
            {!! $merchant->wire->account_name !!}
        </p>
    </div>

    <!-- Wire account number Field -->
    <div class="form-group">
        <p>
            {!! Form::label('account_number', 'Account name:') !!}
            {!! $merchant->wire->account_number !!}
        </p>
    </div>
@elseif (\App\Modules\Users\Enums\PaymentOptionsEnum::PAYPAL === $merchant->payment_option)
    <!-- Paypal email Field -->
    <div class="form-group">
        <p>
            {!! Form::label('email', 'Paypal email:') !!}
            {!! $merchant->paypal->email !!}
        </p>
    </div>
@endif
