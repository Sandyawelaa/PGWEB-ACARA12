<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- leaflet css link  -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    />

    <title>Web-GIS with geoserver and leaflet</title>

    <style>
      body {
        margin: 0;
        padding: 0;
      }
      #map {
        width: 100%;
        height: 100vh;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
  </body>
</html>

<!-- leaflet js link  -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<!-- jquery link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- leaflet geoserver request link  -->
<script src="lib\L.Geoserver.js"></script>

<script>
  var map = L.map("map").setView([-7.693787957859059, 110.39823831570061], 12);

  var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  });

  osm.addTo(map);

  // wms request
  var wmsLayer1 = L.Geoserver.wms("http://localhost:8080/geoserver/wms", {
    layers: "pgweb_belinda:ADMINISTRASIDESA_AR_25K",
    transparent: true,
  });
  wmsLayer1.addTo(map);

  //https://geoportal.slemankab.go.id/geoserver/geonode/jalan_ln/ows
  var wmsLayer2 = L.Geoserver.wms("https://geoportal.slemankab.go.id/geoserver/wms", {
    layers: "geonode:jalan_ln",
    transparent: true,
  });
  wmsLayer2.addTo(map);

  var wmsLayer3 = L.Geoserver.wms("http://localhost:8080/geoserver/wms", {
    layers: "pgweb_belinda:jumlah_penduduk",
    transparent: true,
  });
  wmsLayer3.addTo(map);

  var layerLegend = L.Geoserver.legend("http://localhost:8080/geoserver/wms", {
    layers: "pgweb_belinda:ADMINISTRASIDESA_AR_25K",
    //style: stylefile,
  });
  layerLegend.addTo(map);

  var baseMaps = {
    "OpenSreetMap": osm
  };

  var overlayMaps = {
    "Batas Administrasi Desa": wmsLayer1,
    "Jalan": wmsLayer2,
    "Penduduk": wmsLayer3
  };
  var layerControl = L.control.layers(baseMaps, overlayMaps).addTo(map);
</script>