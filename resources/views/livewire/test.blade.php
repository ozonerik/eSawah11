@push('js')
<!-- InputMask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/bindings/inputmask.binding.min.js" integrity="sha512-TGXLFBp6KE2kQHdH2lH1ysWKWKeuV013LpSktndHu9j3fT8tI7kqz4bWiOIIyFdn3Q65RcdrT/OkdL4LJPEGXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function(){
  $('#luas').inputmask("99-9999999");
});
</script>
@endpush
<div>
  <h1 class="text-center" >Testing Input Mask Mode Add</h1>
  <h2>Mode : {{ $mode }}</h2>
  @if($mode === 'read')
  Luas : <input type="text" wire:model.live="luas" data-inputmask="'alias': 'datetime'" class="form-control m-2" id="luas" placeholder="luas">
  @else
  Bata : <input type="text" wire:model.live="bata" class="form-control m-2" id="bata" placeholder="bata">
  @endif
  <button type="button" wire:click="$dispatch('post-created')" class="btn btn-primary">Dispatch</button>
  <button type="button" wire:click="changeMode( '{{ $mode === 'read' ? 'add' : 'read' }}' )" class="btn btn-primary">Ganti Mode</button>
</div>