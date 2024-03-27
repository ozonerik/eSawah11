@push('js')
<x-script_map eventCurrent="getCurrentLoc" eventPlace="changePlace" dispatchname="getLokasiSaatini" geoalertId="alert" eventDrag="getDragData" eventMeasure="getMeasureData" ac="ac" lt="lt" lg="lg" autoalamat="lokasi" mapid="gismap" area="mluas" length="mkel" />
@endpush
<div>
    <x-content_header name="GIS" >
        <li class="breadcrumb-item active">Sawah</li>
        <li class="breadcrumb-item active">GIS</li>
    </x-content_header>
    <div class="row mx-1">
        @if($mode=='read')
        <x-card_section2 name="GIS - Sawah" type="primary" width="12" order="1" smallorder="1">
            <form wire:submit.prevent="onHitung">
                <div wire:ignore id="alert"></div>
                <div wire:ignore id="gismap" style="height:500px" class="w-100 rounded bg-blank"></div>
                <x-input_mask typemask="lokasi" wajib="" disabled="" ids="lokasi" label="Lokasi" types="text" name="lokasi" placeholder="Get Lokasi" />
                <x-inputlokasi_form action="onCurrentlokasi" labelbtn="Get My Location" wajib="" disabled="" ids="latlang" label="Koordinat" types="text" name="latlang" placeholder="Get Koordinat" />
                <x-input_mask typemask="luas" wajib="" disabled="" ids="luas" label="Luas (m2)" types="text" name="luas" placeholder="Get Luas (m2)" />
                <x-input_mask typemask="bata" wajib="" disabled="" ids="luasbata" label="Luas (bata)" types="text" name="luasbata" placeholder="Get Luas (bata)" />
                <x-input_mask typemask="panjang" wajib="" disabled="" ids="keliling" label="Keliling (m)" types="text" name="keliling" placeholder="Get Keliling (m)" />
                <x-input_mask typemask="harga" wajib="true" ids="hgpadi" label="Harga 1kw Gabah Kering (Rp)" types="text" name="hgpadi" placeholder="Enter Harga 1kw Gabah Kering" disabled="false"/>
                <x-input_mask typemask="kwintal" wajib="true" ids="lanja" label="Lanja/100 bata (kw)" types="text" name="lanja" placeholder="Enter Kwintal Lanja" disabled="false"/>
                <x-input_mask typemask="harga" wajib="true" disabled="false" ids="hargabata" label="Harga Sawah Per Bata (Rp)" types="text" name="hargabata" placeholder="Harga Per Bata Sawah (Rp)" />
                <x-input_mask typemask="kwintal" ids="lanjakw" label="Nilai Lanja/Thn (kw)" types="text" name="lanjakw" placeholder="Nilai Lanja (kw)" disabled="true"/>
                <x-input_mask typemask="harga" ids="lanjarp" label="Nilai Lanja/Thn (Rp)" types="text" name="lanjarp" placeholder="Nilai Lanja (Rp)" disabled="true"/>
                <x-input_mask typemask="harga" ids="hargatanah" label="Harga Jual/Beli Tanah (Rp)" types="text" name="hargatanah" placeholder="Harga Jual/Beli Tanah (Rp)" disabled="true"/>
                <button wire:click="onReset" type="button" class="btn btn-success float-left">Reset</button>
                <button type="submit" class="btn btn-primary float-right">Hitung</button>
            </form>
        </x-card-section2>
        @endif
    </div>
</div>