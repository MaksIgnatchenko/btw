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
<div class="form-group">
    <p>
        {!! Form::label('status', 'Status:') !!}
        {{Form::select(
        'user_status_select',
         ['active' => 'Active', 'pending' => 'Pending', 'inactive' => 'Inactive'],
          $customer->status,
          ['id' => 'user_status_select', 'data-user-url' => route('customers.update', $customer->id)]
      )}}
    </p>
</div>
<!-- Street Field -->
<div class="form-group">
    <p>
        {!! Form::label('street', 'Street:') !!}
        {!! optional($customer->deliveryInformation)->street !!}
    </p>
</div>

<!-- Apartment Field -->
<div class="form-group">
    <p>
        {!! Form::label('apartment', 'Apt, Suite, Unit:') !!}
        {!! optional($customer->deliveryInformation)->apartment !!}
    </p>
</div>

<!-- City Field -->
<div class="form-group">
    <p>
        {!! Form::label('city', 'City/Town:') !!}
        {!! optional($customer->deliveryInformation)->city !!}
    </p>
</div>

<!-- State Field -->
<div class="form-group">
    <p>
        {!! Form::label('state', 'State:') !!}
        {!! optional($customer->deliveryInformation)->state !!}
    </p>
</div>

<!-- Zip Field -->
<div class="form-group">
    <p>
        {!! Form::label('zip', 'zip:') !!}
        {!! optional($customer->deliveryInformation)->zip !!}
    </p>
</div>

<!-- Country Field -->
<div class="form-group">
    <p>
        {!! Form::label('country', 'Country:') !!}
        {!! optional($customer->deliveryInformation)->country !!}
    </p>
</div>

<!-- Phone Field -->
<div class="form-group">
    <p>
        {!! Form::label('phone', 'Phone:') !!}
        {!! optional($customer->deliveryInformation)->phone !!}
    </p>
</div>

<!-- Notes Field -->
<div class="form-group">
    <p>
        {!! Form::label('notes', 'Notes:') !!}
        {!! optional($customer->deliveryInformation)->notes !!}
    </p>
</div>

<!-- Created At Field -->
<div class="form-group">
    <p>
        {!! Form::label('created_at', 'Registered:') !!}
        {!! $customer->created_at !!}
    </p>
</div>
