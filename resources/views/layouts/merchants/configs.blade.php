@foreach($configs as $key => $value)
    @if (is_array($key))
        @each('layouts.merchants.configs', $key, 'configs')
    @else
        <input name="{{$key}}" data-value="{{$value}}" hidden>
    @endif
@endforeach