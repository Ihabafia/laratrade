<x-auth-layout>
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="brand-logo mx-auto">
                        <img class="logo" src="{{ asset("img/ltt-{$mode}-logo.svg") }}" style="max-width: 300px">
                    </div>
                    @if(session('status'))
                    <div class="alert alert-danger text-center p-1 fw-600 my-2">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form class="auth-login-form mt-0" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <x-label for="username" :value="__('forms.username')"/>
                            <x-input id="username" type="text" name="username" class="form-control" :value="old('username')"
                                     tabindex="1" autofocus/>
                            <x-input-error for="username"/>
                        </div>

                        <div class="mb-1">
                            <div class="d-flex justify-content-between">
                                {{--<label class="form-label" for="login-password">Password</label>--}}
                                <x-label for="password" :value="__('forms.password')"/>
                                <a href="{{ route('password.request') }}">
                                    <small>{{ __('forms.forgot-password') }}</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge form-password-toggle">
                                <x-input id="password" type="password"
                                         name="password"
                                         class="form-control"
                                         placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                         required
                                         autocomplete="current-password"
                                         tabindex="2"
                                />
                                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="4">{{ __('buttons.sign-in') }}</button>
                        <a href="{{ route('register') }}" class="btn btn-link w-100" tabindex="4">{{ __('buttons.register') }}</a>
                    </form>

                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
</x-auth-layout>
