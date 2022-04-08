@extends('layouts.main')


@section('content')
    <div class="container ">
        @foreach($data as $item)
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset('images/food-card.jpg')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">{{$item->title}}</h5>
                    <p class="card-text">{{trans('global.texts.menu_description' , ['count'  => $item->max_plate , 'notes' => $item->notes])}}</p>
                    <button type="button"
                            data-menu-items="{{$item->menuItems}}"
                            data-url="{{route('menus.save_user_items',$item->id)}}"
                            class="btn btn-primary menu-button">
                        {{trans('global.buttons.show_menu_items')}}
                    </button>
                </div>
            </div>
        @endforeach
            <div class="modal fade menu-items-modal" tabindex="-1" role="dialog"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form class="menu-form" action="" method="POST">
                            @csrf
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{trans('global.title')}}</th>
                                    <th scope="col">{{trans('global.choose')}}</th>
                                </tr>
                                </thead>
                                <tbody class="menu-items-body">
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    @push('custom-scripts')
        <script>
            $('.menu-button').click(function () {
                $('.menu-form').attr('action', $(this).data('url'));
                $(this).data('menuItems').forEach((index, item) => {
                    let html = `
                      <th scope="row">${index}</th>
                      <td>${item.title}</td>
                      <td><input type="checkbox" name='selected[${index}]'></td>
                    `;
                    $('.menu-items-body').append(html)
                })
                $('.menu-items-modal').modal('show')
            })
        </script>
    @endpush

@endsection
