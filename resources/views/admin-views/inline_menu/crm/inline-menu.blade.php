<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        @if (\App\Helpers\Helpers::module_permission_check('customers'))
            <li class="{{ Request::is('customers*') ? 'active' : '' }}"><a
                    href="{{ route('customer.index') }}">{{ translate('customers') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('add_reminder'))
            <li class="{{ Request::is('reminders*') ? 'active' : '' }}"><a
                    href="{{ route('reminders.index') }}">{{ translate('my_reminders') }}</a></li>
        @endif
        @if (\App\Helpers\Helpers::module_permission_check('all_installments'))
            <li class="{{ Request::is('installment*') ? 'active' : '' }}"><a
                    href="{{ route('customer.installments_list') }}">{{ translate('installments') }}</a></li>
        @endif


    </ul>
</div>
