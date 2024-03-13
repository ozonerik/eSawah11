@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/bindings/inputmask.binding.min.js" integrity="sha512-TGXLFBp6KE2kQHdH2lH1ysWKWKeuV013LpSktndHu9j3fT8tI7kqz4bWiOIIyFdn3Q65RcdrT/OkdL4LJPEGXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function(){
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
<div>
    <x-content_header name="Dashboard" >
        <li class="breadcrumb-item active">Dashboard</li>
    </x-content_header>
    <div class="row mx-1">
        <x-card_form name="Daftar Lanja" width="12" order="1" smallorder="1" closeto="onRead">
            <h1>Ini Dashboard</h1>
            <div class="mb-3">
                <label for="luas" class="form-label">Luas : </label>
                <input wire:model.live="luas" name="luas" type="text" class="form-control" id="luas">
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal : </label>
                <input wire:model.live="tanggal" name="tanggal" type="text" class="form-control" id="tanggal">
            </div>
            <div class="mb-3">
                <label for="result" class="form-label">Result : </label>
                <input wire:model="result" name="result" type="text" class="form-control" id="result">
            </div>
            <x-dropdown_select2 ids="user" label="User" name="user" :data="$user" values="id" showval="name"/>
            <x-dropdown_select2_multi ids="user_multi" label="User Multi" name="user_multi" :data="$user" values="id" showval="name"/>
        </x-card_form>
    </div>
</div>