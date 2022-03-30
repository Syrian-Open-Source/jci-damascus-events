@extends('layouts.main')

@section('content')

    <img class="w-100" src="{{asset('/images/event-background.jpg')}}" />

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="event-introduction text-center w-100">
                <h1 class="font-weight-bold"> {{trans('global.titles.event_introduction')}} </h1>
                <p class="intro-p"> {{trans('global.texts.event_introduction')}} <a href='https://github.com/Syrian-Open-Source/jci-damascus-events'>{{trans('global.here')}}</a></p>
            </div>
        </div>
        <div class="col-md-6">
            <img class="w-100 h-100 mt-1" src="{{asset('images/event3.png')}}">
        </div>
    </div>
</div>

    @component('components.event-cards')@endcomponent
    @include('components.contribution-section')
@endsection
