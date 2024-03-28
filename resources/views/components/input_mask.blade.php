<div class="form-group" wire:ignore>
    <label for="{{ $ids }}" class="@if(!empty($wajib)) text-danger  @endif">{{ $label }}</label>
    @if($typemask == 'nik')
    <input autocomplete="off" type-mask="nik" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'nik'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'noppbb')
    <input autocomplete="off" type-mask="noppbb" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'noppbb'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'harga')
    <input autocomplete="off" type-mask="harga" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'harga'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'luas')
    <input autocomplete="off" type-mask="luas" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" type-inputmask="luas" data-inputmask="'alias':'luas'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'kwintal')
    <input autocomplete="off" type-mask="kwintal" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'kwintal'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'bata')
    <input autocomplete="off" type-mask="bata" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'bata'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'tanggal')
    <input autocomplete="off" type-mask="tanggal" onchange="@this.set('{{ $name }}', this.value)" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'tanggal'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
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
    <input autocomplete="off" type-mask="derajat" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'derajat'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'panjang')
    <input autocomplete="off" type-mask="panjang" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'panjang'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'desimal')
    <input autocomplete="off" type-mask="desimal" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'desimal'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'nomor')
    <input autocomplete="off" type-mask="nomor" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'nomor'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'telp')
    <input autocomplete="off" type-mask="telp" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'telp'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'text')
    <input autocomplete="off" wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'lokasi')
    <input autocomplete="off" wire:ignore onchange="@this.set('{{ $name }}', this.value)" @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif

    @if($errors->has( $name ))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>