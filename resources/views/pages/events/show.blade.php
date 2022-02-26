@extends('layouts.main')

@section('content')
    <div class="mt-5">
        <div class="container-fluid service-area bg-light">
            <div class="row p-3">
                <div class="col-md-6">
                    <img class="card-img-top" src="{{asset('images/tables.webp')}}" alt="Card image cap">
                </div>
                <div class="food-introduction col-md-6 flex-column align-self-center">
                    <h3>{{trans('global.titles.table_text')}}</h3>
                    <p>{{trans('global.texts.table_text')}}</p>
                    <a href="{{route('tables.show' , $event->id)}}" class="btn btn-outline-info">{{trans('global.buttons.table')}}</a>
                </div>
            </div>
            <div class="row flex-column-reverse flex-lg-row p-3">
                <div class="food-introduction col-md-6 mt-lg-4 ">
                    <h3>{{trans('global.titles.menu_text')}}</h3>
                    <p>{{trans('global.texts.menu_text')}}</p>
                    <a href="{{route('menu.show' , $event->id)}}"  class="btn btn-outline-info">{{trans('global.buttons.menu')}}</a>
                </div>
                <div class="col-md-6">
                    <img class="card-img-top food-image" src="{{asset('images/food.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
