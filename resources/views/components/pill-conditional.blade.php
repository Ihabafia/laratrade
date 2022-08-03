@props([
    'condition' => false,
    'color' => 'success',
])

@if($condition)
{{--    <div class="mx-2">--}}
        <span class="badge rounded-pill badge-light-{{ $color }}">{{ $slot }}</span>
{{--    </div>--}}
@endif

