<script>
document.addEventListener('livewire:initialized', () => {
    if('{{$typemask}}' === 'luas'){
        $('#{{ $ids }}').inputmask({
            'autoUnmask': true, 
            'suffix': ' m2',
            'alias': 'decimal', 
            'radixPoint':',', 
            'groupSeparator': '.', 
            'autoGroup': true, 
            'digits': 2, 
            'digitsOptional': false, 
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#{{ $ids }}').val();
            @this.set('{{ $name }}', nilai);
        });
    }else if('{{$typemask}}' === 'bata'){
        $('#{{ $ids }}').inputmask({
            'autoUnmask': true, 
            'suffix': ' bata',
            'alias': 'decimal', 
            'radixPoint':',', 
            'groupSeparator': '.', 
            'autoGroup': true, 
            'digits': 2, 
            'digitsOptional': false, 
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#{{ $ids }}').val();
            @this.set('{{ $name }}', nilai);
        });
    }else if('{{$typemask}}' === 'kwintal'){
        $('#{{ $ids }}').inputmask({
            'autoUnmask': true, 
            'suffix': ' kw',
            'alias': 'decimal', 
            'radixPoint':',', 
            'groupSeparator': '.', 
            'autoGroup': true, 
            'digits': 2, 
            'digitsOptional': false, 
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#{{ $ids }}').val();
            @this.set('{{ $name }}', nilai);
        });
    }else if('{{$typemask}}' === 'derajat'){
        $('#{{ $ids }}').inputmask({
            'autoUnmask': true, 
            'suffix': ' °',
            'alias': 'decimal', 
            'radixPoint':',', 
            'groupSeparator': '.', 
            'autoGroup': true, 
            'digits': 2, 
            'digitsOptional': false, 
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#{{ $ids }}').val();
            @this.set('{{ $name }}', nilai);
        });
    }else if('{{$typemask}}' === 'panjang'){
        $('#{{ $ids }}').inputmask({
            'autoUnmask': true, 
            'suffix': ' m',
            'alias': 'decimal', 
            'radixPoint':',', 
            'groupSeparator': '.', 
            'autoGroup': true, 
            'digits': 2, 
            'digitsOptional': false, 
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#{{ $ids }}').val();
            @this.set('{{ $name }}', nilai);
        });
    }else if('{{$typemask}}' === 'harga'){
        $('#{{ $ids }}').inputmask({
            'autoUnmask': true, 
            'prefix': 'Rp ',
            'alias': 'decimal', 
            'shortcuts':{'r': '1000', 'j': '1000000','m':'1000000000','t':'1000000000000'},
            'radixPoint':',', 
            'groupSeparator': '.', 
            'autoGroup': true, 
            'digits': 0, 
            'digitsOptional': false, 
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#{{ $ids }}').val();
            @this.set('{{ $name }}', nilai);
        });
    }else if('{{$typemask}}' === 'desimal'){
        $('#{{ $ids }}').inputmask({
            'autoUnmask': true, 
            'alias': 'decimal', 
            'radixPoint':',', 
            'groupSeparator': '.', 
            'autoGroup': true, 
            'digits': 2, 
            'digitsOptional': false, 
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#{{ $ids }}').val();
            @this.set('{{ $name }}', nilai);
        });
    }else if('{{$typemask}}' === 'telp'){
        $('#{{ $ids }}').inputmask({
            'autoUnmask': true, 
            'mask': ['9999-9999-999[9][9][9]'],
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#{{ $ids }}').val();
            @this.set('{{ $name }}', nilai);
        });
    }else if('{{$typemask}}' === 'tanggal'){
        $('#{{ $ids }}').datepicker({
            autoclose:true,
            format:'dd/mm/yyyy',
            orientation:'bottom',
            highlight:true,
            language:'id',
            todayHighlight:true,
            todayBtn:true,
        }).on('changeDate', function(e) {
            let nilai=$('#{{ $ids }}').val();
            @this.set('{{ $name }}', nilai);
        });
        $('#{{ $ids }}').inputmask({
            'alias': 'datetime', 
            'inputFormat': 'dd/mm/yyyy',
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#{{ $ids }}').val();
            @this.set('{{ $name }}', nilai);
        });
    }

})
</script>
<div class="form-group">
    <label for="{{ $ids }}" class="form-label @if(!empty($wajib)) text-danger  @endif">{{ $label }}</label>
    @if($typemask == 'notlive')
    <input wire:ignore wire:model="{{ $name }}" name="{{ $name }}" id="{{ $ids }}" @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif type="{{ $types }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @else
    <input wire:model.live="{{ $name }}" name="{{ $name }}" id="{{ $ids }}" @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif type="{{ $types }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @endif
    @if($errors->has( $name ))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>