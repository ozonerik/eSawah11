<script>
function showMeasureMaps($emitname, $lat, $long, $ac, $iddiv, $dragable,$popup){
    const container = document.getElementById($iddiv)
    console.log([$emitname, $lat, $long, $ac, $iddiv, $dragable,$popup]);
    if(container) {
        var map_init=null;
        var marker,vlat,vlong,circle;
        map_init = L.map($iddiv, {
            center: [$lat, $long],
            zoom: 18,
            measureControl: true
        }); 
        //https://stackoverflow.com/questions/9394190/leaflet-map-api-with-google-satellite-layer
        googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
        maxZoom: 22,
        subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map_init);
        
        if (marker) {
            map_init.removeLayer(marker)
        }

        if($dragable!==''){
            marker = new L.marker([$lat, $long], {
                draggable: 'true'
            }).addTo(map_init).bindPopup($popup).openPopup();
        }else{
            marker = new L.marker([$lat, $long], {
            }).addTo(map_init).bindPopup($popup).openPopup();
        }
        
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
            draggable: 'true'
            }).bindPopup(position.lat.toFixed(7)+","+position.lng.toFixed(7)).openPopup().update();
            Livewire.dispatch($emitname, [{'lat': position.lat, 'long': position.lng}]);
        });

        if($ac!==''){
            circle = L.circle([$lat, $long], { radius: $ac });
            var featureGroup = L.featureGroup([marker, circle]).addTo(map_init);
            map_init.fitBounds(featureGroup.getBounds());
        }

        map_init.on('measurefinish', function(evt) {
            writeResults(evt);
        });
    }
    
}
function writeResults(results) {
    @this.set('luas', results.area.toFixed(2));
    @this.set('luasbata', ((results.area)/14).toFixed(2));
    @this.set('keliling', results.length.toFixed(2));
}
</script>