<li>
    <a href="{{route('my-profile.index')}}" class="{{ActiveLink::checkMyProfile() ? 'active' : ''}}"><i class="fa fa-dashboard"></i> <span>My Profile</span></a>
</li>
@if(CurrentUserPermission::check([RolesEnum::ADMIN]))
<li>
    <a href="{{route('users.index')}}" class="{{ActiveLink::checkUsers() ? 'active' : ''}}"><i class="fa fa-user"></i> <span>Users</span></a>
</li>
<li>
    <a href="{{route('admin.categories.index')}}" class="{{ActiveLink::checkCategories() ? 'active' : ''}}"><i class="fa fa-list"></i> <span>Categories</span></a>
</li>
@endif
@if(CurrentUserPermission::check([RolesEnum::ADMIN, RolesEnum::AUTHOR]))
<li>
    <a href="{{route('articles.index')}}" class="{{ActiveLink::checkArticles() ? 'active' : ''}}"><i class="fa fa-newspaper-o"></i> <span>Articles</span></a>
</li>
@endif
