<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <x-metatag/>
    <x-favicon/>
    <x-app_css/>
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
</head>
<body class="hold-transition login-page">
    @yield('content')
    <footer class="pt-5">
        <x-copyright />
    </footer>
    <x-app_script/>
</body>
</html>
