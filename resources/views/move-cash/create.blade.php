<x-admin-backend-layout
    title="{{ __('messages.move-cash') }}"
>
    <x-app.page-title page-title="{{ __('messages.move-cash') }}" />

    <form class="masked-form"
          action="{{ route('move-cash.store') }}"
          method="POST"
    >
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="balance_before_cad">{{ __('forms.balance-before-cad-label') }}</x-label>
                        <div id="balance_before_cad" class="form-control">{{ __('forms.choose-account-label') }}</div>
                        <input id="amount_before_cad" type="hidden" name="before_cad" value="">
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="balance_after_cad">{{ __('forms.balance-after-cad-label') }}</x-label>
                        <div id="balance_after_cad" class="form-control">{{ __('forms.choose-account-label') }}</div>
                        <input id="amount_after_cad" type="hidden" name="after_cad" value="">
                        <span id="after_error_cad" class="" style="display: none;" role="alert"></span>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="balance_before_usd">{{ __('forms.balance-before-usd-label') }}</x-label>
                        <div id="balance_before_usd" class="form-control">{{ __('forms.choose-account-label') }}</div>
                        <input id="amount_before_usd" type="hidden" name="before_usd" value="">
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="balance_after_usd">{{ __('forms.balance-after-usd-label') }}</x-label>
                        <div id="balance_after_usd" class="form-control">{{ __('forms.choose-account-label') }}</div>
                        <input id="amount_after_usd" type="hidden" name="after_usd" value="">
                        <span id="after_error_usd" class="" style="display: none;" role="alert"></span>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="date">{{ __('forms.time-of-transaction-label') }}</x-label>
                        <x-input-group id="date"
                                       class="flatpickr-date-time flatpickr-input"
                                       name="date"
                                       value="{{ old('date', now()->format('Y-m-d H:i')) }}"
                                       type="text"
                                       readonly="readonly"
                        />
                        <x-input-error for="date"/>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="portfolio_id">{{ __('forms.account-name-label') }} <x-required/></x-label>
                        <x-dropdown-array id="portfolio_id"
                                          name="portfolio_id"
                                          object="asset"
                                          default="{{ __('custom-messages.select-model', ['model' => 'an account']) }}"
                                          :array="$accounts"
                                          selected="{{ old('portfolio_id') }}"
                                          serror="{{ $errors->first('portfolio_id') }}"
                        />
                        <x-input-error for="portfolio_id"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="action">{{ __('tables.transaction-action-label') }} <x-required/></x-label>
                        <x-enum-dropdown-menu id="action"
                                              name="action"
                                              default="{{ __('custom-messages.select-model', ['model' => 'transaction action'])}}"
                                              :model="\App\Enums\CashEnum::cases()"
                                              selected='{{ old("action") }}'
                                              serror="{{ $errors->first('action') }}"
                                              disabled="true"
                        />
                        <x-input-error for="action"/>
                    </div>
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="amount">{{ __('tables.amount-label') }} <x-required/></x-label>
                        <x-input-group id="amount"
                                       class="currency"
                                       name="amount"
                                       value="{{ old('amount') }}"
                                       type="text"
                                       disabled="disabled"
                        />
                        <x-input-error for="amount"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="rate">{{ __('tables.rate-label') }}</x-label>
                        <x-input-group id="rate"
                                       class="currency_open"
                                       name="rate"
                                       value="{{ old('rate') }}"
                                       type="text"
                                       disabled="disabled"
                        />
                        <x-input-error for="rate"/>
                    </div>
                    <div id="converted_div" class="form-group col-md-2 mt-2" style="display: none">
                        <x-label for="converted">{{ __('forms.converted-amount-label') }}</x-label>
                        <div id="converted" class="form-control">{{ formatCurrency(0) }}</div>
                        <input id="converted" type="hidden" name="converted" value="">
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button id="submit" type="submit" class="btn btn-primary me-md-0">
                                <i class="fa fa-check"></i> {{ __('buttons.submit') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('js_after')
        <script>
            $(document).on('change', '#portfolio_id', function(e) {
                if(this.value == '') {
                    $("#balance_before_cad").html('{{ __('forms.choose-account-label') }}');
                    $("#balance_after_cad").html('{{ __('forms.choose-account-label') }}');
                    $("#balance_before_usd").html('{{ __('forms.choose-account-label') }}');
                    $("#balance_after_usd").html('{{ __('forms.choose-account-label') }}');
                    $("#action").val('').change();
                    $("#amount").val('');
                    $("#action, #amount, #rate").attr('disabled', true);
                    $('#converted_div').hide();
                    return;
                }

                axios.post('{{ route('portfolio.get') }}', {
                    id: this.value,
                }).then(response => {
                    cad = response.data.CAD;
                    usd = response.data.USD;
                    $("#balance_before_cad").html(formatToCurrency(cad));
                    $("#amount_before_cad").val(cad);
                    $("#balance_after_cad").html(formatToCurrency(cad));
                    $("#amount_after_cad").val(cad);
                    $("#balance_before_usd").html(formatToCurrency(usd));
                    $("#amount_before_usd").val(usd);
                    $("#balance_after_usd").html(formatToCurrency(usd));
                    $("#amount_after_usd").val(usd);
                    $("#action").attr('disabled', false);
                });
            });

            $(document).on('change', '#action', function(e) {
                if(this.value === '') {
                    $("#amount, #rate").val('').attr('disabled', true);
                    $('#converted_div').hide();
                    return;
                }

                $("#amount").attr('disabled', false);
                $("#amount_after_cad").val(0);
                $("#amount_after_usd").val(0);
                updateBalance();
            });

            function updateBalance() {
                amount = $('#amount').val() * 1;
                action = $("#action").val();

                if (action === 'Deposit') {
                    $('#rate').val('').attr('disabled', true);
                    $('#converted_div').hide();
                    after_cad = cad + amount;
                    if (after_cad >= 0) {
                        $("#after_error_cad").removeClass('invalid-feedback fs-xs mt-0').html('').hide();
                        $("#submit").attr('disabled', false);
                    }

                    $("#balance_after_cad").html(formatToCurrency(after_cad));
                    $("#amount_after_cad").val(after_cad);
                    $("#balance_after_usd").html(formatToCurrency(usd));
                    $("#amount_after_usd").val(usd);
                }

                if (action === 'Withdraw') {
                    $('#rate').val('').attr('disabled', true);
                    $('#converted_div').hide();
                    after_cad = cad - amount;
                    if (after_cad < 0) {
                        $("#after_error_cad").addClass('invalid-feedback fs-xs mt-0').html('{{ __('messages.below-zero-error') }}').show();
                        $("#submit").attr('disabled', true);
                    } else {
                        $("#after_error_cad").removeClass('invalid-feedback fs-xs mt-0').html('').hide();
                        $("#submit").attr('disabled', false);
                    }

                    $("#balance_after_cad").html(formatToCurrency(after_cad));
                    $("#amount_after_cad").val(after_cad);
                    $("#balance_after_usd").html(formatToCurrency(usd));
                    $("#amount_after_usd").val(usd);

                }

                if(action === 'CAD2USD') {
                    $('#rate').attr('disabled', false);
                    $('#converted_div').show();
                    rate = $('#rate').val()*1;
                    after_cad = cad - amount;

                    converted = amount * rate;
                    after_usd = usd + converted;
                    if (after_cad < 0) {
                        $("#after_error_cad").addClass('invalid-feedback fs-xs mt-0').html('{{ __('messages.below-zero-error') }}').show();
                        $("#after_error_usd").removeClass('invalid-feedback fs-xs mt-0').html('').hide();
                        $("#submit").attr('disabled', true);
                    } else {
                        $("#after_error_cad").removeClass('invalid-feedback fs-xs mt-0').html('').hide();
                        $("#submit").attr('disabled', false);
                    }
                    $('#converted').html(formatToCurrency(converted));
                    $("#balance_after_cad").html(formatToCurrency(after_cad));
                    $("#balance_after_usd").html(formatToCurrency(after_usd));
                    $("#amount_after_cad").val(after_cad);
                    $("#amount_after_usd").val(after_usd);
                }

                if(action === 'USD2CAD') {
                    $('#rate').attr('disabled', false);
                    $('#converted_div').show();
                    rate = $('#rate').val()*1;
                    after_usd = usd - amount;

                    converted = amount * rate;
                    after_cad = cad + converted;
                    if (after_usd < 0) {
                        $("#after_error_usd").addClass('invalid-feedback fs-xs mt-0').html('{{ __('messages.below-zero-error') }}').show();
                        $("#after_error_cad").removeClass('invalid-feedback fs-xs mt-0').html('').hide();
                        $("#submit").attr('disabled', true);
                    } else {
                        $("#after_error_usd").removeClass('invalid-feedback fs-xs mt-0').html('').hide();
                        $("#submit").attr('disabled', false);
                    }
                    $('#converted').html(formatToCurrency(converted));
                    $("#balance_after_cad").html(formatToCurrency(after_cad));
                    $("#balance_after_usd").html(formatToCurrency(after_usd));
                    $("#amount_after_cad").val(after_cad);
                    $("#amount_after_usd").val(after_usd);
                }
            }

            $(document).on('keyup', "#amount, #rate", function(){
                $("#amount_after_cad").val(0);
                $("#amount_after_usd").val(0);
                updateBalance();
            });

            /*$(document).on('change', '#action', function(e) {
                if(this.value == 'Deposit') {
                    $("#balance_before").html('{{ __('forms.choose-account-label') }}');
                    $("#balance_after").html('{{ __('forms.choose-account-label') }}');
                    $("#action").val('').change();
                    $("#amount").val('');
                    $("#action, #amount").attr('disabled', true);
                    return;
                }

                axios.post('{{ route('portfolio.get') }}', {
                    id: this.value,
                }).then(response => {
                    cad = response.data.cash['CAD'];
                    $("#balance_before").html(formatToCurrency(cad));
                    $("#balance_after").html(formatToCurrency(cad));
                    $("#action, #amount").attr('disabled', false);
                });
            });*/

            const formatToCurrency = amount => {
              return "$" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
            };
        </script>

    @endpush
</x-admin-backend-layout>
