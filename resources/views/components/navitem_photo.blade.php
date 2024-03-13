<!-- Photo Profile -->
<div class="navbar-brand">
    @if(!empty(Auth::user()->photo))
    <img class="img-circle" alt="User Image" height="28" src="{{ Auth::user()->photo }}">
    @else
    <img class="img-circle" alt="User Image" height="28" src="{{asset('img/avatar.png')}}">
    @endif
</div>