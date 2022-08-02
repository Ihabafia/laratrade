@props([
    'error' => '',
    'suffix' => '',
    'prefix' => '',
    'id' => '',
    'type' => 'text',
    'disabled' => '',
])

@error($id)
    @php($error .= "is-invalid")
@enderror

<div class="input-group {{$error}}">
@if($prefix)
    <span class="input-group-text" id="basic-addon2">{{ $prefix ?? '' }}</span>
@endif
    <input id="{{$id}}" {{ $disabled !== '' ? 'disabled':'' }} type="{{ $type }}" {{ $attributes->merge(['class' => "form-control $error"]) }} >
@if($suffix)
    <span class="input-group-text" id="basic-addon2">{{ $suffix ?? '' }}</span>
@endif
</div>
