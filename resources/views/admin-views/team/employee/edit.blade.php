@extends('layouts.back-end.app')
@php
    $lang = session()->get('locale');
@endphp

@section('title')
    {{ translate('add_new_employee') }}
@endsection
@push('css_or_js')
    <link href="{{ asset('assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #dedede;
            border: 1px solid #dedede;
            border-radius: 2px;
            color: #222;
            display: flex;
            gap: 4px;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{-- <img width="20px" src="{{ asset('/assets/back-end/img/property.jpg') }}" alt=""> --}}
                {{ translate('add_new_employee') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.team_master.inline-menu')

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('employee.update' , $employee->id) }}" method="POST"
            enctype="multipart/form-data" id="product_form">
            @csrf
            @method('patch')
            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <h4 class="mb-0">{{ translate('general_info') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('name') }}<span class="text-danger">
                                        *</span>
                                </label>
                                <input type="text" class="form-control" name="name" value="{{ old('name' , $employee->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="code" class="title-color">{{ translate('role') }}<span class="text-danger" >
                                        *</span>
                                </label>
                                <select class="js-select2-custom form-control" name="role_id" required>
                                    <option value="" selected>{{ translate('select') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ ($employee->role_id == $role->id) ? 'selected' : '' }}>{{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('role_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="code" class="title-color">{{ translate('team') }}<span
                                        class="text-danger"> *</span>
                                </label>
                                <select class="js-select2-custom form-control" name="team_id" required>
                                    <option value="" selected>{{ translate('select') }}</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"  {{ ($employee->team_id == $department->id) ? 'selected' : '' }}>{{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('team_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('username') }}<span
                                        class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="username"  value="{{ old('username' , $employee->username) }}">
                                @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('password') }} <span
                                        class="text-danger"> *</span></label>
                                <input type="text" class="form-control" name="password"  value="{{ old('password' , $employee->my_name) }}">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('email') }} </label>
                                <input type="text" class="form-control" name="email"  value="{{ old('email' , $employee->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('phone') }} </label>
                                <input type="text" class="form-control" name="phone"  value="{{ old('phone' , $employee->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>


                    </div>
                </div>
            </div>



            <div class="row justify-content-end gap-3 mt-3 mx-1">
                <button type="reset" class="btn btn-secondary px-5">{{ translate('reset') }}</button>
                <button type="submit" class="btn btn--primary px-5">{{ translate('submit') }}</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('assets/back-end/js/spartan-multi-image-picker.js') }}"></script>

    <script>
        flatpickr("#insurance_period_to", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr("#insurance_period_from", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        $(document).on('ready', function() {
            // INITIALIZATION OF SHOW PASSWORD
            // =======================================================
            $('.js-toggle-password').each(function() {
                new HSTogglePassword(this).init()
            });

            // INITIALIZATION OF FORM VALIDATION
            // =======================================================
            $('.js-validate').each(function() {
                $.HSCore.components.HSValidation.init($(this));
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // color select select2
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
@endpush
