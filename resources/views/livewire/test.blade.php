@push('js')
<!-- InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/bindings/inputmask.binding.min.js" integrity="sha512-TGXLFBp6KE2kQHdH2lH1ysWKWKeuV013LpSktndHu9j3fT8tI7kqz4bWiOIIyFdn3Q65RcdrT/OkdL4LJPEGXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('livewire:init', () => {
    })
 
    document.addEventListener('livewire:initialized', () => {
      $('#luas').inputmask({
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
            let nilai=$('#luas}').val();
            @this.set('luas', nilai);
        });
        $('#bata').inputmask({
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
            let nilai=$('#bata}').val();
            @this.set('bata', nilai);
        });
    });
    Livewire.on('getID', () => {
      console.log(document.getElementById("bata"));
    });
</script>
@endpush
<div>
  <h1 class="text-center" >Testing Input Mask Mode Add</h1>
  <h2>Mode : {{ $mode }}</h2>
  @if($mode === 'read')
  Luas : <input type="text" wire:model.live="luas" class="form-control m-2" id="luas" placeholder="luas">
  @else
  Bata : <input type="text" wire:model.live="bata" class="form-control m-2" id="bata" placeholder="bata">
  @endif
  <button type="button" wire:click="changeMode( '{{ $mode === 'read' ? 'add' : 'read' }}' )" class="btn btn-primary">Ganti Mode</button>
  <button type="button" wire:click="$dispatch('getID')" class="btn btn-primary">Dispatch Tombol</button>
</div>