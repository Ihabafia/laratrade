@props(['for'])

@error($for)
    <span {{ $attributes->merge(['class' => 'invalid-feedback fs-xs mt-0']) }} role="alert">
        {{ $message }}
    </span>
@enderror
