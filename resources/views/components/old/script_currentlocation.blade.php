<script>
Livewire.on('{{ $dispatchname }}', () => {
    //console.log('memanggil javascript');
    navigator.geolocation.getCurrentPosition(geo_getPosition, geo_errorCallback, geo_options);
});
</script>