<x-admin-backend-layout
    title="{{ __('custom-messages.list-of-__model__', ['model' => 'Transaction Packages']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.list-of-__model__', ['model' => 'Transaction Packages']) }}">
        <a href="{{ route('packages.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
            <i class="fa fa-unlock-alt"></i> {{ __('buttons.create') }}
        </a>
    </x-app.page-title>

    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-vcenter">
                        @if($packages->count())
                        <thead>
                            <tr>
                                <th>{{ __('forms.package-id-title') }}</th>
                                <th>{{ __('forms.payee-title') }}</th>
                                <th>{{ __('forms.payment-amount-title') }}</th>
                                <th>{{ __('forms.frequency-title') }}</th>
                                <th>{{ __('forms.payments-title') }}</th>
                                <th>{{ __('forms.status-title') }}</th>
                                <th>{{ __('forms.created-at-title') }}</th>
                                <th>{{ __('forms.process-at-title') }}</th>
                            </tr>
                        </thead>
                        @endif
                        <tbody>
                            @forelse($packages as $package)
                                <tr>
                                    <td><a href="{{ route('packages.edit', [$package, $package->customer]) }}">{{ $package->name }}</a></td>
                                    <td>
                                        {{ $package->customer->full_name }} <x-pill-conditional :condition="session('new') == $package->id">{{ __('messages.new') }}</x-pill-conditional>
                                    </td>
                                    <td>{{ formatCurrency($package->amount) }}</td>
                                    <td>{{ $package->frequency->label() }}</td>

                                    <td class="d-none d-sm-table-cell">{!! badge($package->paid_count . '/' . $package->transactions->count(), 'primary') !!}</td>
                                    <td>{!! pill($package->status->label(), $package->status->color()) !!}</td>
                                    <td>{{ $package->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $package->starting_date->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-gray size-32 text-center fw-500">{{ __('custom-messages.no-__model__-at-this-time', ['model' => 'packages']) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{--@push('js_after')
        <x-datatables-js />

        <script>
            $(document).ready( function () {
                $('.datatables').DataTable({
                    "bSort": true,
                    "pageLength": 25,
                    "stateSave": false,
                    "order": [ 0, 'desc' ],
                    "columnDefs": [{
                        className: 'control',
                    }],
                });
            });
        </script>
    @endpush--}}
</x-admin-backend-layout>
