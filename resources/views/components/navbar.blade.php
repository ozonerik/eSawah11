<nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Home</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <x-navitem_search/>
        <x-navitem_fullscreen/>
        <x-navitem_darkmode/>
        <x-navitem_photo/>
        <!-- Navbar signout -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{route('profile')}}">{{ __('Profile') }}</a>
            <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="dropdown-item" type="submit">{{ __('Sign Out') }}</button>
                </form>
            </div>
        </li>
    </ul>
</nav>