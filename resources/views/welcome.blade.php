@extends('layouts.main')

@section('content')

    <img class="w-100" src="{{asset('/images/event-background.jpg')}}" />

    <div class="event-introduction text-center w-100">
        <h1 class="font-weight-bold"> {{trans('global.titles.event_introduction')}} </h1>
        <p class="w-50 mx-auto"> {{trans('global.texts.event_introduction')}} <a href='https://github.com/Syrian-Open-Source/jci-damascus-events'>{{trans('global.here')}}</a></p>
    </div>

    @component('components.event-cards')@endcomponent
@endsection
