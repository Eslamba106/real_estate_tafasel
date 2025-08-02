<div class="inline-page-menu my-4">
    <ul class="list-unstyled">

        <li class="{{ Request::is('team') ? 'active' : '' }}"><a
                href="{{ route('team.index') }}">{{ translate('team') }}</a></li>
     

    </ul>
</div>
