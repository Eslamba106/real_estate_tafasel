@extends('layouts.back-end.app')

@section('title', translate('all_employees'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="{{ asset(main_path() . 'back-end/img/inhouse-employee_item-list.png') }}" alt="">
                {{ translate('all_employees') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $main->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_master.inline-menu')

        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{ translate('search_by_name') }}" aria-label="Search orders"
                                            value="{{ request('search') }}">
                                        <input type="hidden" value="{{ request('status') }}" name="status">
                                        <button type="submit" class="btn btn--primary">{{ translate('search') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">


                                <a href="{{ route('employee.create') }}" class="btn btn--primary">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ translate('create_employee') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ translate('sl') }}</th>
                                    <th class="text-right">{{ translate('name') }}</th>
                                    <th class="text-right">{{ translate('mobile') }}</th>
                                    <th class="text-right">{{ translate('email') }}</th>
                                    <th class="text-right">{{ translate('role') }}</th>
                                    <th class="text-center">{{ translate('status') }}</th>
                                    <th class="text-center">{{ translate('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($main as $k => $employee_item)
                                    <tr>
                                        <th scope="row">{{ $main->firstItem() + $k }}</th>

                                        <td  class="text-right"> 
                                            {{ \Illuminate\Support\Str::limit($employee_item->name, 20) }}

                                        </td>


                                        <td class="text-right">
                                            {{ $employee_item->phone ?? translate('not_available') }}
                                        </td>
                                        <td class="text-right">
                                            {{ $employee_item->email ?? translate('not_available') }}
                                        </td>
                                        <td class="text-right">
                                            {{ $employee_item->role?->name ?? translate('not_available') }}
                                        </td>
                                        @if (\App\Helpers\Helpers::module_permission_check('change_employee_status'))
                                            <td class="text-center">
                                                <form action="{{ route('employee.status-update') }}" method="post"
                                                    id="employee_item_status{{ $employee_item->id }}_form"
                                                    class="employee_item_status_form">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $employee_item->id }}">
                                                    <label class="switcher mx-auto">
                                                        <input type="checkbox" class="switcher_input"
                                                            id="employee_item_status{{ $employee_item->id }}"
                                                            name="status" value="1"
                                                            {{ $employee_item->status == '1' ? 'checked' : '' }}
                                                            onclick="toogleStatusModal(event,'employee_item_status{{ $employee_item->id }}',
                                                'employee_item-status-on.png','employee_item-status-off.png',
                                                '{{ translate('Want_to_Turn_ON') }} {{ $employee_item->name }} ',
                                                '{{ translate('Want_to_Turn_OFF') }} {{ $employee_item->name }} ',
                                                `<p>{{ translate('if_enabled_this_employee_item_will_be_available') }}</p>`,
                                                `<p>{{ translate('if_disabled_this_employee_item_will_be_hidden') }}</p>`)">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </form>
                                            </td>
                                        @endif
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                                @if (\App\Helpers\Helpers::module_permission_check('edit_employee'))
                                                    <a class="btn btn-outline--primary btn-sm square-btn"
                                                        title="{{ translate('edit') }}"
                                                        href="{{ route('employee.edit', [$employee_item->id]) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                @endif
                                                @if (\App\Helpers\Helpers::module_permission_check('delete_employee'))
                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ translate('delete') }}" id="{{ $employee_item->id }}">
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

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {{ $main->links() }}
                        </div>
                    </div>

                    @if (count($main) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ translate('no_data_to_show') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $('.employee_item_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('employee.status-update') }}",
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

        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ translate('are_you_sure_delete_this') }}",
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
                        url: "{{ route('employee.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success("{{ translate('deleted_successfully') }}");
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
