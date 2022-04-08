@extends('layouts.main')

@section('content')
    <div class="mt-5">
        <div class="container-fluid service-area bg-light">
            <div class="row p-3">
                <div class="col-md-6">
                    <img class="card-img-top" src="{{asset('images/tables.webp')}}" alt="Card image cap">
                </div>
                <div class="food-introduction col-md-6 flex-column align-self-center">
                    <h3>{{trans('global.titles.food_menu_text')}}</h3>
                    <p>{{trans('global.texts.food_menu_text')}}</p>
                    <button class="btn btn-outline-info">{{trans('global.buttons.menu')}}</button>
                </div>
            </div>
            <div class="row flex-column-reverse flex-lg-row p-3">
                <div class="food-introduction col-md-6 mt-lg-4 ">
                    <h3>{{trans('global.titles.food_menu_text')}}</h3>
                    <p>{{trans('global.texts.food_menu_text')}}</p>
                    <button class="btn btn-outline-info">{{trans('global.buttons.menu')}}</button>
                </div>
                <div class="col-md-6">
                    <img class="card-img-top food-image" src="{{asset('images/food.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    @include('components.contribution-section')
@endsection
