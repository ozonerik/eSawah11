<div>
    <header class="masthead">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">eSawah</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">Aplikasi Manajemen Penyewaan Sawah Berbasis Web</h2>
                    @if (Route::has('login'))
                        @auth
                            <a class="btn btn-primary" href="{{ route('dashboard') }}">Dashboard</a>
                        @else
                            <a class="btn btn-primary" href="{{ route('login') }}">Sign In</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>
</div>
