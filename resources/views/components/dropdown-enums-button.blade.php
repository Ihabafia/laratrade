@props([
    'color' => 'primary',
    'title' => 'Action',
    'enums' => null,
    'model' => null,
    'route' => '#'
])
<div class="btn-group" role="group">
    <button type="button" class="btn btn-{{ $color }} dropdown-toggle waves-effect waves-float waves-light"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{ $title }}
    </button>
    <div class="dropdown-menu">
        @foreach($enums as $enum)
            <a class="dropdown-item" href="{{ route($route, [$model, $enum->value]) }}">{{ $enum->label() }}</a>
        @endforeach
    </div>
</div>
