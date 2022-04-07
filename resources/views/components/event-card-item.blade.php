<div class="card mb-3 event-card-item">
    <img class="card-img-top" src="{{asset('images/event-test.jpg')}}" alt="Card image cap">

    <div class="card-body">
        <p class="card-text"><small class="text-muted">March 3, 2022</small></p>

        <h5 class="card-title text-bold">Card title</h5>

        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
        @auth()
            <a href="#" class="text-bold"> <img class="arrow-icon"
                                                src="{{asset('icons/arrow.png')}}"> {{trans('global.buttons.details')}}
            </a>
        @endauth
    </div>

</div>
