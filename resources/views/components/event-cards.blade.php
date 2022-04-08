<div class="container-fluid events-area">
    <div class="row p-3">
        <div class="col-md-4 event-cards-introduction mt-4 mb-4 text-white">
            <h2>{{trans('global.titles.available_events')}}</h2>
            <p class="mt-4">{{trans('global.texts.available_events_text')}}</p>
            @component('components.auth-buttons')@endcomponent
        </div>
        @foreach($data as $item)
            <div class="col-md-4">
                @component('components.event-card-item', ['data' => $item])@endcomponent
            </div>
        @endforeach
    </div>
</div>
