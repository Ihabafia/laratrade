<!doctype html>
<html class="loading light-layout {{ $mode === 'dark-layout' ? 'dark-layout':'' }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<x-app.head :title="$title"/>

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    <x-app.top-nav />
    <x-app.sidebar />
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">

            <div class="content-body">
                <x-notification-messages />
                {{ $slot }}
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <x-app.footer />

    <x-app.scripts />

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
