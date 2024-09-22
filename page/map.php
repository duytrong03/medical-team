<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bản đồ</title>
    <link rel="stylesheet" href="../map/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../map/leaflet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@v0.74.0/dist/L.Control.Locate.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
</head>
<body>
    <?php define('__ROOT__', dirname(dirname(__FILE__))); require_once(__ROOT__ . '/component/navbar.php'); ?>
    <div id="map" style="height: 600px;">
        <div class="leaflet-control coordinate"></div>
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.locatecontrol@0.74.0/dist/L.Control.Locate.min.js" charset="utf-8"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6.5.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-search/dist/leaflet-search.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-search/dist/leaflet-search.min.css" />
    
    <script src="../map/yTeHaNoi.php"></script> <!-- Include the PHP-generated JavaScript -->
    
    <script>
        var map = L.map('map').setView([21.0285, 105.8542], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add markers for Hoang Sa and Truong Sa Islands
        var hoangSaMarker = L.marker([16.5, 112], {
            draggable: true,
            title: "Quần đảo Hoàng Sa, Việt Nam",
            opacity: 0.5
        }).addTo(map)
          .bindPopup("<h1>Quần đảo Hoàng Sa</h1><p>Đây là quần đảo Hoàng Sa của Việt Nam.</p> <img src='../map/HSA.jpg'/>");

        var truongSaMarker = L.marker([9.5, 115], {
            draggable: true,
            title: "Quần đảo Trường Sa, Việt Nam",
            opacity: 0.5
        }).addTo(map)
          .bindPopup("<b>Quần đảo Trường Sa</b><br>Đây là quần đảo Trường Sa của Việt Nam. <img src='../map/HSA.jpg'/>");

        // Additional map layers
        var watercolorMap = L.tileLayer('https://tiles.stadiamaps.com/tiles/stamen_watercolor/{z}/{x}/{y}.{ext}', {
            minZoom: 1,
            maxZoom: 16,
            attribution: '&copy; <a href="https://www.stadiamaps.com/" target="_blank">Stadia Maps</a> &copy; <a href="https://www.stamen.com/" target="_blank">Stamen Design</a> &copy; <a href="https://openmaptiles.org/" target="_blank">OpenMapTiles</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            ext: 'jpg'
        });

        var esriMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
        });

        var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        var googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });

        // Base maps
        var baseMaps = {
            "Google Streets": googleStreets,
            "Watercolor Map": watercolorMap,
            "Esri Map": esriMap,
            "Google Hybrid Map": googleHybrid
        };

        var layerControl = L.control.layers(baseMaps).addTo(map);

        map.on('mouseover', function(e) {
            console.log('Lat: ' + e.latlng.lat, 'lng: ' + e.latlng.lng);
        });

        // Add locate control
        L.control.locate().addTo(map);

        // Add search control
        var searchControl = new L.Control.Search({
            position: 'topright',
            layer: L.geoJSON(yteJson),
            propertyName: 'name',
            marker: false,
            moveToLocation: function(latlng, title, map) {
                map.setView(latlng, 16);
            }
        });

        searchControl.addTo(map);

        // Add markers for hospital locations
        yteJson.features.forEach(function(feature) {
            var name = feature.properties.name;
            var introduction = feature.properties.introduction;
            var address = feature.properties.address;
            var phone = feature.properties.phone;
            var image = feature.properties.image;
            var coordinates = feature.geometry.coordinates;

            var popupContent = `
                <div>
                    <a href="http://localhost/NCKHnew/page/rateAction.php?hospitalName=${name}">Bấm xem chi tiết</a>
                    <h3>${name}</h3>
                    <p>${introduction}</p>
                    <p><strong>Địa chỉ:</strong> ${address}</p>
                    <p><strong>Số điện thoại:</strong> ${phone}</p>
                    <img src="${image}" alt="${name}" style="max-width: 200px;">
                </div>
            `;

            L.marker([coordinates[1], coordinates[0]]).bindPopup(popupContent).addTo(map);
        });
    </script>
    
    <?php require_once(__ROOT__ . '/component/footer.php'); ?>
</body>
</html>
