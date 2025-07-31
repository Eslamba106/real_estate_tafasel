@extends('layouts.back-end.app')

@section('title', translate('all_floor_management' ))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2"> 
                {{ translate('all_floor_management' ) }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $floor_management->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_config.inline-menu')


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
                                            placeholder="{{ translate('search_by_name' ) }}" aria-label="Search orders"
                                            value="{{ request('search') }}">
                                        <input type="hidden" value="{{ request('status') }}" name="status">
                                        <button type="submit" class="btn btn--primary">{{ translate('search' ) }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">


                                <a href="{{ route('floor_management.create') }}" class="btn btn--primary">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ translate('create_floor_management' ) }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ translate('sl' ) }}</th>
                                    <th class="text-right">{{ translate('project' ) }}</th> 
                                    <th class="text-right">{{ translate('floor' ) }}</th>
                                    <th class="text-center">{{ translate('status' ) }}</th>
                                    <th class="text-center">{{ translate('Actions' ) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($floor_management as $k => $floor_management_item)
                                    <tr>
                                        <th scope="row">{{ $floor_management->firstItem() + $k }}</th>

                                        <td class="text-right">
                                            {{ $floor_management_item->project_floor?->name }}
                                        </td> 
                                        <td class="text-right">
                                            {{ $floor_management_item->floor_main?->name }}
                                        </td>

                                        <td class="text-center">
                                            <form action="{{ route('floor_management.status-update') }}" method="post"
                                                id="subscription_status{{ $floor_management_item->id }}_form"
                                                class="subscription_status_form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $floor_management_item->id }}">
                                                <label class="switcher mx-auto">
                                                    <input type="checkbox" class="switcher_input"
                                                        id="subscription_status{{ $floor_management_item->id }}" name="status"
                                                        value="1"
                                                        {{ $floor_management_item->status == 'active' ? 'checked' : '' }}
                                                        onclick="toogleStatusModal(event,'subscription_status{{ $floor_management_item->id }}',
                                                'subscription-status-on.png','subscription-status-off.png',
                                                '{{ translate('Want_to_Turn_ON' ) }} {{ $floor_management_item->name }} ',
                                                '{{ translate('Want_to_Turn_OFF' ) }} {{ $floor_management_item->name }} ',
                                                `<p>{{ translate('if_enabled_this_subscription_will_be_available' ) }}</p>`,
                                                `<p>{{ translate('if_disabled_this_subscription_will_be_hidden' ) }}</p>`)">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                
                                                <a class="btn btn-outline--primary btn-sm square-btn"
                                                    title="{{ translate('edit' ) }}"
                                                    href="{{ route('floor_management.edit', [$floor_management_item->id]) }}">
                                                    <i class="tio-edit"></i>
                                                </a> 
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
                            {{ $floor_management->links() }}
                        </div>
                    </div>

                    @if (count($floor_management) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset(main_path() . 'assets/back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ translate('no_data_to_show' ) }}</p>
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

        $('.subscription_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('floor_management.status-update') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ translate('updated_successfully' ) }}');
                    } else if (data.success == false) {
                        toastr.error(
                            '{{ translate('Status_updated_failed.') }} {{ translate('Product_must_be_approved' ) }}'
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
                title: "{{ translate('are_you_sure_delete_this' ) }}",
                text: "{{ translate('you_will_not_be_able_to_revert_this' ) }}!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ translate('yes_delete_it' ) }}!",
                cancelButtonText: "{{ translate('cancel' ) }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('floor_management.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success("{{ translate('deleted_successfully' ) }}");
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
