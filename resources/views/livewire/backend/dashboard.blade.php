@push('js')
<x-script_map eventCurrent="getCurrentLoc" eventPlace="changePlace" dispatchname="getLokasiSaatini" geoalertId="alert" eventDrag="getDragData" eventMeasure="getMeasureData" ac="ac" lt="lt" lg="lg" autoalamat="lokasi" mapid="gismap" area="mluas" length="mkel" />
@endpush
<div>
    <x-content_header name="Dashboard" >
        <li class="breadcrumb-item active">Dashboard</li>
    </x-content_header>
    <div class="row mx-1">
        
        <x-card_form name="Daftar Lanja" width="12" order="1" smallorder="1" closeto="onRead">
            <h1>Mode: {{ $mode }}</h1>
            @if($mode == 'read')
            <x-input_mask typemask="lokasi" disabled="false" ids="lokasi" label="Lokasi" types="text" name="lokasi" placeholder="Type Lokasi" />
            <x-input_mask typemask="luas" disabled="false" ids="luas" label="Luas" types="text" name="luas" placeholder="Type Luas" />
            <x-input_mask typemask="tanggal" disabled="false" ids="tanggal" label="Tanggal" types="text" name="tanggal" placeholder="Type tanggal" />
            <x-input_mask typemask="text" disabled="true" ids="result" label="Result" types="text" name="result" placeholder="Type Result" />
            <x-dropdown_select2 typeselect="single" ids="user" label="User" name="user" :data="$user" values="id" showval="name"/>
            <x-dropdown_select2 typeselect="multi" ids="user_multi" label="User Multi" name="user_multi" :data="$user" values="id" showval="name"/>
            @endif
            @if($mode == 'edit')
            <x-input_mask typemask="lokasi" disabled="false" ids="lokasi" label="Lokasi" types="text" name="lokasi" placeholder="Type Lokasi" />
            <x-input_mask typemask="luas" disabled="false" ids="luas" label="Luas" types="text" name="luas" placeholder="Type Luas" />
            <x-input_mask typemask="tanggal" disabled="false" ids="tanggal" label="Tanggal" types="text" name="tanggal" placeholder="Type tanggal" />
            <x-input_mask typemask="text" disabled="true" ids="result" label="Result" types="text" name="result" placeholder="Type Result" />
            <x-dropdown_select2 typeselect="single" ids="user" label="User" name="user" :data="$user" values="id" showval="name"/>
            <x-dropdown_select2 typeselect="multi" ids="user_multi" label="User Multi" name="user_multi" :data="$user" values="id" showval="name"/>
            @endif
            <button type="button" wire:click="gantiMode('{{ ($mode=='read')?'edit':'read' }}')" class="btn btn-success float-left">Ganti Mode</button>
        </x-card_form>
    </div>
</div>