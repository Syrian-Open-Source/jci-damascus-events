@extends('layouts.main')

@section('content')
    <div class="mt-5">
        <div class="container-fluid events-area">
            <div class="row p-3">
                @foreach($data as $index => $item)
                    <div class="col-md-4 {{ $index%2 ? 'mt-5' :'' }}"
                         data-aos="{{ $index%2 ? 'zoom-in' :'zoom-in-up' }}"
                         data-aos-duration="2000"
                    >
                        @component('components.event-card-item', ['data' => $item])@endcomponent
                    </div>
                @endforeach
                @if(!sizeof($data))
                    <div class="col-md-4 event-cards-introduction mt-4 mb-4 text-white">
                        <h2>{{trans('global.titles.no_active_events')}}</h2>
                        <p class="mt-4">{{trans('global.texts.no_active_events')}}</p>
                        @component('components.auth-buttons')@endcomponent
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
