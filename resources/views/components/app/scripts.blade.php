<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>
@stack('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>
<script src="{{ asset(mix('js/app.js')) }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
<script src="{{ asset('/js/lib/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('/js/lib/jquery.mask.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"
        integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
{{--<script src="{{ asset('app-assets/js/scripts/extensions/ext-component-sweet-alerts.js') }}"></script>--}}
<livewire:scripts/>

<!-- Page JS Plugins -->
<script defer src="https://unpkg.com/alpinejs@3.9.1/dist/cdn.min.js"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

<script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@stack('js_after')
<!-- END: Page JS-->
