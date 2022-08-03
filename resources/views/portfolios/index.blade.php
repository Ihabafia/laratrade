<x-admin-backend-layout
    title="{{ __('custom-messages.manage-__model__', ['model' => 'Portfolios']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.manage-__model__', ['model' => 'Portfolios']) }}">
        <a href="{{ route('portfolios.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
            <i data-feather='plus'></i> {{ __('buttons.create') }}
        </a>
    </x-app.page-title>

    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-vcenter">
                        @if($portfolios->count())
                        <thead>
                            <tr>
                                <th style="width: 20%">{!! __('tables.portfolio-name-label') !!}</th>
                                <th style="width: 70%">{{ __('tables.portfolio-description-label') }}</th>
                                <th style="width: 10%">{{ __('tables.action-label') }}</th>
                            </tr>
                        </thead>
                        @endif
                        <tbody>
                            @forelse($portfolios as $portfolio)
                                <tr>
                                    <td>
                                        <a href="{{ route('portfolios.edit', $portfolio) }}">{{ $portfolio->name }}</a> <x-pill-conditional :condition="session('new') == $portfolio->id">{{ __('messages.new') }}</x-pill-conditional><x-pill-conditional color="info" :condition="session('updated') == $portfolio->id">{{ __('messages.updated') }}</x-pill-conditional>
                                    </td>
                                    <td>{{ $portfolio->description }}</td>
                                    <td><a href="{{ route('portfolios.edit', $portfolio) }}" class="btn btn-info btn-sm">{{ __('buttons.edit') }}</a></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-gray size-32 text-center fw-500">{{ __('custom-messages.no-__model__-at-this-time', ['model' => 'portfolios']) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-backend-layout>
