@extends('layouts.back-end.app')

@section('title', translate('add_unit'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-product-list.png') }}" alt=""> --}}
                {{ translate('add_unit') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_config.inline-menu')

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('unit_management.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">

                        <h4 class="mb-0">{{ translate('add_unit') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('project') }}<span
                                        class="text-danger"> *</span>
                                </label>
                                <select class="js-select2-custom form-control" name="project"
                                    onchange="get_floor_by_project(this.value)" required>
                                    <option>{{ translate('select') }}
                                    </option>
                                    @foreach ($projects as $property_item)
                                        <option value="{{ $property_item->id }}">
                                            {{ $property_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('floors') }}<span
                                        class="text-danger"> *</span>
                                </label>
                                <select class="js-select2-custom form-control" name="floor" id="floor_select" required>
                                    <option selected>{{ translate('select') }} </option>
                                    {{-- @foreach ($floors as $floor_item)
                                        <option value="{{ $floor_item->id }}"   >
                                            {{ $floor_item->floor_main->name }}
                                        </option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('name') }} <span class="text-danger"> *</span></label>
                                <input name="name" type="text" class=" form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">

                            <div class="form-group">
                                <label>{{ translate('unit_description') }}</label>
                                <select name="unit_description" class="js-select2-custom form-control"
                                    id="general_unit_description">
                                    <option value="">{{ translate('no_applicable') }}</option>
                                    @foreach ($unit_descriptions as $unit_description_item)
                                        <option value="{{ $unit_description_item->id }}">
                                            {{ $unit_description_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('unit_type') }}</label>
                                <select name="unit_type" class="js-select2-custom form-control" id="general_unit_type">
                                    <option value="">{{ translate('no_applicable') }}</option>
                                    @foreach ($unit_types as $unit_type_item)
                                        <option value="{{ $unit_type_item->id }}">{{ $unit_type_item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('unit_condition') }}</label>
                                <select name="unit_condition" class="js-select2-custom form-control"
                                    id="general_unit_condition">
                                    <option value="">{{ translate('no_applicable') }}</option>
                                    @foreach ($unit_conditions as $unit_condition_item)
                                        <option value="{{ $unit_condition_item->id }}">{{ $unit_condition_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('view') }}</label>
                                <select name="view" class="js-select2-custom form-control" id="general_view">
                                    <option value="">{{ translate('no_applicable') }}</option>
                                    @foreach ($views as $view_item)
                                        <option value="{{ $view_item->id }}"> {{ $view_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('unit_parking') }}</label>
                                <select name="unit_parking" class="js-select2-custom form-control"
                                    id="general_unit_parking">
                                    <option value="">{{ translate('no_applicable') }}</option>
                                    @foreach ($unit_parkings as $unit_parking_item)
                                        <option value="{{ $unit_parking_item->id }}">{{ $unit_parking_item->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('total') }}</label>
                                <input name="price" type="number" class=" form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('cash_price') }}</label>
                                <input name="cash" type="number" class=" form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('room_counts') }}</label>
                                <input name="room_counts" type="number" class=" form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('bath_room_counts') }}</label>
                                <input name="bath_room_counts" type="number" class=" form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('net_Area') }}</label>
                                <input name="ratio" type="number" class=" form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('down_Payment') }}</label>
                                <input name="down_payment" type="number" class=" form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="area-measurement">{{ translate('payment_mode') }} </label>
                                <select id="area-measurement" name="payment_mode" class="js-select2-custom form-control">
                                    <option value="">{{ translate('select_payment_mode') }}</option>
                                    <option value="1">{{ translate('monthly') }}</option>
                                    <option value="2">{{ translate('bi_monthly') }}</option>
                                    <option value="3">{{ translate('quarterly') }}</option>
                                    <option value="4">{{ translate('half_yearly') }}</option>
                                    <option value="5">{{ translate('yearly') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('installment') }}</label>
                                <input name="installment" type="number" class=" form-control" />
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('maintenance') }}</label>
                                <input name="maintenance" type="number" class=" form-control" />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('area') }}</label>
                                <input name="area" type="number" class=" form-control" />
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
    <script>
        function get_floor_by_project(project_id) {
            if (!project_id) return;

            $.ajax({
                url: '{{ route('get.floors.by.project') }}',
                type: 'GET',
                data: {
                    project_id: project_id
                },
                success: function(response) {
                    $('#floor_select').empty().append('<option value="">{{ translate('select') }}</option>');

                    response.floors.forEach(function(floor) {
                        $('#floor_select').append('<option value="' + floor.id + '">' + floor.floor_main
                            .name + '</option>');
                    });
                },
                error: function(xhr) {
                    alert('Error fetching floors');
                }
            });
        }
    </script>
@endpush
