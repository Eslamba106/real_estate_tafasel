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
                                <label for="name"
                                    class="title-color">{{ translate('role_name') }}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    aria-describedby="emailHelp"
                                    placeholder="{{ translate('ex') }} : {{ translate('store') }}"
                                    required>
                            </div>
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

                    <div class="row">
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

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit"
                            class="btn btn--primary">{{ translate('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="px-3 py-4">
                <div class="row justify-content-between align-items-center flex-grow-1">
                    <div class="col-md-4 col-lg-6 mb-2 mb-sm-0">
                        <h5 class="d-flex align-items-center gap-2">
                            {{ translate('employee_Roles') }}
                            <span class="badge badge-soft-dark radius-50 fz-12 ml-1">{{ count($rl) }}</span>
                        </h5>
                    </div>
                    <div class="col-md-8 col-lg-6 d-flex flex-wrap flex-sm-nowrap justify-content-sm-end gap-3">
                        <!-- Search -->
                        <form action="{{ url()->current() }}?search={{ $search }}" method="GET">
                            <div class="input-group input-group-merge input-group-custom">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                    placeholder="{{ translate('search_role') }}"
                                    value="{{ $search }}">
                                <button type="submit"
                                    class="btn btn--primary">{{ translate('search') }}</button>
                            </div>
                        </form>
                        <!-- End Search -->
                        {{-- <div class="">
                            <button type="button" class="btn btn-outline--primary text-nowrap" data-toggle="dropdown">
                                <i class="tio-download-to"></i>
                                {{ translate('export') }}
                                <i class="tio-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('role_admin.export', ['search' => request('search')]) }}">
                                        <img width="14" src="{{ asset('/public/assets/back-end/img/excel.png') }}"
                                            alt="">
                                        {{ translate('excel') }}
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="pb-3">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless table-thead-bordered table-align-middle card-table"
                        cellspacing="0"
                        style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                        <thead class="thead-light thead-50 text-capitalize table-nowrap">
                            <tr>
                                <th>{{ translate('SL') }}</th>
                                <th>{{ translate('role_name') }}</th>
                                <th>{{ translate('modules') }}</th>
                                <th>{{ translate('created_at') }}</th>
                                <th>{{ translate('status') }}</th>
                                <th class="text-center">{{ translate('action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rl as $k => $r)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $r['name'] }}</td>
                                    <td class="text-capitalize">
                                        @if ($r['module_access'] != null)
                                            @foreach ((array) json_decode($r['module_access']) as $m)
                                                @if ($m == 'report')
                                                    {{ translate('reports_and_analytics') }} <br>
                                                @elseif($m == 'user_section')
                                                    {{ translate('user_management') }} <br>
                                                @elseif($m == 'support_section')
                                                    {{ translate('Help_&_Support_Section') }} <br>
                                                @else
                                                    {{ translate(str_replace('_', ' ', $m)) }} <br>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ date('d-M-y', strtotime($r['created_at'])) }}</td>
                                    <td>
                                        <form action="{{ route('role_admin.employee-role-status') }}" method="post"
                                            id="employee_role_status{{ $r['id'] }}_form"
                                            class="employee_role_status_form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $r['id'] }}">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher_input"
                                                    id="employee_role_status{{ $r['id'] }}" name="status"
                                                    value="1" {{ $r['status'] == 1 ? 'checked' : '' }}
                                                    onclick="toogleStatusModal(event,'employee_role_status{{ $r['id'] }}','employee-on.png','employee-off.png','{{ translate('Want_to_Turn_ON_Employee_Status.') }}','
                                             {{ translate('Want_to_Turn_OFF_Employee_Status') }}',`<p>{{ translate('when_the_status_is_enabled_employees_can_access_the_system_to_perform_their_responsibilities') }}</p>`,`<p>{{ translate('when_the_status_is_disabled_employees_cannot_access_the_system_to_perform_their_responsibilities') }}</p>`)">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('role_admin.update', [$r['id']]) }}"
                                                class="btn btn-outline--primary btn-sm square-btn"
                                                title="{{ translate('edit') }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-danger btn-sm delete"
                                                title="{{ translate('delete') }}"
                                                id="{{ $r['id'] }}">
                                                <i class="tio-delete"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
@endpush
