@push('js')
<script>
document.addEventListener('livewire:initialized', () => {
    navigator.geolocation.getCurrentPosition(geo_getPosition, geo_errorCallback, geo_options);
    initAutocomplete();
})
</script>
<script>
function geo_getPosition(position) {
    let lt=position.coords.latitude;
    let lg=position.coords.longitude;
    let ac = position.coords.accuracy;
    @this.set('lt', lt);
    @this.set('lg', lg);
    if(ac >  90){
        toastr.warning("Location is not accurate ");
    }else{
        toastr.success("Location is accurate ");
    }
    showMaps(lt,lg,ac,'mymap','true','Your Location') 
}   
function geo_errorCallback(error){
    toastr.error("Geolocation is not supported by this browser. ");
};
function geo_options() {
    enableHighAccuracy: true;
    timeout: 10000;
};
async function initAutocomplete() {
    let input = document.getElementById('address');
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
            @this.set('lt', lt);
            @this.set('lg', lg);
            showMaps(lt,lg,ac,'tempatmap','true','Change Location')  
        }
    }); 
}
function showMaps($lat, $long, $ac, $iddiv, $dragable,$popup){
    $("#tempatMap").html("<div id='mymap'></div>");
    const container = document.getElementById('tempatMap')
    if(container) {
        let map_init=null;
        let marker,vlat,vlong,circle;
        
        map_init = L.map('mymap', {
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
            let position = marker.getLatLng();
            marker.setLatLng(position, {
            draggable: 'true'
            }).bindPopup(position.lat.toFixed(7)+","+position.lng.toFixed(7)).openPopup().update();
        });

        if($ac!==''){
            circle = L.circle([$lat, $long], { radius: $ac });
            let featureGroup = L.featureGroup([marker, circle]).addTo(map_init);
            map_init.fitBounds(featureGroup.getBounds());
        }

        map_init.on('measurefinish', function(hasil) {
            @this.set('area', hasil.area.toFixed(2));
        });
    }
    
}
function myFunction(){
    Livewire.dispatch('testEmit',{ data: 'coba aja' });
}
</script>
@endpush
<div>
    <x-content_header name="Dashboard" >
        <li class="breadcrumb-item active">Dashboard</li>
    </x-content_header>
    <div class="row mx-1">
        <x-card_form name="Daftar Lanja" width="12" order="1" smallorder="1" closeto="onRead">
            <h1>Ini Dashboard</h1>
            <button onclick="myFunction()">Click me</button>
            <div wire:ignore id="tempatMap"></div>
            lt= {{ $lt }}, lg= {{ $lg }}, area= {{ $area }}
            <x-input_mask typemask="text" disabled="false" ids="address" label="Address" types="text" name="address" placeholder="Type address" />
            <x-input_mask typemask="luas" disabled="false" ids="luas" label="Luas" types="text" name="luas" placeholder="Type Luas" />
            <x-input_mask typemask="tanggal" disabled="false" ids="tanggal" label="Tanggal" types="text" name="tanggal" placeholder="Type tanggal" />
            <x-input_mask typemask="text" disabled="true" ids="result" label="Result" types="text" name="result" placeholder="Type Result" />
            <x-dropdown_select2 ids="user" label="User" name="user" :data="$user" values="id" showval="name"/>
            <x-dropdown_select2_multi ids="user_multi" label="User Multi" name="user_multi" :data="$user" values="id" showval="name"/>
        </x-card_form>
    </div>
</div>