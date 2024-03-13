@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js" integrity="sha512-efAcjYoYT0sXxQRtxGY37CKYmqsFVOIwMApaEbrxJr4RwqVVGw8o+Lfh/+59TU07+suZn1BWq4fDl5fdgyCNkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/bindings/inputmask.binding.min.js" integrity="sha512-TGXLFBp6KE2kQHdH2lH1ysWKWKeuV013LpSktndHu9j3fT8tI7kqz4bWiOIIyFdn3Q65RcdrT/OkdL4LJPEGXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endpush
<div>
    <x-content_header name="Dashboard" >
        <li class="breadcrumb-item active">Dashboard</li>
    </x-content_header>
    <div class="row mx-1">
        <x-card_form name="Daftar Lanja" width="12" order="1" smallorder="1" closeto="onRead">
            <h1>Ini Dashboard</h1>
            <x-input_mask typemask="luas" disabled="false" ids="luas" label="Luas" types="text" name="luas" placeholder="Type Luas" />
            <x-input_mask typemask="tanggal" disabled="false" ids="tanggal" label="Tanggal" types="text" name="tanggal" placeholder="Type tanggal" />
            <x-input_mask typemask="text" disabled="true" ids="result" label="Result" types="text" name="result" placeholder="Type Result" />
            <x-dropdown_select2 ids="user" label="User" name="user" :data="$user" values="id" showval="name"/>
            <x-dropdown_select2_multi ids="user_multi" label="User Multi" name="user_multi" :data="$user" values="id" showval="name"/>
        </x-card_form>
    </div>
</div>