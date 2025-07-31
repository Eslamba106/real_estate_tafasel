<div class="inline-page-menu my-4">
    <ul class="list-unstyled"> 
        <li class="{{ Request::is('project*') ?'active':'' }}"><a href="{{ route('project.index') }}">{{translate('projects')}}</a></li> 
        <li class="{{ Request::is('floor_management') ?'active':'' }}"><a href="{{ route('floor_management.index') }}">{{translate('floors_management')}}</a></li>
        <li class="{{ (Request::is('unit_management') ||
        Request::is('unit_management/create') || Request::is('unit_management/edit*') )?'active':'' }}"><a href="{{ route('unit_management.index') }}">{{translate('unit_management')}}</a></li>
         
    </ul>
</div>
