@hasanyrole(\App\Enums\RoleEnum::Admin->value.'|'.\App\Enums\RoleEnum::User->value)
<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
        aria-expanded="false">
    {{ session('portfolio')['name'] }}
</button>
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    @foreach(session('portfolios') as $portfolio => $id)
        @if($id == session('portfolio')['id']) @continue @endif
        <a class="dropdown-item" href="{{ route('redirect', $id) }}">{{ $portfolio }}</a>
    @endforeach
</div>
@endhasanyrole
