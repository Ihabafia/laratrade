<li class="nav-main-item {{ isset($open) && $open ? 'open':'' }}">
    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true"
       aria-expanded="false" href="#">
        @isset($icon)
        <i class="nav-main-link-icon {{ $icon }}"></i>
        @endisset
        <span class="nav-main-link-name">{{ $title }}</span>
    </a>
    <ul class="nav-main-submenu">
        {{ $slot }}
    </ul>
</li>
