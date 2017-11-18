<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Maps > OpenProfile</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="geo.css" rel="stylesheet"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" type="text/javascript"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"
              integrity="sha512-M2wvCLH6DSRazYeZRIm1JnYyh22purTM+FDB5CsyxtQJYeKq83arPe5wgbNmcFXGqiSH2XR8dT/fJISVA1r/zQ=="
              crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"
                integrity="sha512-lInM/apFSqyy1o6s89K4iQUKg6ppXEgsVxT35HbzUupEVRh2Eu9Wdl4tHj7dZO0s1uvplcYGmt3498TtHq+log=="
                crossorigin=""></script>
        <script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
    </head>
    <body>
        <div id="map"></div>
        <button type="button" id="submit" class="btn" onclick="go();">Abschließen</button>
        <script type="text/javascript">
            let map = L.map('map').setView([47.453418, 14.442466], 8);
            let coords = [];

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 18
            }).addTo(map);

            function onMapClick(e) {
                let lat = e.latlng.lat;
                let lng = e.latlng.lng;
                let marker = L.marker([lat, lng]).addTo(map);
                /*let input = document.createElement("input");
                input.style.borderBottom = "1px solid black";
                let popup = L.popup().setContent(input);
                input.addEventListener("keydown", function(e) {
                    if (e.keyCode === 13) {
                        popup.setContent(`<p style='text-align: center; margin: 0; font-size: 15px;'>${input.value}</p>`);
                    }
                });
                marker.bindPopup(popup).openPopup();*/
            }

            function getMean(arr) {
                let res = [0, 0];
                arr.forEach(function (el) {
                    res[0] += el[0];
                    res[1] += el[1];
                });
                res[0] = res[0] / arr.length;
                res[1] = res[1] / arr.length;
                return res;
            }

            function go() {
                map.closePopup();
                map.eachLayer(function (layer) {
                    if (typeof layer._icon !== 'undefined') {
                        let lat = layer._latlng.lat;
                        let lng = layer._latlng.lng;
                        coords.push([lat, lng]);
                    }
                });
                let features = [];
                for (let i = 0; i < coords.length; i++) {
                    features.push(turf.point([coords[i][0], coords[i][1]]));
                }
                let points = turf.featureCollection(features);
                let hull = turf.convex(points);
                coords_hull = [];
                for (let i = 0; i < hull.geometry.coordinates.length; i++) {
                    coords_hull.push(hull.geometry.coordinates[i]);
                }
                let polygon = L.polygon(coords_hull, {color: "red"}).addTo(map);
                let tpolygon = turf.polygon(hull.geometry.coordinates);
                let centroid = turf.centroid(tpolygon);
                let center = turf.centerOfMass(tpolygon);
                let centroidMarker = L.marker(centroid.geometry.coordinates).addTo(map);
                let centerMarker = L.marker(center.geometry.coordinates).addTo(map);
                let meanMarker = L.marker(getMean(coords)).addTo(map);
                centroidMarker.bindPopup("Centroid").openPopup();
                centerMarker.bindPopup("Center").openPopup();
                meanMarker.bindPopup("XX").openPopup();

                let clustered = turf.clustersKmeans(points);
                let cluster = turf.getCluster(clustered, {cluster: 3});
                console.log(cluster);

                let co = features.map(function (el) {
                    return el.geometry.coordinates;
                });

                let polygon2 = L.polygon(coords_hull, {color: "blue"}).addTo(map);

                map.fitBounds(polygon.getBounds());
            }

            map.on('click', onMapClick);
        </script>
    </body>
</html>