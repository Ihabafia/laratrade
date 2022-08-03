<x-admin-backend-layout
    title="{{ __('custom-messages.create-model', ['model' => 'Portfolio']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.create-model', ['model' => 'Portfolio']) }}">
        <a href="{{ route('portfolios.index') }}" class="btn btn-success waves-effect waves-float waves-light">
            <i data-feather='list'></i> {{ __('buttons.list-of-portfolios') }}
        </a>
    </x-app.page-title>

    <form class="masked-form"
          action="{{ route('portfolios.store') }}"
          method="POST"
    >
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4 mt-2">
                        <x-label for="name">{{ __('forms.portfolio-name-label') }} <x-required/></x-label>
                        <x-input-group id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       type="text"
                                       autofocus
                        />
                        <x-input-error for="name"/>
                    </div>
                    <div class="form-group col-md-8 mt-2">
                        <x-label for="description">{{ __('forms.portfolio-description-label') }}</x-label>
                        <x-input-group id="description"
                                       name="description"
                                       value="{{ old('description') }}"
                                       type="text"
                        />
                        <x-input-error for="description"/>
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
