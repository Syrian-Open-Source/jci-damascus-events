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
                                    data-table-items="{{$item->chairTable}}"
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
                    @if (!$isRegisteredBefore)
                        <div class="modal-footer">
                            <button form="form"
                                    class="btn btn-outline-primary btn-block">{{trans('global.buttons.register')}}</button>
                        </div>
                    @else
                        <p>{{trans('global.registered_before')}}</p>
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
                $('.table-items-body').data('allowed', $(this).data('allowed'));
                $('.table-items-body').empty();
                $(this).data('tableItems').forEach((item, index) => {
                    console.log(item)
                    let html = `
                    <tr>
                      <th scope="row">${index}</th>
                      <td>${item.title}</td>
                    </tr>
                    `;
                    $('.table-items-body').append(html)
                });
                $('.table-items-modal').modal('show')
            });


            $(document).on('change', '.table-item-input', function () {
                let len = $('.table-item-input:checked').length;
                $('.table-item-input').each((index, item) => {
                    if (!item.checked && len == $('.table-items-body').data('allowed')) {
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
