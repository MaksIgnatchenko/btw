<div class="form-group">
    <p>
        {!! Form::label('store_name', 'Store Name:') !!}
        {!! $merchant->store->name !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('country', 'Country:') !!}
        {!! $merchant->store->country !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('city', 'City:') !!}
        {!! $merchant->store->city !!}
    </p>
</div>
<div class="form-group">
    <p>
        {!! Form::label('categories', 'Categories:') !!}
        {!! CategoriesHelper::getNames($merchant->store->categories) !!}
    </p>
</div>