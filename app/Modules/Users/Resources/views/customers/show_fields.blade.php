<!-- First Name Field -->
<div class="form-group">
    <p>
        {!! Form::label('first_name', 'First Name:') !!}
        {!! $customer->first_name !!}
    </p>
</div>

<!-- Last Name Field -->
<div class="form-group">
    <p>
        {!! Form::label('last_name', 'Last Name:') !!}
        {!! $customer->last_name !!}
    </p>
</div>

<!-- Username Field -->
<div class="form-group">
    <p>
        {!! Form::label('username', 'Username:') !!}
        {!! $customer->user->username !!}
    </p>
</div>

<!-- Email Field -->
<div class="form-group">
    <p>
        {!! Form::label('email', 'Email:') !!}
        {!! $customer->user->email !!}
    </p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <p>
        {!! Form::label('created_at', 'Registered:') !!}
        {!! $customer->created_at !!}
    </p>
</div>

<!-- Address Field -->
<div class="form-group">
    <p>
        {!! Form::label('address', 'Address:') !!}
        {!! DisplayUsersHelper::displayAddress($customer->address) !!}
    </p>
</div>

<!-- Delivery Address Field -->
<div class="form-group">
    <p>
        {!! Form::label('delivery_address', 'Delivery Address:') !!}
        {!! DisplayUsersHelper::displayAddress($customer->deliveryAddress) !!}
    </p>
</div>