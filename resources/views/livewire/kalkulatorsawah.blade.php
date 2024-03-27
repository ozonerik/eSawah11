<x-card_section name="Kalkulator Sawah" type="primary" width="3" order="2" smallorder="2">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link @if($modecal=='htluas') active @endif" id="hitungluas-tab" wire:click="onHtluas" data-toggle="tab" data-target="#hitungluas" type="button" role="tab" aria-controls="hitungluas" aria-selected="true">Hitung Luas</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link @if($modecal=='htconv') active @endif" id="konversi-tab" wire:click="onCbata" data-toggle="tab" data-target="#konversi" type="button" role="tab" aria-controls="konversi" aria-selected="false">Konversi</button>
        </li>
    </ul>
    <div class="tab-content mt-2" id="myTabContent">
        <div class="tab-pane fade @if($modecal=='htluas') show active @endif" id="hitungluas" role="tabpanel" aria-labelledby="hitungluas-tab">
            <x-calc_sawah action="kalkulatorsawah"/>
        </div>
        <div class="tab-pane fade @if($modecal=='htconv') show active @endif" id="konversi" role="tabpanel" aria-labelledby="konversi-tab">
            <x-calc_konversi action="konversisawah"/>
        </div>
    </div>
</x-card-section> 