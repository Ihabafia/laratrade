@props(['disabled' => false, 'error' => '', 'suffix' => '', 'prefix' => '', 'id' => '', 'class' => ''])

@error($id)
    @php($class .= " is-invalid")
@enderror

@if($prefix)
    <span class="input-group-text" id="basic-addon2">{{ $prefix ?? '' }}</span>
@endif
<input id="{{$id}}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => $class]) !!} >
@if($suffix)
    <span class="input-group-text" id="basic-addon2">{{ $suffix ?? '' }}</span>
@endif


