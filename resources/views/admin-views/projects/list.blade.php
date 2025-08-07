@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', translate('project'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h2 class="h1 mb-0 d-flex gap-2 align-items-center">
                {{-- <img width="60" src="{{ asset('/assets/back-end/img/property.jpg') }}" alt=""> --}}
                {{ translate('project') }}
            </h2>
            @if (\App\Helpers\Helpers::module_permission_check('add_project')) 
            <a href="{{ route('project.create') }}"
                class="btn btn--primary">{{ translate('add_new_project') }}</a>
                @endif
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_config.inline-menu')
        <!-- Content Row -->
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">
                                    {{ translate('project_list') }}
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
                                            placeholder="{{ translate('search_by_project_name') }}"
                                            aria-label="Search" value="{{ $search }}" required>
                                        <button type="submit" class="btn btn--primary">{{ translate('search') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th>{{ translate('sl') }}</th>
                                        <th class="text-center">{{ translate('name') }} </th>
                                        <th class="text-center">{{ translate('location') }} </th>
                                        <th class="text-center">{{ translate('project_type') }} </th>
                                        <th class="text-center">{{ translate('status') }}</th>
                                        <th class="text-center">{{ translate('actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($main as $key => $value)
                                        <tr>
                                            <td>{{ $main->firstItem() + $key }}</td>
                                            <td class="text-center">{{ $value->name }}</td>
                                            <td class="text-center">{{ $value->location }} </td>
                                            <td class="text-center">{{ $value->project_type?->name }} </td>
                                            <td class="text-center">{{ translate(  $value->status  ) }} </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    @if (\App\Helpers\Helpers::module_permission_check('edit_project'))

                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ translate('edit') }}"
                                                        href="{{ route('project.edit', $value->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    @endif
                                                    @if (\App\Helpers\Helpers::module_permission_check('show_project'))

                                                    <a class="btn btn-outline--primary square-btn btn-sm mr-1"
                                                        title="{{ translate('view') }}"
                                                        href="{{ route('project.show', ['id' => $value['id']]) }}">
                                                        <img src="{{ asset('/assets/back-end/img/eye.svg') }}"
                                                            class="svg" alt="">
                                                    </a> 
                                                     @endif
                                                    @if (\App\Helpers\Helpers::module_permission_check('delete_project'))

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
                        url: "{{ route('project.delete') }}",
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
@endpush
