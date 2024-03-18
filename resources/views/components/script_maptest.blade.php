<script>
document.addEventListener('livewire:init', () => {
    Livewire.hook('element.init', ({ component, el }) => {
        navigator.geolocation.getCurrentPosition(geo_getPosition, geo_errorCallback, geo_options);
        initAutocomplete();
        Livewire.on('{{ $dispatchname }}', () => {
            navigator.geolocation.getCurrentPosition(geo_getPosition, geo_errorCallback, geo_options);
        });
    })
})
</script>
<script>
function geo_getPosition(position) {
    let lt=position.coords.latitude;
    let lg=position.coords.longitude;
    let ac = position.coords.accuracy;
    @this.set('{{ $lt }}', lt);
    @this.set('{{ $lg }}', lg);
    if(ac >  90){
        toastr.warning("Location is not accurate ");
    }else{
        toastr.success("Location is accurate ");
    }
    geo_alert('{{ $geoalertId }}',ac)
    showMaps(lt,lg,ac,'mymap','true','Your Location') 
}   
function geo_errorCallback(error){
    toastr.error("Geolocation is not supported by this browser. ");
    geo_alert('{{ $geoalertId }}',null)
    @this.set('{{ $ac }}', null);
};
function geo_options() {
    enableHighAccuracy: true;
    timeout: 10000;
};

function geo_alert(id,ac){
  let container = document.getElementById(id);
  if(ac > 90){
    $(container).html("<div class='alert alert-warning alert-dismissible fade show' role='alert'><strong>Location not Accurate</strong> Please reload your browser or clik Get My Location Button.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
  }else if( ac <= 90){
    $(container).html("<div class='alert alert-success alert-dismissible fade show' role='alert'><strong>Location is accurate</strong> The map is ready to use.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
  }else if( ac === null){
    $(container).html("<div class='alert alert-danger alert-dismissible fade show' role='alert'><strong>Error!!</strong> Geolocation is not supported by this browser.<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>");
  }
  
}
//autocomplete
async function initAutocomplete() {
    let input = document.getElementById('{{ $autoalamat }}');
    if(input){
        const options = {
            componentRestrictions: { country: "id" },
            fields: ["formatted_address", "geometry", "name"],
        };
        let autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function () {
            let place = autocomplete.getPlace();
            if(!place.geometry){
                let lokasi=document.getElementById('address').value;
            }else{
                let lt=place.geometry['location'].lat();
                let lg=place.geometry['location'].lng();
                let ac=90;
                @this.set('{{ $lt }}', lt);
                @this.set('{{ $lg }}', lg);
                showMaps(lt,lg,ac,'{{ $mapid }}','true','Change Location')  
            }
        });
    } 
}
function showMaps($lat, $long, $ac, $iddiv, $dragable,$popup){
    const container = document.getElementById('{{ $mapid }}')
    if(container) {
        $("#{{ $mapid }}").html("<div id='mymap'></div>");

        let map_init=null;
        let measureControl = null;
        let marker,vlat,vlong,circle;
        
        map_init = L.map('mymap', {
            center: [$lat, $long],
            zoom: 18,
        });
        measureControl = new L.Control.Measure({ 
            position: 'topright', 
            primaryLengthUnit: 'meters',
            secondaryLengthUnit: 'kilometers',
            primaryAreaUnit: 'sqmeters',
            secondaryAreaUnit: 'hectares'
        });
        measureControl.addTo(map_init);

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
            let position = marker.getLatLng();
            marker.setLatLng(position, {
            draggable: 'true'
            }).bindPopup(position.lat.toFixed(7)+","+position.lng.toFixed(7)).openPopup().update();
            @this.set('{{ $lt }}', position.lat.toFixed(7));
            @this.set('{{ $lg }}', position.lng.toFixed(7));
            Livewire.dispatch('{{ $eventDrag }}',{ data:{'lt':position.lat.toFixed(7), 'lg':position.lng.toFixed(7)}});
        });

        if($ac!==''){
            circle = L.circle([$lat, $long], { radius: $ac });
            let featureGroup = L.featureGroup([marker, circle]).addTo(map_init);
            map_init.fitBounds(featureGroup.getBounds());
        }

        map_init.on('measurefinish', function(hasil) {
            let ls=hasil.area.toFixed(2);
            let kl=hasil.length.toFixed(2);
            Livewire.dispatch('{{ $eventMeasure }}',{ data:{'ls':ls, 'kl':kl}});
            @this.set('{{ $area }}', ls);
            @this.set('{{ $length }}', kl);
        });
    }
}
</script>