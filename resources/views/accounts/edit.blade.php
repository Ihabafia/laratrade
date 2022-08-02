<x-admin-backend-layout
    title="{{ __('custom-messages.edit-type', ['type' => $account->name.' Portfolio']) }}"
>
    <x-app.page-title page-title="{{ __('custom-messages.edit-type', ['type' => $account->name.' Portfolio']) }}">
        <a href="{{ route('accounts.index') }}" class="btn btn-success waves-effect waves-float waves-light">
            <i data-feather='list'></i> {{ __('buttons.list-of-portfolios') }}
        </a>
    </x-app.page-title>

    <form class="masked-form"
          action="{{ route('accounts.update', $account) }}"
          method="POST"
    >
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-4 mt-2">
                        <x-label for="name">{{ __('forms.account-name-label') }} <x-required/></x-label>
                        <x-input-group id="name"
                                       name="name"
                                       value="{{ old('name', $account->name) }}"
                                       type="text"
                                       autofocus
                        />
                        <x-input-error for="name"/>
                    </div>
                    <div class="form-group col-md-8 mt-2">
                        <x-label for="description">{{ __('forms.description-label') }} <x-required/></x-label>
                        <x-input-group id="description"
                                       name="description"
                                       value="{{ old('description', $account->description) }}"
                                       type="text"
                        />
                        <x-input-error for="description"/>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-md-0">
                                <i class="fa fa-check"></i> {{ __('custom-messages.edit-type', ['type' => 'Portfolio']) }}
                            </button>
                            <a href="{{route('accounts.index')}}" class="btn btn-inverse me-md-0">{{ __('buttons.cancel') }}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</x-admin-backend-layout>
