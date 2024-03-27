<div>
    <form wire:submit="{{$action}}">
        <img alt="images" src="{{ asset('img/sawah.jpg') }}" class="rounded mx-auto d-block w-75" /> 
        <x-input_mask typemask="panjang" ids="p1" label="P1 (m)" types="text" name="p1" placeholder="Enter P1" disabled="false"/>
        <x-input_mask typemask="panjang" ids="l1" label="L1 (m)" types="text" name="l1" placeholder="Enter L1" disabled="false"/>
        <x-input_mask typemask="panjang" ids="p2" label="P2 (m)" types="text" name="p2" placeholder="Enter P2" disabled="false"/>
        <x-input_mask typemask="panjang" ids="l2" label="L2 (m)" types="text" name="l2" placeholder="Enter L2" disabled="false"/>
        <x-input_mask typemask="derajat" ids="la" label="LA (deg)" types="text" name="la" placeholder="Enter LA" disabled="false"/>
        <x-input_mask typemask="panjang" ids="m" label="M (m)" types="text" name="m" placeholder="Enter M" disabled="false"/>
        <x-input_mask typemask="harga" ids="hgpadi" label="Harga 1kw Gabah Kering (Rp)" types="text" name="hgpadi" placeholder="Enter Harga 1kw Gabah Kering" disabled="false"/>
        <x-input_mask typemask="kwintal" ids="lanja" label="Lanja/100 bata (kw)" types="text" name="lanja" placeholder="Enter Kwintal Lanja" disabled="false"/>
        <x-input_mask typemask="harga" disabled="false" ids="shargabata" label="Harga Tanah Per Bata (Rp)" types="text" name="shargabata" placeholder="Harga Per Bata Sawah (Rp)" />
        <x-input_mask typemask="luas" ids="ls1" label="Luas(umum) (m2) " types="text" name="ls1" placeholder="Luas...." disabled="true"/>
        <x-input_mask typemask="bata" ids="ls3" label="Luas(umum) (bata)" types="text" name="ls3" placeholder="Luas...." disabled="true"/>
        <x-input_mask typemask="luas" ids="ls2" label="Luas(rumus) (m2)" types="text" name="ls2" placeholder="Luas...." disabled="true"/>
        <x-input_mask typemask="bata" ids="ls4" label="Luas(rumus) (bata)" types="text" name="ls4" placeholder="Luas...." disabled="true"/>
        <x-input_mask typemask="kwintal" ids="lanjakw" label="Nilai Lanja/Thn (kw)" types="text" name="lanjakw" placeholder="Nilai Lanja (kw)" disabled="true"/>
        <x-input_mask typemask="harga" ids="lanjarp" label="Nilai Lanja/Thn (Rp)" types="text" name="lanjarp" placeholder="Nilai Lanja (Rp)" disabled="true"/>
        <x-input_mask typemask="harga" ids="shargatanah" label="Harga Jual/Beli Tanah (Rp)" types="text" name="shargatanah" placeholder="Harga Jual/Beli Tanah (Rp)" disabled="true"/>
        <div class="form-group">
            <button type="button" wire:click="resetKalkulator" class="btn btn-success float-left">Reset</button>
            <button type="submit" class="btn btn-primary float-right">Hitung</button>
        </div>
    </form>
</div>