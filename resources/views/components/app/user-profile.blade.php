<div class="dropdown d-inline-block ms-2">
    <button type="button" class="btn btn-sm btn-alt-secondary d-flex align-items-center"
            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
        @auth
            <img class="rounded-circle" src="{{ url('https://www.gravatar.com/avatar/'.md5(auth()->user()->email)) }}" alt="Header Avatar"
                 style="width: 21px;">
            <span class="d-none d-sm-inline-block ms-2">{{ auth()->user()->first_name }}</span>
            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
        @endauth
        @guest
            <span class="d-none d-sm-inline-block ms-2">Register / Login</span>
            <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ms-1 mt-1"></i>
        @endguest
    </button>
    <div class="dropdown-menu dropdown-menu-md dropdown-menu-end p-0 border-0"
         aria-labelledby="page-header-user-dropdown">
        @auth
            <div class="p-3 text-center bg-body-light border-bottom rounded-top">
                <img class="img-avatar img-avatar48 img-avatar-thumb"
                     src="{{ url('https://www.gravatar.com/avatar/'.md5(auth()->user()->email)) }}" alt="">
                <p class="mt-2 mb-0 fw-medium">{{ auth()->user()->full_name }}</p>
                <p class="mb-0 text-muted fs-sm fw-medium">Web Developer</p>
            </div>
            <div class="p-2">
                <a class="dropdown-item d-flex align-items-center justify-content-between"
                   href="javascript:void(0)">
                    <span class="fs-sm fw-medium">Inbox</span>
                    <span class="badge rounded-pill bg-primary ms-2">3</span>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between"
                   href="{{ route('profile.edit', auth()->user()) }}">
                    <span class="fs-sm fw-medium">Profile</span>
                    <span class="badge rounded-pill bg-primary ms-2">1</span>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between"
                   href="{{ route('setting.edit', auth()->user()) }}">
                    <span class="fs-sm fw-medium">Settings</span>
                </a>
            </div>
            <div role="separator" class="dropdown-divider m-0"></div>
        @endauth
        @guest
            <div class="p-2">
                <a class="dropdown-item d-flex align-items-center justify-content-between"
                   href="{{ route('register') }}">
                    <span class="fs-sm fw-medium">{{ __('general.register') }}</span>
                </a>
                <a class="dropdown-item d-flex align-items-center justify-content-between"
                   href="{{ route('login') }}">
                    <span class="fs-sm fw-medium">{{ __('general.login') }}</span>
                </a>
            </div>
        @endguest
        <div class="p-2">
            <a class="dropdown-item d-flex align-items-center justify-content-between"
               href="javascript:void(0)">
                <span class="fs-sm fw-medium">Lock Account</span>
            </a>
            @auth
                {{--Logout--}}
                <x-app.logout/>
            @endauth
        </div>
    </div>
</div>
