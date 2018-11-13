<li class="{{ActiveLink::checkDasboard() ? 'active' : ''}}">
    <a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
</li>

<li class="{{ActiveLink::checkCategories() ? 'active' : ''}}">
    <a href="{{route('categories.index')}}"><i class="mdi mdi-format-list-bulleted"></i> <span>Categories</span></a>
</li>

<li class="treeview {{ActiveLink::checkManagement() ? 'active' : ''}}">
    <a href="#" class="treeview-toggle"><i class="fa fa-table"></i><span>Management</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ActiveLink::checkCustomers() ? 'active' : ''}}">
            <a href="{{route('customers.index')}}"><i class="fa fa-circle-o"></i>Customers</a>
        </li>
        <li class="{{ActiveLink::checkMerchants() ? 'active' : ''}}">
            <a href="{{route('merchants.index')}}"><i class="fa fa-circle-o"></i>Merchants</a>
        </li>
    </ul>
</li>

<li class="{{ActiveLink::checkCategories() ? 'active' : ''}}">
    <a href="{{route('payments.income.index')}}"><i class="fa fa-sign-in"></i> <span>Income</span></a>
</li>

<li class="{{ActiveLink::checkTermsAndConditions() ? 'active' : ''}}">
    <a href="{{route('content')}}"><i class="mdi mdi-book-open-page-variant"></i> <span>Terms & Conditions</span></a>
</li>

<li class="{{ActiveLink::checkAboutUs() ? 'active' : ''}}">
    <a href="{{route('content.about-us')}}"><i class="mdi mdi-book-open-page-variant"></i> <span>About Us</span></a>
</li>
