<ul class="sidebar-menu" data-widget="tree">
    <li class="header">Main navigation</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="{{\Route::current()->getName() === 'admin' ? 'active' : ''}}">
        <a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <li class="treeview {{ActiveLink::checkReview() ? 'active' : ''}}">
        <a href="#"><i class="fa fa-flag"></i> <span>Reviews</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ActiveLink::checkProductReview() ? 'active' : ''}}">
                <a href="{{route('review.products.index')}}"><i class="fa fa-circle-o"></i>Product</a>
            </li>
            <li class="{{ActiveLink::checkMerchantReview() ? 'active' : ''}}">
                <a href="{{route('review.merchants.index')}}"><i class="fa fa-circle-o"></i>Merchant</a>
            </li>
        </ul>
    </li>

    <li class="treeview {{ActiveLink::checkManagement() ? 'active' : ''}}">
        <a href="#"><i class="fa fa-table"></i><span>Management</span>
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
            <li class="{{ActiveLink::checkCategories() ? 'active' : ''}}">
                <a href="{{route('categories.index')}}"><i class="fa fa-circle-o"></i>Categories</a>
            </li>
        </ul>
    </li>

    <li class="treeview {{ActiveLink::checkPayments() ? 'active' : ''}}">
        <a href="#"><i class="fa fa-dollar"></i> <span>Payments</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ActiveLink::checkIncome() ? 'active' : ''}}">
                <a href="{{route('payments.income.index')}}"><i class="fa fa-circle-o"></i>Income</a>
            </li>
            <li class="{{ActiveLink::checkOutcome() ? 'active' : ''}}">
                <a href="{{route('outcome.index')}}"><i class="fa fa-circle-o"></i>Payouts</a>
            </li>
        </ul>
    </li>

    <li class="{{ActiveLink::checkAdvert() ? 'active' : ''}}">
        <a href="{{route('adverts.index')}}"><i class="fa fa-star"></i> <span>Ad banner</span></a>
    </li>

    <li class="{{ActiveLink::checkLogs() ? 'active' : ''}}">
        <a href="{{route('logs.index')}}"><i class="fa fa-warning"></i> <span>Logs</span></a>
    </li>


    <li class="{{\Route::current()->getName() === 'content' ? 'active' : ''}}">
        <a href="{{route('content')}}"><i class="fa fa-book"></i> <span>Terms & conditions</span></a>
    </li>

    <li class="{{ActiveLink::checkCsv() ? 'active' : ''}}">
        <a href="{{route('csv.index')}}"><i class="fa fa-sticky-note-o"></i> <span>Csv</span></a>
    </li>

</ul>
