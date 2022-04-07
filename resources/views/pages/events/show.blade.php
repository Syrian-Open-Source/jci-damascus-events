@extends('layouts.main')

@section('content')
    <div class="mt-5">
        <div class="container-fluid events-area">
            <div class="row p-3">
                @foreach($data as $item)
                    <div class="col-md-4">
                        @component('components.event-card-item', ['data' => $item])@endcomponent
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @include('components.contribution-section')
@endsection
