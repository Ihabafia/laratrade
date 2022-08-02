<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav {{ $mode === 'dark-layout' ? 'navbar-dark':'navbar-light' }} navbar-shadow {{ auth()->user()->role->value !== 'Webmaster' && !session('active_product') ? 'container-xxl':'' }}">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>
            Welcome Back! Let's see how we are performing today.
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <div class="btn-group">
                @if(session('account_id'))
                    <x-app.product-selector/>
                @endif
            </div>
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    @if($mode == 'dark-layout')
                    <i class="ficon" data-feather="sun"></i>
                    @else
                    <i class="ficon" data-feather="moon"></i>
                    @endif
                </a>
            </li>
            <x-app.profile-menu />
        </ul>
    </div>
</nav>
<!-- END: Header-->
