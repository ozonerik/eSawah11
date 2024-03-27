<!-- @push('js')
<x-script_mapadd dispatchAddress="getAutocomplete" dispatchname="getLokasiSaatini" geoalertId="alert" eventDrag="getDragData" eventMeasure="getMeasureData" ac="ac" lt="lt" lg="lg" autoalamat="lokasi" mapid="mapaddsawah" area="mluas" length="mkel" />
@endpush -->
<div>
    <x-content_header name="Daftar Sawah" >
        <li class="breadcrumb-item active">Sawah</li>
        <li class="breadcrumb-item active">Daftar Sawah</li>
    </x-content_header>
    <div class="row mx-1">
        <livewire:kalkulatorsawah />
        @if($mode=='read')
        <x-card_tablesawah type="primary" width="9" order="1" smallorder="1" title="Daftar Sawah" :data="$Sawah" :thead="['No Surat','Nama Sawah','Luas(m2)','Lokasi','Photo Sawah']" :tbody="['nosawah','namasawah','luas','lokasi','img']" :tbtn="['edit','del']" search="Search...">
        <x-slot:menu>
            <button wire:click="onAdd" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Tambah"><i class="fas fa-plus"></i></button>
            <button wire:click="onDelSelect" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus" @if(empty($checked)) disabled @endif><i class="fas fa-trash"></i></button>
            <button wire:click="onTrashed" class="btn btn-sm btn-success" data-toggle="tooltip" title="Trash" @if(empty($Restoresawah->total())) disabled @endif><i class="fa fa-archive mr-2"></i>Trash</button>
        </x-slot>    
        </x-card_tablesawah>
        @endif
        @if($mode=='trashed')
        <x-card_tabletrash type="danger" width="9" order="1" smallorder="1" title="Restore Sawah" :data="$Restoresawah" :thead="['No Surat','Nama Sawah','Luas(m2)','Lokasi']" :tbody="['nosawah','namasawah','luas','lokasi']" :tbtn="['restore','del']" search="Search..."/>
        @endif
    
    </div>
</div>