@extends('layouts.back-end.app')
@php
    $lang = session()->get('locale');
@endphp

@section('title')
    {{ translate('edit_customer') }}
@endsection

@section('content')
<div class="content container-fluid">
    <!-- Page Title -->
    <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
        <h2 class="h1 mb-0 d-flex gap-2">
            {{ translate('edit_customer') }}
        </h2>
    </div>
    <!-- End Page Title -->

    @include('admin-views.inline_menu.crm.inline-menu')

    <!-- Edit Form -->
    <form class="product-form text-start" action="{{ route('customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data" id="product_form">
        @csrf
        @method('patch')  

        <!-- General Setup -->
        <div class="card mt-3 rest-part">
            <div class="card-header">
                <div class="d-flex gap-2">
                    <h4 class="mb-0">{{ translate('general_info') }}</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="row">

                    <!-- Name -->
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="name" class="title-color">{{ translate('name') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required value="{{ old('name', $customer->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="phone" class="title-color">{{ translate('phone') }}<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" required value="{{ old('phone', $customer->phone) }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Project -->
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="project_id" class="title-color">{{ translate('project') }}<span class="text-danger">*</span></label>
                            <select class="js-select2-custom form-control" onchange="floor(this)" name="project_id" required>
                                <option value="">{{ translate('select') }}</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ $customer->project_id == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Floor -->
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="floor_id" class="title-color">{{ translate('floor') }}<span class="text-danger">*</span></label>
                            <select class="js-select2-custom form-control" onchange="units(this)" name="floor_id">
                                <option value="">{{ translate('select') }}</option>
                                @foreach ($floors as $floor)
                                    <option value="{{ $floor->id }}" {{ $customer->floor_id == $floor->id ? 'selected' : '' }}>
                                        {{ $floor->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('floor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Unit -->
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="unit_id" class="title-color">{{ translate('unit') }}<span class="text-danger">*</span></label>
                            <select class="js-select2-custom form-control" name="unit_id">
                                <option value="">{{ translate('select') }}</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" {{ $customer->unit_id == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('unit_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="email" class="title-color">{{ translate('email') }}</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email', $customer->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Budget -->
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="budget" class="title-color">{{ translate('budget') }}</label>
                            <input type="number" class="form-control" name="budget" value="{{ old('budget', $customer->budget) }}">
                            @error('budget')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Job -->
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="form-group">
                            <label for="job" class="title-color">{{ translate('job') }}</label>
                            <input type="text" class="form-control" name="job" value="{{ old('job', $customer->job) }}">
                            @error('job')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <button type="submit" class="btn btn--primary mt-3">{{ translate('update_customer') }}</button>
    </form>
</div>
@endsection
