@push('css')
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin=""/>
  <link rel="stylesheet" href="https://ljagis.github.io/leaflet-measure/leaflet-measure.css">
  <style>
    #map {
      height: 500px;
      margin: 20px 20px 0 0;
    }
  </style>
@endpush
<div>
  <h1>leaflet-measure</h1>
  <p class="github"><a href="//github.com/ljagis/leaflet-measure">github.com/ljagis/leaflet-measure</a></p>
  <div id="map"></div>
  <h2><code>measurefinish</code> event data:</h2>
  <pre id="eventoutput">...</pre>
</div>
@push('js')
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
  <script src="https://ljagis.github.io/leaflet-measure/leaflet-measure.js"></script>
  <script>
    (function(L, document) {
      var map = L.map('map', {
        center: [29.749817, -95.080757],
        zoom: 16,
        measureControl: true
      });
      L.tileLayer('//server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        minZoom: 14,
        maxZoom: 18,
        attribution: '&copy; Esri &mdash; Sources: Esri, DigitalGlobe, Earthstar Geographics, CNES/Airbus DS, GeoEye, USDA FSA, USGS, Getmapping, Aerogrid, IGN, IGP, swisstopo, and the GIS User Community'
      }).addTo(map);

      map.on('measurefinish', function(evt) {
        writeResults(evt);
      });

      function writeResults(results) {
        document.getElementById('eventoutput').innerHTML = JSON.stringify(
          {
            area: results.area,
            areaDisplay: results.areaDisplay,
            lastCoord: results.lastCoord,
            length: results.length,
            lengthDisplay: results.lengthDisplay,
            pointCount: results.pointCount,
            points: results.points
          },
          null,
          2
        );
      }
    })(window.L, window.document);
  </script>
@endpush