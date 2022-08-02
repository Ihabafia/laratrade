<li class="nav-main-item">
    <a class="nav-main-link {{ active($route ?? '') ? 'active':'' }}" href="{{ isset($route) ? route($route) : '#' }}">
        @isset($icon)
        <i class="nav-main-link-icon {{ $icon }}"></i>
        @endisset
        <span class="nav-main-link-name">{{ $title }}</span>
    </a>
</li>
