let mode = window.localStorage.getItem('dark');
loadMode(mode);
One.layout('sidebar_style_dark');

const modeToggle = document.getElementById('mode_toggle');
document.getElementById("mode_toggle").addEventListener("click", function() {
    let mode = window.localStorage.getItem('dark');
    toggleMode(mode);
});
function loadMode(mode) {
    mode === '1' ? One.layout('dark_mode_on') : One.layout('dark_mode_off');
}
function toggleMode(mode) {
    if (mode === '1') {
        One.layout('dark_mode_off');
        One.layout('sidebar_style_dark');
        window.localStorage.setItem('dark', '0');
    } else {
        One.layout('dark_mode_on');
        window.localStorage.setItem('dark', '1');
    }
}

$(document).ready(function () {
    $(".select2").select2({
        theme: "bootstrap-5",
    });
});
    /*containerCssClass: "select2--large", // For Select2 v4.0
    selectionCssClass: "select2--large", // For Select2 v4.1
    dropdownCssClass: "select2--large",*/

$(document).on("click", ".js_confirmation", function (e) {
    e.preventDefault();
    $form = $(this).closest('.confirmation_form');
    message = $(this).data('message');
    icon = $(this).data('icon') ?? 'warning';

    Swal.fire({
        title: 'Are you sure?',
        text: message,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: "Yes, let's do it",
        cancelButtonText: "No, cancel!",

        allowEscapeKey: true,
        focusCancel: true,
        allowOutsideClick: false,
        allowEnterKey: true,

        customClass: {
            confirmButton: 'btn btn-warning',
            cancelButton: 'btn btn-success'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.value) {
            $form.submit();
        }
    });
});

$('.phone, .mobile').mask('(000) 000-0000');
$('.date').mask("0000-00-00");
$(".postal_code").mask("S0S 0S0");
$('.sin').mask("000-000-000");
$(".currencies, .currency").inputmask("currency", {rightAlign: false, autoUnmask: true, prefix: "$ "});

$(".masked-form").on('submit', function () {
    unmaskAll();
});

function unmaskAll() {
    $('.mobile, .phone, .date, .postal_code, .sin').unmask();
    $('.currencies, .currency').inputmask('remove');
}

function dateIt(element, options = []) {
    obj = {
        autoclose: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
    };
    var all = $.extend({}, obj, options);
    $(element).datepicker(all);
}
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
  return new bootstrap.Popover(popoverTriggerEl)
})
