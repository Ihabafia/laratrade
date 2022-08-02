<!DOCTYPE html>
<html class="loading {{ $mode === 'dark-layout' ? 'dark-layout':'light-layout' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Ihab Abou Afia">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors.min.css')) }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/colors.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/components.min.css') }}" />
    <link rel="stylesheet" href="{{ asset(mix('css/base/themes/dark-layout.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('css/base/themes/bordered-layout.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('css/base/themes/semi-dark-layout.css')) }}" />
    <link rel="stylesheet" href="{{ asset('css/base/core/menu/menu-types/vertical-menu.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/forms/form-validation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/pages/authentication.min.css') }}" />
    <link rel="stylesheet" href="{{ asset(mix('css/style.css')) }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
          integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <x-notification-messages />
            <div class="content-body">
                {{ $slot }}
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/forms/validations/jquery.validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="{{ asset('/js/lib/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('/js/lib/jquery.mask.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
    <script src="{{ asset(mix('js/core/app.js')) }}"></script>
    <script src="{{ asset(mix('js/app.js')) }}"></script>
    <!-- END: Theme JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
            integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{ asset(mix('js/scripts/pages/auth-login.js')) }}"></script>
    <!-- END: Page JS-->

    <!-- custome scripts file for user -->
    <script src="{{ asset(mix('js/core/scripts.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>
