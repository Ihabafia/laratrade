<x-admin-backend-layout
    title="{{ __('custom-messages.create-model', ['model' => 'Transaction']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.create-model', ['model' => 'Transaction']) }}">
        <a href="{{ route('assets.index') }}" class="btn btn-success waves-effect waves-float waves-light">
            <i data-feather='list'></i> {{ __('buttons.list-of-transactions') }}
        </a>
    </x-app.page-title>

    <form class="masked-form"
          action="{{ route('transactions.store') }}"
          enctype="multipart/form-data"
          method="POST"
    >
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3 mt-2">
                        <x-label for="ticker_id">{{ __('forms.ticker-label') }} <x-required/></x-label>
                        <x-dropdown-array id="ticker_id"
                                          name="ticker_id"
                                          object="asset"
                                          default="{{ __('custom-messages.select-model', ['model' => 'ticker']) }}"
                                          :array="$assets"
                                          selected="{{ old('ticker_id') }}"
                                          serror="{{ $errors->first('ticker_id') }}"
                        />
                        <x-input-error for="ticker_id"/>
                    </div>
                    <div class="form-group col-md-7 mt-2">
                        <x-label for="description">{{ __('forms.description-label') }} <x-required/></x-label>
                        <div id="description" class="form-control">{{ __('messages.select-a-ticker-symbol') }}</div>
                    </div>
                    <div class="form-group col-md-2 mt-2">
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

                    <div class="form-group col-md-2 mt-2">
                        <x-label for="action">{{ __('tables.transaction-action-label') }} <x-required/></x-label>
                        <x-enum-dropdown-menu id="action"
                                              name="action"
                                              default="{{ __('custom-messages.select-model', ['model' => 'transaction action'])}}"
                                              :model="\App\Enums\TransactionEnum::cases()"
                                              selected='{{ old("action") }}'
                                              serror="{{ $errors->first('action') }}"
                                              disabled="disabled"
                        />
                        <x-input-error for="action"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="quantity">{{ __('tables.quantity-label') }} <x-required/></x-label>
                        <x-input-group id="quantity"
                                       class="decimal"
                                       name="quantity"
                                       value="{{ old('quantity') }}"
                                       type="text"
                                       disabled="disabled"
                        />
                        <x-input-error for="quantity"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="price">{{ __('tables.price-label') }} <x-required/></x-label>
                        <x-input-group id="price"
                                       class="currency"
                                       name="price"
                                       value="{{ old('price') }}"
                                       type="text"
                                       disabled="disabled"
                        />
                        <x-input-error for="price"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="description">{{ __('tables.amount-label') }} <x-required/></x-label>
                        <div id="amount" class="form-control">$0.00</div>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="cash">{{ __('tables.cash-label') }} <x-required/></x-label>
                        <div id="cash_display" class="form-control">{{ formatCurrency(old('cash', 0.00)) }}</div>
                        <input id="cash" type="hidden" name="cash" value="{{ old('cash', 0.00) }}">
                        <span id="cash_error" class="" style="display: none;" role="alert"></span>

                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button id="submit" type="submit" class="btn btn-primary me-md-0">
                                <i class="fa fa-check"></i> {{ __('custom-messages.create-model', ['model' => 'Asset']) }}
                            </button>
                            <a href="{{route('assets.index')}}" class="btn btn-inverse me-md-0">{{ __('buttons.cancel') }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

    @push('js_after')
        <script>
            function reset_fields() {
                $("#price, #quantity, #action").val('');
                $('#amount, #cash_display').html('$0.00');
                $("#cash_error").removeClass('invalid-feedback fs-xs mt-0').html('').hide();
            }

            $(document).ready(function() {
                cash = $("#cash").val();
                if(cash > 0) {
                    $("#price, #quantity, #action").attr('disabled', false);
                }
            })

            $(document).on('change', '#action', function () {
                action = this.value;
                updatePrice();
            });

            $(document).on('change', '#ticker_id', function(e) {
                if(this.value == '') {
                    $("#description").html('{{ __('messages.select-a-ticker-symbol') }}');
                    $("#price, #quantity, #action").attr('disabled', true);
                    reset_fields();
                    return;
                }

                axios.post('{{ route('asset.get') }}', {
                    id: this.value,
                }).then(response => {
                    $("#description").html(response.data.description);
                    $("#cash_display").html(formatToCurrency(response.data.cash));
                    $("#cash").val(response.data.cash);
                    cash = response.data.cash;
                    $("#price, #quantity, #action").attr('disabled', false);
                });
            })

            function updatePrice() {
                price = $('#price').val() * 1;
                quantity = $('#quantity').val() * 1;
                amount = price * quantity;
                balance = action === 'Buy' ? cash - amount : cash + amount;

                if (balance < 0) {
                    $("#cash_error").addClass('invalid-feedback fs-xs mt-0').html('{{ __('messages.below-zero-error') }}').show();
                    $("#submit").attr('disabled', true);
                } else {
                    $("#cash_error").removeClass('invalid-feedback fs-xs mt-0').html('').hide();
                    $("#submit").attr('disabled', false);
                }

                $("#amount").html(formatToCurrency(amount));
                $("#cash_display").html(formatToCurrency(balance));
            }

            $(document).on('keyup', "#price, #quantity", function(){
                updatePrice();
            })

            const formatToCurrency = amount => {
              return "$" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
            };
        </script>

    @endpush
</x-admin-backend-layout>
