@props([
    'type' => '',
])
@if($type)
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a
            href="#" onclick="event.preventDefault(); this.closest('form').submit();"
            class="nav-main-link">
            <i class="nav-main-link-icon si si-logout"></i>
            <span class="nav-main-link-name">{{ __('forms.logout') }}</span>
        </a>
    </form>
@else
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a
            href="#" onclick="event.preventDefault(); this.closest('form').submit();"
            class="dropdown-item">
            <i class="me-50" data-feather="power"></i> {{ __('forms.logout') }}
        </a>
    </form>
@endif
