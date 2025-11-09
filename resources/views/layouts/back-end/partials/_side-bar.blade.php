    <?php $lang = session()->get('locale');
    $dir = session()->get('direction'); ?>

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
                            <li
                                class="navbar-vertical-aside-has-menu {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                                <a class="js-navbar-vertical-aside-menu-link nav-link"
                                    title="{{ translate('dashboard') }}" href="{{ route('dashboard') }}">
                                    <i class="tio-home-vs-1-outlined nav-icon"></i>
                                    <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
                                        {{ translate('dashboard') }}
                                    </span>
                                </a>
                            </li>
                            
                            @if (\App\Helpers\Helpers::module_permission_check('unit_description') || \App\Helpers\Helpers::module_permission_check('unit_condition') 
                            || \App\Helpers\Helpers::module_permission_check('unit_type') || \App\Helpers\Helpers::module_permission_check('unit_parking') || \App\Helpers\Helpers::module_permission_check('floor') || \App\Helpers\Helpers::module_permission_check('property_type') || \App\Helpers\Helpers::module_permission_check('view'))
                                <li class=" {{ (Request::is('unit_description*') || Request::is('unit_condition*') ||
                                Request::is('unit_parking*') || Request::is('floor*') || Request::is('property_type*') || Request::is('unit_type*') || Request::is('view*') ) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('unit-master') }}"
                                        title="{{ translate('Unit_Master') }}">
                                        <i class="fas fa-building"></i>
                                        <span class="text-truncate"
                                            style="{{ $lang == 'en' ? 'margin-left: 8px;' : 'margin-right: 8px;' }}">
                                            {{ translate('Unit_Master') }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                             @if (\App\Helpers\Helpers::module_permission_check('show_all_project') 
                            || \App\Helpers\Helpers::module_permission_check('show_all_floor_management') || \App\Helpers\Helpers::module_permission_check('show_all_unit_management') )
                                <li class=" {{ (Request::is('project*') || Request::is('floor_management*') || Request::is('unit_management*'))? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('project_management') }}"
                                        title="{{ translate('project') }}">
                                         <i class="fas fa-layer-group"></i>
                                        <span class="text-truncate" style="{{ $lang == 'en' ? 'margin-left: 8px;' : 'margin-right: 8px;' }}">
                                            {{ translate('Project_Management') }}
                                            
                                        </span>
                                    </a>
                                </li>
                            @endif
                            @if (\App\Helpers\Helpers::module_permission_check('team')
                            || \App\Helpers\Helpers::module_permission_check('team') 
                            || \App\Helpers\Helpers::module_permission_check('employees')
                            || \App\Helpers\Helpers::module_permission_check('roles') )
                                <li class=" {{ (Request::is('team*') || Request::is('employees*')  || 
                                Request::is('custom-role*')  ) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('user_management') }}"
                                        title="{{ translate('user_management') }}">
                                         <i class="fas fa-users"></i>
                                        <span class="text-truncate" style="{{ $lang == 'en' ? 'margin-left: 8px;' : 'margin-right: 8px;' }}">
                                            {{ translate('user_management') }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                            @if (\App\Helpers\Helpers::module_permission_check('show_all_customers') || App\Helpers\Helpers::module_permission_check('add_reminder')
                            ||  \App\Helpers\Helpers::module_permission_check('all_installments') )
                                <li class=" {{ (Request::is('crm*')  || Request::is('customers*') || Request::is('reminders*') || Request::is('installment*')) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('crm') }}"
                                        title="{{ translate('CRM') }}">
                                        <i class="fas fa-handshake"></i>

                                        <span class="text-truncate"  style="{{ $lang == 'en' ? 'margin-left: 8px;' : 'margin-right: 8px;' }}">
                                            {{ translate('CRM') }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                            @if (\App\Helpers\Helpers::module_permission_check('theme_settings') || \App\Helpers\Helpers::module_permission_check('language'))
                                <li class=" {{ (Request::is('theme_settings*') || Request::is('language*') ) ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('settings') }}"
                                        title="{{ translate('settings') }}">
                                        <i class="fas fa-settings"></i>
                                        <span class="text-truncate">
                                            {{ translate('settings') }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                            <!-- End Dashboards -->




                            {{-- @if (\App\Helpers\Helpers::module_permission_check('unit_description'))
                                <li class=" {{ Request::is('unit_description*') ? 'active' : '' }}">
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
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('unit_condition'))
                                <li class=" {{ Request::is('unit_condition*') ? 'active' : '' }}">
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
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('unit_type'))
                                <li class=" {{ Request::is('unit_type*') ? 'active' : '' }}">
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
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('view'))
                                <li class=" {{ Request::is('view*') ? 'active' : '' }}">
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
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('property_type'))
                                <li class=" {{ Request::is('property_type*') ? 'active' : '' }}">
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
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('floor'))
                                <li class=" {{ Request::is('floor*') ? 'active' : '' }}">
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
                            @endif --}}


                            <!--Unit Master Ends-->

                            <!-- Unit Master -->

                            {{-- @if (\App\Helpers\Helpers::module_permission_check('show_all_project'))
                                <li class=" {{ Request::is('project*') ? 'active' : '' }}">
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
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('show_all_floor_management'))
                                <li class=" {{ Request::is('floor_management*') ? 'active' : '' }}">
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
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('show_all_unit_management'))
                                <li class=" {{ Request::is('unit_management*') ? 'active' : '' }}">
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
                            @endif --}}


                           
{{-- 
                            @if (\App\Helpers\Helpers::module_permission_check('team'))
                                <li class=" {{ Request::is('team*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('team.index') }}"
                                        title="{{ translate('team') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ translate('teams') }}
                                        </span>
                                    </a>
                                </li>
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('employees'))
                                <li class=" {{ Request::is('employees*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('employee.index') }}"
                                        title="{{ translate('employees') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ translate('employees') }}
                                        </span>
                                    </a>
                                </li>
                            @endif --}}

                            {{-- @if (\App\Helpers\Helpers::module_permission_check('roles'))
                                <li class=" {{ Request::is('roles*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('role_admin.role_list') }}"
                                        title="{{ translate('roles') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ translate('roles') }}
                                        </span>
                                    </a>
                                </li>
                            @endif --}}


   
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('show_all_customers'))
                                <li class=" {{ Request::is('customers*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('customer.index') }}"
                                        title="{{ translate('customers') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ translate('customers') }}
                                        </span>
                                    </a>
                                </li>
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('add_reminder'))
                                <li class=" {{ Request::is('reminders*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('reminders.index') }}"
                                        title="{{ translate('My_Reminders') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ translate('My_Reminders') }}
                                        </span>
                                    </a>
                                </li>
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('all_installments'))
                                <li class=" {{ Request::is('installment*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('customer.installments_list') }}"
                                        title="{{ translate('installments_list') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ translate('installments_list') }}
                                        </span>
                                    </a>
                                </li>
                            @endif --}}

                            
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('theme_settings'))
                                <li class=" {{ Request::is('theme_settings*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('theme_settings') }}"
                                        title="{{ translate('theme_settings') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ translate('theme_settings') }}
                                        </span>
                                    </a>
                                </li>
                            @endif --}}
                            {{-- @if (\App\Helpers\Helpers::module_permission_check('language'))
                                <li class=" {{ Request::is('language*') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('business-settings.language.index') }}"
                                        title="{{ translate('language') }}">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">
                                            {{ translate('language') }}
                                        </span>
                                    </a>
                                </li>
                            @endif --}}

                            <li class=" pt-5">
                            </li>

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
