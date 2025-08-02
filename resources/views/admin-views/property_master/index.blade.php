@extends('layouts.back-end.app')
 
@section('title', translate($route))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush
@php
    $lang = session()->get('direction'); 
    // dd($lang);
@endphp
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{-- <img width="60" src="{{ asset('assets/back-end/img/' . $route . '.jpg') }}" alt=""> --}}
                {{ translate($route) }}
            </h2>
        </div>
        <!-- End Page Title -->
         @php
            $currentUrl = url()->current();
            $segments = explode('/', $currentUrl);
            $last = end($segments);
            $team_master = [
                'team',
                // 'complaint_category',
                // 'freezing',
                // 'main_complaint',
                // 'employee_type',
                // 'priority',
                // 'asset_group',
                // 'work_status',
            ];
        @endphp
        @if (in_array($last, $team_master))
            @include('admin-views.inline_menu.team_master.inline-menu')
        @else
            @include('admin-views.inline_menu.property_master.inline-menu')
        @endif
        {{-- @include('admin-views.inline_menu.property_master.inline-menu') --}}

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ translate('add_new_' . $route) }}
                    </div>
                    <div class="card-body"  style="text-align: {{ $lang === 'ltr' ? 'left' : 'right' }};">
                        <form action="{{ route($route . '.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <input type="hidden" id="id">
                                <label class="title-color" for="name">{{ translate('name') }}<span class="text-danger">
                                        *</span> </label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ translate('enter_' . $route . '_name') }}">
                            </div>


                            @if ($route != 'team')
                                <div class="form-group">
                                    <label class="title-color" for="status">
                                        {{ translate('status') }}
                                    </label>
                                    <div class="input-group">
                                        <input type="radio" name="status" class="mr-3 ml-3" checked value="active">
                                        <label class="title-color" for="status">
                                            {{ translate('active') }}
                                        </label>
                                        <input type="radio" name="status" class="mr-3 ml-3" value="inactive">
                                        <label class="title-color" for="status">
                                            {{ translate('inactive') }}
                                        </label>

                                    </div>
                                </div>
                            @endif


                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">{{ translate('reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ translate('submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">
                                    {{ translate($route . '_list') }}
                                    <span class="badge badge-soft-dark radius-50 fz-12"> </span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{ translate('search_by_' . $route . '_name') }}"
                                            aria-label="Search" value="{{ $search }}" required>
                                        <button type="submit" class="btn btn--primary">{{ translate('search') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div  >
                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th>{{ translate('sl') }}</th>
                                        <th class="text-center">{{ translate($route . '_name') }} </th>

                                        @if ($route != 'team')
                                            <th class="text-center">{{ translate('status') }}</th>
                                        @endif
                                        <th class="text-center">{{ translate('actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($main as $key => $value)
                                        <tr>
                                            <td>{{ $main->firstItem() + $key }}</td>
                                            <td class="text-center">{{ $value->name }}</td>
                                            @if ($route != 'team')
                                                <td class="text-center">
                                                    <form action="{{ route($route . '.status-update') }}" method="post"
                                                        id="product_status{{ $value->id }}_form"
                                                        class="product_status_form">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $value->id }}">
                                                        <label class="switcher mx-auto">
                                                            <input type="checkbox" class="switcher_input"
                                                                id="product_status{{ $value->id }}" name="status"
                                                                value="1"
                                                                {{ $value->status == 'active' ? 'checked' : '' }}
                                                                onclick="toogleStatusModal(event,'product_status{{ $value->id }}',
                                                    'product-status-on.png','product-status-off.png',
                                                    '{{ translate('Want_to_Turn_ON') }} {{ $value->name }} ',
                                                    '{{ translate('Want_to_Turn_OFF') }} {{ $value->name }} ',
                                                    `<p>{{ translate('if_enabled_this_product_will_be_available') }}</p>`,
                                                    `<p>{{ translate('if_disabled_this_product_will_be_hidden') }}</p>`)">
                                                            <span class="switcher_control"></span>
                                                        </label>
                                                    </form>
                                                </td>
                                            @endif
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    @if (\App\Helpers\Helpers::module_permission_check('edit_'.$route))

                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ translate('edit') }}"
                                                        href="{{ route($route . '.edit', $value->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    @endif
                                                    @if (\App\Helpers\Helpers::module_permission_check('delete_'.$route))

                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ translate('delete') }}" id="{{ $value['id'] }}">
                                                        <i class="tio-delete"></i>
                                                    </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {!! $main->links() !!}
                        </div>
                    </div>

                    @if (count($main) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset('assets/back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ translate('no_data_to_show') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- <input type="hidden" id="route_name" name="route_name" value="{{ $route }}" > --}}
@endsection

@push('script')
    <script>
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            // var route_name = document.getElementById('route_name').value;
            Swal.fire({
                title: "{{ translate('are_you_sure_delete_this') }}",
                text: "{{ translate('you_will_not_be_able_to_revert_this') }}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ translate('yes_delete_it') }}!',
                cancelButtonText: '{{ translate('cancel') }}',
                type: 'warning',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route($route . '.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success('{{ translate('deleted_successfully') }}');
                            location.reload();
                        }
                    });
                }
            })
        });



        // Call the dataTables jQuery plugin
    </script>
    <script>
        $('.product_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route($route . '.status-update') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ translate('updated_successfully') }}');
                    } else if (data.success == false) {
                        toastr.error(
                            '{{ translate('Status_updated_failed.') }} {{ translate('Product_must_be_approved') }}'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    </script>
@endpush
