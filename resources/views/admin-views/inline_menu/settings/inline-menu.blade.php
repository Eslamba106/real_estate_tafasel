<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        @if (\App\Helpers\Helpers::module_permission_check('theme_settings'))
            <li class="{{ Request::is('theme_settings*') ? 'active' : '' }}"><a
                    href="{{ route('theme_settings') }}">{{ translate('theme_settings') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('language'))
            <li class="{{ Request::is('language*') ? 'active' : '' }}"><a
                    href="{{ route('business-settings.language.index') }}">{{ translate('language') }}</a></li>
        @endif
        


    </ul>
</div>
