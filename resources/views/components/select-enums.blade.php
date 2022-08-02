@props([
    'disabled' => false,
    'enums' => [],
    'label' => null,
    'selected' => '',
    'extra' => true,
    'error' => 'select2 form-control',
    'id' => '',
])
@php
    $class = "App\Enums\\".$enums;
    $options = $class::toArray();
@endphp
@error($id)
    @php($error .= " is-invalid")
@enderror
<select {!! $attributes->merge(['class' => $error]) !!} {{ $disabled ? 'disabled' : '' }}>
    <option value="">{{ $label ?? __('settings.please-select') }}</option>
    @forelse($options as $key => $option)
        <option
            value="{{ $key }}" {{ $key === $selected ? 'selected':'' }}>{{ $option }}</option>
    @empty
    @endforelse
</select>

