<div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
    <div class="w-100">
        <!-- Header -->
        <div class="text-center mb-5">
            {{ $logoAndFormName ?? '' }}
        </div>
        <!-- END Header -->

        <!-- Sign In Form -->
        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
        <div class="row g-0 justify-content-center">
            {{ $slot }}
        </div>
        <!-- END Sign In Form -->
    </div>
</div>
