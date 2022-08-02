<x-auth-layout>
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="brand-logo mx-auto">
                        <img class="logo" src="{{ asset("img/ltt-{$mode}-logo.svg") }}" style="max-width: 300px">
                    </div>

                    <h4 class="card-title mb-1">Reset Password 🔒</h4>
                    <p class="card-text mb-2">Your new password must be different from previously used passwords</p>

                    <form class="auth-reset-password-form mt-2" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="reset-password-new">{{ __('general.email') }}</label>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <x-input id="email" type="email" name="email" :value="old('email', $request->email)"
                                         class="form-control"
                                         tabindex="1" />
                                <x-input-error for="email"/>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <x-label for="password" :value="__('general.new-password')"/>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <x-input id="password" type="password"
                                         name="password"
                                         class="form-control"
                                         placeholder="password"
                                         tabindex="2" autocomplete="off" autofocus />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                <x-input-error for="password"/>
                            </div>
                        </div>
                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                <x-label for="password_confirmation" :value="__('general.confirm-password')"/>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <x-input id="password_confirmation" type="password"
                                         name="password_confirmation"
                                         class="form-control"
                                         placeholder="{{ __('Confirm Password') }}"
                                         tabindex="3" autocomplete="off"/>
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                <x-input-error for="password_confirmation"/>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="3">{{ __('general.set-new-password') }}</button>
                    </form>

                    <p class="text-center mt-2">
                        <a href="{{ route('login') }}"> <i data-feather="chevron-left"></i> {{ __('general.back-to-login') }} </a>
                    </p>

                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
</x-auth-layout>
