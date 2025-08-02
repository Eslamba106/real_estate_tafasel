<div id="sidebarMain" class="d-none">
    <aside style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
        class="bg-white js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered  ">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset pb-0">
                <div class="navbar-brand-wrapper justify-content-between side-logo">
                    <!-- Logo -->
                    @php($e_commerce_logo = \App\Models\BusinessSetting::where(['type' => 'company_web_logo'])->first()?->value)
                    <a class="navbar-brand" href="{{ route('dashboard') }}" aria-label="Front">
                        <img onerror="this.src='{{ asset('assets/back-end/img/900x400/img1.jpg') }}'"
                            class="navbar-brand-logo-mini for-web-logo max-h-30"
                            src="{{ asset("storage/company/$e_commerce_logo") }}" alt="Logo">
                    </a>
                    <button type="button"
                        class="d-none js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    <!-- End Navbar Vertical Toggle -->

                    <button type="button" class="js-navbar-vertical-aside-toggle-invoker close">
                        <i class="tio-first-page navbar-vertical-aside-toggle-short-align" data-toggle="tooltip"
                            data-placement="right" title="" data-original-title="Collapse"></i>
                        <i class="tio-last-page navbar-vertical-aside-toggle-full-align"
                            data-template="<div class=&quot;tooltip d-none d-sm-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>"
                            data-toggle="tooltip" data-placement="right" title=""
                            data-original-title="Expand"></i>
                    </button>
                </div>

                <!-- Content -->
                <div class="navbar-vertical-content">
                    <!-- Search Form -->
                    <div class="sidebar--search-form pb-3 pt-4">
                        <div class="search--form-group">
                            <button type="button" class="btn"><i class="tio-search"></i></button>
                            <input type="text" class="js-form-search form-control form--control"
                                id="search-bar-input" placeholder="{{ translate('search_menu') }}...">
                        </div>
                    </div>
                    <!-- End Search Form -->
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        <!-- Dashboards -->
                        <li class="navbar-vertical-aside-has-menu {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                            <a class="js-navbar-vertical-aside-menu-link nav-link" title="{{ translate('dashboard') }}"
                                href="{{ route('dashboard') }}">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                    {{ translate('dashboard') }}
                                </span>
                            </a>
                        </li>
                        <!-- End Dashboards -->


                        <!-- Unit Master -->
                        @if (\App\Helpers\Helpers::module_permission_check('unit_master'))



                            <li
                                class="navbar-vertical-aside-has-menu {{ Request::is('unit_description/*') ||
                                Request::is('unit_type/*') ||
                                Request::is('unit_condition/*') ||
                                Request::is('unit_parking/*') ||
                                Request::is('view/*') ||
                                Request::is('property_type/*')
                                    ? 'active'
                                    : '' }}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                    href="javascript:" title="{{ translate('unit_master') }}">
                                    <i class="tio-receipt-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{ translate('unit_master') }}
                                    </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{ Request::is('unit_description/*') ||
                                    Request::is('unit_type/*') ||
                                    Request::is('unit_condition/*') ||
                                    Request::is('unit_parking/*') ||
                                    Request::is('view/*') ||
                                    Request::is('property_type/*')
                                        ? 'block'
                                        : 'none' }}">
                                    @if (\App\Helpers\Helpers::module_permission_check('unit_description'))

                                        <li class="nav-item {{ Request::is('unit_description/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('unit_description.index') }}"
                                                title="{{ translate('unit_description') }}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">
                                                    {{ translate('unit_description') }}
                                                    <span class="badge badge-soft-danger badge-pill ml-1">
                                                        {{ \App\Models\UnitDescription::count() }}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (\App\Helpers\Helpers::module_permission_check('unit_condition'))

                                        <li class="nav-item {{ Request::is('unit_condition/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('unit_condition.index') }}"
                                                title="{{ translate('unit_condition') }}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">
                                                    {{ translate('unit_condition') }}
                                                    <span class="badge badge-soft-danger badge-pill ml-1">
                                                        {{ \App\Models\UnitCondition::count() }}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (\App\Helpers\Helpers::module_permission_check('unit_type'))
                                        <li class="nav-item {{ Request::is('unit_type/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('unit_type.index') }}"
                                                title="{{ translate('unit_type') }}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">
                                                    {{ translate('unit_type') }}
                                                    <span class="badge badge-soft-danger badge-pill ml-1">
                                                        {{ \App\Models\UnitType::count() }}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (\App\Helpers\Helpers::module_permission_check('view'))
                                        <li class="nav-item {{ Request::is('view/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('view.index') }}"
                                                title="{{ translate('view') }}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">
                                                    {{ translate('view') }}
                                                    <span class="badge badge-soft-danger badge-pill ml-1">
                                                        {{ \App\Models\View::count() }}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (\App\Helpers\Helpers::module_permission_check('property_type'))
                                        <li class="nav-item {{ Request::is('property_type/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('property_type.index') }}"
                                                title="{{ translate('property_type') }}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">
                                                    {{ translate('property_type') }}
                                                    <span class="badge badge-soft-danger badge-pill ml-1">
                                                        {{ \App\Models\PropertyType::count() }}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (\App\Helpers\Helpers::module_permission_check('floor'))
                                        <li class="nav-item {{ Request::is('floor/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('floor.index') }}"
                                                title="{{ translate('floor') }}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">
                                                    {{ translate('floor') }}
                                                    <span class="badge badge-soft-danger badge-pill ml-1">
                                                        {{ \App\Models\Floor::count() }}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </li>
                        @endif
                        <!--Unit Master Ends-->

                        <!-- Unit Master -->
                        @if (\App\Helpers\Helpers::module_permission_check('unit_master'))



                            <li
                                class="navbar-vertical-aside-has-menu {{ Request::is('project/*') || Request::is('unit_management/*') || Request::is('floor_management/*')
                                    ? 'active'
                                    : '' }}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                    href="javascript:" title="{{ translate('project') }}">
                                    <i class="tio-shop nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{ translate('project') }}
                                    </span>
                                </a>
                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
                                    style="display: {{ Request::is('project/*') || Request::is('unit_management/*') || Request::is('floor_management/*')
                                        ? 'block'
                                        : 'none' }}">
                                    @if (\App\Helpers\Helpers::module_permission_check('project'))

                                        <li class="nav-item {{ Request::is('project/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('project.index') }}"
                                                title="{{ translate('project') }}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">
                                                    {{ translate('project') }}
                                                    <span class="badge badge-soft-danger badge-pill ml-1">
                                                        {{ \App\Models\Project::count() }}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (\App\Helpers\Helpers::module_permission_check('floor_management'))
                                        <li class="nav-item {{ Request::is('floor_management/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('floor_management.index') }}"
                                                title="{{ translate('floor_management') }}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">
                                                    {{ translate('floor_management') }}
                                                    <span class="badge badge-soft-danger badge-pill ml-1">
                                                        {{ \App\Models\FloorManagement::count() }}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (\App\Helpers\Helpers::module_permission_check('unit_management'))

                                        <li class="nav-item {{ Request::is('unit_management/*') ? 'active' : '' }}">
                                            <a class="nav-link" href="{{ route('unit_management.index') }}"
                                                title="{{ translate('unit_management') }}">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">
                                                    {{ translate('unit_management') }}
                                                    <span class="badge badge-soft-danger badge-pill ml-1">
                                                        {{ \App\Models\UnitManagement::count() }}
                                                    </span>
                                                </span>
                                            </a>
                                        </li>
                                    @endif



                                </ul>
                            </li>
                        @endif

                        @if (\App\Helpers\Helpers::module_permission_check('unit_master'))



                            <li
                                class="navbar-vertical-aside-has-menu {{ Request::is('theme_settings/*') || Request::is('unit_management/*') || Request::is('floor_management/*')
                                    ? 'active'
                                    : '' }}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                    href="{{ route('theme_settings') }}" title="{{ translate('theme_settings') }}">
                                    <i class="tio-shop nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{ translate('theme_settings') }}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item pt-5">
                            </li>
                            @endif
                    </ul>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </aside>
</div>

@push('script_2')
    <script>
        $(window).on('load', function() {
            if ($(".navbar-vertical-content li.active").length) {
                $('.navbar-vertical-content').animate({
                    scrollTop: $(".navbar-vertical-content li.active").offset().top - 150
                }, 10);
            }
        });

        //Sidebar Menu Search
        var $rows = $('.navbar-vertical-content .navbar-nav > li');
        $('#search-bar-input').keyup(function() {
            var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

            $rows.show().filter(function() {
                var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
                return !~text.indexOf(val);
            }).hide();
        });
    </script>
@endpush
