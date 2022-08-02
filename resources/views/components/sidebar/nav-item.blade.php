<li class="nav-item {{ activea($actives ?? '') ? 'active':'' }}">
    <a class="d-flex align-items-center" href="{{ isset($route) ? route($route) : '#' }}">
        @isset($icon)
        <i data-feather='{{ $icon }}'></i>
        @endisset
        <span class="menu-title text-truncate" data-i18n="{{ $title }}">{{ $title }}</span>
    </a>
</li>
