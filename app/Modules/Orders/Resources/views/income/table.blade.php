@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%']) !!}

@section('script')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
    {!! Html::style('css/Payments/index.css') !!}
    {!! Html::script('js/Payments/index.js') !!}

@endsection