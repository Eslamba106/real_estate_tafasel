<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{Session::get('direction')}}"
      style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->

    <title>@yield('title')</title>
    <meta name="_token" content="{{csrf_token()}}">
    <!--to make http ajax request to https-->
    <!--    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">-->
    <!-- Favicon -->
    <link rel="shortcut icon" href="">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap"
          rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/custom.css">


    <link rel="stylesheet" href="{{asset('assets/back-end')}}/vendor/icon-set/style.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/theme.minc619.css?v=1.0">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/style.css">
    @if(Session::get('direction') === "rtl")
        <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/menurtl.css">
    @endif
    {{-- light box --}}
    <link rel="stylesheet" href="{{asset('css/lightbox.css')}}">
    @stack('css_or_js')
    <!-- <style>
        :root {
            --theameColor: #045cff;
        }

        .rtl {
            direction: {{ Session::get('direction') }};
        }

        .select2-results__options {
            text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};
        }
    </style> -->
    <script
        src="{{asset('assets/back-end')}}/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js"></script>
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/toastr.css">

    @if (strstr(Request::url(),"payment/configuration/addon-payment-get") || strstr(Request::url(),"sms/configuration/addon-sms-get"))
        <style>
            .form-floating{
                position: unset;
            }
            .form-floating > label{
                position: unset;
                padding: 0;
                display: inline-block;
                margin-bottom: 0.5rem;
            }
            .form-floating > .form-control:not(:placeholder-shown){
                padding-top: 0.625rem;
                padding-left: 1rem;
                padding-right: 1rem;
            }
            .form-floating > input[type='file']{
                padding: 0.54688rem 0.875rem !important;
                height: 45px;
                line-height: 1.5;
            }
        </style>
    @endif

</head>

<body class="footer-offset">
<!-- Builder -->
@include('layouts.back-end.partials._front-settings')
<!-- End Builder -->
<span class="d-none" id="placeholderImg" data-img="{{asset('assets/back-end/img/400x400/img3.png')}}"></span>
{{--loader--}}
<div class="row">
    <div class="col-12 position-fixed z-9999 mt-10rem">
        <div id="loading" class="d--none">
            <center>
                <img width="200"
                     src="{{asset('storage/app/company')}}/{{\App\CPU\Helpers::get_business_settings('loader_gif')}}"
                     onerror="this.src='{{asset('assets/front-end/img/loader.gif')}}'">
            </center>
        </div>
    </div>
</div>
{{--loader--}}

<!-- JS Preview mode only -->
@include('layouts.back-end.partials._header')
@include('layouts.back-end.partials._side-bar')

<!-- END ONLY DEV -->

<main id="content" role="main" class="main pointer-event">
    <!-- Content -->
    @yield('content')
    <!-- End Content -->

    <!-- Footer -->
    @include('layouts.back-end.partials._footer')
    <!-- End Footer -->

    @include('layouts.back-end.partials._modals')

</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- ========== END SECONDARY CONTENTS ========== -->
<script src="{{asset('assets/back-end')}}/js/custom.js"></script>
<!-- JS Implementing Plugins -->

{{--@stack('script')--}}

<!-- JS Front -->
<script src="{{asset('assets/back-end')}}/js/vendor.min.js"></script>
<script src="{{asset('assets/back-end')}}/js/theme.min.js"></script>
<script src="{{asset('assets/back-end')}}/js/sweet_alert.js"></script>
<script src="{{asset('assets/back-end')}}/js/toastr.js"></script>
{!! Toastr::message() !!}

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif
<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {
        "use strict"

        // Convert SVG code
        // =======================================================
        $("img.svg").each(function () {
            var $img = jQuery(this);
            var imgID = $img.attr("id");
            var imgClass = $img.attr("class");
            var imgURL = $img.attr("src");

            jQuery.get(
                imgURL,
                function (data) {
                    // Get the SVG tag, ignore the rest
                    var $svg = jQuery(data).find("svg");

                    // Add replaced image's ID to the new SVG
                    if (typeof imgID !== "undefined") {
                        $svg = $svg.attr("id", imgID);
                    }
                    // Add replaced image's classes to the new SVG
                    if (typeof imgClass !== "undefined") {
                        $svg = $svg.attr("class", imgClass + " replaced-svg");
                    }

                    // Remove any invalid XML tags as per http://validator.w3.org
                    $svg = $svg.removeAttr("xmlns:a");

                    // Check if the viewport is set, else we gonna set it if we can.
                    if (
                        !$svg.attr("viewBox") &&
                        $svg.attr("height") &&
                        $svg.attr("width")
                    ) {
                        $svg.attr(
                            "viewBox",
                            "0 0 " + $svg.attr("height") + " " + $svg.attr("width")
                        );
                    }

                    // Replace image with new SVG
                    $img.replaceWith($svg);
                },
                "xml"
            );
        });


        // ONLY DEV
        // =======================================================
        if (window.localStorage.getItem('hs-builder-popover') === null) {
            $('#builderPopover').popover('show')
                .on('shown.bs.popover', function () {
                    $('.popover').last().addClass('popover-dark')
                });

            $(document).on('click', '#closeBuilderPopover', function () {
                window.localStorage.setItem('hs-builder-popover', true);
                $('#builderPopover').popover('dispose');
            });
        } else {
            $('#builderPopover').on('show.bs.popover', function () {
                return false
            });
        }
        // END ONLY DEV
        // =======================================================

        // BUILDER TOGGLE INVOKER
        // =======================================================
        $('.js-navbar-vertical-aside-toggle-invoker').click(function () {
            $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
        });

        // INITIALIZATION OF MEGA MENU
        // =======================================================
        /*var megaMenu = new HSMegaMenu($('.js-mega-menu'), {
            desktop: {
                position: 'left'
            }
        }).init();*/


        // INITIALIZATION OF NAVBAR VERTICAL NAVIGATION
        // =======================================================
        var sidebar = $('.js-navbar-vertical-aside').hsSideNav();


        // INITIALIZATION OF TOOLTIP IN NAVBAR VERTICAL MENU
        // =======================================================
        $('.js-nav-tooltip-link').tooltip({boundary: 'window'})

        $(".js-nav-tooltip-link").on("show.bs.tooltip", function (e) {
            if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
                return false;
            }
        });


        // INITIALIZATION OF UNFOLD
        // =======================================================
        $('.js-hs-unfold-invoker').each(function () {
            var unfold = new HSUnfold($(this)).init();
        });


        // INITIALIZATION OF FORM SEARCH
        // =======================================================
        $('.js-form-search').each(function () {
            new HSFormSearch($(this)).init()
        });


        // INITIALIZATION OF SELECT2
        // =======================================================
        $('.js-select2-custom').each(function () {
            var select2 = $.HSCore.components.HSSelect2.init($(this));
        });


        // INITIALIZATION OF DATERANGEPICKER
        // =======================================================
        $('.js-daterangepicker').daterangepicker();

        $('.js-daterangepicker-times').daterangepicker({
            timePicker: true,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            locale: {
                format: 'M/DD hh:mm A'
            }
        });

        var start = moment();
        var end = moment();

        function cb(start, end) {
            $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format('MMM D') + ' - ' + end.format('MMM D, YYYY'));
        }

        $('#js-daterangepicker-predefined').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);


        // INITIALIZATION OF CLIPBOARD
        // =======================================================
        $('.js-clipboard').each(function () {
            var clipboard = $.HSCore.components.HSClipboard.init(this);
        });
    });
</script>
<script>
    $("#reset").on('click', function () {
        let placeholderImg = $("#placeholderImg").data('img');
        $('#viewer').attr('src', placeholderImg);
        $('.spartan_remove_row').click();
    });

    function openInfoWeb() {
        var x = document.getElementById("website_info");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>
@stack('script')


<script src="{{asset('assets/back-end')}}/js/bootstrap.min.js"></script>
{{-- light box --}}
<script src="{{asset('js/lightbox.min.js')}}"></script>
<audio id="myAudio">
    <source src="{{asset('assets/back-end/sound/notification.mp3')}}" type="audio/mpeg">
</audio>
<script>
    var audio = document.getElementById("myAudio");

    function playAudio() {
        audio.play();
    }

    function pauseAudio() {
        audio.pause();
    }
</script>
<script>
    @if(\App\CPU\Helpers::module_permission_check('order_management') && env('APP_MODE')!='dev')
    setInterval(function () {
        $.get({
            url: '{{route('admin.get-order-data')}}',
            dataType: 'json',
            success: function (response) {
                let data = response.data;
                if (data.new_order > 0) {
                    playAudio();
                    $('#popup-modal').appendTo("body").modal('show');
                }
            },
        });
    }, 10000);
    @endif

    function check_order() {
        location.href = '{{route('admin.orders.list',['status'=>'all'])}}';
    }
</script>
<script>
    $("#search-bar-input").keyup(function () {
        $("#search-card").css("display", "block");
        let key = $("#search-bar-input").val();
        if (key.length > 0) {
            $.get({
                url: '{{url('/')}}/admin/search-function/',
                dataType: 'json',
                data: {
                    key: key
                },
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#search-result-box').empty().html(data.result)
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        } else {
            $('#search-result-box').empty();
        }
    });

    $(document).mouseup(function (e) {
        var container = $("#search-card");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
    });

    function form_alert(id, message) {
        Swal.fire({
            title: '{{translate("are_you_sure")}}?',
            text: message,
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: '{{ translate("no") }}',
            confirmButtonText: '{{ translate("yes") }}',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#' + id).submit()
            }
        })
    }
</script>

<script>
    function call_demo() {
        toastr.info('{{translate("update_option_is_disabled_for_demo")}}!', {
            CloseButton: true,
            ProgressBar: true
        });
    }
</script>

<script>
    function checkedFunc() {
        $('.switch--custom-label .toggle-switch-input').each( function() {
            if(this.checked) {
                $(this).closest('.switch--custom-label').addClass('checked')
            }else {
                $(this).closest('.switch--custom-label').removeClass('checked')
            }
        })
    }
    checkedFunc()
    $('.switch--custom-label .toggle-switch-input').on('change', checkedFunc)
</script>

<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{asset('assets/back-end')}}/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
@stack('script_2')

<!-- ck editor -->

<!-- ck editor -->

<!-- <script>
    initSample();
</script> -->

<script>

</script>
<script>
    function getRndInteger() {
        return Math.floor(Math.random() * 90000) + 100000;
    }
</script>
</body>
</html>
