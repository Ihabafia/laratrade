@props(['url', 'color'])
@php
    if(isset($color)):
        switch ($color) {
            case 'success':
                $color = '#28a745';
                break;
            case 'danger':
            case 'red':
                $color = '#dc3545';
                break;
            case 'warning':
                $color = '#fd7e14';
                break;
            case 'info':
                $color = '#007bff';
                break;

            default:
                $color = '#214287';
                break;
        }
    else:
        $color = '#214287';
    endif;
@endphp
<div {{ $attributes->merge(['style' => 'display: block; text-align: center;']) }}>
    <a href="{{ $url }}"
    style="display: inline-block; padding: 11px 30px; margin: 15px 0 10px; font-size: 15px; color: #fff; background: {{$color}}; border-radius: 60px; text-decoration:none;">
        {{$slot}}
    </a>
</div>
