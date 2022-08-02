<!-- BEGIN: Header-->
<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav {{ $mode === 'dark-layout' ? 'navbar-dark':'navbar-light' }} navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            {{--@if(current_route() == 'home.index')
                Welcome Back! Let's see how we are performing today.
            @endif--}}
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon" data-feather="menu"></i></a>
                </li>
            </ul>
            <div class="btn-group">
                @if(session('portfolios'))
                    <x-app.portfolio-selector/>
                @endif
            </div>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    @if($mode == 'dark-layout')
                    <i class="ficon" data-feather="sun"></i>
                    @else
                    <i class="ficon" data-feather="moon"></i>
                    @endif
                </a>
            </li>
            <li class="nav-item nav-search">
                <a class="nav-link nav-link-search">
                    <i class="ficon" data-feather="search"></i>
                </a>
                <div class="search-input">
                    <div class="search-input-icon">
                        <i data-feather="search"></i>
                    </div>
                    <input class="form-control input" type="text" placeholder="Type something..." tabindex="-1"
                           data-search="search">
                    <div class="search-input-close"><i data-feather="x"></i></div>
                    <ul class="search-list search-list-main"></ul>
                </div>
            </li>

            <x-app.profile-menu />
        </ul>
    </div>
</nav>
<!-- END: Header-->
