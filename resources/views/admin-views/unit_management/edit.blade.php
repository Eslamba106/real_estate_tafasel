@extends('layouts.back-end.app')

@section('title', translate('edit_unit' ))
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
                {{ translate('edit_unit' ) }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_config.inline-menu')

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('unit_management.update'  ,$selected_unit->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        
                        <h4 class="mb-0">{{ translate('edit_unit' ) }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('project' ) }}<span class="text-danger"> *</span>
                                </label>
                                <select class="js-select2-custom form-control" name="project" id="project"   required>
                                    <option  >{{ translate('select' ) }}
                                    </option>
                                    @foreach ($projects as $property_item)
                                        <option value="{{ $property_item->id }}" @if($selected_unit->project_id ==  $property_item->id ) selected @endif >
                                            {{ $property_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('floors' ) }}<span class="text-danger"> *</span>
                                </label>
                                <select class="js-select2-custom form-control" name="floor" id="floor" required >
                                    <option selected>{{ translate('select' ) }}
                                    </option>
                                    @foreach ($floors as $floor_item)
                                        <option value="{{ $floor_item->id }}"  @if($selected_unit->floor_management_id ==  $floor_item->id ) selected @endif >
                                            {{ $floor_item->floor_main->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('unit_Name' ) }}<span class="text-danger"> *</span>
                                </label>
                                <input type="text" class=" form-control" name="name" value="{{ $selected_unit->name }}" required>
                                     
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-3">

                            <div class="form-group">
                                <label>{{ translate('unit_description' ) }}</label>
                                <select name="unit_description" class="js-select2-custom form-control"
                                    id="general_unit_description">
                                    <option value="" >{{ translate('no_applicable' ) }}</option>
                                    @foreach ($unit_descriptions as $unit_description_item)
                                        <option value="{{ $unit_description_item->id }}"  @if($selected_unit->unit_description_id ==  $unit_description_item->id ) selected @endif >
                                            {{ $unit_description_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('unit_type' ) }}</label>
                                <select name="unit_type" class="js-select2-custom form-control" id="general_unit_type">
                                    <option value="" >{{ translate('no_applicable' ) }}</option>
                                    @foreach ($unit_types as $unit_type_item)
                                        <option value="{{ $unit_type_item->id }}" @if($selected_unit->unit_type_id ==  $unit_type_item->id ) selected @endif >{{ $unit_type_item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('unit_condition' ) }}</label>
                                <select name="unit_condition" class="js-select2-custom form-control"
                                    id="general_unit_condition">
                                    <option value="" >{{ translate('no_applicable' ) }}</option>
                                    @foreach ($unit_conditions as $unit_condition_item)
                                        <option value="{{ $unit_condition_item->id }}" @if($selected_unit->unit_condition_id ==  $unit_condition_item->id ) selected @endif >{{ $unit_condition_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('view' ) }}</label>
                                <select name="view" class="js-select2-custom form-control" id="general_view">
                                    <option value="">{{ translate('no_applicable' ) }}</option>
                                    @foreach ($views as $view_item)
                                        <option value="{{ $view_item->id }}"  @if($selected_unit->view_id ==  $view_item->id ) selected @endif > {{ $view_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('unit_parking' ) }}</label>
                                <select name="unit_parking" class="js-select2-custom form-control"
                                    id="general_unit_parking">
                                    <option value="" >{{ translate('no_applicable' ) }}</option>
                                    @foreach ($unit_parkings as $unit_parking_item)
                                        <option value="{{ $unit_parking_item->id }}" @if($selected_unit->unit_parking_id ==  $unit_parking_item->id ) selected @endif>{{ $unit_parking_item->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                           <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('price' ) }}</label>
                                <input name="price" type="number"  value="{{ $selected_unit->price }}" class=" form-control"/> 
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('room_counts' ) }}</label>
                                <input name="room_counts" type="number"  value="{{ $selected_unit->room_counts }}" class=" form-control"/> 
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('bath_room_counts' ) }}</label>
                                <input name="bath_room_counts" type="number"  value="{{ $selected_unit->bath_room_counts }}" class=" form-control"/> 
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('ratio' ) }} %</label>
                                <input name="ratio" type="number"  value="{{ $selected_unit->ratio }}" class=" form-control"/> 
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ translate('area' ) }}</label>
                                <input name="area" type="number"  value="{{ $selected_unit->area }}" class=" form-control"/> 
                            </div>
                        </div>

                    </div>
                </div>
            </div>




            <div class="row justify-content-end gap-3 mt-3 mx-1">
                <button type="reset" class="btn btn-secondary px-5">{{ translate('reset' ) }}</button>
                <button type="submit" class="btn btn--primary px-5">{{ translate('submit' ) }}</button>
            </div>
        </form>



    </div>
@endsection
@push('script')
@endpush
