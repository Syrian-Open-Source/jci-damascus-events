@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="event-introduction text-center w-100">
                    <h1 class="font-weight-bold"> {{trans('global.titles.event_introduction')}} </h1>
                    <p class="intro-p"> {{trans('global.texts.events_system_description')}} <a class="text-bold"
                            href='https://github.com/Syrian-Open-Source/jci-damascus-events'>{{trans('global.here')}}</a>
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <img class="w-100 h-100 mt-1" src="{{asset('images/event3.png')}}">
            </div>
        </div>
    </div>
    <img class="w-100 bg-header mb-3" src="{{asset('/images/event-background.jpg')}}"/>

    @component('components.event-cards' , ['data' => $data])@endcomponent
@endsection
