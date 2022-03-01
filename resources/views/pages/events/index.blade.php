@extends('layouts.main')

@section('content')
    <div class="mt-5">
        <div class="container-fluid events-area">
            <div class="row p-3">
                @foreach($data as $index => $item)
                    <div class="col-md-4 {{ $index%2 ? 'mt-5' :'' }}"
                         data-aos="{{ $index%2 ? 'zoom-in' :'zoom-in-up' }}"
                         data-aos-duration="2000"
                    >
                        @component('components.event-card-item', ['data' => $item])@endcomponent
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
