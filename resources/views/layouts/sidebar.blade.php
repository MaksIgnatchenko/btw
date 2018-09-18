<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <br><br>

    <div class="topbar-left">
        <div class="text-center">
            <img src="{{ asset('assets/images/logo.png') }}" height="50" alt="logo">
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                @include('layouts.menu')
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>