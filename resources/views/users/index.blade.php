<x-admin-backend-layout
    title="{{ __('custom-messages.list-of-__model__', ['model' => 'Users']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.list-of-__model__', ['model' => 'Users']) }}">
        {{--<a href="{{ route('users.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
            <i class="fa fa-unlock-alt"></i> {{ __('buttons.create') }}
        </a>--}}
    </x-app.page-title>

    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-vcenter">
                        @if($users->count())
                        <thead>
                        <tr>
                            <th>{!! __('tables.full-name-label') !!}</th>
                            <th>{{ __('tables.access-level-label') }}</th>
                            <th>{{ __('tables.email-label') }}</th>
                            <th>{{ __('tables.status-label') }}</th>
                            <th>{{ __('tables.action-label') }}</th>
                        </tr>
                        </thead>
                        @endif
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('users.edit', $user) }}">{{ $user->full_name }}</a> <x-pill-conditional :condition="session('new') == $user->id">{{ __('messages.new') }}</x-pill-conditional>
                                    </td>
                                    <td class="d-none d-sm-table-cell">
                                        {!! $user->rolePills !!}
                                    </td>
                                    <td><a href="mailto:{{$user->email}}">{{ $user->email }}</a></td>
                                    <td>{!! pill($user->status->label(), $user->status->lightColor()) !!}</td>
                                    <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">{{ __('buttons.edit') }}</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-gray size-32 text-center fw-500">{{ __('custom-messages.no-__model__-at-this-time', ['model' => 'products']) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-backend-layout>
