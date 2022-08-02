@auth
    <li class="nav-item dropdown dropdown-user">
        <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false">
            <div class="user-nav d-sm-flex d-none">
                <span class="user-name fw-bolder">{{ auth()->user()->full_name }}</span>
                <span class="user-status">{{ auth()->user()->role->label() }}</span>
            </div>
            <span class="avatar">
                <img class="avatar-content" src="{{ url('https://www.gravatar.com/avatar/'.md5(auth()->user()->email)) }}" alt="Header Avatar"
                     style="width: 32px;">
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
            <a class="dropdown-item" href="{{ route('profile.edit', auth()->user()) }}">
                <i class="me-50" data-feather="user"></i> Profile
            </a>
            <x-app.logout/>
            {{--<a class="dropdown-item" href="auth-login-cover.html">
                <i class="me-50" data-feather="power"></i> Logout
            </a>--}}
        </div>
    </li>
@endauth
