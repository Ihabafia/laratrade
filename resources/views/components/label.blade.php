@props(['value', 'required'])

<label {{ $attributes }}>
    {{ $value ?? $slot }}{!! isset($required) ? ' <span class="text-danger">*</span>':'' !!}
</label>
