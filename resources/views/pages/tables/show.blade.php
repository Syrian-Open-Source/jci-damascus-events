@extends('layouts.main')

@section('content')
    <div class="container ">
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
                                    data-table-capacity="{{$item->chairs_count}}"
                                    data-can-register="{{$item->chairs_count >= collect($item->chairTable)->whereNotNull('user_id')->count()}}"
                                    data-url="{{route('table.register_in_table',$item->id)}}"
                                    class="btn btn-outline-primary table-button">
                                {{trans('global.buttons.show_table_members')}}
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
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
                        <p class="text-danger">{{trans('global.texts.edit_warning')}}</p>
                        <form class="table-form p-2" id="form" action="" method="POST">
                            @csrf
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{trans('global.name')}}</th>
                                </tr>
                                </thead>
                                <tbody class="table-items-body">
                                </tbody>
                            </table>
                        </form>
                    </div>
                    @if (!$canNotRegister)
                        <div class="modal-footer justify-content-center">
                            <button form="form"
                                    class="btn btn-outline-primary btn-block">{{trans('global.buttons.received_chair')}}</button>
                        </div>
                    @else
                        <p class="text-center font-weight-bold text-danger">{{trans('global.registered_before')}}</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
    @push('custom-scripts')
        <script>
            $('.table-button').click(function () {
                $('.table-form').attr('action', $(this).data('url'));
                $('.modal-title').html($(this).data('title'));
                $('.table-items-body').empty();
                $(this).data('tableItems').forEach((item, index) => {
                    if (item.user) {
                        let html = `
                    <tr>
                      <th scope="row">${index + 1}</th>
                      <td>${item.user.name}</td>
                    </tr>
                    `;
                        $('.table-items-body').append(html)
                    }
                });
                if (!$(this).data('canRegister')) {
                    $('.modal-footer').html("<p class='text-center font-weight-bold text-danger'>{{trans('global.table_capacity_exceeded')}}</p>")
                }
                $('.table-items-modal').modal('show')
            });
        </script>
    @endpush
@endsection
