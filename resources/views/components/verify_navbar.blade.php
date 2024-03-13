<nav class="main-header navbar navbar-expand-md navbar-light">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('logo/esawah-text.png') }}" alt="Logo" class="brand-image" style="opacity: .8">
        </a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
        </ul>
        <ul class="navbar-nav mr-2 mr-md-0">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav mr-2 mr-md-0">
            <li class="nav-item">
            <div class="theme-switch-wrapper nav-link">
                <label class="theme-switch" for="checkbox">
                    <input type="checkbox" id="checkbox" />
                    <span class="slider round"></span>
                </label>
            </div>
            </li>
        </ul>
        <ul class="navbar-nav mr-2 mr-md-0">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    {{ __('Sign Out') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    </div>
</nav>