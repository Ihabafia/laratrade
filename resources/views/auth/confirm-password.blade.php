<x-auth-layout>
    <x-auth-card>
        <x-slot name="logoAndFormName">
            <p class="mb-3">
                <x-application-logo width="82"/>
            </p>
            <h1 class="fw-bold mb-2">
                {{ __('Confirm Password') }}
            </h1>
            <p class="fw-medium text-muted">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </p>
        </x-slot>

        <div class="card-body">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.confirm') }}" class="mx-sm-4 mx-md-6 mx-lg-6  mx-xl-8">
            @csrf

            <!-- Password -->
            <div class="mb-3">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="d-flex justify-content-end mt-4">
                <x-button class="ms-4">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
        </div>
    </x-auth-card>
</x-auth-layout>
