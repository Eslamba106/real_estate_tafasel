@extends('layouts.back-end.app')

@section('content')
    <div class="container">
        <div class="content container-fluid">
            <!-- Page Title -->
            <div class="mb-3">
                <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                    <img src="{{ asset(main_path() . 'back-end/img/inhouse-customer_item-list.png') }}" alt="">
                    {{ translate('all_reminders') }}
                    <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $reminders->total() }}</span>
                </h2>
            </div>
            <!-- End Page Title -->
            {{-- @include('admin-views.inline_menu.team_master.inline-menu') --}}
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
                                            <button type="submit"
                                                class="btn btn--primary">{{ translate('search') }}</button>
                                        </div>
                                    </form>
                                    <!-- End Search -->
                                </div>

                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="datatable"
                                style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th>{{ translate('sl') }}</th>
                                        <th class="text-right">{{ translate('customer_name') }}</th>
                                        <th class="text-right">{{ translate('customer_mobile') }}</th>
                                        <th class="text-right">{{ translate('reminder_at') }}</th>
                                        <th class="text-center">{{ translate('note') }}</th>
                                        <th class="text-center">{{ translate('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reminders as $reminder)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>

                                            <td class="text-right">
                                                {{ $reminder->customer?->name }}

                                            </td>
                                            <td class="text-right">
                                                {{ $reminder->customer?->phone }}

                                            </td>
                                            <td class="text-right">
                                                {{ \Carbon\Carbon::parse($reminder->reminder_at)->format('Y-m-d') }}

                                            </td>
                                            <td class="text-right">
                                                {{ $reminder->note }}

                                            </td>


                                            <td>
                                                @if ($reminder->inotified == false)
                                                    <div class="d-flex justify-content-center gap-2">

                                                        <form method="POST"
                                                            action="{{ route('reminders.done', $reminder->id) }}">
                                                            @csrf
                                                            <button
                                                                class="btn btn-success btn-sm">{{ translate('done') }}</button>
                                                        </form>

                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-4">
                            <div class="px-4 d-flex justify-content-lg-end">
                                <!-- Pagination -->
                                {{ $reminders->links() }}
                            </div>
                        </div>

                        @if (count($reminders) == 0)
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
        {{-- @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif --}}
        {{-- 
    @forelse($reminders as $reminder)
        <div class="card mb-2">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $reminder->customer->name }}</strong><br>
                    {{ $reminder->note }}<br>
                    <small>موعد التذكير: {{ $reminder->reminder_at->format('Y-m-d H:i') }}</small>
                </div>
                <form method="POST" action="{{ route('reminders.done', $reminder->id) }}">
                    @csrf
                    <button class="btn btn-success btn-sm">تم</button>
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-info">لا توجد تذكيرات لهذا اليوم.</div>
    @endforelse --}}
    </div>
@endsection
