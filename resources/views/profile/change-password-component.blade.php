<form id="settingForm" action="{{ route('change-password.update', auth()->user()) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="block block-rounded mt-4">
        <div class="block-header block-header-default">
            <h3 class="block-title">{{ __('profile.change-password-title') }}</h3>
        </div>

        <div class="block-content block-content-full">
            <div class="row mb-2">
                <div class="col-lg-5">
                    <p class="text-muted mt-1 mb-1">
                        {{ __('profile.current-password-label') }}
                        <x-required/>
                        <span style="font-size: 0.75rem">{{ __('profile.new-password-warning') }}</span>
                    </p>
                </div>
                <div class="col-lg-7">
                    <div class="mb-2">
                        <x-input-group id="current_password" name="current_password" type="password"
                                       value="{{ old('current_password') }}"/>
                        <x-input-error for="current_password"/>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-lg-5">
                    <p class="text-muted mt-1 mb-1">
                        {{ __('profile.new-password-label') }}
                        <x-required/>
                    </p>
                </div>
                <div class="col-lg-7">
                    <div class="mb-2">
                        <x-input-group id="password" name="password" type="password"
                                       value="{{ old('password') }}"/>
                        <x-input-error for="password"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <p class="text-muted mt-1 mb-1">
                        {{ __('profile.confirm-password-label') }}
                        <x-required/>
                    </p>
                </div>
                <div class="col-lg-7">
                    <div class="mb-2">
                        <x-input-group id="password_confirmation" name="password_confirmation" type="password"
                                       value="{{ old('password_confirmation') }}"/>
                        <x-input-error for="password_confirmation"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <button type="submit"
                class="btn btn-alt-primary me-md-0 mt-4 mb-5">{{ __('profile.change-password') }}</button>
    </div>
</form>
