@props([
    'condition' => false,
    'color' => 'info',
])

@if($condition)
{{--    <div class="mx-2">--}}
        <span class="badge rounded-pill badge-light-{{ $color }}">{{ $slot }}</span>
{{--    </div>--}}
@endif

