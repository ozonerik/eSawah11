@push('js')
<x-script_map dispatchname="getLokasiSaatini" geoalertId="alert" eventDrag="getDragData" eventMeasure="getMeasureData" ac="ac" lt="lt" lg="lg" autoalamat="lokasi" mapid="mapaddsawah" area="mluas" length="mkel" />
@endpush
<div>
    <x-content_header name="Daftar Sawah" >
        <li class="breadcrumb-item active">Sawah</li>
        <li class="breadcrumb-item active">Daftar Sawah</li>
    </x-content_header>
    <div class="row mx-1">
        <x-card_form name="Add Sawah" width="12" order="1" smallorder="1" closeto="onRead">
            <h4>Add Sawah Selected</h4>
            <x-slot:footer>
            <form wire:submit.prevent="addsawah">
                <x-input_form wajib="true" disabled="" ids="nosawah" label="No Surat" types="text" name="nosawah" placeholder="Enter No Surat" />
                <x-input_form wajib="true" disabled="" ids="namasawah" label="Nama Sawah" types="text" name="namasawah" placeholder="Type Nama Sawah" />
                <x-input_mask typemask="luas" wajib="true" disabled="" ids="luas" label="Luas Sawah (m2)" types="text" name="luas" placeholder="Type Luas Sawah" />
                <x-input_mask typemask="harga" disabled="false" ids="hargabata" label="Harga Sawah Per Bata (Rp)" types="text" name="hargabata" placeholder="Harga Per Bata Sawah (Rp)" />
                <x-input_mask typemask="bata" wajib="" disabled="true" ids="bata" label="Luas Sawah (bata)" types="text" name="bata" placeholder="Luas Sawah (bata)" />                <div wire:ignore id="alert"></div>
                <div wire:ignore id="mapaddsawah" style="height: 400px;" class="w-100 rounded bg-blank mb-3"></div>
                <x-input_mask typemask="lokasi" wajib="true" disabled="" ids="lokasi" label="Lokasi Sawah" types="text" name="lokasi" placeholder="Type Lokasi Sawah" />
                <x-inputlokasi_form action="onCurrentlokasi" labelbtn="Get My Location" wajib="" disabled="" ids="latlang" label="Koordinat Sawah" types="text" name="latlang" placeholder="Get Koordinat Sawah" />
                <x-input_form disabled="" ids="b_barat" label="Batas Barat/Kulon" types="text" name="b_barat" placeholder="Type Batas Barat Sawah" />
                <x-input_form disabled="" ids="b_utara" label="Batas Utara/Lor" types="text" name="b_utara" placeholder="Type Batas Utara Sawah" />
                <x-input_form disabled="" ids="b_timur" label="Batas Timur/Wetan" types="text" name="b_timur" placeholder="Type Batas Timur Sawah" />
                <x-input_form disabled="" ids="b_selatan" label="Batas Selatan/Kidul" types="text" name="b_selatan" placeholder="Type Batas Selatan Sawah" />
                <x-input_form disabled="" ids="namapenjual" label="Nama Penjual" types="text" name="namapenjual" placeholder="Type Penjual Sawah" />
                <x-input_mask typemask="harga" disabled="" ids="hargabeli" label="Harga Beli (Rp)" types="text" name="hargabeli" placeholder="Type Harga Beli Sawah" />
                <x-input_mask typemask="tanggal" wajib="" disabled="" ids="tglbeli" label="Tanggal Beli" types="text" name="tglbeli" placeholder="Tanggal Beli" formatdate="dd-mm-yyyy"/>
                <x-input_form disabled="" ids="namapembeli" label="Nama Pembeli" types="text" name="namapembeli" placeholder="Type Pembeli Sawah" />
                <x-input_mask typemask="harga" disabled="" ids="hargajual" label="Harga Jual (Rp)" types="text" name="hargajual" placeholder="Type Harga Jual Sawah" />
                <x-input_mask typemask="tanggal" wajib="" disabled="" ids="tgljual" label="Tanggal Jual" types="text" name="tgljual" placeholder="Tanggal Jual" formatdate="dd-mm-yyyy"/>
                <x-input_form disabled="" ids="nop" label="NOP" types="text" name="nop" placeholder="Type Nomor Objek Pajak" />
                <x-input_mask typemask="harga" disabled="" ids="nilaipajak" label="Nilai Pajak (Rp)" types="text" name="nilaipajak" placeholder="Type Nilai Pajak Sawah" />
                <x-file_form2 ids="img" label="Photo Sawah" name="img" :placeholder="$filename" capture=""/>
                <button type="button" wire:click="onRead"class="btn btn-success float-left">Back</button>
                <button type="submit" class="btn btn-primary float-right" wire:target="img" wire:loading.attr="disabled">Save</button>
            </form>
            </x-slot>
        </x-card_form>
    </div>
</div>