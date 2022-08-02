<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>
        @php($page = $title ? ' - ' . $title:'')
        {{ config('app.name') . $page }}
    </title>

    <meta property="og:title" content="Borrowers Marketplace">
    <meta property="og:site_name" content="Borrowers Marketplace">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/vendors.min.css')) }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/colors.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/components.min.css') }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/themes/dark-layout.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('css/base/themes/bordered-layout.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('css/base/themes/semi-dark-layout.css')) }}" />
    <link rel="stylesheet" href="{{ asset(mix('css/base/core/menu/menu-types/vertical-menu.css')) }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/forms/pickers/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"
          integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

{{--    <link rel="stylesheet" href="{{ asset(mix('css/core.css')) }}" />--}}
    <!-- laravel style -->
{{--    <link rel="stylesheet" href="{{ asset(mix('css/overrides.css')) }}" />--}}
    {{-- user custom styles --}}
    <link rel="stylesheet" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('app-assets/css/plugins/extensions/ext-component-sweet-alerts.min.css') }}" />
    <link rel="stylesheet" href="{{ asset(mix('css/style.css')) }}" />

    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
    <!-- Scripts -->
    @stack('css_after')
    <livewire:styles />
</head>
<!-- END: Head-->
