@extends('layouts.back-end.app') 
@section('title', translate('create_floor' ))
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
                {{ translate('create_floor_management' ) }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_config.inline-menu')

        <!-- Form -->
        <form class="product-form text-start" id="myForm" action="{{ route('floor_management.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2"> 
                        <h4 class="mb-0">{{ translate('create_floor' ) }}</h4>
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
                                        <option value="{{ $project_item->id }}">
                                            {{ $project_item->name . ' - ' . $project_item->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="token" class="title-color">{{ translate('Total_No._Floor*') }}</label>
                                <input type="text" class="form-control" name="floor_count">
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-4 col-xl-12 floors  ">
                            <div class="floor-title">{{ translate('floors' ) }}</div>
                            <div class="floor-container">
                                @foreach ($floors as $floor_item)
                                    <label class="floor-item">
                                        <input type="checkbox" name="floors[]" value="{{ $floor_item->id }}">
                                        {{ $floor_item->name . ' - '.$floor_item->code }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        
                        {{-- <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="token" class="title-color">{{ translate('Total No.  Floor *') }}</label>
                                <input type="text" class="form-control" name="floor_count">
                            </div>
                        </div>


                        <div class="col-md-6 col-lg-4 col-xl-12 floors d-none">
                            <div class="floor-title">{{ translate('property_master.floors' ) }}</div>
                            <div class="floor-container">
                                @foreach ($floors as $floor_item)
                                    <label class="floor-item">
                                        <input type="checkbox" name="floors[]" value="{{ $floor_item->id }}">
                                        {{ $floor_item->name . ' - ' . $floor_item->code }}
                                    </label>
                                @endforeach


                            </div>
                        </div> --}}
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

<script>
    $(document).ready(function() {
        $('input[name="floor_count"]').on('keyup', function() {
            const $floorCountInput = $('input[name="floor_count"]');
    const $floorCheckboxes = $('input[name="floors[]"]');
    const $myForm = $('#myForm'); 

    function updateCheckboxStates() {
        const maxFloors = parseInt($floorCountInput.val()) || 0;
        const checkedCount = $floorCheckboxes.filter(':checked').length;

        $floorCheckboxes.each(function() {
            $(this).prop('disabled', checkedCount >= maxFloors && !$(this).prop('checked'));
        });
    }

    $floorCountInput.on('input', updateCheckboxStates);
    $floorCheckboxes.on('change', updateCheckboxStates);

    $myForm.on('submit', function(event) {
        const minFloors = parseInt($floorCountInput.val()) || 0;
        const checkedCount = $floorCheckboxes.filter(':checked').length;

        if (checkedCount < minFloors) {
            event.preventDefault(); 
            alert('You must select a number of floors no less than the total number specified.');  
            return false;
        }
        return true;  
    }); 
    updateCheckboxStates();
    });
    });
     
</script> 
 
@endpush
