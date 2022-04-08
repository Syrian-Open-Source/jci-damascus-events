<div class="container my-2">
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{session()->get('success')}}
        </div>

    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{session()->get('error')}}
        </div>
    @endif
    @if(session()->has('errors'))
        <div class="alert alert-danger" role="alert">
            @foreach(session()->get('error') as $error)
                {{$error}}
            @endforeach
        </div>
    @endif
</div>
