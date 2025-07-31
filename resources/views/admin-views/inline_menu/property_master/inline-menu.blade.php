<div class="inline-page-menu my-4">
    <ul class="list-unstyled">

        <li class="{{ Request::is('unit_description') ? 'active' : '' }}"><a
                href="{{ route('unit_description.index') }}">{{ translate('unit_description') }}</a></li>
        <li class="{{ Request::is('unit_condition') ? 'active' : '' }}"><a
                href="{{ route('unit_condition.index') }}">{{ translate('unit_condition') }}</a></li>
        <li class="{{ Request::is('unit_type') ? 'active' : '' }}"><a
                href="{{ route('unit_type.index') }}">{{ translate('unit_type') }}</a></li>
        <li class="{{ Request::is('unit_parking') ? 'active' : '' }}"><a
                href="{{ route('unit_parking.index') }}">{{ translate('unit_parking') }}</a></li>
        <li class="{{ Request::is('view') ? 'active' : '' }}"><a
                href="{{ route('view.index') }}">{{ translate('view') }}</a></li>
        <li class="{{ Request::is('property_type') ? 'active' : '' }}"><a
                href="{{ route('property_type.index') }}">{{ translate('property_type') }}</a></li>
        <li class="{{ Request::is('floor') ? 'active' : '' }}"><a
                href="{{ route('floor.index') }}">{{ translate('floor') }}</a></li>

    </ul>
</div>
