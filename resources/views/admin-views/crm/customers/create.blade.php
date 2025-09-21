@extends('layouts.back-end.app')
@php
    $lang = session()->get('locale');
@endphp

@section('title')
    {{ translate('add_new_customer') }}
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
                {{ translate('add_new_customer') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.team_master.inline-menu')

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('customer.store') }}" method="POST"
            enctype="multipart/form-data" id="product_form">
            @csrf
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
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('phone') }} <span
                                        class="text-danger">
                                        *</span></label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="code" class="title-color">{{ translate('project') }}<span
                                        class="text-danger">
                                        *</span>
                                </label>
                                <select class="js-select2-custom form-control" onchange="floor(this)" name="project_id"
                                    required>
                                    <option value="" selected>{{ translate('select') }}</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('project_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="code" class="title-color">{{ translate('floor') }}<span
                                        class="text-danger"> *</span>
                                </label>
                                <select class="js-select2-custom form-control" onchange="units(this)" name="floor_id"
                                    required>
                                    <option value="" selected>{{ translate('select') }}</option>

                                </select>
                            </div>
                            @error('floor_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="code" class="title-color">{{ translate('unit') }}<span class="text-danger">
                                        *</span>
                                </label>
                                <select class="js-select2-custom form-control" name="unit_id" required>
                                    <option value="" selected>{{ translate('select') }}</option>

                                </select>
                            </div>
                            @error('unit_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('email') }} </label>
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="budget" class="title-color">{{ translate('budget') }} </label>
                                <input type="number" class="form-control" name="budget" value="{{ old('budget') }}">
                                @error('budget')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-4">
                            <div class="form-group">
                                <label for="job" class="title-color">{{ translate('job') }} </label>
                                <input type="text" class="form-control" name="job" value="{{ old('job') }}">
                                @error('job')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <h4 class="mb-0">{{ translate('assign_To_Team') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="code" class="title-color">{{ translate('teams') }}<span
                                        class="text-danger">
                                        *</span>
                                </label>
                                <select class="js-select2-custom form-control" onchange="employee(this)" name="team_id"
                                     >
                                    <option value="">{{ translate('select') }}</option>
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}
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
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="code" class="title-color">{{ translate('employee') }}<span
                                        class="text-danger"> *</span>
                                </label>
                                <select class="js-select2-custom form-control" name="employee_id"  >
                                    <option value="" selected>{{ translate('select') }}</option>

                                </select>
                            </div>
                            @error('employee_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">{{ translate('remark') }}
                                </label>
                                <textarea class="form-control" cols="30" rows="2" name="assign_note"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <h4 class="mb-0">{{ translate('add_Action') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">{{ translate('title') }}
                                </label>
                                <input type="text" class="form-control main_date" name="activity">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">{{ translate('remark') }}
                                </label>
                                <textarea class="form-control" cols="30" rows="2" name="action_note"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <h4 class="mb-0">{{ translate('add_Reminder') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group">
                                <label for="" class="form-control-label">{{ translate('reminder_at') }}
                                </label>
                                <input type="date" class="form-control main_date" name="reminder_at">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-12 col-xl-12">
                            <div class="form-group">
                                <label for="" class="form-control-label">{{ translate('remark') }}
                                </label>
                                <textarea class="form-control" cols="30" rows="2" name="reminder_note"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row justify-content-end gap-3 mt-3 mx-1 m-2">
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

    <script>
        function floor(element) {
            var id = element.value;

            $.ajax({
                url: "{{ route('customer.get_floors_by_project', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var Select = $("select[name='floor_id']");
                    Select.empty();
                    Select.append('<option value="">{{ translate('select_floor') }}</option>');
                    console.log(data)
                    if (data.floors && Array.isArray(data.floors) && data.floors.length > 0) {
                        data.floors.forEach(function(floor) {
                            Select.append(
                                `<option value="${floor.id}">${floor.floor_main?.name}</option>`
                            );
                        });
                    } else {
                        console.warn("No floor returned.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching floor :', error);
                }
            });
        }

        function units(element) {
            var id = element.value;

            $.ajax({
                url: "{{ route('customer.get_unit_by_floor', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var Select = $("select[name='unit_id']");
                    Select.empty();
                    Select.append('<option value="">{{ translate('select_unit') }}</option>');

                    // console.log(data)
                    // console.log("nnn " + data.sub_categories)
                    if (data.units && Array.isArray(data.units) && data.units.length > 0) {
                        data.units.forEach(function(unit) {
                            Select.append(
                                `<option value="${unit.id}">${unit.name}</option>`
                            );
                        });
                    } else {
                        console.warn("No unit returned.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching unit:', error);
                }
            });
        }
    </script>

    <script>
        function employee(element) {
            var id = element.value;

            $.ajax({
                url: "{{ route('customer.get_employee_by_team_id', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var Select = $("select[name='employee_id']");
                    Select.empty();
                    Select.append('<option value="">{{ translate('select_employee') }}</option>');
                    console.log(data)
                    if (data.employees && Array.isArray(data.employees) && data.employees.length > 0) {
                        data.employees.forEach(function(employee) {
                            Select.append(
                                `<option value="${employee.id}">${employee.name}</option>`
                            );
                        });
                    } else {
                        console.warn("No employee returned.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching employee :', error);
                }
            });
        }
    </script>
@endpush
