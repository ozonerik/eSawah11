<script>
window.addEventListener(@js($eventname), event => {
    function getPosition(position) {
        var lt=position.coords.latitude;
        var lg=position.coords.longitude;
        var ac = position.coords.accuracy;
        var mapname= @js($mapname)+'-'+event.detail.map_id;
        console.log(mapname);
        Livewire.dispatch(@js($emitname), [{'lat': lt, 'long': lg}]);
        showMeasureMaps(@js($emitname),lt,lg,ac,mapname,'true','Your Location') 
    }
    function errorCallback(error){
        alert('Geolocation is not supported by this browser.');
    };
    function options() {
        enableHighAccuracy: true;
        timeout: 10000;
    };
    navigator.geolocation.getCurrentPosition(getPosition, errorCallback, options);
})
</script>