{{--<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "positionClass": "toast-top-full-width",
        "progressBar": false,
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "5000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>--}}
@php
    $errors = $errors->toArray();
    if(count($errors) > 0) {
        $error = array_shift($errors);

        request()->session()->flash('error', $error[0]);
    }
@endphp
@if(session('success'))
    @once
        @push('js_after')
            <script>
                toastr.options.progressBar = true;
                toastr.options.preventDuplicates = true;
                toastr.options.timeOut = 7500;
                toastr.options.positionClass = "toast-bottom-right";
                toastr.success("{{session('success')}}");
            </script>
        @endpush
    @endonce
@endif
@if(session('error'))
    @once
        @push('js_after')
            <script>
                toastr.options.preventDuplicates = true;
                toastr.options.positionClass = "toast-bottom-right";
                toastr.options.timeOut = 0;
                toastr.options.extendedTimeOut = 0;
                toastr.error("{{session('error')}}");
            </script>
        @endpush
    @endonce
@endif
@if(session('info'))
    @once
        @push('js_after')
            <script>
                toastr.options.timeOut = 7500;
                toastr.options.preventDuplicates = true;
                toastr.options.positionClass = "toast-bottom-right";
                toastr.info("{{session('info')}}");
            </script>
        @endpush
    @endonce
@endif
@if(session('warning'))
    @once
        @push('js_after')
            <script>
                toastr.options.timeOut = 0;
                toastr.options.extendedTimeOut = 0;
                toastr.options.preventDuplicates = true;
                toastr.options.positionClass = "toast-bottom-right";
                toastr.warning("{{session('warning')}}");
            </script>
        @endpush
    @endonce
@endif
