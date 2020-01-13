<?php
/*
 Template Name: Home
 */
get_header();?>
<style>#map { position: relative; top: 0; bottom: 0; height: 800px;}</style>
    <main id="mainContent" class="p-0">
        <div class="row">
            <aside id="sidebar-menu" class="shadow-sm">
                <ul>
                    <li><a href="">Item</a></li>
                </ul>
            </aside>
        </div>
        <div class="container main-title">
            <div class="row">
                <div class="col-lg-9 m-auto">
                    <h1>La plateforme qui vous réconcilie avec le recyclage</h1>
                </div>
            </div>
        </div>
        <div id="map2" class="container pull-up">
                <div class="col-lg-9 m-auto">
                    <div class="card-m-b-30 bg-light rounded-lg shadow-sm">
                        <div class="card-header border-0">
                            <div class="card-title">Localisation des bennes</div>

                        </div>
                        <div class="card-body">
                            <div id='map'></div>
                        </div>
                    </div>
                </div>
        </div>

        <script>

            mapboxgl.accessToken = 'pk.eyJ1IjoibGlua2ViaW4iLCJhIjoiY2szbzcxNGIzMDVwdTNibXV6MWV6MXgxeiJ9.SU_Tmcud24UTRnCFDIJJVw';

            //Initialisation de la map

            //var MapboxDirections = require('@mapbox/mapbox-gl-directions');

            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [1.4333257, 43.6000354],
                zoom: 15
            });

            //var bounds = [[1.4333257, 43.6000354], [1.4333257, 43.6000354]];
            //map.setMaxBounds(bounds);

            var canvas = map.getCanvasContainer();

            var start = [1.4333257, 43.6000354];

            function getRoute(end) {
                // make a directions request using cycling profile
                // an arbitrary start will always be the same
                // only the end or destination will change
                var start = [1.4333257, 43.6000354];
                var url = 'https://api.mapbox.com/directions/v5/mapbox/cycling/' + start[0] + ',' + start[1] + ';' + end[0] + ',' + end[1] + '?steps=true&geometries=geojson&access_token=' + mapboxgl.accessToken;

                // make an XHR request https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
                var req = new XMLHttpRequest();
                req.responseType = 'json';
                req.open('GET', url, true);
                req.onload = function() {
                    var data = req.response.routes[0];
                    var route = data.geometry.coordinates;
                    var geojson = {
                        type: 'Feature',
                        properties: {},
                        geometry: {
                            type: 'LineString',
                            coordinates: route
                        }
                    };
                    // if the route already exists on the map, reset it using setData
                    if (map.getSource('route')) {
                        map.getSource('route').setData(geojson);
                    } else { // otherwise, make a new request
                        map.addLayer({
                            id: 'route',
                            type: 'line',
                            source: {
                                type: 'geojson',
                                data: {
                                    type: 'Feature',
                                    properties: {},
                                    geometry: {
                                        type: 'LineString',
                                        coordinates: geojson
                                    }
                                }
                            },
                            layout: {
                                'line-join': 'round',
                                'line-cap': 'round'
                            },
                            paint: {
                                'line-color': '#3887be',
                                'line-width': 5,
                                'line-opacity': 0.75
                            }
                        });
                    }
                    // add turn instructions here at the end
                };
                req.send();
            }

            map.on('load', function() {
                // make an initial directions request that
                // starts and ends at the same location
                getRoute(start);

                // Add starting point to the map
                map.addLayer({
                    id: 'point',
                    type: 'circle',
                    source: {
                        type: 'geojson',
                        data: {
                            type: 'FeatureCollection',
                            features: [{
                                type: 'Feature',
                                properties: {},
                                geometry: {
                                    type: 'Point',
                                    coordinates: start
                                }
                            }
                            ]
                        }
                    },
                    paint: {
                        'circle-radius': 10,
                        'circle-color': '#3887be'
                    }
                });
                // this is where the code from the next step will go
            });


            //Fonction pour récupérer le geojson

            function httpGet(theUrl)
            {
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
                xmlHttp.send( null );
                return xmlHttp.responseText;
            }

            //Intégration du geojson dans une variable
            var request = JSON.parse(httpGet("https://angotbaptiste.com/test.php"));
            var baseurl = 'http://localhost/wordpresslinkebin/';



            map.on('load', function() {

                map.loadImage(baseurl + 'wp-content/themes/thanos/assets/img/poubelleverre.png', function(error, image) {
                    if (error) throw error;
                    map.addImage('poubelle', image);

// Add a new source from our GeoJSON data and set the
// 'cluster' option to true. GL-JS will add the point_count property to your source data.
                    map.addSource("BIN", {
                        type: "geojson",
                        data: request,
                        cluster: true,
                        clusterMaxZoom: 14, // Max zoom to cluster points on
                        clusterRadius: 50 // Radius of each cluster when clustering points (defaults to 50)
                    });




                    //map.addControl(new mapboxgl.GeolocateControl({
                    //    positionOptions: {
                    //        enableHighAccuracy: true
                    //    },
                    //    trackUserLocation: true
                   // }));
                    var geocoder = new MapboxGeocoder({
                        accessToken: mapboxgl.accessToken,
                        marker: {
                            color: 'orange',
                            radius: 1000
                        },

                        mapboxgl: mapboxgl
                    });

                    map.addControl(geocoder, 'top-left');


                    map.addControl(
                        new MapboxDirections({
                            accessToken: mapboxgl.accessToken,
                            unit: 'metric'
                        }),
                        'bottom-left'
                    );

                    map.addLayer({
                        id: "clusters",
                        type: "circle",
                        source: "BIN",
                        filter: ["has", "point_count"],
                        paint: {
                            "circle-color": [
                                "step",
                                ["get", "point_count"],
                                "#51bbd6",
                                100,
                                "#f1f075",
                                750,
                                "#f28cb1"
                            ],
                            "circle-radius": [
                                "step",
                                ["get", "point_count"],
                                20,
                                100,
                                30,
                                750,
                                40
                            ]
                        }
                    });

                    map.addLayer({
                        id: "cluster-count",
                        type: "symbol",
                        source: "BIN",
                        filter: ["has", "point_count"],
                        layout: {
                            "text-field": "{point_count_abbreviated}",
                            "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
                            "text-size": 12
                        }
                    });

                    map.addLayer({
                        id: "unclustered-point",
                        type: "symbol",
                        source: "BIN",
                        filter: ["!", ["has", "point_count"]],
                        layout: {
                            "icon-image": "poubelle",
                            "icon-size": 0.05
                        }
                    });
                });

// inspect a cluster on click
                map.on('click', 'clusters', function (e) {
                    var features = map.queryRenderedFeatures(e.point, { layers: ['clusters'] });
                    var clusterId = features[0].properties.cluster_id;
                    map.getSource('BIN').getClusterExpansionZoom(clusterId, function (err, zoom) {
                        if (err)
                            return;

                        map.easeTo({
                            center: features[0].geometry.coordinates,
                            zoom: zoom
                        });
                    });
                });

                map.on('click', 'unclustered-point', function (e) {
                    var coordinates = e.features[0].geometry.coordinates.slice();
                    var commune = e.features[0].properties.commune;
                    var adresse = e.features[0].properties.adresse;
                    var type = e.features[0].properties.dmt_type;
                    console.log(adresse);
                    console.log(commune);
                    console.log(type);

                    new mapboxgl.Popup()
                        .setLngLat(coordinates)
                        .setHTML(adresse+'<p><strong>'+commune+'</strong></p>'+'<p>'+type+'</p>')
                        .addTo(map)
                });

                map.on('mouseenter', 'clusters', function () {
                    map.getCanvas().style.cursor = 'pointer';
                });
                map.on('mouseleave', 'clusters', function () {
                    map.getCanvas().style.cursor = '';
                });
                map.on('click', function(e) {
                    var coordsObj = e.lngLat;
                    canvas.style.cursor = '';
                    var coords = Object.keys(coordsObj).map(function(key) {
                        return coordsObj[key];
                    });
                    var end = {
                        type: 'FeatureCollection',
                        features: [{
                            type: 'Feature',
                            properties: {},
                            geometry: {
                                type: 'Point',
                                coordinates: coords
                            }
                        }
                        ]
                    };
                    if (map.getLayer('end')) {
                        map.getSource('end').setData(end);
                    } else {
                        map.addLayer({
                            id: 'end',
                            type: 'circle',
                            source: {
                                type: 'geojson',
                                data: {
                                    type: 'FeatureCollection',
                                    features: [{
                                        type: 'Feature',
                                        properties: {},
                                        geometry: {
                                            type: 'Point',
                                            coordinates: coords
                                        }
                                    }]
                                }
                            },
                            paint: {
                                'circle-radius': 10,
                                'circle-color': '#f30'
                            }
                        });
                    }
                    getRoute(coords);
                });


            });

        </script>
    </main>



<?php  get_footer()?>