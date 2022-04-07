@extends('layouts.main')

@section('content')
    <div class="mt-5">
        @component('components.event-cards')@endcomponent
    </div>
    @include('components.contribution-section')
@endsection
