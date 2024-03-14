<script>
document.addEventListener('livewire:initialized', () => {
        Livewire.dispatch('onGetAdress');
})
</script>
<script>
document.addEventListener(@js($eventname), event => {
    initAutocomplete();
    var ac=90;
    var lt=event.detail.lt;
    var lg=event.detail.lg;
    var map_id=event.detail.map_id;
    var kordinat=event.detail.kordinat;
    var mapname=@js($mapname)+'-'+map_id;
    if (!(lt === undefined || lg === undefined || lt === 0 || lg === 0)){
        let nilai = [@js($emitname),lt,lg,ac,mapname,'true',kordinat]
        showMeasureMaps(@js($emitname),lt,lg,ac,mapname,'true',kordinat);
    }else{
        let nilai = [@js($emitname),lt,lg,ac,mapname,'true',kordinat]
        showMeasureMaps(@js($emitname),lt,lg,ac,'nomap'+'-'+map_id,'true','NoMap');
    }
});

async function initAutocomplete() {
        var input = document.getElementById(@js($inputname));
        const options = {
            componentRestrictions: { country: "id" },
            fields: ["formatted_address", "geometry", "name"],
        };
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            if(!place.geometry){
                var lokasi=document.getElementById(@js($inputname)).value;
                Livewire.dispatch(@js($emitname), [{'lat': 0, 'long': 0, 'lokasi':lokasi}]);
            }else{
                var lt=place.geometry['location'].lat();
                var lg=place.geometry['location'].lng();
                var lokasi=document.getElementById(@js($inputname)).value;
                var ac=90;
                Livewire.dispatch(@js($emitname), [{'lat': lt, 'long': lg, 'lokasi':lokasi}]);
            }
        }); 
}
</script>