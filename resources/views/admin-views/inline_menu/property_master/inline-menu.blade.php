<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        @if (\App\Helpers\Helpers::module_permission_check('show_all_unit_description'))
            <li class="{{ Request::is('unit_description') ? 'active' : '' }}"><a
                    href="{{ route('unit_description.index') }}">{{ translate('unit_description') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('show_all_unit_condition'))
            <li class="{{ Request::is('unit_condition') ? 'active' : '' }}"><a
                    href="{{ route('unit_condition.index') }}">{{ translate('unit_condition') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('show_all_unit_type'))
            <li class="{{ Request::is('unit_type') ? 'active' : '' }}"><a
                    href="{{ route('unit_type.index') }}">{{ translate('unit_type') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('show_all_unit_parking'))
            <li class="{{ Request::is('unit_parking') ? 'active' : '' }}"><a
                    href="{{ route('unit_parking.index') }}">{{ translate('unit_parking') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('show_all_view'))
            <li class="{{ Request::is('view') ? 'active' : '' }}"><a
                    href="{{ route('view.index') }}">{{ translate('view') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('show_all_property_type'))
            <li class="{{ Request::is('property_type') ? 'active' : '' }}"><a
                    href="{{ route('property_type.index') }}">{{ translate('property_type') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('show_all_floor'))
            <li class="{{ Request::is('floor') ? 'active' : '' }}"><a
                    href="{{ route('floor.index') }}">{{ translate('floor') }}</a></li>
        @endif 

    </ul>
</div>
