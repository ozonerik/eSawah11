<div class="col-md-{{ $width }} order-{{ $smallorder }} order-md-{{ $order }} connectedSortable mb-3 mb-md-0">
    <div class="card card-primary">
        <div class="card-header text-center">{{ $name }}</div>
        <div class="card-body box-profile">
            <div class="text-center">
                @if(!empty(Auth::user()->photo))
                <img class="profile-user-img img-fluid img-circle" src="{{ asset('storage/'.Auth::user()->photo) }}" alt="User picture">
                @else
                <img class="profile-user-img img-fluid img-circle" src="{{asset('img/avatar.png')}}" alt="User picture">
                @endif
            </div>
            <h3 class="profile-username text-center">{{ucwords(Auth::user()->name)}}</h3>
            <p class="text-muted text-center">{{ucwords(Auth::user()->getRoleNames()->implode(','))}}</p>
            {{ $slot }}
        </div>
        <!-- /.card-body -->
    </div>
</div>