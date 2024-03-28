<script>
document.addEventListener('livewire:initialized', () => {
    $(document).ready(function(){
        document.querySelectorAll('select[type-select="select2"]').forEach((select2) => {
            $(select2).select2({
                theme: 'bootstrap4',
                placeholder: "Please Choose...",
                allowClear: 'true'
            })
        });     
    }); 
})

Livewire.on('run_select2', () => {
    $(document).ready(function(){
        document.querySelectorAll('select[type-select="select2"]').forEach((select2) => {
            $(select2).select2({
                theme: 'bootstrap4',
                placeholder: "Please Choose...",
                allowClear: 'true'
            })
        });    
    });
});
</script>