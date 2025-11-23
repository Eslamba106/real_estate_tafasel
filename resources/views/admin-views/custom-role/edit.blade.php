@extends('layouts.back-end.app')
@section('title', translate('edit_Role'))
@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{ asset('/assets/back-end/img/add-new-seller.png') }}" alt="">
                {{ translate('role_Update') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        @php
            $module_access = $role->module_access ? json_decode($role->module_access, true) : [];
        @endphp

        <div class="card">
            <div class="card-body">
                <form id="submit-edit-role" method="post" action="{{ route('role_admin.update', ['id' => $role->id]) }}"
                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">

                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="name" class="title-color">{{ translate('role_name') }}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name', $role->name) }}"
                                    placeholder="{{ translate('ex') }} : {{ translate('store') }}" required>
                            </div>
                        </div> 
                    </div>

                    <div class="d-flex gap-4 flex-wrap">
                        <label for="is_admin"
                            class="title-color font-weight-bold mb-0">{{ translate('is_admin') }}
                        </label>
                        <div class="form-group d-flex gap-2">
                            <input value="1" type="checkbox" name="is_admin" {{ $role->is_admin == 1 ? 'checked' : '' }} class="cursor-pointer">
                            <label class="title-color mb-0 cursor-pointer"
                                for="is_admin" >{{ translate('is_admin') }}</label>
                        </div>
                    </div> 
                    <div class="d-flex gap-4 flex-wrap">
                        <label for="is_team_leader"
                            class="title-color font-weight-bold mb-0">{{ translate('is_team_leader') }}
                        </label>
                        <div class="form-group d-flex gap-2">
                            <input value="1" type="checkbox"  @checked($role->is_team_leader == 1) name="is_team_leader"  class="cursor-pointer">
                            <label class="title-color mb-0 cursor-pointer"
                                for="is_team_leader">{{ translate('is_team_leader') }}</label>
                        </div>
                    </div>

                    <div class="d-flex gap-4 flex-wrap">
                        <label for="name"
                            class="title-color font-weight-bold mb-0">{{ translate('module_permission') }}
                        </label>
                        <div class="form-group d-flex gap-2">
                            <input type="checkbox" id="select_all" class="cursor-pointer">
                            <label class="title-color mb-0 cursor-pointer"
                                for="select_all">{{ translate('select_All') }}</label>
                        </div>
                    </div>

                    <div class="row mb-3">

                        @php
                            function is_checked($module, $access_array)
                            {
                                return in_array($module, $access_array) ? 'checked' : '';
                            }
                        @endphp

                        <div class="section-card col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="unit_decription" value="unit_decription"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('unit_decription', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="unit_decription">
                                        {{ translate('unit_decription') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_unit_description"
                                            value="show_all_unit_description"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_unit_description', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_unit_description">
                                            {{ translate('show_all_unit_description') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_unit_decription"
                                            value="add_unit_decription"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_unit_decription', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_unit_decription">
                                            {{ translate('add_unit_decription') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_unit_decription"
                                            value="edit_unit_decription"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_unit_decription', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_unit_decription">
                                            {{ translate('edit_unit_decription') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_unit_decription"
                                            value="delete_unit_decription"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_unit_decription', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_unit_decription">
                                            {{ translate('delete_unit_decription') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_unit_decription"
                                            value="change_status_unit_decription"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_unit_decription', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_unit_decription">
                                            {{ translate('change_status_unit_decription') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="unit_condition" value="unit_condition"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('unit_condition', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="unit_condition">
                                        {{ translate('unit_condition') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_unit_condition"
                                            value="show_all_unit_condition"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_unit_condition', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_unit_condition">
                                            {{ translate('show_all_unit_condition') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_unit_condition"
                                            value="add_unit_condition"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_unit_condition', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_unit_condition">
                                            {{ translate('add_unit_condition') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_unit_condition"
                                            value="edit_unit_condition"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_unit_condition', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_unit_condition">
                                            {{ translate('edit_unit_condition') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_unit_condition"
                                            value="delete_unit_condition"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_unit_condition', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_unit_condition">
                                            {{ translate('delete_unit_condition') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_unit_condition"
                                            value="change_status_unit_condition"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_unit_condition', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_unit_condition">
                                            {{ translate('change_status_unit_condition') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="unit_type" value="unit_type"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('unit_type', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="unit_type">
                                        {{ translate('unit_type') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_unit_type"
                                            value="show_all_unit_type"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_unit_type', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_unit_type">
                                            {{ translate('show_all_unit_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_unit_type" value="add_unit_type"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_unit_type', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_unit_type">
                                            {{ translate('add_unit_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_unit_type"
                                            value="edit_unit_type"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_unit_type', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_unit_type">
                                            {{ translate('edit_unit_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_unit_type"
                                            value="delete_unit_type"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_unit_type', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_unit_type">
                                            {{ translate('delete_unit_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_unit_type"
                                            value="change_status_unit_type"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_unit_type', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_unit_type">
                                            {{ translate('change_status_unit_type') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="view" value="view"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('view', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="view">
                                        {{ translate('view') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_view" value="add_view"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_view', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_view">
                                            {{ translate('add_view') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_view" value="show_all_view"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_view', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_view">
                                            {{ translate('show_all_view') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_view" value="edit_view"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_view', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_view">
                                            {{ translate('edit_view') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_view" value="delete_view"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_view', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_view">
                                            {{ translate('delete_view') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_view"
                                            value="change_status_view"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_view', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_view">
                                            {{ translate('change_status_view') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="property_type" value="property_type"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('property_type', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="property_type">
                                        {{ translate('property_type') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_property_type"
                                            value="show_all_property_type"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_property_type', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_property_type">
                                            {{ translate('show_all_property_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_property_type"
                                            value="add_property_type"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_property_type', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_property_type">
                                            {{ translate('add_property_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_property_type"
                                            value="edit_property_type"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_property_type', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_property_type">
                                            {{ translate('edit_property_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_property_type"
                                            value="delete_property_type"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_property_type', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_property_type">
                                            {{ translate('delete_property_type') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_property_type"
                                            value="change_status_property_type"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_property_type', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_property_type">
                                            {{ translate('change_status_property_type') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="floor" value="floor"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('floor', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="floor">
                                        {{ translate('floor') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_floor"
                                            value="show_all_floor"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_floor', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_floor">
                                            {{ translate('show_all_floor') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_floor" value="add_floor"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_floor', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_floor">
                                            {{ translate('add_floor') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_floor" value="edit_floor"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_floor', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_floor">
                                            {{ translate('edit_floor') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_floor" value="delete_floor"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_floor', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_floor">
                                            {{ translate('delete_floor') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_floor"
                                            value="change_status_floor"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_floor', $module_access) }}>
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
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('projects', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="projects">
                                        {{ translate('projects') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_project"
                                            value="show_all_project"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_project', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_project">
                                            {{ translate('show_all_project') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_project" value="show_project"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_project', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_project">
                                            {{ translate('show_project') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_project" value="add_project"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_project', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_project">
                                            {{ translate('add_project') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_project" value="edit_project"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_project', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_project">
                                            {{ translate('edit_project') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_project"
                                            value="delete_project"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_project', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_project">
                                            {{ translate('delete_project') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_project"
                                            value="change_status_project"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_project', $module_access) }}>
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
                                    <input type="checkbox" name="modules[]" id="floor_management"
                                        value="floor_management"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('floor_management', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="floor_management">
                                        {{ translate('floor_management') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_floor_management"
                                            value="show_all_floor_management"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_floor_management', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_floor_management">
                                            {{ translate('show_all_floor_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_floor_management"
                                            value="add_floor_management"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_floor_management', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_floor_management">
                                            {{ translate('add_floor_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_floor_management"
                                            value="edit_floor_management"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_floor_management', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_floor_management">
                                            {{ translate('edit_floor_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_floor_management"
                                            value="delete_floor_management"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_floor_management', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_floor_management">
                                            {{ translate('delete_floor_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_floor_management"
                                            value="change_status_floor_management"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_floor_management', $module_access) }}>
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
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('unit_management', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="unit_management">
                                        {{ translate('unit_management') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_unit_management"
                                            value="show_all_unit_management"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_unit_management', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_unit_management">
                                            {{ translate('show_all_unit_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_unit_management"
                                            value="add_unit_management"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_unit_management', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_unit_management">
                                            {{ translate('add_unit_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_unit_management"
                                            value="edit_unit_management"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_unit_management', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_unit_management">
                                            {{ translate('edit_unit_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_unit_management"
                                            value="delete_unit_management"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_unit_management', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_unit_management">
                                            {{ translate('delete_unit_management') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_unit_management"
                                            value="change_status_unit_management"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_unit_management', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_unit_management">
                                            {{ translate('change_status_unit_management') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="team" value="team"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('team', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="team">
                                        {{ translate('team') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_team" value="show_all_team"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_team', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_team">
                                            {{ translate('show_all_team') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_team" value="add_team"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_team', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_team">
                                            {{ translate('add_team') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_team" value="edit_team"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_team', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_team">
                                            {{ translate('edit_team') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_team" value="delete_team"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_team', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_team">
                                            {{ translate('delete_team') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_team"
                                            value="change_status_team"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_team', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_team">
                                            {{ translate('change_status_team') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="employee" value="employee"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('employee', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="employee">
                                        {{ translate('employee') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_employee"
                                            value="show_all_employee"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_employee', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_employee">
                                            {{ translate('show_all_employee') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_employee" value="add_employee"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_employee', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_employee">
                                            {{ translate('add_employee') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_employee" value="edit_employee"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_employee', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_employee">
                                            {{ translate('edit_employee') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_employee"
                                            value="delete_employee"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_employee', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_employee">
                                            {{ translate('delete_employee') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_employee"
                                            value="change_status_employee"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_employee', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_employee">
                                            {{ translate('change_status_employee') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="role" value="role"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('role', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="role">
                                        {{ translate('role') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_role" value="show_all_role"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_role', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_role">
                                            {{ translate('show_all_roles') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_role" value="add_role"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_role', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_role">
                                            {{ translate('add_role') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_role" value="edit_role"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_role', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_role">
                                            {{ translate('edit_role') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_role" value="delete_role"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_role', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_role">
                                            {{ translate('delete_role') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_role"
                                            value="change_status_role"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_role', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_role">
                                            {{ translate('change_status_role') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="section-card   col-4 col-md-6 col-lg-4 mt-3">
                            <div class="card card-primary section-box">
                                <div class="card-header">
                                    <input type="checkbox" name="modules[]" id="customer" value="customer"
                                        class="form-check-input mt-0 section-parent module-permission"
                                        {{ is_checked('customer', $module_access) }}>
                                    <label
                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                        for="customer">
                                        {{ translate('customer') }}
                                    </label>
                                </div>

                                <div class="card-body">
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="show_all_customers"
                                            value="show_all_customers"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('show_all_customers', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="show_all_customers">
                                            {{ translate('show_all_customers') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_customer" value="add_customer"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_customer', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_customer">
                                            {{ translate('add_customer') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="edit_customer" value="edit_customer"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('edit_customer', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="edit_customer">
                                            {{ translate('edit_customer') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="delete_customer"
                                            value="delete_customer"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('delete_customer', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="delete_customer">
                                            {{ translate('delete_customer') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="assign_to" value="assign_to"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('assign_to', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="assign_to">
                                            {{ translate('assign_to') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="add_reminder" value="add_reminder"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('add_reminder', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="add_reminder">
                                            {{ translate('add_reminder') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="change_status_customer"
                                            value="change_status_customer"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('change_status_customer', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="change_status_customer">
                                            {{ translate('change_status_customer') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="accept_installment"
                                            value="accept_installment"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('accept_installment', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="accept_installment">
                                            {{ translate('accept_installment') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="installments_customer"
                                            value="installments_customer"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('installments_customer', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="installments_customer">
                                            {{ translate('installments_customer') }}
                                        </label>
                                    </div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="modules[]" id="all_installments"
                                            value="all_installments"
                                            class="form-check-input section-child module-permission"
                                            {{ is_checked('all_installments', $module_access) }}>
                                        <label
                                            class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                            for="all_installments">
                                            {{ translate('all_installments_for_admin') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <button type="submit" class="btn btn-primary">{{ translate('update_role') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('#submit-edit-role').on('submit', function(e) {

            var fields = $("input[name='modules[]']").serializeArray();
            if (fields.length === 0) {
                toastr.warning("{{ translate('select_minimum_one_selection_box') }}", {
                    CloseButton: true,
                    ProgressBar: true
                });
                return false;
            } else {
                $('#submit-edit-role').submit();
            }
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

        $(document).ready(function() {
            checkbox_selection_check();
        })

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
