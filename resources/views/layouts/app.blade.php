<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <x-metatag/>
    <x-favicon/>
    @livewireStyles
    <x-app_css/>
    @stack('css')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <x-navbar />
        <x-sidebar>
            <x-navitem_menu name="Dashboard" routename="dashboard" icon="fas fa-tachometer-alt" />
            <x-navitem_tree icon="fas fa-mountain" name="Sawah" :open="cek_currentroute(['giss','sawahs'])">
                @hasanyrole('admin|pro')
                <x-navitem_menu name="GIS" routename="giss" icon="fas fa-map-marked-alt" />
                @endhasanyrole
                <x-navitem_menu name="Daftar Sawah" routename="sawahs" icon="fas fa-map" />
            </x-navitem_tree>
            <x-navitem_tree icon="fas fa-users" name="Pawongan" :open="cek_currentroute(['pawongans'])">
                <x-navitem_menu name="Daftar Pawongan" routename="pawongans" icon="fas fa-users" />
            </x-navitem_tree>
            <x-navitem_tree icon="fas fa-coins" name="Lanja" :open="cek_currentroute(['lanjas','bayarlanjas'])">
                <x-navitem_menu name="Daftar Lanja" routename="lanjas" icon="fas fa-coins" />
                <x-navitem_menu name="Bayar Lanja" routename="bayarlanjas" icon="fas fa-wallet" />
            </x-navitem_tree>
            <x-navitem_menu name="Profile" routename="profile" icon="fas fa-user" />
            @hasanyrole('admin')
            <x-navitem_tree icon="fas fa-tools" name="Settings" :open="cek_currentroute(['referensi','users','infos'])">
                <x-navitem_menu name="Referensi" routename="referensi" icon="fas fa-asterisk" />
                <x-navitem_menu name="Users" routename="users" icon="fas fa-users" />
                <x-navitem_menu name="Info" routename="infos" icon="fas fa-bullhorn" />
            </x-navitem_tree>
            @endhasanyrole
        </x-sidebar>
        <div class="content-wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
        <footer class="main-footer">
            <x-app_version />
            <x-copyright />
        </footer>
    </div>
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    <x-app_script/>
    <x-script_lokasi/>
    @stack('js')
</body>
</html>