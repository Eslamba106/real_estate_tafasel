<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        <li class="{{ Request::is('business-settings/web-config') ?'active':'' }}"><a href="{{route('web-config.index')}}">{{translate('business_settings')}}</a></li>
 
        {{-- <li class="{{ Request::is('admin/customer/customer-settings') ?'active':'' }}"><a href="{{route('admin.customer.customer-settings')}}">{{translate('customer')}}</a></li> --}}
 
    </ul>
</div>
