<li class="{{\Route::current()->getName() === 'admin' ? 'active' : ''}}">
    <a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
</li>
<li class="treeview {{ActiveLink::checkManagement() ? 'active' : ''}}">
    <a href="#" class="treeview-toggle"><i class="fa fa-table"></i><span>Management</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ActiveLink::checkCustomers() ? 'active' : ''}}">
            <a href="{{url('/admin/customers')}}"><i class="fa fa-circle-o"></i>Customers</a>
        </li>
        <li class="{{ActiveLink::checkMerchants() ? 'active' : ''}}">
            <a href="{{url('/admin/merchants')}}"><i class="fa fa-circle-o"></i>Merchants</a>
        </li>
    </ul>
</li>
<li class="{{\Route::current()->getName() === 'content' ? 'active' : ''}}">
    <a href="{{route('content')}}"><i class="mdi mdi-book-open-page-variant"></i> <span>Terms & Condiotions</span></a>
</li>
