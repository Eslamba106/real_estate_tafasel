@extends('layouts.back-end.app')

@section('title', translate('all_installments'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="{{ asset(main_path() . 'back-end/img/inhouse-customer_item-list.png') }}" alt="">
                {{ translate('all_installments') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $installments->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.crm.inline-menu')

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
                            
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ translate('sl') }}</th>
                                    <th class="text-right">{{ translate('name') }}</th>
                                    <th class="text-right">{{ translate('date') }}</th>
                                    <th class="text-right">{{ translate('value') }}</th>
                                    <th class="text-right">{{ translate('status') }}</th>
                                    <th class="text-right">{{ translate('remarks') }}</th>
                                    <th class="text-right">{{ translate('actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($installments as $k => $installment_item)
                                    <tr>
                                        <th scope="row">{{ $installments->firstItem() + $k }}</th>

                                        <td class="text-right">
                                            {{ \Illuminate\Support\Str::limit($installment_item->customer?->name, 20) }}

                                        </td>


                                        <td class="text-right">
                                            {{ $installment_item->date ?? translate('not_available') }}
                                        </td>
                                        <td class="text-right">
                                            {{ $installment_item->value ?? translate('not_available') }}
                                        </td>
                                        <td class="text-right">
                                            {{ isset($installment_item->status) ? translate('paid') : translate('not_paid') }}
                                        </td>
                                        <td class="text-right">
                                            {{ $installment_item->notes ?? translate('not_available') }}
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">

                                                @if (\App\Helpers\Helpers::module_permission_check('accept_installment') && !isset($installment_item->status))
                                                    <a class="btn btn-outline--primary btn-sm square-btn"
                                                        title="{{ translate('accept_installment') }}"
                                                        href="{{ route('customer.accept_installment', [$installment_item->id]) }}">
                                                        <i class="tio-add"></i>
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
                            {{ $installments->links() }}
                        </div>
                    </div>

                    @if (count($installments) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160"
                                src="{{ asset(main_path() . 'assets/back-end') }}/svg/illustrations/sorry.svg"
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

        $('.customer_item_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('customer.status-update') }}",
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
                        url: "{{ route('customer.delete') }}",
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

    <script>
        $(document).on('click', '#add_action', function() {
            var customerId = $(this).data('id');
            $('input[name="customer_id_add_action"]').val(customerId);
        });
        $(document).on('click', '#reminder', function() {
            var customerId = $(this).data('id');
            $('input[name="customer_id"]').val(customerId);
        });
        $(document).on('click', '#assign_to_employee', function() {
            var customerId = $(this).data('id');
            $('input[name="customer_id_assign_to"]').val(customerId);
        });
    </script>

    <script>
        function employee(element) {
            var id = element.value;

            $.ajax({
                url: "{{ route('customer.get_employee_by_team_id', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var Select = $("select[name='employee_id']");
                    Select.empty();
                    Select.append('<option value="">{{ translate('select_employee') }}</option>');
                    console.installment(data)
                    if (data.employees && Array.isArray(data.employees) && data.employees.length > 0) {
                        data.employees.forEach(function(employee) {
                            Select.append(
                                `<option value="${employee.id}">${employee.name}</option>`
                            );
                        });
                    } else {
                        console.warn("No employee returned.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching employee :', error);
                }
            });
        }
    </script>
@endpush
