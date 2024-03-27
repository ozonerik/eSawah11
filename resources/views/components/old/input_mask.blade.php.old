@push('js')
<script>
document.addEventListener('livewire:init', () => {
    Livewire.hook('element.init', ({ component, el }) => {
        let container=document.getElementById('{{ $ids }}');
        console.log('{{ $ids }}');
        if(container){
            if('{{$typemask}}' === 'luas'){
            $(container).inputmask({
                'autoUnmask': true, 
                'suffix': ' m2',
                'alias': 'decimal',
                'onBeforeMask': function (value) {
                    value=0;
                    return value;
                }, 
                'radixPoint':',', 
                'groupSeparator': '.', 
                'autoGroup': true, 
                'digits': 2, 
                'digitsOptional': false, 
                'rightAlign': false 
            }).on('keyup', function(e) {
                let nilai=$(container).val();
                @this.set('{{ $name }}', nilai);
            });
            }else if('{{$typemask}}' === 'bata'){
                $(container).inputmask({
                    'autoUnmask': true, 
                    'suffix': ' bata',
                    'alias': 'decimal',
                    'onBeforeMask': function (value) {
                        value=0;
                        return value;
                    }, 
                    'radixPoint':',', 
                    'groupSeparator': '.', 
                    'autoGroup': true, 
                    'digits': 2, 
                    'digitsOptional': false, 
                    'rightAlign': false 
                }).on('keyup', function(e) {
                    let nilai=$(container).val();
                    @this.set('{{ $name }}', nilai);
                });
            }else if('{{$typemask}}' === 'kwintal'){
                $(container).inputmask({
                    'autoUnmask': true, 
                    'suffix': ' kw',
                    'alias': 'decimal', 
                    'onBeforeMask': function (value) {
                        value=0;
                        return value;
                    },
                    'radixPoint':',', 
                    'groupSeparator': '.', 
                    'autoGroup': true, 
                    'digits': 2, 
                    'digitsOptional': false, 
                    'rightAlign': false 
                }).on('keyup', function(e) {
                    let nilai=$(container).val();
                    @this.set('{{ $name }}', nilai);
                });
            }else if('{{$typemask}}' === 'derajat'){
                $(container).inputmask({
                    'autoUnmask': true, 
                    'suffix': ' °',
                    'alias': 'decimal', 
                    'onBeforeMask': function (value) {
                        value=0;
                        return value;
                    },
                    'radixPoint':',', 
                    'groupSeparator': '.', 
                    'autoGroup': true, 
                    'digits': 2, 
                    'digitsOptional': false, 
                    'rightAlign': false 
                }).on('keyup', function(e) {
                    let nilai=$(container).val();
                    @this.set('{{ $name }}', nilai);
                });
            }else if('{{$typemask}}' === 'panjang'){
                $(container).inputmask({
                    'autoUnmask': true, 
                    'suffix': ' m',
                    'alias': 'decimal', 
                    'onBeforeMask': function (value) {
                        value=0;
                        return value;
                    },
                    'radixPoint':',', 
                    'groupSeparator': '.', 
                    'autoGroup': true, 
                    'digits': 2, 
                    'digitsOptional': false, 
                    'rightAlign': false 
                }).on('keyup', function(e) {
                    let nilai=$(container).val();
                    @this.set('{{ $name }}', nilai);
                });
            }else if('{{$typemask}}' === 'harga'){
                $(container).inputmask({
                    'autoUnmask': true, 
                    'prefix': 'Rp ',
                    'alias': 'decimal', 
                    'onBeforeMask': function (value) {
                        value=0;
                        return value;
                    },
                    'shortcuts':{'r': '1000', 'j': '1000000','m':'1000000000','t':'1000000000000'},
                    'radixPoint':',', 
                    'groupSeparator': '.', 
                    'autoGroup': true, 
                    'digits': 0, 
                    'digitsOptional': false, 
                    'rightAlign': false 
                }).on('keyup', function(e) {
                    let nilai=$(container).val();
                    @this.set('{{ $name }}', nilai);
                });
            }else if('{{$typemask}}' === 'desimal'){
                $(container).inputmask({
                    'autoUnmask': true, 
                    'alias': 'decimal', 
                    'onBeforeMask': function (value) {
                        value=0;
                        return value;
                    },
                    'radixPoint':',', 
                    'groupSeparator': '.', 
                    'autoGroup': true, 
                    'digits': 2, 
                    'digitsOptional': false, 
                    'rightAlign': false 
                }).on('keyup', function(e) {
                    let nilai=$(container).val();
                    @this.set('{{ $name }}', nilai);
                });
            }else if('{{$typemask}}' === 'telp'){
                $(container).inputmask({
                    'autoUnmask': true, 
                    'mask': ['9999-9999-999[9][9][9]'],
                    'onBeforeMask': function (value) {
                        value=0;
                        return value;
                    },
                    'rightAlign': false 
                }).on('keyup', function(e) {
                    let nilai=$(container).val();
                    @this.set('{{ $name }}', nilai);
                });
            }else if('{{$typemask}}' === 'tanggal'){
                $(container).datepicker({
                    autoclose:true,
                    format:'dd/mm/yyyy',
                    orientation:'bottom',
                    highlight:true,
                    language:'id',
                    todayHighlight:true,
                    todayBtn:true,
                }).on('changeDate', function(e) {
                    let nilai=$(container).val();
                    @this.set('{{ $name }}', nilai);
                });
                $(container).inputmask({
                    'alias': 'datetime', 
                    'inputFormat': 'dd/mm/yyyy',
                    'rightAlign': false ,
                    'onBeforeMask': function (value) {
                        let date = new Date().toLocaleDateString("id-ID");
                        value=date;
                        return value;
                    },
                }).on('keyup', function(e) {
                    let nilai=$(container).val();
                    @this.set('{{ $name }}', nilai);
                });
            }
        }  
    })
})
</script>
@endpush
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