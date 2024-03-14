<script>
window.addEventListener(@js($eventname), event => {
    function getPosition(position) {
        var lt=position.coords.latitude;
        var lg=position.coords.longitude;
        var ac = position.coords.accuracy;
        if(ac >  90){
            toastr.warning("Location is not accurate ");
        }else{
            toastr.success("Location is accurate ");
        }
        var mapname= @js($mapname)+'-'+event.detail.map_id;
        Livewire.dispatch(@js($emitname), [{'lat': lt, 'long': lg}]);
        showMeasureMaps(@js($emitname),lt,lg,ac,mapname,'true','Your Location') 
    }
    function errorCallback(error){
        toastr.error("Geolocation is not supported by this browser. ");
    };
    function options() {
        enableHighAccuracy: true;
        timeout: 10000;
    };
    navigator.geolocation.getCurrentPosition(getPosition, errorCallback, options);
})
</script>