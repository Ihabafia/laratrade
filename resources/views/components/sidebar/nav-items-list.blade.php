<li class="nav-item has-sub {{ $open ? 'open':'' }}" style=""><a class="d-flex align-items-center" href="#"><i
            data-feather="menu"></i><span class="menu-title text-truncate" data-i18n="Menu Levels">{{$title}}</span></a>
    <ul class="menu-content">
        {{ $slot }}
    </ul>
</li>
