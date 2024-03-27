@push('js')
<script>
Livewire.on('run_inputmask', () => {
    $(document).ready(function(){       
        if('{{$typemask}}'=='noppbb'){
            $('#{{ $ids }}').inputmask({'alias':'noppbb'});
        }
        if('{{$typemask}}'=='harga'){
            $('#{{ $ids }}').inputmask({'alias':'harga'});
        }
        if('{{$typemask}}'=='luas'){
            $('#{{ $ids }}').inputmask({'alias':'luas'});
        }
        if('{{$typemask}}'=='kwintal'){
            $('#{{ $ids }}').inputmask({'alias':'kwintal'});
        }
        if('{{$typemask}}'=='bata'){
            $('#{{ $ids }}').inputmask({'alias':'bata'});
        }
        if('{{$typemask}}'=='tanggal'){
            $('#{{ $ids }}').inputmask({'alias':'tanggal'});
            $('#{{ $ids }}').datepicker({
                    autoclose:true,
                    format:'dd/mm/yyyy',
                    orientation:'bottom',
                    highlight:true,
                    language:'id',
                    todayHighlight:true,
                    todayBtn:true,
                }).datepicker('update', '{{ $this->$name }}').on('changeDate', function(e) {
                    @this.set('{{ $name }}', this.value);
                });
        }
        if('{{$typemask}}'=='derajat'){
            $('#{{ $ids }}').inputmask({'alias':'derajat'});
        }
        if('{{$typemask}}'=='panjang'){
            $('#{{ $ids }}').inputmask({'alias':'panjang'});
        }
        if('{{$typemask}}'=='desimal'){
            $('#{{ $ids }}').inputmask({'alias':'desimal'});
        }
        if('{{$typemask}}'=='nomor'){
            $('#{{ $ids }}').inputmask({'alias':'nomor'});
        }
        if('{{$typemask}}'=='telp'){
            $('#{{ $ids }}').inputmask({'alias':'telp'});
        }
    });
});
</script>
@endpush
<div class="form-group" wire:ignore>
    <label for="{{ $ids }}" class="@if(!empty($wajib)) text-danger  @endif">{{ $label }}</label>
    @if($typemask == 'noppbb')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'noppbb'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'harga')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'harga'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'luas')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" type-inputmask="luas" data-inputmask="'alias':'luas'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'kwintal')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'kwintal'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'bata')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'bata'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'tanggal')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'tanggal'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
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
                }).datepicker('update', '{{ $this->$name }}').on('changeDate', function(e) {
                    @this.set('{{ $name }}', this.value);
                });
            });
        </script>
        @endpush
    @endif
    @if($typemask == 'derajat')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'derajat'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'panjang')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'panjang'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'desimal')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'desimal'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'nomor')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'nomor'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($typemask == 'telp')
    <input wire:ignore onkeyup="@this.set('{{ $name }}', this.value)" data-inputmask="'alias':'telp'"  @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif id="{{ $ids }}" type="{{ $types }}" wire:model.live="{{ $name }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
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