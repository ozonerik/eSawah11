@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/bindings/inputmask.binding.min.js" integrity="sha512-TGXLFBp6KE2kQHdH2lH1ysWKWKeuV013LpSktndHu9j3fT8tI7kqz4bWiOIIyFdn3Q65RcdrT/OkdL4LJPEGXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function(){
    $("#luas").inputmask({
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
            let nilai=$('#luas').val();
            @this.set('luas', nilai);
        });
    $("#tanggal").inputmask({
        'alias': 'datetime', 
        'inputFormat':'dd/mm/yyyy', 
        'rightAlign': false
    }).on('keyup', function(e) {
            let nilai=$('#tanggal').val();
            @this.set('tanggal', nilai);
        });
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.id.min.js" integrity="sha512-5dCXH+uVhgMJkIOoV1tEejq2voWTEqqh2Q2+Caz6//+6i9dLpfyDmAzKcdbogrXjPLanlDO5pTsBDKzmaJcWFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function(){ 
    $('#tanggal').datepicker({
        autoclose:true,
        format:'dd/mm/yyyy',
        highlight:true,
        language:"id",
        todayBtn: true,
        todayHighlight: true
    });
});
</script>
@endpush
<div>
    <div class="mb-3">
        <label for="luas" class="form-label">Luas : </label>
        <input wire:ignore wire:model="luas" type="text" name="luas" class="form-control" id="luas">
    </div>
    <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal : </label>
        <input wire:ignore wire:model="tanggal" type="text" name="tanggal" class="form-control" id="tanggal">
    </div>
    <div class="mb-3">
        <label for="result" class="form-label">Result : </label>
        <input wire:ignore wire:model="result" type="text" name="result" class="form-control" id="result">
    </div>
</div>
