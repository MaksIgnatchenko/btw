<li class="{{\Route::current()->getName() === 'admin' ? 'active' : ''}}">
    <a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
</li>
<li class="{{\Route::current()->getName() === 'categories.index' ? 'active' : ''}}">
    <a href="{{route('categories.index')}}"><i class="mdi mdi-format-list-bulleted"></i> <span>Categories</span></a>
</li>
<li class="{{\Route::current()->getName() === 'content' ? 'active' : ''}}">
    <a href="{{route('content')}}"><i class="mdi mdi-book-open-page-variant"></i> <span>Terms & Condiotions</span></a>
</li>

