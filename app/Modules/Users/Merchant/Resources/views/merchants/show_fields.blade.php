<div class="form-group">
    <p>
        {!! Form::label('first_name', 'First Name:') !!}
        {!! $merchant->first_name !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('last_name', 'Last Name:') !!}
        {!! $merchant->last_name !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('email', 'Email:') !!}
        {!! $merchant->email !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('country', 'Country:') !!}
        {!! $merchant->address->country !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('state', 'State:') !!}
        {!! $merchant->address->state !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('city', 'City:') !!}
        {!! $merchant->address->city !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('street', 'Street:') !!}
        {!! $merchant->address->street !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('zipcode', 'Zip code:') !!}
        {!! $merchant->address->zipcode !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('created_at', 'Registered:') !!}
        {!! DateConverter::date($merchant->created_at) !!}
    </p>
</div>
