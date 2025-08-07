<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        @if (\App\Helpers\Helpers::module_permission_check('team'))
            <li class="{{ Request::is('team') ? 'active' : '' }}"><a
                    href="{{ route('team.index') }}">{{ translate('team') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('employees'))
            <li class="{{ Request::is('employees*') ? 'active' : '' }}"><a
                    href="{{ route('employee.index') }}">{{ translate('employees') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('customers'))
            <li class="{{ Request::is('customers*') ? 'active' : '' }}"><a
                    href="{{ route('customer.index') }}">{{ translate('customers') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('roles'))
            <li class="{{ Request::is('roles*') ? 'active' : '' }}"><a
                    href="{{ route('role_admin.role_list') }}">{{ translate('roles') }}</a></li>
        @endif


    </ul>
</div>
