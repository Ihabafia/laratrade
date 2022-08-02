@props([
    'color' => 'success',
])

<span class="fs-xs fw-semibold d-inline-block py-0 px-2 mx-2 rounded-pill bg-{{ $color }}-light text-{{ $color }}">
    {{ $slot ?? $label }}
</span>

