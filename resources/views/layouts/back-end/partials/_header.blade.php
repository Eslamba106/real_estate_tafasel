<div id="headerMain" class="d-none">
    <header id="header"
        class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-flush navbar-container shadow">

        <div class="navbar-nav-wrap">
            <div class="navbar-brand-wrapper">
                <!-- Logo -->
                {{-- @php($e_commerce_logo=\App\Models\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)
                <a class="navbar-brand" href="{{route('admin.dashboard.index')}}" aria-label="">
                    <img class="navbar-brand-logo"
                         onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                         src="{{asset("storage/app/company/$e_commerce_logo")}}" alt="Logo">
                    <img class="navbar-brand-logo-mini"
                         onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                         src="{{asset("storage/app/company/$e_commerce_logo")}}"
                         alt="Logo">
                </a> --}}
                <!-- End Logo -->
            </div>

            <div class="navbar-nav-wrap-content-left">
                <!-- Navbar Vertical Toggle -->
                <button type="button" class="js-navbar-vertical-aside-toggle-invoker close mr-3 d-xl-none">
                    <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                        data-placement="right" title="Collapse"></i>
                    <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                        data-template='<div class="tooltip d-none d-sm-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                        data-toggle="tooltip" data-placement="right" title="Expand"></i>
                </button>
            </div>


            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-content-right"
                style="{{ Session::get('direction') === 'rtl' ? 'margin-left:unset; margin-right: auto' : 'margin-right:unset; margin-left: auto' }}">
                <!-- Navbar -->
                <ul class="navbar-nav align-items-center flex-row">
                    <!--<li class="nav-item d-none d-sm-inline-block">
                            <label class="switcher">
                                <input class="switcher_input" type="checkbox" checked="checked">
                                <span class="switcher_control"></span>
                            </label>
                        </li>-->

                    <li class="nav-item d-none d-md-inline-block">
                        <div class="hs-unfold">
                            <div>
                                @php($local = session()->has('local') ? session('local') : 'en')
                                @php($lang = \App\Models\BusinessSetting::where('type', 'language')->first())
                                <div
                                    class="topbar-text dropdown disable-autohide {{ Session::get('direction') === 'rtl' ? 'ml-3' : 'm-1' }} text-capitalize">
                                    <a class="topbar-link dropdown-toggle d-flex align-items-center title-color"
                                        href="#" data-toggle="dropdown">
                                        @foreach (json_decode($lang['value'], true) as $data)
                                            @if ($data['code'] == $local)
                                                <img class="{{ Session::get('direction') === 'rtl' ? 'ml-2' : 'mr-2' }}"
                                                    width="20"
                                                    src="{{ asset('assets/front-end') }}/img/flags/{{ $data['code'] }}.png"
                                                    alt="Eng">
                                                {{ $data['name'] }}
                                            @endif
                                        @endforeach
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach (json_decode($lang['value'], true) as $key => $data)
                                            @if ($data['status'] == 1)
                                                <li>
                                                    <a class="dropdown-item py-1"
                                                        href="{{ route('lang', [$data['code']]) }}">
                                                        <img class="{{ Session::get('direction') === 'rtl' ? 'ml-2' : 'mr-2' }}"
                                                            width="20"
                                                            src="{{ asset('assets/front-end') }}/img/flags/{{ $data['code'] }}.png"
                                                            alt="{{ $data['name'] }}" />
                                                        <span class="text-capitalize">{{ $data['name'] }}</span>
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item d-none d-md-inline-block">
                        <div class="hs-unfold">
                            <a title="Website home"
                                class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                href="{{ route('home') }}" target="_blank">
                                <i class="tio-globe"></i>
                            </a>
                        </div>
                    </li>




                    <li class="nav-item view-web-site-info">
                        <div class="hs-unfold">
                            <a onclick="openInfoWeb()" href="javascript:"
                                class="bg-white js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle">
                                <i class="tio-info"></i>
                            </a>
                        </div>
                    </li>

                    <li class="nav-item">
                        <!-- Account -->
                        <div class="hs-unfold">
                            <a class="js-hs-unfold-invoker media align-items-center gap-3 navbar-dropdown-account-wrapper dropdown-toggle dropdown-toggle-left-arrow"
                                href="javascript:;"
                                data-hs-unfold-options='{
                                     "target": "#accountNavbarDropdown",
                                     "type": "css-animation"
                                   }'>
                                <div class="d-none d-md-block media-body text-right">
                                    <h5 class="profile-name mb-0">{{ auth()->user()->name }}</h5>
                                    <span class="fz-12">{{ auth()->user()->role->name ?? '' }}</span>
                                </div>
                                <div class="avatar border avatar-circle">
                                    <img class="avatar-img"
                                        onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                        src="{{ asset('storage/app/admin') }}/{{ auth()->user()->image }}"
                                        alt="Image Description">
                                    <span class="d-none avatar-status avatar-sm-status avatar-status-success"></span>
                                </div>
                            </a>

                            <div id="accountNavbarDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right navbar-dropdown-menu navbar-dropdown-account">
                                <div class="dropdown-item-text">
                                    <div class="media align-items-center text-break">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img"
                                                onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                                src="{{ asset('storage/app/admin') }}/{{ auth()->user()->image }}"
                                                alt="Image Description">
                                        </div>
                                        <div class="media-body">
                                            <span class="card-title h5">{{ auth()->user()->name }}</span>
                                            <span class="card-text">{{ auth()->user()->email }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown-divider"></div>

                                {{-- <a class="dropdown-item"
                                   href="{{route('admin.profile.update',auth()->user()->id)}}">
                                    <span class="text-truncate pr-2" title="Settings">{{ translate('settings')}}</span>
                                </a> --}}

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="javascript:"
                                    onclick="Swal.fire({
                                    title: '{{ translate('do_you_want_to_logout') }}?',
                                    showDenyButton: true,
                                    showCancelButton: true,
                                    confirmButtonColor: '#377dff',
                                    cancelButtonColor: '#363636',
                                    confirmButtonText: `{{ translate('yes') }}`,
                                    denyButtonText: `{{ translate('Do_not_Logout') }}`,
                                    cancelButtonText: `{{ translate('cancel') }}`,
                                    }).then((result) => {
                                    if (result.value) {
                                    location.href='{{ route('logout') }}';
                                    } else{
                                    Swal.fire('Canceled', '', 'info')
                                    }
                                    })">
                                    <span class="text-truncate pr-2"
                                        title="Sign out">{{ translate('sign_out') }}</span>
                                </a>
                            </div>
                        </div>
                        <!-- End Account -->
                    </li>
                </ul>
                <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->
        </div>
        <div id="website_info" style="display: none;" class="bg-secondary w-100">
            <div class="p-3">
                <div class="bg-white p-1 rounded">
                    @php($local = session()->has('local') ? session('local') : 'en')
                    @php($lang = \App\Models\BusinessSetting::where('type', 'language')->first())
                    <div
                        class="topbar-text dropdown disable-autohide {{ Session::get('direction') === 'rtl' ? 'ml-3' : 'm-1' }} text-capitalize">
                        <a class="topbar-link dropdown-toggle title-color d-flex align-items-center" href="#"
                            data-toggle="dropdown">
                            @foreach (json_decode($lang['value'], true) as $data)
                                @if ($data['code'] == $local)
                                    <img class="{{ Session::get('direction') === 'rtl' ? 'ml-2' : 'mr-2' }}"
                                        width="20"
                                        src="{{ asset('assets/front-end') }}/img/flags/{{ $data['code'] }}.png"
                                        alt="Eng">
                                    {{ $data['name'] }}
                                @endif
                            @endforeach
                        </a>
                        {{-- <ul class="dropdown-menu">
                            @foreach (json_decode($lang['value'], true) as $key => $data)
                                @if ($data['status'] == 1)
                                    <li>
                                        <a class="dropdown-item pb-1"
                                           href="{{route('lang',[$data['code']])}}">
                                            <img
                                                class="{{Session::get('direction') === "rtl" ? 'ml-2' : 'mr-2'}}"
                                                width="20"
                                                src="{{asset('assets/front-end')}}/img/flags/{{$data['code']}}.png"
                                                alt="{{$data['name']}}"/>
                                            <span class="text-capitalize">{{$data['name']}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul> --}}
                    </div>
                </div>
                <div class="bg-white p-1 rounded mt-2">
                    <a title="Website home" class="p-2 title-color" href="{{ route('home') }}" target="_blank">
                        <i class="tio-globe"></i>
                        {{-- <span class="btn-status btn-sm-status btn-status-danger"></span> --}}
                        {{ translate('view_website') }}
                    </a>
                </div>

            </div>
    </header>
</div>
<div id="headerFluid" class="d-none"></div>
<div id="headerDouble" class="d-none"></div>
