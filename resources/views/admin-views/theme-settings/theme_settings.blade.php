@extends('layouts.back-end.app')

@section('title', translate('general_settings'))

@push('css_or_js')
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/custom.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2"> 
                {{ translate('Theme_Setup') }}
            </h2>

            <div class="btn-group">
                <div class="ripple-animation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"
                        class="svg replaced-svg">
                        <path
                            d="M9.00033 9.83268C9.23644 9.83268 9.43449 9.75268 9.59449 9.59268C9.75449 9.43268 9.83421 9.2349 9.83366 8.99935V5.64518C9.83366 5.40907 9.75366 5.21463 9.59366 5.06185C9.43366 4.90907 9.23588 4.83268 9.00033 4.83268C8.76421 4.83268 8.56616 4.91268 8.40616 5.07268C8.24616 5.23268 8.16644 5.43046 8.16699 5.66602V9.02018C8.16699 9.25629 8.24699 9.45074 8.40699 9.60352C8.56699 9.75629 8.76477 9.83268 9.00033 9.83268ZM9.00033 13.166C9.23644 13.166 9.43449 13.086 9.59449 12.926C9.75449 12.766 9.83421 12.5682 9.83366 12.3327C9.83366 12.0966 9.75366 11.8985 9.59366 11.7385C9.43366 11.5785 9.23588 11.4988 9.00033 11.4993C8.76421 11.4993 8.56616 11.5793 8.40616 11.7393C8.24616 11.8993 8.16644 12.0971 8.16699 12.3327C8.16699 12.5688 8.24699 12.7668 8.40699 12.9268C8.56699 13.0868 8.76477 13.1666 9.00033 13.166ZM9.00033 17.3327C7.84755 17.3327 6.76421 17.1138 5.75033 16.676C4.73644 16.2382 3.85449 15.6446 3.10449 14.8952C2.35449 14.1452 1.76088 13.2632 1.32366 12.2493C0.886437 11.2355 0.667548 10.1521 0.666992 8.99935C0.666992 7.84657 0.885881 6.76324 1.32366 5.74935C1.76144 4.73546 2.35505 3.85352 3.10449 3.10352C3.85449 2.35352 4.73644 1.7599 5.75033 1.32268C6.76421 0.88546 7.84755 0.666571 9.00033 0.666016C10.1531 0.666016 11.2364 0.884905 12.2503 1.32268C13.2642 1.76046 14.1462 2.35407 14.8962 3.10352C15.6462 3.85352 16.24 4.73546 16.6778 5.74935C17.1156 6.76324 17.3342 7.84657 17.3337 8.99935C17.3337 10.1521 17.1148 11.2355 16.677 12.2493C16.2392 13.2632 15.6456 14.1452 14.8962 14.8952C14.1462 15.6452 13.2642 16.2391 12.2503 16.6768C11.2364 17.1146 10.1531 17.3332 9.00033 17.3327ZM9.00033 15.666C10.8475 15.666 12.4206 15.0168 13.7195 13.7185C15.0184 12.4202 15.6675 10.8471 15.667 8.99935C15.667 7.15213 15.0178 5.57907 13.7195 4.28018C12.4212 2.98129 10.8481 2.33213 9.00033 2.33268C7.1531 2.33268 5.58005 2.98185 4.28116 4.28018C2.98227 5.57852 2.3331 7.15157 2.33366 8.99935C2.33366 10.8466 2.98283 12.4196 4.28116 13.7185C5.57949 15.0174 7.15255 15.6666 9.00033 15.666Z"
                            fill="currentColor"></path>
                    </svg>
                </div>


                <div
                    class="dropdown-menu dropdown-menu-right bg-aliceblue border border-color-primary-light p-4 dropdown-w-lg">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img width="20" src="{{ asset('/assets/back-end/img/note.png') }}" alt="">
                        <h5 class="text-primary mb-0">{{ translate('note') }}</h5>
                    </div>
                    <p class="title-color font-weight-medium mb-0">
                        {{ translate('please_click_save_information_button_below_to_save_all_the_changes') }}</p>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <!-- Inlile Menu -->
        @include('admin-views.business-settings.business-setup-inline-menu')
        <!-- End Inlile Menu -->

        <div class="alert alert-danger d-none mb-3" role="alert">
            {{ translate('changing_some_settings_will_take_time_to_show_effect_please_clear_session_or_wait_for_60_minutes_else_browse_from_incognito_mode') }}
        </div>
        {{-- {{ route('admin.business-settings.update-info') }} --}}
        <form action="{{ route('theme_settings.update') }}" method="POST" enctype="multipart/form-data"
            @if (session()->get('locale') == 'eg') dir="rtl" @endif>
            @csrf
            <!-- Company Information -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0 text-capitalize d-flex gap-1">
                        <i class="tio-user-big"></i>
                        {{ translate('theme_Information') }}
                    </h5>
                </div>
                {{-- {{ dd($theme_setting) }} --}}
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label class="title-color d-flex">{{ translate('first_header_text') }}</label>
                                <textarea class="form-control" name="first_header_text">{{ $theme_setting['first_header_text'] }}  </textarea>

                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label class="title-color d-flex">{{ translate('first_header_paragraph') }}</label>
                                <textarea class="form-control" name="first_header_p">{{ $theme_setting['first_header_p'] }}  </textarea>

                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label class="title-color d-flex">{{ translate('about_us_header') }}</label>
                                <input class="form-control" name="about_us_header" value="{{ $theme_setting['about_us_header'] }}" /> 

                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label class="title-color d-flex">{{ translate('about_us_middle') }}</label>
                                <textarea class="form-control" name="about_us_middle">{{ $theme_setting['about_us_middle']  }}  </textarea>

                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label class="title-color d-flex">{{ translate('Happy_Clients') }}</label>
                                <input class="form-control" type="number" name="happy_clients" value="{{ $theme_setting['happy_clients'] ?? '' }}" /> 

                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label class="title-color d-flex">{{ translate('Projects') }}</label>
                                <input class="form-control" type="number" name="projects" value="{{ $theme_setting['projects'] ?? '' }}" /> 

                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label class="title-color d-flex">{{ translate('Hours_Of_Support') }}</label>
                                <input class="form-control" type="number" name="hours_of_support" value="{{ $theme_setting['hours_of_support']  ?? ''}}" /> 

                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label class="title-color d-flex">{{ translate('Hard_Workers') }}</label>
                                <input class="form-control" type="number" name="hard_workers" value="{{ $theme_setting['hard_workers']  ?? ''}}" /> 

                            </div>
                        </div>
                        


                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label class="title-color d-flex">{{ translate('about_us_footer') }}</label>
                                <textarea class="form-control" name="about_us_footer">{{ $theme_setting['about_us_footer'] }}  </textarea>

                            </div>
                        </div>

 
                    </div>
                </div>
            </div>








            <div class="col-xxl-4 col-sm-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2">
                            <img src="{{ asset('/assets/back-end/img/footer-logo.png') }}" alt="">
                            {{ translate('loading_Gif') }}
                        </h5>
                        <span class="badge badge-soft-info">( {{ translate('ratio') }} 1:1 )</span>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-around">
                        <center>
                            <img height="60" id="viewerLoader"
                                onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                src="{{ asset('storage/app/company') }}/{{ get_theme_settings('loader_gif') }}">
                        </center>
                        <div class="position-relative mt-4">
                            <input type="file" name="loader_gif" id="customFileUploadLoader" class="custom-file-input"
                                accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                            <label class="custom-file-label"
                                for="customFileUploadLoader">{{ translate('choose_File') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end" @if(session()->get('locale') == 'eg') dir="rtl" @endif>
                <button type="submit"
                    class="btn btn--primary text-capitalize px-4">{{ translate('save_information') }}</button>
            </div>
        </form>
    </div>

@endsection

@push('script')
    <script src="{{ asset('assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>
    <script>
        $("#customFileUploadShop").change(function() {
            read_image(this, 'viewerShop');
        });

        $("#customFileUploadWL").change(function() {
            read_image(this, 'viewerWL');
        });

        $("#customFileUploadWFL").change(function() {
            read_image(this, 'viewerWFL');
        });

        $("#customFileUploadML").change(function() {
            read_image(this, 'viewerML');
        });

        $("#customFileUploadFI").change(function() {
            read_image(this, 'viewerFI');
        });

        $("#customFileUploadLoader").change(function() {
            read_image(this, 'viewerLoader');
        });

        function read_image(input, id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#' + id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function(m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state
                    .text;
            }
        });
    </script>

    <script>
        @php($language = \App\Models\BusinessSetting::where('type', 'pnc_language')->first())
        @php($language = $language->value ?? null)
        let language = {{ $language }};
        $('#language').val(language);
    </script>
    {{--   //{{route('admin.maintenance-mode')}} --}}
    <script>
        $('#maintenance_mode_form').on('submit', function(e) {
            e.preventDefault();
            @if (env('APP_MODE') == 'demo')
                call_demo();
                setTimeout(() => {
                    location.reload();
                }, 3000);
            @else
                $.get({
                    url: '',
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $('#loading').fadeIn();
                    },
                    success: function(data) {
                        toastr.success(data.message);
                        location.reload();
                    },
                    complete: function() {
                        $('#loading').fadeOut();
                    },
                });
            @endif
        });

        function currency_symbol_position(route) {
            $.get({
                url: route,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#loading').fadeIn();
                },
                success: function(data) {
                    toastr.success(data.message);
                },
                complete: function() {
                    $('#loading').fadeOut();
                },
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $("#phone_verification_on").click(function() {
                @if (env('APP_MODE') != 'demo')
                    if ($('#email_verification_on').prop("checked") == true) {
                        $('#email_verification_off').prop("checked", true);
                        $('#email_verification_on').prop("checked", false);
                        const message =
                            "{{ translate('both_Phone_&_Email_verification_can_not_be_active_at_a_time') }}";
                        toastr.info(message);
                    }
                @else
                    call_demo();
                @endif
            });
            $("#email_verification_on").click(function() {
                if ($('#phone_verification_on').prop("checked") == true) {
                    $('#phone_verification_off').prop("checked", true);
                    $('#phone_verification_on').prop("checked", false);
                    const message =
                        "{{ translate('both_Phone_&_Email_verification_can_not_be_active_at_a_time') }}";
                    toastr.info(message);
                }
            });
        });
    </script>
@endpush
