@extends('layouts.back-end.app')
@php
    $lang = session()->get('direction'); 
@endphp
@section('title', translate($route))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('public/assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{-- <img width="60" src="{{ asset('/public/assets/back-end/img/' . $route . '.jpg') }}" alt=""> --}}
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
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ translate('edit_' . $route) }}
                    </div>
                    <div class="card-body" style="text-align: {{ $lang === 'rtl' ? 'right' : 'left' }};">
                        <form action="{{ route($route . '.update', $main->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label class="title-color" for="name">{{ translate('name') }}<span
                                        class="text-danger">*</span> </label>
                                <input type="text" name="name" class="form-control" value="{{ $main->name }}"
                                    placeholder="{{ translate('enter_' . $route . '_name') }}">
                            </div>
                            @if ($route != 'team')

                            <div class="form-group">
                                <label class="title-color" for="status">
                                    {{ translate('status') }}
                                </label>
                                <div class="input-group">
                                    <input type="radio" name="status" class="mr-3 ml-3"
                                        @if ($main->status == 'active') checked @endif value="active">
                                    <label class="title-color" for="status">
                                        {{ translate('active') }}
                                    </label>
                                    <input type="radio" name="status" class="mr-3 ml-3"
                                        @if ($main->status == 'inactive') checked @endif value="inactive">
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


        </div>
    </div>
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
@endpush
