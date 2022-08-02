<x-auth-layout>
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="brand-logo mx-auto mb-3">
                        <img class="logo" src="{{ asset("img/ltt-{$mode}-logo.svg") }}" style="max-width: 300px">
                    </div>
                    <form class="js-validation-signup masked-form" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="d-flex justify-content-between gap-1 align-items-center mb-1 pb-1 col-sm-12 col-xl-12">
                            <div class="form-floating">
                                <x-input id="first_name" type="first_name" name="first_name"
                                         class="form-control" :value="old('first_name')" placeholder="firstname"
                                         required
                                         autofocus />
                                <x-label for="first_name" :value="__('forms.first_name')" required="true" />
                                <x-input-error for="first_name"/>
                            </div>
                            <div class="form-floating">
                                <x-input id="last_name" type="last_name" name="last_name" required
                                         class="form-control" :value="old('last_name')" placeholder="lastname"
                                         />
                                <x-label for="last_name" :value="__('forms.last_name')" required="true" />
                                <x-input-error for="last_name"/>
                            </div>
                        </div>

                        <div class="form-floating mb-1 pb-1">
                            <x-input id="email" type="email" name="email" class="form-control" :value="old('email')"
                                     placeholder="email"/>
                            <x-label for="email" :value="__('forms.email')" required="true" />
                            <x-input-error for="email"/>
                        </div>

                        <div class="form-floating mb-1 pb-1">
                            <x-input id="mobile" type="text" name="mobile" class="form-control mobile" :value="old('mobile')"
                                     placeholder="mobile"/>
                            <x-label for="mobile" :value="__('forms.mobile')" required="true" />
                            <x-input-error for="mobile"/>
                        </div>

                        <div class="form-floating mb-1 pb-1">
                            <x-input id="username" type="text" name="username" class="form-control" :value="old('username')"
                                     placeholder="username" />
                            <x-label for="username" :value="__('forms.username')" required="true" />
                            <x-input-error for="username"/>
                        </div>

                        <!-- Password -->
                        {{--<div class="form-floating mb-1 pb-1">
                            <x-input id="password" type="password"
                                     name="password"
                                     class="form-control"
                                     placeholder="password"
                                     required autocomplete="password"/>
                            <x-label for="password" :value="__('forms.password')" required="true" />
                            <x-input-error for="password"/>
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-floating mb-1 pb-1">
                            <x-input id="password_confirmation" type="password"
                                     name="password_confirmation"
                                     class="form-control"
                                     placeholder="{{ __('general.confirm-password') }}"
                                     required autocomplete="new-password"/>
                            <x-label for="password_confirmation" :value="__('forms.confirm-password')" required="true" />
                            <x-input-error for="password_confirmation"/>
                        </div>--}}

                        <div class="mb-1 pb-1">
                            <div class="d-md-flex align-items-md-center justify-content-md-between">
                                <div class="form-check">
                                    <input name="signup_terms" type="hidden" value="0" />
                                    <input class="form-check-input @error('signup_terms'){{' is-invalid'}}@enderror"
                                           type="checkbox"
                                           value="1"
                                           id="signup_terms"
                                           {{ old('signup_terms') ? 'checked':'' }}
                                           name="signup_terms">
                                    <label class="form-check-label" for="signup_terms">{!! __('custom-messages.i-agree-terms-and-condition') !!}</label>
                                    <x-input-error for="signup_terms"/>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <x-icon-button color="btn btn-primary w-100" icon="plus">
                                {{ __('forms.register') }}
                            </x-icon-button>
                            <a class="btn btn-link w-100" href="{{ route('login') }}">
                                {{ __('forms.already-registered') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
</x-auth-layout>
