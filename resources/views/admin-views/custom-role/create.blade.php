@extends('layouts.back-end.app')
@section('title', translate('create_Role'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{ asset('/public/assets/back-end/img/add-new-seller.png') }}" alt="">
                {{ translate('employee_Role_Setup') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="card">
            <div class="card-body">
                <form id="submit-create-role" method="post" action="{{ route('role_admin.store') }}"
                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="name" class="title-color">{{ translate('role_name') }}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    aria-describedby="emailHelp"
                                    placeholder="{{ translate('ex') }} : {{ translate('store') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-4 flex-wrap">
                        <label for="name" class="title-color font-weight-bold mb-0">{{ translate('module_permission') }}
                        </label>
                        <div class="form-group d-flex gap-2">
                            <input type="checkbox" id="select_all" class="cursor-pointer">
                            <label class="title-color mb-0 cursor-pointer"
                                for="select_all">{{ translate('select_All') }}</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="section-card   col-4 col-md-6 col-lg-4  mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="unit_decription" value="unit_decription"
                                        class="form-check-input mt-0 section-parent module-permission">
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="unit_decription">
                                        {{ translate('unit_decription') }}
                                    </label>
                                </div>

                                <div class="card-body">

                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_unit_decription"
                                            value="add_unit_decription"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_unit_decription">
                                            {{ translate('add_unit_decription') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_unit_decription"
                                            value="edit_unit_decription"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_unit_decription">
                                            {{ translate('edit_unit_decription') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_unit_decription"
                                            value="delete_unit_decription"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_unit_decription">
                                            {{ translate('delete_unit_decription') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]"
                                            id="change_status_unit_decription" value="change_status_unit_decription"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_unit_decription">
                                            {{ translate('change_status_unit_decription') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4  mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="unit_condition" value="unit_condition"
                                        class="form-check-input mt-0 section-parent module-permission">
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="unit_condition">
                                        {{ translate('unit_condition') }}
                                    </label>
                                </div>

                                <div class="card-body">

                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_unit_condition"
                                            value="add_unit_condition"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_unit_condition">
                                            {{ translate('add_unit_condition') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_unit_condition"
                                            value="edit_unit_condition"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_unit_condition">
                                            {{ translate('edit_unit_condition') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_unit_condition"
                                            value="delete_unit_condition"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_unit_condition">
                                            {{ translate('delete_unit_condition') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]"
                                            id="change_status_unit_condition" value="change_status_unit_condition"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_unit_condition">
                                            {{ translate('change_status_unit_condition') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4  mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="unit_type" value="unit_type"
                                        class="form-check-input mt-0 section-parent module-permission">
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="unit_type">
                                        {{ translate('unit_type') }}
                                    </label>
                                </div>

                                <div class="card-body">

                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_unit_type"
                                            value="add_unit_type"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_unit_type">
                                            {{ translate('add_unit_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_unit_type"
                                            value="edit_unit_type"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_unit_type">
                                            {{ translate('edit_unit_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_unit_type"
                                            value="delete_unit_type"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_unit_type">
                                            {{ translate('delete_unit_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]"
                                            id="change_status_unit_type" value="change_status_unit_type"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_unit_type">
                                            {{ translate('change_status_unit_type') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4  mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="view" value="view"
                                        class="form-check-input mt-0 section-parent module-permission">
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="view">
                                        {{ translate('view') }}
                                    </label>
                                </div>

                                <div class="card-body">

                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_view" value="add_view"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_view">
                                            {{ translate('add_view') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_view" value="edit_view"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_view">
                                            {{ translate('edit_view') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_view" value="delete_view"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_view">
                                            {{ translate('delete_view') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_view"
                                            value="change_status_view"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_view">
                                            {{ translate('change_status_view') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="property_type" value="property_type"
                                        class="form-check-input mt-0 section-parent module-permission">
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="property_type">
                                        {{ translate('property_type') }}
                                    </label>
                                </div>

                                <div class="card-body">

                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_property_type"
                                            value="add_property_type"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_property_type">
                                            {{ translate('add_property_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_property_type"
                                            value="edit_property_type"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_property_type">
                                            {{ translate('edit_property_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_property_type"
                                            value="delete_property_type"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_property_type">
                                            {{ translate('delete_property_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]"
                                            id="change_status_property_type" value="change_status_property_type"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_property_type">
                                            {{ translate('change_status_property_type') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="floor" value="floor"
                                        class="form-check-input mt-0 section-parent module-permission">
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="floor">
                                        {{ translate('floor') }}
                                    </label>
                                </div>

                                <div class="card-body">

                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_floor"
                                            value="add_floor"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_floor">
                                            {{ translate('add_floor') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_floor"
                                            value="edit_floor"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_floor">
                                            {{ translate('edit_floor') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_floor"
                                            value="delete_floor"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_floor">
                                            {{ translate('delete_floor') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]"
                                            id="change_status_floor" value="change_status_floor"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_floor">
                                            {{ translate('change_status_floor') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="projects" value="projects"
                                        class="form-check-input mt-0 section-parent module-permission">
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="projects">
                                        {{ translate('projects') }}
                                    </label>
                                </div>

                                <div class="card-body">

                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_project"
                                            value="add_project"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_project">
                                            {{ translate('add_project') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_project"
                                            value="edit_project"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_project">
                                            {{ translate('edit_project') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_project"
                                            value="delete_project"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_project">
                                            {{ translate('delete_project') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]"
                                            id="change_status_project" value="change_status_project"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_project">
                                            {{ translate('change_status_project') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="floor_management" value="floor_management"
                                        class="form-check-input mt-0 section-parent module-permission">
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="floor_management">
                                        {{ translate('floor_management') }}
                                    </label>
                                </div>

                                <div class="card-body">

                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_floor_management"
                                            value="add_floor_management"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_floor_management">
                                            {{ translate('add_floor_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_floor_management"
                                            value="edit_floor_management"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_floor_management">
                                            {{ translate('edit_floor_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_floor_management"
                                            value="delete_floor_management"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_floor_management">
                                            {{ translate('delete_floor_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]"
                                            id="change_status_floor_management" value="change_status_floor_management"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_floor_management">
                                            {{ translate('change_status_floor_management') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="unit_management" value="unit_management"
                                        class="form-check-input mt-0 section-parent module-permission">
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="unit_management">
                                        {{ translate('unit_management') }}
                                    </label>
                                </div>

                                <div class="card-body">

                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_unit_management"
                                            value="add_unit_management"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_unit_management">
                                            {{ translate('add_unit_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_unit_management"
                                            value="edit_unit_management"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_unit_management">
                                            {{ translate('edit_unit_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_unit_management"
                                            value="delete_unit_management"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_unit_management">
                                            {{ translate('delete_unit_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]"
                                            id="change_status_unit_management" value="change_status_unit_management"
                                            class="form-check-input section-child module-permission">
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_unit_management">
                                            {{ translate('change_status_unit_management') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>










                    </div>
                    {{-- <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" value="dashboard" class="module-permission"
                                    id="dashboard">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="dashboard">{{ translate('dashboard') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" value="unit_master" class="module-permission"
                                    id="unit_master">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="unit_master">{{ translate('unit_master') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" value="unit_description" class="module-permission"
                                    id="unit_description">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="unit_description">{{ translate('unit_description') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" value="add_unit_description" class="module-permission"
                                    id="add_unit_description">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="add_unit_description">{{ translate('add_unit_description') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" value="edit_unit_description" class="module-permission"
                                    id="edit_unit_description">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="edit_unit_description">{{ translate('edit_unit_description') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" value="delete_unit_description" class="module-permission"
                                    id="delete_unit_description">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="delete_unit_description">{{ translate('delete_unit_description') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="unit_condition"
                                    id="unit_condition">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="unit_condition">{{ translate('unit_condition') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="add_unit_condition"
                                    id="add_unit_condition">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="add_unit_condition">{{ translate('add_unit_condition') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="edit_unit_condition"
                                    id="edit_unit_condition">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="edit_unit_condition">{{ translate('edit_unit_condition') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="delete_unit_condition"
                                    id="delete_unit_condition">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="delete_unit_condition">{{ translate('delete_unit_condition') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="unit_type"
                                    id="unit_type">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="unit_type">{{ translate('unit_type') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="add_unit_type"
                                    id="add_unit_type">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="add_unit_type">{{ translate('add_unit_type') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="edit_unit_type"
                                    id="edit_unit_type">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="edit_unit_type">{{ translate('edit_unit_type') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="delete_unit_type"
                                    id="delete_unit_type">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="delete_unit_type">{{ translate('delete_unit_type') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="unit_parking" id="unit_parking">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="unit_parking">{{ translate('unit_parking') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="add_unit_parking" id="add_unit_parking">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="add_unit_parking">{{ translate('add_unit_parking') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="edit_unit_parking" id="edit_unit_parking">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="edit_unit_parking">{{ translate('edit_unit_parking') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="delete_unit_parking" id="delete_unit_parking">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="delete_unit_parking">{{ translate('delete_unit_parking') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" class="module-permission" value="view"
                                    id="view">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="view">{{ translate('view') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="property_type"
                                    id="property_type">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="property_type">{{ translate('property_type') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="floor" id="floor">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="floor">{{ translate('floor') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="project" id="project">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="project">{{ translate('project') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="floor_management"
                                    id="floor_management">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="floor_management">{{ translate('floor_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="units" id="units">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="units">{{ translate('units') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="facility_transactions" id="facility_transactions">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="facility_transactions">{{ translate('facility_transactions') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="facility_reports" id="facility_reports">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="facility_reports">{{ translate('facility_reports') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="general_management" id="general_management">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="general_management">{{ translate('general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="settings"
                                    id="settings">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="settings">{{ translate('settings') }}</label>
                            </div>
                        </div>

                    </div> --}}

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn--primary">{{ translate('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('public/assets/back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ translate('are_you_sure_delete_this_role') }}?",
                text: "{{ translate('you_will_not_be_able_to_revert_this') }}!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ translate('yes_delete_it') }}!",
                cancelButtonText: "{{ translate('cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('role_admin.delete') }}",
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success(
                                "{{ translate('role_deleted_successfully') }}"
                            );
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
    <script>
        $('#submit-create-role').on('submit', function(e) {

            var fields = $("input[name='modules[]']").serializeArray();
            if (fields.length === 0) {
                toastr.warning("{{ translate('select_minimum_one_selection_box') }}", {
                    CloseButton: true,
                    ProgressBar: true
                });
                return false;
            } else {
                $('#submit-create-role').submit();
            }
        });
    </script>
    <script>
        $('.employee_role_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success == 1) {
                        toastr.success(response.message);
                    }
                }
            });
        });
    </script>

    <script>
        $("#select_all").on('change', function() {
            if ($("#select_all").is(":checked") === true) {
                console.log($("#select_all").is(":checked"));
                $(".module-permission").prop("checked", true);
            } else {
                $(".module-permission").removeAttr("checked");
            }
        });

        function checkbox_selection_check() {
            let nonEmptyCount = 0;
            $(".module-permission").each(function() {
                if ($(this).is(":checked") !== true) {
                    nonEmptyCount++;
                }
            });
            if (nonEmptyCount == 0) {
                $("#select_all").prop("checked", true);
            } else {
                $("#select_all").removeAttr("checked");
            }
        }

        $('.module-permission').click(function() {
            checkbox_selection_check();
        });
    </script>

    <script src="{{ asset(main_path() . 'js/roles.min.js') }}"></script>
@endpush
