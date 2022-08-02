<x-auth-layout>
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="brand-logo mx-auto">
                        <img class="logo" src="{{ asset("img/ltt-{$mode}-logo.svg") }}" style="max-width: 300px">
                    </div>

                    <form method="POST" action="{{ route('password.first', $user->temp) }}">
                    @csrf
                    @method('PATCH')
                    <!-- Password Reset Token -->
                        <div class="form-floating mb-2 pb-1">
                            <x-input id="email" type="email" name="email" :value="old('email', $user->email)"
                                     class="form-control"
                                     disabled="true"
                                     placeholder="example@example.com" required autofocus/>
                            <x-label for="email" :value="__('Email')"/>
                            <x-input-error for="email"/>
                        </div>

                        <!-- Password -->
                        <div class="form-floating mb-2 pb-1">
                            <x-input id="password" type="password"
                                     name="password"
                                     class="form-control"
                                     placeholder="password"
                                     required autocomplete="off"/>
                            <x-label for="password" :value="__('Password')"/>
                            <x-input-error for="password"/>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-floating mb-2 pb-1">
                            <x-input id="password_confirmation" type="password"
                                     name="password_confirmation"
                                     class="form-control"
                                     placeholder="{{ __('Confirm Password') }}"
                                     required autocomplete="off"/>
                            <x-label for="password_confirmation" :value="__('Confirm Password')"/>
                            <x-input-error for="password_confirmation"/>
                        </div>

                        <div class="text-center">
                            <x-icon-button color="primary" icon="fingerprint">
                                {{ __('Change Password') }}
                            </x-icon-button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
</x-auth-layout>
