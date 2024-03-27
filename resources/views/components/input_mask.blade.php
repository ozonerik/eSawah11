@push('js')
<script>
Livewire.on('run_inputmask2', () => {
    $(document).ready(function(){
        document.querySelectorAll('input[type-mask="noppbb"]').forEach((noppbb) => {
            $(noppbb).inputmask({'alias':'noppbb'});
        });
        document.querySelectorAll('input[type-mask="harga"]').forEach((harga) => {
            $(harga).inputmask({'alias':'harga'});
        });
        document.querySelectorAll('input[type-mask="luas"]').forEach((luas) => {
            $(luas).inputmask({'alias':'luas'});
        });
        document.querySelectorAll('input[type-mask="kwintal"]').forEach((kwintal) => {
            $(kwintal).inputmask({'alias':'kwintal'});
        });
        document.querySelectorAll('input[type-mask="bata"]').forEach((bata) => {
            $(bata).inputmask({'alias':'bata'});
        });
        document.querySelectorAll('input[type-mask="tanggal"]').forEach((tanggal) => {
            $(tanggal).inputmask({'alias':'tanggal'});
            $(tanggal).datepicker({
                    autoclose:true,
                    format:'dd/mm/yyyy',
                    orientation:'bottom',
                    highlight:true,
                    language:'id',
                    todayHighlight:true,
                    todayBtn:true,
                })
        });
        document.querySelectorAll('input[type-mask="derajat"]').forEach((derajat) => {
            $(derajat).inputmask({'alias':'derajat'});
        });
        document.querySelectorAll('input[type-mask="panjang"]').forEach((panjang) => {
            $(panjang).inputmask({'alias':'panjang'});
        });
        document.querySelectorAll('input[type-mask="desimal"]').forEach((desimal) => {
            $(desimal).inputmask({'alias':'desimal'});
        });
        document.querySelectorAll('input[type-mask="nomor"]').forEach((nomor) => {
            $(nomor).inputmask({'alias':'nomor'});
        });
        document.querySelectorAll('input[type-mask="telp"]').forEach((telp) => {
            $(telp).inputmask({'alias':'telp'});
        });
            
    });
});
</script>
@endpush
<div class="form-group" wire:ignore>
    <label for="{{ $ids }}" class="@if(!empty($wajib)) text-danger  @endif">{{ $label }}</label>
    @if($typemask == 'noppbb')
    <input type-mask="noppbb" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'noppbb'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'harga')
    <input type-mask="harga" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'harga'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'luas')
    <input type-mask="luas" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" type-inputmask="luas" data-inputmask="'alias':'luas'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'kwintal')
    <input type-mask="kwintal" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'kwintal'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'bata')
    <input type-mask="bata" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'bata'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'tanggal')
    <input type-mask="tanggal" onchange="@this.set('{{ $name }}', this.value)" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'tanggal'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
        @push('js')
        <script>
            $(document).ready(function(){
                $('#{{ $ids }}').datepicker({
                    autoclose:true,
                    format:'dd/mm/yyyy',
                    orientation:'bottom',
                    highlight:true,
                    language:'id',
                    todayHighlight:true,
                    todayBtn:true,
                });
            });
        </script>
        @endpush
    @endif
    @if($typemask == 'derajat')
    <input type-mask="derajat" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'derajat'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'panjang')
    <input type-mask="panjang" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'panjang'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'desimal')
    <input type-mask="desimal" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'desimal'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'nomor')
    <input type-mask="nomor" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'nomor'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'telp')
    <input type-mask="telp" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'telp'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'text')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'lokasi')
    <input wire:ignore onchange="@this.set('{{ $name }}', this.value)" @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif

    @if($errors->has( $name ))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>