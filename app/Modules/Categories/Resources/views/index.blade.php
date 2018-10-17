@extends('layouts.app')
@section('title', 'Categories')

{{Html::style('css/Categories/categories.css')}}

@section('script')
    <script>
        function deleteCategory(el) {
            if (confirm('Are you sure? This option will delete all merchant subscribers!')) {
                $(el).parent('form').submit();
            }
        }
    </script>
@endsection

@section('content')

    <div class="content">
        @include('flash::message')

        <div class="clearfix"></div>

        @each('categories', $categories, 'category')

        <br>
        <div class='text-right'>
            <a href="{!! route('categories.add') !!}" class='btn btn-success'>Add root category</a>
        </div>

    </div>
@endsection

