/*=========================================================================================
  File Name: customizer.js
  Description: Template customizer js.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/

(function (window, document, $) {
    'use strict';

    var html = $('html'),
        body = $('body'),
        // appContent = $('.app-content'),
        mainMenu = $('.main-menu'),
        menuType = body.attr('data-menu'),
        footer = $('.footer'),
        navbar = $('.header-navbar'),
        horizontalNavbar = $('.horizontal-menu-wrapper .header-navbar'),
        navBarShadow = $('.header-navbar-shadow'),
        collapseSidebar = $('#collapse-sidebar-switch'),
        contentWrapper = $('.content-wrapper'),
        contentAreaWrapper = $('.content-area-wrapper'),
        customizer = $('.customizer'),
        flag = 0;
        // By Ihab



    // Customizer toggle & close button click events  [Remove customizer code from production]
    $('.customizer-toggle').on('click', function (e) {
        e.preventDefault();
        $(customizer).toggleClass('open');
    });
    $('.customizer-close').on('click', function () {
        $(customizer).removeClass('open');
    });

    // perfect scrollbar for customizer
    if ($('.customizer-content').length > 0) {
        var customizer_content = new PerfectScrollbar('.customizer-content');
    }

    /***** Skin Options *****/
    $('.layout-name').on('click', function () {
        var $this = $(this);
        var currentLayout = $this.data('layout');
        html.removeClass('dark-layout bordered-layout semi-dark-layout').addClass(currentLayout);
        if (currentLayout === '') {
            mainMenu.removeClass('menu-dark').addClass('menu-light');
            navbar.removeClass('navbar-dark').addClass('navbar-light');
        } else if (currentLayout === 'dark-layout') {
            mainMenu.removeClass('menu-light').addClass('menu-dark');
            navbar.removeClass('navbar-light').addClass('navbar-dark');
        } else if (currentLayout === 'semi-dark-layout') {
            mainMenu.removeClass('menu-light').addClass('menu-dark');
            navbar.removeClass('navbar-dark').addClass('navbar-light');
        } else {
            mainMenu.removeClass('menu-dark').addClass('menu-light');
            navbar.removeClass('navbar-dark').addClass('navbar-light');
        }

        // $('.horizontal-menu .header-navbar.navbar-fixed').css({
        //   background: 'inherit',
        //   'box-shadow': 'inherit'
        // });
        // $('.horizontal-menu .horizontal-menu-wrapper.header-navbar').css('background', 'inherit');
    });

    // Default Skin Selected Based on Current Layout
    var layout = html.data('layout');
    $(".layout-name[data-layout='" + layout + "']").prop('checked', true);

    collapseSidebar.on('click', function () {
        $('.modern-nav-toggle').trigger('click');
        $('.main-menu').trigger('mouseleave');
    });

    // checks if main menu is collapsed by default
    if (body.hasClass('menu-collapsed')) {
        collapseSidebar.prop('checked', true);
    } else {
        collapseSidebar.prop('checked', false);
    }

    /***** Navbar Color Options *****/
    $('#customizer-navbar-colors .color-box').on('click', function () {
        var $this = $(this);
        $this.siblings().removeClass('selected');
        $this.addClass('selected');
        var navbarColor = $this.data('navbar-color');
        // changes navbar colors
        if (navbarColor) {
            body
                .find(navbar)
                .removeClass('bg-primary bg-secondary bg-success bg-danger bg-info bg-warning bg-dark')
                .addClass(navbarColor + ' navbar-dark');
        } else {
            body
                .find(navbar)
                .removeClass('bg-primary bg-secondary bg-success bg-danger bg-info bg-warning bg-dark navbar-dark');
        }
        if (html.hasClass('dark-layout')) {
            navbar.addClass('navbar-dark');
        }
    });

    /***** Navbar Type *****/
    if (body.hasClass('horizontal-menu')) {
        $('.collapse_menu').removeClass('d-none');
        $('.collapse_sidebar').addClass('d-none');

        $('.menu_type').removeClass('d-none');
        $('.navbar_type').addClass('d-none');
        // Hides hidden option in Horizontal layout
        $('#nav-type-hidden').closest('div').css('display', 'none');

        $('#customizer-navbar-colors').hide();
        $('.customizer-menu').attr('style', 'display: none !important').next('hr').hide();
        $('.navbar-type-text').text('Nav Menu Types');
    }
    // Hides Navbar
    $('#nav-type-hidden').on('click', function () {
        navbar.addClass('d-none');
        navBarShadow.addClass('d-none');
        body.removeClass('navbar-static navbar-floating navbar-sticky').addClass('navbar-hidden');
    });
    // changes to Static navbar
    $('#nav-type-static').on('click', function () {
        if (body.hasClass('horizontal-layout')) {
            horizontalNavbar.removeClass('d-none floating-nav fixed-top navbar-fixed container-xxl');
            body.removeClass('navbar-hidden navbar-floating navbar-sticky').addClass('navbar-static');
        } else {
            navBarShadow.addClass('d-none');
            if (menuType === 'horizontal-menu') {
                horizontalNavbar.removeClass('d-none floating-nav fixed-top container-xxl').addClass('navbar-static-top');
            } else {
                navbar.removeClass('d-none floating-nav fixed-top container-xxl').addClass('navbar-static-top');
            }
            body.removeClass('navbar-hidden navbar-floating navbar-sticky').addClass('navbar-static');
        }
    });
    // change to floating navbar
    $('#nav-type-floating').on('click', function () {
        var $class;
        if (body.hasClass('horizontal-layout')) {
            if ($('#layout-width-full').prop('checked')) {
                $class = "floating-nav";
            } else {
                $class = "floating-nav container-xxl";
            }
            horizontalNavbar.removeClass('d-none fixed-top navbar-static-top').addClass($class);
            body.removeClass('navbar-static navbar-hidden navbar-sticky').addClass('navbar-floating');
        } else {
            if ($('#layout-width-full').prop('checked')) {
                $class = "floating-nav";
            } else {
                $class = "floating-nav container-xxl p-0";
            }
            navBarShadow.removeClass('d-none');
            if (menuType === 'horizontal-menu') {
                horizontalNavbar.removeClass('d-none navbar-static-top fixed-top').addClass($class);
            } else {
                navbar.removeClass('d-none navbar-static-top fixed-top').addClass($class);
            }
            body.removeClass('navbar-static navbar-hidden navbar-sticky').addClass('navbar-floating');
        }
    });
    // changes to Static navbar
    $('#nav-type-sticky').on('click', function () {
        if (body.hasClass('horizontal-layout')) {
            horizontalNavbar
                .removeClass('d-none floating-nav navbar-static-top navbar-fixed container-xxl')
                .addClass('fixed-top');
            body.removeClass('navbar-static navbar-floating navbar-hidden').addClass('navbar-sticky');
        } else {
            navBarShadow.addClass('d-none');
            if (menuType === 'horizontal-menu') {
                horizontalNavbar.removeClass('d-none floating-nav navbar-static-top').addClass('fixed-top');
            } else {
                navbar.removeClass('d-none floating-nav navbar-static-top container-xxl').addClass('fixed-top');
            }

            body.removeClass('navbar-static navbar-floating navbar-hidden').addClass('navbar-sticky');
        }
    });

    /***** Layout Width Options *****/
    // Check current Layout width and show selected layout width accordingly
    if (contentWrapper.hasClass('container-xxl') || contentAreaWrapper.hasClass('container-xxl')) {
        $('#layout-width-boxed').prop('checked', true);
    } else {
        $('#layout-width-full').prop('checked', true);
    }

    // Full Width Layout
    $('#layout-width-full').on('click', function () {
        contentWrapper.removeClass('container-xxl p-0');
        contentAreaWrapper.removeClass('container-xxl p-0');
        navbar.removeClass('container-xxl p-0');
    });
    // Boxed Layout
    $('#layout-width-boxed').on('click', function () {
        contentWrapper.addClass('container-xxl p-0');
        contentAreaWrapper.addClass('container-xxl p-0');
        if (navbar.hasClass('floating-nav')) {
            $('.floating-nav').addClass('container-xxl p-0');
        }
    });

    /***** Footer Type *****/
    // Hides footer
    $('#footer-type-hidden').on('click', function () {
        footer.addClass('d-none');
        body.removeClass('footer-static footer-fixed').addClass('footer-hidden');
    });
    // changes to Static footer
    $('#footer-type-static').on('click', function () {
        body.removeClass('footer-fixed');
        footer.removeClass('d-none').addClass('footer-static');
        body.removeClass('footer-hidden footer-fixed').addClass('footer-static');
    });
    // changes to Sticky footer
    $('#footer-type-sticky').on('click', function () {
        body.removeClass('footer-static footer-hidden').addClass('footer-fixed');
        footer.removeClass('d-none footer-static');
    });

    $(document).ready(function () {
        $(".select2").select2({
            theme: "bootstrap-5",
        });
    });
    /*containerCssClass: "select2--large", // For Select2 v4.0
    selectionCssClass: "select2--large", // For Select2 v4.1
    dropdownCssClass: "select2--large",*/


    $('.phone, .mobile').mask('(000) 000-0000');
    $('.date').mask("0000-00-00");
    $(".postal_code").mask("S0S 0S0");
    $('.sin').mask("000-000-000");
    $(".currencies, .currency").inputmask("currency", {rightAlign: false, autoUnmask: true, prefix: "$ "});
    $(".percent").inputmask("currency", {rightAlign: false, autoUnmask: true, max:100.00});
    $(".float").inputmask("currency", {rightAlign: false, autoUnmask: true});

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

    // Unison.on('change', function (bp) {
    //   if (menuType === 'horizontal-menu' && flag > 0) {
    //     if (bp.name === 'xl') {
    //       $('#nav-type-floating').trigger('click');
    //     }
    //   }
    //   flag++;
    // });
})(window, document, jQuery);

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
            confirmButton: 'btn btn-warning mx-1',
            cancelButton: 'btn btn-success mx-1'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.value) {
            $form.submit();
        }
    });
});

/*=========================================================================================
    File Name: pickers.js
    Description: Pick a date/time Picker, Date Range Picker JS
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: Pixinvent
    Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function (window, document, $) {
  'use strict';

  /*******  Flatpickr  *****/
  var basicPickr = $('.flatpickr-basic'); //,
    // timePickr = $('.flatpickr-time'),
    // dateTimePickr = $('.flatpickr-date-time'),
    // multiPickr = $('.flatpickr-multiple'),
    // rangePickr = $('.flatpickr-range'),
    // humanFriendlyPickr = $('.flatpickr-human-friendly'),
    // disabledRangePickr = $('.flatpickr-disabled-range'),
    // inlineRangePickr = $('.flatpickr-inline');

  // Default
  if (basicPickr.length) {
    basicPickr.flatpickr();
  }

  // Time
  // if (timePickr.length) {
  //   timePickr.flatpickr({
  //     enableTime: true,
  //     noCalendar: true
  //   });
  // }

  // Date & TIme
  // if (dateTimePickr.length) {
  //   dateTimePickr.flatpickr({
  //     enableTime: true
  //   });
  // }

  // Multiple Dates
  // if (multiPickr.length) {
  //   multiPickr.flatpickr({
  //     weekNumbers: true,
  //     mode: 'multiple',
  //     minDate: 'today'
  //   });
  // }

  // Range
  // if (rangePickr.length) {
  //   rangePickr.flatpickr({
  //     mode: 'range'
  //   });
  // }

  // Human Friendly
  // if (humanFriendlyPickr.length) {
  //   humanFriendlyPickr.flatpickr({
  //     altInput: true,
  //     altFormat: 'F j, Y',
  //     dateFormat: 'Y-m-d'
  //   });
  // }

  // Disabled Range
  // if (disabledRangePickr.length) {
  //   disabledRangePickr.flatpickr({
  //     dateFormat: 'Y-m-d',
  //     disable: [
  //       {
  //         from: new Date().fp_incr(2),
  //         to: new Date().fp_incr(7)
  //       }
  //     ]
  //   });
  // }

  // Inline
  // if (inlineRangePickr.length) {
  //   inlineRangePickr.flatpickr({
  //     inline: true
  //   });
  // }
  /*/!*******  Pick-a-date Picker  *****!/
  // Basic date
  $('.pickadate').pickadate();

  // Format Date Picker
  $('.format-picker').pickadate({
    format: 'mmmm, d, yyyy'
  });

  // Date limits
  $('.pickadate-limits').pickadate({
    min: [2019, 3, 20],
    max: [2019, 5, 28]
  });

  // Disabled Dates & Weeks

  $('.pickadate-disable').pickadate({
    disable: [1, [2019, 3, 6], [2019, 3, 20]]
  });

  // Picker Translations
  $('.pickadate-translations').pickadate({
    formatSubmit: 'dd/mm/yyyy',
    monthsFull: [
      'Janvier',
      'Février',
      'Mars',
      'Avril',
      'Mai',
      'Juin',
      'Juillet',
      'Août',
      'Septembre',
      'Octobre',
      'Novembre',
      'Décembre'
    ],
    monthsShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
    weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
    today: "aujourd'hui",
    clear: 'clair',
    close: 'Fermer'
  });

  // Month Select Picker
  $('.pickadate-months').pickadate({
    selectYears: false,
    selectMonths: true
  });

  // Month and Year Select Picker
  $('.pickadate-months-year').pickadate({
    selectYears: true,
    selectMonths: true
  });

  // Short String Date Picker
  $('.pickadate-short-string').pickadate({
    weekdaysShort: ['S', 'M', 'Tu', 'W', 'Th', 'F', 'S'],
    showMonthsShort: true
  });

  // Change first weekday
  $('.pickadate-firstday').pickadate({
    firstDay: 1
  });

  /!*******    Pick-a-time Picker  *****!/
  // Basic time
  $('.pickatime').pickatime();

  // Format options
  $('.pickatime-format').pickatime({
    // Escape any “rule” characters with an exclamation mark (!).
    format: 'T!ime selected: h:i a',
    formatLabel: 'HH:i a',
    formatSubmit: 'HH:i',
    hiddenPrefix: 'prefix__',
    hiddenSuffix: '__suffix'
  });

  // Format options
  $('.pickatime-formatlabel').pickatime({
    formatLabel: function (time) {
      var hours = (time.pick - this.get('now').pick) / 60,
        label = hours < 0 ? ' !hours to now' : hours > 0 ? ' !hours from now' : 'now';
      return 'h:i a <sm!all>' + (hours ? Math.abs(hours) : '') + label + '</sm!all>';
    }
  });

  // Min - Max Time to select
  $('.pickatime-min-max').pickatime({
    // Using Javascript
    min: new Date(2015, 3, 20, 7),
    max: new Date(2015, 7, 14, 18, 30)

    // Using Array
    // min: [7,30],
    // max: [14,0]
  });

  // Intervals
  $('.pickatime-intervals').pickatime({
    interval: 150
  });

  // Disable Time
  $('.pickatime-disable').pickatime({
    disable: [
      // Disable Using Integers
      3,
      5,
      7,
      13,
      17,
      21

      /!* Using Array *!/
      // [0,30],
      // [2,0],
      // [8,30],
      // [9,0]
    ]
  });

  // Close on a user action
  $('.pickatime-close-action').pickatime({
    closeOnSelect: false,
    closeOnClear: false
  });*/
})(window, document, jQuery);
