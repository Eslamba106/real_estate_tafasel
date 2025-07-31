@extends('layouts.back-end.app')

@section('title', translate('edit_floor_management' ))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .floor-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .floor-item {
            display: flex;
            align-items: center;
            background-color: #f5f5dc;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .floor-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .floor-item:hover {
            background-color: #e0e0d1;
        }

        .floor-title {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-product-list.png') }}" alt=""> --}}
                {{ translate('edit_floor_management' ) }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_config.inline-menu')

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('floor_management.update' , $old_floor->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2"> 
                        <h4 class="mb-0">{{ translate('add_floor' ) }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ translate('project' ) }}
                                </label>
                                <select class="js-select2-custom form-control" name="project" required>
                                    <option selected disabled>{{ translate('select' ) }}
                                    </option>
                                    @foreach ($projects as $project_item)
                                        <option value="{{ $project_item->id }}" {{ ($old_floor->project_id == $project_item->id) ? 'selected' : '' }}>
                                            {{ $project_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                     
                        <div class="col-md-6 col-lg-4 col-xl-12 floors  ">
                            <div class="floor-title">{{ translate('floors' ) }}</div>
                            <div class="floor-container">
                             
                                @foreach($floors as $floor_item)
                                <label class="floor-item">
                                <input type="checkbox"  name="floor" value="{{ $floor_item->id }}"
                                       onclick="onlyOne(this)"
                                       value="{{ $floor_item->id }}"  {{ ($old_floor->floor_id == $floor_item->id) ? 'checked' : '' }}>
                                 {{ $floor_item->name }}</label>
                            @endforeach



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
<script>
    function onlyOne(checkbox) {
        document.querySelectorAll('input[name="floor"]').forEach(el => {
            if (el !== checkbox) el.checked = false;
        });
    }
</script>
    <script>
        $(document).ready(function() {
           
            $('input[name="floor_count"]').on('keyup', function() {
                var count = parseInt($(this).val());
                $('.floors').removeClass('d-none');

                $('input[name="floors[]"]').each(function(index) {
                    if (index < count) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
            });

        });
    </script>
@endpush
