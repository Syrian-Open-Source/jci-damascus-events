<div class="card mb-3 event-card-item">
    <img class="card-img-top" src="{{asset('images/event-test.jpg')}}" alt="Card image cap">

    <div class="card-body">
        <p class="card-text"><small class="text-muted">{{$data->start_date}} - {{$data->end_date}}</small></p>

        <h5 class="card-title text-bold">{{$data->title}}</h5>

        <p class="card-text">{{$data->description}}</p>
        @auth()
            <a href="{{route('events.show', 1)}}" class="text-bold">
                <img class="arrow-icon {{isRtlDirection() ? 'flip' : ''}}" src="{{asset('icons/arrow.png')}}">
                {{trans('global.buttons.details')}}
            </a>
        @endauth
    </div>

</div>
