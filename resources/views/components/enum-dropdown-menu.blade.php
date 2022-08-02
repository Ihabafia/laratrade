@props([
    'model' => '',
    'default' => 'Select an option ...',
    'disabled' => false,
    'serror',
    'selected',
    'select2' => false,
])

@php
    $mergeClass = $select2 == 'true' ? ' select2':'';
    $mergeClass .= $serror ? ' is-invalid':'';
@endphp

<select
    {{ $attributes->merge(['class' => "form-select".$mergeClass]) }}
    {{ $attributes }}
    {{ $disabled ? 'disabled="disabled"' : ''  }}
>
    <option value="">{{ $default }}</option>
    @foreach($model as $case)
        <option value="{{ $case->value }}" {{ $selected == $case->value ? 'selected':'' }}>{{ $case->label() }}</option>
    @endforeach
</select>
