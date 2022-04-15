@component('components.logo-center')@endcomponent
<div class="my-3 d-flex justify-content-between nav-buttons w-25 mx-auto">
    @component('components.auth-buttons')@endcomponent
    @component('components.lang-button')@endcomponent
    @auth()
        <a href="{{route('events.index')}}"
           class="btn btn-light text-blue text-bold">{{trans('global.buttons.events')}}</a>
    @endauth
</div>
