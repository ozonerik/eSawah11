<script>
Livewire.on('run_inputmask2', () => {
    $(document).ready(function(){
        document.querySelectorAll('input[type-mask="nik"]').forEach((nik) => {
            $(nik).inputmask({'alias':'nik'});
        });
        document.querySelectorAll('input[type-mask="noppbb"]').forEach((noppbb) => {
            $(noppbb).inputmask({'alias':'noppbb'});
        });
        document.querySelectorAll('input[type-mask="harga"]').forEach((harga) => {
            $(harga).inputmask({'alias':'harga'});
        });
        document.querySelectorAll('input[type-mask="luas"]').forEach((luas) => {
            $(luas).inputmask({'alias':'luas'});
        });
        document.querySelectorAll('input[type-mask="kwintal"]').forEach((kwintal) => {
            $(kwintal).inputmask({'alias':'kwintal'});
        });
        document.querySelectorAll('input[type-mask="bata"]').forEach((bata) => {
            $(bata).inputmask({'alias':'bata'});
        });
        document.querySelectorAll('input[type-mask="tanggal"]').forEach((tanggal) => {
            $(tanggal).inputmask({'alias':'tanggal'});
            $(tanggal).datepicker({
                    autoclose:true,
                    format:'dd/mm/yyyy',
                    orientation:'bottom',
                    highlight:true,
                    language:'id',
                    todayHighlight:true,
                    todayBtn:true,
                })
        });
        document.querySelectorAll('input[type-mask="derajat"]').forEach((derajat) => {
            $(derajat).inputmask({'alias':'derajat'});
        });
        document.querySelectorAll('input[type-mask="panjang"]').forEach((panjang) => {
            $(panjang).inputmask({'alias':'panjang'});
        });
        document.querySelectorAll('input[type-mask="desimal"]').forEach((desimal) => {
            $(desimal).inputmask({'alias':'desimal'});
        });
        document.querySelectorAll('input[type-mask="nomor"]').forEach((nomor) => {
            $(nomor).inputmask({'alias':'nomor'});
        });
        document.querySelectorAll('input[type-mask="telp"]').forEach((telp) => {
            $(telp).inputmask({'alias':'telp'});
        });
            
    });
});
</script>