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
                    <div class="form-group col-md-9 mt-2">
                        <x-label for="description">{{ __('forms.description-label') }} <x-required/></x-label>
                        <div id="description" class="form-control">{{ __('messages.select-a-ticker-symbol') }}</div>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="action">{{ __('tables.transaction-action-label') }} <x-required/></x-label>
                        <x-enum-dropdown-menu id="action"
                                              name="action"
                                              default="{{ __('custom-messages.select-model', ['model' => 'transaction action'])}}"
                                              :model="\App\Enums\TransactionEnum::cases()"
                                              selected='{{ old("action") }}'
                                              serror="{{ $errors->first('action') }}"
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
                        />
                        <x-input-error for="price"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="description">{{ __('tables.amount-label') }} <x-required/></x-label>
                        <div id="amount" class="form-control">$0.00</div>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="cash">{{ __('tables.cash-label') }} <x-required/></x-label>
                        <div id="cash" class="form-control">{{ formatCurrency($account->cash) }}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-md-0">
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
            $(document).on('change', '#ticker_id', function(e) {
                if(this.value == '') {
                    $("#description").html('{{ __('messages.select-a-ticker-symbol') }}');
                    return;
                }

                axios.post('{{ route('assets.get') }}', {
                    id: this.value,
                }).then(response => {
                    description = response.data.description;
                    $("#description").html(description);
                });
            })

            $(document).on('keyup', "#price, #quantity", function(){
                price = $('#price').val()*1;
                quantity = $('#quantity').val()*1;
                amount = price * quantity;
console.log(formatToCurrency(amount));
                $("#amount").html(formatToCurrency(amount));
            })

            const formatToCurrency = amount => {
              return "$" + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");
            };
        </script>

    @endpush
</x-admin-backend-layout>
