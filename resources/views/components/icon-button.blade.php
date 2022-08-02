@php
$color ?? 'alt-primary';
$classAttributes = "btn btn-lg btn-".$color;
@endphp
<button {{ $attributes->merge(['type' => 'submit', 'class' => $classAttributes]) }}>
        <i class="fa fa-fw fa-{{$icon ?? ''}} me-1 opacity-50"></i> {{ $slot }}
</button>
