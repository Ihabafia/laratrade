<x-admin-backend-layout
    title="{{ __('custom-messages.update-model', ['model' => 'Transaction Package']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.update-model', ['model' => 'Transaction Package']) }}" />

    <form class="masked-form confirmation_form"
          action="{{ route('packages.update', [$package, $selected]) }}"
          method="POST"
    >
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="customer.id">{{ __('forms.customer-title') }}</x-label>
                        <select id="customer.id"
                                name="customer[id]"
                                class="form-select customer_id @error('customer.id'){{ 'is-invalid' }}@enderror"
                                {{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'disabled':'' }}
                        >
                            <option value="">{{ __('custom-messages.select-model', ['model' => 'a Customer']) }}</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $selected->id == $customer->id ? 'selected':'' }}>{{ $customer->full_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="customer.id"/>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="customer.first_name">{{ __('forms.customer-first-name-title') }} <x-required/></x-label>
                        <x-input-group id="customer.first_name"
                                       name="customer[first_name]"
                                       value="{{ old('customer.first_name', $selected->first_name ?? '') }}"
                                       class="first_name"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="customer.first_name"/>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="customer.last_name">{{ __('forms.customer-last-name-title') }} <x-required/></x-label>
                        <x-input-group id="customer.last_name"
                                       name="customer[last_name]"
                                       value="{{ old('customer.last_name', $selected->last_name ?? '') }}"
                                       class="last_name"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="customer.last_name"/>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="customer.email">{{ __('forms.customer-email-title') }} <x-required/></x-label>
                        <x-input-group id="customer.email"
                                       name="customer[email]"
                                       value="{{ old('customer.email', $selected->email ?? '') }}"
                                       class="email"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="customer.email"/>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="package.amount">{{ __('forms.total-amount-title') }} <x-required/></x-label>
                        <x-input-group id="package.amount"
                                       name="package[amount]"
                                       value="{{ old('package.amount', $package->amount) }}"
                                       class="currency"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="package.amount"/>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="customer.branch_number">{{ __('forms.branch-number-title') }} <x-required/></x-label>
                        <x-input-group id="customer.branch_number"
                                       name="customer[branch_number]"
                                       value="{{ old('customer.branch_number', $selected->branch_number ?? '') }}"
                                       maxlength="4"
                                       class="branch_number"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="customer.branch_number"/>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="customer.transit_number">{{ __('forms.transit-number-title') }} <x-required/></x-label>
                        <x-input-group id="customer.transit_number"
                                       name="customer[transit_number]"
                                       value="{{ old('customer.transit_number', $selected->transit_number ?? '') }}"
                                       maxlength="5"
                                       class="transit_number"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="customer.transit_number"/>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="customer.account_number">{{ __('forms.account-number-title') }} <x-required/></x-label>
                        <x-input-group id="customer.account_number"
                                       name="customer[account_number]"
                                       value="{{ old('customer.account_number', $selected->account_number ?? '') }}"
                                       maxlength="12"
                                       class="account_number"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="customer.account_number"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <label for="package.payment_type"
                               class="control-label">{{ __('forms.payment-type-title') }}
                            <x-required/>
                        </label>
                        <x-enums-dropdown id="package.payment_type"
                                          name="package[payment_type]"
                                          object="package"
                                          select2=""
                                          :model="\App\Enums\PaymentTypeEnum::toArray()"
                                          selected="{{ old('package.payment_type', $package->payment_type->value ?? '') }}"
                                          serror="{{ $errors->first('package.payment_type') }}"
                                          disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="package.payment_type"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="package.processing_fee">{{ __('forms.processing-fee-title') }} <x-required/></x-label>
                        <x-input-group id="package.processing_fee"
                                       name="package[processing_fee]"
                                       value="{{ old('package.processing_fee', $selected->processing_fee ?? 0) }}"
                                       class="currency"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="package.processing_fee"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <label for="package.frequency"
                               class="control-label">{{ __('forms.payment-frequency-title') }}
                            <x-required/>
                        </label>
                        <x-enums-dropdown id="package.frequency"
                                          name="package[frequency]"
                                          object="package"
                                          select2=""
                                          :model="\App\Enums\FrequencyEnum::toArray()"
                                          selected="{{ old('package.frequency', $package->frequency->value ?? '') }}"
                                          serror="{{ $errors->first('package.frequency') }}"
                                          disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="package.frequency"/>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="package.starting_date">{{ __('forms.payment-starting-date-title') }} <x-required/></x-label>
                        <x-input-group id="package.starting_date"
                                       name="package[starting_date]"
                                       value="{{ old('package.starting_date', $package->starting_date?->format('Y-m-d')) }}"
                                       class="flatpickr-basic"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="package.starting_date"/>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="package.number_of_payments">{{ __('forms.number-of-payments-title') }} <x-required/></x-label>
                        <x-input-group id="package.number_of_payments"
                                       name="package[number_of_payments]"
                                       value="{{ old('package.number_of_payments', $package->number_of_payments) }}"
                                       type="number"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="package.number_of_payments"/>
                    </div>
                    <div class="form-group col-md-12 mt-2">
                        <x-label for="package.payment_description">{{ __('forms.payment-description-title') }} <x-required/></x-label>
                        <x-input-group id="package.payment_description"
                                       name="package[payment_description]"
                                       value="{{ old('package.payment_description', $package->payment_description) }}"
                                       maxlength="255"
                                       disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        />
                        <x-input-error for="package.payment_description"/>
                    </div>
                    <div class="form-group col-md-12 mt-2">
                        <label for="package.message">{{ __('forms.internal-note-label') }}</label>
                        <textarea id="package.message"
                                  name="package[message]"
                                  rows="3"
                                  class="form-control @error('message') {{'is-invalid'}} @enderror"
                                  disabled="{{ $package->status === \App\Enums\PackageStatusEnum::Active ? 'true':'' }}"
                        >{{ old('package.message', $package->message) }}</textarea>
                        <x-input-error for="package.message"/>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-2">
                            @if($package->status === \App\Enums\PackageStatusEnum::Pending)
                                <button type="submit"
                                        class="btn btn-primary me-md-0 js_confirmation"
                                        data-message="You want to generate the transaction(s)?"
                                >
                                    <i class="fa fa-check"></i>
                                    {{ $package?->id
                                        ? __('custom-messages.update-model', ['model' => 'Package'])
                                        : __('custom-messages.create-model', ['model' => 'Package']) }}
                                </button>
                            @endif
                            <a href="{{route('packages.index')}}" class="btn btn-inverse me-md-0">{{ __('buttons.cancel') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @if($package->transactions->count())
        <x-packages.list-of-transactions :package="$package" />
        <x-modals.transaction-details />
    @endif
    @push('css_after')
        <style>
            .blink {
                animation: blinker 1s linear 2s !important;
                color: #000000;
            }

            .blink > td {
                background-color: #ffffbb;
                color: #000000;
            }

            @keyframes blinker {
                50% {
                    opacity: 0.4;
                    color: #000000;
                }
            }
        </style>
    @endpush
    @push('js_after')
        <script>
            $(document).ready(function() {
                hash = get_query();
                if(hash) {
                    //console.log("#"+hash);
                    $("#"+hash).addClass('blink');
                }
            })
            $('.customer_id').on('change', function() {
                id = $(this).val();

                function fillFields(customer) {
                    if(typeof customer == 'object') {
                        $(".first_name").val(customer.first_name);
                        $(".last_name").val(customer.last_name);
                        $(".email").val(customer.email);
                        $(".branch_number").val(customer.branch_number);
                        $(".transit_number").val(customer.transit_number);
                        $(".account_number").val(customer.account_number);
                    } else {
                        $(".first_name").val('');
                        $(".last_name").val('');
                        $(".email").val('');
                        $(".branch_number").val('');
                        $(".transit_number").val('');
                        $(".account_number").val('');
                    }
                }

                if(id !== ''){
                    axios.get('/customers/'+id)
                        .then((response) => {
                            const customer = response.data.customer;
                            fillFields(customer);
                        });
                } else {
                    fillFields('');
                }
            })

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

            function get_query() {
                var url = document.location.href;
                var hash = url.substring(url.indexOf('#') + 1).split('&');

                if(hash[0][0] === 'T') {
                    return hash[0];
                }

                return null;
            }
        </script>
    @endpush
</x-admin-backend-layout>

