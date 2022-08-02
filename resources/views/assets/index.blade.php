<x-admin-backend-layout
    title="{{ __('custom-messages.manage-__model__', ['model' => 'Assets/Tickers']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.manage-__model__', ['model' => 'Assets/Tickers']) }}">
        <a href="{{ route('assets.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
            <i data-feather='plus'></i> {{ __('buttons.create') }}
        </a>
    </x-app.page-title>

    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-vcenter">
                        @if($assets->count())
                        <thead>
                            <tr>
                                <th>{!! __('tables.ticker-label') !!}</th>
                                <th>{{ __('tables.description-label') }}</th>
                                <th>{{ __('tables.currency-label') }}</th>
                                <th>{{ __('tables.type-label') }}</th>
                                <th>{{ __('tables.action-label') }}</th>
                            </tr>
                        </thead>
                        @endif
                        <tbody>
                            @forelse($assets as $asset)
                                <tr>
                                    <td>
                                        @if($asset->ticker == 'CASH')
                                            {{ $asset->ticker }}
                                        @else
                                            <a href="{{ route('assets.edit', $asset) }}">{{ $asset->ticker }}</a> <x-pill-conditional :condition="session('new') == $asset->id">{{ __('messages.new') }}</x-pill-conditional>
                                        @endif
                                    </td>
                                    <td class="d-none d-sm-table-cell">{{ $asset->description }}</td>
                                    <td>{!! pill($asset->currency->name, $asset->currency->color()) !!}</td>
                                    <td>{!! pill($asset->type->label(), $asset->type->lightColor()) !!}</td>
                                    <td>
                                        @if($asset->ticker !== 'CASH')
                                            <a href="{{ route('assets.edit', $asset) }}" class="btn btn-info btn-sm">{{ __('buttons.edit') }}</a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-gray size-32 text-center fw-500">{{ __('custom-messages.no-__model__-at-this-time', ['model' => 'assets']) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-backend-layout>
