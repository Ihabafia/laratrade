<x-admin-backend-layout
    title="{{ __('messages.list-of-clients') }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.list-of-__model__', ['model' => 'Crons']) }}" />

    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-vcenter">
                        <tbody>
                            <tr>
                                <th class="fw-600">{{ __('messages.general-crons') }}</th>
                            </tr>
                            <tr>
                                <td class="fw-semibold"><a href="{{ url('cron/update-vars') }}">Update Email Vars</a></td>
                            </tr>
                            <tr>
                                <th class="fw-600">{{ __('messages.payments-crons') }}</th>
                            </tr>
                            <tr>
                                <td class="fw-semibold"><a href="{{ route('process.payments', 'first') }}">First Try Process Payments</a></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold"><a href="{{ route('generate.bank-files', \App\Enums\PaymentTypeEnum::Debit->value) }}">Generate Bank Files (Debit)</a></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold"><a href="{{ route('generate.bank-files', \App\Enums\PaymentTypeEnum::Credit->value) }}">Generate Bank Files (Credit)</a></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold"><a href="{{ route('cron.upload-rbc-test-files', \App\Enums\TransactionEnum::Debit->value) }}">Upload Bank Test Files</a></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold"><a href="{{ route('cron.upload-rbc-files', \App\Enums\TransactionEnum::Debit->value) }}">Upload Bank Files (Debit)</a></td>
                            </tr>
                            <tr>
                                <td class="fw-semibold"><a href="{{ route('cron.upload-rbc-files', \App\Enums\TransactionEnum::Credit->value) }}">Upload Bank Files (Credit)</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-backend-layout>
