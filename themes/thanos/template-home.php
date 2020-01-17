<?php
/*
 Template Name: Home
 */
get_header();?>
<style>#map { position: relative; top: 0; bottom: 0; height: 800px;}</style>
    <style>
        #menu {
            background: #fff;
            position: absolute;
            z-index: 1;
            top: 10px;
            right: 10px;
            border-radius: 3px;
            width: 120px;
            border: 1px solid rgba(0, 0, 0, 0.4);
            font-family: 'Open Sans', sans-serif;
        }

        #menu a {
            font-size: 13px;
            color: #404040;
            display: block;
            margin: 0;
            padding: 0;
            padding: 10px;
            text-decoration: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.25);
            text-align: center;
        }

        #menu a:last-child {
            border: none;
        }

        #menu a:hover {
            background-color: #f8f8f8;
            color: #404040;
        }

        #menu a.active {
            background-color: #3887be;
            color: #ffffff;
        }

        #menu a.active:hover {
            background: #3074a4;
        }
    </style>
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
                            <nav id="menu"></nav>
                            <div id='map'></div>
                        </div>
                    </div>
                </div>
        </div>

        <script>

            mapboxgl.accessToken = 'pk.eyJ1IjoibGlua2ViaW4iLCJhIjoiY2szbzcxNGIzMDVwdTNibXV6MWV6MXgxeiJ9.SU_Tmcud24UTRnCFDIJJVw';

            //Initialisation de la map


            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [1.4333257, 43.6000354],
                zoom: 15
            });

            map.addControl(
                new MapboxDirections({
                    accessToken: mapboxgl.accessToken,
                    unit: 'metric',
                    container: 'directions',
                    language: 'fr'
                }),
                'bottom-left'
            );


            //Fonction pour récupérer le geojson

            function httpGet(theUrl)
            {
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
                xmlHttp.send( null );
                return xmlHttp.responseText;
            }

            //Intégration du geojson dans une variable
            var request = JSON.parse(httpGet("http://localhost:8000/bins/getAllBins"));

            var baseurl = 'http://localhost/wordpresslinkebin/';
            console.log(request);
            console.log(request);




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



//GEOLOCALISATION

                    map.addControl(new mapboxgl.GeolocateControl({
                        positionOptions: {
                            enableHighAccuracy: true
                        },
                        trackUserLocation: true
                    }));


                    var geocoder = new MapboxGeocoder({
                        accessToken: mapboxgl.accessToken,
                        marker: {
                            color: 'orange',
                            radius: 1000
                        },
                        mapboxgl: mapboxgl,
                        limit: 10
                    });

                    map.addControl(geocoder, 'top-left');


                    map.addLayer({
                        id: "clusters",
                        type: "circle",
                        source: "BIN",
                        filter: ["has", "point_count"],
                        layout:{"visibility": "none"},
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
                            "visibility": "visible",
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
                    var adresse = e.features[0].properties.adress;
                    console.log(adresse);
                    console.log(commune);

                    new mapboxgl.Popup()
                        .setLngLat(coordinates)
                        .setHTML(adresse+'<p><strong>'+commune+'</strong></p>')
                        .addTo(map)
                });

                map.on('mouseenter', 'clusters', function () {
                    map.getCanvas().style.cursor = 'pointer';
                });
                map.on('mouseleave', 'clusters', function () {
                    map.getCanvas().style.cursor = '';
                });

            });
            var toggleableLayerIds = ['clusters', 'unclustered-point'];

            for (var i = 0; i < toggleableLayerIds.length; i++) {
                var id = toggleableLayerIds[i];

                var link = document.createElement('a');
                link.href = '#';
                link.className = 'active';
                link.textContent = id;

                link.onclick = function(e) {
                    var clickedLayer = this.textContent;
                    e.preventDefault();
                    e.stopPropagation();

                    var visibility = map.getLayoutProperty(clickedLayer, 'visibility');

                    if (visibility === 'visible') {
                        map.setLayoutProperty(clickedLayer, 'visibility', 'none');
                        this.className = '';
                    } else {
                        this.className = 'active';
                        map.setLayoutProperty(clickedLayer, 'visibility', 'visible');
                    }
                };

                var layers = document.getElementById('menu');
                layers.appendChild(link);
            }



        </script>
    </main>



<?php  get_footer()?>