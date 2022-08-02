
    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed {{ $mode === 'dark-layout' ? 'menu-dark':'menu-light' }} menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                    <a class="navbar-brand" href="{{ route('home.index') }}">
                        <span class="brand-logo">
                            <img class="logo" src="{{ asset("img/ltt-{$mode}-logo.svg") }}" width="220px;">
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main mt-3" id="main-menu-navigation" data-menu="menu-navigation">
                <x-sidebar.nav-item route="dashboard.index" icon="home" title="Dashboard" :actives="['dashboard.index']" />
                @hasanyrole(\App\Enums\RoleEnum::User->value)
                    <x-sidebar.nav-item route="assets.index" icon="list" title="Manage Assets" :actives="[
                        'assets.create', 'assets.edit', 'assets.index'
                    ]" />
                    <x-sidebar.nav-item route="move-cash.create" icon="dollar-sign" title="Move Cash" :actives="[
                        'move-cash.create'
                    ]" />
                    <x-sidebar.nav-item route="transactions.index" icon="trending-up" title="Manage Transactions" :actives="[
                        'transactions.create', 'transactions.edit', 'transactions.index'
                    ]" />
                @endhasrole
                @hasanyrole(\App\Enums\RoleEnum::Admin->value)
                    <x-sidebar.nav-head-title title="Webmaster" />
                    <x-sidebar.nav-item route="users.index" icon="users" title="Manage Users" :actives="[
                        'users.create', 'users.edit', 'users.index'
                    ]" />
                    <x-sidebar.nav-item route="communications.index" icon="message-square" title="Communications" :actives="[
                        'communications.create', 'communications.edit', 'communications.index'
                    ]" />
                    <x-sidebar.nav-item route="audits.index" icon="mouse-pointer" title="Audit Trail" :actives="['audits.index']" />
                    {{--<x-sidebar.nav-item route="crons.index" icon="circle" title="Manage Crons" :actives="[
                        'crons.index'
                    ]" />--}}
                @endhasanyrole
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->
