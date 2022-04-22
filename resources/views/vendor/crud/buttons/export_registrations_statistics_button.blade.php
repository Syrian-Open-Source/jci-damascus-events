
@if ($crud->hasAccess('show'))
    <a href="{{route('export_registrations_statistics' , $entry->getKey())}} " class="btn btn-xs btn-default">
        <i class="fa fa-ban"></i> {{trans('global.buttons.export_registrations_statistics')}}
    </a>
@endif
