@extends('layouts.app')

{{Html::style('css/Categories/categories.css')}}

@section('scripts')
    <script>
        function deleteCategory(el) {
            if (confirm('Are you sure? This option will delete all merchant subscribers!')) {
                $(el).parent('form').submit();
            }
        }
    </script>
@endsection

@section('content')

    <section class="content-header">
        <h1>Categories</h1>
        {{ Breadcrumbs::render('categories') }}
    </section>
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

