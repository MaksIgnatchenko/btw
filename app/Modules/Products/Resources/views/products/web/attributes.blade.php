@foreach(old('attributes') as $type => $attributes)
    @foreach($attributes as $name => $value)
        <div class="form-line__wrapper form-line__wrapper--min-margin">
            <div class="form-item__wrapper form-item__wrapper--text">
                <p class="form-item__title">{{ $name }}</p>
            </div>
            <div class="form-item__wrapper form-item__wrapper--field">
                <input class="form-item__inp" type="text" name="attributes[{{ $type }}][{{ $name }}]" maxlength="100" placeholder="Enter the value" value="{{ $value }}">
                @if($errors->has("attributes.$type.$name"))
                    <div class="alert alert-danger" role="alert"><strong>{{ $errors->first("attributes.$type.$name") }}</strong></div>
                @endif
            </div>
        </div>
    @endforeach
@endforeach