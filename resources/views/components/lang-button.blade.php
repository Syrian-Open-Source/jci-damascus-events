<form action="{{route('change_lang')}}" method="POST">
    @csrf
    @if(isRtlDirection())
        <input type="hidden" name="lang" value="en">
        <button class="btn btn-light text-blue text-bold">En</button>
    @else
        <input type="hidden" name="lang" value="ar">
        <button class="btn btn-light text-blue text-bold">Ar</button>
    @endif
</form>
