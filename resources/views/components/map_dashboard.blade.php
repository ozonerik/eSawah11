<script>
    document.addEventListener('livewire:initialized', function () {
        $(document).ready(function(){
            function getPosition(position) {
                var lt=position.coords.latitude;
                var lg=position.coords.longitude;
                var ac = position.coords.accuracy;
                showMaps(lt,lg,ac,@js($mapname)+'-'+@js($mapid)) 
            }
            function errorCallback(error){
                alert('Geolocation is not supported by this browser.');
            };
            function options() {
                enableHighAccuracy: true;
                timeout: 10000;
            };
            navigator.geolocation.getCurrentPosition(getPosition, errorCallback, options);
        });
    })
</script>
<script>
    function showMaps($lat, $long, $ac, $iddiv){
        var map_init=null;
        var marker,vlat,vlong,circle;

        var redIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        var greenIcon = new L.Icon({
            iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        map_init = L.map($iddiv, {
            center: [$lat, $long],
            zoom: 18
        });

        //https://stackoverflow.com/questions/9394190/leaflet-map-api-with-google-satellite-layer
        googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map_init);

        marker = new L.marker([$lat, $long], {icon: redIcon
        }).addTo(map_init).bindPopup('Your Location').openPopup();

        circle = L.circle([$lat, $long], { radius: $ac });
        var featureGroup = L.featureGroup([marker, circle]).addTo(map_init);
        map_init.fitBounds(featureGroup.getBounds());

        const letaksawah = @js($data);
        letaksawah.forEach((letak) => {
            if(letak.latlang!==null){
                let kordinat =letak.latlang.split(",");
                marksawah = new L.marker(kordinat, {icon: greenIcon}).addTo(map_init).bindPopup(letak.namasawah);
            }
        });

    }
</script>