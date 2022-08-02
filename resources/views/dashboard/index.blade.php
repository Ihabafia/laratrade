<x-admin-backend-layout
    title="{{ auth()->user()->role->label() }} Dashboard"
>
    <!-- BEGIN: Content-->
    <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
        <section id="dashboard-ecommerce">

            <div class="row match-height">
                <!-- Statistics Card -->
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-50">{{ $assetsCount }}</h3>
                                <span>Assets Count</span>
                            </div>
                            <div class="avatar bg-light-primary p-50">
                                <span class="avatar-content">
                                    <i data-feather="user" class="font-medium-4"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="fw-bolder mb-25">CAD: {{ formatCurrency($account->cash['CAD']) }}</h4>
                                <h4 class="fw-bolder mb-25">USD: {{ formatCurrency($account->cash['USD']) }}</h4>
                                <span>{{ $account->name }} Protfolio</span>
                            </div>
                            <div class="avatar bg-light-danger p-50">
                                <span class="avatar-content">
                                    <i data-feather="activity" class="font-medium-4"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">{{ 0 }}</h3>
                                <span>Amount Collected</span>
                            </div>
                            <div class="avatar bg-light-warning p-50">
                                <span class="avatar-content">
                                    <i data-feather="pocket" class="font-medium-4"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">{{ 0 }}</h3>
                                <span>Transactions</span>
                            </div>
                            <div class="avatar bg-light-success p-50">
                                <span class="avatar-content">
                                    <i data-feather="dollar-sign" class="font-medium-4"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Tables start -->
            {{--<div class="row" id="basic-table">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Latest Transactions</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>{{ __('tables.transaction-id') }}</th>
                                    <th>{{ __('tables.payee') }}</th>
                                    <th>{{ __('tables.amount') }}</th>
                                    <th>{{ __('tables.type') }}</th>
                                    <th>{{ __('tables.process-at') }}</th>
                                    <th>{{ __('tables.status') }}</th>
                                    <th>{{ __('tables.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestTransactions as $transaction)
                                    <tr>
                                        <td>
                                            <a href="{{ route('packages.edit', [$transaction->package_id, $transaction->customer_id]).'#T'.$transaction->padId }}">
                                                {{ $transaction->padId }}
                                            </a>
                                        </td>
                                        <td class="d-none d-sm-table-cell">{{ $transaction->customer->full_name }}</td>
                                        <td>{{ formatCurrency($transaction->amount) }}</td>
                                        <td>{!! badge($transaction->payment_type->label(), $transaction->payment_type->color()) !!}</td>
                                        <td>{{ $transaction->process_date?->format('Y-m-d') }}</td>
                                        <td>{!! pill($transaction->status->label(), $transaction->status->lightColor()) !!}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm fetchTransactionDetails"
                                               href="#"
                                               data-id="{{$transaction->id}}"
                                            >
                                                <i data-feather="edit-2" class="me-50"></i>
                                                <span>{{ __('forms.view-details-title') }}</span>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                <tr>
                                    <td colspan="8" class="size-32 fw-700 text-gray text-center">{{ __('custom-messages.no-__model__-at-this-time', ['model' => 'finances']) }}</td>
                                </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>--}}
            <!-- Basic Tables end -->
        </section>
        <!-- Dashboard Ecommerce ends -->
    </div>
    <!-- END: Content-->
    <!-- Dashboard Ecommerce Starts -->
<!-- Dashboard Ecommerce ends -->

    @push('js_after')
        {{--<script src="{{ asset('app-assets/js/charts/apexcharts.min.js') }}"></script>
        <script src="{{ asset('app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>--}}

        <script>
            $(".fetchTransactionDetails").on('click', function(e) {
                e.preventDefault();
                id = $(this).data('id');
                $("#transactionDetails .modal-body").html('');
                $("#transactionDetails .modal-title").html('');

                axios.get('/transactions/' + id + '/transactionDetails')
                    .then((response) => {
                        $("#transactionDetails .modal-body").html(response.data.body);
                        $("#transactionDetails .modal-title").html(response.data.title);

                        $("#transactionDetails").modal('show');
                    });
            });
        </script>
    @endpush
</x-admin-backend-layout>
