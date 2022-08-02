<x-admin-backend-layout
    title="{{ __('custom-messages.create-model', ['model' => 'Asset/Ticker']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.create-model', ['model' => 'Asset/Ticker']) }}">
        <a href="{{ route('assets.index') }}" class="btn btn-success waves-effect waves-float waves-light">
            <i data-feather='list'></i> {{ __('buttons.list-of-assets') }}
        </a>
    </x-app.page-title>

    <form class="masked-form"
          action="{{ route('assets.store') }}"
          enctype="multipart/form-data"
          method="POST"
    >
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-1 mt-2">
                        <x-label for="asset.ticker">{{ __('forms.ticker-label') }} <x-required/></x-label>
                        <x-input-group id="asset.ticker"
                                       name="asset[ticker]"
                                       value="{{ old('asset.ticker') }}"
                                       type="text"
                                       autofocus
                        />
                        <x-input-error for="asset.ticker"/>
                    </div>
                    <div class="form-group col-md-7 mt-2">
                        <x-label for="asset.description">{{ __('forms.description-label') }} <x-required/></x-label>
                        <x-input-group id="asset.description"
                                       name="asset[description]"
                                       value="{{ old('asset.description') }}"
                                       type="text"
                        />
                        <x-input-error for="asset.description"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="asset.type">{{ __('forms.type-label') }} <x-required/></x-label>
                        <x-enum-dropdown-menu id="asset.type"
                                              name="asset[type]"
                                              object="asset"
                                              default="{{ __('custom-messages.select-model', ['model' => 'asset type'])}}"
                                              :model="\App\Enums\AssetTypeEnum::cases()"
                                              selected='{{ old("asset.type") }}'
                                              serror="{{ $errors->first('asset.type') }}"
                        />
                        <x-input-error for="asset.type"/>
                    </div>
                    <div class="form-group col-md-2 mt-2">
                        <x-label for="asset.currency">{{ __('forms.currency-label') }} <x-required/></x-label>
                        <x-enum-dropdown-menu id="asset.currency"
                                              name="asset[currency]"
                                              object="asset"
                                              default="{{ __('custom-messages.select-model', ['model' => 'asset currency'])}}"
                                              :model="\App\Enums\CurrencyEnum::cases()"
                                              selected='{{ old("asset.currency") }}'
                                              serror="{{ $errors->first('asset.currency') }}"
                        />
                        <x-input-error for="asset.currency"/>
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
</x-admin-backend-layout>
