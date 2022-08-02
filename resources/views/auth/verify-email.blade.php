<x-auth-layout>
    <div class="auth-wrapper auth-basic px-2">
        <div class="auth-inner my-2">
            <!-- Login basic -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="brand-logo mx-auto mb-3">
                        <img class="logo" src="{{ asset("img/ltt-{$mode}-logo.svg") }}" style="max-width: 300px">
                    </div>
                    <p class="mx-1 text-center">
                        {!! __('messages.registered-verify') !!}
                    </p>


                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success" role="alert">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif

                    <div class="mt-2 text-center mx-8">
                        <form method="POST" action="{{ route('verification.re-send', $user) }}">
                            @csrf

                            <div class="text-center">
                                <button type="submit"
                                        class="btn btn-primary me-md-0"
                                >
                                    <i class="fa fa-check"></i>
                                    {{ __('Resend Verification Email') }}
                                </button>


                                {{--<x-icon-button color="primary" icon="">
                                    {{ __('Resend Verification Email') }}
                                </x-icon-button>--}}
                            </div>
                        </form>

                        {{--<form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="btn btn-link">
                                {{ __('Log Out') }}
                            </button>
                        </form>--}}
                    </div>

                </div>
            </div>
            <!-- /Login basic -->
        </div>
    </div>
</x-auth-layout>
