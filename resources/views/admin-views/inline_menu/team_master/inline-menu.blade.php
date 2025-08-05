<div class="inline-page-menu my-4">
    <ul class="list-unstyled">

        <li class="{{ Request::is('team') ? 'active' : '' }}"><a
                href="{{ route('team.index') }}">{{ translate('team') }}</a></li>
        <li class="{{ Request::is('employees*') ? 'active' : '' }}"><a
                href="{{ route('employee.index') }}">{{ translate('employees') }}</a></li>


    </ul>
</div>
