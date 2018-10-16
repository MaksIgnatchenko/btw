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

<!-- Email Field -->
<div class="form-group">
    <p>
        {!! Form::label('email', 'Email:') !!}
        {!! $customer->email !!}
    </p>
</div>

<!-- Address Field -->
<div class="form-group">
    <p>
        {!! Form::label('address', 'Address:') !!}
        {!! $customer->address !!}
    </p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <p>
        {!! Form::label('created_at', 'Registered:') !!}
        {!! $customer->created_at !!}
    </p>
</div>
