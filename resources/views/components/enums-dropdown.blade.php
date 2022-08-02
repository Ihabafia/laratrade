@props([
    'model' => '',
    'id' => '',
    'name' => '',
    'multi' => '',
    'select',
    'serror',
    'required',
    'title',
    'disabled' => '',
    'select2' => false,
    'selected',
    'object' => null
])
@php
    if(!$name) {
        $name = $multi ? $id.'[]' : $id;
        $name = $object ? $object."[".$id."]" : $id;
    }
    $mergeClass = $select2 == 'true' ? ' select2':'';
    $mergeClass .= $serror ? ' is-invalid':'';
@endphp
<select id="{{ $id }}"
        {{ $attributes->merge(['class' => "form-select".$mergeClass]) }}
        name="{{ $name }}"
        {{ $disabled != '' ? 'disabled' : ''  }}
>
    <option value="">Select an option ...</option>
    @foreach($model as $id => $value)
        <option value="{{ $id }}" {{ $selected == $id ? 'selected':'' }}>{{ $value }}</option>
    @endforeach
</select>
