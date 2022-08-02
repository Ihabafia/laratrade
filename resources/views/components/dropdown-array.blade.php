@props([
    'array',
    'serror',
    'id' => '',
    'selected',
    'multi' => '',
    'object' => null,
    'select2' => false,
    'name' => '',
])


@php
    if(!$name) {
        $name = $multi ? $id.'[]' : $id;
        $name = $object ? $object."[".$id."]" : $id;
    }
@endphp

<select id="{{ $id }}"
        name="{{ $name }}"
        class="form-select {{ $serror ? 'is-invalid':'' }}  {{ $select2 == 'true' ? 'select2':'' }}"
>
    <option value="">Please Select...</option>
    @foreach($array as $id => $item)
        <option value="{{ $id }}" {{ $selected == $id ? 'selected':'' }}>{{ $item }}</option>
    @endforeach
</select>
