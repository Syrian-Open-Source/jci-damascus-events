@extends('layouts.main')


@section('content')
    <div class="container ">
        <div class="row">
            @foreach($data as $item)
                <div class="col-md-4 com-sm-12">
                    <div class="card">
                        <img class="card-img-top" src="{{asset('images/food-card.jpg')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->title}}</h5>
                            <p class="card-text">{{trans('global.texts.menu_description' , ['count'  => $item->max_plate])}}</p>
                            @if($item->notes != '')
                                <br>
                                <p>{{trans('global.notes')}} {{$item->notes}}</p>
                            @endif
                            <button type="button"
                                    data-menu-items="{{$item->menuItems}}"
                                    data-max="{{$item->menuItems}}"
                                    data-allowed="{{$item->max_plate}}"
                                    data-title="{{$item->title}}"
                                    data-url="{{route('menus.save_user_items',$item->id)}}"
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
                        <button type="button" class="btn btn-outline-default" data-dismiss="modal" aria-label="Close">
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
    @push('custom-scripts')
        <script>
            $('.menu-button').click(function () {
                $('.menu-form').attr('action', $(this).data('url'));
                $('.modal-title').html($(this).data('title'));
                $('.menu-items-body').data('allowed', $(this).data('allowed'));
                $('.menu-items-body').empty();
                $(this).data('menuItems').forEach((item, index) => {
                    let html = `
                    <tr>
                      <th scope="row">${index}</th>
                      <td>${item.title}</td>
                      <td>${item.description}</td>
                      <td><input class="menu-item-input" type="checkbox" name='selected[]' value="${item.id}"></td>
                    </tr>
                    `;
                    $('.menu-items-body').append(html)
                });
                $('.menu-items-modal').modal('show')
            });


            $(document).on('change', '.menu-item-input', function () {
                let len = $('.menu-item-input:checked').length;
                $('.menu-item-input').each((index, item) => {
                    if (!item.checked && len == $('.menu-items-body').data('allowed')) {
                        item.disabled = true;
                    } else {
                        if (item.disabled) {
                            item.disabled = false;
                        }
                    }
                })
            })
        </script>
    @endpush

@endsection
