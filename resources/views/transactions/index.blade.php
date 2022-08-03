<x-admin-backend-layout
    title="{{ __('custom-messages.list-of-__model__', ['model' => 'Transactions']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.list-of-__model__', ['model' => 'Transactions']) }}">
        <a href="{{ route('transactions.create') }}" class="btn btn-primary waves-effect waves-float waves-light">
            <i data-feather='plus'></i> {{ __('buttons.create') }}
        </a>
    </x-app.page-title>

    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="datatables table table-hover table-striped table-vcenter">
                        @if($transactions->count())
                        <thead>
                            <tr>
                                <th>{!! __('tables.date-label') !!}</th>
                                <th>{{ __('tables.ticker-description-label') }}</th>
                                <th>{{ __('tables.transaction-action-label') }}</th>
                                <th>{{ __('tables.quantity-label') }}</th>
                                <th>{{ __('tables.price-label') }}</th>
                                <th>{{ __('tables.amount-label') }}</th>
                                <th class="text-center">{{ __('tables.action-label') }}</th>
                            </tr>
                        </thead>
                        @endif
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->date->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('transactions.edit', $transaction) }}">{{ $transaction->tickerDescription }}</a> <x-pill-conditional :condition="session('new') == $transaction->id">{{ __('messages.new') }}</x-pill-conditional>
                                    </td>
                                    <td>{!! pill($transaction->action->label(), $transaction->action->lightColor()) !!}</td>
                                    <td>{{ formatQty($transaction->qty, 5) }}</td>
                                    <td>{{ formatCurrency($transaction->the_price) }}</td>
                                    <td>{!! currency($transaction->amount) !!}</td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                <i data-feather="more-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('transactions.edit', $transaction) }}">
                                                    <i data-feather="edit-2" class="me-50"></i>
                                                    <span>Edit</span>
                                                </a>

                                                <form class="confirmation_form" method="POST"
                                                      action="{{ route('transactions.destroy', $transaction) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    @php
                                                      $type = $transaction->deleted_at ? 'Un-delete':'delete';
                                                    @endphp
                                                    <button
                                                        class="dropdown-item js_confirmation"
                                                        type="submit"
                                                        title="Delete {{ $transaction->tickerDescription }}"
                                                        data-message="You want to {{ $type }} this transaction?"
                                                    >
                                                        <i data-feather="trash" class="me-50"></i>
                                                        <span>{{ $transaction->deleted_at ? 'Un-delete':'Delete' }}</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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
    @push('js_after')
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
    @endpush
</x-admin-backend-layout>
