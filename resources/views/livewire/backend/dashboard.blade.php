@push('js')
<x-script_map lt="lt" lg="lg" autoalamat="address" mapid="tempatMap" area="area" length="keliling" />
<script>
    function myFunction(){
        Livewire.dispatch('testEmit',{ data: 'coba aja' });
    }
</script>
@endpush
<div>
    <x-content_header name="Dashboard" >
        <li class="breadcrumb-item active">Dashboard</li>
    </x-content_header>
    <div class="row mx-1">
        <x-card_form name="Daftar Lanja" width="12" order="1" smallorder="1" closeto="onRead">
            <h1>Ini Dashboard</h1>
            <button onclick="myFunction()">Click me</button>
            <div wire:ignore id="tempatMap"></div>
            lt= {{ $lt }}, lg= {{ $lg }}, area= {{ $area }}, keliling= {{ $keliling }}
            <x-input_mask typemask="text" disabled="false" ids="address" label="Address" types="text" name="address" placeholder="Type address" />
            <x-input_mask typemask="luas" disabled="false" ids="luas" label="Luas" types="text" name="luas" placeholder="Type Luas" />
            <x-input_mask typemask="tanggal" disabled="false" ids="tanggal" label="Tanggal" types="text" name="tanggal" placeholder="Type tanggal" />
            <x-input_mask typemask="text" disabled="true" ids="result" label="Result" types="text" name="result" placeholder="Type Result" />
            <x-dropdown_select2 ids="user" label="User" name="user" :data="$user" values="id" showval="name"/>
            <x-dropdown_select2_multi ids="user_multi" label="User Multi" name="user_multi" :data="$user" values="id" showval="name"/>
        </x-card_form>
    </div>
</div>