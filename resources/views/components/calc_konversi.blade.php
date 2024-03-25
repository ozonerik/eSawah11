<div>
    <form wire:submit.prevent="{{$action}}">
        <x-input_mask typemask="luas" ids="cluas" label="Luas Tanah (m2)" types="text" name="cluas" placeholder="Enter Luas Tanah (m)..." disabled="false"/>
        <x-input_mask typemask="bata" ids="cbata" label="Luas Tanah (bata)" types="text" name="cbata" placeholder="Enter Luas Tanah (bata)..." disabled="false"/>
        <x-input_mask typemask="harga" ids="conhgpadi" label="Harga 1kw Gabah Kering (Rp)" types="text" name="conhgpadi" placeholder="Enter Harga 1kw Gabah Kering" disabled="false"/>
        <x-input_mask typemask="kwintal" ids="conlanja" label="Lanja/100 bata (kw)" types="text" name="conlanja" placeholder="Enter Kwintal Lanja" disabled="false"/>
        <x-input_mask typemask="harga" disabled="false" ids="chargabata" label="Harga Tanah Per Bata (Rp)" types="text" name="chargabata" placeholder="Harga Per Bata Sawah (Rp)" />
        <x-input_mask typemask="kwintal" ids="clanjakw" label="Nilai Lanja/Thn (kw)" types="text" name="clanjakw" placeholder="Nilai Lanja (kw)" disabled="true"/>
        <x-input_mask typemask="harga" ids="clanjarp" label="Nilai Lanja/Thn (Rp)" types="text" name="clanjarp" placeholder="Nilai Lanja (Rp)" disabled="true"/>
        <x-input_mask typemask="harga" ids="chargatanah" label="Harga Jual/Beli Tanah (Rp)" types="text" name="chargatanah" placeholder="Harga Jual/Beli Tanah (Rp)" disabled="true"/>
        <div class="form-group">
            <button type="button" wire:click="resetKonversi" class="btn btn-success float-left">Reset</button>
            <button type="submit" class="btn btn-primary float-right">Hitung</button>
        </div>
    </form>
</div>