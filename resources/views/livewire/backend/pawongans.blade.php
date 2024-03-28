@push('js')
<x-script_map eventCurrent="getCurrentLoc" eventPlace="changePlace" dispatchname="getLokasiSaatini" geoalertId="alert" eventDrag="getDragData" ac="ac" lt="lt" lg="lg" autoalamat="lokasi" mapid="pawonganmap"/>
<x-script_inputmask />
@endpush
<div>
    <x-content_header name="Daftar Pawongan" >
        <li class="breadcrumb-item active">Pawongan</li>
        <li class="breadcrumb-item active">Daftar Pawongan</li>
    </x-content_header>
    <div class="row mx-1">
        @if($mode=='read')
        <x-card_table type="primary" width="12" order="1" smallorder="1" title="Daftar Pawongan" :data="$Pawongan" :thead="['Photo','Nama','Alamat','Telp/HP']" :tbody="['photo','nama','alamat','telp']" :tbtn="['edit','del']" search="Search...">
        <x-slot:menu>
            <button wire:click="onAdd" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Tambah"><i class="fas fa-plus"></i></button>
            <button wire:click="onDelSelect" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Hapus" @if(empty($checked)) disabled @endif><i class="fas fa-trash"></i></button>
            <button wire:click="onTrashed" class="btn btn-sm btn-success" data-toggle="tooltip" title="Trash" @if(empty($Restorepawongan->total())) disabled @endif><i class="fa fa-archive mr-2"></i>Trash</button>
        </x-slot>    
        </x-card_table>
        @elseif($mode=='trashed')
        <x-card_tabletrash type="danger" width="12" order="1" smallorder="1" title="Restore Pawongan" :data="$Restorepawongan" :thead="['NIK','Nama','Telp','Photo']" :tbody="['nik','nama','telp','photo']" :tbtn="['restore','del']" search="Search..."/>
        @elseif($mode=='add')
        <x-card_form name="Add Pawongan" width="12" order="1" smallorder="1" closeto="onRead">
            <h4>Add Pawongan</h4>
            <x-slot:footer>
            <form wire:submit.prevent="addpawongan">
                <x-input_mask typemask="nik" wajib="true" disabled="false" ids="nik" label="NIK" types="text" name="nik" placeholder="Type NIK" />
                <x-input_form disabled="false" wajib="true" ids="nama" label="Nama" types="text" name="nama" placeholder="Type Nama" />
                <x-input_map alertname="alert" mapid="pawonganmap" height="400px" />
                <x-input_mask typemask="lokasi" disabled="" ids="alamat" label="Lokasi Rumah" types="text" name="alamat" placeholder="Type Lokasi Sawah" />
                <x-inputlokasi_form action="onCurrentlokasi" labelbtn="Get Location" wajib="" disabled="" ids="latlang" label="Koordinat Rumah" types="text" name="latlang" placeholder="Get Koordinat Rumah" />
                <x-input_mask typemask="telp" disabled="false" ids="telp" label="Telp" types="text" name="telp" placeholder="Type Telp" />
                <div class="form-group">
                    <div class="font-weight-bold mb-2">Photo</div>
                    <img alt="images" src="{{ asset('img/image.png') }}" class="img-thumbnail rounded" style="max-height:150px"/> 
                </div>
                <x-file_form2 ids="photo" label="Photo" name="photo" :placeholder="$filename" capture=""/>
                <button type="button" wire:click="onRead" class="btn btn-success float-left">Back</button>
                <button type="submit" class="btn btn-primary float-right" wire:target="photo" wire:loading.attr="disabled">Save</button>
            </form>
            </x-slot>
        </x-card_form>
        @elseif($mode=='edit')
        <x-card_form name="Edit Pawongan" width="12" order="1" smallorder="1" closeto="onRead">
            <h4>Edit Pawongan</h4>
            <x-slot:footer>
            <form wire:submit.prevent="editpawongan">
                <x-input_mask typemask="nik" wajib="true" disabled="false" ids="nik" label="NIK" types="text" name="nik" placeholder="Type NIK" />
                <x-input_form disabled="false" wajib="true" ids="nama" label="Nama" types="text" name="nama" placeholder="Type Nama" />
                <x-input_map alertname="alert" mapid="pawonganmap" height="400px" />
                <x-input_mask typemask="lokasi" disabled="" ids="alamat" label="Lokasi Rumah" types="text" name="alamat" placeholder="Type Lokasi Sawah" />
                <x-inputlokasi_form action="onCurrentlokasi" labelbtn="Get Location" wajib="" disabled="" ids="latlang" label="Koordinat Rumah" types="text" name="latlang" placeholder="Get Koordinat Rumah" />
                <x-input_mask typemask="telp" disabled="false" ids="telp" label="Telp" types="text" name="telp" placeholder="Type Telp" />
                <div class="form-group">
                    <div class="font-weight-bold mb-2">Photo</div>
                    @if(!empty($tmpphoto))
                    <img alt="images" src="{{ $tmpphoto }}" class="img-thumbnail rounded" style="max-height:150px"/> 
                    @else
                    <img alt="images" src="{{ asset('img/image.png') }}" class="img-thumbnail rounded" style="max-height:150px"/> 
                    @endif
                </div>
                <x-file_form2 ids="photo" label="" name="photo" :placeholder="$filename" capture=""/>
                <button type="button" wire:click="onRead" class="btn btn-success float-left">Back</button>
                <button type="submit" class="btn btn-primary float-right" wire:target="img" wire:loading.attr="disabled">Save</button>
            </form>
            </x-slot>
        </x-card_form>
        @endif
    </div>
</div>