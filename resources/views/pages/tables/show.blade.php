@extends('layouts.main')

@section('content')
    <div class="container ">
        <div class="row">
            @foreach($data as $item)
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <img class="card-img-top" src="{{asset('images/tables.webp')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->title}}</h5>
                            <p class="card-text">{{$item->description}}</p>
                            <button type="button"
                                    data-menu-items="{{$item->foodTables}}"
                                    data-url="{{route('table.register_in_table',$item->id)}}"
                                    class="btn btn-outline-primary menu-button">
                                {{trans('global.buttons.show_menu_items')}}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal fade menu-items-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content container">
                    <div class="modal-header">
                        <h6 class="modal-title"></h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">{{trans('global.texts.edit_warning')}}</p>
                        <form class="menu-form p-2" id="form" action="" method="POST">
                            @csrf
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{trans('global.title')}}</th>
                                    <th scope="col">{{trans('global.description')}}</th>
                                    <th scope="col">{{trans('global.choose')}}</th>
                                </tr>
                                </thead>
                                <tbody class="menu-items-body">
                                </tbody>
                            </table>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button form="form"
                                class="btn btn-outline-primary btn-block">{{trans('global.buttons.save')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
