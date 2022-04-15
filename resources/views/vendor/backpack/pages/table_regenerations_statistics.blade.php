@extends(backpack_view('blank'))

@section('header')
    <div class="container-fluid">
        <h2>
            <span class="text-capitalize">{{trans('global.tables')}}</span>
        </h2>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            @foreach($data as $item)
                <div class="col-md-4 col-sm-12 mb-3">
                    <div class="card">
                        <img class="card-img-top" src="{{asset('images/tables.webp')}}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->title}}</h5>
                            <p class="card-text">{{trans('global.table_chairs_count')}}: {{$item->chairs_count}}</p>
                            <p class="card-text">{{trans('global.table_received_chairs')}}
                                : {{collect($item->chairTable)->whereNotNull('user_id')->count()}}</p>
                            <button type="button"
                                    data-table-items="{{$item->chairTable}}"
                                    class="btn btn-outline-primary table-button">
                                {{trans('global.buttons.show_table_members')}}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@section('after_scripts')
    <div class="modal fade table-items-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content container">
                <div class="modal-header">
                    <h6 class="modal-title"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="table-form p-2" id="form" action="" method="POST">
                        @csrf
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{trans('global.name')}}</th>
                                <th scope="col">{{trans('global.selected_food_items')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-items-body">
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.table-button').click(function () {
            $('.modal-title').html($(this).data('title'));
            $('.table-items-body').empty();
            $(this).data('tableItems').forEach((item, index) => {
                if (item.user) {
                    let selectedMenuItems = getSelectedMenuItems(item.user.menu_items);
                    let html = `
                    <tr>
                      <th scope="row">${index + 1}</th>
                      <td>${item.user.name}</td>
                      <td>${selectedMenuItems}</td>
                    </tr>
                    `;
                    $('.table-items-body').append(html)
                }
            });
            $('.table-items-modal').modal('show')
        });

        function getSelectedMenuItems(items)
        {
            return  items.map(function (item) {
                return item.title;
            }).join(', ');
        }
    </script>
@endsection
