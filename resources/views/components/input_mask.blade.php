@if($typemask == 'luas')
    @push('js')
    <script>
        $(document).ready(function(){
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
        });
    </script>
    @endpush
@elseif($typemask == 'bata')
    @push('js')
    <script>
        $(document).ready(function(){
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
        });
    </script>
    @endpush
@elseif($typemask == 'kwintal')
    @push('js')
    <script>
        $(document).ready(function(){
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
        });
    </script>
    @endpush
@elseif($typemask == 'panjang')
    @push('js')
    <script>
        $(document).ready(function(){
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
        });
    </script>
    @endpush
@elseif($typemask == 'harga')
    @push('js')
    <script>
        $(document).ready(function(){
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
        });
    </script>
    @endpush
@elseif($typemask == 'desimal')
    @push('js')
    <script>
        $(document).ready(function(){
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
        });
    </script>
    @endpush
@elseif($typemask == 'telp')
    @push('js')
    <script>
        $(document).ready(function(){
            $('#{{ $ids }}').inputmask({
                'autoUnmask': true, 
                'mask': ['9999-9999-999[9][9][9]'],
                'rightAlign': false 
            }).on('keyup', function(e) {
                let nilai=$('#{{ $ids }}').val();
                @this.set('{{ $name }}', nilai);
            });
        });
    </script>
    @endpush
@elseif($typemask == 'tanggal')
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
        });
    </script>
    @endpush
@endif

@push('js')
<script>
    $(document).ready(function(){
        $('#tanggal').datepicker({
            autoclose:true,
            format:'dd/mm/yyyy',
            orientation:'bottom',
            highlight:true,
            language:'id',
            todayHighlight:true,
            todayBtn:true,
        }).on('changeDate', function(e) {
            let nilai=$('#tanggal').val();
            @this.set('tanggal', nilai);
        });
        $('#luas').inputmask({
            'autoUnmask': true, 
            'suffix': ' m2','alias': 
            'decimal', 'radixPoint':',', 
            'groupSeparator': '.', 
            'autoGroup': true, 
            'digits': 2, 
            'digitsOptional': false, 
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#luas').val();
            @this.set('luas', nilai);
        });
        $('#tanggal').inputmask({
            'alias': 'datetime', 
            'inputFormat': 'dd/mm/yyyy',
            'rightAlign': false 
        }).on('keyup', function(e) {
            let nilai=$('#tanggal').val();
            @this.set('tanggal', nilai);
        });
    });
</script>
@endpush
<div class="form-group">
    <label for="{{ $ids }}" class="form-label @if(!empty($wajib)) text-danger  @endif">{{ $label }}</label>
    <input wire:model.live="{{ $name }}" name="{{ $name }}" id="{{ $ids }}" @if(!empty($wajib)) requiered @endif @if($disabled=="true") disabled @endif type="{{ $types }}" class="form-control @if($errors->has( $name )) is-invalid @endif"  placeholder="{{ $placeholder }}" >
    @if($errors->has( $name ))
        <span class="invalid-feedback" role="alert">
            {{ $errors->first($name) }}
        </span>
    @endif
</div>