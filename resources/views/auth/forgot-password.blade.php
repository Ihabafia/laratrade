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
                    <div class="alert alert-{{ session('status') }}" role="alert">
                        <div class="alert-body">
                            {{ session('message') }}
                        </div>
                    </div>
                    @endif

                    <h4 class="card-title mb-1">{{ __('forms.forgot-password-with-logo') }}</h4>
                    <p class="card-text mb-2">{{ __('messages.forgot-password-message') }}</p>

                    <form class="auth-forgot-password-form mt-2" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-1">
                            <x-label for="username" :value="__('Username')"/>
                            <x-input id="username" type="text" name="username" class="form-control"
                                     :value="old('username')" tabindex="1" autofocus/>
                            <x-input-error for="username"/>
                        </div>
                        <button class="btn btn-primary w-100" tabindex="2">{{ __('forms.send-reset-link') }}</button>
                    </form>

                    <p class="text-center mt-2">
                        <a href="{{ route('login') }}">{!! __('buttons.back-to-login') !!}</a>
                    </p>

                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
</x-auth-layout>
